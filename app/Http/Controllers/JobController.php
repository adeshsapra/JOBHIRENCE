<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JobApplication;
use App\Models\JobExperience;
use App\Models\Jobs;
use App\Models\JobSaved;
use App\Models\JobType;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str; 


class JobController extends Controller
{
    // show post job file
    public function showPostJob(){

        $categories = Category::orderBy('category_name','ASC')->where('status',1)->get();
        $jobTypes = JobType::orderBy('type_name','ASC')->where('status',1)->get();
        $experiences = JobExperience::orderBy('experience','ASC')->where('status',1)->get();

        return view('front.account.job.postJob',[
            'categories' => $categories,
            'jobtypes' => $jobTypes,
            'experiences' => $experiences
        ]);
    }

    // post job save
    public function saveJob(Request $request)
    {
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
            'company_location' => 'nullable|string|max:80',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userId = Auth::guard('web')->id();
        
        // Process data to capitalize fields before saving
        $postJob = Jobs::create([
            'title' => Str::headline($request->title),
            'job_category_id' => $request->job_category,
            'job_type_id' => $request->job_type,
            'user_id' => $userId,
            'vacancy' => Auth::user()->id,
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
            'company_website' => strtolower($request->company_website), // Optionally, make the URL lowercase
        ]);

        if ($postJob) {
            return redirect()->back()->with([
                'success' => 'Job posted successfully..!!',
                'link' => route('account.showMyJobs'),
                'link_text' => 'View All Jobs',
            ]);
        } else {
            return redirect()->back()->with('error', 'An error occurred while posting the job. Please try again.');
        }
    }


    // show my jobs page
    public function showMyJobs(){

        $jobs = Jobs::with('jobType','applicants_count')
                        ->where('user_id',Auth::user()->id)
                        ->orderBy('created_at','DESC')
                        ->paginate(5);
        // dd($jobs);

        return view('front.account.job.myJobs',[
            'jobs' => $jobs
        ]);
    }

    // Show the edit job form
    public function showEditJob($id)
    {
        $job = Jobs::findOrFail($id);
        $categories = Category::orderBy('category_name', 'ASC')->where('status', 1)->get();
        $jobTypes = JobType::orderBy('type_name', 'ASC')->where('status', 1)->get();

        return view('front.account.job.editJobs', [
            'job' => $job,
            'categories' => $categories,
            'jobtypes' => $jobTypes
        ]);
    }


    // Update the job details
    public function updateJob(Request $request, $id)
    {
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

        // Find the job by ID
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->back()->with('error', 'Job not found.');
        }

        $job->title = Str::headline($request->title);
        $job->job_category_id = $request->job_category;
        $job->job_type_id = $request->job_type;
        $job->vacancy = $request->vacancy;

        if ($request->has('salary') && !empty($request->salary)) {
            $job->salary = $request->salary;
        } else {
            $job->salary = null;
        }

        $job->location = Str::headline($request->location);

        $job->required_skills = Str::ucfirst($request->required_skills);
        $job->description = Str::ucfirst($request->description);
        $job->responsibility = $request->has('responsibility') ? Str::ucfirst($request->responsibility) : null;
        $job->qualifications = $request->has('qualifications') ? Str::ucfirst($request->qualifications) : null;
        $job->benefits = $request->has('benefits') ? Str::ucfirst($request->benefits) : null;

        $job->experience = $request->has('experience') ? Str::ucfirst($request->experience) : null;

        $job->keywords = $request->has('keywords') ? Str::headline($request->keywords) : null;

        $job->company_name = Str::headline($request->company_name);

        $job->company_location = $request->has('company_location') && !empty($request->company_location)
            ? Str::headline($request->company_location)
            : null;

        $job->company_industry = $request->has('company_industry') ? Str::headline($request->company_industry) : null;
        $job->company_website = $request->has('company_website') && !empty($request->company_website)
            ? strtolower($request->company_website)
            : null;

        $updated = $job->save();

