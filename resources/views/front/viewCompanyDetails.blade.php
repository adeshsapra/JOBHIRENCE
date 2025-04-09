@extends('front.layouts.app')

@section('main')
<div class="company-profile-container">
@include('front.alertMessage')

    <!-- Header Section -->
     <div class="company-cover-image">
        <img src="{{ asset('uploads/company_cover/' . $company->cover_img) }}" alt="Company Cover">
    </div>
    <div class="company-profile-header">
        @php
            $imagePath = 'uploads/company_profile/' . ($company->profile_img ?? 'default_company.png');
            $fullPath = public_path($imagePath);
            $exists = file_exists($fullPath);
        @endphp
            <img src="{{ $exists ? asset($imagePath) : asset('uploads/company_profile/default_company.png') }}" 
                alt="{{ $company->c_name }}" 
                class="companie-logo"
                onerror="this.src='{{ asset('uploads/company_profile/default_company.png') }}'">   
        <div>
            <h1>{{ $company->c_name }}</h1>

            <!-- Star Rating System -->
           <div class="company-rating">
                @php
                    $avgRating = $avgRating ?? 0;
                    $followers = DB::table('company_followers')
                        ->where('company_id', $company->id)
                        ->count();
                    $followerCount = number_format($followers);
                @endphp
                
                @for ($i = 1; $i <= 5; $i++)
                    <span class="company-detail-header-star {{ $i <= $avgRating ? 'filled' : '' }}" 
                        data-value="{{ $i }}">&#9733;</span>
                @endfor
                <span class="rating-text">({{ number_format($avgRating, 1) }})</span>
                <span class="follower-count">| {{ $followerCount }} {{ Str::plural('Follower', $followers) }}</span>
            </div>
            
            <div class="company-type-container">
                @if ($company->c_industry)
                    <div class="company-type">{{ $company->c_industry }}</div>   
                @endif
                @if ($company->c_type)
                    <div class="company-type">{{ $company->c_type }}</div>   
                @endif
                @if ($company->market_type)
                    <div class="company-type">{{ $company->market_type }}</div>
                @endif
            </div>
            
            <div class="follow-section">
                @if(Auth::check())
                    @if($isFollowing)
                        <form action="{{ route('company.unfollow', ['id' => $company->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="follow-btn following">Following</button>
                        </form>
                    @else
                        <form action="{{ route('company.follow', ['id' => $company->id]) }}" method="POST">
                            @csrf
                            <button type="submit" class="follow-btn">Follow</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('account.userLogin') }}" class="follow-btn">Follow</a>
                @endif
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
            <p>{{ $company->about ?? 'Not Specified' }}</p>
            
            <h2>Key Information</h2>
            <div class="company-profile-info-grid">
                <div class="company-profile-info-card">
                    <h3><i class="fas fa-industry"></i> Industry</h3>
                    <p>{{ $company->c_industry ?? 'Not Specified' }}</p>
                </div>
                <div class="company-profile-info-card">
                    <h3><i class="fas fa-calendar-alt"></i> Founded</h3>
                    <p>{{ $company->c_established_year ?? 'Not Specified' }}</p>
                </div>
                <div class="company-profile-info-card">
                    <h3><i class="fas fa-map-marker-alt"></i> Headquarters</h3>
                    <p>{{ $company->headquarters ?? 'Not Specified' }}</p>
                </div>
                <div class="company-profile-info-card">
                    <h3><i class="fas fa-users"></i> Employees</h3>
                    <p>{{ $company->c_size ?? 'Not Specified' }}</p>
                </div>
                <div class="company-profile-info-card">
                    <h3><i class="fas fa-building"> </i> Type</h3>
                    <p>{{ $company->c_type ?? 'Not Specified' }}</p>
                </div>
                <div class="company-profile-info-card">
                    <h3><i class="fas fa-globe"></i> website</h3>
                    <p>{{ $company->c_website ?? 'Not Specified' }}</p>
                </div>
            </div>

            <h2>Contact Information</h2>
            <p>Email: {{ $company->c_email ?? 'Not Specified' }}</p>
            <p>Phone: +91 {{ $company->phone ?? 'Not Specified' }}</p>
            <p>Address: {{ $company->c_address ?? 'Not Specified' }}, {{ $company->c_country ?? 'Not Specified' }}</p>

            <!-- Social Media Links -->
            <div class="company-profile-social-media">
                @if($company->facebook)
                        <a href="{{ $company->facebook }}" target="_blank" class="social-icon">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-facebook-f" ></i>
                        </div>
                    @endif

                    @if($company->twitter)
                        <a href="{{ $company->twitter }}" target="_blank" class="social-icon">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-twitter" ></i>
                        </div>
                    @endif

                    @if($company->linkedin)
                        <a href="{{ $company->linkedin }}" target="_blank" class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-linkedin-in"></i>
                        </div>
                    @endif
                    @if($company->instagram)
                        <a href="{{ $company->instagram }}" target="_blank" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @else
                        <div class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </div>
                    @endif

                    {{-- @if($company->instagram)
                        <a href="{{ $company->instagram }}" target="_blank" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @else
                        <a href="#instagram" target="_blank" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif             --}}
            </div>
        </div>
    </div>

    <!-- Jobs Tab Content -->
    <div class="tab-content" id="jobs">
        <h2>Jobs Offered</h2>
        <div class="company-profile-jobs">
            @forelse($jobs as $job)
                <div class="company-job-card">
                    <h3>{{ $job->title }}</h3>
                    <p><i class="fas fa-map-marker-alt"></i> <strong>Location:</strong> {{ $job->location }}</p>
                    <p><i class="fa-solid fa-indian-rupee-sign"></i> <strong>Salary:</strong> {{ $job->salary ?? 'Not specified' }}</p>
                    <p> <i class="fas fa-clock"></i><strong>Type:</strong> {{ $job->jobType->type_name }}</p>
                    <p><i class="fas fa-briefcase"></i> <strong>Experience:</strong> {{ $job->experience ?? 'Not specified' }}</p>
                    <a href="{{ route('jobDetail', $job->id) }}" class="company-job-apply-btn">View Details</a>
                    <div class="job-posted">Posted {{ $job->created_at->diffForHumans() }}</div>
                </div>
                @empty
                <p>No jobs available at the moment.</p>
            @endforelse
        </div>

        <div class="pagination-container">
            @if ($jobs->hasPages())
                <nav class="pagination-nav">
                    @if ($jobs->onFirstPage())
                        <span class="pagination-link disabled">Previous</span>
                    @else
                        <a href="{{ $jobs->appends(['tab' => 'jobs'])->previousPageUrl() }}" class="pagination-link">Previous</a>
                    @endif
        
                    @foreach ($jobs->links()->elements as $element)
                        @if (is_string($element))
                            <span class="pagination-link dots">{{ $element }}</span>
                        @endif
        
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $jobs->currentPage())
                                    <span class="pagination-link active">{{ $page }}</span>
                                @else
                                    <a href="{{ $jobs->appends(['tab' => 'jobs'])->url($page) }}" class="pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    @if ($jobs->hasMorePages())
                        <a href="{{ $jobs->appends(['tab' => 'jobs'])->nextPageUrl() }}" class="pagination-link">Next</a>
                    @else
                        <span class="pagination-link disabled">Next</span>
                    @endif
                </nav>
            @endif
        </div>

    </div>
    </div>
