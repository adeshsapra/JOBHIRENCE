@extends('company.layouts.app')

@section('main')
<div class="company-jobs-panel-content">
    <div class="company-jobs-panel-header">
        <h1 class="panel-heading">Post a New Job</h1>
    </div>

    <!-- Job Posting Form -->
    <div class="company-jobs-new-section">
        <form class="company-jobs-new-form" method="POST" action="{{ isset($job) ? route('company.jobs.update', $job->id) : route('company.savePostJob') }}">
            @csrf

            @if(isset($job))
                @method('PUT')
            @endif

            <div class="job-details-section">
                <h3>Job Details</h3>
                <div class="form-row-two-columns">

                    <div class="form-group">
                        <label for="job-title">Job Title <span style="color: red;">*</span></label>
                        <input type="text" id="job-title" name="title" placeholder="Job Title" value="{{ old('title', isset($job) ? $job->title : '') }}"
                        class="@error('title') input-error @enderror">
                        @error('title') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="job-category">Category <span style="color: red;">*</span></label>
                        <select id="job-category" name="job_category" class="{{ $errors->has('job_category') ? 'input-error' : '' }}">
                            <option value="">Select Job Category</option>
                            @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option  value="{{ $category->id }}" 
                                {{ old('job_category', isset($job) ? $job->job_category_id : '') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        @endif
                        </select>
                        @error('job_category') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="job-type">Job Type <span style="color: red;">*</span></label>
                        <select id="job-type" name="job_type" class="{{ $errors->has('job_type') ? 'input-error' : '' }}">
                            <option value="">Select Job Type</option>
                            @if ($jobtypes->isNotEmpty())
                            @foreach ($jobtypes as $jobtype)
                                <option value="{{ $jobtype->id }}" 
                                {{ old('job_type', isset($job) ? $job->job_type_id : '') == $jobtype->id ? 'selected' : '' }}>
                                    {{ $jobtype->type_name }}
                                </option>
                            @endforeach
                        @endif
                        </select>
                        @error('job_type') <span class="error-message">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="vacancy">Vacancy <span style="color: red;">*</span></label>
                        <input type="number" id="vacancy" name="vacancy" placeholder="Vacancy" value="{{ old('vacancy', isset($job) ? $job->vacancy : '') }}"
                            class="{{ $errors->has('vacancy') ? 'input-error' : '' }}">
                        @error('vacancy') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="salary">Salary</label>
                        <input type="text" id="salary" name="salary" placeholder="Salary" value="{{ old('salary', isset($job) ? $job->salary : '') }}">
                    </div>
                    <div class="form-group">
                        <label for="location">Location <span style="color: red;">*</span></label>
                        <input type="text" id="location" name="location" placeholder="Location" value="{{ old('location', isset($job) ? $job->location : '') }}" 
                            class="{{ $errors->has('location') ? 'input-error' : '' }}">
                        @error('location') <span class="error-message">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <h3>Required Skills <span style="color: red;">*</span></h3>
                <textarea id="required_skills" name="required_skills" placeholder="Required Skills" class="@error('required_skills') input-error @enderror">{{ old('required_skills', isset($job) ? $job->required_skills : '') }}</textarea>
                @error('required_skills') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="job-description-section">
                <h3>Job Description <span style="color: red;">*</span></h3>
                <textarea id="job_description" name="description" placeholder="Job Description" class="@error('description') input-error @enderror">{{ old('description', isset($job) ? $job->description : '') }}</textarea>
                @error('description') <span class="error-message">{{ $message }}</span> @enderror
            </div>

            <div class="benefits-section">
                <h3>Benefits</h3>
                <textarea id="benefits" name="benefits" placeholder="List Benefits">{{ old('benefits', isset($job) ? $job->benefits : '') }}</textarea>
            </div>

            <div class="responsibilities-section">
                <h3>Responsibilities</h3>
                <textarea id="responsibilities" name="responsibility" placeholder="List Responsibilities">{{ old('responsibility', isset($job) ? $job->responsibility : '') }}</textarea>
            </div>
    
            <div class="qualifications-section">
                <h3>Qualifications</h3>
                <textarea id="qualifications" name="qualifications" placeholder="List Qualifications">{{ old('qualifications', isset($job) ? $job->qualifications : '') }}</textarea>
            </div>
    
            <div class="experience-section">
                <h3>Experience</h3>
                <div class="form-row-two-columns">
                    <div class="form-group">
                        <label for="experience">Experience Level *</label>
                        <select id="experience" name="experience" 
                            class="{{ $errors->has('experience') ? 'error-border' : '' }}">
                            <option value="">Select Experience Level</option>
                            <option value="1-year" {{ old('experience', isset($job) ? $job->experience : '') == '1-year' ? 'selected' : '' }}>0-1 Year</option>
                            <option value="2-years" {{ old('experience', isset($job) ? $job->experience : '') == '2-years' ? 'selected' : '' }}>0-2 Years</option>
                            <option value="3-years" {{ old('experience', isset($job) ? $job->experience : '') == '3-years' ? 'selected' : '' }}>1-3 Years</option>
                            <option value="5-years" {{ old('experience', isset($job) ? $job->experience : '') == '5-years' ? 'selected' : '' }}>2-5 Years</option>
                            <option value="7-years" {{ old('experience', isset($job) ? $job->experience : '') == '7-years' ? 'selected' : '' }}>3-7 Years</option>
                            <option value="10-years" {{ old('experience', isset($job) ? $job->experience : '') == '10-years' ? 'selected' : '' }}>5-10 Years</option>
                            <option value="10+years" {{ old('experience', isset($job) ? $job->experience : '') == '10+years' ? 'selected' : '' }}>10+ Years</option>
                            <option value="no-experience" {{ old('experience', isset($job) ? $job->experience : '') == 'no-experience' ? 'selected' : '' }}>No Experience</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="keywords">Keywords</label>
                        <input type="text" id="keywords" name="keywords" placeholder="Enter Keywords"  value="{{ old('keywords', isset($job) ? $job->keywords : '') }}">
                    </div>
                </div>
            </div>
    

            <div class="company-details-section">
                <h3>Company Details</h3>
                <div class="form-group">
                    <label for="company-name">Company Name <span style="color: red;">*</span></label>
                    <input type="text" id="company-name" name="company_name" placeholder="Company Name" value="{{ old('company_name', isset($job) ? $job->company_name : '') }}" 
                        class="{{ $errors->has('company_name') ? 'input-error' : '' }}">
                    @error('company_name') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                
                <div class="form-group">
                    <label for="company-location">Location <span style="color: red;">*</span></label>
                    <input type="text" id="company-location" name="company_location" placeholder="Location" 
                        value="{{ old('company_location', isset($job) ? $job->company_location : '') }}" class="{{ $errors->has('company_location') ? 'input-error' : '' }}">
                        @error('company_location') <span class="error-message">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="industry">Industry </label>
                    <input type="text" id="industry" name="company_industry" placeholder="Company Industry" 
                        class="{{ $errors->has('company_industry') ? 'error-border' : '' }}" 
                        value="{{ old('company_industry', isset($job) ? $job->company_industry : '') }}">
                    @error('company_industry')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="company_website" placeholder="Company Website" 
                        value="{{ old('company_website', isset($job) ? $job->company_website : '') }}">
                </div>
            </div>

            <button type="submit">{{ isset($job) ? 'Update Job' : 'Post Job' }}</button>
        </form>
    </div>
</div>


  
@endsection

@section('customCss')
    <style>
    .input-error {
        border: 1px solid red !important;
        outline: none !important;
    }
    .error-message {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
    </style>
@endsection
