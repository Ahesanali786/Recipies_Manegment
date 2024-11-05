<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Recipe Sharing Platform</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 900px;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }

        .profile-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 20px;
            border: 3px solid #ddd;
        }

        .profile-info {
            flex: 1;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-bio {
            color: #666;
            margin-bottom: 10px;
        }

        .follow-section {
            display: flex;
            justify-content: space-around;
            margin-top: 10px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .count {
            font-size: 1.5rem;
            font-weight: 600;
            color: #333;
        }

        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }

        .recipe-card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
            position: relative;
        }

        .recipe-card:hover {
            transform: scale(1.02);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .recipe-image {
            width: 100%;
            height: 150px;
            object-fit: cover;
            border-bottom: 2px solid #f8f9fa;
        }

        .recipe-title {
            padding: 10px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
        }

        .recipe-actions {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            font-size: 0.9rem;
            border-top: 1px solid #ddd;
        }

        .btn-sm {
            font-size: 0.8rem;
        }

        .btn-primary {
            background-color: #3897f0;
            border-color: #3897f0;
        }

        .btn-danger {
            background-color: #e1306c;
            border-color: #e1306c;
        }

        .btn-primary:hover,
        .btn-danger:hover {
            opacity: 0.8;
        }

        .text-muted {
            color: #666;
        }

        .no-profile {
            text-align: center;
            margin-top: 50px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Center the buttons horizontally */
            gap: 20px;
            /* Space between buttons */
        }

        .btn-secondary {
            background-color: #f5f5f5;
            color: #000;
            border: 1px solid #ccc;
        }

        .btn-secondary:hover {
            background-color: #e0e0e0;
        }

        .btn-dark {
            background-color: #333;
            color: #fff;
            border: 1px solid #000;
        }

        .btn-dark:hover {
            background-color: #555;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        .btn-secondary,
        .btn-dark {
            margin: 0;
            /* Remove margin to avoid extra space */
        }

        .dropdown-menu {
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item {
            padding: 10px 15px;
            font-size: 16px;
            color: #333;
        }

        .dropdown-item:hover {
            background-color: #e9ecef;
            color: #007bff;
            border-radius: 5px;
        }

        .dropdown-item i {
            font-size: 18px;
        }
        .alert-container {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-top: 50px;
        }

        .alert-container img {
            width: 150px;
            margin-bottom: 20px;
            opacity: 0.8;
        }

        .alert-message {
            font-size: 18px;
            color: #555;
            font-weight: 500;
            margin-bottom: 15px;
        }

        .add-recipe-btn {
            color: #fff;
            background-color: #007bff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 500;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .add-recipe-btn:hover {
            background-color: #0056b3;
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
        <a href="{{ url('home') }}" class="btn btn-secondary mb-3">
            <i class="fa fa-arrow-left"></i> Back
        </a>
        <!-- Button aligned to the right -->
        <div class="dropdown mb-3 float-end">
            @if (Auth::check() && $profile && Auth::user()->id === $profile->user_id)
                <!-- user ni profile na hoy tyare aa totgle button pn dekhase nhi  -->
                <button class="btn btn-secondary" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                    aria-expanded="false" style="border: none; color: #050404; background-color: #fff;">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width: 200px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('profiles/edit-profile') }}">
                            <i class="fas fa-user-edit me-2"></i> Edit Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('account-info') }}">
                            <i class="fas fa-user-circle me-2"></i> <!-- Updated icon -->
                            Account Info
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('favorite-recipes') }}">
                            <i class="fas fa-heart me-2"></i> Favorite Recipes
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ url('/profile/cheng_password') }}">
                            <i class="fas fa-key me-2"></i> Change Password
                        </a>
                    </li>
                </ul>
            @endif
        </div>
        @if ($profile)
            <div class="profile-header">
                @if ($profile->profile_picture)
                    <img src="{{ asset('storage/' . $profile->profile_picture) }}" class="profile-image"
                        alt="Profile Picture">
                @else
                    <img src="{{ asset('default-profile.png') }}" class="profile-image" alt="Default Profile Picture">
                @endif

                <div class="profile-info">
                    <h1 class="profile-name">{{ $profile->name ?? 'User Name Not Available' }}</h1>
                    <p class="profile-bio">{{ $profile->bio ?? 'No bio provided' }}</p>
                    {{-- <p class="profile-bio">
                        Created The Profile:-{{ $profile->created_at ? $profile->created_at->format('F j, Y') : 'No bio provided' }} <br> <br>
                        Last Update The Profile:-{{ $profile->updated_at ? $profile->updated_at->format('F j, Y') : 'No bio provided' }}
                    </p> --}}
                    <div class="follow-section">
                        <div>
                            <p class="count">{{ $recipes->count() }}</p>
                            <p class="text-muted">Recipes</p>
                        </div>
                        <div>
                            <p class="count">{{ $user->followers_count ?? '0' }}</p>
                            <p class="text-muted">Followers</p>
                        </div>
                        <div>
                            <p class="count">{{ $user->following_count ?? '0' }}</p>
                            <p class="text-muted">Following</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="button-container">
                @if (Auth::check() && Auth::user()->id === $profile->user_id)
                    <div class="mb-3">
                        <a href="javascript:void(0)" onclick="window.location='{{ url('profiles/edit-profile') }}'"
                            class="btn btn-secondary">Edit Profile</a>
                        <a href="javascript:void(0)" onclick="window.location='{{ url('favorite-recipes') }}'"
                            class="btn btn-dark">My Favorite Recipes</a>
                    </div>
                @endif
            </div> --}}


            <h3 class="mt-4">My Recipes</h3>
            <div class="recipe-grid">
                @if ($recipes->count() == 0)
                    <div class="alert-container">
                        <img src="https://via.placeholder.com/150x150?text=No+Recipes+Yet" alt="No Recipes Yet">
                        <p class="alert-message">You haven't added any recipes yet.</p>
                        <a href="{{ url('recipe-add') }}" class="add-recipe-btn">Add Your First Recipe</a>
                    </div>
                @else
                    @foreach ($recipes as $recipe)
                        <div class="recipe-card">
                            <a href="{{ url('user/user-show/' . $recipe->id) }}">
                                <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                                    class="recipe-image">
                            </a>
                            <h3 class="recipe-title">{{ $recipe->title }}</h3>
                            <div class="ratings">
                                @php
                                    $averageRating = $recipe->reviews()->avg('rating');
                                    $filledStars = floor($averageRating);
                                    $halfStar = $averageRating - $filledStars >= 0.5 ? 1 : 0;
                                @endphp

                                @for ($i = 1; $i <= $filledStars; $i++)
                                    <i class="bi bi-star-fill"></i>
                                @endfor

                                @if ($halfStar)
                                    <i class="bi bi-star-half"></i>
                                @endif

                                @for ($i = 1; $i <= 5 - $filledStars - $halfStar; $i++)
                                    <i class="bi bi-star"></i>
                                @endfor
                            </div>
                            <p class="average-rating">
                                @if ($averageRating)
                                    Average Rating: {{ number_format($averageRating, 1) }} / 5
                                @else
                                    No ratings yet
                                @endif
                            </p>
                            <div class="recipe-actions">
                                <span><i class="fa fa-heart"></i> {{ $recipe->favorites_count ?? 0 }} </span>
                                <span><i class="fa fa-comment"></i> {{ $recipe->reviews_count ?? 0 }} </span>
                                {{-- <span><i class="fa fa-share-alt"></i> Share</span> --}}

                                @if (Auth::check() && $recipe->user_id === Auth::id())
                                    <div>
                                        <!-- Pin/Unpin Button -->
                                        <form action="{{ route('recipe.pin', $recipe->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-warning">
                                                <i class="fa {{ $recipe->pinned ? 'fa-times' : 'fa-thumbtack' }}"></i>
                                            </button>
                                        </form>

                                        <!-- Edit Button -->
                                        <a href="javascript:void(0)"
                                            onclick="window.location='{{ url('recipe-edit/' . $recipe->id) }}'"
                                            class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Delete Button -->
                                        <a href="javascript:void(0)"
                                            onclick="confirmDelete('{{ url('recipe-delete/' . $recipe->id) }}')"
                                            class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @else
            <div class="no-profile text-center">
                <i class="fas fa-user-circle" style="font-size: 80px; color: #6c757d;"></i>
                <h2 class="mt-3" style="font-weight: 600; color: #343a40;">Profile Not Found</h2>
                <p style="color: #6c757d; font-size: 1.1rem;">
                    It seems like you haven't set up your profile yet.
                </p>
                @if (Auth::check() && Auth::user()->id === $user->id)
                    <a href="{{ route('profile.create') }}" class="btn btn-success btn-lg mt-3"
                        style="border-radius: 30px; padding: 10px 20px;">
                        <i class="fas fa-user-plus"></i> Create Profile
                    </a>
                @endif
            </div>
        @endif
    </div>

    <script>
        function confirmDelete(url) {
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
                    window.location.href = url;
                }
            });
        }
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
