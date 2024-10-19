<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Favorite Recipes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
        }

        h1 {
            color: #ff6b6b;
            text-align: center;
            margin-bottom: 30px;
        }

        .card {
            margin-bottom: 20px; /* Space between cards */
            transition: transform 0.2s; /* Animation for hover effect */
        }

        .card:hover {
            transform: scale(1.02); /* Scale effect on hover */
        }

        .ratings i {
            color: #ff6b6b;
        }

        .btn-back {
            display: block;
            margin: 0 auto;
            background-color: #ff6b6b;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            text-align: center;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #ff5252;
        }

        .alert {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1>Your Favorite Recipes</h1>
        <div class="mb-3">
            <a href="/profile" class="btn btn-secondary"><i class="fa fa-home"></i> Back to Home</a>
        </div>

        @if ($favoriteRecipes->isEmpty())
            <p class="alert alert-info">You haven't favorited any recipes yet.</p>
        @else
            <div class="row">
                @foreach ($favoriteRecipes as $recipe)
                    <div class="col-md-4">
                        <div class="card">
                            <img src="{{ $recipe->image ? asset('webimg/' . $recipe->image) : asset('images/default-recipe.png') }}"
                                 alt="{{ $recipe->title }}"
                                 class="card-img-top"
                                 style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $recipe->title }}</h5>
                                <p class="card-text">Category: {{ $recipe->category->name }}</p>
                                <div class="ratings">
                                    @php
                                        $averageRating = $recipe->reviews()->avg('rating');
                                        $filledStars = floor($averageRating);
                                        $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                                    @endphp
                                    @for ($i = 1; $i <= $filledStars; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor

                                    @if ($halfStar)
                                        <i class="fa fa-star-half-o"></i>
                                    @endif

                                    @for ($i = $filledStars + $halfStar + 1; $i <= 5; $i++)
                                        <i class="fa fa-star-o"></i>
                                    @endfor
                                </div>
                                <p>{{ number_format($averageRating, 1) }} / 5</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</body>

</html>
