@extends('company.layouts.app')

@section('main')
<div class="premium-user-profile-container">
    @include('front.backBreadCrumb')
    <!-- Profile Header Section -->
    <div class="premium-user-header">
        <div class="premium-header-left-section">
            <div class="premium-profile-image-container">
                <!-- Use user's profile image or a default image -->
                <img src="{{ $user->image ? asset($user->image) : asset('assets/photos/default_icon.png') }}" alt="Profile Picture" class="premium-profile-img">
            </div>
            <div class="premium-profile-info-data">
                <!-- Display user's name and title -->
                <h2 class="premium-user-fullname">{{ $user->fullName }}</h2>
                <p class="premium-user-title">{{ $user->designation ?? 'No designation provided' }}</p>
            </div>
        </div>
    </div>

    <!-- Profile Details Section -->
    <div class="premium-profile-info-container">
        <!-- Profile Information Section -->
        <div class="premium-info-card premium-profile-data-card">
            <h3 class="premium-data-card-title">Profile Information</h3>
            <ul class="premium-user-details-list">
                <li><strong>Full Name:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Designation:</strong> {{ $user->designation ?? 'Not available' }}</li>
                <li><strong>Mobile:</strong> {{ $userDetail->mobile ?? 'Not available' }}</li>
                <li><strong>Bio:</strong> {{ $userDetail->bio ?? 'No bio provided' }}</li>
            </ul>
        </div>

        <!-- Education Section -->
        <div class="premium-info-card premium-education-data-card">
            <h3 class="premium-data-card-title">Education</h3>
            <ul class="premium-education-details-list">
                <li><strong>Degree:</strong> {{ $userDetail->degree ?? 'Not available' }}</li>
                <li><strong>University:</strong> {{ $userDetail->university ?? 'Not available' }}</li>
                <li><strong>Graduation Year:</strong> {{ $userDetail->graduation_year ?? 'Not available' }}</li>
            </ul>
        </div>

        <!-- Location Section -->
        <div class="premium-info-card premium-location-data-card">
            <h3 class="premium-data-card-title">Location</h3>
            <p class="premium-location-text">
                {{ $userDetail->location ?? 'Location not provided' }}
            </p>
        </div>

        <!-- Skills Section -->
        @if($userDetail && $userDetail->skills)
        <div class="premium-info-card premium-skills-data-card">
            <h3 class="premium-data-card-title">Skills</h3>
            <ul class="premium-skills-details-list">
                {{ $userDetail->skills ?? 'Not Provided'}}
            </ul>
        </div>
        @else
        <div class="premium-info-card premium-skills-data-card">
            <h3 class="premium-data-card-title">Skills</h3>
            <p>No skills provided.</p>
        </div>
        @endif

        <!-- Resume Section -->
        @if($userDetail && $userDetail->resume)
        <div class="premium-info-card premium-resume-data-card">
            <h3 class="premium-data-card-title">Resume</h3>
            <p class="premium-resume-text">
                View or download my latest resume for an overview of my experience and projects.
            </p>
            <p class="premium-display-resume">
                File: {{ $userDetail->resume }}
            </p>
            <div class="premium-resume-actions">
                <a href="{{ route('resume.view') }}" target="_blank">
                    <button class="premium-resume-button">View Resume</button>
                </a>
                <a href="{{ route('resume.download') }}">
                    <button class="premium-resume-button">Download Resume</button>
                </a>
            </div>
        </div>
        @else
        <div class="premium-info-card premium-resume-data-card">
            <h3 class="premium-data-card-title">Resume</h3>
            <p>No resume uploaded.</p>
        </div>
        @endif
    </div>
</div>
@endsection


@section('customCss')
@endsection
