<!DOCTYPE html>
<html lang="en" class="company-login-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/company.css') }}">
    <title>JOBHIRENCE - Company Panel Login</title>
</head>
<body>
    <div class="company-main-login-page">
        <div class="company-login-page-wrapper">
            <div class="company-login-container">
                <div class="company-login-branding">
                    <div class="company-login-brand-overlay"></div>
                    <div class="company-login-logo-container">
                        <div class="company-login-logo">JOBHIRENCE</div>
                    </div>
                    <div class="company-login-brand-content">
                        <h1>Optimize Your Hiring with JobHirence</h1>
                        <p>Access your dashboard to manage jobs, view applicants, and grow your team with top talent.</p>
                        
                        <div class="company-login-brand-features">
                            <div class="company-login-feature-item">
                                <div class="company-login-feature-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="company-login-feature-text">Talent management tools</div>
                            </div>
                            <div class="company-login-feature-item">
                                <div class="company-login-feature-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="company-login-feature-text">Analytics and insights</div>
                            </div>
                            <div class="company-login-feature-item">
                                <div class="company-login-feature-icon">
                                    <i class="fas fa-handshake"></i>
                                </div>
                                <div class="company-login-feature-text">Seamless recruitment</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="company-login-form-container">
                    <div class="company-login-form-header">
                        <h2>Sign in to dashboard</h2>
                        <p>Please enter your credentials to continue</p>
                    </div>
                    
                    @include('front.alertMessage')
                    
                    <form id="loginForm" action="{{ route('company.login') }}" method="POST">
                        @csrf
                        
                        <div class="company-login-input-group">
                            <label for="email">Email ID <span style="color: red;">*</span></label>
                            <div class="company-login-input-wrapper">
                                <i class="fas fa-envelope company-login-input-icon"></i>
                                <input type="email" name="email" id="email" class="company-login-form-control @error('email') error-border @enderror" placeholder="your@company.com" value="{{ old('email') }}">
                            </div>
                            <span class="error-message">@error('email') {{ $message }} @enderror</span>
                        </div>
                        
                        <div class="company-login-input-group">
                            <label for="password">Password <span style="color: red;">*</span></label>
                            <div class="company-login-input-wrapper">
                                <i class="fas fa-lock company-login-input-icon"></i>
                                <input type="password" name="password" id="password" class="company-login-form-control @error('password') error-border @enderror" placeholder="Enter your password">
                                <button type="button" class="company-login-toggle-password" onclick="togglePassword()">
                                    <i class="fa-solid fa-eye" id="company-login-password-toggle-icon"></i>
                                </button>
                            </div>
                            <span class="error-message">@error('password') {{ $message }} @enderror</span>
                        </div>
                        
                        <div class="company-login-options">
                            <label class="company-login-custom-checkbox">
                                Remember me
                                <input type="checkbox" name="remember" id="company-login-remember-me" checked="checked">
                                <span class="company-login-checkmark"></span>
                            </label>
                            <div class="company-login-forgot-password">
                                <a href="" id="company-login-forgot-password-link">Forgot password?</a>
                            </div>
                        </div>
                        
                        <button type="submit" class="company-login-btn" id="company-login-button">
                            Sign in to Dashboard
                            <i class="fas fa-spinner company-login-loading-indicator" id="company-login-spinner"></i>
                        </button>
                        
                        <div class="company-login-divider">
                            <span>OR</span>
                        </div>
                        
                        <div class="company-login-social-login">
                            <p>Don't have an account?</p>
                            <a href="{{ route('company.register') }}" class="company-login-social-btn ">Create Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('company-login-password-toggle-icon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        // Function placeholder for OTP modal
        function openOTPModal() {
            // Implementation for OTP modal will go here
            console.log("OTP modal functionality to be implemented");
        }
    </script>
</body>
</html>