<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,600&display=swap">
    <style>
        /* Basic Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            color: #333;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            overflow: hidden;
        }

        /* 404 Page Container */
        .page_404 {
            text-align: center;
            max-width: 600px;
            padding: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            animation: fadeInUp 1s ease-out;
        }

        /* 404 Background & Image */
        .four_zero_four_bg {
            background: url('https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif') no-repeat center;
            background-size: contain;
            height: 220px;
            margin-bottom: 20px;
        }

        /* Title and Text Styling */
        .error-title {
            font-size: 6rem;
            color: #ff6b6b;
            font-weight: 600;
            margin: 20px 0;
        }

        .error-message {
            font-size: 1.2rem;
            color: #555;
            margin-bottom: 15px;
        }

        .error-suggestion {
            font-size: 1rem;
            color: #777;
            margin-bottom: 30px;
        }

        /* Button Styling */
        .link_404 {
            text-decoration: none;
            color: #fff !important;
            padding: 12px 30px;
            background: #ff6b6b;
            border-radius: 30px;
            font-weight: 500;
            font-size: 1rem;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 8px 16px rgba(255, 107, 107, 0.4);
        }

        .link_404:hover {
            background: #ff4949;
            transform: translateY(-3px);
            box-shadow: 0 12px 20px rgba(255, 73, 73, 0.5);
        }

        /* Animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <section class="page_404">
        <div class="four_zero_four_bg"></div>
        <h1 class="error-title">404</h1>
        <p class="error-message">Oops! Page Not Found</p>
        <p class="error-suggestion">The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
        <a href="/login" class="link_404">Return to Login</a>
    </section>
</body>

</html>
