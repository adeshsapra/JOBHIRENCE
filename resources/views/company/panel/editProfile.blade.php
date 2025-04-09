@extends('company.layouts.app')

@section('main')
<div class="edit-company-profile-container">
    <div class="edit-company-profile-header">
        <h1>Edit Company Profile</h1>
    </div>

    @include('front.backBreadCrumb')
    
    @include('front.alertMessage')

    <div class="edit-company-profile-content">
        <div class="edit-company-profile-images-section">
            <!-- Profile Picture Section -->
            <div class="edit-company-profile-photo-section">
                <h2>Profile Picture</h2>
                <div class="edit-company-profile-picture">
                    <img src="{{ asset('uploads/company_profile/' . ($companyDetails->profile_img ?? 'default_icon.png')) }}" alt="Company Logo" class="edit-company-profile-logo">
                    <form action="{{ route('company.update.profile.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="profile_img" class="edit-company-profile-upload-logo" >
                        <button type="submit" class="edit-company-image-update-btn">Update Profile Picture</button>
                    </form>
                </div>
            </div>

            <!-- Cover Photo Section -->
            <div class="edit-company-profile-photo-section">
                <h2>Cover Photo</h2>
                <div class="edit-company-profile-cover">
                    <img src="{{ asset('uploads/company_cover/' . ($companyDetails->cover_img ?? 'default_icon.png')) }}" 
                         alt="Company Cover" class="edit-company-profile-cover-img">
                    <form action="{{ route('company.update.cover.image') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="file" name="cover_img" class="edit-company-profile-upload-cover" >
                        <button type="submit" class="edit-company-image-update-btn">Update Cover Photo</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Company Name Section -->
        <div class="edit-company-profile-section">
            <h2>Company Name</h2>
            <form action="{{ route('company.update.name') }}" method="POST">
                @csrf
                <input type="text" name="c_name" class="edit-company-profile-input" value="{{ $company->c_name }}" >
                <button type="submit" class="edit-company-profile-update-btn">Update Company Name</button>
            </form>
        </div>

        <!-- Company Type Section -->
        <div class="edit-company-profile-section">
            <h2>Company Type</h2>
            <form action="{{ route('company.update.type') }}" method="POST">
                @csrf
                <input type="text" name="c_type" class="edit-company-profile-input" value="{{ $company->c_type }}" >
                <button type="submit" class="edit-company-profile-update-btn">Update Company Type</button>
            </form>
        </div>

        <!-- Market Type Section -->
        <div class="edit-company-profile-section">
            <h2>Market Type</h2>
            <form action="{{ route('company.update.market') }}" method="POST">
                @csrf
                <input type="text" name="market_type" class="edit-company-profile-input" 
                       value="{{ $companyDetails->market_type }}" placeholder="| B2C | B2B | B2G |" >
                <button type="submit" class="edit-company-profile-update-btn">Update Market Type</button>
            </form>
        </div>

        <!-- About Section -->
        <div class="edit-company-profile-section">
            <h2>About the Company</h2>
            <form action="{{ route('company.update.about') }}" method="POST">
                @csrf
                <textarea name="about" class="edit-company-profile-textarea" >{{ $companyDetails->about }}</textarea>
                <button type="submit" class="edit-company-profile-update-btn">Update About Info</button>
            </form>
        </div>

        <!-- Key Information Section -->
        <div class="edit-company-profile-section">
            <h2>Key Information</h2>
            <form action="{{ route('company.update.keyinfo') }}" method="POST">
                @csrf
                <div class="company-profile-info-grid">
                    <div class="company-profile-info-card">
                        <label>Industry:</label>
                        <input type="text" name="c_industry" class="edit-company-profile-input" 
                               value="{{ $company->c_industry }}">
                    </div>
                    <div class="company-profile-info-card">
                        <label>Founded:</label>
                        <input type="number" name="c_established_year" class="edit-company-profile-input" 
                               value="{{ $company->c_established_year }}">
                    </div>
                    <div class="company-profile-info-card">
                        <label>Headquarters:</label>
                        <input type="text" name="headquarters" class="edit-company-profile-input" 
                               value="{{ $companyDetails->headquarters }}">
                    </div>
                    <div class="company-profile-info-card">
                        <label>Employees:</label>
                        <input type="text" name="c_size" class="edit-company-profile-input" 
                               value="{{ $company->c_size }}">
                    </div>
                    <div class="company-profile-info-card">
                        <label>Type:</label>
                        <select name="c_type" class="edit-company-profile-select">
                            <option value="Private" {{ $company->c_type == 'Private' ? 'selected' : '' }}>Private</option>
                            <option value="Public" {{ $company->c_type == 'Public' ? 'selected' : '' }}>Public</option>
                        </select>
                    </div>
                    <div class="company-profile-info-card">
                        <label>Website:</label>
                        <input type="url" name="c_website" class="edit-company-profile-input" 
                               value="{{ $company->c_website }}">
                    </div>
                </div>
                <button type="submit" class="edit-company-profile-update-btn">Update Key Info</button>
            </form>
        </div>

        <!-- Contact Information Section -->
        <div class="edit-company-profile-section">
            <h2>Contact Information</h2>
            <form action="{{ route('company.update.contact') }}" method="POST">
                @csrf
                <label>Email</label>
                <input type="email" name="contact_email" class="edit-company-profile-input" value="{{ $companyDetails->contact_email }}" >
                <label>Phone</label>
                <input type="tel" name="contact_phone" class="edit-company-profile-input" value="{{ $companyDetails->phone }}" >
                <label>Address</label>
                <textarea name="c_address" class="edit-company-profile-textarea" >{{ $company->c_address }}</textarea>
                <button type="submit" class="edit-company-profile-update-btn">Update Contact Info</button>
            </form>
        </div>

        <!-- Social Media Links -->
        <div class="edit-company-profile-section">
            <h2>Social Media Links</h2>
            <form action="{{ route('company.update.social') }}" method="POST">
                @csrf
                <label>Facebook</label>
                <input type="url" name="facebook" class="edit-company-profile-input" 
                       value="{{ $companyDetails->facebook }}">
                <label>Twitter</label>
                <input type="url" name="twitter" class="edit-company-profile-input" 
                       value="{{ $companyDetails->twitter }}">
                <label>LinkedIn</label>
                <input type="url" name="linkedin" class="edit-company-profile-input" 
                       value="{{ $companyDetails->linkedin }}">
                <label>Instagram</label>
                <input type="url" name="instagram" class="edit-company-profile-input" 
                       value="{{ $companyDetails->instagram }}">
                <button type="submit" class="edit-company-profile-update-btn">Update Social Links</button>
            </form>
        </div>
    </div>
</div>
@endsection