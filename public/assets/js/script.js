const slider = document.querySelector('.home-slider');
slider.innerHTML += slider.innerHTML; // Duplicate the slider content



// job - companie section js -----------------------------------------------------------------------------------

const cardsContainer = document.querySelector(".companies-job-cards");
const leftButton = document.querySelector(".left-btn");
const rightButton = document.querySelector(".right-btn");

let currentIndex = 0; // Start at the first group of cards
const cardsPerView = 3; // Show 3 cards at a time
const cardWidth = 250; // The width of each card (including margin)

leftButton.addEventListener("click", () => {
  if (currentIndex > 0) {
    currentIndex--;
    updateCarousel();
  }
});

rightButton.addEventListener("click", () => {
  const totalCards = cardsContainer.children.length;
  const maxIndex = Math.floor(totalCards / cardsPerView) - 1;
  if (currentIndex < maxIndex) {
    currentIndex++;
    updateCarousel();
  }
});

function updateCarousel() {
  // Move the carousel by the width of 3 cards
  cardsContainer.style.transform = `translateX(-${currentIndex * cardWidth * cardsPerView}px)`;
}



// companie section js -----------------------------------------------------------------------------------

 // Apply the background images dynamically to each slide
 document.addEventListener("DOMContentLoaded", () => {
  const slides = document.querySelectorAll(".slide");

  slides.forEach(slide => {
      const background = slide.getAttribute("data-background");
      if (background) {
          slide.style.backgroundImage = `url('${background}')`;
      }
  });

  const slider = document.querySelector(".slider");
  const slideWidth = slides[0].clientWidth;
  let currentSlide = 1;

  // Position the slider to start from the first actual slide
  slider.style.transform = `translateX(-${slideWidth * currentSlide}px)`;

  function showNextSlide() {
      currentSlide++;
      slider.style.transition = "transform 0.5s ease-in-out";
      slider.style.transform = `translateX(-${slideWidth * currentSlide}px)`;

      // Reset to the first slide smoothly after the last cloned slide
      slider.addEventListener("transitionend", () => {
          if (currentSlide === slides.length - 1) {
              slider.style.transition = "none"; // Disable transition
              currentSlide = 0; // Reset to the first slide
              slider.style.transform = `translateX(-${slideWidth * currentSlide}px)`;
          }
      });
  }

  setInterval(showNextSlide, 3000); // Change slide every 3 seconds
});



//profile picture update page----------------------------------------------------------------------------------------

 // JavaScript to handle profile picture upload with plus icon
 function previewImage(event) {
  const file = event.target.files[0];
  if (file) {
      const reader = new FileReader();
      reader.onload = function() {
          document.getElementById('profileImage').src = reader.result;
      };
      reader.readAsDataURL(file);
  }
}

// ------------------------------- for header dropdown
document.addEventListener('DOMContentLoaded', function() {
  // Get all dropdown toggles
  const dropdownToggles = document.querySelectorAll('.dropdown-toggling');
  
  // Add click event listener to each toggle
  dropdownToggles.forEach(toggle => {
      toggle.addEventListener('click', function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          // Get the parent dropdown element
          const dropdown = this.closest('.dropdown');
          
          // Toggle active class
          dropdown.classList.toggle('dropdown-active');
          
          // Close other dropdowns
          dropdownToggles.forEach(otherToggle => {
              if (otherToggle !== toggle) {
                  otherToggle.closest('.dropdown').classList.remove('dropdown-active');
              }
          });
      });
  });
  
  // Close dropdown when clicking outside
  document.addEventListener('click', function(e) {
      if (!e.target.closest('.dropdown')) {
          dropdownToggles.forEach(toggle => {
              toggle.closest('.dropdown').classList.remove('dropdown-active');
          });
      }
  });
});


// -------------------- contact form

document.addEventListener('DOMContentLoaded', function() {
  const categories = document.querySelectorAll('.faq-category');
  const faqItems = document.querySelectorAll('.faq-item');

  categories.forEach(category => {
      category.addEventListener('click', function() {
          // Remove active class from all categories
          categories.forEach(c => c.classList.remove('active'));
          // Add active class to the clicked category
          this.classList.add('active');

          // Get the selected category
          const selectedCategory = this.getAttribute('data-category');

          // Show/hide FAQ items based on the selected category
          faqItems.forEach(item => {
              const itemCategory = item.getAttribute('data-category');
              if (selectedCategory === 'all' || itemCategory === selectedCategory) {
                  item.style.display = 'block';
              } else {
                  item.style.display = 'none';
              }
          });
      });
  });
});