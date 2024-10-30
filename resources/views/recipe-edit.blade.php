<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Recipe Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f8fc;
            padding: 30px;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        h2 {
            text-align: center;
            color: #333;
            font-weight: 500;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .form-control:focus {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }

        .btn-primary,
        .btn-success,
        .btn-danger {
            border-radius: 25px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover,
        .btn-success:hover,
        .btn-danger:hover {
            transform: translateY(-3px);
        }

        img {
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .ingredient-group {
            transition: all 0.3s ease;
        }

        .ingredient-group:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .fa-plus,
        .fa-trash {
            color: #fff;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Edit Recipe</h2>

        <form action="" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Recipe Title -->
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $recipe->title }}"
                    required>
            </div>

            <!-- Recipe Description -->
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $recipe->description }}</textarea>
            </div>

            <!-- Preparation Time -->
            <div class="form-group">
                <label for="preparation_time">Preparation Time (in minutes)</label>
                <input type="number" class="form-control" id="preparation_time" name="preparation_time"
                    value="{{ $recipe->preparation_time }}" required>
            </div>

            <!-- Cooking Time -->
            <div class="form-group">
                <label for="cooking_time">Cooking Time (in minutes)</label>
                <input type="number" class="form-control" id="cooking_time" name="cooking_time"
                    value="{{ $recipe->cooking_time }}" required>
            </div>

            <!-- Servings -->
            <div class="form-group">
                <label for="servings">Servings</label>
                <input type="number" class="form-control" id="servings" name="servings"
                    value="{{ $recipe->servings }}" required>
            </div>

            <!-- Recipe Category -->
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $recipe->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Recipe Image -->
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                @if ($recipe->image)
                    <div>
                        <img src="{{ asset('webimg/' . $recipe->image) }}" alt="Current Image"
                            style="max-width: 200px; max-height: 200px;">
                    </div>
                @endif
                <input type="file" class="form-control" name="image" id="image" accept="image/*">
                <small class="text-muted">Leave empty to keep the current image.</small>
            </div>

            <!-- Ingredient Fields -->
            <div id="ingredientContainer">
                @foreach ($recipe->ingredients as $ingredient)
                    <div class="ingredient-group row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name[]"
                                value="{{ old('name[]', $ingredient->name) }}" placeholder="Ingredient Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="quantity[]"
                                value="{{ old('quantity[]', $ingredient->quantity) }}"
                                placeholder="Quantity (e.g., 200g)" required>
                        </div>

                        <div class="col-md-3">
                            <select name="unit_id[]" class="form-control" required>
                                <option value="">Select a Units</option>
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}"
                                        {{ $ingredient->unit_id == $unit->id ? 'selected' : '' }}>
                                        {{ $unit->unitname }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-ingredient">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>



            <!-- Add Ingredient Button -->
            <button type="button" class="btn btn-success mb-3" id="addIngredientButton">
                <i class="fa fa-plus"></i> Add Ingredient
            </button>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary btn-block">Update Recipe</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Add Ingredient Script -->
    <script>
        $(document).ready(function() {
            // Add Ingredient Button Click Event
            $('#addIngredientButton').click(function() {
                var ingredientGroup = `
                    <div class="ingredient-group row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name[]" placeholder="Ingredient Name" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="quantity[]" placeholder="Quantity (e.g., 200g)" required>
                        </div>
                        <div class="col-md-3">
                            <select name="unit_id[]" class="form-control" required>
                                <option value="">Select a Units</option>
                                @foreach ($units as $unit)
                                      <option value="{{ $unit->id }}">{{ $unit->unitname }}</option>
                                @endforeach
                            </select>
                                    </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger remove-ingredient">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>`;
                $('#ingredientContainer').append(ingredientGroup);
            });

            // Remove Ingredient Button Click Event
            $(document).on('click', '.remove-ingredient', function() {
                $(this).closest('.ingredient-group').remove();
            });
        });
    </script>
</body>

</html>
