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
            background: linear-gradient(135deg, #ececec, #f8f9fa);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 700px;
            margin-top: 60px;
        }

        .profile-card {
            background-color: #ffffff;
            border: none;
            border-radius: 12px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
            padding: 40px;
            color: #333;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .profile-card:hover {
            transform: scale(1.02);
        }

        .profile-header {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 25px;
        }

        .profile-header img {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #007bff;
            transition: box-shadow 0.3s ease-in-out;
        }

        .profile-header img:hover {
            box-shadow: 0 8px 15px rgba(0, 123, 255, 0.6);
        }

        .profile-header h1 {
            font-size: 28px;
            font-weight: 700;
            color: #333;
            margin-top: 15px;
        }

        .profile-header h1::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: #007bff;
            margin: 8px auto 0;
            border-radius: 5px;
        }

        .profile-details {
            font-size: 16px;
            color: #666;
            text-align: left;
            margin-top: 25px;
            line-height: 1.6;
        }

        .profile-details p {
            margin: 12px 0;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 12px 30px;
            font-size: 15px;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-delete {
            background-color: #e63946;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
            box-shadow: 0px 4px 15px rgba(230, 57, 70, 0.5);
        }

        .btn-delete i {
            margin-right: 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="profile-card">
        <div class="profile-header">
            @if($profile->profile_picture)
                <img src="{{ Storage::url($profile->profile_picture) }}" alt="Profile Picture">
            @else
                <img src="https://via.placeholder.com/140" alt="Profile Picture">
            @endif
            <h1>{{ $profile->name }}</h1>
        </div>

        <div class="profile-details">
            <p><strong>Email:</strong> {{ $profile->email }}</p>
            <p><strong>Bio:</strong> {{ $profile->bio ?? 'No bio provided.' }}</p>
            <p><strong>Profile Created:</strong> {{ $profile->created_at->format('d M Y') }}</p>
            <p><strong>Last Updated:</strong> {{ $profile->updated_at->format('d M Y') }}</p>
        </div>

        <div class="text-center mt-4">
            <form id="delete-form" action="{{ route('profile.destroy', $profile->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-delete btn-custom" id="delete-btn">
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
                confirmButton: 'btn btn-success btn-custom',
                cancelButton: 'btn btn-danger btn-custom'
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                deleteForm.submit();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire({
                    title: 'Cancelled',
                    text: 'Your profile is safe :)',
                    icon: 'info'
                });
            }
        });
    });
</script>
</body>
</html>
