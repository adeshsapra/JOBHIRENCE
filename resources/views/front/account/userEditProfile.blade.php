{{-- 
@extends('front.layouts.app')

@section('main')
<div class="profile-container">
    <!-- Header Section -->
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-header">
            <img id="profileImage" src="https://i.pravatar.cc/150?img=7" alt="Profile Picture">
            <div class="profile-picture-section">
                <label for="profilePicInput">+</label>
                <input type="file" id="profilePicInput" name="profile_picture" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="profile-info">
                <h2>Update Profile Photo</h2>
                <button type="submit" class="update-photo-btn">Update Photo</button>
            </div>
        </div>
    </form>

    <!-- Profile Information Section -->
    <form action="" id="userInfoForm" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">My Profile</h3>
            <input type="text" name="full_name" class="section-input" placeholder="Full Name" value="{{ Auth::user()->fullName }}">
            <input type="email" name="email" class="section-input" placeholder="Email" value="{{ Auth::user()->email }}">
            <input type="text" name="designation" class="section-input" placeholder="Designation" value="{{ Auth::user()->designation }}">
            <input type="text" name="mobile" class="section-input" placeholder="Mobile" value="{{ Auth::user()->mobile_number }}">
            <textarea name="bio" class="section-input" placeholder="Bio" value="{{ Auth::user()->bio }}"></textarea>
            <button type="submit" class="update-btn">Update</button>
        </div>
    </form>

    <!-- Education Section -->
    <form action="" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Education</h3>
            <input type="text" name="degree" class="section-input" placeholder="Degree">
            <input type="text" name="university" class="section-input" placeholder="University">
            <input type="text" name="graduation_year" class="section-input" placeholder="Graduation Year">
            <button type="submit" class="update-btn">Update Education</button>
        </div>
    </form>

    <!-- Location Section -->
    <form action="" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Location</h3>
            <input type="text" name="city" class="section-input" placeholder="Enter Your City">
            <input type="text" name="state" class="section-input" placeholder="Enter Your State">
            <button type="submit" class="update-btn">Update Location</button>
        </div>
    </form>

    <!-- Skills Section -->
    <form action="" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Skills</h3>
            <input type="text" name="skills" class="section-input" placeholder="Enter your Skills">
            <button type="submit" class="update-btn">Update Skills</button>
        </div>
    </form>

    <!-- Upload Resume Section -->
    <form action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Upload Resume</h3>
            <input type="file" name="resume" class="section-input" id="resumeUpload" accept=".pdf,.doc,.docx">
            <button type="submit" class="update-btn">Upload Resume</button>
        </div>
    </form>
</div>
@endsection
 --}}

 
@extends('front.layouts.app')
@section('main')
<div class="profile-container">
    <!-- Header Section -->
    <form action="{{ route('account.updateProfileImage') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-header">
            <img id="profileImage" src="{{ Auth::user()->image ? asset(Auth::user()->image) : asset('assets/photos/default_icon.png') }}" alt="Profile Picture">

            <div class="profile-picture-section">
                <label for="profilePicInput">+</label>
                <input type="file" id="profilePicInput" name="profile_image" accept="image/*" onchange="previewImage(event)">
            </div>
            <div class="profile-info">
                <h2>Update Profile Photo</h2>
                <button type="submit" class="update-photo-btn">Update Photo</button>
            </div>
        </div>
    </form>
    
    <!-- Include alerts -->
    @include('front.alertmessage')

    <!-- Profile Information Section -->
    <form action="{{ route('account.userUpdateProfile') }}" id="userInfoForm" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">My Profile</h3>
            
            <div class="form-group">
                <input type="text" name="full_name" class="section-input @error('full_name') error-input @enderror" 
                    placeholder="Full Name" value="{{ old('full_name', Auth::user()->fullName) }}">
                @error('full_name')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="email" name="email" class="section-input @error('email') error-input @enderror" 
                    placeholder="Email" value="{{ old('email', Auth::user()->email) }}">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" name="designation" class="section-input @error('designation') error-input @enderror" 
                    placeholder="Designation" value="{{ old('designation', Auth::user()->designation) }}">
                @error('designation')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" name="mobile" class="section-input @error('mobile') error-input @enderror" 
                    placeholder="Mobile" value="{{ old('mobile', Auth::user()->mobile_number) }}">
                @error('mobile')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <textarea name="bio" class="section-input @error('bio') error-input @enderror" 
                    placeholder="Bio">{{ old('bio', Auth::user()->bio) }}</textarea>
                @error('bio')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="update-btn">Update</button>
        </div>
    </form>

    <!-- Education Section -->
    <form action="{{ route('account.updateEducation') }}" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Education</h3>

            <div class="form-group">
                <input type="text" name="degree" class="section-input @error('degree') error-input @enderror" 
                    placeholder="Degree" value="{{ old('degree', $userDetail->degree ?? '') }}">
                @error('degree')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" name="university" class="section-input @error('university') error-input @enderror" 
                    placeholder="University" value="{{ old('university', $userDetail->university ?? '') }}">
                @error('university')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <input type="text" name="graduation_year" class="section-input @error('graduation_year') error-input @enderror" 
                    placeholder="Graduation Year" value="{{ old('graduation_year', $userDetail->graduation_year ?? '') }}">
                @error('graduation_year')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="update-btn">Update Education</button>
        </div>
    </form>



    <!-- Location Section -->
    <form action="{{ route('account.updateLocation') }}" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Location</h3>
            <div class="form-group">
                <input type="text" name="city" class="section-input @error('city') error-input @enderror" 
                    placeholder="City" value="{{ old('city', $userDetail->city ?? '') }}">
                @error('city')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="state" class="section-input @error('state') error-input @enderror" 
                    placeholder="State" value="{{ old('state', $userDetail->state ?? '') }}">
                @error('state')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="update-btn">Update Location</button>
        </div>
    </form>
        

    <!-- Skills Section -->
    <form action="{{ route('account.updateSkills') }}" method="POST">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Skills</h3>

            <div class="form-group">
                <input type="text" name="skills" class="section-input @error('skills') error-input @enderror" 
                    placeholder="Enter your skills, separated by commas" value="{{ old('skills', $userDetail->skills ?? '') }}">
                @error('skills')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="update-btn">Update Skills</button>
        </div>
    </form>

    <!-- Resumes Section -->
    <form action="{{ route('account.uploadResume') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="profile-section">
            <h3 class="section-header">Upload Resume</h3>
    
            <!-- Resume Upload -->
            <div class="form-group">
                <input type="file" name="resume" class="section-input @error('resume') error-input @enderror" 
                    accept=".pdf,.doc,.docx">
                @error('resume')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
    
            <!-- Current Resume Display -->
            @if(Auth::user()->resume)
                <div class="form-group">
                    <p>Current Resume: 
                        <a href="{{ asset(Auth::user()->resume) }}" target="_blank">Download</a>
                    </p>
                </div>
            @endif
    
            <button type="submit" class="update-btn">Upload Resume</button>
        </div>
    </form>
    

    
</div>
@endsection

@section('customJs')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('profileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
    
@endsection