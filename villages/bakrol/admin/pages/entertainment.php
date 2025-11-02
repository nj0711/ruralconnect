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

$name = '';
$address = '';
$city = '';
$zip = '';
$weekdayopen = '';
$weekdayclose = '';
$contact_no = '';
$description = '';
$type = '';


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
            window.location.href = "editform.php?tablename=entertainment";
        }
    </script>

<?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

    // Perform the deletion logic here
    $sel = "select * from entertainment where entertainmentid=" . $deleteId;
    $res = $obj->selectdata("entertainment", $sel);

    $p = $res[0]['photo'];
    $array = json_decode($p, true);  // Decode the JSON into an array

    // Directory for uploaded images
    $uploadDir = './uploadedimages/';
    foreach ($array as $image) {
        $filePath = $uploadDir . $image;  // Full path to the image
        if (file_exists($filePath)) {  // Check if the file exists
            if (unlink($filePath)) {  // Attempt to delete the file
                echo "Deleted: $image<br>";
            } else {
                echo "Failed to delete: $image<br>";
            }
        } else {
            echo "File does not exist: $image<br>";
        }
    }

    // Delete the record from the database
    $del = "DELETE FROM entertainment WHERE entertainmentid=" . $deleteId;
    $result = $obj->deletedata("entertainment", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
            window.location.href = 'editform.php?tablename=entertainment';
            </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}


if (isset($_POST['insert'])) {
    $name = isset($_POST['Name']) ? $obj->escape($_POST['Name']) : '';
    $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
    $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : '';
    $zip = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : '';
    $fullAddress = $address . '@' . $city . '@' . $zip;
    $weekdayopen = isset($_POST['weekdays-opening-time']) ? $obj->escape($_POST['weekdays-opening-time']) : '';
    $weekdayclose = isset($_POST['weekdays-closing-time']) ? $obj->escape($_POST['weekdays-closing-time']) : '';
    $time_duration = json_encode([
        'weekdayopenkey' => $weekdayopen,
        'weekdayclosekey' => $weekdayclose,
    ]);
    $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : '';
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : '';
    $type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';

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
                $newFileName = time() . $name . 'entertainment' . $i . '.' . $fileExtension;
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
    }
    // else {
    //     echo "No files selected.";
    // }
    $filesJson = json_encode($uploadedFiles);

    $selq = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selq);
    $village_id = $res[0]['villageid'];

    $query = "INSERT INTO entertainment (
		villageid, name, photo, address, timeschedule, contactno, description,type
	) VALUES (
		'$village_id', '$name', '$filesJson', '$fullAddress', '$time_duration', '$contact_no', '$description','$type'
	)";

    $result = $obj->insertdata("entertainment", $query);
    if ($result == "Data Inserted.") {
        echo "<script>alert('Success! Data Inserted');
            window.location.href = 'editform.php?tablename=entertainment';
            </script>";
    } else {
        echo "<script>alert('Error: Failed to insert data');</script>";
    }
}

if (isset($_GET['updateid'])) {
    $selq = "select * from entertainment where entertainmentid = " . $_GET['updateid'];
    $res = $obj->selectdata("entertainment", $selq);
    // print_r($res);

    if ($res != null) {

        $name = $res[0]['name'];
        $fullAddress = array_map('trim', explode('@', $res[0]['address']));
        $address = $fullAddress[0];
        $city = $fullAddress[1];
        $zip = $fullAddress[2];
        $timejson = $res[0]['timeschedule'];
        $time = json_decode($timejson, true);
        $weekdayopen = $time['weekdayopenkey'];
        $weekdayclose = $time['weekdayclosekey'];
        $contact_no = $res[0]['contactno'];
        $description = $res[0]['description'];
        $type = $res[0]['type'];
        $photo = $res[0]['photo'];
        $data = json_decode($photo, true);
        // print_r($res[0]);
    } else {
        header('Location: entertainment.php?updateid=' . $_GET['updateid']);
    }
}

