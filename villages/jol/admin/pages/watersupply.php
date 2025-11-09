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

$system_description = '';
$source_type = '';
$source_description = '';
$installation_date = '';
$capacity = '';
$last_maintenance_date = '';
$system_condition = '';
$water_supply_schedule = '';
$entity_name = '';
$entity_type = '';
$Address = '';
$FundingSource = '';
$contact_phone = '';
$contact_person = '';

// Check if the delete ID is set from the previous page
if (isset($_GET['deleteid'])) {
    // Store the delete ID for use later in PHP
    $deleteId = $_GET['deleteid'];
?>

    <script>
        // Show the confirmation dialog
        if (confirm("Are you sure you want to proceed?")) {
            // If confirmed, reload the page with the 'confirmeddeleteid' query string to proceed with deletion
            window.location.href = "?confirmeddeleteid=<?php echo $deleteId; ?>";
        } else {
            // If the user cancels, redirect back to a safe page (e.g., edit form)
            window.location.href = "editform.php?tablename=watersupply";
        }
    </script>

<?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID


    // Delete the record from the database
    $del = "DELETE FROM watersupply WHERE watersupplyid=" . $deleteId;
    $result = $obj->deletedata("watersupply", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
                window.location.href = 'editform.php?tablename=watersupply';
                </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}


if (isset($_POST['insert'])) {

    // Step 1: Create the 'banks' table if it does not exist in this village database
    $createTableQuery = "
                        CREATE TABLE `watersupply` (
  `watersupplyid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `villageid` int(11) DEFAULT NULL,
  `systemdescription` varchar(255) NOT NULL,
  `sourcetype` varchar(255) NOT NULL,
  `sourcedescription` varchar(255) NOT NULL,
  `installationdate` date NOT NULL,
  `capacity` bigint(20) NOT NULL,
  `lastmaintenancedate` date DEFAULT NULL,
  `systemcondition` varchar(255) DEFAULT NULL,
  `watersupplyschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`watersupplyschedule`)),
  `entityname` varchar(255) NOT NULL,
  `entitytype` varchar(255) DEFAULT NULL,
  `contactphone` bigint(20) DEFAULT NULL,
  `contactperson` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `fundingsource` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
                        ";

    // Run the create table query once (it won't recreate if already exists)
    if (!$obj->tableExists('watersupply')) {
        if (!$obj->mysqli->query($createTableQuery)) {
            echo "<script>alert('Error creating table: " . $obj->mysqli->error . "');</script>";
        }
    }

    $system_description = isset($_POST['sysDesc']) ? $obj->escape($_POST['sysDesc']) : '';
    $source_type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
    $source_description = isset($_POST['srcDesc']) ? $obj->escape($_POST['srcDesc']) : '';
    $installation_date = isset($_POST['installationDate']) ? $obj->escape($_POST['installationDate']) : '';
    $capacity = isset($_POST['capacity']) ? $obj->escape($_POST['capacity']) : 0;
    $last_maintenance_date = isset($_POST['lastMDate']) ? $obj->escape($_POST['lastMDate']) : '';
    $system_condition = isset($_POST['condition']) ? $obj->escape($_POST['condition']) : '';
    $entity_name = isset($_POST['entityName']) ? $obj->escape($_POST['entityName']) : '';
    $entity_type = isset($_POST['entity']) ? $obj->escape($_POST['entity']) : '';
    $Address = isset($_POST['entityOfficeAddress']) ? $obj->escape($_POST['entityOfficeAddress']) : '';
    $FundingSource = isset($_POST['fundingSource']) ? $obj->escape($_POST['fundingSource']) : '';
    $contact_phone = isset($_POST['entityPhoneNo']) ? $obj->escape($_POST['entityPhoneNo']) : 0;
    $contact_person = isset($_POST['primaryContactPerson']) ? $obj->escape($_POST['primaryContactPerson']) : '';
    $MorningStart = isset($_POST['morST']) ? $obj->escape($_POST['morST']) : '';
    $MorningEnd = isset($_POST['morET']) ? $obj->escape($_POST['morET']) : '';
    $AfternoonStart = isset($_POST['aftST']) ? $obj->escape($_POST['aftST']) : '';
    $AfternoonEnd = isset($_POST['aftET']) ? $obj->escape($_POST['aftET']) : '';
    $EveningStart = isset($_POST['eveST']) ? $obj->escape($_POST['eveST']) : '';
    $EveningEnd = isset($_POST['eveET']) ? $obj->escape($_POST['eveET']) : '';

    $water_supply_schedule = json_encode([
        'MorningStart' => $MorningStart,
        'MorningEnd' => $MorningEnd,
        'AfternoonStart' => $AfternoonStart,
        'AfternoonEnd' => $AfternoonEnd,
        'EveningStart' => $EveningStart,
        'EveningEnd' => $EveningEnd
    ]); // JSON encoded schedule


    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    //echo $res[0]['villageid'];

    $query = "INSERT INTO watersupply (
            villageid, systemdescription, sourcetype, sourcedescription, installationdate, capacity, lastmaintenancedate, systemcondition, watersupplyschedule, entityname, entitytype, contactphone, contactperson, address, fundingsource
        ) VALUES (
            $village_id,'$system_description', '$source_type', '$source_description', '$installation_date', $capacity, '$last_maintenance_date', '$system_condition', '$water_supply_schedule', '$entity_name', '$entity_type', '$contact_phone', '$contact_person', '$Address', '$FundingSource'
        )";

    $result = $obj->insertdata("watersupply", $query);
    if ($result == "Data Inserted.") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Inserted');
            window.location.href = 'editform.php?tablename=watersupply';
            </script>";
    } else {
        echo "<script>alert('Error: Failed to insert data');</script>";
    }
}


