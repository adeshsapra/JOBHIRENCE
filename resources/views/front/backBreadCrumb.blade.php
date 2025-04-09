<nav class="breadcrumb">
    <a href="#" id="backButton">
        <i class="fas fa-arrow-left"></i> Back
    </a>
</nav>

<script>
    let pageHistory = [window.location.href]; // Start by adding the current page

    // Update pageHistory on every page load
    document.addEventListener('DOMContentLoaded', function() {
        // This could be useful to add dynamically when the user navigates within the app
        // For example, pageHistory.push(window.location.href);
        
        const backButton = document.getElementById('backButton');

        backButton.addEventListener('click', function(event) {
            event.preventDefault(); // Prevent default link action
            
            // Ensure the history has more than one page
            if (pageHistory.length > 1) {
                // Pop the current page (so it doesn't stay in the array)
                pageHistory.pop();

                // Get the last visited page (before the current one)
                const previousPage = pageHistory[pageHistory.length - 1];

                // Navigate to the previous page in the history
                window.location.href = previousPage;
            } else {
                // If only one page exists (the current page), fall back to browser history
                window.history.back();
            }
        });

        // Optionally, you can update the history dynamically for single-page navigation:
        // pageHistory.push(window.location.href);
    });
</script>
