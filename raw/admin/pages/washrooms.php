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

$number_of_washrooms = '';
$location_description = '';
$facility_type = '';
$washroom_condition = '';
$maintenance_schedule = '';
$entity_name = '';
$entity_type = '';
$primary_contact_person = '';
$phone_no = '';
$address = '';
$funding_source = '';
$established_date = '';


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
            window.location.href = "editform.php?tablename=washrooms";
        }
        </script>
    
        <?php
    }
    
    // After confirmation, handle the deletion process using 'confirmeddeleteid'
    if (isset($_GET['confirmeddeleteid'])) {
        $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID
    
        // Perform the deletion logic here
        $sel = "select * from washrooms where washroomsid=" . $deleteId;
        $res = $obj->selectdata("washrooms", $sel);
    
        
        // Delete the record from the database
        $del = "DELETE FROM washrooms WHERE washroomsid=" . $deleteId;
        $result = $obj->deletedata("washrooms", $del);
    
        // Handle success or failure
        if ($result == "Data Deleted") {
            echo "<script>alert('Success! Data Deleted');
            window.location.href = 'editform.php?tablename=washrooms';
            </script>";
        } else {
            echo "<script>alert('Error: Failed to delete data');</script>";
        }
    }



if (isset($_POST['insert'])) {

    $number_of_washrooms = isset($_POST['numberOfWashrooms']) ? $obj->escape($_POST['numberOfWashrooms']) : 0;
    $location_description = isset($_POST['location']) ? $obj->escape($_POST['location']) : '';
    $facility_type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
     $washroom_condition = isset($_POST['condition']) ? $obj->escape($_POST['condition']) : '';
    $maintenance_schedule = isset($_POST['maintenanceSchedule']) ? $obj->escape($_POST['maintenanceSchedule']) : '';
    $entity_name = isset($_POST['entityName']) ? $obj->escape($_POST['entityName']) : '';
    $entity_type = isset($_POST['entity']) ? $obj->escape($_POST['entity']) : '';
    $primary_contact_person = isset($_POST['primaryContactPerson']) ? $obj->escape($_POST['primaryContactPerson']) : '';
    $phone_no = isset($_POST['entityPhoneNo']) ? $obj->escape($_POST['entityPhoneNo']) : 0;
    $address = isset($_POST['entityOfficeAddress']) ? $obj->escape($_POST['entityOfficeAddress']) : '';
    $funding_source = isset($_POST['fundingSource']) ? $obj->escape($_POST['fundingSource']) : '';
    $established_date = isset($_POST['establishedDate']) ? $obj->escape($_POST['establishedDate']) : '';



    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    //echo $res[0]['villageid'];


    $query = "INSERT INTO washrooms (
        villageid, numberofwashrooms, locationdescription, facilitytype, washroomcondition, maintenanceschedule, entityname, entitytype, primarycontactperson, phoneno, address, fundingsource, establisheddate
    ) VALUES (
        '$village_id', $number_of_washrooms, '$location_description', '$facility_type', '$washroom_condition', '$maintenance_schedule', '$entity_name', '$entity_type', '$primary_contact_person', $phone_no, '$address', '$funding_source', '$established_date'
    )";

    

    $result = $obj->insertdata("drainage", $query);
    if($result =="Data Inserted."){
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Inserted');
        window.location.href = 'editform.php?tablename=washrooms';
        </script>";
        
    }else{
        echo "<script>alert('Error: Failed to insert data');</script>";
    }
}



if (isset($_GET['updateid'])) {

    $selQ = "select * from washrooms where washroomsid=" . $_GET['updateid'];

    $res = $obj->selectdata("washrooms", $selQ);
    if ($res != null) {
        $number_of_washrooms = $res[0]['numberofwashrooms'];
        $location_description = $res[0]['locationdescription'];
        $facility_type = $res[0]['facilitytype'];
        $washroom_condition = $res[0]['washroomcondition'];
        $maintenance_schedule = $res[0]['maintenanceschedule'];
        $entity_name = $res[0]['entityname'];
        $entity_type = $res[0]['entitytype'];
        $primary_contact_person = $res[0]['primarycontactperson'];
        $phone_no = $res[0]['phoneno'];
        $address = $res[0]['address'];
        $funding_source = $res[0]['fundingsource'];
        $established_date = $res[0]['establisheddate'];
    } else {
        header('Location: washrooms.php');
    }
}



