<?php
session_start();
if (isset($_SESSION['village_admin_email'])) {
    header("Location: dashboard.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        /* General styling */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f9; /* Light background */
        }

        .login-container {
            width: 320px;
            padding: 2rem;
            background-color: #ffffff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        .input-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .input-group label {
            font-size: 0.9rem;
            color: #555;
            margin-bottom: 0.2rem;
            display: block;
        }

        .input-group input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1rem;
        }

        .input-group input:focus {
            border-color: #0066cc; /* Highlight color */
            outline: none;
        }

        .login-btn {
            width: 100%;
            padding: 0.6rem;
            border: none;
            background-color: #0066cc; /* Primary button color */
            color: #ffffff;
            font-size: 1rem;
            font-weight: bold;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 1rem;
        }

        .login-btn:hover {
            background-color: #005bb5;
        }

        .error-message {
            color: red;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Admin Login</h2>
        <form id="loginForm" action="login_process.php" method="POST" onsubmit="return validateForm()">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="login-btn">Login</button>
            <p id="error" class="error-message"></p>
        </form>
    </div>

    <script>
        // JavaScript validation to prevent basic SQL injection attempts
        function validateForm() {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const errorElement = document.getElementById('error');

            // Regular expression to detect potentially dangerous characters
            const regex = /['"=;*\/-]/;

            if (regex.test(email) || regex.test(password)) {
                errorElement.textContent = "Invalid characters detected in input.";
                return false;
            }

            return true;
        }
    </script>
</body>
</html>