if (isset($_POST['update'])) {
    $name = isset($_POST['Name']) ? $obj->escape($_POST['Name']) : '';
    $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
    $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : '';
    $zip = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : '';
    $fullAddress = $address . '@' . $city . '@' . $zip;
    $weekdayopen = isset($_POST['weekdays-opening-time']) ? $obj->escape($_POST['weekdays-opening-time']) : '';
    $weekdayclose = isset($_POST['weekdays-closing-time']) ? $obj->escape($_POST['weekdays-closing-time']) : '';
    $type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';
    $time_duration = json_encode([
        'weekdayopenkey' => $weekdayopen,
        'weekdayclosekey' => $weekdayclose,
    ]);
    $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : '';
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : '';

    $selQ = "select photo from entertainment  where entertainmentid  = " . $_GET['updateid'];
    $res = $obj->selectdata("entertainment", $selQ);
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
                $newFileName = time() . $name . 'entertainment' . $count + $i . '.' . $fileExtension;
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
    }
    // else {
    //     echo "No files selected.";
    // }
    $filesJson = json_encode($uploadedFiles);


    $updateq = "update entertainment set name = '{$name}', photo = '{$filesJson}', address = '{$fullAddress}', timeschedule = '{$time_duration}', contactno = '{$contact_no}', description = '{$description}',type='{$type}' where entertainmentId ={$_GET['updateid']}";
    $result = $obj->updatedata("entertainment", $updateq);

    if ($result == "Data Updated") {
        echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=entertainment';
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
    <title> Entertainment | Admin Panel</title>

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
                                <h4 class="card-title">Entertainment</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="#" method="post" enctype="multipart/form-data" name="myForm"
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
                                                                    Place*</label>
                                                                <input type="text" name="Name" class="form-control"
                                                                    value="<?php echo $name ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 col-md-6">
                                                            <label class="form-label"> Type </label>
                                                            <div class="mt-1">

                                                                <label class="radio-inline me-3"><input type="radio"
                                                                        name="type" class="form-check-input"
                                                                        value="theater" checked
                                                                        <?php if ($type == 'theater') {
                                                                            echo 'checked';
                                                                        } ?>>
                                                                    theater</label>
                                                                <label class="radio-inline me-3"><input type="radio"
                                                                        name="type" class="form-check-input"
                                                                        value="funpark"
                                                                        <?php if ($type == 'funpark') {
                                                                            echo 'checked';
                                                                        } ?>>
                                                                    Fun Park/Game Zone</label>
                                                                <label class="radio-inline me-3"><input type="radio"
                                                                        name="type" class="form-check-input"
                                                                        value="other"
                                                                        <?php if ($type == 'other') {
                                                                            echo 'checked';
                                                                        } ?>>
                                                                    Other</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Address*</label>
                                                                <textarea class="form-control"
                                                                    name="Address" required><?php echo $address ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <div class="card-body px-0 pt-0">
                                                                    <div class="basic-form">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <label
                                                                                    class="text-label form-label">City*</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="city"
                                                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                                                    value="<?php echo $city ?>" required>
                                                                            </div>
                                                                            <div class="col mt-2 mt-sm-0">
                                                                                <label class="text-label form-label">Pin
                                                                                    Code*</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="zip"
                                                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                                                    value="<?php echo $zip ?>" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Contact
                                                                    No.*</label>
                                                                <input type="text" name="ContactNo" class="form-control"
                                                                    value="<?php echo $contact_no ?>" required>
                                                            </div>

                                                        </div>
                                                        <div class="col-lg-6 mb-2">


                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Other
                                                                    Information</label>
                                                                <textarea name="description" class="form-control"> <?php echo $description; ?></textarea>
                                                            </div>

                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="text-label form-label">Time Duration*</label>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <!-- <label class="text-label form-label">Time Duration</label> -->
                                                                <fieldset>

                                                                    <label for="weekdays-opening-time">Opening
                                                                        Time:</label>
                                                                    <input type="time" class="form-control"
                                                                        name="weekdays-opening-time"
                                                                        value="<?php echo $weekdayopen; ?>" required>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <!-- <label class="text-label form-label">Time Duration</label> -->
                                                                <fieldset>
                                                                    <label for="weekdays-closing-time">Closing
                                                                        Time:</label>
                                                                    <input type="time" class="form-control"
                                                                        name="weekdays-closing-time"
                                                                        value="<?php echo $weekdayclose; ?>" required>
                                                                </fieldset>
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
                                </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Import Section -->
                <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;" id="import-section">
                    <h4>🎬 Bulk Import Entertainment Venues</h4>
                    <p class="text-muted mb-3">
                        <strong>How it works:</strong> Download the template, fill in the entertainment venue data, and import.
                        <strong>Village ID is automatically assigned</strong> - you don't need to fill it.
                        <strong>Photos will be empty</strong> - add them later via the edit form.
                    </p>

                    <div class="row align-items-center g-3">
                        <div class="col-md-4">
                            <a href="templates/entertainment_template.php" class="btn btn-info w-100">
                                📥 Download Template
                            </a>
                        </div>
                        <div class="col-md-8">
                            <form action="imports/import_entertainment.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
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
                            <strong>💡 Required fields:</strong> Name, Address<br>
                            <strong>📝 Optional fields:</strong> City, Zip, Contact, Description<br>
                            <strong>⚠️ Notes:</strong><br>
                            • <strong>Type:</strong> theater, funpark, other - defaults to theater<br>
                            • <strong>Contact Number:</strong> 10-digit number<br>
                            • <strong>Zip Code:</strong> 6-digit number (e.g., 388001)<br>
                            • <strong>Time Schedule:</strong> JSON format <code>{"weekdayopenkey":"10:00","weekdayclosekey":"22:00"}</code><br>
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
           Support ticket button start
        ***********************************-->

    <!--**********************************
           Support ticket button end
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
    <!--     vendors -->
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

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const imageName = this.getAttribute('data-image');
                    const tableName = "entertainment";
                    if (confirm('Are you sure you want to delete this image?')) {
                        window.location.href =
                            `delete_image.php?image=${encodeURIComponent(imageName)}&tablename=${encodeURIComponent(tableName)}&updateid=${encodeURIComponent(<?php echo $_GET['updateid'] ?>)}`;
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('form').addEventListener('submit', function(e) {
                let isValid = true;
                let messages = [];

                // Validate  Name (not empty)
                const placeName = document.querySelector('input[name="Name"]').value.trim();
                if (placeName === "") {
                    messages.push('Name is required.');
                    isValid = false;
                }

                //for address
                const address = document.querySelector('textarea[name="Address"]').value.trim();
                if (address === "") {
                    messages.push('Address is required.');
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

                // //for contact number
                //                             const contact = document.querySelector('input[name="ContactNo"]').value.trim();
                //                             if (contact === "") {
                //                                 messages.push('Contact number is required');
                //                                 isValid = false;
                //                             } else if (!/^[6-9]\d{9}$/.test(contact)) {
                //                                 messages.push('Contact number must be 10 digit and should start from 6 to 9');
                //                                 isValid = false;
                //                             }

                //for history
                const history = document.querySelector('textarea[name="history"]').value.trim();
                if (history === "") {
                    messages.push('History is required');
                    isValid = false;
                }

                //timing
                const otime = document.querySelector('input[name="weekdays-opening-time"]').value.trim();
                const ctime = document.querySelector('input[name="weekdays-closing-time"]').value.trim();
                if (otime === "" || ctime === "") {
                    messages.push('Opening and closing time is required for weekdays');
                    isValid = false;
                }

                //for description
                const description = document.querySelector('textarea[name="description"]').value.trim();
                if (description === "") {
                    messages.push('description is required');
                    isValid = false;
                }


                //box display
                if (messages.length > 0) {
                    alert(messages.join('\n'));
                    isValid = false;
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        });

        function validateForm() {

            var photoInput = document.getElementById('photo');
            var files = photoInput.files;
            var maxSize = 5 * 1024 * 1024; // 2MB

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

</body>

</html>