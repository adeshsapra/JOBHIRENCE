<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <style>
        .error-border {
            border: 1px solid red !important;
        }

        .admin-signup-section-error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="admin-register-main-container">
        <div class="admin-signup-section-container">
            <div class="admin-signup-section-card">
                <div class="admin-signup-section-header">
                    <div class="admin-signup-section-logo">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h1>Create Admin Account</h1>
                    <p>Fill in your details to get started</p>
                </div>

                @include('front.alertMessage')

                <form method="POST" action="{{ route('admin.register') }}">
                    @csrf
                    <div class="admin-signup-section-form-group">
                        <label for="name">Name</label>
                        <div class="admin-signup-section-input-wrapper">
                            <i class="fas fa-user"></i>
                            <input 
                                type="text" 
                                id="admin-signup-section-name" 
                                name="name"
                                placeholder="Enter your full name"
                                value="{{ old('name') }}"
                                class="{{ $errors->has('name') ? 'error-border' : '' }}"
                            >
                        </div>
                        @if($errors->has('name'))
                            <div class="admin-signup-section-error-message">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
    
                    <div class="admin-signup-section-form-group">
                        <label for="email">Email Address</label>
                        <div class="admin-signup-section-input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input 
                                type="email" 
                                id="admin-signup-section-email" 
                                name="email"
                                placeholder="Enter your email"
                                value="{{ old('email') }}"
                                class="{{ $errors->has('email') ? 'error-border' : '' }}"
                            >
                        </div>
                        @if($errors->has('email'))
                            <div class="admin-signup-section-error-message">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
    
                    <div class="admin-signup-section-form-group">
                        <label for="password">Password</label>
                        <div class="admin-signup-section-input-wrapper">
                            <i class="fas fa-lock" id="admin-signup-section-togglePassword"></i>
                            <input 
                                type="password" 
                                id="admin-signup-section-password" 
                                name="password"
                                placeholder="Create password"
                                class="{{ $errors->has('password') ? 'error-border' : '' }}"
                            >
                        </div>
                        @if($errors->has('password'))
                            <div class="admin-signup-section-error-message">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
    
                    <button type="submit" class="admin-signup-section-button">
                        <i class="fas fa-user-plus"></i>
                        Create Account
                    </button>
    
                    <div class="admin-signup-section-login-link">
                        Already have an account?<a href="{{ route('admin.login') }}">Sign in</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
    // Toggle password visibility
    document.getElementById('admin-signup-section-togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('admin-signup-section-password');
        const fieldType = passwordInput.getAttribute('type');
        
        if (fieldType === 'password') {
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