 <?php
                include_once '../config.php';
                
// session_start();
// if (!isset($_SESSION['village_admin_email'])) {
//     header("Location: index.php");
//     exit();
// }

// // Set the timeout duration (in seconds)
// $timeout_duration = 600; // 10 minutes

// // Check if last activity is set and calculate the inactivity period
// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
//     // Last request was over 10 minutes ago, so destroy the session
//     session_unset();     // Unset session variables
//     session_destroy();   // Destroy the session
//     header("Location: index.php"); // Redirect to login page
//     exit();
// }

// // Update the last activity timestamp to the current time
// $_SESSION['LAST_ACTIVITY'] = time();
                $Emg = new ConnDb();
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
    <title>Emergency Services | Admin Panel</title>

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

        <?php include('header.php');



        // Check if the delete ID is set from the previous page
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
    window.location.href = "editform.php?tablename=emergencyservices";
}
</script>
            </script>

        <?php
        }

        // After confirmation, handle the deletion process using 'confirmeddeleteid'
        if (isset($_GET['confirmeddeleteid'])) {
            $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

            // Perform the deletion logic here

            // Delete the record from the database
             $del = "DELETE FROM emergencyservices WHERE emergencyservicesid=" . $deleteId;
             $result = $Emg->deletedata("emergencyservices", $del);

            // Handle success or failure
            if ($result == "Data Deleted") {
                echo "<script>alert('Success! Data Deleted');
                window.location.href = 'editform.php?tablename=emergencyservices';
                </script>";
            } else {
                echo "<script>alert('Error: Failed to delete data');</script>";
            }
        }


        ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <?php
               


                $village_id = $Emg->selectdata("villagebasic", "select villageid from villagebasic");
                $villageid = $village_id[0]['villageid'];

                //url upadte id
                $fetchID = isset($_GET['updateid']) ? $_GET['updateid'] : "";

                if ($fetchID != "") {
                    $fetchquery = "select * from emergencyservices where emergencyservicesid=" . $fetchID;
                    $FormData = $Emg->selectdata("emergencyservices", $fetchquery);
                }

                // $Vid=isset($FormData[0]['VillageID']) ? $FormData[0]['VillageID'] : 12;
                $Vid = $villageid;
                $emergencyservicesID = isset($FormData[0]['emergencyservicesid']) ? $FormData[0]['emergencyservicesid'] : "";
                $name = isset($FormData[0]['servicename']) ? $FormData[0]['servicename'] : "";
                $type = isset($FormData[0]['servicetype']) ? $FormData[0]['servicetype'] : "";
                $connum = isset($FormData[0]['contactnumber']) ? $FormData[0]['contactnumber'] : "";
                $address_split = isset($FormData[0]['address']) ? $FormData[0]['address'] : "";
                $address_arr = explode("@", $address_split);
                $adres = isset($address_arr[0]) ? $address_arr[0] : "";
                $cty = isset($address_arr[1]) ? $address_arr[1] : "";
                $pincode = isset($address_arr[2]) ? $address_arr[2] : "";

                if (isset($_POST['submit'])) {

                    $emergencyservicesID = isset($_POST['emergencyservicesID']) ? $_POST['emergencyservicesID'] : "";
                    $VillageID = $villageid;
                    $ServiceName = isset($_POST['ServiceName']) ? $Emg->escape($_POST['ServiceName']) : "";
                    $ServiceType = isset($_POST['ServiceType']) ? $Emg->escape($_POST['ServiceType']) : "";
                    $contactNo = isset($_POST['ContactNo']) ? $Emg->escape($_POST['ContactNo']) : "";
                    $Address = isset($_POST['Address']) ? $Emg->escape($_POST['Address']) : "";
                    $city = isset($_POST['city']) ? $Emg->escape($_POST['city']) : "";
                    $zip = isset($_POST['zip']) ? $Emg->escape($_POST['zip']) : "";
                    $Address_join = $Address . "@" . $city . "@" . $zip;

                    if (isset($_POST['emergencyservicesID']) && $_POST['emergencyservicesID'] != "") {
                        if ($ServiceName != "" && $ServiceType != "" && $contactNo != "" && $VillageID != "") {
                            $sql = "update emergencyservices set servicename='$ServiceName', servicetype='$ServiceType', contactnumber='$contactNo', address='$Address_join', villageid=$VillageID where emergencyservicesid=$emergencyservicesID";
                            $result = $Emg->updatedata("emergencyservices", $sql);
                            if ($result == "Data Updated") {
                                // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                echo "<script>alert('Success! Data Updated');
                                window.location.href = 'editform.php?tablename=emergencyservices';
                                </script>";
                            } else {
                                echo "<script>alert('Error: Failed to update data');</script>";
                            }
                        } else {
                            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                Please Enter Complete Details! You Entered Details Are Incomplete!!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        }
                    } else {
                        if ($ServiceName != "" && $ServiceType != "" && $contactNo != "" && $VillageID != "") {
                            $sql = "insert into emergencyservices values(null,'$ServiceName','$ServiceType','$contactNo','$Address_join',$VillageID)";
                            $result = $Emg->insertdata("emergencyservices", $sql);
                            if ($result == "Data Inserted.") {
                                // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                                echo "<script>alert('Success! Data Inserted');
                                window.location.href = 'editform.php?tablename=emergencyservices';
                                </script>";
                            } else {
                                echo "<script>alert('Error: Failed to insert data');</script>";
                            }
                        } else {
                            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                        }
                    }
                }
                ?>
                <!-- Here Edit Start -->
                <div class="row">
                    <div class="col-xl-12 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Village Emegency Services</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">

                                        <div class="row">
                                            <input type="hidden" class="form-control" name="emergencyservicesID"
                                                value="<?php echo $emergencyservicesID; ?>">
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Emergency Service Name</label>
                                                <input type="text" class="form-control" name="ServiceName"
                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                    value="<?php echo $name; ?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="text-label form-label">Emergency Service Type</label>
                                                <select class="default-select form-control wide mb-3"
                                                    name="ServiceType">
                                                    <option value="Fire" <?php if ($type == 'Fire') echo 'selected'; ?>>
                                                        Fire</option>
                                                    <option value="Police"
                                                        <?php if ($type == 'Police') echo 'selected'; ?>>Police</option>
                                                    <option value="Medical"
                                                        <?php if ($type == 'Medical') echo 'selected'; ?>>Medical
                                                    </option>
                                                    <option value="Other"
                                                        <?php if ($type == 'Other') echo 'selected'; ?>>Other</option>
                                                </select>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="text-label form-label">Contact No.</label>
                                                <input type="text" name="ContactNo"
                                                    value="<?php echo $connum; ?>"
                                                    class="form-control">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="text-label form-label">Address</label>
                                                <textarea class="form-control"
                                                    name="Address"><?php echo $adres; ?></textarea>
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <div class="card-body px-0 pt-0">
                                                    <div class="basic-form">
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <label class="text-label form-label">City</label>
                                                                <input type="text" class="form-control"
                                                                    name="city"
                                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                                    value="<?php echo $cty; ?>">
                                                            </div>
                                                            <!-- <div class="col mt-2 mt-sm-0">
																			<label class="text-label form-label">State</label>
																				<input type="text" class="form-control" placeholder="State" name="state">
																			</div> -->
                                                            <div class="col mt-2 mt-sm-0">
                                                                <label class="text-label form-label">Pin Code</label>
                                                                <input type="text" class="form-control"
                                                                    name="zip"
                                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                                    value="<?php echo $pincode; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Here Edit End -->

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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(e) {
                let isValid = true;
                let messages = [];

                const name = document.querySelector('input[name="ServiceName"]').value.trim();
                if (name === "") {
                    messages.push('Service Name is required.')
                    isValid = false;
                }

                const select = this.querySelector('select[name="ServiceType"]').value.trim();
                if (select === "") {
                    messages.push('Service Type is required.')
                    isValid = false;
                }

                //for address
                const address = document.querySelector('textarea[name="Address"]').value.trim();
                let addressPattern = /^[a-zA-Z0-9\s,.-]{5,}$/;
  
                if (address == "" || !addressPattern.test(address)) {
                    alert("Minimum 5 characters, only letters, numbers, spaces, commas, periods, and dashes");
        isValid = false;
                }

                //for city
                const city = document.querySelector('input[name="city"]').value.trim();
                if (city === "") {
                    messages.push('City is required');
                    isValid = false;
                }

                //for zip
                const zip = document.querySelector('input[name="zip"]').value.trim();
                if (zip === "") {
                    messages.push('Zip code is required.');
                    isValid = false;
                } else if (!/^\d{6}$/.test(zip)) {
                    messages.push(' Zip code must be 6 digit');
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