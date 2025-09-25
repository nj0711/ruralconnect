<?php

include_once('../config.php');

session_start();
if (!isset($_SESSION['village_admin_email'])) {
    header("Location: index.php");
    exit();
}

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

$obj = new ConnDb();



$selAdmin = "select * from admin";
$admin = $obj->selectdata("admin", $selAdmin);
$adminid = $admin[0]['email'];

$selVillage = "select * from villagebasic";
$village = $obj->selectdata("villagebasic", $selVillage);
$villagename = $village[0]['name'];

//    $villagename=isset($_POST['villagename']) ? $obj->escape($_POST['villagename']) : '';
//    $adminid=isset($_POST['adminid']) ? $obj->escape($_POST['adminid']) : '';
$district = isset($_POST['district']) ? $obj->escape($_POST['district']) : '';
$state = isset($_POST['state']) ? $obj->escape($_POST['state']) : '';
$pincode = isset($_POST['pincode']) ? $obj->escape($_POST['pincode']) : '';
$mapdes = isset($_POST['mapdes']) ? $obj->escape($_POST['mapdes']) : '';
$area = isset($_POST['area']) ? $obj->escape($_POST['area']) : '';
$establishedyear = isset($_POST['establishedyear']) ? $obj->escape($_POST['establishedyear']) : '';
$sarpanchname = isset($_POST['sarpanchname']) ? $obj->escape($_POST['sarpanchname']) : '';
$sarpanchcontact = isset($_POST['sarpanchcontact']) ? $obj->escape($_POST['sarpanchcontact']) : '';
$vmap = isset($_POST['vmap']) ? $obj->escape($_POST['vmap']) : '';

if (isset($_GET['updateid'])) {

    $selq = "select * from villagebasic";
    $res = $obj->selectdata("villagebasic", $selq);

    // $villagename=$res[0]['Name'];
    // $adminid=$res[0]['AdminID'];;
    $district = $res[0]['district'];
    $state = $res[0]['state'];;
    $pincode = $res[0]['pincode'];
    $mapdes = $res[0]['mapdes'];
    $area = $res[0]['area'];
    $establishedyear = $res[0]['establishedyear'];
    $sarpanchname = $res[0]['sarpanchname'];
    $sarpanchcontact = $res[0]['contactnumber'];
    $vmap = $res[0]['vmap'];
}

