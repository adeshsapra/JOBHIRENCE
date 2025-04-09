@extends('front.layouts.app')

@section('main')

<div class="job-details-container">
    
    @include('front.backBreadCrumb')
    
    @include('front.alertMessage')

    <div class="job-details-header">
        <div>
            <h1>{{ $job->title }}</h1>
            <div class="job-details-meta">
                <i class="fas fa-calendar-alt"></i> Published on: {{ $job->created_at->format('d M, Y') }} |
                <i class="fas fa-users"></i> <span>{{ $job->applicants_count->count() }}</span> Applicants |
                <i class="fas fa-map-marker-alt"></i> {{ $job->location }} 
            </div>
        </div>
        @if (Auth::check())
            <form action="{{ route('jobSaved', $job->id) }}" method="POST" class="like-form">
                @csrf
                <button class="like-button {{ $isSaved ? 'saved' : '' }}" aria-label="Like"><i class="fas fa-heart"></i></button>
            </form>
        @else
            <button class="like-button" id="like-btn" aria-label="Like"><i class="fas fa-heart"></i></button>
        @endif
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
                    <a href="{{ $job->company_website }}" target="_blank">
                        {{ $job->company_website }}
                    </a>
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

    <div class="job-details-actions">
        @if (Auth::check())
            <form action="{{ route('jobSaved', $job->id) }}" method="POST">
                @csrf
                <div class="after-logged-in">
                    <button class="job-details-save-button">Save</button>
                </div>
            </form>
        @else
            <button id="save-btn" class="job-details-save-button">Save</button>
        @endif

        @if (Auth::check())
            <form action="{{ route('jobApply', $job->id) }}" method="POST">
                @csrf
                <div class="after-logged-in">
                    <button type="submit" class="job-details-apply-button">Apply Now</button>
                </div>
            </form>
        @else
            <button id="apply-btn" class="job-details-apply-button">Apply Now</button>
        @endif
    </div>
</div>

<!-- Popup Toast Message -->
<div id="popup-toast" class="popup-toast">
    <!-- Icon on the left -->
    <div class="popup-icon">
        <i class="fas fa-info-circle"></i><span>Please log in to apply for this job.</span>
    </div>
</div>
@endsection

@section('customJs')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const applyButton = document.getElementById('apply-btn');
        const saveButton = document.getElementById('save-btn');
        const likeButton = document.getElementById('like-btn');
        const popupToast = document.getElementById('popup-toast');
        const popupMessage = popupToast.querySelector('span'); // Select the message element inside the popup

        const showToastMessage = (message) => {
            popupMessage.textContent = message; // Update the popup message
            popupToast.classList.add('show'); // Show the popup

            // Automatically hide the popup after 3 seconds
            setTimeout(() => {
                popupToast.classList.remove('show');
                popupToast.classList.add('hide');

                // Reset the animation after closing
                setTimeout(() => {
                    popupToast.classList.remove('hide');
                }, 500); // Matching animation duration
            }, 3000); // Display for 3 seconds
        };

        const handleButtonClick = (message) => {
            // Check if the user is logged in or not
            if (!{{ Auth::check() ? 'true' : 'false' }}) {
                showToastMessage(message);
            }
        };

        // Add event listeners to buttons
        if (applyButton) {
            applyButton.addEventListener('click', () => handleButtonClick('Please log in to apply for this job.'));
        }

        if (saveButton) {
            saveButton.addEventListener('click', () => handleButtonClick('Please log in to save this job.'));
        }
        
        if (likeButton) {
            likeButton.addEventListener('click', () => handleButtonClick('Please log in to save this job.'));
        }
    });
</script>
@endsection



