<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <style>
        /* Basic Reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f0f4f8;
        }

        .container {
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h3 {
            color: #333;
            margin-bottom: 1rem;
        }

        .error-message {
            color: #e74c3c;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
            text-align: left;
        }

        input[type="email"],
        input[type="text"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        input[type="email"]:focus,
        input[type="text"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 4px rgba(52, 152, 219, 0.3);
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
        }

        button:hover {
            background-color: #2980b9;
        }

        .footer-note {
            margin-top: 1rem;
            font-size: 0.875rem;
            color: #777;
        }
    </style>
</head>

<body>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script>
        // Check if there's a 'status' session message
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: '<strong>Success!</strong>',
                html: '<p>{{ session('status') }}</p>',
                iconColor: '#4CAF50',
                background: '#f9f9f9',
                color: '#333',
                showCloseButton: true,
                showConfirmButton: false,
                timer: 3000,
                toast: true,
                position: 'top-end',
                customClass: {
                    popup: 'animate__animated animate__fadeInDown'
                }
            });
        @endif
    </script>
    <div class="container">
        <h3>Email Verification</h3>

        <!-- Display error message if session has 'error' -->
        @if (session('error'))
            <p class="error-message">{{ session('error') }}</p>
        @endif

        <form action="{{ route('verify.otp') }}" method="POST">
            @csrf
            <div>
                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                    placeholder="Enter your email">
            </div>

            <div>
                <label for="otp">One-Time Password (OTP):</label>
                <input type="text" id="otp" name="otp" required placeholder="Enter OTP">
            </div>

            <button type="submit">Verify OTP</button>
        </form>
    </div>
</body>

</html>
