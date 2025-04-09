@extends('front.layouts.app')

@section('main')

<section class="about-section" id="about">
    <div class="about-container">
      <!-- Intro Section -->
        <div class="about-intro">
            <h1 class="about-title">About <span class="highlight">JobHierance</span></h1>
            <p class="about-subtitle">
            Bridging the gap between ambition and success. At JobHierance, we strive to create meaningful connections between job seekers and employers with innovation, precision, and passion.
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
                <h2 class="core-heading">💡 Why JobHierance?</h2>
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
                            <img src="{{ $feedback->user_image ? asset($feedback->user_image) : asset('assets/photos/default_icon.png') }}" alt="User Image">
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
                        <p class="testimonial-author">- {{ $feedback->user_name }}</p>
                    </div>
                </div>
            @empty
                <p>No feedback available at the moment.</p>
            @endforelse
        </div>
    </div>

      <!-- Call to Action -->
      <div class="about-cta">
        <a href="Emp_login.html" class="about-cta-button">Join Our Journey</a>
      </div>
    </div>
  </section>
@endsection