if (isset($_GET['updateid'])) {

    $selQ = "select * from watersupply where watersupplyid=" . $_GET['updateid'];

    $res = $obj->selectdata("watersupply", $selQ);
    if ($res != null) {

        $system_description = $res[0]['systemdescription'];
        $source_type = $res[0]['sourcetype'];
        $source_description = $res[0]['sourcedescription'];
        $installation_date = $res[0]['installationdate'];
        $capacity = $res[0]['capacity'];
        $last_maintenance_date = $res[0]['lastmaintenancedate'];
        $system_condition = $res[0]['systemcondition'];
        $timeJson = $res[0]['watersupplyschedule'];
        $timeArray = json_decode($timeJson, true);
        $MorningStart = $timeArray['MorningStart'];
        $MorningEnd = $timeArray['MorningEnd'];
        $AfternoonStart = $timeArray['AfternoonStart'];
        $AfternoonEnd = $timeArray['AfternoonEnd'];
        $EveningStart = $timeArray['EveningStart'];
        $EveningEnd = $timeArray['EveningEnd'];
        $entity_name = $res[0]['entityname'];
        $entity_type = $res[0]['entitytype'];
        $contact_phone = $res[0]['contactphone'];
        $contact_person = $res[0]['contactperson'];
        $Address = $res[0]['address'];
        $FundingSource = $res[0]['fundingsource'];
    } else {
        header('Location: drainage.php');
    }
}

