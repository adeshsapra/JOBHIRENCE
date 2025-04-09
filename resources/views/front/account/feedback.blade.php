@extends('front.layouts.app')

@section('main')

<!-- Feedback Section -->
<section class="feedback-and-rating-section">
    <div class="feedback-and-rating-container">
        @include('front.alertMessage')
        <h2 class="feedback-and-rating-title">Feedback Helps Us Grow</h2>
        <p class="feedback-and-rating-subtitle">How was your experience? Share your thoughts below.</p>

        <!-- Feedback Form -->
        <form id="feedback-form" action="{{ route('account.saveFeedback') }}" method="POST">
            @csrf
            <div class="feedback-and-rating-rating-container">
                <div class="feedback-and-rating-rating-stars" id="feedback-and-rating-stars">
                    <span class="feedback-and-rating-star" data-value="1">&#9733;</span>
                    <span class="feedback-and-rating-star" data-value="2">&#9733;</span>
                    <span class="feedback-and-rating-star" data-value="3">&#9733;</span>
                    <span class="feedback-and-rating-star" data-value="4">&#9733;</span>
                    <span class="feedback-and-rating-star" data-value="5">&#9733;</span>
                </div>
                <p id="feedback-and-rating-text">Rate our service</p>
            </div>

            <!-- Hidden Input for Rating -->
            <input type="hidden" name="rating" id="rating-value" value="">

            <!-- Feedback Text Area -->
            <textarea class="feedback-and-rating-message" name="feedback" placeholder="Leave your feedback here..."></textarea>

            <!-- Submit Button -->
            <button type="submit" class="feedback-and-rating-submit-btn">Submit Feedback</button>
        </form>
    </div>
</section>

@endsection

@section('customJs')
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const stars = document.querySelectorAll(".feedback-and-rating-star");
        const ratingValue = document.getElementById("rating-value");
        const ratingText = document.getElementById("feedback-and-rating-text");

        let currentRating = 0;

        const ratingsText = {
            1: "Bad 🙁",
            2: "Poor 😕",
            3: "Average 😐",
            4: "Good 😊",
            5: "Excellent 😍"
        };

        // Highlight stars and set rating value
        stars.forEach((star, index) => {
            star.addEventListener("mouseover", () => highlightStars(index + 1));
            star.addEventListener("mouseout", () => highlightStars(currentRating));
            star.addEventListener("click", () => {
                currentRating = index + 1;
                ratingValue.value = currentRating; // Update hidden input value
                ratingText.textContent = ratingsText[currentRating] || "Rate our service";
            });
        });

        function highlightStars(rating) {
            stars.forEach((star, index) => {
                if (index < rating) {
                    star.classList.add("active");
                } else {
                    star.classList.remove("active");
                }
            });
        }
    });
</script>
@endsection
