<?php
session_start();
if (isset($_SESSION['admin_email'])) {
    header("Location: dashboard.php");
    exit();
}

include_once("config.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Apply salt and SHA-1 hashing to the input password
    $salt = "villageonweb";
    $hashed_password = sha1($salt . $password);
    
    // Query to check if the hashed password and email match
    $query = "SELECT * FROM admins WHERE email = '$email' AND password = '$hashed_password'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $_SESSION['admin_email'] = $email;
        header("Location: dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password. Please try again.'); window.location.href='index.php';</script>";
       
    }
}

mysqli_close($conn);
?>
