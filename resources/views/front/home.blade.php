@extends('front.layouts.app')

@section('main')

<!-- Hero Section with Image Slider -->
<section id="home" class="home-first-section" style=" background-image: linear-gradient(to right, rgba(19, 26, 33, 0.8), rgba(0, 0, 0, 0.8)), url({{ asset('assets/photos/image1.jpg') }});">

    <div class="container">
        <h1>Land Your Dream Job with <span>JobHirence</span></h1>
        <p>Discover thousands of career opportunities designed just for you.</p>

        <div class="cta-buttons">
            
            <a href="{{ route('job') }}"><button class="cta-btn explore-btn">Explore Jobs</button></a>
            @if (Auth::check())
                <a href="{{ route('account.showPostJob') }}"><button class="cta-btn post-btn">Post a Job</button></a>
            @else
                <a href="{{ route('account.userLogin') }}"><button class="cta-btn post-btn">Post a Job</button></a>
            @endif
            
        </div>
    </div>
    
</section>


<!-- Featured Jobs Section -->
<section id="jobs" class="home-featured-jobs">
<div class="trending-job-container">
    <h2>🚀 Trending Jobs</h2>
        <div class="job-grid">

            @if ($trendingJobs->isNotEmpty())
                @foreach ($trendingJobs as $trendingJob)
                    <div class="job-item">
                        <div class="job-header">
                            <div class="job-title">{{ $trendingJob->title }}</div>
                        </div>
                        <div class="job-info-container">
                        <div class="job-company"><i class="fas fa-building"></i> {{ $trendingJob->company_name }}</div>
                        <div class="job-location"><i class="fas fa-map-marker-alt"></i> {{ $trendingJob->location }}</div>
                        <div class="job-salary"><i class="fa-solid fa-indian-rupee-sign"></i>
                            {{ $trendingJob->salary ?  $trendingJob->salary . '/year' : 'Not Specified' }}</div>
                        <div class="job-type"> <i class="fas fa-briefcase"></i> {{ $trendingJob->jobType->type_name }}</div>
                        <div class="job-posted">Posted {{ $trendingJob->created_at->diffForHumans() }}</div>
                        </div>
                        <a href="{{ route('jobDetail', $trendingJob->id) }}" class="job-apply">View Details Now</a>
                    </div>
                @endforeach
        @endif
        </div>
    </div>
</section>

<!-- Categories Section -->

<section id="categories" class="home-categories">
    <div class="container">
        <h2>Browse Top Categories</h2>
        <div class="home-category-grid">

            @if ($categories->isNotEmpty())
                @foreach ($categories as $category)
                <div class="home-category-item">
                    <h3>{{ $category->category_name }}</h3>
                    <p>Explore 200+ jobs</p>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>



<!-- additional compant page redirecting cards section. -->
<div id="companies" class="companies-job">
    <div class="companies-job-container">
        <h2 class="companies-job-title">🎯 Explore jobs by top companies</h2>
        <div class="companies-job-wrapper">
            <button class="scroll-btn left-btn">←</button>
            <div class="companies-job-cards-container">
                <div class="companies-job-cards">
                    @foreach($topCompanies as $company)
                        <div class="companies-job-card">
                            @php
                            $imagePath = 'uploads/company_profile/' . ($company->company_details->profile_img ?? 'default_company.png');
                            $fullPath = public_path($imagePath);
                            $exists = file_exists($fullPath);
                        @endphp

                        <img src="{{ $exists ? asset($imagePath) : asset('uploads/company_profile/default_company.png') }}" 
                            alt="{{ $company->c_name }}" 
                            class="companie-logo"
                            onerror="this.src='{{ asset('uploads/company_profile/default_company.png') }}'">

                            {{-- <img src="{{ asset('uploads/company_profile/' . ($company->company_details->profile_img ?? 'default_company.png')) }}" alt="{{ $company->c_name }}"> --}}
                            <h3>{{ $company->c_name }}</h3>
                            <p class="companies-job-description">
                                {{ Str::limit($company->company_details->about ?? 'Description Not Specified', 70) }}
                            </p>
                            {{-- <div class="companies-job-rating">
                                ⭐ {{ number_format($company->avg_rating ?? 0, 1) }} 
                                <span>({{ $company->review_count ?? 0 }} reviews)</span>
                            </div> --}}
                            <div class="companies-job-count">
                                {{ $company->job_count }} open positions
                            </div>
                            <a href="{{ route('companies.details', ['id' => $company->id, 'tab' => 'jobs']) }}" class="companies-job-view-jobs">View jobs</a>
                        </div>
                    @endforeach
                </div>
            </div>
            <button class="scroll-btn right-btn">→</button>
        </div>
        <a href="{{ route('companie') }}" class="companies-job-view-all-companies">View all companies</a>
    </div>
</div>

