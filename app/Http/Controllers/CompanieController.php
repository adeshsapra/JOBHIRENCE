<?php

namespace App\Http\Controllers;

use App\Models\CompanyFollower;
use App\Models\CompanyRating;
use App\Models\CompanyRatings;
use App\Models\Jobs;
use Illuminate\Contracts\Queue\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CompanieController extends Controller
{
    // show companies
    public function showCompanies()
    {
        // Get companies with basic information
        $companies = DB::table('companies')
            ->leftJoin('company_details', 'companies.id', '=', 'company_details.company_id')
            ->select(
                'companies.id',
                'companies.c_name',
                'companies.c_industry',
                'companies.c_type',
                'company_details.profile_img',
                'company_details.market_type'
            )
            ->distinct()
            ->paginate(24);

        $totalCompanies = DB::table('companies')->count();

        // Get all company IDs for efficient query
        $companyIds = $companies->pluck('id')->toArray();

        // Get average ratings for all companies in one query
        $avgRatings = DB::table('company_ratings')
            ->select('company_id', DB::raw('AVG(rating) as avg_rating'), DB::raw('COUNT(*) as review_count'))
            ->whereIn('company_id', $companyIds)
            ->groupBy('company_id')
            ->get()
            ->keyBy('company_id');

        // Get 2 most recent reviews for each company in one query
        $recentReviews = DB::table('company_ratings')
            ->select(
                'company_ratings.company_id',
                'company_ratings.rating',
                'company_ratings.feedback',
                'company_ratings.created_at',
                'users.fullName as user_name'
            )
            ->join('users', 'company_ratings.user_id', '=', 'users.id')
            ->whereIn('company_ratings.company_id', $companyIds)
            ->whereNotNull('company_ratings.feedback')
            ->orderBy('company_ratings.created_at', 'desc')
            ->get()
            ->groupBy('company_id');

        // Add ratings and reviews to each company object
        foreach ($companies as $company) {
            $rating = $avgRatings->get($company->id);
            
            $company->avg_rating = $rating ? round($rating->avg_rating, 1) : 0;
            $company->review_count = $rating ? $rating->review_count : 0;
            
            // Add recent reviews (limit to 2)
            $company->recent_reviews = $recentReviews->get($company->id, collect())->take(2);
        }

        return view('front.companie', compact('companies', 'totalCompanies'));
    }

    // show company details 
    public function showCompanyDetails($id, Request $request)
    {
        $company = DB::table('companies')
            ->leftJoin('company_details', 'companies.id', '=', 'company_details.company_id')
            ->select(
                'companies.*',
                'company_details.*',
                'companies.id as id'
            )
            ->where('companies.id', $id)
            ->first();

        if (!$company) {
            return abort(404);
        }

        // Get average rating and user's rating if logged in
        $avgRating = CompanyRatings::where('company_id', $id)->avg('rating') ?? 0;
        $userRating = null;
        
        if (Auth::check()) {
            $userRating = CompanyRatings::where('company_id', $id)
                ->where('user_id', Auth::id())
                ->first();
        }

        $jobs = Jobs::where('company_id', $id)
            ->where('status', 1)
            ->with('jobType')
            ->paginate(6);

        $isFollowing = false;
        if (Auth::check()) {
            $isFollowing = CompanyFollower::where('user_id', Auth::id())
                ->where('company_id', $id)
                ->exists();
        }

        return view('front.viewCompanyDetails', [
            'company' => $company,
            'jobs' => $jobs,
            'activeTab' => $request->query('tab', 'overview'),
            'isFollowing' => $isFollowing,
            'avgRating' => round($avgRating, 1),
            'userRating' => $userRating
        ]);
    }

    // follow company
    public function followCompany($id)
    {
        try {
            CompanyFollower::firstOrCreate([
                'user_id' => Auth::id(),
                'company_id' => $id
            ]);
            
            return redirect()->back()->with('success', 'Company followed successfully..!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to follow company');
        }
    }

    // unfollow company
    public function unfollowCompany($id)
    {
        try {
            CompanyFollower::where('user_id', Auth::id())
                ->where('company_id', $id)
                ->delete();
                
            return redirect()->back()->with('success', 'Company unfollowed successfully..!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to unfollow company');
        }
    }

    // rating companies
    public function rateCompany(Request $request, $id)
    {
        if (!Auth::check()) {
            return redirect()->route('account.userLogin')
                ->with('error', 'Please login to rate companies');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string|max:1000'
        ]);

        try {
            CompanyRatings::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'company_id' => $id
                ],
                [
                    'rating' => $request->rating,
                    'feedback' => $request->feedback
                ]
            );

            return redirect()->back()->with('success', 'Thank you for your rating..!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit rating');
        }
    }
}
