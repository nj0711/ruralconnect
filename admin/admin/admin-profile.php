<?php
session_start();
include_once("config.php");

if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}

//Session management code

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

//session code ends

$admin_email = $_SESSION['admin_email'];
$error = $success = "";

// Fetch existing admin data
$query = "SELECT * FROM admins WHERE email = '$admin_email'";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['update_info'])) {
        // Update personal information
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $city = mysqli_real_escape_string($conn, $_POST['city']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);

        $update_query = "UPDATE admins SET phone = '$phone', address = '$address', pincode = '$pincode', city = '$city', state = '$state' WHERE email = '$admin_email'";
        if (mysqli_query($conn, $update_query)) {
            $success = "Profile updated successfully!";
        } else {
            $error = "Error updating profile: " . mysqli_error($conn);
        }
    }

    if (isset($_POST['change_password'])) {
        // Change password
        $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
        $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
        $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
        $salt = 'villageonweb'; // Salt value

        // Encrypt the current and new passwords with SHA-1 and salt
        $encrypted_current_password = sha1($salt . $current_password);
        $encrypted_new_password = sha1($salt . $new_password);

        if ($new_password === $confirm_password) {
            if ($encrypted_current_password === $admin['password']) {
                $update_pass_query = "UPDATE admins SET password = '$encrypted_new_password' WHERE email = '$admin_email'";
                if (mysqli_query($conn, $update_pass_query)) {
                    $success = "Password changed successfully!";
                } else {
                    $error = "Error changing password: " . mysqli_error($conn);
                }
            } else {
                $error = "Current password is incorrect.";
            }
        } else {
            $error = "New passwords do not match.";
        }
    }
}

mysqli_close($conn);
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
                <input type="email" id="email" name="email" value="<?php echo $admin['email']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo isset($admin['phone']) ? $admin['phone'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea id="address" name="address"><?php echo isset($admin['address']) ? $admin['address'] : ''; ?></textarea>
            </div>
            <div class="form-group">
                <label for="pincode">Pincode:</label>
                <input type="text" id="pincode" name="pincode" value="<?php echo isset($admin['pincode']) ? $admin['pincode'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" value="<?php echo isset($admin['city']) ? $admin['city'] : ''; ?>">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" id="state" name="state" value="<?php echo isset($admin['state']) ? $admin['state'] : ''; ?>">
            </div>
            <button type="submit" name="update_info" class="btn">Update Info</button>
            <button type="button" style="margin-top:10px;" name="cancel" onclick="window.location.href='dashboard.php';" class="btn">Go Back</button>
        </form>

        <form method="POST" style="margin-top: 1.5rem;">
            <h3>Change Password</h3>
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" id="current_password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" id="new_password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" name="change_password" class="btn">Change Password</button><br>
            <button type="button" style="margin-top:10px;" name="cancel" onclick="window.location.href='dashboard.php';" class="btn">Cancel</button>

        </form>
    </div>
</body>
</html>