if (isset($_POST['update'])) {
    // $villagename=isset($_POST['villagename']) ? $obj->escape($_POST['villagename']) : '';
    // $adminid=isset($_POST['adminid']) ? $obj->escape($_POST['adminid']) : '';
    $district = isset($_POST['district']) ? $obj->escape($_POST['district']) : '';
    $state = isset($_POST['state']) ? $obj->escape($_POST['state']) : '';
    $pincode = isset($_POST['pincode']) ? $obj->escape($_POST['pincode']) : 'NULL';
    $mapdes = isset($_POST['mapdes']) ? $obj->escape($_POST['mapdes']) : '';
    $area = isset($_POST['area']) ? $obj->escape($_POST['area']) : '';
    $establishedyear = isset($_POST['establishedyear']) ? $obj->escape($_POST['establishedyear']) : '';
    $sarpanchname = isset($_POST['sarpanchname']) ? $obj->escape($_POST['sarpanchname']) : '';
    $sarpanchcontact = isset($_POST['sarpanchcontact']) ? $obj->escape($_POST['sarpanchcontact']) : '';
    $vmap = isset($_POST['vmap']) ? $obj->escape($_POST['vmap']) : '';

    $updateQ = "UPDATE villagebasic SET district='$district',
        state='$state',mapdes='$mapdes',area='$area',
        establishedYear='$establishedyear',pincode='$pincode',
        sarpanchname='$sarpanchname',contactnumber='$sarpanchcontact',vmap='$vmap'";
    //   WHERE villageid= {$_GET['updateid']}";


    $result =  $obj->updatedata("villagebasic", $updateQ);
    if ($result == "Data Updated") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=villagebasic';
            </script>";
    } else {
        // echo $updateQ;
        echo "<script>alert('Error: Failed to update data');</script>";
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>


    <!-- Meta -->
    <meta charset="utf-8">

    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title -->
    <title> Village Basic | Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="../images/villagelogo.png">

    <!-- All StyleSheet -->
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">

    <!-- Globle CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/delete_btn.css" rel="stylesheet">

</head>

<body>



    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include('header.php'); ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">

                <!-- Here Edit Start -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Village Personal Details</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Village Name</label>
                                                <input type="text" value="<?php echo $villagename; ?>"
                                                    name="villagename" class="form-control" placeholder="" readonly>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Admin </label>
                                                <input type="text" value="<?php echo $adminid; ?>" name="adminid"
                                                    class="form-control" placeholder="" readonly>
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">District</label>
                                                <input type="text" value="<?php echo $district; ?>" name="district"
                                                    class="form-control" placeholder=" ">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">State</label>
                                                <input type="text" value="<?php echo $state; ?>" name="state"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Village-PINCode*</label>
                                                <input type="text" value="<?php echo $pincode; ?>" name="pincode"
                                                    pattern="[0-9]{6}" title="Please enter a valid 6-digit pin code"
                                                    class="form-control" required />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Area (in square kilometers)</label>
                                                <input type="text" value="<?php echo $area; ?>" name="area"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Village-Established-Year</label>
                                                <input type="text" value="<?php echo $establishedyear; ?>"
                                                    name="establishedyear" class="form-control" pattern="[0-9]{4}"
                                                    title="Please enter a valid Year" />
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">SarpanchName</label>
                                                <input type="text" value="<?php echo $sarpanchname; ?>"
                                                    name="sarpanchname" class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Sarpanch-ContactNumber</label>
                                                <input type="text" value="<?php echo $sarpanchcontact; ?>"
                                                    name="sarpanchcontact" class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Map Link</label>
                                                <input type="text" value="<?php echo $vmap; ?>" name="vmap"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">mapdes </label>
                                                <textarea class="form-control"
                                                    placeholder="Distance and directions from a specific location that can be used instead of a map for the village."
                                                    name="mapdes"><?php echo $mapdes; ?></textarea>
                                            </div>

                                        </div>

                                        <div class="mb-3">
                                            <div class="col-lg-1 ms-auto">


                                                <button type="submit" name="update"
                                                    class="btn btn-primary">Submit</button>


                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Here Edit End -->
                    <!-- Add this right after <div class="content-body"> and before the existing form -->


                </div>
            </div>
            <!--**********************************
		Content body end
	***********************************-->



        </div>
        <!--**********************************
            Content body end
        ***********************************-->




        <!--**********************************
		Footer start
	***********************************-->
        <div class="footer">
            <?php include_once('../footer.php'); ?>
        </div>
        <!--**********************************
		Footer end
	***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->




    <!--**********************************
	Scripts
***********************************-->
    <!-- Required vendors -->
    <script src="../vendor/global/global.min.js"></script>
    <script src="../vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Apex Chart -->
    <script src="../vendor/apexchart/apexchart.js"></script>
    <script src="../vendor/chartjs/chart.bundle.min.js"></script>

    <!-- Chart piety plugin files -->
    <script src="../vendor/peity/jquery.peity.min.js"></script>

    <!-- Dashboard 1 -->
    <script src="../js/dashboard/dashboard-1.js"></script>

    <script src="../vendor/owl-carousel/owl.carousel.js"></script>

    <script src="../js/custom.min.js"></script>
    <script src="../js/dlabnav-init.js"></script>


    <script>
        function JobickCarousel() {

            /*  testimonial one function by = owl.carousel.js */
            jQuery('.front-view-slider').owlCarousel({
                loop: false,
                margin: 30,
                nav: true,
                autoplaySpeed: 3000,
                navSpeed: 3000,
                autoWidth: true,
                paginationSpeed: 3000,
                slideSpeed: 3000,
                smartSpeed: 3000,
                autoplay: false,
                animateOut: 'fadeOut',
                dots: true,
                navText: ['', ''],
                responsive: {
                    0: {
                        items: 1,

                        margin: 10
                    },

                    480: {
                        items: 1
                    },

                    767: {
                        items: 3
                    },
                    1750: {
                        items: 3
                    }
                }
            })
        }

        jQuery(window).on('load', function() {
            setTimeout(function() {
                JobickCarousel();
            }, 1000);
        });
    </script>
</body>

</html>