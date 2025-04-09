@extends('company.layouts.app')

@section('main')
<div class="company-panel-menu-header">
    <h1 class="company-panel-menu-heading">- Profile Overview -</h1>
</div>

<div class="company-profile-container">
    <!-- Header Section -->
    <div class="company-cover-image">
        @if($companyDetails->cover_img)
            <img src="{{ asset('uploads/company_cover/' . $companyDetails->cover_img) }}" alt="Company Cover">
        @else
            <div class="default-cover">
                <span>Upload Cover Photo</span>
            </div>
        @endif
    </div>
    
    <div class="company-profile-header">
        <img src="{{ asset('uploads/company_profile/' . ($companyDetails->profile_img ?? 'default_icon.png')) }}" alt="Company Logo" class="edit-company-profile-logo">

        <div>
            <h1>{{ $company->c_name ?? 'Company Name' }}</h1>
            <div class="company-rating">
                <span class="company-detail-header-star" data-value="1">&#9733;</span>
                <span class="company-detail-header-star" data-value="2">&#9733;</span>
                <span class="company-detail-header-star" data-value="3">&#9733;</span>
                <span class="company-detail-header-star" data-value="4">&#9733;</span>
                <span class="company-detail-header-star" data-value="5">&#9733;</span>
                <span class="rating-text">(4.5)</span>
                <span class="follower-count">| 1.2K Followers</span>
            </div>
            
            <div class="company-type-container">
                @if($company->c_industry)
                    <div class="company-type">{{ $company->c_industry}}</div>
                @endif
                @if($company->c_type)
                    <div class="company-type">{{ $company->c_type }}</div>
                @endif
                @if($companyDetails->market_type)
                    <div class="company-type">{{ $companyDetails->market_type}}</div>
                @endif
            </div>

            <div class="follow-section">
                <a href="{{ route('company.editProfile') }}" class="edit-profile-btn">Edit Profile</a>
            </div>

        </div>
    </div>

    <div class="company-profile-content">
        <!-- Tab Navigation -->
        <div class="tab-navigation">
            <div class="tab active-tab" id="overview-tab" onclick="showTab('overview')">Overview</div>
            <div class="tab" id="jobs-tab" onclick="showTab('jobs')">Jobs</div>
        </div>

        <!-- Overview Tab Content -->
        <div class="tab-content active" id="overview">
            <div class="company-profile-details">
                <h2>About the Company</h2>
                <p>{{ $companyDetails->about ?? 'Description not available' }}</p>
                
                <h2>Key Information</h2>
                <div class="company-profile-info-grid">
                    <div class="company-profile-info-card">
                        <h3><i class="fas fa-industry"></i> Industry</h3>
                        <p>{{ $company->c_industry ?? 'Not specified' }}</p>
                    </div>
                    <div class="company-profile-info-card">
                        <h3><i class="fas fa-calendar-alt"></i> Founded</h3>
                        <p>{{ $company->c_established_year ?? 'Not specified' }}</p>
                    </div>
                    <div class="company-profile-info-card">
                        <h3><i class="fas fa-map-marker-alt"></i> Headquarters</h3>
                        <p>{{ $company->c_city ?? 'Not specified' }}, {{ $company->c_country ?? '' }}</p>
                    </div>
                    <div class="company-profile-info-card">
                        <h3><i class="fas fa-users"></i> Employees</h3>
                        <p>{{ $company->c_size ?? 'Not specified' }}</p>
                    </div>
                    <div class="company-profile-info-card">
                        <h3><i class="fas fa-building"></i> Type</h3>
                        <p>{{ $company->c_type ?? 'Not specified' }}</p>
                    </div>
                    <div class="company-profile-info-card">
                        <h3><i class="fas fa-globe"></i> Website</h3>
                        <a href="{{ $company->c_website }}"> {{ $company->c_website ?? 'Not specified' }} </a>
                        {{-- <p>{{ $company->c_website ?? 'Not specified' }}</p> --}}
                    </div>
                </div>

                <h2>Contact Information</h2>
                <p>Email: {{ $companyDetails->contact_email ?? 'Not specified' }}</p>
                <p>Phone: +91 {{ $companyDetails->phone ?? 'Not specified' }}</p>
                <p>Address: {{ $company->c_address ?? 'Not specified' }}, {{ $company->c_city ?? '' }}, {{ $company->c_country ?? '' }} {{ $company->c_postal_code ?? '' }}</p>

                <div class="company-profile-social-media">

                    @if($companyDetails->facebook)
                        <a href="{{ $companyDetails->facebook }}" target="_blank" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-facebook-f" ></i>
                        </div>
                    @endif

                    @if($companyDetails->twitter)
                        <a href="{{ $companyDetails->twitter }}" target="_blank" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-twitter" ></i>
                        </div>
                    @endif

                    @if($companyDetails->linkedin)
                        <a href="{{ $companyDetails->linkedin }}" target="_blank" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                    @endif

                    @if($companyDetails->instagram)
                        <a href="{{ $companyDetails->instagram }}" target="_blank" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                    @endif  

                </div>
            </div>
        </div>

        <!-- Jobs Tab Content -->
        <div class="tab-content" id="jobs">
            <h2>Jobs Offered</h2>
            <div class="company-profile-jobs">
                @forelse($recentJobs as $job)
                <div class="company-job-card">
                    <h3>{{ $job->title }}</h3>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $job->location }}</p>
                    <p><i class="fas fa-dollar-sign"></i> <strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
                    <p><i class="fas fa-briefcase"></i> <strong>Experience:</strong> {{ $job->experience ?? 'Not specified' }}</p>
                    <p><i class="fas fa-info-circle"></i> <strong>Description:</strong> {{ Str::limit($job->description, 100) }}</p>
                    <a href="{{ route('company.viewJobDetail', $job->id) }}" class="company-job-apply-btn">View Details</a>
                </div>
                @empty
                <p>No jobs available at the moment.</p>
                @endforelse
            </div>

            <div class="pagination-container">
                @if ($recentJobs->hasPages())
                    <nav class="pagination-nav">
                        {{-- Previous Button --}}
                        @if ($recentJobs->onFirstPage())
                            <span class="pagination-link disabled">Previous</span>
                        @else
                            <a href="{{ $recentJobs->previousPageUrl() . '&tab=jobs' }}" class="pagination-link">Previous</a>
                        @endif
            
                        {{-- Page Numbers --}}
                        @foreach ($recentJobs->links()->elements as $element)
                            {{-- Separator for "..." --}}
                            @if (is_string($element))
                                <span class="pagination-link dots">{{ $element }}</span>
                            @endif
            
                            {{-- Array of Links --}}
                            @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $recentJobs->currentPage())
                                    <span class="pagination-link active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url . '&tab=jobs' }}" class="pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach
                            @endif
                        @endforeach
            
                        {{-- Next Button --}}
                        @if ($recentJobs->hasMorePages())
                        <a href="{{ $recentJobs->nextPageUrl() . '&tab=jobs' }}" class="pagination-link">Next</a>
                        @else
                        <span class="pagination-link disabled">Next</span>
                        @endif
                    </nav>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection

@section('customJs')
<script>
    function showTab(tabName) {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('active-tab');
        });
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        document.getElementById(`${tabName}-tab`).classList.add('active-tab');
        document.getElementById(tabName).classList.add('active');
    }

    // Check for tab parameter on page load
    document.addEventListener('DOMContentLoaded', function() {
        const urlParams = new URLSearchParams(window.location.search);
        const activeTab = urlParams.get('tab');
        if (activeTab) {
            showTab(activeTab);
        }
    });
</script>
@endsection