</div>

<div class="company-details-rating-container">
    <h2>Rate Our Company</h2>
    @if(Auth::check())
        <form action="{{ route('company.rate', $company->id) }}" method="POST" id="ratingForm">
            @csrf
            <div class="company-detail-stars">
                <span class="company-detail-star" data-value="1">★</span>
                <span class="company-detail-star" data-value="2">★</span>
                <span class="company-detail-star" data-value="3">★</span>
                <span class="company-detail-star" data-value="4">★</span>
                <span class="company-detail-star" data-value="5">★</span>
            </div>
            <input type="hidden" name="rating" id="selected-rating" value="">
            
            <p class="rating-message">
                @if($userRating)
                    Your current rating: {{ $userRating->rating }} stars
                @else
                    Select a rating
                @endif
            </p>
            
            <textarea name="feedback" class="comment-box" placeholder="Leave a comment..."></textarea>
            <button type="submit" class="company-rating-submit-btn">Submit</button>
        </form>
    @else
        <p>Please <a href="{{ route('account.userLogin') }}">login</a> to rate this company.</p>
    @endif
</div>
@endsection

{{-- <p class="rating-text">
    @if($userRating)
        Your current rating: {{ $userRating->rating }} stars
    @else
        Select a rating
    @endif
</p> --}}

@section('customCss')
<style>

    </style>
@endsection

@section('customJs')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showTab('{{ $activeTab }}');
        initializeRating();
        initializeHeaderStars();
    });

    // Initialize header stars display
    function initializeHeaderStars() {
        const headerStars = document.querySelectorAll('.company-detail-header-star');
        const avgRating = {{ $avgRating }};
        
        headerStars.forEach((star, index) => {
            if (index + 1 <= avgRating) {
                star.classList.add('filled');
            }
        });
    }

    // Tab switching functionality
    function showTab(tabName) {
        document.querySelectorAll('.tab').forEach(tab => {
            tab.classList.remove('active-tab');
        });
        document.querySelectorAll('.tab-content').forEach(content => {
            content.classList.remove('active');
        });

        document.getElementById(`${tabName}-tab`).classList.add('active-tab');
        document.getElementById(tabName).classList.add('active');

        const url = new URL(window.location);
        url.searchParams.set('tab', tabName);
        window.history.pushState({}, '', url);
    }

    // Rating functionality
    function initializeRating() {
        const ratingForm = document.getElementById('ratingForm');
        if (!ratingForm) return; // Exit if rating form doesn't exist

        const stars = ratingForm.querySelectorAll('.company-detail-star');
        const ratingMessage = ratingForm.querySelector('.rating-message');
        const ratingInput = ratingForm.querySelector('#selected-rating');
        let selectedRating = 0;

        stars.forEach(star => {
            star.addEventListener('mouseover', function() {
                updateStars(this.dataset.value);
            });

            star.addEventListener('click', function() {
                selectedRating = this.dataset.value;
                ratingInput.value = selectedRating;
                updateStars(selectedRating);
                ratingMessage.textContent = `You selected ${selectedRating} stars`;
                ratingMessage.style.color = ''; // Reset color
            });
        });

        ratingForm.querySelector('.company-detail-stars').addEventListener('mouseleave', function() {
            updateStars(selectedRating);
        });

        function updateStars(rating) {
            stars.forEach(star => {
                const value = star.dataset.value;
                star.style.color = value <= rating ? '#ffd700' : '#ddd';
            });
        }

        // Validate only the rating form
        ratingForm.addEventListener('submit', function(e) {
            if (!ratingInput.value) {
                e.preventDefault();
                ratingMessage.textContent = 'Please select a rating';
                ratingMessage.style.color = 'red';
            }
        });
    }

</script>
@endsection