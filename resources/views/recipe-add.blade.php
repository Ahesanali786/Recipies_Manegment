<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background: #f8f9fa;
            padding: 30px;
        }

        h2 {
            color: #343a40;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: 600;
            color: #495057;
        }

        .form-control {
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .btn-primary,
        .btn-success {
            border-radius: 25px;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-primary:hover,
        .btn-success:hover {
            transform: translateY(-3px);
        }

        .btn-danger {
            background-color: #dc3545;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-3px);
        }

        .ingredient-group {
            transition: all 0.3s ease;
        }

        .ingredient-group:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        /* File input */
        input[type="file"] {
            transition: all 0.3s ease;
        }

        input[type="file"]:hover {
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
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
    <div class="container">
        <h2 class="text-center">Add Recipe</h2>

        <form action="{{ Auth::user()->role == 'admin' ? 'recipe-add' : 'home' }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="preparation_time">Preparation Time (minutes)</label>
                <input type="number" class="form-control" id="preparation_time" name="preparation_time" required>
            </div>

            <div class="form-group">
                <label for="cooking_time">Cooking Time (minutes)</label>
                <input type="number" class="form-control" id="cooking_time" name="cooking_time" required>
            </div>

            <div class="form-group">
                <label for="servings">Servings</label>
                <input type="number" class="form-control" id="servings" name="servings" required>
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" class="form-control" required>
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input type="file" class="form-control" name="image" id="image" accept="image/*">
            </div>

            <!-- Ingredient Section -->
            <div id="ingredientContainer">
                <div class="ingredient-group row mb-3">
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="name[]" placeholder="Ingredient Name"
                            required>
                    </div>
                    <div class="col-md-5">
                        <input type="text" class="form-control" name="quantity[]" placeholder="Quantity (e.g., 200g)"
                            required>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-success add-more">
                            <i class="fa fa-plus"></i> Add More
                        </button>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-block mt-4">Add Recipe</button>
        </form>
    </div>

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // Add more ingredients functionality
            $('.add-more').on('click', function() {
                var newIngredientRow = `
                    <div class="ingredient-group row mb-3">
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="name[]" placeholder="Ingredient Name" required>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="quantity[]" placeholder="Quantity (e.g., 200g)" required>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-ingredient"><i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div>`;
                $('#ingredientContainer').append(newIngredientRow);
            });

            // Remove ingredient functionality
            $(document).on('click', '.remove-ingredient', function() {
                $(this).closest('.ingredient-group').remove();
            });
        });
    </script>
</body>

</html>
