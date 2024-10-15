<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            font-family: 'Open Sans', sans-serif;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0 20px;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.6s ease;
            max-width: 450px;
            transition: transform 0.3s;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h2 {
            margin-bottom: 20px;
            color: #0072ff;
            text-align: center;
            font-weight: 700;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            transition: all 0.3s;
            border-radius: 10px;
            border: 1px solid #ccc;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            border-color: #0072ff;
            box-shadow: 0 0 5px rgba(0, 114, 255, 0.5);
        }

        .btn {
            height: 60px;
            border-radius: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            transition: all 0.3s;
        }

        .pushable {
            position: relative;
            background: transparent;
            padding: 0px;
            border: none;
            cursor: pointer;
            outline: none;
            display: inline-block;
            margin-top: 20px;
        }

        .shadow {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            background: rgba(0, 114, 255, 0.3);
            border-radius: 8px;
            filter: blur(5px);
            transform: translateY(4px);
            transition: transform 0.3s;
        }

        .front {
            display: block;
            position: relative;
            border-radius: 8px;
            background: #0072ff;
            padding: 16px 32px;
            color: white;
            font-family: inherit;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 1rem;
            transform: translateY(-4px);
            transition: transform 0.3s;
        }

        .pushable:hover .front {
            transform: translateY(-6px);
        }

        .pushable:hover .shadow {
            transform: translateY(2px);
        }

        .pushable:active .front {
            transform: translateY(-2px);
        }

        .pushable:active .shadow {
            transform: translateY(1px);
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <h2>Register</h2>

    <!-- Display Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Registration Form -->
    <form method="POST" action="/register">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <!-- Submit Button -->
        <div class="d-flex justify-content-center">
            <button class="pushable">
                <span class="shadow"></span>
                <span class="front">Submit</span>
            </button>
        </div>
    </form>
    <br>

    <p>If you are registered, click here <a href="/login">Login</a></p>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
