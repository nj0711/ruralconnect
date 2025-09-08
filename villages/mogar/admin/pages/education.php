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
    $zip = "";
    $description = "";
    $facility = "";
    $photo = "";
    $fullAddress = $address . '@ ' . $city . '@ ' . $zip;
    $contact_no = "";
    $email = "";
    $type="";



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
    window.location.href = "editform.php?tablename=education";
}
</script>

<?php
   }
   
   // After confirmation, handle the deletion process using 'confirmeddeleteid'
   if (isset($_GET['confirmeddeleteid'])) {
       $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID
   
       // Perform the deletion logic here
       $sel = "select * from education where educationid=" . $deleteId;
       $res = $obj->selectdata("education", $sel);
   
       $p = $res[0]['photo'];
       $array = json_decode($p, true);  // Decode the JSON into an array
   
       // Directory for uploaded images
       $uploadDir = './uploadedimages/'; 
       foreach ($array as $image) {
           $filePath = $uploadDir . $image;  // Full path to the image
           if (file_exists($filePath)) {  // Check if the file exists
               if (unlink($filePath)) {  // Attempt to delete the file
                //    echo "Deleted: $image<br>";
               } else {
                //    echo "Failed to delete: $image<br>";
               }
           } else {
            //    echo "File does not exist: $image<br>";
           }
       }
   
       // Delete the record from the database
       $del = "DELETE FROM education WHERE educationid=" . $deleteId;
       $result = $obj->deletedata("education", $del);
   
       // Handle success or failure
       if ($result == "Data Deleted") {
           echo "<script>alert('Success! Data Deleted');
           window.location.href = 'editform.php?tablename=education';
           </script>";
       } else {
           echo "<script>alert('Error: Failed to delete data');</script>";
       }
   }
   

    if (isset($_POST['insert'])) {

        $name = isset($_POST['name']) ? $obj->escape($_POST['name']) : "";
        $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
        $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : "";
        $zip = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : "";
        $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : "";
        $email = isset($_POST['email'])? $obj -> escape($_POST['email']) : "";
        $facility = isset($_POST['facility'])? $obj -> escape($_POST['facility']) : "";
        $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
        $fullAddress = $address . '@' . $city . '@' . $zip;
        $type=isset($_POST['type']) ? $obj->escape($_POST['type']) : "";


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
                    $newFileName = time().$name . 'education' . $i . '.' . $fileExtension;
                    $destination = $uploadDir . $newFileName;

                    if (in_array($fileExtension, $allowedExtensions) && $fileSize <= $maxFileSize) {
                        if (move_uploaded_file($fileTmpName, $destination)) {
                            $uploadedFiles[] = $newFileName;
                        } else {?>
<script>
alert('Failed to move file');
</script>
<?php }
                    } else {?>
<script>
alert('Invalid file format or file size exceeds limit 5MB.');
</script>
<?php }
                }
            }
        } else {
            // echo "No files selected.";
        }
        if($filesJson==null){
            ?>
<script>
alert('Please select at least one image');
</script>
<?php
        }else{
            $filesJson = json_encode($uploadedFiles);


            $selQ = "select villageid from villagebasic";
            $res = $obj->selectdata("villagebasic", $selQ);
            $village_id = $res[0]['villageid'];
            $res[0]['villageid'];
    
            $query="INSERT INTO education (
               villageid, name, address, facilityavailable, photo, contactno, emailiD, description,type
               ) VALUES (
              '$village_id','$name', ' $fullAddress', '$facility', '$filesJson', '$contact_no','$email', '$description','$type'
               );";
            $result= $obj->insertdata("education", $query);
            if($result =="Data Inserted."){
                // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                echo "<script>alert('Success! Data Inserted');
                window.location.href = 'editform.php?tablename=education';
                </script>";
                
            }else{
                echo "<script>alert('Error: Failed to insert data');</script>";
            }
        }
        
    }

    if (isset($_GET['updateid'])) {

        $selQ = "select * from education where educationid=" . $_GET['updateid'];
        $res = $obj->selectdata("education", $selQ);
        if ($res != null) {

            $name = $res[0]['name'];
            $fullAddress = array_map('trim', explode('@', $res[0]['address']));
            // print_r($fullAddress);
            $address = $fullAddress[0];
            $city = $fullAddress[1];
            $zip = $fullAddress[2];
            $description = $res[0]['description'];
            $facility = $res[0]['facilityavailable'];
            $photo = $res[0]['photo'];
            $data = json_decode($photo, true);
            $contact_no = $res[0]['contactno'];
            $email = $res[0]['emailid'];
            $type=$res[0]['type'];
        } else {
            header('Location: education.php');
        }
    }

    if (isset($_POST['update'])) {
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        
        $name = isset($_POST['name']) ? $obj->escape($_POST['name']) : "";
        $address = isset($_POST['Address']) ? $obj->escape($_POST['Address']) : '';
        $city = isset($_POST['city']) ? $obj->escape($_POST['city']) : "";
        $zip = isset($_POST['zip']) ? $obj->escape($_POST['zip']) : "";
        $contact_no = isset($_POST['ContactNo']) ? $obj->escape($_POST['ContactNo']) : "";
        $email = isset($_POST['email'])? $obj -> escape($_POST['email']) : "";
        $facility = isset($_POST['facility'])? $obj -> escape($_POST['facility']) : "";
        $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : "";
        $fullAddress = $address . '@ ' . $city . '@ ' . $zip;
        $type=isset($_POST['type']) ? $obj->escape($_POST['type']) : "";
        $selQ = "select photo from education  where educationid  = " . $_GET['updateid'];
        $res = $obj->selectdata("education", $selQ);
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
                     $newFileName =  time().$name . 'education' . $count + $i . '.' . $fileExtension;
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
        
        if($filesJson==null){
            ?>
<script>
alert('Please select at least one image');
</script>
<?php
        }else{
            $filesJson = json_encode($uploadedFiles);
        
            $qupdate = "update education set name='{$name}', address='{$fullAddress}', facilityavailable='{$facility}', photo='{$filesJson}', contactno='{$contact_no}', EmailID='{$email}', Description='{$description}',type='{$type}'
                        where educationid ={$_GET['updateid']}";
                        
    
            $result = $obj->updatedata("education", $qupdate);
            if($result =="Data Updated"){
                // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
                echo "<script>alert('Success! Data Updated');
                window.location.href = 'editform.php?tablename=education';
                </script>";
                
            }else{
                echo "<script>alert('Error: Failed to update data');</script>";
            }
    
        }
        
        // header('Location: education.php?updateid=' . $_GET['updateid']);
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
    <title> Education | Admin Panel</title>

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
                                <h4 class="card-title">Education</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="#" enctype="multipart/form-data"
                                        onsubmit="return validateForm()">
                                        <div class="row">
                                            <div class="col-lg-12  col-xxl-12">
                                                <div class="tab-content">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Name *</label>
                                                                <input type="text" name="name" id='name'
                                                                    value="<?php echo $name ?>" class="form-control"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-3 mt-3">
                                                            <label class="form-label"> Type </label>
                                                            <div class="mt-1">

                                                                <label class="radio-inline me-3"><input type="radio"
                                                                        name="type" class="form-check-input"
                                                                        value="scl" checked
                                                                        <?php if ($type == 'scl') {echo 'checked';} ?>>  School</label>
                                                                <label class="radio-inline me-3"><input type="radio"
                                                                        name="type" class="form-check-input" value="clg"
                                                                        <?php if ($type == 'clg') {echo 'checked';} ?>>  College</label>
                                                            </div>
                                                        </div>
                                                        <div class=" col-lg-6 mb-3">
                                                            <label class="text-label form-label"> Contact
                                                                No. *</label>
                                                            <input type="text" name="ContactNo" class="form-control"
                                                                id="conno" value="<?php echo $contact_no ?>" required>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Address *</label>
                                                                <textarea class="form-control" id="address"
                                                                    name="Address" maxlength="290"
                                                                    title="Max 290 characters allowed.'@' is not allowed."><?php echo $address; ?></textarea>

                                                            </div>
                                                            </div>
                                                            <div class=" col-lg-6 mb-3">
                                                                <div class="card-body px-0 pt-0">
                                                                    <div class="basic-form">
                                                                        <div class="row">
                                                                            <div class="col-sm-7">
                                                                                <label
                                                                                    class="text-label form-label">City
                                                                                    *</label>
                                                                                <input type="text" class="form-control"
                                                                                    placeholder="Anand" name="city"
                                                                                    value="<?php if($city!=''){echo $city;}else{echo 'Anand';} ?>"
                                                                                    required>
                                                                            </div>
                                                                            <div class="col mt-2 mt-sm-0">
                                                                                <label class="text-label form-label">Pin
                                                                                    Code *</label>
                                                                                <input type="text" class="form-control"
                                                                                    name="zip"
                                                                                    value="<?php echo $zip; ?>"
                                                                                    pattern="[0-9]{6}" id="zip"
                                                                                    title="Please enter a valid 6-digit pin code" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Email id</label>
                                                                <input type="email" name="email" class="form-control"
                                                                    value="<?php echo $email; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Facilities
                                                                    Available</label>
                                                                <textarea name="facility"
                                                                    class="form-control"><?php echo $facility; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Description</label>
                                                                <textarea name="description"
                                                                    class="form-control"><?php echo $description; ?></textarea>
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

    function validateForm() {
        var name = document.getElementById('name').value;
        if (name.trim() == "") {
            alert("Name is Required");
            return false;
        }

        var conno = document.getElementById('conno').value;
        if (conno.trim() == "") {
            alert("Contect No is Required");
            return false;
        }

        var address = document.getElementById('address').value;
        if (address.trim() == "") {
            alert("Address is Required");
            return false;
        } else if (address.trim() > 290) {
            alert("Address is too long!");
            return false;
        }

        const pinCode = document.getElementById('zip').value.trim();
        if (pinCode === "") {
            messages.push('Pin Code is required.');
            isValid = false;
        } else if (!/^\d{6}$/.test(pinCode)) {
            messages.push('Pin Code must be a 6 digit number.');
            isValid = false;
        }

        // Validate file input (photo)
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


        // Validate address (no '@' symbol)
        var addressInput = document.getElementById('address').value;
        if (addressInput.includes('@')) {
            alert("The '@' symbol is not allowed in the address.");
            return false;
        }

        return true; // Allow form submission

    }
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                const imageName = this.getAttribute('data-image');
                const tableName = "education";
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