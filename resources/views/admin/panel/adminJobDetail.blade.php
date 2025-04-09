@extends('admin.layouts.app')

@section('main')
    
<div class="job-details-container">
        @include('front.backBreadCrumb')
        
        <div class="job-details-header">
            <div>
                <h1>{{ $job->title }}</h1>
                <div class="job-details-meta">
                    <i class="fas fa-calendar-alt"></i> Published on: {{ $job->created_at->format('d M, Y') }} |
                    <i class="fas fa-users"></i> <span>{{ $job->applicants_count->count() ?? 0 }}</span> Applicants |
                    <i class="fas fa-map-marker-alt"></i> {{ $job->location ?? 'N/A'}}
                </div>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between;">
            <div class="job-details-summary-container">
                <h3>Job Summary</h3>
                <ul>
                    <li><i class="fas fa-clock"></i> Job Type: {{ $job->jobType->type_name }} </li>
                    <li><i class="fas fa-user"></i> Vacancy: {{ $job->vacancy }}</li>
                    <li><i class="fas fa-briefcase"></i> Experience: {{ $job->experience ?? 'Not Specified' }}</li>
                    <li><i class="fa-solid fa-indian-rupee-sign"></i> Salary: {{ $job->salary ?? 'Not Specified' }}</li>
                </ul>
            </div>
            
            <div class="job-details-company">
                <h3>Company Details</h3>
                <ul>
                    <li><i class="fas fa-building"></i> Name: {{ $job->company_name }}</li>
                    <li><i class="fas fa-map-marker-alt"></i> Location: {{ $job->company_location }}</li>
                    <li><i class="fas fa-industry"></i> Industry: {{ $job->company_industry ?? 'Not Specified' }}</li>
                    <li><i class="fas fa-globe"></i> Website: 
                        @if($job->company_website)
                            <a href="{{ $job->company_website }}" target="_blank">
                                {{ $job->company_website }}
                            </a>
                        @else
                            Not Specified
                        @endif
                    </li>
                </ul>
            </div>
        </div>

        <div class="job-details-section">
            <h2>Required Skills</h2>
            <p>{{ $job->required_skills ?? 'Not Specified' }}</p>
        </div>

        <div class="job-details-section">
            <h2>Job Description</h2>
            <p>{{ $job->description }}</p>
        </div>

        <div class="job-details-section">
            <h2>Responsibilities</h2>
            <ul>
                @forelse ($responsibilities as $responsibility)
                    <li><i class="fas fa-check-circle"></i> {{ $responsibility }}</li>
                @empty
                    <li>No responsibilities specified.</li>
                @endforelse
            </ul>
        </div>
        
        <div class="job-details-section">
            <h2>Qualifications</h2>
            <ul>
                @forelse ($qualifications as $qualification)
                    <li><i class="fas fa-check-circle"></i> {{ $qualification }}</li>
                @empty
                    <li>No qualifications specified.</li>
                @endforelse
            </ul>
        </div>
        
        <div class="job-details-section">
            <h2>Benefits</h2>
            <ul>
                @forelse ($benefits as $benefit)
                    <li><i class="fas fa-check-circle"></i> {{ $benefit }}</li>
                @empty
                    <li>No benefits specified.</li>
                @endforelse
            </ul>
        </div>
    
    </div>
</div>
@endsection