if (isset($_POST['update'])) {

    $system_description = isset($_POST['sysDesc']) ? $obj->escape($_POST['sysDesc']) : '';
    $source_type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
    $source_description = isset($_POST['srcDesc']) ? $obj->escape($_POST['srcDesc']) : '';
    $installation_date = isset($_POST['installationDate']) ? $obj->escape($_POST['installationDate']) : '';
    $capacity = isset($_POST['capacity']) ? $obj->escape($_POST['capacity']) : 0;
    $last_maintenance_date = isset($_POST['lastMDate']) ? $obj->escape($_POST['lastMDate']) : '';
    $system_condition = isset($_POST['condition']) ? $obj->escape($_POST['condition']) : '';
    $entity_name = isset($_POST['entityName']) ? $obj->escape($_POST['entityName']) : '';
    $entity_type = isset($_POST['entity']) ? $obj->escape($_POST['entity']) : '';
    $Address = isset($_POST['entityOfficeAddress']) ? $obj->escape($_POST['entityOfficeAddress']) : '';
    $FundingSource = isset($_POST['fundingSource']) ? $obj->escape($_POST['fundingSource']) : '';
    $contact_phone = isset($_POST['entityPhoneNo']) ? $obj->escape($_POST['entityPhoneNo']) : 0;
    $contact_person = isset($_POST['primaryContactPerson']) ? $obj->escape($_POST['primaryContactPerson']) : '';
    $MorningStart = isset($_POST['morST']) ? $obj->escape($_POST['morST']) : '';
    $MorningEnd = isset($_POST['morET']) ? $obj->escape($_POST['morET']) : '';
    $AfternoonStart = isset($_POST['aftST']) ? $obj->escape($_POST['aftST']) : '';
    $AfternoonEnd = isset($_POST['aftET']) ? $obj->escape($_POST['aftET']) : '';
    $EveningStart = isset($_POST['eveST']) ? $obj->escape($_POST['eveST']) : '';
    $EveningEnd = isset($_POST['eveET']) ? $obj->escape($_POST['eveET']) : '';

    $water_supply_schedule = json_encode([
        'MorningStart' => $MorningStart,
        'MorningEnd' => $MorningEnd,
        'AfternoonStart' => $AfternoonStart,
        'AfternoonEnd' => $AfternoonEnd,
        'EveningStart' => $EveningStart,
        'EveningEnd' => $EveningEnd
    ]); // JSON encoded schedule


    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    //echo $res[0]['villageid'];

    $qupdate = "update watersupply set systemdescription='{$system_description}', 
        sourcetype='{$source_type}',
        sourcedescription='{$source_description}',
        installationdate='{$installation_date}',
        capacity={$capacity},
        lastmaintenancedate='{$last_maintenance_date}',
        systemcondition='{$system_condition}',
        watersupplyschedule='{$water_supply_schedule}',
        entityname='{$entity_name}',
        entitytype='{$entity_type}',
        contactphone={$contact_phone},
        contactperson='{$contact_person}',
        address='{$Address}',
        fundingsource='{$FundingSource}'

        where watersupplyid={$_GET['updateid']}";


    $result = $obj->updatedata("watersupply", $qupdate);
    if ($result == "Data Updated") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=watersupply';
            </script>";
    } else {
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
    <title> Watersupply Details | Admin Panel</title>

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

                <form action="#" method="post" name="wsForm" onsubmit="return validateWSForm()">
                    <!-- Here Edit Start -->
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Water Supply System Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form action="insertBank.php" method="post" name="wsForm">

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> System Description *</label>
                                                    <input type="text" class="form-control" name="sysDesc"
                                                        value="<?php echo $system_description ?>" require>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Capacity *</label>
                                                    <input type="number" class="form-control" name="capacity"
                                                        value="<?php echo $capacity ?>" require>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Source Type</label>
                                                    <input type="text" class="form-control" name="type"
                                                        value="<?php echo $source_type ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Source Description</label>
                                                    <input type="text" class="form-control" name="srcDesc"
                                                        value="<?php echo $source_description ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Installation Date</label>
                                                    <input type="date" class="form-control" name="installationDate"
                                                        value="<?php echo $installation_date ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Last Maintance Date</label>
                                                    <input type="date" class="form-control" name="lastMDate"
                                                        value="<?php echo $last_maintenance_date ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">System Condition *</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio" checked
                                                                name="condition" class="form-check-input" value="Good"
                                                                <?php if ($system_condition == 'Good') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Good</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input" value="Fair"
                                                                <?php if ($system_condition == 'Fair') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Fair</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input" value="Poor"
                                                                <?php if ($system_condition == 'Poor') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Poor</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"></label>

                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Morning water supply start time</label>
                                                    <input type="time" class="form-control" name="morST"
                                                        value="<?php echo $MorningStart ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Morning water supply end time</label>
                                                    <input type="time" class="form-control" name="morET"
                                                        value="<?php echo $MorningEnd ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Afternoon water supply start time</label>
                                                    <input type="time" class="form-control" name="aftST"
                                                        value="<?php echo $AfternoonStart ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Afternoon water supply end time</label>
                                                    <input type="time" class="form-control" name="aftET"
                                                        value="<?php echo $AfternoonEnd ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Evening water supply start time</label>
                                                    <input type="time" class="form-control" name="eveST"
                                                        value="<?php echo $EveningStart ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Evening water supply end time</label>
                                                    <input type="time" class="form-control" name="eveET"
                                                        value="<?php echo $EveningEnd ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">Who managed the system ?</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input" value="NGO"
                                                                <?php if ($entity_type == 'NGO') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            NGO</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input"
                                                                value="Government" checked
                                                                <?php if ($entity_type == 'Government') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Government</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input" value="Private"
                                                                <?php if ($entity_type == 'Private') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Private</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input"
                                                                value="Semi Government"
                                                                <?php if ($entity_type == 'Semi Government') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Semi Government</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Name of management Entity</label>
                                                    <input type="text" class="form-control" name="entityName"
                                                        value="<?php echo $entity_name ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Name of the primary contact person from the
                                                        management</label>
                                                    <input type="text" class="form-control" name="primaryContactPerson"
                                                        value="<?php echo $contact_person ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Phone No.</label>
                                                    <input type="text" class="form-control" name="entityPhoneNo"
                                                        value="<?php echo $contact_phone ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Management office Address</label>
                                                    <input type="text" class="form-control" name="entityOfficeAddress"
                                                        value="<?php echo $Address ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Funding source</label>
                                                    <input type="text" class="form-control" name="fundingSource"
                                                        value="<?php echo $FundingSource ?>">
                                                </div>
                                            </div>

                                            <?php if (isset($_GET['updateid'])) { ?>
                                                <button type="submit" name="update" class="btn btn-primary">Update</button>

                                            <?php } else { ?>

                                                <button type="submit" name="insert" class="btn btn-primary">Submit</button>

                                            <?php } ?>
                                        </form>
                                        <!-- Add this right after <div class="content-body"> and before the existing form -->
                                        <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;">
                                            <h4>📊 Bulk Import Water Supply Systems</h4>
                                            <p class="text-muted mb-3">
                                                <strong>How it works:</strong> Download the template, fill in the data, and import.
                                                <!-- <strong>Village ID is automatically assigned</strong> - you don't need to fill it. -->
                                            </p>

                                            <div class="row align-items-center g-3">
                                                <div class="col-md-4">
                                                    <a href="templates/watersupply_template.php" class="btn btn-info w-100">
                                                        📥 Download Template
                                                    </a>
                                                </div>
                                                <div class="col-md-8">
                                                    <form action="imports/import_watersupply.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
                                                        <input type="file" name="excel_file" class="form-control"
                                                            accept=".xls,.xlsx" required style="max-width: 300px;">
                                                        <button type="submit" class="btn btn-success">
                                                            📤 Import Excel
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>

                                            <div class="mt-3 p-2 border rounded">
                                                <small class="text-muted">
                                                    <strong>💡 Required fields:</strong> System Description, Source Type, Source Description, Installation Date, Capacity, Entity Name<br>
                                                    <strong>📝 Optional fields:</strong> Last Maintenance Date, System Condition, Water Supply Schedule, Entity Type, Contact Phone, Contact Person, Address, Funding Source, Visibility<br>
                                                    <strong>⚠️ Notes:</strong>
                                                    Dates in YYYY-MM-DD format (e.g., 2023-05-15),<br>
                                                    System Condition: "Good", "Fair", or "Poor",<br>
                                                    Entity Type: "NGO", "Government", "Private", or "Semi Government",<br>
                                                    Water Supply Schedule: Enter times in HH:MM format in separate columns (MorningStart, MorningEnd, etc.)
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Here Edit End -->

                    </div>
                </form>
            </div>
            <!--**********************************
            Content body end
        ***********************************-->




            <!--**********************************
           Support ticket button start
        ***********************************-->

            <!--**********************************
           Support ticket button end
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
        function validateWSForm() {


            // Contact Number validation (should be a 10-digit number)
            // let contactNo = document.forms["wsForm"]["entityPhoneNo"].value;
            // const contactNoRegex = /^[0-9]{10}$/;
            // if (!contactNoRegex.test(contactNo)) {
            //     alert("Please enter a valid 10-digit contact number");
            //     return false;
            // }

            return true;
        }
    </script>





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