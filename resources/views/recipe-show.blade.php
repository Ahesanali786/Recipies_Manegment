<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            padding: 20px;
        }

        h2,
        h3,
        h4 {
            color: #333;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .card {
            background: #fff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .btn {
            border-radius: 50px;
            padding: 10px 20px;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-warning,
        .btn-primary,
        .btn-success {
            font-weight: bold;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-warning:hover {
            background-color: #e0a800;
            transform: translateY(-3px);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .btn-success:hover {
            background-color: #28a745;
            transform: translateY(-3px);
        }

        .ingredient-list {
            margin-top: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            border-left: 5px solid #17a2b8;
        }

        .ingredient-item {
            padding: 10px;
            border-radius: 8px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .ingredient-item:hover {
            background-color: #e2e6ea;
            transform: scale(1.05);
        }

        .rating-stars {
            color: #ffc107;
            margin-top: 5px;
        }

        .review {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .review:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .card img {
            max-width: 100%;
            border-radius: 20px 20px 0 0;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card img:hover {
            transform: scale(1.1);
        }

        .card img {
            width: 100%;
            /* Full width of the card */
            max-height: 300px;
            /* Max height to maintain proportion */
            object-fit: cover;
            /* Ensure image covers the area properly */
            border-radius: 20px 20px 0 0;
            /* Rounded corners for the top */
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            /* Soft shadow */
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            /* Smooth hover effect */
        }

        .card img:hover {
            transform: scale(0.9);
            /* Zoom effect on hover */
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            /* More intense shadow on hover */
        }

        /* 3D Button Hover Effect */
        .btn-3d {
            position: relative;
            padding: 10px 30px;
            color: white;
            background-color: #007bff;
            border-radius: 50px;
            box-shadow: 0 5px 10px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }

        .btn-3d:hover {
            background-color: #0056b3;
            box-shadow: 0 15px 30px rgba(0, 123, 255, 0.5);
            transform: translateY(-5px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .recipe-details {
                margin-top: 20px;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header h4 {
            font-weight: bold;
            font-size: 1.25rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        .user-name {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
        }

        .review {
            padding: 15px 0;
            border-bottom: 1px solid #eaeaea;
        }

        .rating-box {
            display: inline-flex;
            align-items: center;
            padding: 6px 12px;
            border-radius: 12px;
            color: #fff;
            font-weight: bold;
            font-size: 0.85rem;
        }

        .rating-red {
            background-color: #f44336;
            /* Red */
        }

        .rating-yellow {
            background-color: #ffeb3b;
            /* Yellow */
            color: #333;
        }

        .rating-green {
            background-color: #4caf50;
            /* Green */
        }

        .review-comment {
            font-size: 0.95rem;
            color: #555;
            margin-top: 5px;
            margin-left: 58px;
            /* Aligned with avatar and name */
        }

        .text-muted.small {
            font-size: 0.85rem;
            color: #888;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 90%;
            margin-right: 10px;

        }
    </style>
</head>

<body>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "{{ session('success') }}",
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: "{{ session('error') }}",
                toast: true,
                position: 'top-right',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif
    @if (Auth::user()->role == 'user')
        <a href="{{ url('home') }}" class="btn btn-primary btn-3d"><i class="fa fa-arrow-left"></i></a>
    @endif
    <div class="container recipe-details">
        <h2 class="text-center">Recipe Details</h2>
        <br><br><br>

        <div class="card">
            @if ($recipe->image)
                <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}">
            @else
                <p>No image available.</p>
            @endif

            <div class="card-header">
                <h3>{{ $recipe->title }}</h3>
            </div>
            <div class="card-body">
                <p><strong>Description:</strong> {{ $recipe->description }}</p>
                <p><strong>Preparation Time:</strong> {{ $recipe->preparation_time }} minutes</p>
                <p><strong>Cooking Time:</strong> {{ $recipe->cooking_time }} minutes</p>
                <p><strong>Servings:</strong> {{ $recipe->servings }}</p>
                <p><strong>Category:</strong> {{ $recipe->category->name }}</p>

                <h4 class="mt-4">Ingredients:</h4>
                <ul class="list-group ingredient-list">
                    @foreach ($recipe->ingredients as $ingredient)
                        <li class="list-group-item ingredient-item">
                            <strong>{{ $ingredient->name }}</strong> - {{ $ingredient->quantity }}
                            @foreach ($units as $unit)
                                @if ($ingredient->unit_id == $unit->id)
                                    {{ $unit->unitname }}
                                @break;
                            @endif
                        @endforeach
                    </li>
                @endforeach
            </ul>


            @if (Auth::user()->role == 'admin' || Auth::user()->id == $recipe->user_id)
                <div class="card-footer text-center">
                    <a href="{{ url('recipe-edit/' . $recipe->id) }}" class="btn btn-warning btn-3d">Edit
                        Recipe</a>
                    <a href="{{ url('recipe-list') }}" class="btn btn-primary btn-3d">Back to Recipes</a>
                </div>
            @endif

            @if (Auth::user()->role == 'user')
                <div class="card-footer">
                    <h4>Leave a Comment</h4>
                    <form action="{{ url('recipe/' . $recipe->id . '/review') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="rating">Rating:</label>
                            <div class="rating">
                                <span>Select Rating:</span>
                                <div class="star-rating" style="cursor: pointer;">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fa fa-star-o" id="star-{{ $i }}"
                                            onclick="setRating({{ $i }})"
                                            onmouseover="highlightStars({{ $i }})"
                                            onmouseout="resetStars({{ $i }})" aria-hidden="true"
                                            style="font-size: 50px; color: gray; margin-right: 10px;"></i>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating" id="rating" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="comment">Comment:</label>
                            <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success btn-3d">Submit Review</button>
                    </form>
                </div>
            @endif
        </div>

        <!-- Display Existing Reviews -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>User Reviews</h4>
            </div>
            <div class="card-body">
                @foreach ($recipe->reviews as $review)
                    <div class="review mb-4">
                        <!-- User Profile Picture and Name -->
                        <div class="d-flex align-items-center mb-2">
                            <!-- User Avatar -->


                            <!-- User Name and Date -->
                            <div>
                                <img src="https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211467.png"
                                    alt="User Avatar" class="user-avatar me-3" style="width: 40px; height: 40px;">
                                <strong
                                    class="user-name">{{ $review->user ? $review->user->name : 'User undefined' }}</strong>
                            </div>

                            <!-- Rating Box -->

                        </div>
                        <div class="rating-box ms-auto {{ $review->rating <= 2 ? 'rating-red' : ($review->rating <= 3 ? 'rating-yellow' : 'rating-green') }}">
                            <span>{{ number_format($review->rating, 1) }}</span> <i class="fa fa-star"
                                aria-hidden="true"></i>

                            </div>
                            <div class="text-muted small">Posted on {{ $review->created_at->format('j M Y') }}
                            </div>
                        <!-- Review Comment -->
                        <p class="review-comment">{{ $review->comment }}</p>
                    </div>
                @endforeach

                @if ($recipe->reviews->isEmpty())
                    <p>No reviews yet.</p>
                @endif
            </div>
        </div>
        <br><br>


    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        let currentRating = 0;

        // Function to set the rating when a star is clicked
        function setRating(rating) {
            currentRating = rating;
            document.getElementById('rating').value = rating;
            highlightStars(rating); // Highlight the clicked stars
        }

        // Function to highlight stars on mouseover
        function highlightStars(starCount) {
            for (let i = 1; i <= 5; i++) {
                const starElement = document.getElementById('star-' + i);
                if (i <= starCount) {
                    starElement.classList.remove('fa-star-o');
                    starElement.classList.add('fa-star');
                    starElement.style.color = 'gold';
                } else {
                    starElement.classList.remove('fa-star');
                    starElement.classList.add('fa-star-o');
                    starElement.style.color = 'gray';
                }
            }
        }

        // Function to reset stars if not clicked (on mouseout)
        function resetStars() {
            if (currentRating === 0) {
                highlightStars(0); // Reset all stars if no rating selected
            } else {
                highlightStars(currentRating); // Show the current selected rating
            }
        }
    </script>

    <!-- Include Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</body>

</html>
