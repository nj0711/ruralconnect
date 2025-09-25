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
$bday = '';
$dday = '';
$edu = '';
$politicalcarrier = '';
$positionheld = '';
$rolein = '';
$description = '';
$profession = "";
$typeofleader = "";


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
            window.location.href = "editform.php?tablename=pillarofcommunity";
        }
    </script>

<?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID

    // Perform the deletion logic here
    $sel = "select * from pillarofcommunity where pillarofcommunityid=" . $deleteId;
    $res = $obj->selectdata("pillarofcommunity", $sel);

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
    $del = "DELETE FROM pillarofcommunity WHERE pillarofcommunityid=" . $deleteId;
    $result = $obj->deletedata("pillarofcommunity", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
            window.location.href = 'editform.php?tablename=pillarofcommunity';
            </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}


if (isset($_POST['insert'])) {


    $name = isset($_POST['name']) ? $obj->escape($_POST['name']) : '';
    $bday = isset($_POST['bday']) ? $obj->escape($_POST['bday']) : '';
    $dday = isset($_POST['dday']) ? $obj->escape($_POST['dday']) : '';
    $edu = isset($_POST['edu']) ? $obj->escape($_POST['edu']) : '';
    $politicalcarrier = isset($_POST['politicalcarrier']) ? $obj->escape($_POST['politicalcarrier']) : '';
    $positionheld = isset($_POST['positionheld']) ? $obj->escape($_POST['positionheld']) : '';
    $rolein = isset($_POST['rolein']) ? $obj->escape($_POST['rolein']) : '';
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : '';
    $profession = isset($_POST['profession']) ? $obj->escape($_POST['profession']) : '';
    $typeofleader = isset($_POST['typeofleader']) ? $obj->escape($_POST['typeofleader']) : '';

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
                $tname = str_replace(' ', '_', $name);
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = time() . $tname . 'pillarofcommunity' . $i . '.' . $fileExtension;
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
    } else {
        echo "No files selected.";
    }
    $filesJson = json_encode($uploadedFiles);



    $selq = "select villageid from villagebasic";
    $res = $obj->selectdata("villagebasic", $selq);
    $village_id = $res[0]['villageid'];

    if ($fileCount <= 0) {

        $query = "INSERT INTO pillarofcommunity( name, birthdate, dateofpassing, education, politicalcareer, positionsheld, roleinindependencemovement,villageid, description,profession,typeofleader) 
            VALUES ('$name','$bday','$dday','$edu','$politicalcarrier','$positionheld','$rolein',$village_id,'$description','$profession','$typeofleader')";
    } else {

        $query = "INSERT INTO pillarofcommunity( name, birthdate, dateofpassing, education, politicalcareer, positionsheld, roleinindependencemovement,villageid, description, photo,profession,typeofleader) 
            VALUES ('$name','$bday','$dday','$edu','$politicalcarrier','$positionheld','$rolein',$village_id,'$description','$filesJson','$profession','$typeofleader')";
    }


    $result = $obj->insertdata("pillarofcommunity", $query);
    if ($result == "Data Inserted.") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Inserted');
                window.location.href = 'editform.php?tablename=pillarofcommunity';
                </script>";
    } else {
        echo "<script>alert('Error: Failed to insert data');</script>";
    }
}

if (isset($_GET['updateid'])) {
    $selq = "select * from pillarofcommunity where pillarofcommunityid = " . $_GET['updateid'];
    $res = $obj->selectdata("pillarofcommunity", $selq);
    // print_r($res);

    if ($res != null) {

        $name = $res[0]['name'];
        $bday = $res[0]['birthdate'];
        $dday = $res[0]['dateofpassing'];
        $edu = $res[0]['education'];
        $politicalcarrier = $res[0]['politicalcareer'];
        $positionheld = $res[0]['positionsheld'];
        $rolein = $res[0]['roleinindependencemovement'];
        $description = $res[0]['description'];
        $typeofleader = $res[0]['typeofleader'];
        $profession = $res[0]['profession'];
        $photo = $res[0]['photo'];
        $data = json_decode($photo, true);
        // 			print_r($res[0]); 
    } else {
        header('Location: pillarofcommunity.php?updateid=' . $_GET['updateid']);
    }
}

