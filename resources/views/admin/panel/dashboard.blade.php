@extends('admin.layouts.app')

@section('main')
<section id="admin-dashboard" class="admin-dashboard-section">
    <h2 class="dashboard-title">Dashboard Overview</h2>

    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-briefcase"></i>
            </div>
            <h3 class="stat-number" id="totalJobs" data-value="{{ $activeJobListings }}">0</h3>
            <p class="stat-label">Active Jobs</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <h3 class="stat-number" id="activeUsers" data-value="{{ $registeredUsers }}">0</h3>
            <p class="stat-label">Active Users</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-building"></i>
            </div>
            <h3 class="stat-number" id="employers" data-value="{{ $registeredCompanies }}">0</h3>
            <p class="stat-label">Total Companies</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fas fa-file-alt"></i>
            </div>
            <h3 class="stat-number" id="applications" data-value="{{ $totalApplications }}">0</h3>
            <p class="stat-label">Total Applications</p>
        </div>
    </div>

    <div class="admin-chart-container">
        <h3>JobHirence Platform Analytics</h3>
        <!-- Chart container with data attributes -->
        <div id="admin-jobChart" 
             data-months="{{ json_encode($chartData['months']) }}"
             data-jobs="{{ json_encode($chartData['jobs']) }}"
             data-applications="{{ json_encode($chartData['applications']) }}"
             data-users="{{ json_encode($chartData['users']) }}"
             data-companies="{{ json_encode($chartData['companies']) }}"
             style="width: 100%; height: 350px;"></div>
    </div>
    
    <div class="admin-dashboard-sections">
        <section class="admin-profile-job-postings">
            <h3>Recent Job Postings</h3>
            @if(count($recentJobs) > 0)
                <div class="admin-job-postings-grid">
                    @foreach($recentJobs as $job)
                    <div class="admin-profile-job-item">
                        <div class="admin-profile-job-header">
                            <span class="admin-profile-job-company">
                                @if($job->user_id)
                                    <i class="fas fa-user"></i> {{ $job->company_name ?? 'Unknown User' }}
                                @elseif($job->company_id)
                                    <i class="fas fa-building"></i> {{ $job->company->c_name ?? 'Unknown Company' }}
                                @else
                                    Unknown Poster
                                @endif
                            </span>
                            <span class="admin-profile-job-date">Posted {{ $job->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="admin-profile-job-title">{{ $job->title }}</p>
                        <a href="{{ route('admin.job.details', $job->id) }}" class="admin-dashboard-view-job-btn">View Details</a>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="no-data-message">No recent job postings found.</p>
            @endif
        </section>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Ensure ApexCharts is loaded before initializing
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ApexCharts === 'undefined') {
            console.error('ApexCharts is not loaded. Please include the ApexCharts library.');
            
            // Create a script element and load ApexCharts dynamically if not present
            const script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/apexcharts';
            script.onload = function() {
                console.log('ApexCharts loaded dynamically');
                // Initialize the chart after loading
                if (typeof initializeChart === 'function') {
                    initializeChart();
                }
            };
            document.body.appendChild(script);
        }
    });
</script>
@endsection