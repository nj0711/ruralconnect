<?php
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password | VillageOnWeb</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --gray-100: #f8fafc;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-500: #64748b;
            --gray-700: #334155;
            --gray-900: #1e293b;
            --white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0, 0, 0, 0.1);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 25px -3px rgba(0, 0, 0, 0.1);
            --radius: 24px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .login-wrapper {
            display: flex;
            max-width: 1000px;
            width: 100%;
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-section {
            flex: 1;
            padding: 3rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-section h1 {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--gray-900);
            margin-bottom: 0.5rem;
        }

        .form-section p {
            color: var(--gray-500);
            font-size: 1rem;
            margin-bottom: 2rem;
        }

        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group .icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-500);
            font-size: 1.1rem;
        }

        .input-group input {
            width: 100%;
            padding: 0.9rem 1rem;
            border: 1.5px solid var(--gray-300);
            border-radius: 12px;
            font-size: 1rem;
            background: var(--gray-100);
            transition: all 0.2s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: var(--primary);
            background: var(--white);
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15);
        }

        .btn-login {
            width: 100%;
            padding: 0.9rem;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.5rem;
        }

        .btn-login:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
        }

        .back-link {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.95rem;
        }

        .back-link a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error-message,
        .success-message {
            font-size: 0.9rem;
            margin-top: 1rem;
            text-align: center;
            padding: 0.75rem;
            border-radius: 8px;
        }

        .error-message {
            color: #dc2626;
            background: #fee2e2;
            border: 1px solid #fecaca;
        }

        .success-message {
            color: #16a34a;
            background: #dcfce7;
            border: 1px solid #bbf7d0;
        }

        .illustration-section {
            flex: 1;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
            
        }

        .illustration-section::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            top: -50px;
            right: -50px;
            z-index: 1;
        }

        .illustration {
            width: 100%;
            max-width: 380px;
            height: auto;
            z-index: 2;
            filter: drop-shadow(0 10px 20px rgba(0, 0, 0, 0.1));
        }

        /* Mobile Responsive */
        @media (max-width: 992px) {
            .login-wrapper {
                flex-direction: column;
                max-width: 420px;
            }

            .form-section {
                padding: 2.5rem 2rem;
            }

            .illustration-section {
                padding: 2rem;
                min-height: 300px;
            }

            .illustration {
                max-width: 280px;
            }
        }

        @media (max-width: 480px) {
            .form-section {
                padding: 2rem 1.5rem;
            }

            .form-section h1 {
                font-size: 1.8rem;
            }

            .illustration-section {
                min-height: 250px;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <!-- Left: Reset Form -->
        <div class="form-section">
            <h1>Reset Password</h1>
            <p>Enter your email and new password to regain access.</p>

            <form action="update-account.php" method="POST">
                <div class="input-group">
                    <input type="email" name="email" placeholder="admin@villageonweb.com" required>
                </div>
                <div class="input-group">
                    <input type="password" name="password" placeholder="New password (min 6 chars)" minlength="6" required>
                </div>
                <button type="submit" name="update" class="btn-login">Update Password</button>
                <div class="back-link">
                    <a href="index.php">Back to Login</a>
                </div>
            </form>

            <!-- Messages -->
            <?php if (isset($_GET['error'])): ?>
                <div class="error-message">Email not found!</div>
            <?php endif; ?>

            <?php if (isset($_GET['success'])): ?>
                <div class="success-message">Password updated! Redirecting to login...</div>
                <script>
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 2000);
                </script>
            <?php endif; ?>
        </div>

        <!-- Right: Illustration -->
        <div class="illustration-section">
            <img src="../assets/forgot.jpg" alt="Workspace" class="illustration">
        </div>
    </div>
</body>

</html>