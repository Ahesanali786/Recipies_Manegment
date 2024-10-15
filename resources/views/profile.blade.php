<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recipe Sharing Platform</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Base Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f3f4f6;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
        }

        .profile-header {
            display: flex;
            align-items: center;
            padding: 40px;
            background-color: #fafafa;
            border-bottom: 1px solid #ddd;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }

        .profile-image {
            border-radius: 50%;
            border: 4px solid #ff6f61;
            width: 130px;
            height: 130px;
            object-fit: cover;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-info {
            margin-left: 20px;
            text-align: left;
        }

        .profile-info h1 {
            font-size: 2.2rem;
            font-weight: 600;
            color: #333;
        }

        .profile-info p {
            font-size: 1rem;
            color: #777;
        }

        .follow-section {
            display: flex;
            justify-content: space-between;
            max-width: 400px;
            margin-top: 15px;
            gap: 30px;
        }

        .follow-section div {
            text-align: center;
        }

        .follow-section div p {
            margin: 0;
        }

        .follow-section .count {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .btn-follow {
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 500;
            color: #fff;
            background-color: #ff6f61;
            transition: background-color 0.3s ease;
        }

        .btn-follow:hover {
            background-color: #ff836e;
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
            padding: 15px;
            border-radius: 12px;
            border: 1px solid #ddd;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .recipe-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .recipe-image {
            width: 100%;
            height: 200px;
            border-radius: 10px;
            overflow: hidden;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .recipe-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin: 10px 0;
        }

        .recipe-stats {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            font-size: 0.9rem;
        }

        .recipe-stats i {
            color: #ff6f61;
        }

        /* Button styles */
        .btn-view-favorites {
            background-color: #ff6f61;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 500;
            margin-right: 10px;
            transition: background-color 0.3s ease;
        }

        .btn-view-favorites:hover {
            background-color: #ff836e;
        }

        .btn-back {
            background-color: #ccc;
            color: white;
            border-radius: 20px;
            padding: 10px 20px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #bbb;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
            }

            .recipe-card {
                flex: 0 0 calc(50% - 20px);
            }
        }

        @media (max-width: 576px) {
            .recipe-card {
                flex: 0 0 calc(100% - 20px);
            }

            .profile-header {
                text-align: center;
            }

            .profile-image {
                margin-bottom: 20px;
            }

            .profile-info h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <div class="container profile-container">
        <div class="profile-header">
            <img src="https://png.pngtree.com/png-vector/20231019/ourmid/pngtree-user-profile-avatar-png-image_10211467.png"
                alt="Profile Image" class="profile-image">
            <div class="profile-info">
                <h1>{{ $user->name }}</h1>
                <p>{{ $user->name }}</p>
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
                <button class="btn btn-follow mt-3">Follow</button>
            </div>
        </div>

        <!-- Add Favorite Recipes Button -->
        <div class="text-center mt-4">
            @if (Auth::check() && $user->id === Auth::id())
            <a href="{{ url('favorite-recipes') }}" class="btn btn-view-favorites">View My Favorite Recipes</a>
            @endif
            <a href="javascript:history.back()" class="btn btn-back">Back</a>
        </div>

        <div class="recipe-grid">
            @foreach ($recipes as $recipe)
                <div class="recipe-card">
                    <a href="{{ url('user/user-show/' . $recipe->id) }}">
                        <img src="{{ asset('webimg/' . $recipe->image) }}" alt="{{ $recipe->title }}"
                            class="recipe-image">
                    </a>
                    <h3 class="recipe-title">{{ $recipe->title }}</h3>
                    <div class="recipe-stats">
                        <span><i class="fa fa-star"></i> {{ number_format($recipe->reviews()->avg('rating'), 1) }} / 5</span>
                        <span><i class="fa fa-heart"></i> {{ $recipe->favorites->count() }} Likes</span>
                    </div>

                    <!-- Edit and Delete Buttons -->
                    @if ($recipe->user_id === Auth::id())
                        <div class="mt-2">
                            <a href="/recipe-edit/{{ $recipe->id }}">
                                <i style="color: rgb(5, 138, 129); font-size:20px;" class="fas fa-edit"></i>
                            </a>
                            <a href="/recipe-delete/{{ $recipe->id }}" class="delete-btn">
                                <i style="color: red; font-size:20px;" class="fas fa-trash"></i>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

    </div>
</body>

</html>
