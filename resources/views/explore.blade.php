<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Explorer</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Updated Bootstrap Icons -->

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #dad1d1;
            /* Light background */
            margin-top: 20px;
        }

        .btn-back {
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 600;
        }

        .card {
            transition: transform 0.2s, box-shadow 0.2s;
            border: none;
            border-radius: 8px;
            /* Rounded corners */
        }

        .card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }

        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            /* Circular profile picture */
            margin-right: 10px;
        }

        .user-name {
            font-size: 0.85rem;
            color: #888;
            /* Subtle user name color */
            margin: 0;
            font-weight: 500;
            /* Bold name */
        }

        .favorite-btn {
            background: none;
            border: none;
            color: #dc3545;
            cursor: pointer;
        }

        .ratings i {
            color: #0ad8bd;
            /* Gold color for stars */
        }

        .average-rating,
        .favorites-count {
            font-size: 0.9rem;
            color: #d14d4d;
            /* Darker gray for text */
        }

        /* Card Image Styling */
        .card-img-top {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
            height: 200px;
            /* Fixed height */
            object-fit: cover;
            /* Crop image */
        }

        /* Button Styles */
        .btn-primary {
            background-color: #3897f0;
            /* Instagram-like blue */
            border: none;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #007bff;
            /* Darker blue on hover */
        }

        /* Responsive styles */
        @media (max-width: 576px) {
            .card {
                margin-bottom: 20px;
                /* Space between cards */
            }
        }

        .search-bar {
            display: flex;
            justify-content: center;
            /* Center align the search bar */
        }

        .input-group {
            max-width: 600px;
            /* Limit the width of the search input group */
            width: 100%;
            /* Make it responsive */
        }

        .search-input {
            border: 2px solid #3897f0;
            /* Match the border with the button */
            border-radius: 30px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Increased padding for better spacing */
            transition: border-color 0.3s;
            /* Smooth transition for border color */
        }

        .search-input:focus {
            outline: none;
            /* Remove default outline */
            border-color: #007bff;
            /* Change border color on focus */
            box-shadow: 0 0 5px rgba(56, 151, 240, 0.5);
            /* Add shadow on focus */
        }

        .btn-search {
            background-color: #3897f0;
            /* Primary button color */
            border: none;
            /* Remove default border */
            color: white;
            /* White text color */
            border-radius: 30px;
            /* Rounded corners */
            padding: 10px 20px;
            /* Padding for the button */
            font-size: 10px;
            /* Font size */
            transition: background-color 0.3s;
            /* Smooth transition for background color */
        }

        .btn-search:hover {
            background-color: #007bff;
            /* Darker blue on hover */
        }

        .btn-search i {
            margin-right: 10px;
            /* Space between icon and text */
        }
    </style>
</head>

<body>
    <div class="container">
        <a href="{{ url('home') }}" class="btn btn-secondary btn-back">Back</a>
        <h1>Explore Recipes</h1>

        <form method="GET" action="{{ url('explore') }}" class="search-bar mb-4">
            <div class="search-bar mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control search-input"
                        placeholder="Search for recipes..." value="{{ request()->input('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-search" type="submit">
                            <i class="bi bi-search"></i> <!-- Search icon from Bootstrap Icons -->
                            Search
                        </button>
                    </div>
                </div>
            </div>

        </form>

        @foreach ($categories as $category)
            <h2 class="my-4" style="font-weight: 600;">{{ $category->name }}</h2>
            <div class="row">
                @foreach ($category->recipes as $recipe)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card shadow-sm">
                            <!-- User Profile Section -->
                            <div class="user-profile">
                                <img src="https://png.pngtree.com/png-vector/20230831/ourmid/pngtree-man-avatar-image-for-profile-png-image_9197911.png"
                                    alt="{{ $recipe->user->name }}">
                                <p class="user-name">
                                    <a href="{{ url('profile/' . $recipe->user->id) }}">
                                        {{ $recipe->user->name }}
                                    </a>
                                </p>
                            </div>
                            <img src="{{ asset('webimg/' . $recipe->image) }}" class="card-img-top"
                                alt="{{ $recipe->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="favorites-count">
                                    Likes: {{ $recipe->favorites->count() }}
                                </p>
                                <div class="ratings">
                                    @php
                                        $averageRating = $recipe->reviews()->avg('rating');
                                        $filledStars = floor($averageRating);
                                        $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                                    @endphp

                                    @for ($i = 1; $i <= $filledStars; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="bi bi-star-half"></i>
                                    @endif

                                    @for ($i = 1; $i <= 5 - $filledStars - $halfStar; $i++)
                                        <i class="bi bi-star"></i>
                                    @endfor
                                </div>
                                <p class="average-rating">
                                    @if ($averageRating)
                                        Average Rating: {{ number_format($averageRating, 1) }} / 5
                                    @else
                                        No ratings yet
                                    @endif
                                </p>
                                <button class="btn favorite-btn" data-recipe-id="{{ $recipe->id }}">
                                    @if ($recipe->favorites->contains(Auth::id()))
                                        <i class="bi bi-heart-fill"></i> <!-- Filled heart -->
                                    @else
                                        <i class="bi bi-heart"></i> <!-- Outlined heart -->
                                    @endif
                                </button>
                                <a href="{{ url('user/user-show/' . $recipe->id) }}" class="btn btn-primary">View
                                    Recipe</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('.favorite-btn').click(function(e) {
                e.preventDefault(); // Prevent default button action
                const button = $(this);
                const recipeId = button.data('recipe-id');

                $.ajax({
                    url: `/recipes/${recipeId}/favorite`, // Adjust the URL to your route
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}', // Include CSRF token
                    },
                    success: function(response) {
                        // Check the response for 'isFavorited'
                        if (response.isFavorited) {
                            button.html(
                                '<i class="bi bi-heart-fill"></i>'
                                ); // Show filled heart if favorited
                        } else {
                            button.html(
                                '<i class="bi bi-heart"></i>'
                                ); // Show outlined heart if unfavorited
                        }

                        // Update the favorites count
                        button.siblings('.favorites-count').text('Likes: ' + response
                            .favoritesCount);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText); // Log error
                    }
                });
            });
        });
    </script>
</body>

</html>
