@extends('front.layouts.app')

@section('main')

<div class="post-job-container">
        <!-- Include alerts -->
        @include('front.alertmessage')

    <h1 class="post-job-title">Post Job</h1>
    <form class="post-job-form" method="POST" action="{{ route('account.saveJob') }}">
        @csrf

        <div class="post-job-section">
            <h2>Job Details</h2>
            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="title">Title <span style="color: red;">*</span></label>
                    <input type="text" id="title" name="title" placeholder="Job Title" 
                        class="{{ $errors->has('title') ? 'error-border' : '' }}" 
                        value="{{ old('title') }}">
                    @error('title')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="category-type">Category <span style="color: red;">*</span></label>
                    <select id="category-type" name="job_category" 
                        class="{{ $errors->has('job_category_id') ? 'error-border' : '' }}">
                        <option value="">Select Category Type</option>
                        @if ($categories->isNotEmpty())
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" 
                                    {{ old('job_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('job_category_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="job-type">Job Type <span style="color: red;">*</span></label>
                    <select id="job-type" name="job_type" 
                        class="{{ $errors->has('job_type_id') ? 'error-border' : '' }}">
                        <option value="">Select Job Type</option>
                        @if ($jobtypes->isNotEmpty())
                            @foreach ($jobtypes as $jobtype)
                                <option value="{{ $jobtype->id }}" 
                                    {{ old('job_type_id') == $jobtype->id ? 'selected' : '' }}>
                                    {{ $jobtype->type_name }}
                                </option>
                            @endforeach
                        @endif
                    </select>
                    @error('job_type_id')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="vacancy">Vacancy <span style="color: red;">*</span></label>
                    <input type="number" id="vacancy" name="vacancy" placeholder="Vacancy" 
                        class="{{ $errors->has('vacancy') ? 'error-border' : '' }}" 
                        value="{{ old('vacancy') }}">
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
                        value="{{ old('salary') }}">
                    @error('salary')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="location">Location <span style="color: red;">*</span></label>
                    <input type="text" id="location" name="location" placeholder="Location" 
                        class="{{ $errors->has('location') ? 'error-border' : '' }}" 
                        value="{{ old('location') }}">
                    @error('location')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="post-job-section">
            <h2>Required Skills <span style="color: red;">*</span></h2>
            <div class="post-job-form-group">
                <textarea id="required_skills" name="required_skills" placeholder="Enter Required Skills" 
                    class="{{ $errors->has('required_skills') ? 'error-border' : '' }}">{{ old('required_skills') }}</textarea>
                @error('required_skills')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="post-job-section">
            <h2>Description <span style="color: red;">*</span></h2>
            <div class="post-job-form-group">
                <textarea id="description" name="description" placeholder="Job Description" 
                    class="{{ $errors->has('description') ? 'error-border' : '' }}">{{ old('description') }}</textarea>
                @error('description')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="post-job-section">
            <h2>Benefits</h2>
            <div class="post-job-form-group">
                <textarea id="benefits" name="benefits" placeholder="List Benefits">{{ old('benefits') }}</textarea>
            </div>
        </div>

        <div class="post-job-section">
            <h2>Responsibilities</h2>
            <div class="post-job-form-group">
                <textarea id="responsibility" name="responsibility" placeholder="List Responsibilities">{{ old('responsibility') }}</textarea>
            </div>
        </div>

        <div class="post-job-section">
            <h2>Qualifications</h2>
            <div class="post-job-form-group">
                <textarea id="qualifications" name="qualifications" placeholder="List Qualifications">{{ old('qualifications') }}</textarea>
            </div>
        </div>

        <div class="post-job-section">
            <h2>Experience</h2>
            <div class="post-job-form-group">
                <select id="experience" name="experience" 
                        class="{{ $errors->has('id') ? 'error-border' : '' }}">
                        <option value="">Select Experience Level</option>
                        @if ($experiences->isNotEmpty())
                            @foreach ($experiences as $experience)
                                <option value="{{ $experience->id }}" 
                                    {{ old('id') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->experience }} Years
                                </option>
                            @endforeach
                            <option value="no-experience" {{ old('experience') == 'no-experience' ? 'selected' : '' }}>No Experience</option>
                        @endif
                    </select>
                {{-- <select id="experience" name="experience" 
                    class="{{ $errors->has('experience') ? 'error-border' : '' }}">
                    <option value="">Select Experience Level</option>
                    <option value="1-year" {{ old('experience') == '1-year' ? 'selected' : '' }}>0-1 Year</option>
                    <option value="2-years" {{ old('experience') == '2-years' ? 'selected' : '' }}>0-2 Years</option>
                    <option value="3-years" {{ old('experience') == '3-years' ? 'selected' : '' }}>1-3 Years</option>
                    <option value="5-years" {{ old('experience') == '5-years' ? 'selected' : '' }}>2-5 Years</option>
                    <option value="7-years" {{ old('experience') == '7-years' ? 'selected' : '' }}>3-7 Years</option>
                    <option value="10-years" {{ old('experience') == '10-years' ? 'selected' : '' }}>5-10 Years</option>
                    <option value="10+years" {{ old('experience') == '10+years' ? 'selected' : '' }}>10+ Years</option>
                    <option value="no-experience" {{ old('experience') == 'no-experience' ? 'selected' : '' }}>No Experience</option>
                </select> --}}
                @error('experience')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="post-job-section">
            <h2>Keywords</h2>
            <div class="post-job-form-group">
                <input type="text" id="keywords" name="keywords" placeholder="Enter Keywords" 
                    class="{{ $errors->has('keywords') ? 'error-border' : '' }}" 
                    value="{{ old('keywords') }}">
                @error('keywords')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="post-job-section">
            <h2>Company Details</h2>
            <div class="post-job-form-row">
                <div class="post-job-form-group">
                    <label for="company-name">Name <span style="color: red;">*</span></label>
                    <input type="text" id="company-name" name="company_name" placeholder="Company Name" 
                        class="{{ $errors->has('company_name') ? 'error-border' : '' }}" 
                        value="{{ old('company_name') }}">
                    @error('company_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="post-job-form-group">
                    <label for="company-location">Location <span style="color: red;">*</span></label>
                    <input type="text" id="company-location" name="company_location" placeholder="Location" 
                        value="{{ old('company_location') }}">
                </div>
                <div class="post-job-form-group">
                    <label for="industry">Industry </label>
                    <input type="text" id="industry" name="company_industry" placeholder="Company Industry" 
                        class="{{ $errors->has('company_industry') ? 'error-border' : '' }}" 
                        value="{{ old('company_industry') }}">
                    @error('company_industry')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
                <div class="post-job-form-group">
                    <label for="website">Website</label>
                    <input type="url" id="website" name="company_website" placeholder="Company Website" 
                        value="{{ old('company_website') }}">
                </div>
            </div>
        </div>

        <div class="post-job-form-group">
            <button type="submit">Post Job</button>
        </div>
    </form>
</div>

@endsection
