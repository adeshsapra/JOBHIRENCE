@extends('company.layouts.app')

@section('main')
<div class="company-panel-menu-header">
    <h1 class="company-panel-menu-heading">- Account Settings -</h1>
</div>

<div class="company-settings-account">
    
    @include('front.alertMessage')

    <!-- Email Section -->
    <div class="company-settings-section" id="email-section">
        <div class="company-settings-header-title">
            <strong><i class="fas fa-envelope"></i> Email</strong>
        </div>
        <div class="company-settings-status">
            <p>{{ $company->c_email }}</p> <!-- Display current email -->
            <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Green Tick" title="Valid Email">
        </div>

        <!-- Email Form -->
        <form action="{{ route('company.update.email') }}" method="POST">
            @csrf
            <div id="email-input-section" class="company-settings-input-section">
                <label for="email">Change Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $company->c_email) }}" placeholder="Enter your new email"
                    class="@error('email') is-invalid @enderror">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="company-settings-buttons">
                    <button type="button" class="company-settings-cancel-btn">Cancel</button>
                    <button type="submit" class="company-settings-save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Phone Section -->
    <div class="company-settings-section" id="company-settings-mobile-section">
        <div class="company-settings-header-title">
            <strong><i class="fas fa-phone"></i> Phone</strong>
        </div>
        <div class="company-settings-status">
            <p>+91 {{ $companyDetails->phone ?? 'Not set' }}</p> <!-- Display current phone -->
            <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Green Tick" title="Valid Number">
        </div>

        <!-- Phone Form -->
        <form action="{{ route('company.update.phone') }}" method="POST">
            @csrf
            <div id="company-settings-mobile-input-section" class="company-settings-input-section">
                <label for="company-settings-mobile">Mobile Number</label>
                <input type="text" id="company-settings-mobile" name="phone" placeholder="Enter your mobile number"
                    class="@error('phone') is-invalid @enderror">
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="company-settings-buttons">
                    <button type="button" class="company-settings-cancel-btn">Cancel</button>
                    <button type="submit" class="company-settings-save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Password Section -->
    <div class="company-settings-section" id="company-settings-password-section">
        <div class="company-settings-header-title">
            <strong><i class="fas fa-key"></i> Password</strong>
        </div>
        
        <!-- Password Form -->
        <form action="{{ route('company.update.password') }}" method="POST">
            @csrf
            <div id="company-settings-password-input-section" class="company-settings-input-section">
                <label for="company-settings-old-password">Old Password</label>
                <input type="password" id="company-settings-old-password" name="current_password" placeholder="Enter old password"
                    class="@error('current_password') is-invalid @enderror">
                @error('current_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="company-settings-new-password">New Password</label>
                <input type="password" id="company-settings-new-password" name="new_password" placeholder="Enter new password"
                    class="@error('new_password') is-invalid @enderror">
                @error('new_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <label for="company-settings-confirm-password">Confirm New Password</label>
                <input type="password" id="company-settings-confirm-password" name="new_password_confirmation" placeholder="Confirm new password"
                    class="@error('new_password_confirmation') is-invalid @enderror">
                @error('new_password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                <div class="company-settings-buttons">
                    <button type="button" class="company-settings-cancel-btn">Cancel</button>
                    <button type="submit" class="company-settings-save-btn">Save</button>
                </div>
            </div>
        </form>
    </div>

</div>
@endsection

