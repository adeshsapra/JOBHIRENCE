@extends('admin.layouts.app')

@section('main')
<div class="admin-try">
    <h3>JobHirence Administrator</h3>

    @include('front.alertMessage')
    <section class="admin-profile-profile-section">
        <div class="admin-profile-profile-header">
            <img src="{{ $admin->profile_img ? asset('admin_photos/' . $admin->profile_img) : asset('assets/photos/default_icon.png') }}" alt="Admin Profile Picture" class="admin-profile-profile-picture">
            <div class="admin-profile-profile-name">
                <div class="name-row">
                    <h2>{{ $admin->name }}</h2>
                    <a href="{{ route('admin.editProfile') }}" class="edit-profile-btn">Edit Profile</a>
                </div>
                <p class="admin-profile-profile-role">Email: {{ $admin->email }}</p>
            </div>
        </div>
    </section>

    <section class="admin-profile-stats-section">
        <h3>Portal Statistics</h3>
        <div class="admin-profile-stats-grid">
            <div class="admin-profile-stat-item">
                <p class="admin-profile-stat-value">{{ $registeredUsers }}</p>
                <p class="admin-profile-stat-label">Registered Users</p>
            </div>
            <div class="admin-profile-stat-item">
                <p class="admin-profile-stat-value">{{ $registeredCompanies }}</p>
                <p class="admin-profile-stat-label">Registered Companies</p>
            </div>
            <div class="admin-profile-stat-item">
                <p class="admin-profile-stat-value">{{ $activeJobListings }}</p>
                <p class="admin-profile-stat-label">Active Job Listings</p>
            </div>
            <div class="admin-profile-stat-item">
                <p class="admin-profile-stat-value">{{ $totalApplications }}</p>
                <p class="admin-profile-stat-label">Total Applications</p>
            </div>
        </div>
    </section>

    <section class="admin-profile-quick-actions">
        <h3 class="admin-profile-heading">Quick Actions</h3>
        <div class="admin-profile-actions-grid">
            <a href="{{ route('admin.UserManage') }}" class="admin-profile-action-button">View Active Users</a>
            <a href="{{ route('admin.CompanyManage') }}" class="admin-profile-action-button">View Active Companies</a>
            <a href="{{ route('admin.jobManagement') }}" class="admin-profile-action-button">Manage Latest & Trending Job Listings</a>
            <a href="{{ route('admin.CategorySkillManage') }}" class="admin-profile-action-button">Manage Categories - Types & Experience</a>
        </div>
    </section>
</div>
@endsection