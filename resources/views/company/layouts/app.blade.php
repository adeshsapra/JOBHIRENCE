<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Company Profile - JOBHIERANCE</title>
    <link rel="stylesheet" href="{{ asset('assets/css/company.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    @yield('customCss')
</head>
<body>

    <!-- Header Section -->
    <header class="company-header-part-container">
        <div class="company-header-part-left">
            @php
                $company = Auth::guard('company')->user();
                $companyDetails = DB::table('company_details')->where('company_id', $company->id)->first();
            @endphp
    
            <h2><i class="fas fa-landmark"></i> {{ $company->c_name ?? 'Company Name' }}</h2>
        </div>
        <div class="company-header-part-right">
            <div class="notification-wrapper">
                <a href="#" class="notification-btn">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span> <!-- Example badge -->
                </a>
            </div>
            <div class="profile-dropdown">
                <button class="profile-btn" id="profileDropdownBtn">
                    @if(isset($companyDetails->profile_img))
                    <img src="{{ asset('uploads/company_profile/' . $companyDetails->profile_img) }}" 
                        alt="Company Logo" class="company-header-part-logo">
                @else
                    <img src="{{ asset('uploads/company_profile/default_icon.png') }}" 
                        alt="Default Logo" class="company-header-part-logo">
                @endif
                    <i class="fas fa-chevron-down"></i>
                </button>
                <ul class="dropdown-menu" id="profileDropdown">
                    <li><a href="{{ route('company.profile') }}"><i class="fas fa-user"></i> Profile</a></li>
                    <li><a href="{{ route('company.settings') }}"><i class="fas fa-cog"></i> Settings</a></li>
                    <li><a href="{{ route('company.companyLogout') }}" class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a></li>
                </ul>
            </div>
        </div>
    </header>
    

      <div class="company-profile-sidebar">
        <h2>JOBHIERANCE</h2>
        <ul>
            <li><a href="{{ route('company.dashboard') }}">Dashboard</a></li>
            <li><a href="{{ route('company.jobs') }}">Jobs</a></li>
            <li><a href="{{ route('company.applications') }}">Applications</a></li>
            <li><a href="{{ route('company.profile') }}">Company Profile</a></li>
            <li><a href="{{ route('company.settings') }}">Settings</a></li>
            <li><a href="#notifications">Notifications</a></li>
			<li><a href="{{ route('company.companyLogout') }}">Logout</a></li>
        </ul>
    </div>

    @yield('main')

    <script src="{{ asset('assets/js/company_panel.js') }}"></script>
    <script>
            
        document.addEventListener("DOMContentLoaded", function () {
            const profileBtn = document.getElementById("profileDropdownBtn");
            const dropdownMenu = document.getElementById("profileDropdown");

            profileBtn.addEventListener("click", function (event) {
                event.stopPropagation(); // Prevents click from immediately closing the menu
                dropdownMenu.classList.toggle("show");
            });

            // Hide dropdown when clicking outside
            document.addEventListener("click", function (event) {
                if (!profileBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.remove("show");
                }
            });
        });

    </script>
    @yield('customJs')
</body>
</html>