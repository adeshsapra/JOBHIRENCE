<!DOCTYPE html>
<html lang="en" class="com-register-html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/company.css') }}">
    <title>JOBHIRENCE - Company Registration</title>
</head>
<body class="com-register-body">
    <div class="company-register-page-wrapper">
        <div class="company-register-container">
            <div class="company-register-login-branding">
                <div class="company-register-brand-overlay"></div>
                <div class="company-register-logo-container">
                    <div class="company-register-logo">JOBHIRENCE</div>
                </div>
                <div class="company-register-brand-content">
                    <h1>Join JOBHIRENCE and Optimize Hiring</h1>
                    <p>Create an account to streamline recruitment, manage job postings, and connect with top talent.</p>
                    
                    <div class="company-register-brand-features">
                        <div class="company-register-feature-item">
                            <div class="company-register-feature-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="company-register-feature-text">Advanced Talent Management</div>
                        </div>
                        <div class="company-register-feature-item">
                            <div class="company-register-feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="company-register-feature-text">Data-Driven Insights</div>
                        </div>
                        <div class="company-register-feature-item">
                            <div class="company-register-feature-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="company-register-feature-text">Effortless Recruitment</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="company-register-login-form-container">
                <div class="company-register-login-form-header">
                    <h2>Register Now</h2>
                    <p>Please enter your details to create an account</p>
                </div>
                
                @if ($errors->has('error'))
                <div class="error-message">
                    {{ $errors->first('error') }}
                </div>
                @endif
                
                <div class="company-register-progress-indicator">
                    <div class="company-register-progress-step company-register-step-1 {{ session('basic_details_completed') ? '' : 'company-register-active' }}"></div>
                    <div class="company-register-progress-step company-register-step-2 {{ session('basic_details_completed') ? 'company-register-active' : '' }}"></div>
                </div>
                
                <div class="company-register-form-wrapper">
                    <form id="company-register-basic-details" action="{{ route('company.registration') }}" method="POST" class="company-register-form-step {{ session('basic_details_completed') ? 'company-register-hidden' : '' }}">
                        @csrf
                        <div class="company-register-step-title">Step 1: Basic Information</div>
                        
                        <div class="company-register-input-group">
                            <label for="company-register-company-name">Company Name <span style="color: red;">*</span></label>
                            <div class="company-register-input-wrapper">
                                <i class="fas fa-building company-register-input-icon"></i>
                                <input type="text" id="company-register-company-name" name="c_name" class="company-register-form-control @error('c_name') is-invalid @enderror" placeholder="Enter Company Name" value="{{ old('c_name') ?? session('basic_details.c_name') }}" >
                                @error('c_name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="company-register-input-group">
                            <label for="company-register-email">Official Email ID <span style="color: red;">*</span></label>
                            <div class="company-register-input-wrapper">
                                <i class="fas fa-envelope company-register-input-icon"></i>
                                <input type="email" id="company-register-email" name="c_email" class="company-register-form-control @error('c_email') is-invalid @enderror" placeholder="Enter Email ID" value="{{ old('c_email') ?? session('basic_details.c_email') }}" >
                                @error('c_email')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="company-register-input-group">
                            <label for="company-register-password">Create Password <span style="color: red;">*</span></label>
                            <div class="company-register-input-wrapper">
                                <i class="fas fa-lock company-register-input-icon"></i>
                                <input type="password" id="company-register-password" name="c_password" class="company-register-form-control @error('c_password') is-invalid @enderror" placeholder="Enter Password" >
                                <button type="button" class="company-register-toggle-password" onclick="companyRegisterTogglePassword()">
                                    <i class="fa-solid fa-eye" id="company-register-password-toggle-icon"></i>
                                </button>
                                @error('c_password')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="company-register-login-btn">
                            Continue
                            <i class="fas fa-spinner company-register-loading-indicator" id="company-register-login-spinner"></i>
                        </button>
                        
                        <div class="company-register-register-link">
                            <p>Already have an account? <a href="{{ route('company.login') }}">Login</a></p>
                        </div>
                    </form>
                    
                    <form id="company-register-company-details" action="{{ route('company.registration') }}" method="POST" class="company-register-form-step {{ session('basic_details_completed') ? '' : 'company-register-hidden' }}">
                        @csrf
                        <button type="button" class="company-register-back-btn" id="company-register-backBtn">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                        
                        <div class="company-register-step-title">Step 2: Company Information</div>
                        
                        <div class="company-register-form-grid">
                            <div class="company-register-input-group">
                                <label for="company-register-industry">Industry Type <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-industry company-register-input-icon"></i>
                                    <input type="text" id="company-register-industry" name="c_industry" class="company-register-form-control @error('c_industry') is-invalid @enderror" value="{{ old('c_industry') }}" placeholder="Enter Industry" >
                                    @error('c_industry')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-size">Company Size</label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-users company-register-input-icon"></i>
                                    <select id="company-register-size" name="c_size" class="company-register-form-control @error('c_size') is-invalid @enderror">
                                        <option value="" disabled selected>Select Size</option>
                                        <option value="1-10" {{ old('c_size') == '1-10' ? 'selected' : '' }}>1-10 Employees</option>
                                        <option value="11-50" {{ old('c_size') == '11-50' ? 'selected' : '' }}>11-50 Employees</option>
                                        <option value="51-200" {{ old('c_size') == '51-200' ? 'selected' : '' }}>51-200 Employees</option>
                                        <option value="201-500" {{ old('c_size') == '201-500' ? 'selected' : '' }}>201-500 Employees</option>
                                        <option value="501-1000" {{ old('c_size') == '501-1000' ? 'selected' : '' }}>501-1000 Employees</option>
                                        <option value="1001+" {{ old('c_size') == '1001+' ? 'selected' : '' }}>1000+ Employees</option>
                                    </select>
                                    @error('c_size')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-established">Established Year <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-calendar company-register-input-icon"></i>
                                    <input type="text" id="company-register-established" name="c_established_year" class="company-register-form-control @error('c_established_year') is-invalid @enderror" value="{{ old('c_established_year') }}" placeholder="Enter Year" >
                                    @error('c_established_year')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-company-type">Company Type <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-briefcase company-register-input-icon"></i>
                                    <input type="text" id="company-register-company-type" name="c_type" class="company-register-form-control @error('c_type') is-invalid @enderror" value="{{ old('c_type') }}" placeholder="Enter Company Type" >
                                    @error('c_type')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-city">City <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-city company-register-input-icon"></i>
                                    <input type="text" id="company-register-city" name="c_city" class="company-register-form-control @error('c_city') is-invalid @enderror" value="{{ old('c_city') }}" placeholder="Enter City" >
                                    @error('c_city')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-country">Country <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-globe company-register-input-icon"></i>
                                    <input type="text" id="company-register-country" name="c_country" class="company-register-form-control @error('c_country') is-invalid @enderror" value="{{ old('c_country') }}" placeholder="Enter Country" >
                                    @error('c_country')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-postal">Zip/Postal Code <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-map-pin company-register-input-icon"></i>
                                    <input type="text" id="company-register-postal" name="c_postal_code" class="company-register-form-control @error('c_postal_code') is-invalid @enderror" value="{{ old('c_postal_code') }}" placeholder="Enter Zip/Postal Code" >
                                    @error('c_postal_code')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group">
                                <label for="company-register-website">Website</label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-link company-register-input-icon"></i>
                                    <input type="url" id="company-register-website" name="c_website" class="company-register-form-control @error('c_website') is-invalid @enderror" value="{{ old('c_website') }}" placeholder="Enter Website URL">
                                    @error('c_website')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="company-register-input-group company-register-grid-full">
                                <label for="company-register-address">Address <span style="color: red;">*</span></label>
                                <div class="company-register-input-wrapper">
                                    <i class="fas fa-map-marker-alt company-register-input-icon"></i>
                                    <textarea id="company-register-address" name="c_address" class="company-register-form-control @error('c_address') is-invalid @enderror" placeholder="Enter Address" rows="2" >{{ old('c_address') }}</textarea>
                                    @error('c_address')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="company-register-login-btn">
                            Complete Registration
                            <i class="fas fa-spinner company-register-loading-indicator" id="company-register-submit-spinner"></i>
                        </button>
                        
                        <div class="company-register-register-link">
                            <p>Already have an account? <a href="{{ route('company.login') }}">Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function companyRegisterTogglePassword() {
            const passwordInput = document.getElementById('company-register-password');
            const toggleIcon = document.getElementById('company-register-password-toggle-icon');
            
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
        // Handle the back button click
        document.getElementById('company-register-backBtn').addEventListener('click', function() {
            // Redirect to clear the session and go back to first step
            window.location.href = "{{ route('company.register.reset') }}";
        });
    </script>
</body>
</html>