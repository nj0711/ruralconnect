<?php
include('../config.php');


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
$station_name = "";
$address = "";
$city = "";
$pincode = "";
$fuel_type = [];
$time_schedule = "";
$description = "";
$photos = "";
$fullAddress = $address . '@' . $city . '@' . $pincode;
$contact_no = "";




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
            window.location.href = "editform.php?tablename=fuelstation";
        }
    </script>

<?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

    // Perform the deletion logic here
    $sel = "select * from fuelstation where fuelstationid=" . $deleteId;
    $res = $obj->selectdata("fuelstation", $sel);

    $p = $res[0]['photo'];
    $array = json_decode($p, true);  // Decode the JSON into an array

    // Directory for uploaded images
    $uploadDir = './uploadedimages/';
    foreach ($array as $image) {
        $filePath = $uploadDir . $image;  // Full path to the image
        if (file_exists($filePath)) {  // Check if the file exists
            if (unlink($filePath)) {  // Attempt to delete the file
                // echo "Deleted: $image<br>";
            } else {
                // echo "Failed to delete: $image<br>";
            }
        } else {
            // echo "File does not exist: $image<br>";
        }
    }

    // Delete the record from the database
    $del = "DELETE FROM fuelstation WHERE fuelstationid=" . $deleteId;
    $result = $obj->deletedata("fuelstation", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
            window.location.href = 'editform.php?tablename=fuelstation';
            </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}

if (isset($_POST['insert'])) {

    $station_name = isset($_POST['StationName']) ? $obj->escape($_POST['StationName']) : "";
    $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
    $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : "";
    $pincode = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : "";
    $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : "";
    $fuel_type = $_POST['fuel_type'];
    $time_schedule_open = isset($_POST['TimeDurationOpen']) ? $obj->escape($_POST['TimeDurationOpen']) : "";
    $time_schedule_close = isset($_POST['TimeDurationClose']) ? $obj->escape($_POST['TimeDurationClose']) : "";
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
    $fullAddress = $address . '@' . $city . '@' . $pincode;



    if (is_array($fuel_type)) {
        $fuel_type_str = implode(',', $fuel_type);
    } else {
        $fuel_type_str = ''; // Set to an empty string if no checkboxes are selected
    }

    $time = json_encode([
        'open' => $time_schedule_open,
        'close' => $time_schedule_close
    ]);


    $filesJson = json_encode('');
    $uploadDir = './uploadedimages/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'jfif', 'pjpeg', 'pjp', 'svg', 'webp'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    // Array to store filenames
    $uploadedFiles = [];

    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'][0])) {

        $fileCount = count($_FILES['photo']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['photo']['name'][$i];
            $fileTmpName = $_FILES['photo']['tmp_name'][$i];
            $fileError = $_FILES['photo']['error'][$i];
            $fileSize = $_FILES['photo']['size'][$i];

            if ($fileError === UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = time() . $station_name . 'fuelstation' . $i . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;
                if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // Store the filename in the array

                        $uploadedFiles[] = $newFileName;
                    } else {
                        echo "Failed to move file: $fileName<br>";
                    }
                } else {
                    echo "File Formate or Size is invalid";
                }
            }
        }
    } //else {
    //     echo "No files selected.";
    // }
    $filesJson = json_encode($uploadedFiles);

    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    $res[0]['villageid'];

    $query = "INSERT INTO fuelstation (
			villageid,fuelstationname, photo, pumpstimeduration, contactno, address,typesoffuelavailable,description
		) VALUES (
			'$village_id','$station_name', '$filesJson', '$time', $contact_no, ' $fullAddress','$fuel_type_str', '$description'
		)";
    $result = $obj->insertdata("fuelstation", $query);
    if ($result == "Data Inserted.") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Inserted');
            window.location.href = 'editform.php?tablename=fuelstation';
            </script>";
    } else {
        echo "<script>alert('Error: Failed to insert data');</script>";
    }
}

