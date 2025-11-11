<?php
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .login-container {
            width: 340px;
            padding: 2.5rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
        }

        .input-group {
            margin-bottom: 1rem;
            text-align: left;
        }

        .input-group label {
            font-size: 0.9rem;
            color: #555;
            display: block;
            margin-bottom: 0.4rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.7rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: 0.3s;
        }

        .input-group input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 8px rgba(102, 126, 234, 0.3);
        }

        .login-btn {
            width: 100%;
            padding: 0.8rem;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 1rem;
        }

        .login-btn:hover {
            background: #5a6fd8;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.9rem;
            margin-top: 0.8rem;
        }

        .success-message {
            color: #27ae60;
            font-size: 0.9rem;
            margin-top: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Reset Password</h2>
        <form action="update-account.php" method="POST">
            <div class="input-group">
                <label for="email">Enter Your Email</label>
                <input type="email" id="email" name="email" required placeholder="admin@example.com">
            </div>
            <div class="input-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required minlength="6">
            </div>
            <button type="submit" name="update" class="login-btn">Update Password</button>
        </form>

        <?php
        if (isset($_GET['error'])) {
            echo "<p class='error-message'>Email not found!</p>";
        }
        if (isset($_GET['success'])) {
            echo "<p class='success-message'>Password updated successfully!</p>";
        }
        ?>
    </div>
</body>

</html>