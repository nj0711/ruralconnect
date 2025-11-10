<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['village_admin_email'])) {
    header("Location: index.php");
    exit();
}

// Session management code

// Set the timeout duration (in seconds)
$timeout_duration = 600; // 10 minutes

// Check if last activity is set and calculate the inactivity period
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Last request was over 10 minutes ago, so destroy the session
    session_unset();     // Unset session variables
    session_destroy();   // Destroy the session
    header("Location: index.php"); // Redirect to login page
    exit();
}

// Update the last activity timestamp to the current time
$_SESSION['LAST_ACTIVITY'] = time();

// Session code ends

$village_admin_email = $_SESSION['village_admin_email'];
$error = $success = "";

// Fetch existing admin data
$db = new ConnDb();  // Ensure an instance of ConnDb is created
$query = "SELECT * FROM admin WHERE email = '$village_admin_email'";
$result = $db->selectdata("admin", $query);
$admin = isset($result[0]) ? $result[0] : null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_info'])) {  // Ensure this matches the name attribute in the form
        // Update only the name field
        $name = $db->escape($_POST['name']);
        $pno = $db->escape($_POST['phone']);

        $update_query = "UPDATE admin SET fullname = '$name', pno= '$pno' WHERE email = '$village_admin_email'";  // Use correct column name
        if ($db->updatedata("admin", $update_query) === "Data Updated") {
            $success = "Name updated successfully!";
        } else {
            $error = "Error updating name.";
        }
    }
}

// Close the database connection
$db->__destruct();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 20px; }
        .container { max-width: 600px; margin: auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15); }
        h2 { color: #333; text-align: center; }
        .form-group { margin-bottom: 1rem; }
        .form-group label { display: block; font-weight: bold; margin-bottom: 0.3rem; }
        .form-group input, .form-group textarea { width: 100%; padding: 0.5rem; border: 1px solid #ccc; border-radius: 4px; }
        .btn { background-color: #0066cc; color: white; padding: 0.6rem; border: none; border-radius: 4px; cursor: pointer; width: 100%; font-weight: bold; }
        .btn:hover { background-color: #005bb5; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Profile</h2>

        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <?php if ($success): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>

        <form method="POST">
            <h3>Personal Information</h3>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($admin['email']); ?>" disabled>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($admin['fullname']); ?>">
            </div>
            
            <!--<div class="form-group">-->
            <!--    <label for="name">Phone:</label>-->
            <!--    <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($admin['pno']); ?>">-->
            <!--</div>-->
           
            <button type="submit" name="update_info" class="btn">Update</button>
            <button type="button" style="margin-top:10px;" onclick="window.location.href='dashboard.php';" class="btn">Go Back</button>
        </form>

    </div>
</body>
</html>
