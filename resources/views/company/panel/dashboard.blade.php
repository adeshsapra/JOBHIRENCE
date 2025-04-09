@extends('company.layouts.app')

@section('main')
<div class="company-panel-content">
    <div class="dashboard-header">
        <div class="dashboard-header-left">
            <h1>Dashboard Overview</h1>
            <p>Monitor your recruitment activities and performance</p>
        </div>
        <div class="dashboard-header-right">
            <div class="dashboard-date">
                <i class="fas fa-calendar"></i>
                <span>{{ date('F d, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="quick-stats">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $activeJobsCount }}</h3>
                <p>Active Jobs</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalApplicationsCount }}</h3>
                <p>Total Applications</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $followersCount }}</h3>
                <p>Total Followers</p>
            </div>
        </div>
    </div>

    <div class="dashboard-grid">
        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2>Recent Job Postings</h2>
                <a href="{{ route('company.jobs') }}" class="view-all">View All</a>
            </div>
            <div class="job-list">
                @forelse($recentJobs as $job)
                <div class="job-item">
                    <div>
                        <h4>{{ $job->title }}</h4>
                        <p>Posted {{ $job->created_at->diffForHumans() }}</p>
                    </div>
                    <span class="status-badge status-{{ $job->status ? 'active' : 'closed' }}">
                        {{ $job->status ? 'Active' : 'Closed' }}
                    </span>
                </div>
                @empty
                <div class="job-item">
                    <p>No recent job postings</p>
                </div>
                @endforelse
            </div>
        </div>

        <div class="dashboard-card">
            <div class="dashboard-card-header">
                <h2>Recent Applications</h2>
                <a href="{{ route('company.applications') }}" class="view-all">View All</a>
            </div>
            <div class="application-list">
                @forelse($recentApplications as $application)
                <div class="application-item">
                    <div>
                        <h4>{{ $application->user->name }}</h4>
                        <p>{{ $application->job->title }}</p>
                    </div>
                    <span class="status-badge status-{{ $application->status === 'pending' ? 'pending' : ($application->status === 'reviewing' ? 'active' : 'closed') }}">
                        {{ ucfirst($application->status) }}
                    </span>
                </div>
                @empty
                <div class="application-item">
                    <p>No recent applications</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <h2>Recent Activity</h2>
        </div>
        <div class="activity-list">
            @forelse($recentActivities as $activity)
            <div class="activity-item">
                <div class="activity-icon">
                    <i class="{{ $activity['icon'] }}"></i>
                </div>
                <div class="activity-content">
                    <h4>{{ $activity['title'] }}</h4>
                    <p>{{ $activity['description'] }}</p>
                    <small>{{ \Carbon\Carbon::parse($activity['time'])->diffForHumans() }}</small>
                </div>
            </div>
            @empty
            <div class="activity-item">
                <p>No recent activity</p>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection