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


$bank_name = '';
$email = '';
$phone_no = '';
$address = '';
$number_of_atms = '';
$branch_code = '';
$operational_status = '';
$other_service_information = '';
$service_type = '';
$service_description = '';
$time = '';
$type = '';
/*json_encode([
        'Monday-Friday' => '09:00-17:00',
        'Saturday' => '10:00-14:00',
        'Sunday' => 'Closed'
    ]); */



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
            window.location.href = "editform.php?tablename=banks";
        }
    </script>

    <?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

    // Perform the deletion logic here
    $sel = "select * from banks where banksid=" . $deleteId;
    $res = $obj->selectdata("banks", $sel);

    $p = $res[0]['photo'];
    $array = json_decode($p, true);  // Decode the JSON into an array

    // Directory for uploaded images
    $uploadDir = './uploadedimages/';
    foreach ($array as $image) {
        $filePath = $uploadDir . $image;  // Full path to the image
        if (file_exists($filePath)) {  // Check if the file exists
            if (unlink($filePath)) {  // Attempt to delete the file
                //echo "Deleted: $image<br>";
            } else {
                //echo "Failed to delete: $image<br>";
            }
        } else {
            //echo "File does not exist: $image<br>";
        }
    }

    // Delete the record from the database
    $del = "DELETE FROM banks WHERE banksid=" . $deleteId;
    $result = $obj->deletedata("banks", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
        window.location.href = 'editform.php?tablename=banks';
        </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}


