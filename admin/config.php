<?php
// Admin panel database configuration
$dbHost = 'localhost';
$dbName = 'ruralconnectadmin_panel';  // Replace with your actual admin panel database name
$dbUser = "root";            // Replace with your actual database username
$dbPass = "root";                // Replace with your actual database password

// Create connection for admin panel
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
