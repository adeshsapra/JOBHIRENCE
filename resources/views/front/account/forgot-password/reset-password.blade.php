<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="forgot-password-container">
        <div>
            @include('front.alertMessage')

          <h2>Reset Password</h2>
          <p>Enter your new password below to reset it.</p>
          <form action="{{ route('account.resetPassword') }}" method="POST" class="forgot-password-form">
            @csrf
            <input type="hidden" name="email" value="{{ $email }}">
            <div class="form-group">
              <label for="password">New Password</label>
              <input type="password" name="password" id="password" placeholder="Enter new password" required>
            </div>
            <div class="form-group">
              <label for="password_confirmation">Confirm Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password" required>
            </div>
            <button type="submit" class="forgot-password-btn">Reset Password</button>
          </form>
        </div>
      </div>
      
      
  <script src="{{ asset('assets/js/ShowPassword.js') }}"></script>
</body>
</html>
