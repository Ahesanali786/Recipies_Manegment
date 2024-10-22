<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Recipe Sharing Platform</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 750px;
            margin-top: 60px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            padding: 40px 30px;
        }

        h1 {
            font-weight: 600;
            text-align: center;
            color: #333;
            margin-bottom: 35px;
            font-size: 1.8rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 30px;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #666;
            font-size: 1.2rem;
        }

        .form-control {
            padding-left: 50px;
            height: 50px;
            font-size: 1rem;
            border-radius: 30px;
            border: 1px solid #ccc;
        }

        .form-control:focus {
            border-color: #3897f0;
            box-shadow: none;
        }

        textarea.form-control {
            padding-left: 50px;
            height: 130px;
            border-radius: 20px;
        }

        .form-control-file {
            padding-left: 45px;
            border-radius: 20px;
            font-size: 0.95rem;
            border: 1px solid #ccc;
        }

        label.custom-file-label {
            margin-left: 50px;
            font-size: 1rem;
            color: #666;
        }

        .btn-primary {
            background-color: #3897f0;
            border-color: #3897f0;
            width: 100%;
            border-radius: 30px;
            padding: 10px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #307dcf;
            border-color: #307dcf;
        }

        .btn-secondary {
            width: 100%;
            border-radius: 30px;
            padding: 10px;
            font-size: 1.1rem;
            font-weight: 500;
            margin-top: 15px;
        }

        .alert {
            font-size: 0.9rem;
            text-align: center;
            margin-bottom: 25px;
        }

        .custom-file {
            position: relative;
        }

        .custom-file input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Edit Profile</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('profile.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" class="form-control" id="name" name="name" value="{{ $profile->name }}" required placeholder="Name">
            </div>

            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" class="form-control" id="email" name="email" value="{{ $profile->email }}" required placeholder="Email">
            </div>

            <div class="form-group">
                <i class="fas fa-info-circle"></i>
                <textarea class="form-control" id="bio" name="bio" placeholder="Bio">{{ $profile->bio }}</textarea>
            </div>

            <div class="form-group">
                <label for="profile_picture" class="d-flex align-items-center">
                    <span style="font-size: 1.1rem; color: #333;">Choose Profile Picture</span>
                    <i class="fas fa-camera" style="font-size: 1.5rem; color: #007bff; margin: 17px -7px;"></i>
                </label>
                <input type="file" class="form-control-file mt-2" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Update Profile</button>
            <a href="{{ url('profile') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>

</html>
