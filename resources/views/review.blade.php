@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review DataTable</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Light background for contrast */
        }
        .container {
            background-color: #ffffff; /* White background for the table */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
            padding: 20px; /* Spacing inside the container */
            margin-top: 20px; /* Spacing from the top */
        }
        .table {
            border-radius: 8px; /* Rounded corners for table */
            overflow: hidden; /* Clip the corners */
        }
        th {
            background-color: #007bff; /* Primary color for headers */
            color: white; /* White text for headers */
        }
        td {
            vertical-align: middle; /* Aligns cell content */
        }
        .alert {
            margin-bottom: 20px; /* Spacing below alerts */
        }
        .fas.fa-star,
        .far.fa-star {
            font-size: 20px; /* Adjust size as needed */
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        {{-- <h2 class="text-center mb-4">Review DataTable</h2> --}}
        <div class="col-sm-6">
            <h3 class="mb-5">All Reviews</h3>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table id="recipeTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Recipe Name</th>
                    <th>Category</th>
                    <th>User</th>
                    <th>Comment</th>
                    <th>Rating</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data will be populated by DataTables -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#recipeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('review.data') }}', // Fetch data from the server
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'recipe.title', name: 'recipe.title' },
                    { data: 'recipe.category.name', name: 'recipe.category.name' },
                    { data: 'user.name', name: 'user.name' },
                    { data: 'comment', name: 'comment' },
                    { data: 'rating', name: 'rating', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ]
            });
        });
    </script>
</body>

</html>
@endsection
