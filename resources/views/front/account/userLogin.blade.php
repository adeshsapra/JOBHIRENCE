<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>JobHirence - Premium Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body class="user-login-main-body">
  <div class="user-login-container">
    <!-- Left Panel - Brand -->
    <div class="user-login-brand-panel">
      <div class="user-login-brand-background"></div>
      <div class="user-login-brand-overlay">
        <div class="user-login-shape-one"></div>
        <div class="user-login-shape-two"></div>
        <div class="user-login-shape-three"></div>
        <div class="user-login-dots-pattern"></div>
      </div>
      <div class="user-login-brand-content">
        <div class="user-login-logo-container">
          <div class="user-login-logo-text">JOB<span>HIRENCE</span></div>
        </div>
      
        <h1 class="user-login-headline">Find Top<span class="user-login-highlight"> Opportunities</span>, Hire with <span class="user-login-highlight">Ease</span></h1>
        <p class="user-login-tagline">Discover the perfect job or hire the best professionals with our seamless recruitment platform.</p>
      
        <div class="user-login-features-container">
          <div class="user-login-feature-card">
            <div class="user-login-feature-icon">
              <i class="fas fa-search"></i>
            </div>
            <div class="user-login-feature-content">
              <h3 class="user-login-feature-title">Smart Job Search</h3>
              <p class="user-login-feature-description">Find jobs that match your skills and preferences in just a few clicks.</p>
            </div>
          </div>
      
          <div class="user-login-feature-card">
            <div class="user-login-feature-icon">
              <i class="fas fa-robot"></i>
            </div>
            <div class="user-login-feature-content">
              <h3 class="user-login-feature-title">AI Matching</h3>
              <p class="user-login-feature-description">AI connects job seekers with opportunities and employers with talent.</p>
            </div>
          </div>
      
          <div class="user-login-feature-card">
            <div class="user-login-feature-icon">
              <i class="fas fa-bell"></i>
            </div>
            <div class="user-login-feature-content">
              <h3 class="user-login-feature-title">Real-Time Alerts</h3>
              <p class="user-login-feature-description">Stay updated with job openings and application statuses instantly.</p>
            </div>
          </div>
      
          <div class="user-login-feature-card">
            <div class="user-login-feature-icon">
              <i class="fas fa-lock"></i>
            </div>
            <div class="user-login-feature-content">
              <h3 class="user-login-feature-title">Secure & Reliable</h3>
              <p class="user-login-feature-description">Your data is protected with enterprise-grade security measures.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Right Panel - Form -->
    <div class="user-login-form-panel">
      <div class="user-login-welcome-back">
        <span class="user-login-welcome-emoji">👋</span>
        <span class="user-login-welcome-text">Welcome back</span>
      </div>
      <div class="user-login-form-header">
        <h2 class="user-login-form-title">Sign in to your account</h2>
        <p class="user-login-form-subtitle">Enter Your Credentials To Access Your JobHirence Account.</p>
      </div>
      
      @include('front.alertMessage')
      
      <form method="POST" action="{{ route('account.userAuthenticate') }}">
        @csrf
        
        <div class="user-login-form-group">
          <label for="email">Email Address <span class="user-login-required">*</span></label>
          <div class="user-login-input-wrapper">
            <i class="user-login-input-icon fas fa-envelope"></i>
            <input 
              type="email" 
              id="email" 
              name="email"
              value="{{ old('email') }}" 
              class="user-login-form-control {{ $errors->has('email') ? 'error-input' : '' }}" 
              placeholder="user@email.com"
            >
          </div>
          @if ($errors->has('email'))
            <div class="error-message">
              {{ $errors->first('email') }}
            </div>
          @endif
        </div>
        
        <div class="user-login-form-group">
          <label for="password">Password <span class="user-login-required">*</span></label>
          <div class="user-login-input-wrapper">
            <i class="user-login-input-icon fas fa-lock"></i>
            <input 
              type="password" 
              id="password" 
              name="password" 
              class="user-login-form-control {{ $errors->has('password') ? 'error-input' : '' }}" 
              placeholder="••••••••" 
              minlength="8"
            >
            <i class="user-login-password-toggle fas fa-eye" id="togglePassword"></i>
          </div>
          @if ($errors->has('password'))
            <div class="error-message">
              {{ $errors->first('password') }}
            </div>
          @endif
        </div>
        
        <div class="user-login-remember-forgot-row">
          <div class="user-login-remember-me">
            <div class="user-login-checkbox-wrapper">
              <input type="checkbox" id="remember" name="remember" class="user-login-custom-checkbox">
              <label for="remember" class="user-login-checkbox-label">Remember me</label>
            </div>
          </div>
          <a href="{{ route('account.showForgotPasswordForm') }}" class="user-login-forgot-password">Forgot password?</a>
        </div>
        
        <button type="submit" class="user-login-login-btn">Sign in<i class="fas fa-arrow-right"></i></button>
      </form>

      
      
      <div class="user-login-divider">
        <div class="user-login-divider-line"></div>
        <span class="user-login-divider-text">OR</span>
        <div class="user-login-divider-line"></div>
      </div>

      <div class="user-login-social-login">
        <a href="{{ route('login.google') }}" class="user-login-social-btn google">
          <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
            <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/>
            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
          </svg>
        </a>
        <a href="{{ route('login.github') }}" class="user-login-social-btn github">
          <svg width="18" height="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
            <path fill="currentColor" d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.92.42.36.81 1.096.81 2.22 0 1.606-.015 2.896-.015 3.286 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/>
          </svg>
        </a>
      </div>

      
      <div class="user-login-register-link">
        Don't have an account? <a href="{{ route('account.userRegistration') }}">Create Account</a>
      </div>
    </div>
  </div>

  <script>
    // Toggle password visibility
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
      }
    });
  </script>
</body>
</html>