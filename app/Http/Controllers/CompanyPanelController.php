<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\JobApplication;
use Illuminate\Support\Str; 
use App\Models\Jobs;
use App\Models\JobType;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class CompanyPanelController extends Controller
{
        // show company login page
        public function showLogin(){
            return view('company.company_login');
        }

        // show company register page
        public function showRegister(){
            return view('company.company_register');
        }

        // registratin process store data into database
        public function companyRegistration(Request $request)
        {
            // Check if this is the basic details submission (first step)
            if (!$request->has('c_industry')) {
                // Validate basic details
                $request->validate([
                    'c_name' => 'required|string|max:255',
                    'c_email' => 'required|email|unique:companies,c_email',
                    'c_password' => 'required|min:8',
                ], [
                    'c_name.required' => 'The Company Name is required.',
                    'c_email.required' => 'The Email field is required.',
                    'c_email.unique' => 'This email is already registered.',
                    'c_password.required' => 'The Password field is required.',
                    'c_password.min' => 'Password must be at least 8 characters.',
                ]);

                // Store basic details in session
                session([
                    'basic_details' => $request->only(['c_name', 'c_email', 'c_password']),
                    'basic_details_completed' => true,
                    'show_company_details' => true
                ]);

                // Redirect back to show company details form
                return redirect()->route('company.register');
            } else {
                // For company details submission, keep the basic details form data in session
                if (!session('basic_details_completed')) {
                    return redirect()->route('company.register')
                        ->withErrors(['error' => 'Please complete basic details first']);
                }

                // Validate company details
                $request->validate([
                    'c_industry' => 'required|string|max:255',
                    'c_size' => 'nullable|string',
                    'c_established_year' => 'required|integer|min:1800|max:' . date('Y'),
                    'c_type' => 'required|string|max:255',
                    'c_city' => 'required|string|max:255',
                    'c_country' => 'required|string|max:255',
                    'c_postal_code' => 'required|string|max:10',
                    'c_website' => 'nullable|url',
                    'c_address' => 'required|string',
                ], [
                    'c_industry.required' => 'The Industry field is required.',
                    'c_established_year.required' => 'The Year field is required.',
                    'c_established_year.integer' => 'The Year must be a valid number.',
                    'c_type.required' => 'The Company Type field is required.',
                    'c_city.required' => 'The City field is required.',
                    'c_country.required' => 'The Country field is required.',
                    'c_postal_code.required' => 'The Postal Code field is required.',
                    'c_address.required' => 'The Address field is required.',
                ]);

                // Get basic details from session
                $basicDetails = session('basic_details');

                // Check if basic details exist in session
                if ($basicDetails) {
                    // Create company record
                    Company::create([
                        'c_name' => $basicDetails['c_name'],
                        'c_email' => $basicDetails['c_email'],
                        'c_password' => Hash::make($basicDetails['c_password']),
                        'c_industry' => $request->c_industry,
                        'c_size' => $request->c_size,
                        'c_established_year' => $request->c_established_year,
                        'c_type' => $request->c_type,
                        'c_city' => $request->c_city,
                        'c_country' => $request->c_country,
                        'c_postal_code' => $request->c_postal_code,
                        'c_website' => $request->c_website,
                        'c_address' => $request->c_address,
                    ]);

                    // Clear all session data
                    session()->forget(['basic_details', 'basic_details_completed', 'show_company_details']);

                    return redirect()->route('company.login')->with('success', 'Company registered successfully..!!');
                } else {
                    // If session data is missing, return with an error
                    return redirect()->back()
                        ->withErrors(['error' => 'Registration failed. Please try again.'])
                        ->withInput();
                }
            }
        }

        /**
         * Reset registration process
         */
        public function resetRegistration()
        {
            session()->forget(['basic_details', 'basic_details_completed']);
            return redirect()->route('company.register');
        }

        // for company login process
        public function companyAuthenticate(Request $request)
        {
            // Validate Input Fields
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:8',
            ]);

            // If validation fails, redirect back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Attempt to login using Laravel Auth
            if (Auth::guard('company')->attempt(['c_email' => $request->email, 'password' => $request->password])) {
                $company = Auth::guard('company')->user();
                session(['logged_in_company' => $company->id]);
            
                return redirect()->route('company.dashboard')->with('success', 'Login Successfully..!!');
            } else {
                // Check if email exists in the company database
                $company = Company::where('c_email', $request->email)->first();

                if (!$company) {
                    return redirect()->back()
                        ->with('error', 'The email address is not registered.')
                        ->withInput();
                } else {
                    return redirect()->back()
                        ->with('error', 'Invalid email or password.')
                        ->withInput();
                }
            }
        }

        //show company dashboard menu

        public function showDashboard()
        {
            $companyId = Auth::guard('company')->id();
            
            // Get active jobs count
            $activeJobsCount = Jobs::where('company_id', $companyId)
                                ->where('status', 1)
                                ->count();
            
            // Get total applications count
            $totalApplicationsCount = JobApplication::whereHas('job', function($query) use ($companyId) {
                                        $query->where('company_id', $companyId);
                                    })->count();
            
            // Get recent job postings (last 3)
            $recentJobs = Jobs::where('company_id', $companyId)
                            ->orderBy('created_at', 'desc')
                            ->take(3)
                            ->get();
            
            // Get recent applications (last 3 with user details)
            $recentApplications = JobApplication::with(['job', 'user'])
                                                ->whereHas('job', function($query) use ($companyId) {
                                                    $query->where('company_id', $companyId);
                                                })
                                                ->orderBy('created_at', 'desc')
                                                ->take(3)
                                                ->get();
            
                    $followersCount = DB::table('company_followers')
                                        ->where('company_id', $companyId)
                                        ->count();

            // Get recent activities based on jobs and applications (last 3)
            $recentActivities = collect();
            
            // Add recent job postings to activities
            $recentJobActivities = Jobs::where('company_id', $companyId)
                                    ->orderBy('created_at', 'desc')
                                    ->take(3)
                                    ->get()
                                    ->map(function($job) {
                                        return [
                                            'type' => 'job_posted',
                                            'title' => 'New Job Posted',
                                            'description' => $job->title . ' position created',
                                            'time' => $job->created_at,
                                            'icon' => 'fas fa-plus-circle'
                                        ];
                                    });
            
            // Add recent application status changes to activities
            $recentApplicationActivities = JobApplication::with(['job', 'user'])
                                                        ->whereHas('job', function($query) use ($companyId) {
                                                            $query->where('company_id', $companyId);
                                                        })
                                                        ->orderBy('updated_at', 'desc')
                                                        ->take(3)
                                                        ->get()
                                                        ->map(function($application) {
                                                            return [
                                                                'type' => 'application_' . $application->status,
                                                                'title' => 'Application ' . ucfirst($application->status),
                                                                'description' => 'Candidate ' . $application->user->name . ' for ' . $application->job->title . ' role',
                                                                'time' => $application->updated_at,
                                                                'icon' => 'fas fa-user-check'
                                                            ];
                                                        });
            
            // Merge activities and sort by time
            $recentActivities = $recentJobActivities->concat($recentApplicationActivities)
                                                    ->sortByDesc('time')
                                                    ->take(3);
            
            return view('company.panel.dashboard', compact(
                'activeJobsCount',
                'totalApplicationsCount',
                'followersCount',
                'recentJobs',
                'recentApplications',
                'recentActivities'
            ));
        }

        // show company jobs menu
        public function showJobs()
        {
            $companyId = Auth::guard('company')->id();

            // Fetch jobs
            $jobs = Jobs::with('jobType','category', 'applicants_count')
                        ->where('company_id', $companyId)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(5);

            // Debugging: Dump & Die
            // dd($companyId, $jobs->toArray()); 
            // dd(Auth::guard('company')->user());
            // dd($jobs);
            return view('company.panel.jobs', compact('jobs'));
        }

        // jobs status changed
        public function reopenJob($jobId)
        {
            $job = Jobs::findOrFail($jobId);
            
            // Ensure the job is not already active
            if ($job->status !== 1) {
                $job->status = 1; // Set status to Active
                $job->save();
                
                return redirect()->route('company.jobs')->with('success', 'Job Reopened successfully..!!');
            }
            
            return redirect()->route('company.jobs')->with('error', 'Job is already active.');
        }

        public function closeJob($jobId)
        {
            $job = Jobs::findOrFail($jobId);
            
            // Ensure the job is not already closed
            if ($job->status !== 0) {
                $job->status = 0; // Set status to Closed
                $job->save();
                
                return redirect()->route('company.jobs')->with('success', 'Job closed successfully..!!');
            }
            
            return redirect()->route('company.jobs')->with('error', 'Job is already closed.');
        }

        
        // open a post jobs for company
        public function postJob(Request $request, $id = null)
        {
            $categories = Category::orderBy('category_name','ASC')->where('status',1)->get();
            $jobTypes = JobType::orderBy('type_name','ASC')->where('status',1)->get();
            
            $job = null;
            if ($id) {
                $job = Jobs::findOrFail($id);
                // Check if the job belongs to the logged-in company
                if ($job->company_id != Auth::guard('company')->id()) {
                    return redirect()->route('company.jobs')
                    ->with('error', 'You are not authorized to edit this job.');
                }
            }
            
            return view('company.panel.postJob', [
                'categories' => $categories,
                'jobtypes' => $jobTypes,
                'job' => $job,
                'isEdit' => !is_null($job)
            ]);
        }


        
        
        // post job by company
        public function savePostJob(Request $request)
        {
            if (!Auth::guard('company')->check()) {
                return redirect()->route('company.login')
                ->with('error', 'Please login to post a job');
            }
            // Validate the Request Data
            $validator = Validator::make($request->all(), [
                'title' => 'required|string|min:5|max:200',
                'job_category' => 'required',
                'job_type' => 'required',
                'vacancy' => 'required|integer',
                'location' => 'required|string|max:255',
                'required_skills' => 'required',
                'description' => 'required',
                'company_name' => 'required|min:3|max:255',
                'company_location' => 'required|string|max:80',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $companyId = Auth::guard('company')->id();
            // dd($companyId);
            if (!$companyId) {
                return redirect()->back()
                ->with('error', 'Unable to identify company. Please try logging in again.')
                ->withInput();
            }
            
            // Process data to capitalize fields before saving
            $postJob = Jobs::create([
                'title' => Str::headline($request->title),
                'job_category_id' => $request->job_category,
                'job_type_id' => $request->job_type,
                'user_id' => null,
                'company_id' => $companyId,
                'vacancy' => $request->vacancy,
                'salary' => $request->salary,
                'location' => Str::headline($request->location),
                'description' => Str::ucfirst($request->description),
                'responsibility' => Str::ucfirst($request->responsibility),
                'qualifications' => Str::ucfirst($request->qualifications),
                'benefits' => Str::ucfirst($request->benefits),
                'experience' => Str::ucfirst($request->experience),
                'required_skills' => Str::ucfirst($request->required_skills),
                'keywords' => Str::headline($request->keywords),
                'company_name' => Str::headline($request->company_name),
                'company_location' => $request->company_location 
                ? Str::headline($request->company_location) 
                : null,
                'company_industry' => Str::headline($request->company_industry),
                'company_website' => strtolower($request->company_website), 
            ]);
            
            if ($postJob) {
                return redirect()->route('company.jobs')->with('success', 'Job posted successfully..!!');
            } else {
                return redirect()->back()->with('error', 'An error occurred while posting the job. Please try again.');
            }
        }
        
        
        // update post jobs
        public function updateJob(Request $request, $id)
        {
            if (!Auth::guard('company')->check()) {
                return redirect()->route('company.login')
                    ->with('error', 'Please login to update a job');
            }

            $job = Jobs::findOrFail($id);
            
            // Check if the job belongs to the logged-in company
            if ($job->company_id != Auth::guard('company')->id()) {
                return redirect()->route('company.jobs')
                    ->with('error', 'You are not authorized to update this job.');
                }
                
                // Validate the Request Data
                $validator = Validator::make($request->all(), [
                    'title' => 'required|string|min:5|max:200',
                    'job_category' => 'required',
                    'job_type' => 'required',
                    'vacancy' => 'required|integer',
                    'location' => 'required|string|max:255',
                    'required_skills' => 'required',
                    'description' => 'required',
                    'company_name' => 'required|min:3|max:255',
                    'company_location' => 'required|string|max:80',
                ]);
                
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                
                // Update job data
                $job->update([
                    'title' => Str::headline($request->title),
                    'job_category_id' => $request->job_category,
                'job_type_id' => $request->job_type,
                'vacancy' => $request->vacancy,
                'salary' => $request->salary,
                'location' => Str::headline($request->location),
                'description' => Str::ucfirst($request->description),
                'responsibility' => Str::ucfirst($request->responsibility),
                'qualifications' => Str::ucfirst($request->qualifications),
                'benefits' => Str::ucfirst($request->benefits),
                'experience' => Str::ucfirst($request->experience),
                'required_skills' => Str::ucfirst($request->required_skills),
                'keywords' => Str::headline($request->keywords),
                'company_name' => Str::headline($request->company_name),
                'company_location' => $request->company_location 
                ? Str::headline($request->company_location) 
                : null,
                'company_industry' => Str::headline($request->company_industry),
                'company_website' => strtolower($request->company_website),
            ]);
            
            return redirect()->route('company.jobs')
            ->with('success', 'Job updated successfully..!!');
        }

        // view particular jobs details
        public function viewJobDetail($id)
        {
            if (!Auth::guard('company')->check()) {
                return redirect()->route('company.login')
                ->with('error', 'Please login to view job details');
            }
            
            // Find the job with related data
            $job = Jobs::with(['jobType', 'category', 'applicants_count'])
            ->where('id', $id)
            ->where('company_id', Auth::guard('company')->id())
            ->firstOrFail();
            
            // Split the data into arrays based on periods (".")
            $benefits = $this->splitIntoListItems($job->benefits);
            $responsibilities = $this->splitIntoListItems($job->responsibility);
            $qualifications = $this->splitIntoListItems($job->qualifications);
            
            
            return view('company.panel.companyViewJobDetail', compact(
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
            
            // Split by period followed by space or newline, or just by newline
            $lines = preg_split('/(\.\s+|\.\n|\n)/', $text);
            
            // Clean up whitespace, remove empty items, and add period back if it was removed
            $result = [];
            foreach ($lines as $line) {
                $line = trim($line);
                if (!empty($line)) {
                    // Don't add period for items that already end with a period
                    if (!str_ends_with($line, '.')) {
                        $line .= '.';
                    }
                    $result[] = $line;
                }
            }
            
            return $result;
        }
        
        
        // delete post job
        public function deletePostJob($id)
        {
            $job = Jobs::findOrFail($id); 
            $job->delete();
            
            return redirect()->route('company.jobs')->with('success', 'Job deleted successfully..!!');
        }
        
        //show company applications menu
        public function showApplications(Request $request)
        {
            // Ensure the company is logged in
            $companyId = Auth::guard('company')->id();
            if (!$companyId) {
                return redirect()->route('company.login')->with('error', 'Please log in to view job applications.');
            }

            // Get filter parameters
            $jobTitle = $request->input('job_title', 'all');
            $status = $request->input('status', 'all');

            // Start with a base query for the logged-in company
            $query = Jobs::with('applicants_count','category')
                        ->where('company_id', $companyId); // Filter by logged-in company ID

            // Apply job title filter
            if ($jobTitle !== 'all') {
                $query->where('title', $jobTitle);
            }

            // Apply status filter
            if ($status !== 'all') {
                $query->where('status', $status === 'active' ? 1 : 0);
            }

            // Get all unique job titles for the filter dropdown (for this specific company)
            $jobTitles = Jobs::where('company_id', $companyId)->distinct()->pluck('title');

            // Define possible statuses
            $statuses = ['Active', 'Closed'];

            // Execute the query with pagination
            $jobs = $query->orderBy('created_at', 'desc')
                        ->paginate(5)
                        ->withQueryString(); // Preserve filter parameters in pagination links

            return view('company.panel.applications', compact('jobs', 'jobTitles', 'statuses'));
        }

        
        // show all applications for particular job
        public function viewApplications($jobId)
        {
            $job = Jobs::findOrFail($jobId);
            $applicants = $job->applicants_count()
                                ->with(['user', 'user.details'])
                                ->paginate(10);
            
            return view('company.panel.viewApplications', compact('job', 'applicants'));
        }

        // show applicants user profile
        public function viewUserProfile($userId)
        {
            $user = User::findOrFail($userId);
            $userDetail = UserDetail::where('user_id', $userId)->first();
            
            return view('company.panel.viewUserProfile', compact('user', 'userDetail'));
        }

        // update applications status
        public function updateStatus(Request $request, $id)
        {
            $applicant = JobApplication::findOrFail($id);
            $newStatus = $request->status;

            if ($applicant->status === $newStatus) {
                return redirect()->back()->with('error', "Application is already {$newStatus}.");
            }

            $applicant->status = $newStatus;
            $applicant->save();

            return redirect()->back()->with('success', "Application status updated to {$newStatus}.");
        }

        // logout
        public function companyLogout(Request $request)
        {
            // Clear company specific session data
            session()->forget('logged_in_company');
            
            // Logout the company user
            Auth::guard('company')->logout();
            
            // Invalidate the session
            $request->session()->invalidate();
            
            // Regenerate the session token
            $request->session()->regenerateToken();
            
            return redirect()->route('company.login')
            ->with('success', 'Company Logout successfully.!!');
        }
    }
    
    