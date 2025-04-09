@extends('front.layouts.app')

@section('main')

<div class="post-job-container">
    
    @include('front.alertmessage')

    <h1 class="post-job-title">Edit Your Job</h1>
    <form class="post-job-form" method="POST" action="{{ route('account.updateJob', $job->id) }}">
        @csrf

        <div class="post-job-section">
            <h2>Job Details</h2>
            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Job Title" 
                        class="{{ $errors->has('title') ? 'error-border' : '' }}" 
                        value="{{ old('title', $job->title) }}">
                    @error('title')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="category-type">Category <span style="color: red;">*</span></label>
                    <select id="category-type" name="job_category" 
                        class="{{ $errors->has('job_category') ? 'error-border' : '' }}">
                        <option value="">Select Category Type</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" 
                                {{ old('job_category', $job->job_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('job_category')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="job-type">Job Type <span style="color: red;">*</span></label>
                    <select id="job-type" name="job_type" 
                        class="{{ $errors->has('job_type') ? 'error-border' : '' }}">
                        <option value="">Select Job Type</option>
                        @foreach ($jobtypes as $jobtype)
                            <option value="{{ $jobtype->id }}" 
                                {{ old('job_type', $job->job_type_id) == $jobtype->id ? 'selected' : '' }}>
                                {{ $jobtype->type_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('job_type')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="vacancy">Vacancy <span style="color: red;">*</span></label>
                    <input type="number" id="vacancy" name="vacancy" placeholder="Vacancy" 
                        class="{{ $errors->has('vacancy') ? 'error-border' : '' }}" 
                        value="{{ old('vacancy', $job->vacancy) }}">
                    @error('vacancy')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="salary">Salary</label>
                    <input type="text" id="salary" name="salary" placeholder="Enter Annual Salary Package" 
                        class="{{ $errors->has('salary') ? 'error-border' : '' }}" 
                        value="{{ old('salary', $job->salary) }}">
                    @error('salary')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="location">Location <span style="color: red;">*</span></label>
                    <input type="text" id="location" name="location" placeholder="Location" 
                        class="{{ $errors->has('location') ? 'error-border' : '' }}" 
                        value="{{ old('location', $job->location) }}">
                    @error('location')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="required_skills">Required Skills <span style="color: red;">*</span></label>
                    <textarea id="required_skills" name="required_skills" rows="5" placeholder="Enter Required Skills" 
                        class="{{ $errors->has('required_skills') ? 'error-border' : '' }}">{{ old('required_skills', $job->required_skills) }}</textarea>
                    @error('required_skills')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="description">Job Description <span style="color: red;">*</span></label>
                    <textarea id="description" name="description" rows="5" placeholder="Job Description" 
                        class="{{ $errors->has('description') ? 'error-border' : '' }}">{{ old('description', $job->description) }}</textarea>
                    @error('description')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="responsibility">Responsibility</label>
                    <textarea id="responsibility" name="responsibility" rows="5" placeholder="Responsibilities" 
                        class="{{ $errors->has('responsibility') ? 'error-border' : '' }}">{{ old('responsibility', $job->responsibility) }}</textarea>
                    @error('responsibility')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="qualifications">Qualifications</label>
                    <textarea id="qualifications" name="qualifications" rows="5" placeholder="Qualifications" 
                        class="{{ $errors->has('qualifications') ? 'error-border' : '' }}">{{ old('qualifications', $job->qualifications) }}</textarea>
                    @error('qualifications')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="benefits">Benefits</label>
                    <textarea id="benefits" name="benefits" rows="5" placeholder="Benefits" 
                        class="{{ $errors->has('benefits') ? 'error-border' : '' }}">{{ old('benefits', $job->benefits) }}</textarea>
                    @error('benefits')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="experience">Experience</label>
                    <select id="experience" name="experience" 
                        class="{{ $errors->has('experience') ? 'error-border' : '' }}">
                        <option value="">Select Experience</option>
                        <option value="1-2" {{ old('experience', $job->experience) == '1-2' ? 'selected' : '' }}>1-2 years</option>
                        <option value="3-5" {{ old('experience', $job->experience) == '3-5' ? 'selected' : '' }}>3-5 years</option>
                        <option value="5+" {{ old('experience', $job->experience) == '5+' ? 'selected' : '' }}>5+ years</option>
                    </select>
                    @error('experience')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="keywords">Job Keywords</label>
                    <input type="text" id="keywords" name="keywords" placeholder="Enter keywords (e.g., marketing, SEO)"
                        class="{{ $errors->has('keywords') ? 'error-border' : '' }}" 
                        value="{{ old('keywords', $job->keywords) }}">
                    @error('keywords')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="company-name">Company Name <span style="color: red;">*</span></label>
                    <input type="text" id="company-name" name="company_name" placeholder="Company Name" 
                        class="{{ $errors->has('company_name') ? 'error-border' : '' }}" 
                        value="{{ old('company_name', $job->company_name) }}">
                    @error('company_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="company-location">Company Location</label>
                    <input type="text" id="company-location" name="company_location" placeholder="Company Location" 
                        class="{{ $errors->has('company_location') ? 'error-border' : '' }}" 
                        value="{{ old('company_location', $job->company_location) }}">
                    @error('company_location')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="company-industry">Company Industry</label>
                    <input type="text" id="company-industry" name="company_industry" placeholder="Industry" 
                        class="{{ $errors->has('company_industry') ? 'error-border' : '' }}" 
                        value="{{ old('company_industry', $job->company_industry) }}">
                    @error('company_industry')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="company-website">Company Website</label>
                    <input type="text" id="company-website" name="company_website" placeholder="Company Website URL" 
                        class="{{ $errors->has('company_website') ? 'error-border' : '' }}" 
                        value="{{ old('company_website', $job->company_website) }}">
                    @error('company_website')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="post-job-form-group">
            <button type="submit">Save Job</button>
        </div>
    </form>
</div>

@endsection