{{-- <div class="companies-job-card">
    <img src="image1.jpg" alt="Actalent">
    <h3>1 Actalent Services</h3>
    <p class="companies-job-description">We are a global leader in engineering & sciences...</p>
    <div class="companies-job-rating">⭐ 3.4 <span>(277 reviews)</span></div>
    <a href="#" class="companies-job-view-jobs">View jobs</a>
  </div> --}}


<!-- Trusted Companies Section -->
<section class="home-companies">
<div class="home-slider-container">
    <div class="home-text">
        <h2>Trusted Companies</h2>
        <p>We work with the best companies across industries.</p>
    </div>
    <div class="home-slider-wrapper">
        <div class="home-slider">
            <!-- Original Items -->
            <div class="home-company">
                <img src="assets/" alt="Company 1" data-src="company1.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 2" data-src="company2.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 3" data-src="company3.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 4" data-src="company4.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 5" data-src="company5.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 6" data-src="company6.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 7" data-src="company7.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 8" data-src="company8.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 9" data-src="company9.png">
            </div>
            <div class="home-company">
                <img src="assets/photos/image1.jpg" alt="Company 10" data-src="company10.png">
            </div>
            <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 1" data-src="company1.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 2" data-src="company2.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 3" data-src="company3.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 4" data-src="company4.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 5" data-src="company5.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 6" data-src="company6.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 7" data-src="company7.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 8" data-src="company8.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 9" data-src="company9.png">
          </div>
          <div class="home-company">
              <img src="assets/photos/image1.jpg" alt="Company 10" data-src="company10.png">
          </div>
        </div>
    </div>
</div>

</section>

