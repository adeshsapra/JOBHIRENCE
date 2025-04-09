@extends('front.layouts.app')

@section('main')
<div class="postjob-job-details-container">
   @include('front.backBreadCrumb')

    <div class="postjob-job-details-header">
        <div>
            <h1>{{ $job->title }}</h1>
            <div class="postjob-job-details-meta">
                <i class="fas fa-calendar-alt"></i> Published on: {{ $job->created_at->format('d M, Y') }} |
                <i class="fas fa-users"></i> <span>{{ $job->applicants_count->count() }}</span> Applicants |
                <i class="fas fa-map-marker-alt"></i> {{ $job->location }} 
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between;">
        <div class="postjob-job-details-summary-container">
            <h3>Job Summary</h3>
            <ul>
                <li><i class="fas fa-calendar-alt"></i> Published on : {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</li>
                <li><i class="fas fa-user"></i> Vacancy : {{ $job->vacancy }}</li>
                <li><i class="fa-solid fa-indian-rupee-sign"></i> Salary : {{ $job->salary ?? 'Negotiable' }}</li>
                <li><i class="fas fa-clock"></i> Job Type : {{ $job->jobType->type_name }}</li>
            </ul>
        </div>

        <div class="postjob-job-details-company">
            <h3>Company Details</h3>
            <ul>
                <li><i class="fas fa-building"></i> Name : {{ $job->company_name }}</li>
                <li><i class="fas fa-map-marker-alt"></i> Location : {{ $job->company_location }}</li>
                <li><i class="fas fa-cogs"></i> Industry : {{ $job->company_industry }}</li>
                <li><i class="fas fa-globe"></i> Website : 
                    @if ($job->company_website)
                        <a href="{{ $job->company_website }}" target="_blank">{{ $job->company_website }}</a>
                    @else
                        Not Available
                    @endif
                </li>
            </ul>
        </div>
    </div>

    <!-- required skills Section -->
    <div class="postjob-job-details-section">
        <h2>Required Skills</h2>
        <p>{{ $job->required_skills }}</p>
    </div>

    <!-- Job Description Section -->
    <div class="postjob-job-details-section">
        <h2>Job Description</h2>
        <p>{{ $job->description }}</p>
    </div>

    <div class="postjob-job-details-section-row">

        <!-- Job Responsibilities Section -->
        <div class="postjob-job-details-section">
            <h2>Responsibilities</h2>
            @forelse ($responsibilities as $responsibility)
                <p><i class="fas fa-check-circle"></i> {{ $responsibility }}</p>
            @empty
                <p>No responsibilities specified.</p>
            @endforelse
        </div>

        <!-- Job Qualifications Section -->
        <div class="postjob-job-details-section">
            <h2>Qualifications</h2>
            @forelse ($qualifications as $qualification)
                <p><i class="fas fa-check-circle"></i> {{ $qualification }}</p>
            @empty
                <p>No qualification specified.</p>
            @endforelse
        </div>

        <div class="postjob-job-details-section">
            <h2>Qualifications</h2>
            @forelse ($benefits as $benefit)
                <p><i class="fas fa-check-circle"></i> {{ $benefit }}</p>
            @empty
                <p>No qualification specified.</p>
            @endforelse
        </div>

    </div>
</div>


<!-- New Applicants Container -->
<div class="postjob-applicants-container">
    <div class="postjob-applicants-header">Applicants</div>
    <table class="postjob-applicants-table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Applied Date</th>
                <th>View Profile</th>
            </tr>
        </thead>
        <tbody>
            @if ($applications->isNotEmpty())
                @php $counter = 1; @endphp
                @foreach ($applications as $application)
                    <tr>
                        <td>{{ $counter }}</td>
                        <td>{{ $application->user->fullName }}</td>
                        <td>{{ $application->user->email }}</td>
                        <td>{{ $application->applied_date->format('d M, Y') }}</td>
                        <td>
                            <a href="{{ route('account.viewUserProfile', $application->user->id)  }}" class="postJob-view-profile-btn">
                                View Profile
                        </td>
                    </tr>
                    @php $counter++; @endphp
                @endforeach
            @else
                <tr>
                    <td colspan="6" style="text-align: center;">No applications available.</td>
                </tr>
            @endif
        </tbody>
    </table>
    
    </table>
</div>
@endsection