if (isset($_POST['update'])) {

    $name = isset($_POST['name']) ? $obj->escape($_POST['name']) : '';
    $bday = isset($_POST['bday']) ? $obj->escape($_POST['bday']) : '';
    $dday = isset($_POST['dday']) ? $obj->escape($_POST['dday']) : '';
    $edu = isset($_POST['edu']) ? $obj->escape($_POST['edu']) : '';
    $politicalcarrier = isset($_POST['politicalcarrier']) ? $obj->escape($_POST['politicalcarrier']) : '';
    $positionheld = isset($_POST['positionheld']) ? $obj->escape($_POST['positionheld']) : '';
    $rolein = isset($_POST['rolein']) ? $obj->escape($_POST['rolein']) : '';
    $description = isset($_POST['description']) ? $obj->escape($_POST['description']) : '';
    $typeofleader = isset($_POST['typeofleader']) ? $obj->escape($_POST['typeofleader']) : '';
    $profession = isset($_POST['profession']) ? $obj->escape($_POST['profession']) : '';

    $selQ = "select photo from pillarofcommunity  where pillarofcommunityid  = " . $_GET['updateid'];
    $res = $obj->selectdata("pillarofcommunity", $selQ);
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
                $tname = str_replace(' ', '_', $name);
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                $newFileName = time() . $tname . 'pillarofcommunity' . $count + $i . '.' . $fileExtension;
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
    } else {
        echo "No files selected.";
    }
    $filesJson = json_encode($uploadedFiles);

    if (count($uploadedFiles) >= 1) {

        $updateq = "UPDATE pillarofcommunity SET name='$name',birthdate='$bday',dateofpassing='$dday',education='$edu',politicalcareer='$politicalcarrier',positionsheld='$positionheld',roleinindependencemovement='$rolein',description='$description',profession='$profession',typeofleader='$typeofleader',photo='$filesJson' WHERE pillarofcommunityid=" . $_GET['updateid'];
    } else {

        $updateq = "UPDATE pillarofcommunity SET name='$name',birthdate='$bday',dateofpassing='$dday',education='$edu',politicalcareer='$politicalcarrier',positionsheld='$positionheld',roleinindependencemovement='$rolein',description='$description',profession='$profession',typeofleader='$typeofleader',photo=DEFAULT WHERE pillarofcommunityid=" . $_GET['updateid'];
    }

    $result = $obj->updatedata("pillarofcommunity", $updateq);
    if ($result == "Data Updated") {
        // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=pillarofcommunity';
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
    <title> Pillar Of Community | Admin Panel</title>

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
                                <h4 class="card-title">Pillar of Community</h4>
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
                                                                <label class="text-label form-label">Name
                                                                </label>
                                                                <input type="text" name="name" class="form-control"
                                                                    value="<?php echo $name ?>" maxlength="250"
                                                                    required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">profession(One
                                                                    Line)
                                                                </label>
                                                                <input type="text" name="profession"
                                                                    class="form-control"
                                                                    value="<?php echo $profession ?>" maxlength="250"
                                                                    required>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Leader Type</label>
                                                                <div class="mb-3 mb-0">

                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="typeofleader" value="sarpanch"
                                                                            class="form-check-input" checked <?php if ($typeofleader == 'sarpanch') {
                                                                                                                    echo 'checked';
                                                                                                                } ?>>
                                                                        Sarpanch</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="typeofleader" value="mla"
                                                                            class="form-check-input" <?php if ($typeofleader == 'mla') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                                        MLA</label>
                                                                    <label class="radio-inline me-3"><input type="radio"
                                                                            name="typeofleader" value="other"
                                                                            class="form-check-input" <?php if ($typeofleader == 'other') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                                                                        Other</label>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3 mt-3">
                                                                <label class="text-label form-label">Birth Date</label>
                                                                <input type="date" class="form-control" name="bday"
                                                                    value="<?php echo $bday; ?>" />
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Date Of Passing
                                                                </label>
                                                                <input type="date" class="form-control" name="dday"
                                                                    value="<?php echo $dday; ?>" />
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Education</label>
                                                                <input type="text" name="edu" class="form-control"
                                                                    value="<?php echo $edu; ?>" maxlength="250">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">political Carrier
                                                                    Information</label>
                                                                <textarea name="politicalcarrier" class="form-control"
                                                                    maxlength="250"><?php echo $politicalcarrier; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Government
                                                                    Position</label>
                                                                <textarea name="positionheld" class="form-control"
                                                                    maxlength="250"><?php echo $positionheld; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Role In
                                                                    Independence Movement</label>
                                                                <textarea name="rolein" class="form-control"
                                                                    maxlength="250"><?php echo $rolein; ?></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 mb-2">
                                                            <div class="mb-3">
                                                                <label class="text-label form-label">Description</label>
                                                                <textarea name="description" class="form-control"
                                                                    maxlength="490"><?php echo $description; ?></textarea>
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
                                                                                                    if ($person != "no-profile.png") { ?>
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
                    <!-- Import Section -->
                    <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;" id="import-section">
                        <h4>👥 Bulk Import Pillar of Community</h4>
                        <p class="text-muted mb-3">
                            <strong>How it works:</strong> Download the template, fill in the biographical data, and import.
                            <strong>Village ID is automatically assigned</strong> - you don't need to fill it.
                            <strong>Photos will be empty</strong> - add them later via the edit form.
                        </p>

                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <a href="templates/pillarofcommunity_template.php" class="btn btn-info w-100">
                                    📥 Download Template
                                </a>
                            </div>
                            <div class="col-md-8">
                                <form action="imports/import_pillarofcommunity.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
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
                                <strong>💡 Required field:</strong> Name<br>
                                <strong>📝 Optional fields:</strong> Birth Date, Date of Passing, Profession, Leader Type, Education, Political Career, Positions Held, Role in Independence, Description<br>
                                <strong>⚠️ Notes:</strong><br>
                                • <strong>Leader Type:</strong> sarpanch, mla, other - defaults to other<br>
                                • <strong>Dates:</strong> Format YYYY-MM-DD (e.g., 1940-05-15)<br>
                                • <strong>Birth Date:</strong> Must be a past date<br>
                                • <strong>Date of Passing:</strong> Must be after birth date and past date (leave empty if alive)<br>
                                • <strong>Visibility:</strong> on/off - defaults to off<br>
                                • <strong>Photos:</strong> Will be empty - add via edit form later
                            </small>
                        </div>
                    </div>
                </div>
            </div>
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
            var bday = document.forms["myForm"]["bday"].value;
            var dday = document.forms["myForm"]["dday"].value;
            if (new Date(bday) >= new Date()) {
                alert("Birth date should be a past date.");
                return false;
            }

            var photoInput = document.getElementById('photo');
            var files = photoInput.files;
            var maxSize = 5 * 1024 * 1024; // 5MB

            // Check if no photo is selected and no existing photos (update mode)
            // var existingPhotos = <?php echo isset($_GET['updateid']) && !empty($data) ? 'true' : 'false'; ?>;
            // if (files.length === 0 && !existingPhotos) {
            //     alert("Please select at least one photo.");
            //     return false; // Prevent form submission
            // }

            // Check file sizes
            for (var i = 0; i < files.length; i++) {
                if (files[i].size > maxSize) {
                    alert("File size of " + files[i].name + " exceeds 5MB.");
                    return false; // Prevent form submission
                }
            }

            return true;
        }

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const imageName = this.getAttribute('data-image');
                    const tableName = "pillarofcommunity";
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