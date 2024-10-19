<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Recipe Sharing Platform</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            display: flex;
            align-items: center;
            padding: 30px;
            border-bottom: 1px solid #ddd;
            background-color: #fafafa;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }

        .profile-image {
            border-radius: 50%;
            border: 4px solid #ff6f61;
            width: 150px;
            height: 150px;
            object-fit: cover;
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            margin-left: 20px;
            text-align: left;
        }

        .profile-info h1 {
            font-size: 2.5rem;
            font-weight: 600;
            color: #333;
        }

        .profile-info p {
            font-size: 1rem;
            color: #777;
            margin-bottom: 5px;
        }

        .follow-section {
            display: flex;
            justify-content: flex-start;
            margin-top: 15px;
            gap: 30px;
        }

        .follow-section div {
            text-align: center;
        }

        .follow-section .count {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .btn-follow {
            padding: 10px 25px;
            border-radius: 25px;
            font-weight: 500;
            color: #fff;
            background-color: #ff6f61;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
            cursor: pointer;
        }

        .btn-follow:hover {
            background-color: #ff836e;
            transform: scale(1.05);
        }

        .recipe-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 30px;
        }

        .recipe-card {
            flex: 0 0 calc(33.33% - 20px);
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .recipe-image {
            width: 100%;
            height: 200px;
            border-radius: 15px 15px 0 0;
            overflow: hidden;
            object-fit: cover;
        }

        .recipe-title {
            font-size: 1.2rem;
            font-weight: 600;
            margin: 10px;
            color: #333;
        }

        .recipe-actions {
            display: flex;
            justify-content: space-between;
            margin: 10px;
            font-size: 0.9rem;
        }

        .recipe-actions i {
            color: #ff6f61;
        }

        .about-me {
            margin-top: 30px;
            border: 1px solid #ddd;
            border-radius: 15px;
            padding: 15px;
        }

        .about-me h3 {
            margin-bottom: 10px;
            font-size: 1.5rem;
            font-weight: 600;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .recipe-card {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .recipe-card {
                flex: 0 0 calc(100% - 20px);
            }

            .profile-header {
                flex-direction: column;
                align-items: center;
            }

            .profile-image {
                margin-bottom: 20px;
            }

            .profile-info h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
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
    <div class="container">
        <div class="profile-header">
            <img src="https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211467.png"
                alt="Profile Image" class="profile-image" onclick="openEditProfileModal()">
            <div class="profile-info">
                <h1>{{ $user->name }}</h1>
                <p class="user-bio">{{ $user->bio ? $user->bio : 'No bio available.' }}</p>
                <div class="follow-section">
                    <div>
                        <p class="count">{{ $user->recipes()->count() }}</p>
                        <p>Recipes</p>
                    </div>
                    <div>
                        <p class="count">10M</p>
                        <p>Followers</p>
                    </div>
                    <div>
                        <p class="count">10</p>
                        <p>Following</p>
                    </div>
                </div>
                <button class="btn-follow">Follow</button>
            </div>
        </div>

        <!-- Add Favorite Recipes Button -->
        <div class="text-center mt-4">
            @if (Auth::check() && $user->id === Auth::id())
                <a href="{{ url('favorite-recipes') }}" class="btn btn-view-favorites">View My Favorite Recipes</a>
            @endif
            <a href="home" class="btn btn-back">Back</a>
        </div>

        <div class="recipe-grid">
            @foreach ($recipes as $recipe)
                <div class="recipe-card">
                    <a href="{{ url('user/user-show/' . $recipe->id) }}">
                        <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                            class="recipe-image">
                    </a>
                    <h3 class="recipe-title">{{ $recipe->title }}</h3>
                    <div class="recipe-actions">
                        <span><i class="fa fa-heart"></i> {{ $recipe->favorites->count() }} Likes</span>
                        <span><i class="fa fa-share-alt"></i> Share</span>
                        @if (Auth::check() && $recipe->user_id === Auth::id())
                            <!-- Check if the user is the owner -->
                            <div>
                                <a href="{{ url('recipe-edit/' . $recipe->id) }}"
                                    class="btn btn-sm btn-primary">Edit</a>
                                <a href="javascript:void(0)"
                                    onclick="confirmDelete('{{ url('recipe-delete/' . $recipe->id) }}')"
                                    class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="about-me">
            <h3>About Me</h3>
            <p>{{ $user->about ? $user->about : 'No information available.' }}</p>
        </div>
    </div>

    <script>
        function openEditProfileModal() {
            // Functionality to open the edit profile modal
            alert("Edit Profile Modal Opens Here!");
        }
    </script>
    <script>
        function confirmDelete(deleteUrl) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ff6f61', // Matches your site's theme
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // If confirmed, create a form and submit it
                    var form = document.createElement('form');
                    form.action = deleteUrl;
                    form.method = 'POST';

                    // Add CSRF token field
                    var csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}'; // Laravel CSRF token
                    form.appendChild(csrfInput);

                    // Add DELETE method field
                    var methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'get';
                    form.appendChild(methodInput);

                    document.body.appendChild(form);
                    form.submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire(
                        'Cancelled',
                        'Your recipe is safe :)',
                        'error'
                    );
                }
            });
        }
    </script>

</body>

</html>
