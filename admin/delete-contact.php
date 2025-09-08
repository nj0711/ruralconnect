<?php
    include_once('config.php');
    $id = $_GET['id'];
    $sql = "DELETE FROM contact WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        ?> <script>alert('Record Deleted!')</script> <?php
        echo "<script type='text/javascript'>
                window.location.href = 'contact.php';
              </script>"; 
    } else {
        echo "<script>alert('Error deleting entry: " . mysqli_error($conn) . "');</script>";
    }
?>