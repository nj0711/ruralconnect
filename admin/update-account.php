<?php
include('config.php');

if (isset($_POST['update'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($email) || empty($password)) {
        header("Location: forget.php?error=1");
        exit();
    }

    if (strlen($password) < 6) {
        header("Location: forget.php?error=1");
        exit();
    }

    // Sanitize
    $email = mysqli_real_escape_string($conn, $email);

    // Check if email exists
    $check = mysqli_query($conn, "SELECT * FROM admins WHERE email = '$email'");
    if (mysqli_num_rows($check) == 0) {
        header("Location: forget.php?error=1");
        exit();
    }

    // Hash password
    $salt = "villageonweb";
    $hashed_password = sha1($salt . $password);

    // Update password
    $query = "UPDATE admins SET password = '$hashed_password' WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Set success message in session
        session_start();
        $_SESSION['success_message'] = "Password updated successfully! Please login.";
        header("Location: index.php");
        exit();
    } else {
        header("Location: forget.php?error=1");
        exit();
    }
}
