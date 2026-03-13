<?php
include_once '../config.php';

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
    <title> Events & Festivals | Admin Panel</title>

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
                <?php

                $Event = new ConnDb();


                $village_id = $Event->selectdata("villagebasic", "select villageid from villagebasic");
                $villageid = $village_id[0]['villageid'];



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
                            window.location.href = "editform.php?tablename=eventsfestivals";
                        }
                    </script>

                <?php
                }

                // After confirmation, handle the deletion process using 'confirmeddeleteid'
                if (isset($_GET['confirmeddeleteid'])) {
                    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID


                    // Delete the record from the database
                    $del = "DELETE FROM eventsfestivals WHERE eventsfestivalsid=" . $deleteId;
                    $result = $Event->deletedata("eventsfestivals", $del);

                    // Handle success or failure
                    if ($result == "Data Deleted") {
                        echo "<script>alert('Success! Data Deleted');
                        window.location.href = 'editform.php?tablename=eventsfestivals';
                        </script>";
                    } else {
                        echo "<script>alert('Error: Failed to delete data');</script>";
                    }
                }



                $fetchID = isset($_GET['updateid']) ? $_GET['updateid'] : "";

                if ($fetchID != "") {

                    $fetchquery = "select * from eventsfestivals where eventsfestivalsid=" . $fetchID;
                    $FormData = $Event->selectdata("emergencyservices", $fetchquery);
                }

                $Vid = $villageid;
                $ServiceID = isset($FormData[0]['eventsfestivalsid']) ? $FormData[0]['eventsfestivalsid'] : "";
                $name = isset($FormData[0]['eventname']) ? $FormData[0]['eventname'] : "";
                $type = isset($FormData[0]['eventtype']) ? $FormData[0]['eventtype'] : "";
                $stdate = isset($FormData[0]['startdate']) ? $FormData[0]['startdate'] : "";
                $eddate = isset($FormData[0]['enddate']) ? $FormData[0]['enddate'] : "";
                $connum = isset($FormData[0]['contactnumber']) ? $FormData[0]['contactnumber'] : "";
                $Desc = isset($FormData[0]['description']) ? $FormData[0]['description'] : "";

                if (isset($_POST['submit'])) {
                    $id = isset($_POST['eventsfestivalsID']) ? $_POST['eventsfestivalsID'] : "";
                    $VillageID = $villageid;
                    $EventName = isset($_POST['EventName']) ? $Event->escape($_POST['EventName']) : "";
                    $EventType = isset($_POST['EventType']) ? $Event->escape($_POST['EventType']) : "";
                    $StartDate = isset($_POST['startdate']) ? $Event->escape($_POST['startdate']) : "";
                    $EndDate = isset($_POST['enddate']) ? $Event->escape($_POST['enddate']) : "";
                    $contactNo = isset($_POST['ContactNo']) ? $Event->escape($_POST['ContactNo']) : "";
                    $Description = isset($_POST['Description']) ? $Event->escape($_POST['Description']) : "";

                    // echo '<pre>';
                    // print_r($_POST);
                    // echo '</pre>';


                    if (isset($_POST['eventsfestivalsID']) && $_POST['eventsfestivalsID'] != "") {
                        if ($EventName != "" && $EventType != "" && $StartDate != "" && $EndDate != "" && $contactNo != "" && $Description != "" && $VillageID != "") {
                            $sql = "update eventsfestivals set eventname='$EventName', eventtype='$EventType', startdate='$StartDate', enddate='$EndDate', contactnumber='$contactNo', description='$Description', villageid=$VillageID where eventsfestivalsid=$id";
                            $result = $Event->updatedata("eventsfestivals", $sql);
                            if ($result == "Data Updated") {
                                // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                echo "<script>alert('Success! Data Updated');
                                window.location.href = 'editform.php?tablename=eventsfestivals';
                                </script>";
                            } else {
                                echo "<script>alert('Error: Failed to update data');</script>";
                            }
                        } else {
                            // echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            //     Please Enter Complete Details! You Entered Details Are Incomplete!!
                            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            //     </div>';
                        }
                    } else {
                        if ($EventName != "" && $EventType != "" && $StartDate != "" && $EndDate != "" && $contactNo != "" && $Description != "" && $VillageID != "") {
                            $sql = "insert into eventsfestivals(eventname,eventtype,startdate,enddate,contactnumber,description,villageid) values('$EventName','$EventType','$StartDate','$EndDate','$contactNo','$Description',$VillageID)";
                            $result = $Event->insertdata("eventsfestivals", $sql);
                            if ($result == "Data Inserted.") {
                                // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                echo "<script>alert('Success! Data Inserted');
                                window.location.href = 'editform.php?tablename=eventsfestivals';
                                </script>";
                            } else {
                                echo "<script>alert('Error: Failed to insert data');</script>";
                            }
                        } else {
                            // echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                            //     Please Enter Complete Details! You Entered Details Are Incomplete!!
                            //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            //     </div>';
                        }
                    }
                }
                ?>
                <!-- Here Edit Start -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Event & Festival</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                                        <input type="hidden" class="form-control" name="eventsfestivalsID"
                                            value="<?php echo $ServiceID; ?>">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Event-Festival Name</label>
                                                <input type="text" class="form-control" name="EventName"
                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                    value="<?php echo $name; ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="text-label form-label">Event-Festival Type</label>
                                                <select class="default-select form-control wide mb-3" name="EventType">
                                                    <option value="Cultural"
                                                        <?php if ($type == 'Cultural') echo 'selected'; ?>>Cultural
                                                        Festivals</option>
                                                    <option value="Music"
                                                        <?php if ($type == 'Music') echo 'selected'; ?>>Music Festivals
                                                    </option>
                                                    <option value="Film" <?php if ($type == 'Film') echo 'selected'; ?>>
                                                        Film Festivals</option>
                                                    <option value="Food" <?php if ($type == 'Food') echo 'selected'; ?>>
                                                        Food Festivals</option>
                                                    <option value="Art" <?php if ($type == 'Art') echo 'selected'; ?>>Art
                                                        Festivals</option>
                                                    <option value="Religious"
                                                        <?php if ($type == 'Religious') echo 'selected'; ?>>Religious
                                                        Festivals</option>
                                                    <option value="Seasonal"
                                                        <?php if ($type == 'Seasonal') echo 'selected'; ?>>Seasonal
                                                        Festivals</option>
                                                    <option value="Historical"
                                                        <?php if ($type == 'Historical') echo 'selected'; ?>>Historical
                                                        Festivals</option>
                                                    <option value="Literary"
                                                        <?php if ($type == 'Literary') echo 'selected'; ?>>Literary
                                                        Festivals</option>
                                                    <option value="Sports"
                                                        <?php if ($type == 'Sports') echo 'selected'; ?>>Sports Festivals
                                                    </option>
                                                    <option value="Harvest"
                                                        <?php if ($type == 'Harvest') echo 'selected'; ?>>Harvest
                                                        Festivals</option>
                                                    <option value="Technology"
                                                        <?php if ($type == 'Technology') echo 'selected'; ?>>Technology
                                                        Festivals</option>
                                                    <option value="Community"
                                                        <?php if ($type == 'Community') echo 'selected'; ?>>Community
                                                        Festivals</option>
                                                    <option value="Other"
                                                        <?php if ($type == 'Other') echo 'selected'; ?>>Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="startDate" class="text-label form-label">Start Date:</label>
                                                <input type="date" class="form-control" id="startDate"
                                                    value="<?php echo $stdate; ?>" name="startdate">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="endDate" class="text-label form-label">End Date:</label>
                                                <input type="date" class="form-control" id="endDate"
                                                    value="<?php echo $eddate; ?>" name="enddate">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="text-label form-label">Contact No.</label>
                                                <input type="text" name="ContactNo" value="<?php echo $connum; ?>"

                                                    class="form-control" " >
                                            </div>
                                            <div class=" mb-3 col-md-6">
                                                <label class="text-label form-label">Description</label>
                                                <textarea class="form-control" name="Description"
                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                    maxlength="400"><?php echo $Desc; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="col-lg-1 ms-auto">

                                                <?php if (isset($_GET['updateid'])) { ?>
                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary">Update</button>

                                                <?php } else { ?>

                                                    <button type="submit" name="submit"
                                                        class="btn btn-primary">Submit</button>

                                                <?php } ?>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Import Section -->



                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Here Edit End -->
                    <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;" id="import-section">
                        <h4>🎉 Bulk Import Events & Festivals</h4>
                        <p class="text-muted mb-3">
                            <strong>How it works:</strong> Download the template, fill in the events data, and import.
                            <strong>Village ID is automatically assigned</strong> - you don't need to fill it.
                        </p>

                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <a href="templates/eventsfestivals_template.php" class="btn btn-info w-100">
                                    📥 Download Template
                                </a>
                            </div>
                            <div class="col-md-8">
                                <form action="imports/import_eventsfestivals.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
                                    <input type="file" name="excel_file" class="form-control"
                                        accept=".xls,.xlsx" required style="max-width: 300px;">
                                    <button type="submit" class="btn btn-success">
                                        📤 Import Excel
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="mt-3 p-2  border rounded">
                            <small class="text-muted">
                                <strong>💡 Required fields:</strong> Event Name, Event Type<br>
                                <strong>📝 Optional fields:</strong> Start Date, End Date, Contact Number, Description<br>
                                <strong>⚠️ Notes:</strong><br>
                                • <strong>Event Type:</strong> Cultural, Music, Film, Food, Art, Religious, Seasonal, Historical, Literary, Sports, Harvest, Technology, Community, Other - defaults to Other<br>
                                • <strong>Dates:</strong> Format YYYY-MM-DD (e.g., 2024-10-03)<br>
                                • <strong>Contact Number:</strong> 10-digit phone number<br>
                                • <strong>Date Range:</strong> Start date can be after end date (will auto-swap)<br>
                                • <strong>Visibility:</strong> on/off - defaults to off
                            </small>
                        </div>
                    </div>
                </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(e) {
                let isValid = true;
                let messages = [];

                const name = document.querySelector('input[name="EventName"]').value.trim();
                if (name === "") {
                    messages.push('Event Name is required.')
                    isValid = false;
                }

                const select = this.querySelector('select[name="EventType"]').value.trim();
                if (select === "") {
                    messages.push('Event Type is required.')
                    isValid = false;
                }

                //for contact number
                // const contact = document.querySelector('input[name="ContactNo"]').value.trim();
                // if (contact === "") {
                //     messages.push('Contact number is required');
                //     isValid = false;
                // } else if (!/^[6-9]\d{9}$/.test(contact)) {
                //     messages.push('Contact number must be 10 digit and should start from 6 to 9');
                //     isValid = false;
                // }

                const description = this.querySelector('textarea[name="Description"]').value.trim();
                if (description === "") {
                    messages.push('Description is required.')
                    isValid = false;
                }

                const sdate = this.querySelector('input[type="date"][name="startdate"]').value.trim();
                const edate = this.querySelector('input[type="date"][name="enddate"]').value.trim();
                if (sdate == "" || edate == "") {
                    messages.push('Start and End Date is required.')
                    isValid = false;
                }

                if (messages.length > 0) {
                    alert(messages.join('\n'));
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>

</html>