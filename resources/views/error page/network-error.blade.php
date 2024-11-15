<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Network Check</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        #network-error {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding-top: 50px;
            z-index: 9999;
        }

        #network-error h1 {
            font-size: 50px;
        }

        #network-error p {
            font-size: 20px;
        }

        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

    <!-- Network Error Message -->
    <div id="network-error">
        <h1>Network Error</h1>
        <p>Your network is currently off. Please check your connection and try again.</p>
    </div>

    <!-- Main content -->
    <div class="content">
        <h1>Welcome to the Page!</h1>
        <p>This content will be visible only if the network is on.</p>
    </div>

    <script>
        // Function to check if the network is online
        function checkNetworkStatus() {
            if (!navigator.onLine) {
                // If the network is off, show the error message
                document.getElementById('network-error').style.display = 'block';
                // Hide main content
                document.querySelector('.content').style.display = 'none';
            } else {
                // If the network is on, show the main content
                document.getElementById('network-error').style.display = 'none';
                document.querySelector('.content').style.display = 'block';
            }
        }

        // Check network status on page load
        window.addEventListener('load', checkNetworkStatus);

        // Listen for changes in network status (online or offline)
        window.addEventListener('online', checkNetworkStatus);
        window.addEventListener('offline', checkNetworkStatus);
    </script>

</body>
</html>