{{-- letest job --}}
<div class="home-latest-jobs-section">
    <h2>💎 Latest Jobs</h2>
    <div class="home-latest-jobs-carousel">

        @if ($letestJobs->isNotEmpty())
                @foreach ($letestJobs as $letestJob)
                <div class="home-latest-job-card">
                    <h3>{{ $letestJob->title }}</h3>
                    <div class="home-latest-job-details">
                        <p><i class="fas fa-building"></i> <strong>Company:</strong> {{ $letestJob->company_name }}</p>
                        <p class="home-latest-job-location"><i class="fas fa-map-marker-alt"></i> <strong> Location:</strong> {{ $letestJob->company_location }}</p>
                        <p class="home-latest-job-jobType"><i class="fas fa-laptop"></i>
                            <strong> JobType:</strong> {{ $letestJob->jobType->type_name }}</p>
                    </div>
                    <div class="home-latest-job-footer">
                        <a href="{{ route('jobDetail', $letestJob->id) }}" class="home-latest-apply-btn">View Details</a>
                        <p class="home-latest-posted-date">Posted {{ $letestJob->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @endforeach
        @endif
    </div>
</div>


<!-- about page  -->
@if (!Auth::user())
    
<section class="about-section" id="about">
    <div class="about-container">
      <!-- Intro Section -->
        <div class="about-intro">
            <h1 class="about-title">About <span class="highlight">JobHirence</span></h1>
            <p class="about-subtitle">
            Bridging the gap between ambition and success. At JobHirence, we strive to create meaningful connections between job seekers and employers with innovation, precision, and passion.
            </p>
        </div>
    
        <div class="about-core-wrapper">
            <div class="about-core">
            <div class="core-item">
                <h2 class="core-heading">🌟 Our Mission</h2>
                <p>
                Empowering individuals and organizations to unlock their potential. We aim to revolutionize the job market with AI-driven solutions and a human-centered approach.
                </p>
            </div>
            <div class="core-item">
                <h2 class="core-heading">🚀 What We Offer</h2>
                <p>
                Whether you're an employer seeking top talent or a professional seeking your next role, we provide tailored solutions, smart tools, and unwavering support every step of the way.
                </p>
            </div>
            <div class="core-item">
                <h2 class="core-heading">💡 Why JobHirence?</h2>
                <p>
                With advanced technology and a user-first philosophy, we make job searching and hiring effortless. Our platform delivers speed, precision, and reliability like no other.
                </p>
            </div>
            </div>
            <div class="about-core-image">
            <img src="{{ asset('assets/photos/register.png') }}" alt="Job Hierance Illustration" />
            </div>
        </div>
      </div>
       <!-- Testimonials Section -->
       <div class="about-testimonials">
        <h2 class="testimonials-heading">What People Say</h2>
        <div class="testimonial-group">
            @forelse ($feedbacks as $feedback)
                <div class="testimonial">
                    <div class="testimonial-header">
                        <div class="testimonial-image">
                            <img src="{{ $feedback->user->image ? asset($feedback->user->image) : asset('assets/photos/default_icon.png') }}" alt="User Image">
                        </div>
                        <div class="testimonial-rating">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $feedback->rating)
                                    &#9733; 
                                @else
                                    &#9734; 
                                @endif
                            @endfor
                        </div>
                    </div>
                    <div class="testimonial-text">
                        <p class="testimonial-quote">
                            “{{ $feedback->feedback }}”
                        </p>
                        <p class="testimonial-author">- {{ $feedback->user->fullName }}</p>
                    </div>
                </div>
            @empty
                <p>No feedback available at the moment.</p>
            @endforelse
        </div>
    </div>

      <!-- Call to Action -->
      <div class="about-cta">
        <a href="{{ route('account.userLogin') }}" class="about-cta-button">Join Our Journey</a>
      </div>
    </div>
  </section>
@endif


<!-- Contact Page -->
<!-- FAQ Section -->
<section class="faq-section">
    <div class="faq-container">
        <div class="faq-header">
            <h2>Frequently Asked Questions</h2>
            <p>Find answers to the most common questions about our platform</p>
        </div>
        
        <div class="faq-categories">
            <div class="faq-category active" data-category="all">All Questions</div>
            <div class="faq-category" data-category="job-seekers">Job Seekers</div>
            <div class="faq-category" data-category="employers">Employers</div>
            <div class="faq-category" data-category="account">Account</div>
        </div>
        
        <div class="faq-accordion">
            <details class="faq-item" data-category="job-seekers">
                <summary class="faq-question">How do I create an account?</summary>
                <div class="faq-answer">
                    <p>Creating an account on JobHirence is simple and free. Follow these steps:</p>
                    <ul>
                        <li>Click on the "Sign Up" button in the top-right corner of the homepage</li>
                        <li>Choose whether you're a job seeker or employer</li>
                        <li>Fill in your details (name, email, password)</li>
                        <li>Verify your email address</li>
                        <li>Complete your profile with relevant information</li>
                    </ul>
                    <p>Once your account is created, you can immediately start browsing jobs or posting opportunities.</p>
                </div>
            </details>
            
            <details class="faq-item" data-category="job-seekers">
                <summary class="faq-question">How do I apply for a job?</summary>
                <div class="faq-answer">
                    <p>To apply for a job on JobHirence:</p>
                    <ul>
                        <li>Search for jobs using the search bar or filters</li>
                        <li>Click on a job listing that interests you</li>
                        <li>Review the job details and requirements</li>
                        <li>Click the "Apply Now" button</li>
                        <li>Follow the application instructions (some may require uploading your resume or answering screening questions)</li>
                    </ul>
                    <p>You can track all your job applications in the "Jobs Applied" section of your account dashboard.</p>
                </div>
            </details>
            
            <details class="faq-item" data-category="employers">
                <summary class="faq-question">How do I post a job as an employer?</summary>
                <div class="faq-answer">
                    <p>To post a job on JobHirence as an employer:</p>
                    <ul>
                        <li>Sign in to your employer account</li>
                        <li>Go to "Post a Job" in your dashboard</li>
                        <li>Fill in all the job details (title, description, requirements, location, salary, etc.)</li>
                        <li>Select any screening questions if desired</li>
                        <li>Review your job posting</li>
                        <li>Submit it for publication</li>
                    </ul>
                    <p>Your job will be reviewed and typically published within 24 hours. You can manage all your job postings from the "My Jobs" section.</p>
                </div>
            </details>
            
            <details class="faq-item" data-category="account">
                <summary class="faq-question">How do I reset my password?</summary>
                <div class="faq-answer">
                    <p>If you've forgotten your password:</p>
                    <ul>
                        <li>Click "Login" in the top menu</li>
                        <li>Select "Forgot Password" below the login form</li>
                        <li>Enter the email address associated with your account</li>
                        <li>Check your email for a password reset link</li>
                        <li>Follow the link and create a new password</li>
                    </ul>
                    <p>For security reasons, password reset links expire after 24 hours. If you don't receive the email, check your spam folder or contact our support team.</p>
                </div>
            </details>
            
            <details class="faq-item" data-category="account">
                <summary class="faq-question">Is it free to use JobHirence?</summary>
                <div class="faq-answer">
                    <p>JobHirence offers both free and premium services:</p>
                    <ul>
                        <li>For job seekers: Creating an account, browsing jobs, and applying to most positions is completely free.</li>
                        <li>For employers: We offer different subscription tiers based on your hiring needs. Basic job posting may include a fee, while premium features like candidate sorting, featured listings, and analytics require a subscription.</li>
                    </ul>
                    <p>Visit our Pricing page for detailed information about our plans and features.</p>
                </div>
            </details>
        </div>
        
        <div class="faq-cta">
            <p>Didn't find the answer you were looking for?</p>
            @if (Auth::check())
                <a href="{{ route('account.contactUs') }}" class="faq-cta-btn">Contact Us</a>
            @else
                <a href="{{ route('account.userLogin') }}" class="faq-cta-btn">Contact Us</a>
            @endif
            
        </div>
    </div>
</section>
@endsection