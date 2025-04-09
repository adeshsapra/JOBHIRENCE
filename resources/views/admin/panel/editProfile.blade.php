@extends('admin.layouts.app')

@section('main')
<div class="admin-edit-section">
    <h1>Edit Profile</h1>
    
    @include('front.alertMessage')

    <div class="admin-edit-container">
        <div class="admin-edit-details">
            <div class="admin-edit-header">
                <!-- Display the profile image -->
                <img src="{{ $admin->profile_img ? asset('admin_photos/' . $admin->profile_img) : asset('assets/photos/default_icon.png') }}" 
                     alt="Admin Avatar" 
                     class="admin-edit-avatar">
                <h2>{{ $admin->name }}</h2>
            </div>

            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="admin-edit-form-group">
                    <label for="profile_img">Choose a new profile picture:</label>
                    <input type="file" id="profile_img" name="profile_img" accept="image/*" class="admin-edit-form-control @error('profile_img') is-invalid @enderror">
                    @error('profile_img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="admin-edit-form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $admin->name) }}" class="admin-edit-form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="admin-edit-form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $admin->email) }}" class="admin-edit-form-control @error('email') is-invalid @enderror">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="admin-edit-btn-submit">Update Details</button>
            </form>
        </div>

        <div class="admin-edit-password">
            <h2>Change Password</h2>
            <form action="{{ route('admin.password.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="admin-edit-form-group">
                    <label for="current_password">Current Password:</label>
                    <input type="password" id="current_password" name="current_password" class="admin-edit-form-control @error('current_password') is-invalid @enderror">
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="admin-edit-form-group">
                    <label for="new_password">New Password:</label>
                    <input type="password" id="new_password" name="new_password" class="admin-edit-form-control @error('new_password') is-invalid @enderror">
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="admin-edit-form-group">
                    <label for="new_password_confirmation">Confirm New Password:</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="admin-edit-form-control @error('new_password_confirmation') is-invalid @enderror">
                    @error('new_password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="admin-edit-btn-submit">Update Password</button>
            </form>
        </div>
    </div>
</div>
@endsection