        if ($updated) {
            return redirect()->route('account.showMyJobs')->with('success', 'Job updated successfully..!!');
        } else {
            return redirect()->back()->with('error', 'Failed to update job. Please try again.');
        }
    }

    // delete a job
    public function deleteJob($id)
    {
        $job = Jobs::find($id);
    
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found.');
        }
    
        if ($job->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        if ($job->delete()) {
            return redirect()->route('account.showMyJobs')->with('success', 'Job deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the job. Please try again.');
        }
    }
    
    // View a particular job details
    public function viewPostJob($id)
    {
        $job = Jobs::with('jobType', 'category', 'applicants_count')->findOrFail($id);

        if ($job == null) {
            abort(404);
         }
        
        // Split the data into arrays based on periods (".")
        $benefits = $this->splitIntoListItems($job->benefits);
        $responsibilities = $this->splitIntoListItems($job->responsibility);
        $qualifications = $this->splitIntoListItems($job->qualifications);


        // fetch applicants
        $applications = JobApplication::where('job_id', $id)
                                    ->with('user')
                                    ->get();

        return view('front.account.job.viewPostJob', [
            'job' => $job,
            'benefits' => $benefits,
            'responsibilities' => $responsibilities,
            'qualifications' => $qualifications,
            'applications' => $applications
        ]);
    }

    public function job(Request $request)
    {
        // Start building the query
        $query = Jobs::query()->where('status', 1)->with('jobType', 'category');

        // Filter by keywords
        if ($request->has('keywords') && !empty($request->keywords)) {
            $query->where('title', 'like', '%' . $request->keywords . '%');
        }

        // Filter by location
        if ($request->has('location') && !empty($request->location)) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $query->where('job_category_id', $request->category);
        }

        // Filter by job types (multiple job types)
        if ($request->has('job_types') && !empty($request->job_types)) {
            $query->whereIn('job_type_id', $request->job_types);
        }

        // Filter by experience
        if ($request->has('experience') && !empty($request->experience)) {
            $experience = $request->experience;

            if ($experience == '0-1') {
                $query->where('experience', '<=', 1);
            } elseif ($experience == '1-3') {
                $query->whereBetween('experience', [1, 3]);
            } elseif ($experience == '3+') {
                $query->where('experience', '>=', 3);
            }
        }

        $jobs = $query->orderBy('created_at', 'DESC')->paginate(24);

        $categories = Category::where('status', 1)->get();
        $jobTypes = JobType::where('status', 1)->get();

        return view('front.job', [
            'jobs' => $jobs,
            'categories' => $categories,
            'jobTypes' => $jobTypes,
        ]);
    }

    // job details page show and fetch data
    public function viewJobDetail($id)
    {
        $job = Jobs::where(['id' => $id,'status' => 1])
                    ->with('applicants_count')
                    ->findOrFail($id);

        if ($job == null) {
           abort(404);
        }
        // check job is alredy saved
        $isSaved = JobSaved::where('job_id', $job->id)
                        ->where('user_id', Auth::id())
                        ->exists();


        // Split the data into arrays based on periods (".")
        $benefits = $this->splitIntoListItems($job->benefits);
        $responsibilities = $this->splitIntoListItems($job->responsibility);
        $qualifications = $this->splitIntoListItems($job->qualifications);

        return view('front.viewJobDetail', [
            'job' => $job,
            'benefits' => $benefits,
            'responsibilities' => $responsibilities,
            'qualifications' => $qualifications,
            'isSaved' => $isSaved,
        ]);
    }

    private function splitIntoListItems($text)
    {
        // Ensure input is a string and not null
        if (is_null($text) || !is_string($text)) {
            return [];
        }
    
        // Normalize line breaks to handle paragraphs and newlines
        $text = preg_replace('/\r\n|\r|\n/', "\n", $text); // Normalize line endings
    
        // Split text by periods (.) or newlines (\n)
        $lines = preg_split('/(\.|\n)/', $text);
    
        // Clean up whitespace and remove empty lines
        $lines = array_filter(array_map('trim', $lines));
    
        // Add a period to sentences that ended with it
        return array_map(function ($line) {
            return rtrim($line, '.') . '.'; // Ensures each sentence ends with a period
        }, $lines);
    }


    public function applyJob(Request $request, $id)
    {
        // Check if the job exists
        $job = Jobs::find($id);
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found.');
        }

        // Prevent users from applying to their own jobs
        if ($job->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot apply to your own job post.');
        }

        // Check if the user has already applied to this job
        $alreadyApplied = JobApplication::where('job_id', $job->id)
                                        ->where('user_id', Auth::id())
                                        ->exists();

        if ($alreadyApplied) {
            return redirect()->back()->with('error', 'You have already applied for this job.');
        }

        // Always store the user_id who posted the job as the employer_id to satisfy the foreign key constraint
        // Store the company_id separately if the job was posted by a company
        $employerId = $job->user_id;
        $companyId = null;
        
        if (!$employerId) {
            // If no user_id is set but company_id exists, we need to find the user who owns this company
            // or use a default system user ID
            if ($job->company_id) {
                // Option 1: Find the user associated with this company (if such relation exists)
                $company = Company::find($job->company_id);
                if ($company && $company->user_id) {
                    $employerId = $company->user_id;
                    $companyId = $job->company_id;
                } else {
                    // Option 2: Use a default system user ID (create one if needed)
                    // For immediate fix, you could use ID 1 or another admin user ID
                    $employerId = 1; // Use a valid user ID that exists in your users table
                    $companyId = $job->company_id;
                }
            } else {
                return redirect()->back()->with('error', 'Invalid job posting. Missing employer information.');
            }
        }

        // Store the application in the database
        $jobApplication = JobApplication::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'employer_id' => $employerId, // This must be a valid user_id
            'company_id' => $companyId,   // Store company_id separately if applicable
            'applied_date' => now(),
        ]);

        if ($jobApplication) {
            return redirect()->back()->with([
                'success' => 'You have successfully applied for the job!',
                'link' => route('account.appliedJobs'),
                'link_text' => 'View Applied Job',
            ]);
        } else {
            return redirect()->back()->with('error', 'Failed to apply for the job. Please try again.');
        }
    }


    public function viewAppliedJobs()
    {
        $appliedJobs = JobApplication::with(['job', 'job.jobType', 'job.category','job.applicants_count'])
                                    ->where('user_id', Auth::user()->id)
                                    ->orderBy('applied_date', 'DESC')
                                    ->paginate(5);
    
        return view('front.account.job.appliedJobs', [
            'appliedJobs' => $appliedJobs
        ]);
    }
    
    // cancel applied jobs
    public function cancelAppliedJob($id)
    {
        $application = JobApplication::where(['user_id' => Auth::user()->id])->find($id);

        if($application == null){
            return redirect()->back()->with('error', 'Job Application not found.');
        }
    
        if ($application) {
            $application->delete();
            return redirect()->back()->with('success', 'Job application cancelled successfully!');
        } else {
            return redirect()->back()->with('error', 'Job application not found.');
        }
    }
    
    // view saved jobs page
    public function viewSavedJobs(){
        $savedJobs = JobSaved::with(['job', 'job.jobType', 'job.category','job.applicants_count'])
        ->where('user_id', Auth::user()->id)
        ->orderBy('created_at', 'DESC')
        ->paginate(5);

        return view('front.account.job.savedJobs', [
        'savedJobs' => $savedJobs
        ]);
        // return view('front.account.job.savedJobs');
    }

    // job save
    public function jobSaved(Request $request, $id)
    {
        // Check if the job exists
        $job = Jobs::find($id);
        if (!$job) {
            return redirect()->back()->with('error', 'Job not found.');
        }

        // Prevent users from applying to their own jobs
        if ($job->user_id === Auth::id()) {
            return redirect()->back()->with('error', 'You cannot Saved to your own job post.');
        }

        // Check if the user has already applied to this job
        $alredySaved = JobSaved::where('job_id', $job->id)
            ->where('user_id', Auth::id())
            ->exists();

        if ($alredySaved) {
            return redirect()->back()->with('error', 'You have already Saved for this job.');
        }

        // Store the application in the database
        $jobSaved = JobSaved::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
        ]);

        if ($jobSaved) {
            return redirect()->back()->with([
                'success' => 'You have successfully Saved for the job..!!',
                'link' => route('account.savedJobs'), 
                'link_text' => 'View Saved Job', 
            ]);
        } else {
            return redirect()->back()->with('error', 'Failed to apply for the job. Please try again.');
        }
    }

    // removed saved jobs
    public function removeSavedJob($id)
    {
        // Find the saved job by user ID and job ID
        $savedJob = JobSaved::where('user_id', Auth::user()->id)
                            ->where('job_id', $id)
                            ->first();

                            // dd($savedJob);
        if ($savedJob) {
            $savedJob->delete();
            return redirect()->back()->with('success', 'Job removed Successfully from saved list..!!');
        } else {
            return redirect()->back()->with('error', 'Saved job not found.');
        }
    }

}
