<?php
include_once("config.php");
session_start();
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_admin'])) {
    $adminId = trim($_POST['admin_id']);
    $villageName = trim($_POST['village_name']);
    $newAdminEmail = mysqli_real_escape_string($conn, trim($_POST['admin_email']));
    $newAdminPass = trim($_POST['admin_pass']);
    $salt = "villageonweb";
    $password_encrypted = sha1($newAdminPass . $salt);

    // Path to village-specific config file
    $villageConfigPath = "../villages/$villageName/admin/config.php";

    // Check if the village config file exists
    if (file_exists($villageConfigPath)) {
        include $villageConfigPath;

        $villageDbConnection = new ConnDb();

        if (!$villageDbConnection->conn) {
            die("Connection to village database failed: " . implode(", ", $villageDbConnection->result));
        }

        // Construct the update query for village admin
        if (!empty($newAdminPass)) {
            $updateVillageAdminSQL = "UPDATE admin SET email = '$newAdminEmail', passwordhash = '$password_encrypted' WHERE adminid = '$adminId'";
        } else {
            $updateVillageAdminSQL = "UPDATE admin SET email = '$newAdminEmail' WHERE adminid = '$adminId'";
        }

        if ($villageDbConnection->mysqli->query($updateVillageAdminSQL)) {
            echo "<script>alert('Admin details updated successfully for village \"$villageName\".');</script>";
        } else {
            echo "<script>alert('Error updating village admin details: " . $villageDbConnection->mysqli->error . "');</script>";
        }
    } else {
        echo "<script>alert('Village config file not found for village \"$villageName\".');</script>";
    }

    // Update the super admin database (admin_panel)
    $superAdminConn = mysqli_connect($dbHost, $dbUser, $dbPass, "villageonweb_admin_panel");

    if (!$superAdminConn) {
        die("Connection to super admin database failed: " . mysqli_connect_error());
    }

    if (!empty($newAdminPass)) {
        $updateSuperAdminSQL = "UPDATE villages SET admin_email = '$newAdminEmail', admin_pass = '$password_encrypted' WHERE village_name = '$villageName'";
    } else {
        $updateSuperAdminSQL = "UPDATE villages SET admin_email = '$newAdminEmail' WHERE village_name = '$villageName'";
    }

    if (mysqli_query($superAdminConn, $updateSuperAdminSQL)) {
        echo "<script>alert('Super admin details updated successfully for village \"$villageName\".');</script>";
    } else {
        echo "<script>alert('Error updating super admin details: " . mysqli_error($superAdminConn) . "');</script>";
    }

    mysqli_close($superAdminConn);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="DexignLab">
	<meta name="robots" content="" >
	<meta name="keywords" content="admin dashboard, admin template, analytics, bootstrap, bootstrap 5, bootstrap 5 admin template, job board admin, job portal admin, modern, responsive admin dashboard, sales dashboard, sass, ui kit, web app, frontend">
	<meta name="description" content="We proudly present Jobick, a Job Admin dashboard HTML Template, If you are hiring a job expert you would like to build a superb website for your Jobick, it's a best choice.">
	<meta property="og:title" content="Jobick : Job Admin Dashboard Bootstrap 5 Template + FrontEnd">
	<meta property="og:description" content="We proudly present Jobick, a Job Admin dashboard HTML Template, If you are hiring a job expert you would like to build a superb website for your Jobick, it's a best choice." >
	<meta property="og:image" content="https://jobick.dexignlab.com/xhtml/social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- PAGE TITLE HERE -->
	<title>Edit Admins</title>
	
	<!-- Favicon icon -->
	<link rel="shortcut icon" type="image/png" href="images/favicon.png">
<link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
</head>
<body>

   

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include("header.php")  ; ?>

        <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
                <div class="col-xl-6 col-lg-6">
                    <div class="basic-form">
                        <h2>Edit Village</h2>
                        <hr>
                        <?php  
                            $village = $_GET['village'];
                            $sql="select * from villages where village_name='$village'";
                            $table=mysqli_query($conn,$sql);
                          
                            while($row=mysqli_fetch_array($table)){ 
                            echo "  <form method='POST' action='#' class='mb-5'>

                                <h3>Village Details</h3><br>
                                <input type='hidden' class='form-control input-default' id='admin_id' value='$row[id]' name='admin_id' readonly>

                                <label for='village_name'>Village Name:</label><br>
                                <input type='text' class='form-control input-default' id='village_name' value='$row[village_name]' name='village_name' readonly><br><br>

                                <label for='admin_email'>Village Admin Email:</label><br>
                                <input type='email' id='new_admin_email' name='admin_email' class='form-control input-default' value='$row[admin_email]' required><br><br>

                                <label for='admin_pass'>Village Admin New Password:</label><br>
                                <input type='password' id='new_admin_pass' name='admin_pass' class='form-control input-default' required><br><br>
                            
                                <h3>Database Details</h3><br>

                                <h4>Note: You cannot change database details</h4><br/>

                                <label for='db_host'>Database Host:</label><br>
                                <input type='text' id='db_host' class='form-control input-default' value='$row[db_host]' value='localhost' value='db_host' readonly><br><br>
                                
                                <label for='db_name'>Database Name:</label><br>
                                <input type='text' id='db_name' name='db_name' class='form-control input-default' value='$row[db_name]' readonly><br><br>
                                
                                <label for='db_user'>Database Username:</label><br>
                                <input type='text' id='db_user' name='db_user' class='form-control input-default' value='$row[db_user]' readonly><br><br>
                                
                                <label for='db_pass'>Database Password:</label><br>
                                <input type='password' id='db_pass' class='form-control input-default' value='$row[db_pass]' name='db_pass' readonly><br><br>
                                
                                <input type='submit' name='edit_admin' class='btn btn-primary mb-5' value='Update Village'>
                            </form> "; }?>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
		
		
        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © Designed &amp; Developed by <a href="https://dexignlab.com/" target="_blank">DexignLab</a> 2023</p>
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

		<!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
			


	</div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
	
	

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="js/custom.min.js"></script>
	<script src="js/dlabnav-init.js"></script>
	
  
</body>
</html>