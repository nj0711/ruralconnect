<?php
// Path to the forgot-account.php file
$filePath = __DIR__ . '/forgot-account.php';

if (file_exists($filePath)) {
    // If the file exists, redirect to forgot-account.php
    header("Location: forgot-account.php");
    exit();
} else {
    // If the file doesn't exist, display an error message
    echo "<h2 style='color: red; text-align: center;'>Upload the file 'forgot-account.php' to change the password.</h2>";
    echo "<p style='text-align: center;'><a href='index.php'>Back to Login</a></p>";
}
?>
