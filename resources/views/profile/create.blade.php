<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Profile</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f2f5;
        }

        .container {
            max-width: 600px;
            margin-top: 50px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }

        h1 {
            font-weight: 600;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-group i {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #888;
            font-size: 1.2rem;
        }

        .form-control {
            padding-left: 45px;
            height: 45px;
            font-size: 0.95rem;
            border-radius: 30px;
            box-shadow: none;
        }

        .form-control-file {
            border-radius: 30px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #3897f0;
        }

        .btn-primary {
            background-color: #3897f0;
            border-color: #3897f0;
            width: 100%;
            border-radius: 30px;
            padding: 10px;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #307dcf;
            border-color: #307dcf;
        }

        .profile-icon {
            font-size: 80px;
            color: #3897f0;
            display: block;
            margin: 0 auto 20px;
        }

        .text-center p {
            font-size: 0.9rem;
            color: #666;
        }

        .custom-file-label::after {
            content: "Choose file";
        }

        /* Additional styling to improve icon alignment */
        .form-control::placeholder {
            color: #999;
        }

        .form-group input[type="file"] {
            padding-left: 45px;
        }
    </style>
</head>

<body>

    <div class="container">
        <i class="fas fa-user-circle profile-icon"></i>
        <h1>Create Profile</h1>

        <form action="{{ route('profile.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
            </div>

            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" required>
            </div>

            <div class="form-group">
                <i class="fas fa-info-circle"></i>
                <textarea name="bio" id="bio" class="form-control" placeholder="A short bio about yourself"></textarea>
            </div>

            <div class="form-group">
                <i class="fas fa-camera"></i>
                <input type="file" name="profile_picture" id="profile_picture" class="form-control-file">
            </div>

            <button type="submit" class="btn btn-primary">Create Profile</button>
        </form>

        <div class="text-center mt-3">
            <p>Already have a profile? <a href="{{ url('login') }}" class="text-primary">Login</a></p>
        </div>
    </div>

</body>

</html>
