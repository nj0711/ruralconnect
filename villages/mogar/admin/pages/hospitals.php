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

    $name = "";
    $address = "";
    $city = "";
    $pincode = "";
    $type = "";
    $time_schedule_open="";
    $time_schedule_close="";
    // $photos = "";
    $doctors = "";
    $patient_capacity = "";
    $health_statistics = "";
    $fullAddress = "";
    $contact_no = "";
    $description = "";
    
    
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
    window.location.href = "editform.php?tablename=hospitals";
}
</script>

<?php
        }
        
        // After confirmation, handle the deletion process using 'confirmeddeleteid'
        if (isset($_GET['confirmeddeleteid'])) {
            $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID
        
            // Perform the deletion logic here
            $sel = "select * from hospitals where hospitalsid=" . $deleteId;
            $res = $obj->selectdata("hospitals", $sel);
        
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
            $del = "DELETE FROM hospitals WHERE hospitalsid=" . $deleteId;
            $result = $obj->deletedata("hospitals", $del);
        
            // Handle success or failure
            if ($result == "Data Deleted") {
                echo "<script>alert('Success! Data Deleted');
                window.location.href = 'editform.php?tablename=hospitals';
                </script>";
            } else {
                echo "<script>alert('Error: Failed to delete data');</script>";
            }
        }
    

	if (isset($_POST['insert'])) {

        $name = isset($_POST['Name']) ? $obj->escape($_POST['Name']) : "";
        $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
        $city = isset($_POST['City']) ? $obj->escape($_POST['City']) : "";
        $pincode = isset($_POST['Zip']) ? $obj->escape($_POST['Zip']) : "";
        $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : "";
        $time_schedule_open = isset($_POST['TimeDurationOpen']) ? $obj->escape($_POST['TimeDurationOpen']) : "";
        $time_schedule_close = isset($_POST['TimeDurationClose']) ? $obj->escape($_POST['TimeDurationClose']) : "";
        
        $patient_capacity = isset($_POST['PatientCapacity']) ? $obj->escape($_POST['PatientCapacity']) : "";
        $health_statistics = isset($_POST['HealthStatistics']) ? $obj->escape($_POST['HealthStatistics']) : "";
        $fullAddress = $address . '@' . $city . '@' . $pincode;
        $type = isset($_POST['type']) ? $obj->escape($_POST['type']) : "";
        $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
        
        // Combine doctor names and specialties
        
        // Time schedule as JSON
        $time = json_encode([
            'open' => $time_schedule_open,
            'close' => $time_schedule_close
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

        if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'][0])) {
            $fileCount = count($_FILES['photo']['name']);

            for ($i = 0; $i < $fileCount; $i++) {
                $fileName = $_FILES['photo']['name'][$i];
                $fileTmpName = $_FILES['photo']['tmp_name'][$i];
                $fileError = $_FILES['photo']['error'][$i];
                $fileSize = $_FILES['photo']['size'][$i];

                if ($fileError === UPLOAD_ERR_OK) {
                    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $newFileName = time().$name . 'hospital' . $i . '.' . $fileExtension;
                    $destination = $uploadDir . $newFileName;

                    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                        if (move_uploaded_file($fileTmpName, $destination)) {
                            $uploadedFiles[] = $newFileName;
                        } else {
                            // echo "Failed to move file: $fileName<br>";
                        }
                    } else {
                        // echo "Invalid file format or file size exceeds limit.<br>";
                    }
                }
            }
        } //else {
        //     echo "No files selected.";
        // }
        $filesJson = json_encode($uploadedFiles);

        // Fetch village id
        $selQ = "SELECT villageid FROM villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];

        // Inserting into the hospitals table
        $query = "INSERT INTO hospitals (villageid, type, name, photo, address, contactno, timeduration, patientcapacity, description) 
                  VALUES ('$village_id', '$type', '$name', '$filesJson', '$fullAddress', '$contact_no', '$time', '$patient_capacity', '$description')";
        
        $result = $obj->insertdata("hospitals", $query);
        if($result =="Data Inserted."){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Inserted');
            window.location.href = 'editform.php?tablename=hospitals';
            </script>";
            
        }else{
            echo "<script>alert('Error: Failed to insert data');</script>";
        }
	}

    if(isset($_GET['updateid'])){
        $selQ = "select * from hospitals where hospitalsid=" . $_GET['updateid'];

        $res = $obj->selectdata("hospitals", $selQ);
        if ($res != null) {
            $name = $res[0]['name'];            
            $fullAddress = array_map('trim', explode('@', $res[0]['address']));
            $address = $fullAddress[0];
            $city =  $fullAddress[1];
            $pincode =  $fullAddress[2];

            $type=$res[0]['type'];

            $time=json_decode($res[0]["timeduration"]);    
            $time_schedule_open=$time->open;
            $time_schedule_close=$time->close;

            
            
            $patient_capacity = $res[0]['patientcapacity'];                        
            $contact_no = $res[0]['contactno'];
            $description = $res[0]['description'];

            $photo = $res[0]['photo'];
            $data = json_decode($photo, true);
        } else {
            header('Location: hotels.php');
        }
    }

    if(isset($_POST['update'])){
        $name = isset($_POST['Name']) ? $obj->escape($_POST['Name']) : "";
        $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
        $city = isset($_POST['City']) ? $obj->escape($_POST['City']) : "";
        $pincode = isset($_POST['Zip']) ? $obj->escape($_POST['Zip']) : "";
        $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : "";
        $time_schedule_open = isset($_POST['TimeDurationOpen']) ? $obj->escape($_POST['TimeDurationOpen']) : "";
        $time_schedule_close = isset($_POST['TimeDurationClose']) ? $obj->escape($_POST['TimeDurationClose']) : "";
        
        $patient_capacity = isset($_POST['PatientCapacity']) ? $obj->escape($_POST['PatientCapacity']) : "";
        $health_statistics = isset($_POST['HealthStatistics']) ? $obj->escape($_POST['HealthStatistics']) : "";
        $fullAddress = $address . '@' . $city . '@' . $pincode;
        $type = isset($_POST['type']) ? $obj->escape($_POST['type']) : "";
        $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
        
        // Combine doctor names and specialties
        
        // Time schedule as JSON
        $time = json_encode([
            'open' => $time_schedule_open,
            'close' => $time_schedule_close
        ]);

        // File upload handling
        $selQ = "select photo from hospitals  where hospitalsid  = " . $_GET['updateid'];
        $res = $obj->selectdata("hospitals", $selQ);
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
                    $newFileName = time().$name . 'hospitals' . $count + $i . '.' . $fileExtension; //echo
                    $destination = $uploadDir . $newFileName;
                    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                        if (move_uploaded_file($fileTmpName, $destination)) {
                            // Store the filename in the array
                            $uploadedFiles[] = $newFileName;
                        } else {
                            // echo "Failed to move file: $fileName<br>";
                        }
                    } else {
                        // echo "File Formate or Size is invalid";
                    }
                }
            }
        } //else {
        //     echo "No files selected.";
        // }
        $filesJson = json_encode($uploadedFiles);  //echo
        // Fetch village id
        $selQ = "SELECT villageid FROM villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];

        "INSERT INTO hospitals (villageid, type, name, photo, address, contactno, timeduration, patientcapacity, description) 
                  VALUES ('$village_id', '$type', '$name', '$filesJson', '$fullAddress', '$contact_no', '$time', '$patient_capacity', '$description')";

        $qupdate="UPDATE hospitals SET type='$type',name='$name',photo='$filesJson',address='$fullAddress',
        contactno='$contact_no',timeduration='$time',patientcapacity='$patient_capacity',description='$description' WHERE hospitalsid=".$_GET['updateid'];
        $result =$obj->updatedata("hospitals",$qupdate);
        if($result =="Data Updated"){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=hospitals';
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
    <title> Hospitals | Admin Panel</title>

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
                                <h4 class="card-title">Hospital</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form name="hospitalForm" method="post" action="#" enctype="multipart/form-data"
                                        onsubmit="return validateForm()">

                                        <div class="row">
                                            <div class="col-lg-12  col-xxl-12">
                                                <!-- <div class="card"> -->

                                                <!-- <div class="card-body"> -->
                                                <div class="tab-content">
                                                    <div class="row">


                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Name </label>
                                                                <input type="text" name="Name" class="form-control"
                                                                    value="<?php echo $name ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="mt-1"> Type</label>
                                                                <div class="mt-1">
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="type" class="form-check-input"
                                                                            id="showDivRadio" onclick="toggleTextBox()"
                                                                            value="Hospital" required
                                                                            <?php if ($type == 'Hospital') {echo 'checked';} ?>>
                                                                        Hospital</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="type" class="form-check-input"
                                                                            onclick="toggleTextBox()"
                                                                            value="Medical Shop"
                                                                            <?php if ($type == 'Medical Shop') {echo 'checked';} ?>>
                                                                        Medical Shop</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="type" class="form-check-input"
                                                                            onclick="toggleTextBox()"
                                                                            value="Care Center"
                                                                            <?php if ($type == 'Care Center') {echo 'checked';} ?>>
                                                                        Care Center</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Address</label>
                                                                <textarea class="form-control"
                                                                    name="Address"><?php echo $address ?></textarea>
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
                                                                                    name="City">
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
                                                                                    name="Zip">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
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
                                                            <div class="mb-3">
                                                                <label
                                                                    class="text-label form-label">PatientCapacity</label>
                                                                <input type="text" name="PatientCapacity"
                                                                    class="form-control"
                                                                    value="<?php echo $patient_capacity; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-4">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label"> Contact
                                                                    No.</label>
                                                                <input type="text" name="ContactNo" class="form-control"
                                                                    value="<?php echo $contact_no ?>" required>

                                                            </div>

                                                            <div class="col-lg-12 mb-4 ">

                                                                <div class="mb-3">
                                                                    <label class="text-label form-label">Other
                                                                        Information</label>
                                                                    <textarea name="description"
                                                                        class="form-control solid" rows="5"
                                                                        aria-label="With textarea"><?php echo $description;?></textarea>
                                                                </div>
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
                                                                                            if(count($data)>1){?>
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
    function validateForm() {

        // Name validation
        let name = document.forms["hospitalForm"]["Name"].value;
        if (name == "") {
            alert("Name must be filled out");
            return false;
        }
        if (name.trim().length > 20) {
            alert("Name must be less than 20 characters long");
            return false;
        }

        // Type validation (ensure one radio button is selected)
        let type = document.forms["hospitalForm"]["type"].value;
        if (type == "") {
            alert("Type must be selected");
            return false;
        }

        // Address validation
        let address = document.forms["hospitalForm"]["Address"].value;
        let addressPattern = /^[a-zA-Z0-9\s,.-]{5,}$/;
        if (address == "" || !addressPattern.test(address)) {
            alert("Minimum 5 characters, only letters, numbers, spaces, commas, periods, and dashes");
            return false;
        }

        // City validation
        let city = document.forms["hospitalForm"]["City"].value;
        if (city == "") {
            alert("City must be filled out");
            return false;
        }
        if (city.trim().length > 20) {
            alert("City must be less than 20 characters long");
            return false;
        }

        // Pincode validation (should be a 6-digit number)
        let pincode = document.forms["hospitalForm"]["Zip"].value;
        const pincodeRegex = /^[1-9][0-9]{5}$/;
        if (!pincodeRegex.test(pincode)) {
            alert("Please enter a valid 6-digit pincode");
            return false;
        }

        // Patient capacity validation
        let patientCapacity = document.forms["hospitalForm"]["PatientCapacity"].value;
        if (isNaN(patientCapacity)) {
            alert("Please enter a valid patient capacity");
            return false;
        }
        // Validate Time Duration
        let timeOpen = document.forms["hospitalForm"]["TimeDurationOpen"].value;
        let timeClose = document.forms["hospitalForm"]["TimeDurationClose"].value;
        if (timeOpen == "" || timeClose == "") {
            alert("Please select both opening and closing times");
            return false;
        }

        // Contact number validation (should be 10 digits)
        // let contactNo = document.forms["hospitalForm"]["ContactNo"].value;
        //     let contactPattern = /^[6-9]\d{9}$/;
        //     if (!contactPattern.test(contactNo)) {
        //         alert("Please enter a valid contact number (10 digits starting with 6-9)");
        //         return false;
        //     }
        // Validate Other Information
        let description = document.forms["hospitalForm"]["description"].value;
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
                const tableName = "hospitals";
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