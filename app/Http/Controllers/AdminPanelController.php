<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\CompanyFollower;
use App\Models\CompanyRatings;
use App\Models\JobApplication;
use App\Models\JobExperience;
use App\Models\Jobs;
use App\Models\JobType;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminPanelController extends Controller
{
    // for show dashboard page
    public function showDashboard()
    {
        // Existing code
        $registeredUsers = User::count();
        $registeredCompanies = Company::count();
        $activeJobListings = Jobs::where('status', 1)->count();
        $totalApplications = JobApplication::count();
        
        // Add this new code for chart data
        $chartData = $this->getChartData();
        
        $recentJobs = Jobs::with(['company', 'user'])
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->take(5) 
            ->get();
        
        return view('admin.panel.dashboard', compact(
            'registeredUsers',
            'registeredCompanies',
            'activeJobListings',
            'totalApplications',
            'recentJobs',
            'chartData'  // Pass chart data to the view
        ));
    }

    // Add this new method to get chart data
    private function getChartData()
    {
        // Get the last 7 months
        $months = [];
        $monthsData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $months[] = $date->format('M Y'); // Include year for better clarity
            $monthsData[] = [
                'month' => $date->format('M'),
                'year' => $date->year,
                'monthNum' => $date->month,
                'startDate' => $date->startOfMonth()->format('Y-m-d'),
                'endDate' => $date->endOfMonth()->format('Y-m-d'),
            ];
        }
        
        // Get job counts by month with more accurate date filtering
        $jobsData = [];
        foreach ($monthsData as $monthData) {
            $jobsData[] = Jobs::whereDate('created_at', '>=', $monthData['startDate'])
                ->whereDate('created_at', '<=', $monthData['endDate'])
                ->count();
        }
        
        // If no data (all zeros), provide fallback data for testing
        if (array_sum($jobsData) === 0) {
            $jobsData = [10, 15, 20, 25, 30, 35, 40];
        }
        
        // Get application counts by month
        $applicationsData = [];
        foreach ($monthsData as $monthData) {
            $applicationsData[] = JobApplication::whereDate('created_at', '>=', $monthData['startDate'])
                ->whereDate('created_at', '<=', $monthData['endDate'])
                ->count();
        }
        
        // If no data, provide fallback data for testing
        if (array_sum($applicationsData) === 0) {
            $applicationsData = [5, 10, 15, 20, 25, 30, 35];
        }
        
        // Get user registration counts by month
        $usersData = [];
        foreach ($monthsData as $monthData) {
            $usersData[] = User::whereDate('created_at', '>=', $monthData['startDate'])
                ->whereDate('created_at', '<=', $monthData['endDate'])
                ->count();
        }
        
        // If no data, provide fallback data for testing
        if (array_sum($usersData) === 0) {
            $usersData = [8, 12, 18, 22, 28, 32, 38];
        }
        
        // Get company registration counts by month
        $companiesData = [];
        foreach ($monthsData as $monthData) {
            $companiesData[] = Company::whereDate('created_at', '>=', $monthData['startDate'])
                ->whereDate('created_at', '<=', $monthData['endDate'])
                ->count();
        }
        
        // If no data, provide fallback data for testing
        if (array_sum($companiesData) === 0) {
            $companiesData = [3, 5, 8, 10, 12, 15, 18];
        }
        
        // Calculate growth percentages
        $growthData = [
            'jobs' => $this->calculateGrowthPercentage($jobsData),
            'applications' => $this->calculateGrowthPercentage($applicationsData),
            'users' => $this->calculateGrowthPercentage($usersData),
            'companies' => $this->calculateGrowthPercentage($companiesData)
        ];
        
        return [
            'months' => $months,
            'jobs' => $jobsData,
            'applications' => $applicationsData,
            'users' => $usersData,
            'companies' => $companiesData,
            'growth' => $growthData
        ];
    }

    /**
     * Calculate growth percentage between current and previous month
     * 
     * @param array $data Array of monthly data
     * @return float Growth percentage
     */
    private function calculateGrowthPercentage($data)
    {
        if (count($data) < 2) {
            return 0;
        }
        
        $currentMonth = $data[count($data) - 1];
        $previousMonth = $data[count($data) - 2];
        
        if ($previousMonth == 0) {
            return $currentMonth > 0 ? 100 : 0;
        }
        
        return round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1);
    }

    /**
     * Get trending data for the dashboard
     * 
     * @return array Array containing trending categories and job types
     */
    private function getTrendingData()
    {
        // Get trending job categories (last 30 days)
        $trendingCategories = Jobs::select('job_category_id', DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy('job_category_id')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $category = Category::find($item->job_category_id);
                return [
                    'id' => $item->job_category_id,
                    'name' => $category ? $category->category_name : 'Unknown',
                    'count' => $item->count
                ];
            });
        
        // Get trending job types (last 30 days)
        $trendingJobTypes = Jobs::select('job_type_id', DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(30))
            ->groupBy('job_type_id')
            ->orderBy('count', 'desc')
            ->take(5)
            ->get()
            ->map(function ($item) {
                $jobType = JobType::find($item->job_type_id);
                return [
                    'id' => $item->job_type_id,
                    'name' => $jobType ? $jobType->type_name : 'Unknown',
                    'count' => $item->count
                ];
            });
            
        return [
            'categories' => $trendingCategories,
            'jobTypes' => $trendingJobTypes
        ];
    }
    // for show jobs management page
    public function showJobManagement(Request $request)
    {
        // Get search parameters
        $search = $request->get('search');
        $category = $request->get('category');
        $status = $request->get('status');
        $postedBy = $request->get('posted_by');
        
        // Start building the query
        $query = Jobs::with(['Category', 'jobType'])
            ->select('jobs.*')
            ->orderBy('created_at', 'desc');
            
        // Apply search filters if provided
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                ->orWhere('company_name', 'like', "%{$search}%");
            });
        }
        
        if ($category) {
            $query->where('job_category_id', $category);
        }
        
        if ($status !== null) {
            $query->where('status', $status);
        }

        // Add posted_by filter
        if ($postedBy) {
            if ($postedBy === 'user') {
                $query->whereNotNull('user_id');
            } else if ($postedBy === 'company') {
                $query->whereNull('user_id');
            }
        }

        // Get paginated results
        $jobs = $query->paginate(10);
        
        // Get categories and types for filters
        $categories = Category::all();
        $jobTypes = JobType::all();

        return view('admin.panel.JobManagement', compact('jobs', 'categories', 'jobTypes'));
    }

        public function toggleStatus(Request $request, $id)
    {
        // Find the job by ID
        $job = Jobs::findOrFail($id);

        // Toggle the status
        $job->status = !$job->status;
        $job->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Job status updated successfully.');
    }

    // view job details job page
    public function showJobDetails($id)
    {
        $job = Jobs::with(['Category', 'jobType','applicants_count'])->findOrFail($id);
        
        // Parse arrays from strings if stored as JSON
        $benefits = $this->splitIntoListItems($job->benefits);
        $responsibilities = $this->splitIntoListItems($job->responsibility);
        $qualifications = $this->splitIntoListItems($job->qualifications);
        
        return view('admin.panel.adminJobDetail', compact(
            'job',
            'responsibilities',
            'qualifications',
            'benefits'
        ));
    }
    private function splitIntoListItems($text)
    {
            // Ensure input is a string and not null
            if (is_null($text) || !is_string($text)) {
                return [];
            }

            // Normalize line breaks
            $text = preg_replace('/\r\n|\r|\n/', "\n", $text);
            
            // Split text by space, newline, or period
            $lines = preg_split('/(\s+|\n)/', $text);
            
            // Clean up whitespace and remove empty items
            $lines = array_filter(array_map('trim', $lines));
            
            return array_values($lines); // Re-index array
    }
    
    // for delete jobs
    public function deleteJob($id)
    {
        $job = Jobs::find($id);

        if ($job) {
            $job->delete();
            return redirect()->back()->with('success', 'Job deleted successfully..!!');
        } else {
            return redirect()->back()->with('error', 'Job not found.');
        }
    }

    // Show user management page
    public function showUserManage(Request $request)
    {
        // Get search parameter
        $search = $request->get('search');

        // Start building the query
        $query = User::orderBy('created_at', 'desc');

        // Apply search filter if provided
        if ($search) {
            $query->where('fullName', 'like', "%{$search}%");
        }

        // Get paginated results
        $users = $query->paginate(10);

        return view('admin.panel.userManagement', compact('users'));
    }

    // Delete user
    public function deleteUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return redirect()->back()->with('success', 'User deleted successfully..!!');
        } else {
            return redirect()->back()->with('error', 'User not found.');
        }
    }

    // for user profile page
    public function showUserProfile($id)
    {
        // Find the user by ID with their details
        $user = User::findOrFail($id);
        $userDetail = UserDetail::where('user_id', $id)->first();
        
        return view('admin.panel.viewUserProfile', compact('user', 'userDetail'));
    }

    // show company management page
    public function showCompanyManage(Request $request)
    {
        // Get search parameter
        $search = $request->get('search');

        // Start building the query
        $query = Company::orderBy('created_at', 'desc');

        // Apply search filter if provided
        if ($search) {
            $query->where('c_name', 'like', "%{$search}%");
        }

        // Get paginated results
        $companies = $query->paginate(10);

        return view('admin.panel.companyManagement', compact('companies'));
    }

    // delete a particular company
    public function deleteCompany($id)
    {
        $company = Company::find($id);

        if ($company) {
            $company->delete();
            return redirect()->back()->with('success', 'Company deleted successfully..!!');
        } else {
            return redirect()->back()->with('error', 'Company not found.');
        }
    }

    // show company profile
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

        return view('admin.panel.viewCompanyProfile', [
            'company' => $company,
            'jobs' => $jobs,
            'activeTab' => $request->query('tab', 'overview'),
            'avgRating' => round($avgRating, 1),
            'userRating' => $userRating
        ]);
    }

    // show application management
    public function showApplicationManage()
    {
        // Fetch jobs posted by users
        $userJobs = Jobs::with(['Category', 'jobType', 'applicants_count'])
            ->whereNotNull('user_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Fetch jobs posted by companies
        $companyJobs = Jobs::with(['Category', 'jobType', 'applicants_count'])
            ->whereNotNull('company_id')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        return view('admin.panel.applicationManagement', compact('userJobs', 'companyJobs'));
    }

    // view applicants for particular jobs
    public function showJobApplicants($job_id)
    {
        // Fetch the job details
        $job = Jobs::findOrFail($job_id);
    
        // Fetch the applicants for the job with pagination
        $applicants = $job->applicants_count()->with('user', 'job')->paginate(20);
    
        return view('admin.panel.viewApplication', compact('job', 'applicants'));
    }

    // show category and skill management page
    public function showCategorySkillManage()
    {
        $categories = Category::all(); 
        $jobTypes = JobType::all(); 
        $experiences = JobExperience::all();

        return view('admin.panel.categorySkillsManagement', compact('categories', 'jobTypes', 'experiences'));
    }

    // add category
    public function addCategory(Request $request)
    {
        // Validate the request
        $request->validate([
            'category_name' => 'required|string|max:255|unique:job_categories,category_name',
        ]);

        // Insert into the database
        DB::table('job_categories')->insert([
            'category_name' => $request->category_name,
            'status' => 1, // Default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category added successfully..!!');
    }

    // add type
    public function addJobType(Request $request)
    {
        // Validate the request
        $request->validate([
            'type_name' => 'required|string|max:255|unique:job_types,type_name',
        ]);

        // Insert into the database
        DB::table('job_types')->insert([
            'type_name' => $request->type_name,
            'status' => 1, // Default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Job Type added successfully..!!');
    }

    // add experience
    public function addExperience(Request $request)
    {
        // Validate the request
        $request->validate([
            'experience_name' => 'required|string|max:255|unique:job_experience,experience',
        ]);

        // Insert into the database
        DB::table('job_experience')->insert([
            'experience' => $request->experience_name,
            'status' => 1, // Default status
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Experience added successfully..!!');
    }

    public function toggleCategoryStatus(Request $request, $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Toggle the status
        $category->status = !$category->status;
        $category->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category status updated successfully..!!');
    }

    public function toggleJobTypeStatus(Request $request, $id)
    {
            // Find the job type by ID
            $jobType = JobType::findOrFail($id);

            // Toggle the status
            $jobType->status = !$jobType->status;
            $jobType->save();

            // Redirect back with a success message
            return redirect()->back()->with('success', 'Job type status updated successfully..!!');
    }

    public function toggleExperienceStatus(Request $request, $id)
    {
        // Find the experience level by ID
        $experience = JobExperience::findOrFail($id);

        // Toggle the status
        $experience->status = !$experience->status;
        $experience->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Experience status updated successfully..!!');
    }

    // show feedbacks and reviews
    public function showFeedbackRatingManage()
    {
        // Get user feedbacks with user information
        $userFeedbacks = DB::table('feedbacks')
            ->join('users', 'feedbacks.user_id', '=', 'users.id')
            ->select('feedbacks.*', 'users.fullName', DB::raw('ROW_NUMBER() OVER (ORDER BY feedbacks.created_at DESC) as row_num'))
            ->orderBy('feedbacks.created_at', 'desc')
            ->paginate(10);

        return view('admin.panel.FeedbackRatingManagement', compact('userFeedbacks'));
    }

    public function setFeedback($id)
    {
        $feedback = DB::table('feedbacks')->where('id', $id)->first();

        if ($feedback) {
            $isFeedback = $feedback->is_feedback ? 0 : 1;
            DB::table('feedbacks')->where('id', $id)->update(['is_feedback' => $isFeedback]);

            return redirect()->back()->with('success', 'Feedback status updated successfully!');
        }

        return redirect()->back()->with('error', 'Feedback not found.');
    }

    public function deleteFeedback($id)
    {
        $feedback = DB::table('feedbacks')->where('id', $id)->first();
        
        if ($feedback) {
            DB::table('feedbacks')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Feedback deleted successfully!');
        }
        
        return redirect()->back()->with('error', 'Feedback not found.');
    }
    
    public function showCompanieReview()
    {
        $companyRatings = CompanyRatings::with(['user', 'company'])
            ->select(
                'company_ratings.id',
                'company_ratings.user_id',
                'company_ratings.company_id',
                'company_ratings.rating',
                'company_ratings.feedback',
                'company_ratings.created_at'
            )
            ->orderBy('company_ratings.created_at', 'desc')
            ->paginate(10); // Adjust the pagination as needed

        return view('admin.panel.companieReview', compact('companyRatings'));
    }
}