if (isset($_GET['updateid'])) {

    $selQ = "select * from fuelstation where fuelstationid=" . $_GET['updateid'];

    $res = $obj->selectdata("fuelstation", $selQ);
    if ($res != null) {
        $station_name = $res[0]['fuelstationname'];
        $timeJson = $res[0]['pumpstimeduration'];
        $timeArray = json_decode($timeJson, true);
        $time_schedule_open = $timeArray['open'];
        $time_schedule_close = $timeArray['close'];
        $contact_no = $res[0]['contactno'];

        $fuel_type_str = $res[0]['typesoffuelavailable'];
        $fuel_type = explode(',', $fuel_type_str);


        $description = $res[0]['description'];
        $fullAddress = array_map('trim', explode('@', $res[0]['address']));
        $address = $fullAddress[0];
        $city = $fullAddress[1];
        $pincode = $fullAddress[2];
        $photo = $res[0]['photo'];
        $data = json_decode($photo, true);
    } else {
        header('Location: fuel_station.php');
    }
}

if (isset($_POST['update'])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    $station_name = isset($_POST['StationName']) ? $obj->escape($_POST['StationName']) : "";
    $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
    $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : "";
    $pincode = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : "";
    $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : "";
    $fuel_type = $_POST['fuel_type'];
    $time_schedule_open = isset($_POST['TimeDurationOpen']) ? $obj->escape($_POST['TimeDurationOpen']) : "";
    $time_schedule_close = isset($_POST['TimeDurationClose']) ? $obj->escape($_POST['TimeDurationClose']) : "";
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
    $fullAddress = $address . '@' . $city . '@' . $pincode;



    if (is_array($fuel_type)) {
        $fuel_type_str = implode(',', $fuel_type);
    } else {
        $fuel_type_str = ''; // Set to an empty string if no checkboxes are selected
    }

    $time = json_encode([
        'open' => $time_schedule_open,
        'close' => $time_schedule_close
    ]);



    $selQ = "select photo from fuelstation  where fuelstationid  = " . $_GET['updateid'];
    $res = $obj->selectdata("fuelstation", $selQ);
    $p = $res[0]['photo'];
    $array = json_decode($p);
    $count = count($array);


    $filesJson = json_encode('');
    $uploadDir = './uploadedimages/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'jfif', 'pjpeg', 'pjp', 'svg', 'webp'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    // Array to store filenames
    $uploadedFiles = [];
    $uploadedFiles = $array;

    if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'][0])) {

        $fileCount = count($_FILES['photo']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['photo']['name'][$i];
            $fileTmpName = $_FILES['photo']['tmp_name'][$i];
            $fileError = $_FILES['photo']['error'][$i];
            $fileSize = $_FILES['photo']['size'][$i];

            if ($fileError === UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName =  time() . $station_name . 'fuelstation' . $count + $i . '.' . $fileExtension; //echo
                $destination = $uploadDir . $newFileName;
                if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // Store the filename in the array

                        $uploadedFiles[] = $newFileName;
                    } else {
                        echo "Failed to move file: $fileName<br>";
                    }
                } else {
                    echo "File Formate or Size is invalid";
                }
            }
        }
    } //else {
    //     echo "No files selected.";
    // }
    $filesJson = json_encode($uploadedFiles); //echo

    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    $res[0]['villageid'];  //echo


    $qupdate = "update fuelstation set fuelstationname='{$station_name}',address='{$fullAddress}',pumpstimeduration='{$time}', contactno='{$contact_no}'
    ,typesoffuelavailable='{$fuel_type_str}',photo='{$filesJson}',description='{$description}' where fuelstationid ={$_GET['updateid']}";


    $result = $obj->updatedata("fuelstation", $qupdate);

    if ($result == "Data Updated") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=fuelstation';
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
    <title> Fuel-Station | Admin Panel</title>

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

    <!--*******************
        Preloader start
    ********************-->
    <!--<div id="preloader">-->
    <!--    <div class="lds-ripple">-->
    <!--        <div></div>-->
    <!--        <div></div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--*******************
        Preloader end
    ********************-->

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
                                <h4 class="card-title">Fuel Station</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form name="fuelStationForm" method="post" action="#" enctype="multipart/form-data"
                                        onsubmit="return validateForm()">
                                        <div class="row">
                                            <div class="col-lg-12  col-xxl-12">
                                                <!-- <div class="card"> -->

                                                <!-- <div class="card-body"> -->
                                                <div class="tab-content">
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Name of
                                                                    Station</label>
                                                                <input type="text" name="StationName"
                                                                    value="<?php echo $station_name ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Fuel Type</label>
                                                                <div class="mb-3 mb-0">
                                                                    <label class="checkbox-inline me-3">
                                                                        <input type="checkbox" name="fuel_type[]"
                                                                            value="petrol" <?php if (isset($fuel_type) && in_array('petrol', $fuel_type)) {
                                                                                                echo 'checked';
                                                                                            } ?> class="form-check-input">
                                                                        Petrol
                                                                    </label>

                                                                    <label class="checkbox-inline me-3">
                                                                        <input type="checkbox" name="fuel_type[]"
                                                                            value="diesel" <?php if (isset($fuel_type) && in_array('diesel', $fuel_type)) {
                                                                                                echo 'checked';
                                                                                            } ?> class="form-check-input">
                                                                        Diesel
                                                                    </label>

                                                                    <label class="checkbox-inline me-3">
                                                                        <input type="checkbox" name="fuel_type[]"
                                                                            value="cng" <?php if (isset($fuel_type) && in_array('cng', $fuel_type)) {
                                                                                            echo 'checked';
                                                                                        } ?> class="form-check-input">
                                                                        CNG
                                                                    </label>

                                                                    <label class="checkbox-inline me-3">
                                                                        <input type="checkbox" name="fuel_type[]"
                                                                            value="other" <?php if (isset($fuel_type) && in_array('other', $fuel_type)) {
                                                                                                echo 'checked';
                                                                                            } ?> class="form-check-input">
                                                                        Other
                                                                    </label>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Address</label>
                                                                <textarea class="form-control"
                                                                    name="Address"><?php echo $address; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <div class="card-body px-0 pt-0">
                                                                    <div class="basic-form">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <label
                                                                                    class="text-label form-label">City</label>
                                                                                <input type="text" class="form-control"
                                                                                    value="<?php echo $city ?>"
                                                                                    name="city">
                                                                            </div>
                                                                            <!-- <div class="col mt-2 mt-sm-0">
                                                                            <label class="text-label form-label">State</label>
                                                                                <input type="text" class="form-control" placeholder="State" name="state">
                                                                            </div> -->
                                                                            <div class="col mt-2 mt-sm-0">
                                                                                <label class="text-label form-label">Pin
                                                                                    Code</label>
                                                                                <input type="number"
                                                                                    class="form-control"
                                                                                    value="<?php echo $pincode ?>"
                                                                                    name="zip">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Contact
                                                                    No.</label>
                                                                <input type="text" name="ContactNo" class="form-control"
                                                                    value="<?php echo $contact_no ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Time duration
                                                                </label>
                                                                <div class="mb-3">
                                                                    Open
                                                                    <input class="form-control" type="time"
                                                                        value="<?php echo $time_schedule_open ?>"
                                                                        name="TimeDurationOpen">
                                                                </div>
                                                                <div class="mb-3">
                                                                    close
                                                                    <input class="form-control" type="time"
                                                                        value="<?php echo $time_schedule_close ?>"
                                                                        name="TimeDurationClose">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Other
                                                                    Information</label>
                                                                <textarea name="description"
                                                                    class="form-control"><?php echo $description; ?></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="mb-3">
                                                            <label class="text-label form-label"> Add Image </label>
                                                            <div class="mb-3">
                                                                <input class="form-control" type="file" name="photo[]"
                                                                    id="photo" multiple>
                                                                <?php if (isset($_GET['updateid'])) { ?>
                                                                    <div class="col-xl-6">
                                                                        <div class="card">
                                                                            <div class="card-body p-4">
                                                                                <h4 class="card-intro-title">Slides only
                                                                                </h4>
                                                                                <div id="carouselExampleIndicators"
                                                                                    class="carousel slide"
                                                                                    data-bs-ride="carousel">
                                                                                    <div class="carousel-indicators">

                                                                                        <?php

                                                                                        foreach ($data as $index => $person) { ?>
                                                                                            <button type="button"
                                                                                                data-bs-target="#carouselExampleIndicators"
                                                                                                data-bs-slide-to="<?php echo $index; ?>"
                                                                                                <?php if ($index == 0) { ?>
                                                                                                class="active"
                                                                                                aria-current="true" <?php } ?>
                                                                                                aria-label="Slide <?php echo ($index + 1); ?>">
                                                                                            </button>
                                                                                        <?php } ?>
                                                                                    </div>
                                                                                    <div class="carousel-inner">
                                                                                        <?php
                                                                                        $active = true;
                                                                                        foreach ($data as $index => $person) { ?>
                                                                                            <div
                                                                                                class="carousel-item <?php echo $active ? 'active' : ''; ?>">
                                                                                                <img class="d-block w-100"
                                                                                                    style="width:200px; height:200px"
                                                                                                    src="uploadedimages/<?php echo $person; ?>"
                                                                                                    alt="Slide image">
                                                                                                <div class="button-container">
                                                                                                    <?php
                                                                                                    if (count($data) > 1) { ?>
                                                                                                        <button type="button"
                                                                                                            class="btn btn-danger delete-btn"
                                                                                                            data-image="<?php echo $person; ?>">
                                                                                                            <span>Delete</span>
                                                                                                        </button>
                                                                                                    <?php }
                                                                                                    ?>

                                                                                                </div>
                                                                                            </div>
                                                                                        <?php
                                                                                            $active = false;
                                                                                        } ?>
                                                                                    </div>


                                                                                    <!-- Previous Button -->
                                                                                    <button class="carousel-control-prev"
                                                                                        type="button"
                                                                                        data-bs-target="#carouselExampleIndicators"
                                                                                        data-bs-slide="prev">
                                                                                        <span
                                                                                            class="carousel-control-prev-icon"
                                                                                            aria-hidden="true"></span>
                                                                                        <span>Previous</span>
                                                                                    </button>

                                                                                    <!-- Next Button -->
                                                                                    <button class="carousel-control-next"
                                                                                        type="button"
                                                                                        data-bs-target="#carouselExampleIndicators"
                                                                                        data-bs-slide="next">
                                                                                        <span
                                                                                            class="carousel-control-next-icon"
                                                                                            aria-hidden="true"></span>
                                                                                        <span>Next</span>
                                                                                    </button>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="margin-top:50px;">
                                                            <div class="col-lg-1 ms-auto">
                                                                <?php if (isset($_GET['updateid'])) { ?>
                                                                    <button type="submit" name="update"
                                                                        class="btn btn-primary">Update</button>
                                                                <?php } else { ?>
                                                                    <button type="submit" name="insert"
                                                                        class="btn btn-primary">Submit</button>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
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
                        <h4>⛽ Bulk Import Fuel Stations</h4>
                        <p class="text-muted mb-3">
                            <strong>How it works:</strong> Download the template, fill in the fuel station data, and import.
                            <strong>Village ID is automatically assigned</strong> - you don't need to fill it.
                            <strong>Photos will be empty</strong> - add them later via the edit form.
                        </p>

                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <a href="templates/fuelstation_template.php" class="btn btn-info w-100">
                                    📥 Download Template
                                </a>
                            </div>
                            <div class="col-md-8">
                                <form action="imports/import_fuelstation.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
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
                                <strong>💡 Required fields:</strong> Station Name, Fuel Types<br>
                                <strong>📝 Optional fields:</strong> Address, City, Zip, Contact, Description<br>
                                <strong>⚠️ Notes:</strong><br>
                                • <strong>Fuel Types:</strong> petrol,diesel,cng,other (comma-separated) - defaults to petrol<br>
                                • <strong>Contact Number:</strong> 10-digit phone number<br>
                                • <strong>Zip Code:</strong> 6-digit number (e.g., 388001)<br>
                                • <strong>Time Schedule:</strong> JSON format <code>{"open":"06:00","close":"22:00"}</code><br>
                                • <strong>Address Format:</strong> Full address in Address column, City and Zip in separate columns<br>
                                • <strong>Visibility:</strong> on/off - defaults to off<br>
                                • <strong>Photos:</strong> Will be empty - add via edit form later
                            </small>
                        </div>
                    </div>
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
        function validateForm() {
            // Validate Station Name
            let stationName = document.forms["fuelStationForm"]["StationName"].value;
            if (stationName == "") {
                alert("Station Name must be filled out");
                return false;
            }
            if (stationName.trim().length > 20) {
                alert("Station Name must be less than 20 characters long");
                return false;
            }

            // Validate Fuel Type (at least one checkbox selected)
            let fuelTypes = document.querySelectorAll('input[name="fuel_type[]"]:checked');
            if (fuelTypes.length == 0) {
                alert("Please select at least one fuel type");
                return false;
            }

            // Validate Address
            let address = document.forms["fuelStationForm"]["Address"].value;
            let addressPattern = /^[a-zA-Z0-9\s,.-]{5,}$/;
            if (address == "" || !addressPattern.test(address)) {
                alert("Minimum 5 characters, only letters, numbers, spaces, commas, periods, and dashes");
                return false;
            }

            // Validate City
            let city = document.forms["fuelStationForm"]["city"].value;
            if (city == "") {
                alert("City must be filled out");
                return false;
            }
            if (city.trim().length > 20) {
                alert("City must be less than 20 characters long");
                return false;
            }

            // Validate Pin Code
            let pincode = document.forms["fuelStationForm"]["zip"].value;
            let pincodeRegex = /^[1-9][0-9]{5}$/;
            if (pincode == "" || !pincodeRegex.test(pincode)) {
                alert("Please enter a valid Pin Code");
                return false;
            }

            // Validate Contact No.
            // let contactNo = document.forms["fuelStationForm"]["ContactNo"].value;
            // let contactPattern = /^[6-9]\d{9}$/;
            // if (!contactPattern.test(contactNo)) {
            //     alert("Please enter a valid contact number (10 digits starting with 6-9)");
            //     return false;
            // }

            // Validate Time Duration
            let timeOpen = document.forms["fuelStationForm"]["TimeDurationOpen"].value;
            let timeClose = document.forms["fuelStationForm"]["TimeDurationClose"].value;
            if (timeOpen == "" || timeClose == "") {
                alert("Please select both opening and closing times");
                return false;
            }

            // Validate Other Information
            let description = document.forms["fuelStationForm"]["description"].value;
            if (description == "") {
                alert("Please provide additional information");
                return false;
            }

            var photoInput = document.getElementById('photo');
            var files = photoInput.files;
            var maxSize = 5 * 1024 * 1024; // 5MB

            // Check if no photo is selected and no existing photos (update mode)
            var existingPhotos = <?php echo isset($_GET['updateid']) && !empty($data) ? 'true' : 'false'; ?>;
            if (files.length === 0 && !existingPhotos) {
                alert("Please select at least one photo.");
                return false; // Prevent form submission
            }

            // Check file sizes
            for (var i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert("File size of " + files[i].name + " exceeds 5MB.");
                    return false; // Prevent form submission
                }
            }

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


        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const imageName = this.getAttribute('data-image');
                    const tableName = "fuelstation";
                    if (confirm('Are you sure you want to delete this image?')) {
                        // Redirect to the delete PHP script with the image name as a query parameter
                        window.location.href =
                            `delete_image.php?image=${encodeURIComponent(imageName)}&tablename=${encodeURIComponent(tableName)}&updateid=${encodeURIComponent(<?php echo $_GET['updateid'] ?>)}`;
                    }
                });
            });
        });
    </script>
</body>

</html>