<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">

    <style>
        .error-border {
            border: 1px solid red !important;
        }

        .admin-login-section-error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-login-main-container">
        <div class="admin-login-section-login-container">
            <div class="admin-login-section-login-card">
                <div class="admin-login-section-login-header">
                    <div class="admin-login-section-logo">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h1>JobHirence Admin</h1>
                    <p>Enter your credentials to access your account</p>

                    @include('front.alertMessage')
                </div>

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf
                    <div class="admin-login-section-form-group">
                        <label for="email">Email Address</label>
                        <div class="admin-login-section-input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input 
                                type="email" 
                                id="admin-login-section-email" 
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                class="{{ $errors->has('email') ? 'error-border' : '' }}"
                            >
                        </div>
                        @error('email')
                            <div class="admin-login-section-error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="admin-login-section-form-group">
                        <label for="password">Password</label>
                        <div class="admin-login-section-input-wrapper">
                            <i class="fas fa-lock" id="admin-login-section-togglePassword"></i>
                            <input 
                                type="password" 
                                id="admin-login-section-password" 
                                name="password"
                                placeholder="Enter your password"
                                class="{{ $errors->has('password') ? 'error-border' : '' }}"
                            >
                        </div>
                        @error('password')
                            <div class="admin-login-section-error-message">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="admin-login-section-options-group">
                        <a href="#" class="admin-login-section-forgot-password">Forgot Password?</a>
                    </div>

                    <button type="submit" class="admin-login-section-login-button">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </button>

                    {{-- <div class="admin-login-section-register-link">
                        Don't have an account?<a href="{{ route('admin.register') }}">Create account</a>
                    </div> --}}
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('admin-login-section-togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('admin-login-section-password');
            const passwordFieldType = passwordInput.getAttribute('type');
        
            if (passwordFieldType === 'password') {
                passwordInput.setAttribute('type', 'text');
                this.classList.remove('fa-lock');
                this.classList.add('fa-unlock');
            } else {
                passwordInput.setAttribute('type', 'password');
                this.classList.remove('fa-unlock');
                this.classList.add('fa-lock');
            }
        });
    </script>
</body>
</html>