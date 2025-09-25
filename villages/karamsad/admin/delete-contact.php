<?php
    include_once('config.php');
    $obj = new ConnDb();
    $table = 'contacts';
    $id = $_GET['id'];
    $values = "DELETE FROM contacts WHERE contactid = '$id'";
    $res = $obj->deletedata($table,$values);
    
    if ($res=='Data Deleted') {
        ?> <script>alert('Record Deleted!')</script> <?php
        echo "<script type='text/javascript'>
                window.location.href = 'contact.php';
              </script>"; 
    } else {
        echo "<script>alert('Error deleting entry: " . mysqli_error($conn) . "');</script>";
    }
?>