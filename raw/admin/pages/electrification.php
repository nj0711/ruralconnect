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
    $econtact='';
    $solar=0;
    $wind=0;
    $coal=0;
    $gas=0;
    $address = "";
    $city = "";
    $pincode = "";
    $fullAddress = $address . '@' . $city . '@' . $pincode;
    $servicearea='';
    $contactno='';
    $email='';
    $supplychain='';

    $description = "";
    $photos = "";
    
    $contactno = "";


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
    window.location.href = "editform.php?tablename=electrification";
}
</script>

<?php
    }
    
    // After confirmation, handle the deletion process using 'confirmeddeleteid'
    if (isset($_GET['confirmeddeleteid'])) {
        $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID
    
        // Perform the deletion logic here
        $sel = "select * from electrification where electrificationid=" . $deleteId;
        $res = $obj->selectdata("electrification", $sel);
    
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
        $del = "DELETE FROM electrification WHERE electrificationid=" . $deleteId;
        $result = $obj->deletedata("electrification", $del);
    
        // Handle success or failure
        if ($result == "Data Deleted") {
            echo "<script>alert('Success! Data Deleted');
            window.location.href = 'editform.php?tablename=electrification';
            </script>";
        } else {
            echo "<script>alert('Error: Failed to delete data');</script>";
        }
    }
    
    

    if (isset($_POST['insert'])) {

        $name = isset($_POST['name']) ? $obj->escape($_POST['name']) : "";
        $econtact=isset($_POST['econtact']) ? $obj->escape($_POST['econtact']) : "";
        $solar=isset($_POST['solar']) ? $obj->escape($_POST['solar']) : "";
        $wind=isset($_POST['wind']) ? $obj->escape($_POST['wind']) : "";
        $coal=isset($_POST['coal']) ? $obj->escape($_POST['coal']) : "";
        $gas=isset($_POST['gas']) ? $obj->escape($_POST['gas']) : "";
        $address = isset($_POST['address']) ? $obj->escape($_POST['address']) : "";
        $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : "";
        $pincode = isset($_POST['pincode']) ? $obj->escape($_POST['pincode']) : "";
        $fullAddress = $address . '@' . $city . '@' . $pincode;
        $servicearea=isset($_POST['servicearea']) ? $obj->escape($_POST['servicearea']) : "";
        $contactno=isset($_POST['contactno']) ? $obj->escape($_POST['contactno']) : "";
        $email=isset($_POST['email']) ? $obj->escape($_POST['email']) : "";
        $supplychain=isset($_POST['supplychain']) ? $obj->escape($_POST['supplychain']) : "";
        $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
        $contactno = isset($_POST['contactno']) ? $obj->escape($_POST['contactno']) : "";    




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
                    $newFileName = time().$name . 'electrification' . $i . '.' . $fileExtension;
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
        } else {
            // echo "No files selected.";
        }
        $filesJson = json_encode($uploadedFiles);

        $selQ = "select villageid from villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];
        $res[0]['villageid'];

        $query="INSERT INTO electrification(companyname, emergencycontactno, energyresourcessolar, energyresourceswind, energyresourcescoal,energyresourcesgas, photo, 
        officeaddress, servicearea, contactno, email, supplychain, villageid, description) 
        VALUES ('$name','$econtact','$solar','$wind','$coal','$gas','$filesJson','$fullAddress','$servicearea',
        '$contactno','$email','$supplychain','$village_id','$description')";
        // echo $query;
        $result = $obj->insertdata("electrification", $query);

        if($result =="Data Inserted."){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Inserted');
            window.location.href = 'editform.php?tablename=electrification';
            </script>";
            
        }else{
            echo "<script>alert('Error: Failed to insert data');</script>";
        }
    }

    if (isset($_GET['updateid'])) {

        $selQ = "select * from electrification where electrificationid=" . $_GET['updateid'];

        $res = $obj->selectdata("electrification", $selQ);
        if ($res != null) {
        $name = $res[0]['companyname'];
        $solar= $res[0]['energyresourcessolar'];
        $wind= $res[0]['energyresourceswind'];
        $coal= $res[0]['energyresourcescoal'];
        $gas= $res[0]['energyresourcesgas'];
        $fullAddress = array_map('trim', explode('@', $res[0]['officeaddress']));
            $address = $fullAddress[0];
            $city =  $fullAddress[1];
            $pincode =  $fullAddress[2];

        $servicearea= $res[0]['servicearea'];
        $contactno= $res[0]['contactno'];
        $email= $res[0]['email'];
        $supplychain= $res[0]['supplychain'];
        $description =  $res[0]['description'];
        $econtact=$res[0]['emergencycontactno'];
        
        $photo = $res[0]['photo'];
        $data = json_decode($photo, true);
        } else {
            header('Location: electrification.php');
        }
    }

    if (isset($_POST['update'])) {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        $name = isset($_POST['name']) ? $obj->escape($_POST['name']) : "";
        $solar=isset($_POST['solar']) ? $obj->escape($_POST['solar']) : "";
        $wind=isset($_POST['wind']) ? $obj->escape($_POST['wind']) : "";
        $coal=isset($_POST['coal']) ? $obj->escape($_POST['coal']) : "";
        $gas=isset($_POST['gas']) ? $obj->escape($_POST['gas']) : "";
        $address = isset($_POST['address']) ? $obj->escape($_POST['address']) : "";
        $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : "";
        $pincode = isset($_POST['pincode']) ? $obj->escape($_POST['pincode']) : "";
        $fullAddress = $address . '@' . $city . '@' . $pincode;
        $servicearea=isset($_POST['servicearea']) ? $obj->escape($_POST['servicearea']) : "";
        $contactno=isset($_POST['contactno']) ? $obj->escape($_POST['contactno']) : "";
        $email=isset($_POST['email']) ? $obj->escape($_POST['email']) : "";
        $supplychain=isset($_POST['supplychain']) ? $obj->escape($_POST['supplychain']) : "";
        $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
        $contactno = isset($_POST['contactno']) ? $obj->escape($_POST['contactno']) : "";    
        $econtact=isset($_POST['econtact']) ? $obj->escape($_POST['econtact']) : "";



        $selQ = "select photo from electrification  where electrificationid  = " . $_GET['updateid'];
        $res = $obj->selectdata("electrification", $selQ);
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
                     $newFileName =  time().$name . 'electrification' . $count + $i . '.' . $fileExtension;
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
        } else {
            // echo "No files selected.";
        }
        $filesJson = json_encode($uploadedFiles);

        $selQ = "select villageid from villagebasic";
        $res = $obj->selectdata("villagebasic", $selQ);
        $village_id = $res[0]['villageid'];
        $res[0]['villageid'];


        $qupdate = "UPDATE electrification SET companyname='$name',emergencycontactno='$econtact',
        energyresourcessolar='$solar',energyresourceswind='$wind',
        energyresourcescoal='$coal',energyresourcesgas='$gas',
        photo='$filesJson',officeaddress='$fullAddress',servicearea='$servicearea',
        contactno='$contactno',email='$email',
        supplychain='$supplychain',description='$description' WHERE electrificationid=".$_GET['updateid'];


        $result = $obj->updatedata("electrification", $qupdate);
        if($result =="Data Updated"){
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=electrification';
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
    <title> Electrification | Admin Panel</title>

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
                                <h4 class="card-title">Electrification</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form name="electrificationForm" method="post" action="#"
                                        enctype="multipart/form-data" onsubmit="return validateForm()">
                                        <div class="row">
                                            <div class="col-lg-12  col-xxl-12">
                                                <div class="tab-content">
                                                    <div class="row">
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Name</label>
                                                                <input type="text" name="name"
                                                                    value="<?php echo $name ?>" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Emergency Contact
                                                                    No </label>
                                                                <input type="text" name="econtact"
                                                                    value="<?php echo $econtact ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="text-label form-label">EnergyResourcesSolar</label>
                                                                <input type='text' name='solar'
                                                                    value='<?php echo $solar; ?>'
                                                                    class="form-control" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label
                                                                    class="text-label form-label">EnergyResourcesWind</label>
                                                                <input type='text' name='wind'
                                                                    value='<?php echo $wind; ?>' class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label
                                                                    class="text-label form-label">EnergyResourcesCoal</label>
                                                                <input type='text' name='coal'
                                                                    value='<?php echo $coal; ?>' class="form-control" />
                                                            </div>
                                                            <div class="mb-3">
                                                                <label
                                                                    class="text-label form-label">EnergyResourcesGas</label>
                                                                <input type='text' name='gas'
                                                                    value='<?php echo $gas; ?>' class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Address</label>
                                                                <textarea class="form-control"
                                                                    name="address"><?php echo $address; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">city</label>
                                                                <input type="text" name="city"
                                                                    value="<?php if($city!=''){echo $city;}else{echo 'Anand';} ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Pincode</label>
                                                                <input type="text" name="pincode"
                                                                    value="<?php echo $pincode; ?>"
                                                                    class="form-control">
                                                            </div>
                                                        </div>




                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Email</label>
                                                                <input type='email' name='email'
                                                                    value='<?php echo $email; ?>'
                                                                    class="form-control" />
                                                            </div>

                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">ContactNo</label>
                                                                <input type='text' name='contactno'
                                                                    value='<?php echo $contactno; ?>'
                                                                    class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Service
                                                                    Area</label>
                                                                <textarea class="form-control"
                                                                    name="servicearea"><?php echo $servicearea; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Supply
                                                                    Chain</label>
                                                                <textarea class="form-control"
                                                                    name="supplychain"><?php echo $supplychain; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Description</label>
                                                                <textarea class="form-control"
                                                                    name="description"><?php echo $description; ?></textarea>
                                                            </div>

                                                        </div>



                                                        <div class="mb-3">
                                                            <label class="text-label form-label"> Add Image </label>
                                                            <div class="mb-3">
                                                                <input class="form-control" type="file" name="Photo[]"
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
            <!--**********************************
            Footer end
        ***********************************-->






    </div>



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
        // Validate  Name
        let Name = document.forms["electrificationForm"]["name"].value;
        if (Name == "") {
            alert("Name must be filled out");
            return false;
        }
        if (Name.trim().length > 20) {
            alert("Name must be less than 20 characters long");
            return false;
        }
        // Validate Emergency Contact (must be a 10-digit number)
        // let econtact = document.forms["electrificationForm"]['econtact'].value;
        // let econtactPattern = /^[0-9]{10}$/;
        // if (!econtactPattern.test(econtact)) {
        //     alert("Please enter a valid contact number (10 digits starting with 6-9)");
        //     return false;
        // }
        // Validate Solar Energy (must be a non-negative number)
        let solar = document.forms["electrificationForm"]['solar'].value;
        if (solar < 0) {
            alert("Please enter a positive numbers for Solar Energy ");
            return false;
        }
        // Validate Wind Energy (must be a non-negative number)
        const wind = document.forms["electrificationForm"]['wind'].value;
        if (wind < 0) {
            alert("Please enter a positive numbers for Wind Energy ");
            return false;
        }
        // Validate Coal Energy (must be a non-negative number)
        const coal = document.forms["electrificationForm"]['coal'].value;
        if (coal < 0) {
            alert("Please enter a positive numbers for Coal Energy ");
            return false;
        }
        // Validate Gas Energy (must be a non-negative number)
        const gas = document.forms["electrificationForm"]['gas'].value;
        if (gas < 0) {
            alert("Please enter a positive numbers for Gas Energy ");
            return false;
        }
        // Validate Address
        let address = document.forms["electrificationForm"]["address"].value;
        let addressPattern = /^[a-zA-Z0-9\s,.-]{5,}$/;
        if (address == "" || !addressPattern.test(address)) {
            alert("Minimum 5 characters, only letters, numbers, spaces, commas, periods, and dashes");
            return false;
        }

        // Validate City
        let city = document.forms["electrificationForm"]["city"].value;
        if (city == "") {
            alert("City must be filled out");
            return false;
        }
        if (city.trim().length > 20) {
            alert("City must be less than 20 characters long");
            return false;
        }
        // Validate Pin Code
        let pincode = document.forms["electrificationForm"]["pincode"].value;
        let pincodeRegex = /^[1-9][0-9]{5}$/;
        if (pincode == "" || !pincodeRegex.test(pincode)) {
            alert("Please enter a valid Pin Code");
            return false;
        }
        // Validate Email (must follow email format)
        const email = document.forms["electrificationForm"]["email"].value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Enter valid email");
            return false;
        }
        // Validate Contact No.
        //  let contactNo = document.forms["electrificationForm"]["contactno"].value;
        // let contactPattern = /^[6-9]\d{9}$/;
        // if (!contactPattern.test(contactNo)) {
        //     alert("Please enter a valid contact number (10 digits starting with 6-9)");
        //     return false;
        // }
        // Validate service area Name
        let service = document.forms["electrificationForm"]["servicearea"].value;
        if (service.trim() == "") {
            alert("Service Area name must be filled out");
            return false;
        }
        // Validate supply chain
        let supplyChain = document.forms["electrificationForm"]["supplychain"].value;
        if (supplyChain.trim() == "") {
            alert("Supply Chain name must be filled out");
            return false;
        }
        // Validate Other Information
        let description = document.forms["electrificationForm"]["description"].value;
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
                const tableName = "electrification";
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