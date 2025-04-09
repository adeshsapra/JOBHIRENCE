@if (session('success'))
    <div class="alert alert-success" id="success-alert">
        <span class="alert-icon success-icon">✔</span>
        {{ session('success') }}
        @if (session('link') && session('link_text'))
            <a href="{{ session('link') }}" class="alert-links">
                {{ session('link_text') }}
            </a>
        @endif
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" id="error-alert">
        <span class="alert-icon error-icon">✖</span>
        {{ session('error') }}
    </div>
@endif

<style>
    .alert {
        display: flex;
        align-items: center;
        padding: 0.75rem 1.25rem;
        margin-bottom: 1rem;
        border: 1px solid transparent;
        border-radius: 0.25rem;
        font-size: 1rem;
        position: relative; /* Added for fade-out animation */
        opacity: 1;
        transition: opacity 0.5s ease; /* Smooth fade-out */
    }

    .alert-success {
        color: #155724;
        background-color: #d4edda;
        border-color: #c3e6cb;
        text-transform: capitalize;
    }

    .alert-danger {
        color: #721c24;
        background-color: #f8d7da;
        border-color: #f5c6cb;
        text-transform: capitalize;
    }

    .alert-icon {
        font-weight: bold;
        margin-right: 0.5rem;
        display: inline-block;
        width: 20px;
        height: 20px;
        text-align: center;
        line-height: 20px;
    }

    .success-icon {
        color: #155724;
    }

    .error-icon {
        color: #721c24;
    }

    .alert-links {
        margin-left: 10px;
        text-decoration: none;
        font-weight: 600;
        color: #155724;
    }

    .alert-links:hover {
        text-decoration: underline;
    }
</style>

<script>
    // Automatically remove alert messages after 5 seconds
    window.addEventListener('DOMContentLoaded', () => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        if (successAlert) {
            setTimeout(() => {
                successAlert.style.opacity = '0'; // Start fade-out
                setTimeout(() => successAlert.remove(), 500); // Remove element after fade-out
            }, 5000); // Delay before fade-out starts
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.opacity = '0'; // Start fade-out
                setTimeout(() => errorAlert.remove(), 500); // Remove element after fade-out
            }, 5000); // Delay before fade-out starts
        }
    });
</script>
