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
          <h2>Verify OTP</h2>
          <p>Enter the OTP sent to your email to verify your identity.</p>
          <form action="{{ route('account.verifyOtp') }}" method="POST" class="forgot-password-form">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <div class="form-group">
                <label for="otp">OTP</label>
                <input type="text" name="otp" id="otp" placeholder="Enter OTP" required>
                @if ($errors->has('otp'))
                    <div class="error-message">{{ $errors->first('otp') }}</div>
                @endif
            </div>
            <button type="submit" class="forgot-password-btn">Verify OTP</button>
        </form>
        
        </div>
      </div>
      
  <script src="{{ asset('assets/js/ShowPassword.js') }}"></script>
</body>
</html>
