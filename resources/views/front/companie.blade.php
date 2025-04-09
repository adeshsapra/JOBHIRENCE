@extends('front.layouts.app')

@section('main')
    <!-- Slider Section -->
    <section class="slider-container">
        <div class="slider">
            <div class="slide" data-background="{{ asset('assets/companie/reliance.jpg') }}">
                <img src="{{ asset('assets/companie/reliance_logo.jpg') }}" alt="Company Logo" class="slide-image">
                <h3 class="slide-company-name">1. TATA <span>(Ahemdabad)</span></h3>
                <p>This is most expensive comapnies for you.</p>
                <button class="view-jobs-btn">View Jobs</button>
            </div>
            <!-- Slide 1 -->
            <div class="slide" data-background="{{ asset('assets/companie/infosys.jpg') }}">
                <img src="{{ asset('assets/companie/infosys_logo.jpg') }}" alt="Company Logo" class="slide-image">
                <h3 class="slide-company-name">2. Infosys <span>(Noida)</span></h3>
                <p class="company-desc">This is most expensive comapnies for you.</p>
                <button class="view-jobs-btn">View Jobs</button>
            </div>
            <!-- Slide 2 -->
            <div class="slide" data-background="{{ asset('assets/companie/wipro.jpg') }}">
                <img src="{{ asset('assets/companie/wipro_logo.jpg') }}" alt="Company Logo" class="slide-image">
                <h3 class="slide-company-name">3. Wipro <span>(Hyderabad)</span></h3>
                <p class="company-desc">This is most expensive comapnies for you.</p>
                <button class="view-jobs-btn">View Jobs</button>
            </div>
            <!-- Slide 3 -->
            <div class="slide" data-background="{{ asset('assets/companie/reliance.jpg') }}">
                <img src="{{ asset('assets/companie/reliance_logo.jpg') }}" alt="Company Logo" class="slide-image">
                <h3 class="slide-company-name">4. Reliance <span>(Chennai)</span></h3>
                <p class="company-desc">This is most expensive comapnies for you.</p>
                <button class="view-jobs-btn">View Jobs</button>
            </div>
            <!-- Slide 4 -->
            <div class="slide" data-background="{{ asset('assets/companie/infosys.jpg') }}">
                <img src="{{ asset('assets/companie/infosys_logo.jpg') }}" alt="Company Logo" class="slide-image">
                <h3 class="slide-company-name">5. TCS <span>(Anand)</span></h3>
                <p>This is most expensive comapnies for you.</p>
                <button class="view-jobs-btn">View Jobs</button>
            </div>
        </div>
    </section>

    <!-- search bar -->

    <div class="main-search-container">
        <div class="search-container">
            <div class="search-header">
              <h1>Find a Company Matching Requirements</h1>
              <p>Explore 5 lakh+ career opportunities!</p>
            </div>
            
            <div class="search-box">
              <input type="text" class="search-input" placeholder="Enter skills / designations / companies">
              
              <div class="search-divider"></div>
              <div class="search-dropdown">
                <select>
                  <option value="">Department</option>
                  <option value="engineering">Engineering</option>
                  <option value="marketing">Marketing</option>
                  <option value="sales">Sales</option>
                  <option value="finance">Finance</option>
                  <option value="hr">Human Resources</option>
                </select>
              </div>
              
              <div class="search-divider"></div>
              <div class="search-dropdown">
                <select>
                  <option value="">Industry</option>
                  <option value="technology">Technology</option>
                  <option value="healthcare">Healthcare</option>
                  <option value="finance">Finance</option>
                  <option value="retail">Retail</option>
                  <option value="manufacturing">Manufacturing</option>
                </select>
              </div>
              
              <div class="search-divider"></div>
              <div class="search-dropdown">
                <select>
                  <option value="">Location</option>
                  <option value="mumbai">Mumbai</option>
                  <option value="delhi">Delhi</option>
                  <option value="bangalore">Bangalore</option>
                  <option value="hyderabad">Hyderabad</option>
                  <option value="chennai">Chennai</option>
                </select>
              </div>
              
              <button class="search-button">Search Companie</button>
            </div>
          </div>
    </div>
    

    <!-- compnies section -->

    <section class="companies-container">
        <h2 class="section-heading">- Top-Rated Companies -</h2>
    </section>
    <div class="total-companies">Showing {{ $totalCompanies }} companies</div>

        <div class="companies-card-container">
            @foreach ($companies as $company)
                <a href="{{ route('companies.details', ['id' => $company->id]) }}" class="companie-card-link">
                    <div class="companies-card">
                        @php
                            $imagePath = 'uploads/company_profile/' . ($company->profile_img ?? 'default_company.png');
                            $fullPath = public_path($imagePath);
                            $exists = file_exists($fullPath);
                        @endphp
                        <img src="{{ $exists ? asset($imagePath) : asset('uploads/company_profile/default_company.png') }}" 
                            alt="{{ $company->c_name }}" 
                            class="companie-logo"
                            onerror="this.src='{{ asset('uploads/company_profile/default_company.png') }}'">
                        <div class="companie-info">
                            <div class="companie-name">{{ $company->c_name }}</div>
                            <div class="companie-rating-reviews">
                                <span class="star">★</span>
                                <span class="rating">{{ $company->avg_rating }}</span>
                                <span class="reviews">{{ $company->review_count }} {{ Str::plural('review', $company->review_count) }}</span>
                            </div>
                            <div class="companie-tags">
                                <span class="companie-tag">{{ $company->c_industry }} | {{ $company->market_type }}</span>
                                <span class="companie-tag">{{ $company->c_type }}</span>
                            </div>
                        </div>
                        <span class="companie-arrow">›</span>
                        
                        @if($company->review_count > 0)
                            <div class="company-card-reviews-preview">
                                <h4>Recent Reviews</h4>
                                <div class="recent-reviews">
                                    @foreach($company->recent_reviews as $review)
                                        <div class="review-snippet">
                                            <div class="review-stars">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="mini-star {{ $i <= $review->rating ? 'filled' : '' }}">★</span>
                                                @endfor
                                            </div>
                                            <p class="review-excerpt">{{ Str::limit($review->feedback, 100) }}</p>
                                            <span class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('M Y') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Pagination (inside Turbo Frame) -->
        <div class="pagination-container">
            @if ($companies->hasPages())
                <nav class="pagination-nav">
                    {{-- Previous Button --}}
                    @if ($companies->onFirstPage())
                        <span class="pagination-link disabled">Previous</span>
                    @else
                        <a href="{{ $companies->previousPageUrl() }}" class="pagination-link">Previous</a>
                    @endif
        
                    {{-- Page Numbers --}}
                    @foreach ($companies->links()->elements as $element)
                        {{-- Separator for "..." --}}
                        @if (is_string($element))
                            <span class="pagination-link dots">{{ $element }}</span>
                        @endif
        
                        {{-- Array of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $companies->currentPage())
                                    <span class="pagination-link active">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
        
                    {{-- Next Button --}}
                    @if ($companies->hasMorePages())
                        <a href="{{ $companies->nextPageUrl() }}" class="pagination-link">Next</a>
                    @else
                        <span class="pagination-link disabled">Next</span>
                    @endif
                </nav>
            @endif
        </div>
        
        {{--
        <a href="#" class="card-link">
            <div class="company-card">
                <img src="/api/placeholder/48/48" alt="UTL" class="company-logo">
                <div class="company-info">
                    <div class="company-name">UTL</div>
                    <div class="rating-reviews">
                        <span class="star">★</span>
                        <span class="rating">3.6</span>
                        <span class="reviews">299 reviews</span>
                    </div>
                    <div class="tags">
                        <span class="tag">Corporate</span>
                        <span class="tag">Power</span>
                        <span class="tag">Founded: 1996</span>
                    </div>
                </div>
                <span class="arrow">></span>
            </div>
        </a> --}}
    </div>
@endsection

@section('customJs')
<script>
 function initializeSlider() {
    const slider = document.querySelector(".slider");
    if (!slider) return; // Prevent errors if slider is not on the page

    const slides = document.querySelectorAll(".slide");
    let currentSlide = 0;
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                const bgImage = slide.getAttribute('data-background');
                slide.style.backgroundImage = `url(${bgImage})`;
                slide.style.backgroundSize = 'cover';
                slide.style.backgroundPosition = 'center';
                slide.style.backgroundRepeat = 'no-repeat';

                slide.style.opacity = "1";
                slide.style.display = "block";
            } else {
                slide.style.opacity = "0";
                slide.style.display = "none";
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    // Initialize first slide
    showSlide(currentSlide);

    // Ensure only one interval is running
    if (window.slideInterval) clearInterval(window.slideInterval);
    window.slideInterval = setInterval(nextSlide, 3000);

    // Pause slider on hover
    slider.addEventListener("mouseenter", () => clearInterval(window.slideInterval));
    slider.addEventListener("mouseleave", () => {
        window.slideInterval = setInterval(nextSlide, 3000);
    });
}

// Detect when the page is loaded with Turbo Drive or regular page load
document.addEventListener("DOMContentLoaded", initializeSlider);
document.addEventListener("turbo:load", initializeSlider); // For Turbo Drive (Laravel inertia.js, Livewire, etc.)

</script>
@endsection