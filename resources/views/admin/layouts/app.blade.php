<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Portal Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('assets/css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    @yield('customCss')
</head>
<body>
    <div class="admin-panel">
        <nav id="admin-sidebar" class="admin-sidebar">
            <div class="admin-sidebar-header">
                <h2 class="admin-sidebar-title">JobHirence Admin</h2>
            </div>
            <ul class="admin-sidebar-menu">
                <li><a href="{{ route('admin.dashboard') }}"><i class="fas fa-chart-bar"></i><span>Dashboard</span></a></li>
                <li><a href="{{ route('admin.jobManagement') }}"><i class="fas fa-briefcase"></i><span>Jobs</span></a></li>
                <li><a href="{{ route('admin.UserManage') }}"><i class="fas fa-users"></i><span>Users</span></a></li>
                <li><a href="{{ route('admin.CompanyManage') }}"><i class="fas fa-building"></i><span>Companies</span></a></li>
                <li><a href="{{ route('admin.Applicationmanage') }}"><i class="fas fa-file-alt"></i><span>Applications</span></a></li>
                <li><a href="{{ route('admin.CategorySkillManage') }}"><i class="fas fa-layer-group"></i><span>Job Criteria</span></a></li>
                <li><a href="{{ route('admin.FeedbackRatingManage') }}"><i class="fas fa-flag"></i><span>Feedback Center </span></a></li>
                <li><a href="admin_settings.html"><i class="fas fa-cogs"></i><span>Site Settings</span></a></li>
            </ul>
        </nav>
        <main class="admin-content">
            <header class="admin-header">
                <div class="admin-header-left">
                    <button id="admin-sidebar-toggle" class="admin-btn-icon" data-toggle="sidebar"><i class="fas fa-bars"></i></button>
                    <div class="admin-search-bar">
                        <input type="text" placeholder="Search...">
                        <button class="admin-btn-icon"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="admin-header-right">
                    <div class="admin-user-menu">
                        <input type="checkbox" id="admin-dropdown-toggle">
                        <label for="admin-dropdown-toggle" class="admin-user-label">
                            @if(Auth::guard('admin')->user()->profile_img)
                                <img src="{{ asset('admin_photos/' . Auth::guard('admin')->user()->profile_img) }}" alt="Admin Avatar" class="admin-avatar">
                            @else
                                <img src="{{ asset('assets/photos/default_icon.png') }}" alt="Admin Avatar" class="admin-avatar">
                            @endif
                            <span>{{ Auth::guard('admin')->user()->name }}</span>
                            <i class="fas fa-chevron-down"></i>
                        </label>
                    
                        <div class="admin-dropdown">
                            <ul>
                                <li><i class="fas fa-user"></i> <a href="{{ route('admin.profile') }}">Profile</a></li>
                                <li><i class="fas fa-cog"></i> <a href="admin_settings.html">Settings</a></li>
                                <li><i class="fas fa-sign-out-alt"></i> <a href="{{ route('admin.logout') }}">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            @yield('main')
            
       </main>
    </div>

    <script src="{{ asset('assets/js/admin.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @yield('customJs')
</body>
</html>
