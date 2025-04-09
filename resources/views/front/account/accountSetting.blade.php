@extends('front.layouts.app')

@section('main')

<div class="account-settings">
    @include('front.backBreadCrumb')
    <h2>Account Settings</h2>

    @include('front.alertMessage')

    <div class="account-settings-section" id="email-section">
        <strong>Email</strong>
        <div class="status">
            <p>{{ $user->email }}</p>
            <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Green Tick" title="Valid Email">
        </div>
        <button class="setting-edit-btn" onclick="toggleSection('email-setting-input-section')">
            <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
        </button>
        <div id="email-setting-input-section" class="hidden setting-input-section">
            <form action="{{ route('account.updateEmail') }}" method="POST">
                @csrf
                <label for="email">Change Email</label>
                <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="Enter your new email">
                <div class="settings-buttons">
                    <button type="button" class="setting-cancel-btn" onclick="toggleSection('email-setting-input-section')">Cancel</button>
                    <button type="submit" class="setting-save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="account-settings-section" id="mobile-section">
        <strong>Mobile Number</strong>
        <div class="status">
            <p>{{ $user->mobile_number }}</p>
            <img src="https://cdn-icons-png.flaticon.com/512/845/845646.png" alt="Green Tick" title="Valid Number">
        </div>
        <button class="setting-edit-btn" onclick="toggleSection('mobile-setting-input-section')">
            <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
        </button>
        <div id="mobile-setting-input-section" class="hidden setting-input-section">
            <form action="{{ route('account.updateMobile') }}" method="POST">
                @csrf
                <label for="mobile">Change Mobile Number</label>
                <input type="text" name="mobile" id="mobile" value="{{ $user->mobile_number }}" placeholder="Enter your mobile number">
                <div class="settings-buttons">
                    <button type="button" class="setting-cancel-btn" onclick="toggleSection('mobile-setting-input-section')">Cancel</button>
                    <button type="submit" class="setting-save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>

    <div class="account-settings-section" id="password-section">
        <strong>Change Password</strong>
        <button class="setting-edit-btn" onclick="toggleSection('password-setting-input-section')">
            <i class="fa-sharp-duotone fa-solid fa-pencil"></i>
        </button>
        <div id="password-setting-input-section" class="hidden setting-input-section">
            <form action="{{ route('account.updatePassword') }}" method="POST">
                @csrf
                <label for="old-password">Old Password</label>
                <input type="password" name="old_password" id="old-password" placeholder="Enter old password">
            
                <label for="new-password">New Password</label>
                <input type="password" name="new_password" id="new-password" placeholder="Enter new password">
            
                <label for="new-password_confirmation">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" id="confirm-password" placeholder="Confirm new password">
            
                <div class="settings-buttons">
                    <button type="button" class="setting-cancel-btn" onclick="toggleSection('password-setting-input-section')">Cancel</button>
                    <button type="submit" class="setting-save-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('customJs')
<script>
    function toggleSection(sectionId) {
        const section = document.getElementById(sectionId);
        if (section.classList.contains('hidden')) {
            section.classList.remove('hidden');
        } else {
            section.classList.add('hidden');
        }
    }
</script>
@endsection
