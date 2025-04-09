document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    
    togglePassword.addEventListener('click', function() {
      // Toggle the password visibility
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      
      // Toggle the icon
      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
      
      // Update the aria-label for accessibility
      this.setAttribute('aria-label', 
        type === 'password' ? 'Show password' : 'Hide password'
      );
    });
    
    // Prevent the button from submitting the form
    togglePassword.addEventListener('mousedown', function(e) {
      e.preventDefault();
    });
  });