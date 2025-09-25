<?php
session_start();
include 'config.php';  // Include your configuration file

class VillageAdminLogin {
    private $db;

    public function __construct() {
        $this->db = new ConnDb();
    }

    public function login($email, $password) {
        // Define salt
        $salt = "villageonweb";
        
        // Hash the password with SHA1 and salt
        $hashedPassword = sha1($password . $salt);

        // Escape input values to prevent SQL injection
        $email = $this->db->escape($email);

        // Query to check if admin exists with given email and password hash
        $query = "SELECT * FROM admin WHERE email = '$email' AND passwordhash = '$hashedPassword'";
        $result = $this->db->selectdata("admin", $query);

        // Check if user exists
        if (is_array($result) && count($result) > 0) {
            // Set session variable
            $_SESSION['village_admin_email'] = $email;
            // Redirect to dashboard.php on successful login
            header("Location: dashboard.php");
            exit();
        } else {
            // Return false if login fails
            header("Location: index.php");
            exit();
        }
    }
}

// Usage
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $login = new VillageAdminLogin();
    $success = $login->login($email, $password);
    
    if (!$success) {
        // Display error message using JavaScript
        echo "<script>alert('Invalid email or password!');</script>";
    }
}
?>