if (isset($_POST['insert'])) {


    // Step 1: Create the 'banks' table if it does not exist in this village database
    $createTableQuery = "
                        CREATE TABLE `banks` (
                        `banksid` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                        `villageid` int(11) DEFAULT NULL,
                        `bankname` varchar(50) NOT NULL,
                        `email` varchar(50) DEFAULT NULL,
                        `phoneno` bigint(20) DEFAULT NULL,
                        `address` varchar(300) NOT NULL,
                        `numberofatms` int(11) DEFAULT NULL,
                        `branchcode` varchar(20) NOT NULL,
                        `operationalstatus` enum('Open','Under Renovation','Closed') NOT NULL,
                        `otherserviceinformation` varchar(255) DEFAULT NULL,
                        `servicetype` varchar(255) DEFAULT NULL,
                        `servicedescription` varchar(255) DEFAULT NULL,
                        `timeschedule` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`timeschedule`)),
                        `photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`photo`)),
                        `type` varchar(10) DEFAULT NULL,
                        `visibility` varchar(5) NOT NULL DEFAULT 'off'
                        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
                        ";

    // Run the create table query once (it won't recreate if already exists)
    if (!$obj->tableExists('banks')) {
        if (!$obj->mysqli->query($createTableQuery)) {
            echo "<script>alert('Error creating table: " . $obj->mysqli->error . "');</script>";
        }
    }

    $bank_name = isset($_POST['bankName']) ? $obj->escape($_POST['bankName']) : '';
    $email = isset($_POST['email']) ? $obj->escape($_POST['email']) : '';
    $phone_no = isset($_POST['cNo']) ? $obj->escape($_POST['cNo']) : 0;
    $address = isset($_POST['address']) ? $obj->escape($_POST['address']) : '';
    $number_of_atms = isset($_POST['totalATM']) ? $obj->escape($_POST['totalATM']) : 0;
    $branch_code = isset($_POST['bCode']) ? $obj->escape($_POST['bCode']) : '';
    $operational_status = isset($_POST['status']) ? $obj->escape($_POST['status']) : '';
    $other_service_information = isset($_POST['serviceInfo']) ? $obj->escape($_POST['serviceInfo']) : '';
    $service_description = isset($_POST['serviceDesc']) ? $obj->escape($_POST['serviceDesc']) : '';
    $open_time = isset($_POST['openTime']) ? $obj->escape($_POST['openTime']) : '';
    $close_time = isset($_POST['closeTime']) ? $obj->escape($_POST['closeTime']) : '';
    $service_type = isset($_POST['serviceType']) ? $obj->escape($_POST['serviceType']) : '';
    $type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';

    $time = json_encode([
        'open' => $open_time,
        'close' => $close_time
    ]);

    // File upload handling
    $filesJson = json_encode([]);
    $uploadDir = './uploadedimages/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'jfif', 'pjpeg', 'pjp', 'svg', 'webp'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    $uploadedFiles = [];

    if (isset($_FILES['Photo']) && !empty($_FILES['Photo']['name'][0])) {
        $fileCount = count($_FILES['Photo']['name']);

        for ($i = 0; $i < $fileCount; $i++) {
            $fileName = $_FILES['Photo']['name'][$i];
            $fileTmpName = $_FILES['Photo']['tmp_name'][$i];
            $fileError = $_FILES['Photo']['error'][$i];
            $fileSize = $_FILES['Photo']['size'][$i];

            if ($fileError === UPLOAD_ERR_OK) {
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $newFileName = time() . $bank_name . 'banks' . $i . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;

                if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $uploadedFiles[] = $newFileName;
                    } else {
                        //echo "Failed to move file: $fileName<br>";
                    }
                } else {
                    //echo "Invalid file format or file size exceeds limit.<br>";
                }
            }
        }
    } else {
        //echo "No files selected.";
    }
    $filesJson = json_encode($uploadedFiles);

    $checkBranchCode = "select * from banks where branchcode='$branch_code'";
    $chk = $obj->selectdata("banks", $checkBranchCode);

    if ($chk == "No Data Found!") {
        $selQ = "select villageid from villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];
        //echo $res[0]['villageid'];

        $query = "INSERT INTO banks (
                    villageid, bankname, email, phoneno, address, numberofatms, branchcode, operationalstatus, otherserviceinformation, servicetype, servicedescription, timeschedule,photo,type
                ) VALUES (
                    '$village_id', '$bank_name', '$email', $phone_no, '$address', $number_of_atms, '$branch_code', '$operational_status', '$other_service_information', '$service_type', '$service_description', '$time','$filesJson','$type'
                )";

        $result = $obj->insertdata("banks", $query);
        if ($result == "Data Inserted.") {
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Inserted');
                    window.location.href = 'editform.php?tablename=banks';
                    </script>";
        } else {
            echo "<script>alert('Error: Failed to insert data');</script>";
        }
    } else {

    ?>
        <script>
            alert("Branch Code must be unique");
        </script>
<?php
    }
}

if (isset($_GET['updateid'])) {

    $selQ = "select * from banks where banksid=" . $_GET['updateid'];

    $res = $obj->selectdata("banks", $selQ);
    if ($res != null) {

        $bank_name = $res[0]['bankname'];
        $email = $res[0]['email'];
        $phone_no = $res[0]['phoneno'];
        $address = $res[0]['address'];
        $number_of_atms = $res[0]['numberofatms'];
        $branch_code = $res[0]['branchcode'];
        $operational_status = $res[0]['operationalstatus'];
        $other_service_information = $res[0]['otherserviceinformation'];
        $service_type = $res[0]['servicetype'];
        $service_description = $res[0]['servicedescription'];
        $timeJson = $res[0]['timeschedule'];
        $timeArray = json_decode($timeJson, true);
        $open_time = $timeArray['open'];
        $close_time = $timeArray['close'];
        $type = $res[0]['type'];

        $photo = $res[0]['photo'];
        $data = json_decode($photo, true);
    } else {
        header('Location: banks.php');
    }
}



if (isset($_POST['update'])) {

    $bank_name = isset($_POST['bankName']) ? $obj->escape($_POST['bankName']) : '';
    $email = isset($_POST['email']) ? $obj->escape($_POST['email']) : '';
    $phone_no = isset($_POST['cNo']) ? $obj->escape($_POST['cNo']) : 0;
    $address = isset($_POST['address']) ? $obj->escape($_POST['address']) : '';
    $number_of_atms = isset($_POST['totalATM']) ? $obj->escape($_POST['totalATM']) : 0;
    $branch_code = isset($_POST['bCode']) ? $obj->escape($_POST['bCode']) : '';
    $operational_status = isset($_POST['status']) ? $obj->escape($_POST['status']) : '';
    $other_service_information = isset($_POST['serviceInfo']) ? $obj->escape($_POST['serviceInfo']) : '';
    $service_description = isset($_POST['serviceDesc']) ? $obj->escape($_POST['serviceDesc']) : '';
    $open_time = isset($_POST['openTime']) ? $obj->escape($_POST['openTime']) : '';
    $close_time = isset($_POST['closeTime']) ? $obj->escape($_POST['closeTime']) : '';
    $service_type = isset($_POST['serviceType']) ? $obj->escape($_POST['serviceType']) : '';
    $type = isset($_POST['type']) ? $obj->escape($_POST['type']) : '';

    $time = json_encode([
        'open' => $open_time,
        'close' => $close_time
    ]);

    // File upload handling
    $selQ = "select photo from banks where banksid = " . $_GET['updateid'];
    $res = $obj->selectdata("banks", $selQ);

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
                $newFileName = time() . $bank_name . 'banks' . $count + $i . '.' . $fileExtension;
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
    // else{
    //     echo "No files selected.";
    // }
    $filesJson = json_encode($uploadedFiles);

    $selQ = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selQ);
    $village_id = $res[0]['villageid'];
    //echo $res[0]['villageid'];


    $qupdate = "update banks set bankname='{$bank_name}', 
            email='{$email}',
            phoneno={$phone_no},
            address='{$address}',
            numberofatms={$number_of_atms},
            branchcode='{$branch_code}',
            operationalstatus='{$operational_status}',
            otherserviceinformation='{$other_service_information}',
            servicetype='{$service_type}',
            servicedescription='{$service_description}',
            timeschedule='{$time}',
            photo='{$filesJson}',
            type='{$type}'
    
            where banksid={$_GET['updateid']}";


    $result = $obj->updatedata("banks", $qupdate);


    if ($result == "Data Updated") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=banks';
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
    <title>Banks | Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="../images/villagelogo.png">

    <!-- All StyleSheet -->
    <link href="../vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="../vendor/owl-carousel/owl.carousel.css" rel="stylesheet">

    <!-- Globle CSS -->
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/delete_btn.css" rel="stylesheet">
    <style>
        .import-section {
            margin: 30px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .import-section h3 {
            color: #495057;
            margin-bottom: 15px;
        }

        .import-section .form-control {
            display: inline-block;
            width: auto;
            margin-right: 10px;
        }

        .template-info {
            font-size: 12px;
            color: #6c757d;
            margin-top: 10px;
        }
    </style>

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

                <form name="bankForm" action="#" method="post" enctype="multipart/form-data"
                    onsubmit="return validateBankForm()">
                    <!-- Here Edit Start -->
                    <div class="row">
                        <div class="col-xl-12 col-xxl-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Bank Details</h4>
                                </div>
                                <div class="card-body">
                                    <div class="basic-form">
                                        <form action="insertBank.php" method="post">

                                            <div class="row">
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Bank Name *</label>
                                                    <input type="text" class="form-control" name="bankName"
                                                        value="<?php echo $bank_name ?>" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Type </label>
                                                    <div class="mt-1">

                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="bank" checked
                                                                <?php if ($type == 'bank') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Bank</label>
                                                        <label class="radio-inline me-3"><input type="radio" name="type"
                                                                class="form-check-input" value="atm"
                                                                <?php if ($type == 'atm') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            ATM</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Email *</label>
                                                    <input type="email" class="form-control" name="email"
                                                        value="<?php echo $email ?>" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Bank contact No *</label>
                                                    <input type="text" class="form-control" name="cNo"
                                                        value="<?php echo $phone_no; ?>" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Address *</label>
                                                    <input type="text" class="form-control" name="address"
                                                        value="<?php echo $address ?>" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Branch code *</label>
                                                    <input type="text" class="form-control" name="bCode"
                                                        value="<?php echo $branch_code ?>" required>
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> No of ATMs *</label>
                                                    <input type="number" class="form-control" name="totalATM"
                                                        value="<?php echo $number_of_atms ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="mt-1">Operational Status</label>
                                                    <div class="mt-1">

                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="status" class="form-check-input" value="Open"
                                                                checked
                                                                <?php if ($operational_status == 'Open') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Open</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="status" class="form-check-input"
                                                                value="Under Renovation"
                                                                <?php if ($operational_status == 'Under Renovation') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Under Renovation</label>
                                                        <label class="radio-inline me-3"><input type="radio"
                                                                name="status" class="form-check-input" value="Closed"
                                                                <?php if ($operational_status == 'Closed') {
                                                                    echo 'checked';
                                                                } ?>>
                                                            Closed</label>
                                                    </div>
                                                </div>

                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Opening Time</label>
                                                    <input type="time" class="form-control" name="openTime"
                                                        value="<?php echo $open_time ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label">Closing Time</label>
                                                    <input type="time" class="form-control" name="closeTime"
                                                        value="<?php echo $close_time ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Other Service Information</label>
                                                    <input type="text" class="form-control" name="serviceInfo"
                                                        value="<?php echo $other_service_information ?>"
                                                        placeholder="Services if any or none">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Service Type</label>
                                                    <input type="text" class="form-control" name="serviceType"
                                                        value="<?php echo $service_type ?>"
                                                        placeholder="Types if any or none">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label"> Service Description</label>
                                                    <input type="text" class="form-control" name="serviceDesc"
                                                        value="<?php echo $service_description ?>"
                                                        placeholder="Desc if any or none">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="text-label form-label"> Add Image </label>
                                                <div class="mb-3">
                                                    <input class="form-control" type="file" name="Photo[]" id="photo"
                                                        multiple>
                                                    <?php if (isset($_GET['updateid'])) { ?>
                                                        <div class="col-xl-6">
                                                            <div class="card">
                                                                <div class="card-body p-4">
                                                                    <h4 class="card-intro-title">Slides only
                                                                    </h4>
                                                                    <div id="carouselExampleIndicators"
                                                                        class="carousel slide" data-bs-ride="carousel">
                                                                        <div class="carousel-indicators">

                                                                            <?php

                                                                            foreach ($data as $index => $person) { ?>
                                                                                <button type="button"
                                                                                    data-bs-target="#carouselExampleIndicators"
                                                                                    data-bs-slide-to="<?php echo $index; ?>"
                                                                                    <?php if ($index == 0) { ?> class="active"
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
                                                                        <button class="carousel-control-prev" type="button"
                                                                            data-bs-target="#carouselExampleIndicators"
                                                                            data-bs-slide="prev">
                                                                            <span class="carousel-control-prev-icon"
                                                                                aria-hidden="true"></span>
                                                                            <span>Previous</span>
                                                                        </button>

                                                                        <!-- Next Button -->
                                                                        <button class="carousel-control-next" type="button"
                                                                            data-bs-target="#carouselExampleIndicators"
                                                                            data-bs-slide="next">
                                                                            <span class="carousel-control-next-icon"
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
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Here Edit End -->

                    </div>
                </form>
               


                <!-- Import Section -->
                <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;">
                    <h4>📊 Bulk Import Banks</h4>
                    <p class="text-muted mb-3">
                        <strong>How it works:</strong> Download the template, fill in the data, and import.
                        <!-- <strong>Village ID is automatically assigned</strong> - you don't need to fill it. -->
                    </p>

                    <div class="row align-items-center g-3">
                        <div class="col-md-4">
                            <a href="templates/banks_template.php" class="btn btn-info w-100">
                                📥 Download Template
                            </a>
                        </div>
                        <div class="col-md-8">
                            <form action="imports/import_banks.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
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
                            <strong>💡 Required fields:</strong> Bank Name, Branch Code<br>
                            <strong>📝 Optional fields:</strong> Email, Phone, Address, etc.<br>
                            <strong>⚠️ Notes:</strong>
                            Photos will be empty (add later via edit form),
                            Time format: <code>{"open":"09:00","close":"17:00"}</code>
                        </small>
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

                <?php include('../footer.php'); ?>
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
            function validateBankForm() {

                // Bank Name validation
                let bankName = document.forms["bankForm"]["bankName"].value;
                if (bankName === "") {
                    alert("Bank Name must be filled out");
                    return false;
                }
                if (bankName.trim().length > 20) {
                    alert("Bank Name must be less than 20 characters long");
                    return false;
                }


                // Address validation
                let address = document.forms["bankForm"]["address"].value;
                let addressPattern = /^[a-zA-Z0-9\s,.-]{5,}$/;
                if (address === "" || !addressPattern.test(address)) {
                    alert("Minimum 5 characters, only letters, numbers, spaces, commas, periods, and dashes");
                    return false;
                }


                // Contact Number validation (should be a 10-digit number)
                // let contactNo = document.forms["bankForm"]["phoneno"].value;
                // const contactNoRegex = /^[0-9]{10}$/;
                // if (!contactNoRegex.test(contactNo)) {
                //     alert("Please enter a valid 10-digit contact number");
                //     return false;
                // }


                // Validate Time Duration
                let timeOpen = document.forms["bankForm"]["openTime"].value;
                let timeClose = document.forms["bankForm"]["closeTime"].value;
                if (timeOpen == "" || timeClose == "") {
                    alert("Please select both opening and closing times");
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
                        const tableName = "banks";
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