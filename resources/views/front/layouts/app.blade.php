<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobHirence - Your Career Starts Here</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @yield('customCss')
</head>
<body>

{{-- --------------------header------------------ --}}
<header class="header">
    <div class="container">
        <h1 class="logo">Job<span>Hirence</span></h1>
        <nav class="nav">
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('job') }}">Jobs</a>
            <a href="{{ route('companie') }}">Companies</a>
        </nav>

        {{-- Check if user is authenticated --}}
        @auth
        <div class="menu-wrapper">
            <!-- User Icon -->
            <div class="user-icon" id="user-icon">
                <a href="{{ route('account.userProfile') }}"> 
                    <img id="profileImage" src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('assets/photos/default_icon.png') }}" alt="Profile Picture">
                </a>
            </div>

            <!-- Hamburger Menu Toggle -->
            <div class="toggle-button" id="toggle-button">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
        </div>
        @endauth

        {{-- Show Login, Signup, Logout buttons for guest --}}
        @guest
        <div class="header-actions">
            <div class="login-signup-button">
                <a href="{{ route('account.userLogin') }}">Login</a>
                <a href="{{ route('account.userRegistration') }}">Sign Up</a>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggling">
                    For Companies <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('company.login') }}">Company Access</a>
                    <a href="{{ route('company.register') }}">Join As a Company</a>
                </div>
            </div>
          </div>
        @endguest
    </div>

    <!-- Account Settings Sidebar -->
    @include('front.account.sidebar')

    
</header>

@yield('main')

{{-- --------------------------footer------------------------- --}}
<footer class="modern-footer">
    <div class="footer-top">
        <div class="footer-logo">
            <img src="{{ asset('assets/photos/logo.png') }}" alt="JobHirence Logo" class="logo-image">
            <p>Your career starts here. We connect job seekers with opportunities worldwide.</p>
        </div>
        <div class="footer-links">
            <div class="links-column">
                <h3>Company</h3>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="links-column">
                <h3>Need help ?</h3>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="links-column">
                <h3>Follow Us</h3>
                <ul class="social-links">
                    <li><a href="#" class="linkedin"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                    <li><a href="#" class="twitter"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li><a href="#" class="instagram"><i class="fab fa-instagram"></i> Instagram</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="subscription">
        <p>Stay Updated</p>
        <form class="newsletter-form">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
        </form>
    </div>

    <div class="footer-info">
        <p>&copy; 2024 JobHirence. All rights reserved.</p>
    </div>
</footer>

<script src="{{ asset('assets/js/script.js') }}"></script>
<script src="{{ asset('assets/js/sidebar.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

@yield('customJs')
</body>
</html>
