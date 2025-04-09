
document.addEventListener("DOMContentLoaded", function () {
    // Get all buttons with the dropdown
    const actionButtons = document.querySelectorAll('.company-job-list-actions button');
    
    actionButtons.forEach(button => {
        // Add event listener for the button to show dropdown
        button.addEventListener('click', function(event) {
            const dropdown = button.nextElementSibling;
            
            // Toggle dropdown visibility
            dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            
            // Prevent event from propagating to document
            event.stopPropagation();
        });
    });

    // Close dropdown if clicking outside
    document.addEventListener('click', function(event) {
        const dropdowns = document.querySelectorAll('.company-job-list-dropdown');
        
        dropdowns.forEach(dropdown => {
            // If clicked outside of the button or dropdown, hide it
            if (!dropdown.contains(event.target) && !event.target.closest('.company-job-list-actions')) {
                dropdown.style.display = 'none';
            }
        });
    });

    // Ensure dropdown hides when clicking on the button
    const buttons = document.querySelectorAll('.company-job-list-actions button');
    buttons.forEach(button => {
        button.addEventListener('click', function(event) {
            event.stopPropagation(); // To prevent closing right after clicking the button
        });
    });
});




//post button  click event------------------------------------------------------------------>>>>>>>>>>>>>>>>>>>>>

document.getElementById('post-job-button').addEventListener('click', function() {
    var newJobSection = document.getElementById('new-job-section');
    // Toggle the display of the job posting section
    newJobSection.style.display = (newJobSection.style.display === 'none' || newJobSection.style.display === '') ? 'block' : 'none';
});




//company applications 
    document.addEventListener('DOMContentLoaded', () => {
        // Select all action buttons
        const actionButtons = document.querySelectorAll('.action-button');

        actionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation(); // Prevent click from propagating
                const dropdown = button.nextElementSibling;
                
                // Toggle the visibility of the dropdown menu
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

                // Close all other open dropdowns
                document.querySelectorAll('.dropdown-menu').forEach(menu => {
                    if (menu !== dropdown) menu.style.display = 'none';
                });
            });
        });

        // Close dropdown menu if clicked outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        });
    });




    //...............................................................................................

    document.addEventListener('DOMContentLoaded', () => {
        const actionButtons = document.querySelectorAll('.company-applications-action-button');

        actionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();
                const dropdown = button.nextElementSibling;

                // Toggle visibility of the dropdown
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

                // Dynamically adjust dropdown position if it extends beyond the viewport
                const dropdownRect = dropdown.getBoundingClientRect();
                const viewportHeight = window.innerHeight;
                const viewportWidth = window.innerWidth;

                // Adjust if dropdown goes out of the viewport
                if (dropdownRect.bottom > viewportHeight) {
                    dropdown.style.top = `-${dropdownRect.height}px`; // Move above the button
                }
                if (dropdownRect.right > viewportWidth) {
                    dropdown.style.left = 'auto'; // Align to the left
                    dropdown.style.right = '0';
                }

                // Close other dropdowns
                document.querySelectorAll('.company-applications-dropdown-menu').forEach(menu => {
                    if (menu !== dropdown) menu.style.display = 'none';
                });
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', () => {
            document.querySelectorAll('.company-applications-dropdown-menu').forEach(menu => {
                menu.style.display = 'none';
            });
        });
    });

    //job------------------------------------------------

    document.addEventListener('DOMContentLoaded', () => {
const actionButtons = document.querySelectorAll('.company-jobs-action-button');

actionButtons.forEach(button => {
    button.addEventListener('click', (e) => {
        e.stopPropagation();
        const dropdown = button.nextElementSibling;

        // Toggle visibility of the dropdown
        dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';

        // Dynamically adjust dropdown position if it extends beyond the viewport
        const dropdownRect = dropdown.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const viewportWidth = window.innerWidth;

        // Adjust if dropdown goes out of the viewport
        if (dropdownRect.bottom > viewportHeight) {
            dropdown.style.top = `-${dropdownRect.height}px`; // Move above the button
        }
        if (dropdownRect.right > viewportWidth) {
            dropdown.style.left = 'auto'; // Align to the left
            dropdown.style.right = '0';
        }

        // Close other dropdowns
        document.querySelectorAll('.company-jobs-dropdown-menu').forEach(menu => {
            if (menu !== dropdown) menu.style.display = 'none';
        });
    });
});

// Close dropdown when clicking outside
document.addEventListener('click', () => {
    document.querySelectorAll('.company-jobs-dropdown-menu').forEach(menu => {
        menu.style.display = 'none';
    });
});
});


// ---------------------------- dropdown in header section company
