<?php
include('config.php');

if (isset($_POST['update'])) { // Changed to 'update' for clarity
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $salt = "villageonweb";
    $pass_protect = sha1($salt . $pass);

    // Update query to change the password for the provided email
    $query = "UPDATE admins SET password = '$pass_protect' WHERE email = '$email'";
    $res = mysqli_query($conn, $query);

    if ($res) {
        echo "<script>alert('Password has been updated successfully.');</script>";
        echo "<script type='text/javascript'>
                    window.location.href = 'index.php';
              </script>";
    } else {
        $error = "Error updating password: " . mysqli_error($conn);
        echo "<script>alert('$error');</script>"; // Display the error in an alert
    }
}
?>