if (isset($_POST['update'])) {

    $number_of_washrooms = isset($_POST['numberOfWashrooms']) ? $obj->escape($_POST['numberOfWashrooms']) : 0;
    $location_description = isset($_POST['location']) ? $obj->escape($_POST['location']) : '';
    $facility_type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
    $washroom_condition = isset($_POST['condition']) ? $obj->escape($_POST['condition']) : '';
    $maintenance_schedule = isset($_POST['maintenanceSchedule']) ? $obj->escape($_POST['maintenanceSchedule']) : '';
    $entity_name = isset($_POST['entityName']) ? $obj->escape($_POST['entityName']) : '';
    $entity_type = isset($_POST['entity']) ? $obj->escape($_POST['entity']) : '';
    $primary_contact_person = isset($_POST['primaryContactPerson']) ? $obj->escape($_POST['primaryContactPerson']) : '';
    $phone_no = isset($_POST['entityPhoneNo']) ? $obj->escape($_POST['entityPhoneNo']) : 0;
    $address = isset($_POST['entityOfficeAddress']) ? $obj->escape($_POST['entityOfficeAddress']) : '';
    $funding_source = isset($_POST['fundingSource']) ? $obj->escape($_POST['fundingSource']) : '';
    $established_date = isset($_POST['establishedDate']) ? $obj->escape($_POST['establishedDate']) : '';

    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    //echo $res[0]['villageid'];


    $qupdate = "update washrooms set numberofwashrooms={$number_of_washrooms}, 
    locationdescription='{$location_description}',
    facilitytype='{$facility_type}',
    washroomcondition='{$washroom_condition}',
    maintenanceschedule='{$maintenance_schedule}',
    entityname='{$entity_name}',
    entitytype='{$entity_type}',
    primarycontactperson='{$primary_contact_person}',
    phoneno={$phone_no},
    address='{$address}',
    fundingsource='{$funding_source}',
    establisheddate='{$established_date}'

    where WashroomsID={$_GET['updateid']}";


    $result = $obj->updatedata("washrooms", $qupdate);

    if($result =="Data Updated"){
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
        window.location.href = 'editform.php?tablename=washrooms';
        </script>";
        
    }else{
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
    <title> Washrooms Detail | Admin Panel</title>

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

                <form action="#" method="post" name="wrForm" onsubmit="return validateWRForm()">
                    <!-- Here Edit Start -->
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Washroom Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form>

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Number Of Washrooms</label>
                                                    <input type="number" class="form-control" name="numberOfWashrooms"
                                                        value="<?php echo $number_of_washrooms ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Location Description</label>
                                                    <input type="text" class="form-control" name="location"
                                                        value="<?php echo $location_description ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">Facility Type</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Free"checked
                                                                <?php if ($facility_type == "Free") {echo 'checked';} ?>>
                                                            Free</label>
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Paid" 
                                                                <?php if ($facility_type == "Paid") {echo 'checked';} ?>>
                                                            Paid</label>
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Accessible"
                                                                <?php if ($facility_type == "Accessible") {echo 'checked';} ?>>
                                                            Accessible</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">Washroom Condition</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input" value="Clean" checked
                                                                <?php if ($washroom_condition == 'Clean') {echo 'checked';} ?>>
                                                            Clean</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input"
                                                                value="Needs Repair"
                                                                <?php if ($washroom_condition == 'Needs Repair') {echo 'checked';} ?>>
                                                            Needs Repair</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Maintenance Schedule (For ex. once a day
                                                        or twice a day)</label>
                                                    <input type="text" class="form-control" name="maintenanceSchedule"
                                                        value="<?php echo $maintenance_schedule ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Established Date</label>
                                                    <input type="date" class="form-control" name="establishedDate"
                                                        value="<?php echo $established_date ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">Who managed the system ?</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input" value="NGO"  checked
                                                                <?php if ($entity_type == 'NGO') {echo 'checked';} ?>>
                                                            NGO</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input"
                                                                value="Government"
                                                                <?php if ($entity_type == 'Government') {echo 'checked';} ?>>
                                                            Government</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input" value="Private"
                                                                <?php if ($entity_type == 'Private') {
                                                                                                                                                                        echo 'checked';
                                                                                                                                                                    } ?>>
                                                            Private</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label></label>
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
                                                        value="<?php echo $primary_contact_person ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Phone No.</label>
                                                    <input type="text" class="form-control" name="entityPhoneNo"
                                                        value="<?php echo $phone_no ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Management office Address</label>
                                                    <input type="text" class="form-control" name="entityOfficeAddress"
                                                        value="<?php echo $address ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Funding source</label>
                                                    <input type="text" class="form-control" name="fundingSource"
                                                        value="<?php echo $funding_source ?>">
                                                </div>
                                            </div>

                                            <?php if (isset($_GET['updateid'])) { ?>
                                            <button type="submit" name="update" class="btn btn-primary">Update</button>

                                            <?php } else { ?>

                                            <button type="submit" name="insert" class="btn btn-primary">Submit</button>

                                            <?php } ?>

                                        </form>
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
    function validateWRForm() {


    // Contact Number validation (should be a 10-digit number)
    // let contactNo = document.forms["wrForm"]["entityPhoneNo"].value;
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