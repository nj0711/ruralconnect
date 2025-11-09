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

$stationName = '';
$stationType = '';
$address = '';
$city = '';
$zip = '';
$contactNo = '';
$email = '';
$ticketProcess = '';
$description = '';


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
            window.location.href = "editform.php?tablename=transport";
        }
    </script>



<?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

    // Perform the deletion logic here
    $sel = "select * from transport where transportid=" . $deleteId;
    $res = $obj->selectdata("transport", $sel);

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
                echo "Failed to delete: $image<br>";
            }
        } else {
            echo "File does not exist: $image<br>";
        }
    }

    // Delete the record from the database
    $del = "DELETE FROM transport WHERE transportid=" . $deleteId;
    $result = $obj->deletedata("transport", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
        window.location.href = 'editform.php?tablename=transport';
        </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}

if (isset($_POST['insert'])) {
    // Step 1: Create the 'banks' table if it does not exist in this village database
    $createTableQuery = "
                       CREATE TABLE `transport` (
  `transportid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `villageid` int(11) DEFAULT NULL,
  `stationname` varchar(255) DEFAULT NULL,
  `stationtype` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contactno` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `ticketingprocess` varchar(255) DEFAULT NULL,
  `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
  `description` varchar(255) DEFAULT NULL,
  `visibility` varchar(5) NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
                        ";

    // Run the create table query once (it won't recreate if already exists)
    if (!$obj->tableExists('transport')) {
        if (!$obj->mysqli->query($createTableQuery)) {
            echo "<script>alert('Error creating table: " . $obj->mysqli->error . "');</script>";
        }
    }

    $stationName = isset($_POST['StationName']) ? $obj->escape($_POST['StationName']) : '';
    $stationType = isset($_POST['stationType']) ? $obj->escape($_POST['stationType']) : '';
    $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
    $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : '';
    $zip = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : '';
    $fullAddress = $address . '@' . $city . '@' . $zip;
    $contactNo = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : '';
    $email = isset($_POST['Email']) ? $obj->escape($_POST['Email']) : '';
    $ticketProcess = isset($_POST['ticketProcess']) ? $obj->escape($_POST['ticketProcess']) : '';
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : '';


    $filesJson = json_encode('');
    $uploadDir = './uploadedimages/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'jfif', 'pjpeg', 'pjp', 'svg', 'webp'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    // Array to store filenames
    $uploadedFiles = [];

    if (isset($_FILES['Photo']) && !empty($_FILES['Photo']['name'][0])) {

        $fileCount = count($_FILES['Photo']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['Photo']['name'][$i];
            $fileTmpName = $_FILES['Photo']['tmp_name'][$i];
            $fileError = $_FILES['Photo']['error'][$i];
            $fileSize = $_FILES['Photo']['size'][$i];

            if ($fileError === UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                // echo $newFileName = time().$stationName.'station'.$i.'.'.$fileExtension;
                $newFileName = time() . $stationName . 'station' . $i . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;
                if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // Store the filename in the array

                        $uploadedFiles[] = $newFileName;
                    } else {
                        echo "<script>alert('Failed to move file: $fileName');</script>";
                    }
                } else {
                    echo "<script>alert('File Formate or Size is invalid');</script>";
                }
            }
        }
    } else {
    }
    $filesJson = json_encode($uploadedFiles);

    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    // echo $res[0]['villageid'];


    $query = "INSERT INTO transport (
    villageid,stationname, stationtype, address, contactno, email, ticketingprocess, photo, description
) VALUES (
    $village_id,'$stationName', '$stationType', '$fullAddress', '$contactNo', '$email', '$ticketProcess', '$filesJson',
     '$description'
)";


    $result = $obj->insertdata("transport", $query);
    if ($result == "Data Inserted.") {
        echo "<script>alert('Success! Data Inserted');
    window.location.href = 'editform.php?tablename=transport';
    </script>";
    } else {
        echo "<script>alert('Error: Failed to insert data');</script>";
    }
}



if (isset($_GET['updateid'])) {

    $selQ = "select * from transport where transportid=" . $_GET['updateid'];
    $res = $obj->selectdata("transport", $selQ);
    if ($res != null) {
        // echo $res[0]['villageid'];
        $stationName = $res[0]['stationname'];
        $stationType = $res[0]['stationtype'];
        $fullAddress = array_map('trim', explode('@', $res[0]['address']));


        $address = $fullAddress[0];
        $city = $fullAddress[1];
        $zip = $fullAddress[2];
        $contactNo = $res[0]['contactno'];
        $email = $res[0]['email'];
        $ticketProcess = $res[0]['ticketingprocess'];
        $description = $res[0]['description'];
        $photo = $res[0]['photo'];
        $data = json_decode($photo, true);
    } else {
        header('Location: transport.php?updateid=' . $_GET['updateid']);
    }
}

if (isset($_POST['update'])) {
    $stationName = isset($_POST['StationName']) ? $obj->escape($_POST['StationName']) : '';
    $stationType = isset($_POST['stationType']) ? $obj->escape($_POST['stationType']) : '';
    $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
    $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : '';
    $zip = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : '';
    $fullAddress = $address . '@' . $city . '@' . $zip;
    $contactNo = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : '';
    $email = isset($_POST['Email']) ? $obj->escape($_POST['Email']) : '';
    $ticketProcess = isset($_POST['ticketProcess']) ? $obj->escape($_POST['ticketProcess']) : '';
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : '';

    $selQ = "select photo from transport  where transportid = " . $_GET['updateid'];
    $res = $obj->selectdata("transport", $selQ);
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

    if (isset($_FILES['Photo']) && !empty($_FILES['Photo']['name'][0])) {

        $fileCount = count($_FILES['Photo']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['Photo']['name'][$i];
            $fileTmpName = $_FILES['Photo']['tmp_name'][$i];
            $fileError = $_FILES['Photo']['error'][$i];
            $fileSize = $_FILES['Photo']['size'][$i];

            if ($fileError === UPLOAD_ERR_OK) {
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = time() . $stationName . 'station' . $count + $i . '.' . $fileExtension;
                // echo $newFileName = time().$stationName.'station'.$count+$i.'.'.$fileExtension;
                $destination = $uploadDir . $newFileName;
                if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        // Store the filename in the array

                        $uploadedFiles[] = $newFileName;
                    } else {
                        echo "<script>alert('Failed to move file: $fileName');</script>";
                    }
                } else {
                    echo "<script>alert('File Formate or Size is invalid');</script>";
                }
            }
        }
    } else {
    }
    // echo $filesJson = json_encode($uploadedFiles);
    $filesJson = json_encode($uploadedFiles);

    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    // echo $res[0]['villageid'];


    $qupdate = "update transport set stationname='{$stationName}' ,stationtype='{$stationType}', contactno='{$contactNo}'
, email='{$email}' , ticketingprocess='{$ticketProcess}',photo='{$filesJson}',description='{$description}' where transportid={$_GET['updateid']}";


    $result = $obj->updatedata("transport", $qupdate);
    if ($result == "Data Updated") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
    window.location.href = 'editform.php?tablename=transport';
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
    <title> Transport | Admin Panel</title>

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
                                <h4 class="card-title">Transport</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form action="#" method="post" enctype="multipart/form-data" name="myForm"
                                        onsubmit="return validateForm()">
                                        <div class="row">
                                            <div class="col-lg-12  col-xxl-12">
                                                <div class="tab-content">
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Name of
                                                                    Station</label>
                                                                <input type="text" name="StationName"
                                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                                    value="<?php echo $stationName ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Type</label>
                                                                <div class="mb-3 mb-0">

                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="stationType" value="BusStation"
                                                                            class="form-check-input" checked <?php if ($stationType == 'BusStation') {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                                        Bus
                                                                        Station</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="stationType" value="RailwayStation"
                                                                            class="form-check-input" <?php if ($stationType == 'RailwayStation') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                                        Railway
                                                                        Station</label>
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
                                                                                    name="city"
                                                                                    onkeypress="return (event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32"
                                                                                    value="<?php echo $city; ?>">
                                                                            </div>
                                                                            <div class="col mt-2 mt-sm-0">
                                                                                <label class="text-label form-label">Pin
                                                                                    Code</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="zip"
                                                                                    onkeypress="return (event.charCode >= 48 && event.charCode <= 57)"
                                                                                    value="<?php echo $zip; ?>">
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
                                                                    value="<?php echo $contactNo; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Email </label>
                                                                <input type="text" name="Email" class="form-control"
                                                                    value="<?php echo $email; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Ticket
                                                                    Process</label>
                                                                <div class="mb-3 mb-0">
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="ticketProcess" value="online"
                                                                            class="form-check-input" <?php if ($ticketProcess == 'online') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                                        Online</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="ticketProcess" value="offline"
                                                                            class="form-check-input" <?php if ($ticketProcess == 'offline') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                                        Offline</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="ticketProcess" value="both"
                                                                            class="form-check-input" checked <?php if ($ticketProcess == 'both') {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                                        Both</label>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Add Image </label>
                                                                <div class="mb-3">
                                                                    <input class="form-control" type="file"
                                                                        name="Photo[]" id="photo" multiple>
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
                                                                                                    aria-current="true"
                                                                                                    <?php } ?>
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
                                                                                                    <div
                                                                                                        class="button-container">
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
                                                                                        <button
                                                                                            class="carousel-control-prev"
                                                                                            type="button"
                                                                                            data-bs-target="#carouselExampleIndicators"
                                                                                            data-bs-slide="prev">
                                                                                            <span
                                                                                                class="carousel-control-prev-icon"
                                                                                                aria-hidden="true"></span>
                                                                                            <span>Previous</span>
                                                                                        </button>

                                                                                        <!-- Next Button -->
                                                                                        <button
                                                                                            class="carousel-control-next"
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
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Other
                                                                    Information</label>
                                                                <textarea name="description" maxlength="400"
                                                                    class="form-control"><?php echo $description; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3 row">
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
                                    <!-- Add this right after <div class="content-body"> and before the existing form -->

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Here Edit End -->
                    <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;">
                        <h4>📊 Bulk Import Transport Services</h4>
                        <p class="text-muted mb-3">
                            <strong>How it works:</strong> Download the template, fill in the data, and import.
                            <!-- <strong>Village ID is automatically assigned</strong> - you don't need to fill it. -->
                        </p>

                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <a href="templates/transport_template.php" class="btn btn-info w-100">
                                    📥 Download Template
                                </a>
                            </div>
                            <div class="col-md-8">
                                <form action="imports/import_transport.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
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
                                <strong>💡 Required fields:</strong> Station Name, Station Type, Address, City, Zip, Email, Ticketing Process<br>
                                <strong>📝 Optional fields:</strong> Contact No, Description, Visibility<br>
                                <strong>⚠️ Notes:</strong>
                                Photos will be empty (add later via edit form),
                                Station Type: "BusStation" or "RailwayStation",<br>
                                Ticketing Process: "online", "offline", or "both"
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
            Footer start
        ***********************************-->
    <div class="footer">
        <?php include_once('../footer.php'); ?>
    </div>
    <!--**********************************
            Footer end
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

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const imageName = this.getAttribute('data-image');
                    const tableName = "transport";
                    if (confirm('Are you sure you want to delete this image?')) {
                        // Redirect to the delete PHP script with the image name as a query parameter
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

                // Validate Station Name (not empty)
                const stationName = document.querySelector('input[name="StationName"]').value.trim();
                if (stationName === "") {
                    messages.push('Station Name is required.');
                    isValid = false;
                }

                // Validate Address (not empty)
                const address = document.querySelector('textarea[name="Address"]').value.trim();
                if (address === "") {
                    messages.push('Address is required.');
                    isValid = false;
                }

                // Validate City (not empty)
                const city = document.querySelector('input[name="city"]').value.trim();
                if (city === "") {
                    messages.push('City is required.');
                    isValid = false;
                }

                // Validate Pin Code (6 digits, not empty)
                const pinCode = document.querySelector('input[name="zip"]').value.trim();
                if (pinCode === "") {
                    messages.push('Pin Code is required.');
                    isValid = false;
                } else if (!/^\d{6}$/.test(pinCode)) {
                    messages.push('Pin Code must be a 6 digit number.');
                    isValid = false;
                }

                // Validate Contact Number (10 digits starting with 6, 7, 8, or 9, not empty)
                // const contactNo = document.querySelector('input[name="ContactNo"]').value.trim();
                // if (contactNo === "") {
                //     messages.push('Contact Number is required.');
                //     isValid = false;
                // } else if (!/^[6-9]\d{9}$/.test(contactNo)) {
                //     messages.push('Contact Number must be a 10 digit number starting with 6, 7, 8, or 9.');
                //     isValid = false;
                // }

                // Validate Email (not empty)
                const email = document.querySelector('input[name="Email"]').value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (email === "") {
                    messages.push('Email is required.');
                    isValid = false;
                } else if (!emailRegex.test(email)) {
                    messages.push('Please enter a valid email address.');
                    isValid = false;
                }

                // Validate Ticket Process (must select one option)
                const ticketProcess = document.querySelector('input[name="ticketProcess"]:checked');
                if (!ticketProcess) {
                    messages.push('Ticket Process is required.');
                    isValid = false;
                }

                //photos
                const url = window.location.href;
                if (url.includes('updateid=')) {

                    const pary = document.getElementsByName('Photo[]');
                    if (pary.length === 0) {
                        messages.push('Please upload at least one image.');
                        isValid = false;
                    }
                } else {

                    const imageUpload = document.querySelector('input[name="Photo[]"]').files.length;
                    if (imageUpload === 0) {
                        messages.push('Please upload at least one image.');
                        isValid = false;
                    }
                }

                // Validate Other Information (not empty)
                // const otherInfo = document.querySelector('textarea[name="description"]').value.trim();
                // if (otherInfo === "") {
                //     messages.push('Other Information is required.');
                //     isValid = false;
                // }

                //box display
                if (messages.length > 0) {
                    alert(messages.join('\n'));
                    // isValid = false;
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