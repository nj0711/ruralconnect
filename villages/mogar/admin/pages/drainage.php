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

    $SystemCondition = '';
    $EstablishedDate = '';
    $LastMaintenanceDate = '';
    $Capacity = '';
    $Type = '';
    $CoverageArea = '';
    $IssuesReported = '';
    $MaintenanceHistory = '';
    $EntityName = '';
    $EntityType = '';
    $PrimaryContactPerson = '';
    $PhoneNo = '';
    $Address = '';
    $FundingSource = '';


	
    
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
        window.location.href = "editform.php?tablename=drainage";
    }
    </script>

    <?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

    // Delete the record from the database
    $del = "DELETE FROM drainage WHERE drainageid=" . $deleteId;
    $result = $obj->deletedata("drainage", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
        window.location.href = 'editform.php?tablename=drainage';
        </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}


	
    if (isset($_POST['insert'])) {

        $SystemCondition = isset($_POST['condition']) ? $obj->escape($_POST['condition']) : '';
        $EstablishedDate = isset($_POST['establishedDate']) ? $obj->escape($_POST['establishedDate']) : '';
        $LastMaintenanceDate = isset($_POST['mdate']) ? $obj->escape($_POST['mdate']) : '';
        $Type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
        $IssuesReported = isset($_POST['issue']) ? $obj->escape($_POST['issue']) : '';
        $MaintenanceHistory = isset($_POST['history']) ? $obj->escape($_POST['history']) : '';
        $EntityName = isset($_POST['entityName']) ? $obj->escape($_POST['entityName']) : '';
        $EntityType = isset($_POST['entity']) ? $obj->escape($_POST['entity']) : '';
        $PrimaryContactPerson = isset($_POST['primaryContactPerson']) ? $obj->escape($_POST['primaryContactPerson']) : '';
        $PhoneNo = isset($_POST['entityPhoneNo']) ? $obj->escape($_POST['entityPhoneNo']) : '';
        $Address = isset($_POST['entityOfficeAddress']) ? $obj->escape($_POST['entityOfficeAddress']) : '';
        $FundingSource = isset($_POST['fundingSource']) ? $obj->escape($_POST['fundingSource']) : '';
        $Capacity = isset($_POST['capacity']) ? $obj->escape($_POST['capacity']) : 0;
        $CoverageArea = isset($_POST['area']) ? $obj->escape($_POST['area']) : 0;

        $selQ = "select villageid from villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];
        //echo $res[0]['villageid'];

        $query = "INSERT INTO drainage (
            villageid, systemcondition, establisheddate, lastmaintenancedate, capacity, type, coveragearea, issuesreported, maintenancehistory, entityname, entitytype, primarycontactperson, phoneno, address, fundingsource
        ) VALUES (
            $village_id,'$SystemCondition', '$EstablishedDate', '$LastMaintenanceDate', $Capacity, '$Type', $CoverageArea, '$IssuesReported', '$MaintenanceHistory', '$EntityName', '$EntityType', '$PrimaryContactPerson', '$PhoneNo', '$Address', '$FundingSource'
        )";

        $result= $obj->insertdata("drainage", $query);
        if($result =="Data Inserted."){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Inserted');
            window.location.href = 'editform.php?tablename=drainage';
            </script>";
            
        }else{
            echo "<script>alert('Error: Failed to insert data');</script>";
        }
    }




    if (isset($_GET['updateid'])) {

        $selQ = "select * from drainage where drainageid=" . $_GET['updateid'];

        $res = $obj->selectdata("drainage", $selQ);
        if ($res != null) {
            $SystemCondition = $res[0]['systemcondition'];
            $EstablishedDate = $res[0]['establisheddate'];
            $LastMaintenanceDate = $res[0]['lastmaintenancedate'];
            $Capacity = $res[0]['capacity'];
            $Type = $res[0]['type'];
            $CoverageArea = $res[0]['coveragearea'];
            $IssuesReported = $res[0]['issuesreported'];
            $MaintenanceHistory = $res[0]['maintenancehistory'];
            $EntityName = $res[0]['entityname'];
            $EntityType = $res[0]['entitytype'];
            $PrimaryContactPerson = $res[0]['primarycontactperson'];
            $PhoneNo = $res[0]['phoneno'];
            $Address = $res[0]['address'];
            $FundingSource = $res[0]['fundingsource'];
        } else {
            header('Location: drainage.php');
        }
    }




    if (isset($_POST['update'])) {
        $SystemCondition = isset($_POST['condition']) ? $obj->escape($_POST['condition']) : '';
        $EstablishedDate = isset($_POST['establishedDate']) ? $obj->escape($_POST['establishedDate']) : '';
        $LastMaintenanceDate = isset($_POST['mdate']) ? $obj->escape($_POST['mdate']) : '';
        $Type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
        $IssuesReported = isset($_POST['issue']) ? $obj->escape($_POST['issue']) : '';
        $MaintenanceHistory = isset($_POST['history']) ? $obj->escape($_POST['history']) : '';
        $EntityName = isset($_POST['entityName']) ? $obj->escape($_POST['entityName']) : '';
        $EntityType = isset($_POST['entity']) ? $obj->escape($_POST['entity']) : '';
        $PrimaryContactPerson = isset($_POST['primaryContactPerson']) ? $obj->escape($_POST['primaryContactPerson']) : '';
        $PhoneNo = isset($_POST['entityPhoneNo']) ? $obj->escape($_POST['entityPhoneNo']) : '';
        $Address = isset($_POST['entityOfficeAddress']) ? $obj->escape($_POST['entityOfficeAddress']) : '';
        $FundingSource = isset($_POST['fundingSource']) ? $obj->escape($_POST['fundingSource']) : '';
        $Capacity = isset($_POST['capacity']) ? $obj->escape($_POST['capacity']) : 0;
        $CoverageArea = isset($_POST['area']) ? $obj->escape($_POST['area']) : 0;


        $selQ = "select villageid from villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];
        //echo $res[0]['villageid'];


        $qupdate = "update drainage set SystemCondition='{$SystemCondition}', 
        establisheddate='{$EstablishedDate}',
        lastMaintenancedate='{$LastMaintenanceDate}',
        capacity={$Capacity},
        type='{$Type}',
        coveragearea={$CoverageArea},
        issuesreported='{$IssuesReported}',
        maintenancehistory='{$MaintenanceHistory}',
        entityname='{$EntityName}',
        entitytype='{$EntityType}',
        primarycontactperson='{$PrimaryContactPerson}',
        phoneno={$PhoneNo},
        address='{$Address}',
        fundingsource='{$FundingSource}'

        where drainageid={$_GET['updateid']}";


        $result= $obj->updatedata("drainage", $qupdate);
        if($result =="Data Updated"){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=drainage';
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
    <title>Drainage | Admin Panel</title>

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

                <form action="#" method="post" name="drainageForm" onsubmit="return validateDrainageForm()">
                    <!-- Here Edit Start -->
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Drainage System Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form>

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Dranage System Capacity (Assuming capacity
                                                        in liters per second) *</label>
                                                    <input type="number" class="form-control" name="capacity"
                                                        value="<?php echo $Capacity ?>" require step="1" min="0">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Dranage System Coverage Area (Area in
                                                        square meters) *</label>
                                                    <input type="number" class="form-control" name="area"
                                                        value="<?php echo $CoverageArea ?>" require>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">System Type *</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Open Drain"
                                                                <?php if($Type=='Open Drain'){echo 'checked'; } ?> checked> Open
                                                            Drain</label>
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Covered Drain"
                                                                <?php if($Type=='Covered Drain'){echo 'checked'; } ?>>
                                                            Covered Drain</label>
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Sewer System"
                                                                <?php if($Type=='Sewer System'){echo 'checked'; } ?>>
                                                            Sewer System</label>
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="Other"
                                                                <?php if($Type=='Other'){echo 'checked'; } ?>>
                                                            Other</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">System Condition *</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input" value="Good"
                                                                <?php if($SystemCondition=='Good'){echo 'checked'; } ?> checked>
                                                            Good</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input" value="Fair"
                                                                <?php if($SystemCondition=='Fair'){echo 'checked'; } ?>>
                                                            Fair</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="condition" class="form-check-input" value="Poor"
                                                                <?php if($SystemCondition=='Poor'){echo 'checked'; } ?>>
                                                            Poor</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Established Date</label>
                                                    <input type="date" class="form-control" name="establishedDate"
                                                        value="<?php echo $EstablishedDate ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Last Maintanance Date</label>
                                                    <input type="date" class="form-control" name="mdate"
                                                        value="<?php echo $LastMaintenanceDate ?>">
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label>Issues Reported (Short description if any issure
                                                        reported)</label>
                                                    <input type="text" class="form-control" name="issue"
                                                        value="<?php echo $IssuesReported ?>" placeholder="if any or none">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Maintenance History (Short description of how the system is
                                                        maintained)</label>
                                                    <input type="text" class="form-control" name="history"
                                                        value="<?php echo $MaintenanceHistory ?>" placeholder="if any or none">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">Who managed the system ?</label>
                                                    <div class="mt-1">
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input" value="NGO"
                                                                <?php if($EntityType=='NGO'){echo 'checked'; } ?>>
                                                            NGO</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input"
                                                                value="Government"
                                                                <?php if($EntityType=='Government'){echo 'checked'; } ?>>
                                                            Government</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input" value="Private"
                                                                <?php if($EntityType=='Private'){echo 'checked'; } ?>>
                                                            Private</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="entity" class="form-check-input"
                                                                value="Semi Government"
                                                                <?php if($EntityType=='Semi Government'){echo 'checked'; } ?>>
                                                            Semi Government</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label></label>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Name of management Entity</label>
                                                    <input type="text" class="form-control" name="entityName"
                                                        value="<?php echo $EntityName ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Name of the primary contact person from the
                                                        management</label>
                                                    <input type="text" class="form-control" name="primaryContactPerson"
                                                        value="<?php echo $PrimaryContactPerson ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label>Phone No.</label>
                                                    <input type="text" class="form-control" name="entityPhoneNo"
                                                     value="<?php echo $PhoneNo ?>">
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
            
        <?php include('../footer.php'); ?>    
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
    function validateDrainageForm() {


    // Contact Number validation (should be a 10-digit number)
    // let contactNo = document.forms["drainageForm"]["entityPhoneNo"].value;
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