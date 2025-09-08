<?php
// Admin panel database configuration
$dbHost = 'localhost';
$dbName = "villageonweb_admin_panel";  // Replace with your actual admin panel database name
$dbUser = "root";            // Replace with your actual database username
$dbPass = "root";                // Replace with your actual database password

// Create connection for admin panel
$conn = mysqli_connect("localhost", "root", "", "villageonweb_admin_panel");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
