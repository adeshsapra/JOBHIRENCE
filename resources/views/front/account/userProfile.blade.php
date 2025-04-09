@extends('front.layouts.app')

@section('main')
<div class="acc-user-profile-container">
    <!-- Profile Header Section -->
    <div class="acc-user-header">
        <div class="acc-header-left-section">
            <div class="acc-profile-image-container">
                <img src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('assets/photos/default_icon.png') }}" alt="Profile Picture" class="acc-profile-img">
            </div>
            <div class="acc-profile-info-data">
                <h2 class="acc-user-fullname">{{ Auth::user()->fullName }}</h2>
                <p class="acc-user-title">{{ Auth::user()->designation }}</p>
            </div>
        </div>
        <div class="acc-profile-edit-section">
            <a href="{{ route('account.userEditProfile') }}">
                <button class="acc-profile-edit-button">Edit Profile</button>
            </a>
        </div>
    </div>

    <!-- Profile Details Section -->
    <div class="acc-profile-info-container">
        <!-- Profile Information Section -->
        <div class="acc-info-card acc-profile-data-card">
            <h3 class="acc-data-card-title">Profile Information</h3>
            <ul class="acc-user-details-list">
                <li><strong>Full Name: </strong> {{ Auth::user()->fullName }}</li>
                <li><strong>Email: </strong> {{ Auth::user()->email }}</li>
                <li><strong>Designation: </strong> {{ Auth::user()->designation }}</li>
                <li><strong>Mobile: </strong> {{ Auth::user()->mobile_number }}</li>
                <li><strong>Bio: </strong>{{ Auth::user()->bio }}</li>
            </ul>
        </div>

        <!-- Education Section -->
        <div class="acc-info-card acc-education-data-card">
            <h3 class="acc-data-card-title">Education</h3>
            <ul class="acc-education-details-list">
                <li><strong>Degree :</strong> {{ $userDetail->degree ?? 'Not Provided'}}</li>
                <li><strong>University: </strong> {{ $userDetail->university ?? 'Not Provided'}}</li>
                <li><strong>Graduation Year: </strong> {{ $userDetail->graduation_year ?? 'Not Provided' }}</li>
            </ul>
        </div>

        <!-- Location Section -->
        <div class="acc-info-card acc-location-data-card">
            <h3 class="acc-data-card-title">Location</h3>
            <p class="acc-location-text">{{ $userDetail->city ?? 'Not Provided'}}, <span>{{ $userDetail->state ?? 'Not Provided'}}</span></p>
        </div>

        <!-- Skills Section -->
        <div class="acc-info-card acc-skills-data-card">
            <h3 class="acc-data-card-title">Skills</h3>
            <ul class="acc-skills-details-list">
                {{ $userDetail->skills ?? 'Not Provided'}}
            </ul>
        </div>

        <!-- Show Resume Section -->
        <div class="acc-info-card acc-resume-data-card">
            <h3 class="acc-data-card-title">Resume</h3>
            <p class="acc-resume-text">
                View or download my latest resume to get a detailed overview of my experience and projects.
            </p>
            @if($userDetail && $userDetail->resume)
                <p class="display-resume">File: {{ $userDetail->resume }}</p>
                <div class="acc-resume-actions">
                    <!-- View Resume -->
                    <a href="{{ route('resume.view') }}" target="_blank">
                        <button class="acc-resume-download-button">View Resume</button>
                    </a>
                    <!-- Download Resume -->
                    <a href="{{ route('resume.download') }}">
                        <button class="acc-resume-download-button">Download Resume</button>
                    </a>
                </div>
            @else
                <p class="display-resume">No resume uploaded</p>
            @endif
        </div>
    </div>
</div>
@endsection

@section('customCss')
@endsection