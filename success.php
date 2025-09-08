<?php
include_once("admin/config.php");

if (isset($_POST['send'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pno = $_POST['phone'];
    $sub = $_POST['subject'];
    $m1 = $_POST['message'];

    // Construct the SQL query correctly
    $sql = "INSERT INTO contact (name, email, pno, subject, message) VALUES ('$name', '$email', '$pno', '$sub', '$m1')";
    $q = mysqli_query($conn, $sql);

    if ($q) {
        // Output the JavaScript alert using PHP, then redirect
        echo "<script>
                alert('We have received your query! Thank You');
                window.location.href = 'contact.php';
              </script>";
        exit; // Stop further execution after redirection
    } else {
        // Output an error alert if the query fails
        echo "<script>alert('Data not inserted: " . mysqli_error($conn) . "');</script>";
    }
}
?>
