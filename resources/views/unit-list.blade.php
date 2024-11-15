@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap DataTable Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container mt-5">
        <div class="col-sm-6">
            <h3 class="mb-5">All Units</h3>
        </div>
        {{-- <h2 class="text-center">Units Table</h2> --}}

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

        <!-- Back Button -->
        {{-- <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fa fa-arrow-left"></i> Back
            </a>
        </div> --}}

        <!-- Add Category Button -->
        {{-- <div class="text-right mb-3">
            <a href="/units-add" class="btn btn-success">
                <i class="fa fa-plus"></i> Add Units
            </a>
        </div> --}}

        <!-- Category Table -->
        <table id="recipeTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>units Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $units as $unit)
                    <tr>
                        <td>  {{ $unit->id }} </td>
                        <td>{{ $unit->unitname }}</td>
                        <td>
                            <a href="unit-edit/{{ $unit->id }}" class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <a href="/unit-delete/{{ $unit->id }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
        });
    </script>
</body>

</html>
@endsection
