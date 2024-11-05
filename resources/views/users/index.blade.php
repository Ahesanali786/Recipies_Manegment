<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h2 {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .table {
            background-color: #fff;
            border-radius: 0.5rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .btn {
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-danger:hover {
            background-color: #c82333;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #6c757d;
            color: white;
        }

        .animate__animated {
            animation-duration: 0.5s;
        }
    </style>
</head>

<body>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Optional: Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.4.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        // Check if there's a 'status' session message
        @if (session('status'))
            Swal.fire({
                icon: 'success',
                title: '<strong>Success!</strong>',
                html: '<p>{{ session('status') }}</p>',
                iconColor: '#4CAF50',
                background: '#f9f9f9',
                color: '#333',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            });
        @endif
    </script>

    <div class="container mt-5">
        <h2 class="mb-4">Registered Users</h2>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Email verify</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>
                            <a href="{{ route('profile.show', $user->id) }}" class="text-decoration-none text-dark">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if($user->email_verified_at)
                                Yes
                            @else
                                Pending
                            @endif
                        </td>
                        <td>
                            @if ($user->role !== 'admin')
                                <form action="{{ route('users.toggleBlock', $user->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn btn-{{ $user->is_blocked ? 'danger' : 'secondary' }} btn-sm">
                                        {{ $user->is_blocked ? 'Unblock User' : 'Block User' }}
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">Admin User</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('.table').DataTable({
                "order": [[ 0, "asc" ]], // Sort by ID ascending by default
                "responsive": true, // Make the table responsive
                "lengthMenu": [2,5, 10, 25, 50], // Options for number of records to display
                "pageLength": 5 // Default records per page
            });
        });
    </script>
</body>

</html>
