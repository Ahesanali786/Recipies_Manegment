<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(to right, #00c6ff, #0072ff);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Login Container */
        .login-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            text-align: center;
            width: 400px;
            animation: fadeIn 0.6s ease;
        }

        .login-container h2 {
            margin-bottom: 20px;
            font-size: 28px;
            color: #333;
            font-weight: bold;
        }

        /* Input Group */
        .form-group {
            margin-bottom: 20px;
            text-align: left;
            position: relative;
        }

        .form-group label {
            font-weight: bold;
            color: #555;
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px 12px 40px; /* Added left padding for the icon */
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: all 0.3s;
            background-color: #f8f9fa;
        }

        .form-group input:focus {
            outline: none;
            border: 1px solid #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.5);
        }

        /* Icon Style */
        .form-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none; /* Prevents icon from interfering with input */
        }

        /* Button */
        button {
            height: 48px;
            width: 100%;
            margin-top: 20px;
            border: none;
            border-radius: 8px;
            background-color: #007bff;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Toast Notification */
        .colored-toast {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        p {
            margin-top: 20px;
            color: #666;
        }

        /* Forgot Password Link */
        .forgot-password {
            display: block;
            margin-top: 10px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="login" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <i class="fas fa-envelope"  style="margin: 11px -3px;"></i>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <i class="fas fa-lock" style="margin: 11px -3px;"></i>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Submit</button>

            @if (session('error'))
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-right',
                    iconColor: 'red',
                    customClass: {
                        popup: 'colored-toast'
                    },
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                });

                Toast.fire({
                    icon: 'error',
                    title: "{{ session('error') }}"
                });
            </script>
            @endif
        </form>
        <a class="forgot-password" href="/password/reset">Forgot Password?</a>
        <p>If you are not registered, click here <a href="/">Register</a></p>
    </div>
</body>

</html>
