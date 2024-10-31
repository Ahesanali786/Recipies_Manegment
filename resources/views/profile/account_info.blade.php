<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f9f9f9;
        }

        .profile-card {
            background-color: #fff;
            border: 1px solid #eaeaea;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-header img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .profile-header h1 {
            font-size: 24px;
            margin: 0;
        }

        .profile-details {
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }

        .btn-custom {
            border-radius: 20px;
            padding: 10px 20px;
        }

        .btn-delete {
            background-color: #e63946;
            color: white;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="profile-card">
        <div class="profile-header">
            @if($profile->profile_picture)
                <img src="{{ Storage::url($profile->profile_picture) }}" alt="Profile Picture">
            @else
                <img src="https://via.placeholder.com/100" alt="Profile Picture">
            @endif
            <h1>{{ $profile->name }}</h1>
        </div>

        <div class="profile-details">
            <p><strong>Email:</strong> {{ $profile->email }}</p>
            <p><strong>Bio:</strong> {{ $profile->bio ?? 'N/A' }}</p>
            <p><strong>Profile Created At:</strong> {{ $profile->created_at->format('d M Y') }}</p>
            <p><strong>Profile Updated At:</strong> {{ $profile->updated_at->format('d M Y') }}</p>
        </div>

        <div class="text-center mt-4">
            {{-- <a href="#" class="btn btn-warning btn-custom">Edit Profile</a>
            <a href="#" class="btn btn-secondary btn-custom">Back to Profile</a> --}}
            <form id="delete-form" action="{{ route('profile.destroy', $profile->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-danger" id="delete-btn">
                    <i class="fa fa-trash"></i> Delete My Profile
                </button>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const deleteBtn = document.getElementById('delete-btn');
    const deleteForm = document.getElementById('delete-form');

    deleteBtn.addEventListener('click', function() {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Submit the form if confirmed
                deleteForm.submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Cancelled',
                    text: 'Your profile is safe :)',
                    icon: 'error'
                });
            }
        });
    });
</script>
</body>
</html>
