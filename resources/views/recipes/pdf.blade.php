<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details PDF</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            padding: 40px;
            background-color: #f7f7f7;
        }

        .pdf-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .pdf-header {
            text-align: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }

        .pdf-header h2 {
            font-size: 2.2rem;
            font-weight: 700;
            color: #333;
        }

        .pdf-body p {
            font-size: 1.1rem;
            color: #555;
            line-height: 1.6;
        }

        .pdf-body .section-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #444;
            margin-top: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .ingredient-list {
            list-style: none;
            padding: 0;
        }

        .ingredient-item {
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
            font-size: 1rem;
            color: #555;
        }

        .recipe-image img {
            width: 100%;
            max-height: 300px;
            border-radius: 12px;
            object-fit: cover;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #007bff;
            border-radius: 8px;
            padding: 10px 20px;
            color: #fff;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0, 123, 255, 0.3);
        }

        .btn-primary:hover {
            background-color: #0056b3;
            box-shadow: 0 6px 20px rgba(0, 123, 255, 0.4);
        }

        .rating-stars {
            color: #ffc107;
            font-size: 1.2rem;
        }

        .footer-text {
            text-align: center;
            font-size: 0.9rem;
            color: #777;
            margin-top: 30px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

    </style>
</head>

<body>

    <div class="pdf-container">
        <div class="pdf-header">
            <h2>Recipe Details</h2>
        </div>

        @if ($recipe->image)
            <div class="recipe-image">
                <img src="{{ public_path('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}">
            </div>
        @endif

        <div class="pdf-body">
            <h3 class="section-title">{{ $recipe->title }}</h3>
            <p><strong>Description:</strong> {{ $recipe->description }}</p>
            <p><strong>Preparation Time:</strong> {{ $recipe->preparation_time }} minutes</p>
            <p><strong>Cooking Time:</strong> {{ $recipe->cooking_time }} minutes</p>
            <p><strong>Servings:</strong> {{ $recipe->servings }}</p>
            <p><strong>Category:</strong> {{ $recipe->category->name }}</p>
            <br><br><br><br><br>
            <h4 class="section-title">Ingredients:</h4>
            <ul class="ingredient-list">
                @foreach ($recipe->ingredients as $ingredient)
                    <li class="ingredient-item">
                        <strong>{{ $ingredient->name }}</strong> - {{ $ingredient->quantity }}
                        @foreach ($units as $unit)
                            @if ($ingredient->unit_id == $unit->id)
                                {{ $unit->unitname }}
                                @break
                            @endif
                        @endforeach
                    </li>
                @endforeach
            </ul>
        <div class="footer-text">
            Recipe Management System &copy; 2024
        </div>
    </div>
</body>

</html>
