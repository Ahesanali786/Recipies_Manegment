<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<style>
    /* Review Section */
    .reviews-section {
        background-color: #f9f9f9;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    /* Title */
    .reviews-title {
        font-size: 1.75rem;
        font-weight: bold;
        color: #343a40;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    /* No Reviews */
    .no-reviews {
        color: #777;
        font-size: 1rem;
    }

    /* Individual Review */
    .review {
        background-color: #fff;
        padding: 15px;
        margin-bottom: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Review Header */
    .review-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    /* Review User Name */
    .review-user {
        font-weight: bold;
        font-size: 1.2rem;
        color: #007bff;
    }

    /* Star Ratings */
    .review-rating {
        display: flex;
        align-items: center;
        font-size: 1.2rem;
        color: #f39c12;
        /* Star color */
    }

    .review-rating .fas.fa-star,
    .review-rating .fas.fa-star-half-alt,
    .review-rating .far.fa-star {
        margin-right: 2px;
    }

    /* Rating Text */
    .review-rating-text {
        font-size: 1rem;
        margin-left: 10px;
        color: #555;
    }

    /* Review Comment */
    .review-comment {
        font-size: 1.1rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 5px;
    }

    /* Review Description */
    .review-description {
        font-size: 0.9rem;
        color: #777;
    }
</style>

<body>
    <div class="reviews-section">
        <h3 class="reviews-title">Reviews:</h3>
        @if ($recipe->reviews->isEmpty())
            <p class="no-reviews">No reviews yet.</p>
        @else
            @foreach ($recipe->reviews as $review)
                <div class="review">
                    <div class="review-header">
                        <strong class="review-user">{{ $review->user->name }}</strong>
                        <div class="review-rating">
                            @php
                                $filledStars = floor($review->rating);
                                $halfStar = $review->rating - $filledStars >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - $filledStars - $halfStar;
                            @endphp

                            <!-- Display filled stars -->
                            @for ($i = 1; $i <= $filledStars; $i++)
                                <i class="fas fa-star"></i>
                            @endfor

                            <!-- Display half star if applicable -->
                            @if ($halfStar)
                                <i class="fas fa-star-half-alt"></i>
                            @endif

                            <!-- Display empty stars -->
                            @for ($i = 1; $i <= $emptyStars; $i++)
                                <i class="far fa-star"></i>
                            @endfor
                        </div>
                        <span class="review-rating-text">{{ $review->rating }}/5</span>
                    </div>
                    <p class="review-comment">{{ $review->review }}</p>
                    <p class="review-description">{{ $review->comment }}</p>
                </div>
            @endforeach
        @endif
    </div>
</body>

</html>
