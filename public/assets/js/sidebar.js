
// main sidebar ----------------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('toggle-button').addEventListener('click', function() {
        document.querySelector('.account-sidebar').classList.toggle('active');
        document.querySelector('.nav').classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        var sidebar = document.querySelector('.account-sidebar');
        var toggleButton = document.getElementById('toggle-button');
        var navMenu = document.querySelector('.nav');

        if (!sidebar.contains(event.target) && !toggleButton.contains(event.target) && !navMenu.contains(event.target)) {
            sidebar.classList.remove('active');
            navMenu.classList.remove('active');
        }
    });
});