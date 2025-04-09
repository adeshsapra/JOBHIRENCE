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

          <h2>Forgot Password</h2>
          <p>Enter your registered email address, and we'll send you an OTP to reset your password.</p>
          <form action="{{ route('account.sendOtp') }}" method="POST" class="forgot-password-form">
            @csrf
            <div class="form-group">
              <label for="email">Email Address</label>
              <input type="email" name="email" id="email" placeholder="Your email address" required>
              @if ($errors->has('email'))
                <div class="error-message">{{ $errors->first('email') }}</div>
              @endif
            </div>
            <button type="submit" class="forgot-password-btn">Send OTP</button>
          </form>
        </div>
      </div>
  <script src="{{ asset('assets/js/ShowPassword.js') }}"></script>
</body>
</html>
