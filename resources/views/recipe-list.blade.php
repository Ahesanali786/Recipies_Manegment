<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe DataTable</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>
    body {
        background-color: #f8f9fa;
    }

    h2 {
        margin-bottom: 20px;
    }

    table.dataTable thead th {
        background-color: #111111;
        color: white;
    }

    table.dataTable tbody tr:hover {
        background-color: #e9ecef;
    }

    .btn {
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #58595b;
        color: white;
    }

    #eye {
        cursor: pointer;
        font-size: 12px;
        margin-left: 12px;
        transition: color 0.3s;
    }

    #eye:hover {
        color: #007bff;
    }

    .action-icons a {
        margin-left: 10px;
    }
</style>

<body>
    <div class="container mt-5">
        @if (Auth::user()->role == 'admin')
            <h2 class="text-center">Recipe Management</h2>
        @elseif (Auth::user()->role == 'user')
            <h2 class="text-center">View Recipes</h2>
        @endif

        @if (session('success'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'green',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'success',
                    title: "{{ session('success') }}"
                });
            </script>
        @endif

        <div class="text-right mb-3">
            <a href="/recipe-add" class="btn btn-success">
                <i class="fa fa-plus"></i> Add Recipe
            </a>
            <a href="{{ Auth::user()->role == 'admin' ? '/dashboard' : '/home' }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div>

        <form id="bulkDeleteForm" action="/recipe-bulk-delete" method="POST">
            @if (Auth::user()->role == 'admin')
                @csrf
                @method('DELETE')
                <div class="text-right mb-3">
                    <button type="submit" id="bulkDeleteBtn" class="btn btn-danger" disabled>
                        <i class="fa fa-trash"></i> Delete Selected
                    </button>
                </div>
            @endif

            <table id="recipeTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        @if (Auth::user()->role == 'admin')
                            <th>
                                <input type="checkbox" id="selectAll">
                            </th>
                        @endif
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Preparation Time</th>
                        <th>Cooking Time</th>
                        <th>Servings</th>
                        <th>Category</th>
                        {{-- <th>Ingredients</th> --}}
                        @if (Auth::user()->role == 'admin')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recipes as $recipe)
                        <tr>
                            @if (Auth::user()->role == 'admin')
                                <td>
                                    <input type="checkbox" name="selected[]" value="{{ $recipe->id }}"
                                        class="selectRecipe">
                                </td>
                            @endif
                            <td>
                                <a href="recipe-show/{{ $recipe->id }} " style="color: black">
                                    {{ $recipe->id }}
                                </a>
                            </td>
                            <td>{{ $recipe->title }}</td>
                            <td>{{ $recipe->description }}</td>
                            <td>{{ $recipe->preparation_time }}</td>
                            <td>{{ $recipe->cooking_time }}</td>
                            <td>{{ $recipe->servings }}</td>
                            <td>{{ $recipe->category ? $recipe->category->name : 'No Category' }}</td>
                            {{-- <td>
                                <a href="/recipe-show/{{ $recipe->id }}" id="eye"
                                    class="btn btn-outline-secondary">
                                    <i class="fa fa-eye"></i> View Details
                                </a>
                            </td> --}}
                            @if (Auth::user()->role == 'admin')
                                <td class="action-icons">
                                    <a href="/recipe-edit/{{ $recipe->id }}">
                                        <i style="color: rgb(5, 138, 129); font-size:20px;" class="fas fa-edit"></i>
                                    </a>
                                    <a href="/recipe-delete/{{ $recipe->id }}" class="delete-btn">
                                        <i style="color: red; font-size:20px;" class="fas fa-trash"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#recipeTable').DataTable(); // Initialize DataTable

            // Reusable SweetAlert with Bootstrap Buttons
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            // Single delete confirmation
            $('.delete-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default action of the link

                let deleteUrl = $(this).attr('href'); // Get the delete URL from the link

                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href =
                        deleteUrl; // If confirmed, navigate to the delete URL
                        swalWithBootstrapButtons.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Your imaginary file is safe :)",
                            icon: "error"
                        });
                    }
                });
            });

            // Bulk delete confirmation
            $('#bulkDeleteBtn').on('click', function(e) {
                e.preventDefault(); // Prevent form submission

                swalWithBootstrapButtons.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#bulkDeleteForm').submit(); // Submit the form if confirmed
                        swalWithBootstrapButtons.fire({
                            title: "Deleted!",
                            text: "Your selected files have been deleted.",
                            icon: "success"
                        });
                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        swalWithBootstrapButtons.fire({
                            title: "Cancelled",
                            text: "Your selected files are safe :)",
                            icon: "error"
                        });
                    }
                });
            });

            // Enable/Disable bulk delete button based on checkbox selection
            $('.selectRecipe').on('change', function() {
                let selected = $('.selectRecipe:checked').length;
                $('#bulkDeleteBtn').prop('disabled', selected === 0);
            });

            // Select or deselect all checkboxes
            $('#selectAll').on('click', function() {
                $('.selectRecipe').prop('checked', this.checked);
                $('#bulkDeleteBtn').prop('disabled', $('.selectRecipe:checked').length === 0);
            });
        });
    </script>
</body>

</html>
