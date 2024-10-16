<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe DataTable</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">{{ Auth::user()->role == 'admin' ? 'Recipe Management' : 'View Recipes' }}</h2>

        <div class="text-right mb-3">
            @if (Auth::user()->role == 'admin')
                <a href="/recipe-add" class="btn btn-success"><i class="fa fa-plus"></i> Add Recipe</a>
            @endif
            <a href="{{ Auth::user()->role == 'admin' ? '/dashboard' : '/home' }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
            @if (Auth::user()->role == 'admin')
                <button id="bulkDeleteBtn" class="btn btn-danger" style="display: none;"><i class="fas fa-trash"></i> Delete Selected</button>
            @endif
        </div>

        <form id="bulkDeleteForm" action="/recipe-bulk-delete" method="POST">
            @csrf
            @method('DELETE')
            <table id="recipeTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        @if (Auth::user()->role == 'admin')
                            <th><input type="checkbox" id="selectAll"></th>
                        @endif
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Preparation Time</th>
                        <th>Cooking Time</th>
                        <th>Servings</th>
                        <th>Category</th>
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
            </table>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable with server-side processing
            var table = $('#recipeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('recipes.list') }}", // Adjust the route as per your setup
                columns: [
                    @if (Auth::user()->role == 'admin')
                        {
                            data: 'select',
                            name: 'select',
                            orderable: false,
                            searchable: false
                        },
                    @endif {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'preparation_time',
                        name: 'preparation_time'
                    },
                    {
                        data: 'cooking_time',
                        name: 'cooking_time'
                    },
                    {
                        data: 'servings',
                        name: 'servings'
                    },
                    {
                        data: 'category.name',
                        name: 'category.name'
                    },
                    @if (Auth::user()->role == 'admin')
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        }
                    @endif
                ]
            });

            // Show/hide bulk delete button based on checkbox selection
            $(document).on('change', '.selectRecipe', function() {
                $('#bulkDeleteBtn').toggle($('.selectRecipe:checked').length > 0);
            });

            // Select all checkboxes functionality
            $('#selectAll').on('click', function() {
                $('.selectRecipe').prop('checked', this.checked);
                $('#bulkDeleteBtn').toggle($('.selectRecipe:checked').length > 0);
            });

            // Single delete functionality with SweetAlert
            $(document).on('click', '.delete-btn', function() {
                var recipeId = $(this).data('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/recipe-delete/' + recipeId, // Adjust the route as per your setup
                            type: 'GET',
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire('Deleted!', 'Recipe has been deleted.', 'success');
                                table.ajax.reload();
                            },
                            error: function(xhr) {
                                Swal.fire('Oops!', 'Something went wrong. Try again later.', 'error');
                            }
                        });
                    }
                });
            });

            // Bulk delete functionality
            $('#bulkDeleteBtn').on('click', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete selected!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bulkDeleteForm').submit(); // Submit the form to perform bulk delete
                    }
                });
            });
        });
    </script>
</body>

</html>
