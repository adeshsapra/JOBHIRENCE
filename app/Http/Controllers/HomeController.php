<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Feedback;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    //show home page
    public function index(){

        // Fetch trending jobs (most applied jobs)
    $trendingJobs = Jobs::withCount('applications')
                        ->with('jobType')
                        ->where('status', 1)
                        ->orderByDesc('applications_count')
                        ->orderByDesc('created_at')
                        ->take(6)
                        ->get();


        // categories
        $categories = Category::where('status',1)->orderBy('category_name','ASC')->take(8)->get();

        // letest jobs
        $letestJobs = Jobs::where('status',1)
                        ->orderBy('created_at','DESC')
                        ->with('jobType')
                        ->take(8)
                        ->get();
        
        // feedbacks
        $feedbacks = Feedback::with(['user']) 
                                ->where('is_feedback', 1) 
                                ->orderBy('created_at', 'desc') 
                                ->get(); 


       // Top companies
        $topCompanies = Company::select(
            'companies.*',
            'company_details.profile_img',
            'company_details.about',
            DB::raw('(SELECT COUNT(*) FROM jobs WHERE jobs.company_id = companies.id) as job_count'),
            // DB::raw('(SELECT AVG(rating) FROM company_reviews WHERE company_reviews.company_id = companies.id) as avg_rating'),
            // DB::raw('(SELECT COUNT(*) FROM company_reviews WHERE company_reviews.company_id = companies.id) as review_count')
        )
        ->leftJoin('company_details', 'companies.id', '=', 'company_details.company_id')
        ->orderBy('job_count', 'DESC')
        ->orderBy('created_at', 'ASC')
        ->take(10)
        ->get();

        return view('front.home', [
            'categories' => $categories,
            'trendingJobs' => $trendingJobs,
            'letestJobs' => $letestJobs,
            'feedbacks' => $feedbacks,
            'topCompanies' => $topCompanies
        ]);
    }
}
