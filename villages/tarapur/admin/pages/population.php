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


// Retrieve form data
$tot_males = 0;
$tot_females = 0;
$tot_childs = 0;
$birth_and_death_ratio = '0:0';

// Education wise population
$tot_pgs = 0;
$tot_ugs = 0;
$tot_12 = 0;
$tot_10 = 0;
$tot_nonedus = 0;

// Age wise population
$tot_100_m = 0;
$tot_100_f = 0;
$tot_80_m = 0;
$tot_80_f = 0;
$tot_60_m = 0;
$tot_60_f = 0;
$tot_40_m = 0;
$tot_40_f = 0;
$tot_20_m = 0;
$tot_20_f =  0;




// Religion wise population
$tot_hindus = 0;
$tot_muslims = 0;
$tot_christians = 0;
$tot_sikh = 0;
$tot_others = 0;




// Annual Income wise population
$inc_above_15 = 0;
$inc_10_15 = 0;
$inc_3_10 = 0;
$inc_below_3 = 0;



$tot_farmers = 0;
$tot_govEmp = 0;
$occ_3_name = '';
$occ_3 = 0;
$occ_4_name = '';
$occ_4 = 0;
$occ_5_name = '';
$occ_5 = 0;




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
            window.location.href = "editform.php?tablename=population";
        }
    </script>

<?php
}

// After confirmation, handle the deletion process using 'confirmeddeleteid'
if (isset($_GET['confirmeddeleteid'])) {
    $deleteId = $_GET['confirmeddeleteid'];  // Get the confirmed delete ID


    // Delete the record from the database
    $del = "DELETE FROM population WHERE populationid=" . $deleteId;
    $result = $obj->deletedata("population", $del);

    // Handle success or failure
    if ($result == "Data Deleted") {
        echo "<script>alert('Success! Data Deleted');
                window.location.href = 'editform.php?tablename=population';
                </script>";
    } else {
        echo "<script>alert('Error: Failed to delete data');</script>";
    }
}

if (isset($_GET['updateid'])) {

    $selall = "select * from population where populationid=" . $_GET['updateid'];
    $res = $obj->selectdata("population", $selall);

    $tot_males = $res[0]['totalnoofmale'];
    $tot_females = $res[0]['totalnooffemale'];
    $tot_childs = $res[0]['totalnoofchildren'];
    $birth_and_death_ratio = $res[0]['birthanddeathratio'];

    $religion_population = json_decode($res[0]['religionandpopulation']);
    $occupation_population = json_decode($res[0]['occupationandpopulation']);
    $education_population = json_decode($res[0]['educationandpopulation']);
    $age_male = json_decode($res[0]['agewisemale']);
    $age_female = json_decode($res[0]['agewisefemale']);
    $salary_population = json_decode($res[0]['salaryandpopulation']);


    $tot_hindus = $religion_population->tot_hindus;
    $tot_muslims = $religion_population->tot_muslims;
    $tot_christians = $religion_population->tot_christians;
    $tot_sikh = $religion_population->tot_sikh;
    $tot_others = $religion_population->tot_others;




    $tot_farmers = $occupation_population->tot_farmers;
    $tot_govEmp = $occupation_population->tot_govEmp;
    $occ_3_name = $occupation_population->occ_3_name;
    $occ_3 = $occupation_population->occ_3;
    $occ_4_name = $occupation_population->occ_4_name;
    $occ_4 = $occupation_population->occ_4;
    $occ_5_name = $occupation_population->occ_5_name;
    $occ_5 = $occupation_population->occ_5;

    $tot_pgs = $education_population->tot_pgs;
    $tot_ugs = $education_population->tot_ugs;
    $tot_12 = $education_population->tot_12;
    $tot_10 = $education_population->tot_10;
    $tot_nonedus = $education_population->tot_nonedus;

    $inc_above_15 =  $salary_population->inc_above_15;
    $inc_10_15 = $salary_population->inc_10_15;
    $inc_3_10 = $salary_population->inc_3_10;
    $inc_below_3 = $salary_population->inc_below_3;



    // Age wise population
    $tot_100_m = $age_male->tot_100_m;
    $tot_100_f = $age_female->tot_100_f;
    $tot_80_m = $age_male->tot_80_m;
    $tot_80_f = $age_female->tot_80_f;
    $tot_60_m = $age_male->tot_60_m;
    $tot_60_f = $age_female->tot_60_f;
    $tot_40_m = $age_male->tot_40_m;
    $tot_40_f = $age_female->tot_40_f;
    $tot_20_m = $age_male->tot_20_m;
    $tot_20_f =  $age_female->tot_20_f;
}

$selQ = "select villageid from villagebasic";
$res = $obj->selectdata("villagebasic", $selQ);
$village_id = $res[0]['villageid'];
// echo $res[0]['villageid'];


if (isset($_POST['update'])) {


    $tot_males = isset($_POST['tot_males']) ? intval($_POST['tot_males']) : 0;
    $tot_females = isset($_POST['tot_females']) ? intval($_POST['tot_females']) : 0;
    $tot_childs = isset($_POST['tot_childs']) ? intval($_POST['tot_childs']) : 0;
    $birth_and_death_ratio = isset($_POST['birth_death_ratio']) ? $_POST['birth_death_ratio'] : '';

    // Education wise population
    $tot_pgs = isset($_POST['tot_pgs']) ? intval($_POST['tot_pgs']) : 0;
    $tot_ugs = isset($_POST['tot_ugs']) ? intval($_POST['tot_ugs']) : 0;
    $tot_12 = isset($_POST['tot_12']) ? intval($_POST['tot_12']) : 0;
    $tot_10 = isset($_POST['tot_10']) ? intval($_POST['tot_10']) : 0;
    $tot_nonedus = isset($_POST['tot_nonedus']) ? intval($_POST['tot_nonedus']) : 0;


    $education_and_population = json_encode([
        'tot_10' => $tot_10,
        'tot_12' => $tot_12,
        'tot_ugs' => $tot_ugs,
        'tot_pgs' => $tot_pgs,
        'tot_nonedus' => $tot_nonedus

    ]);



    // Age wise population
    $tot_100_m = isset($_POST['tot_100_m']) ? intval($_POST['tot_100_m']) : 0;
    $tot_100_f = isset($_POST['tot_100_f']) ? intval($_POST['tot_100_f']) : 0;
    $tot_80_m = isset($_POST['tot_80_m']) ? intval($_POST['tot_80_m']) : 0;
    $tot_80_f = isset($_POST['tot_80_f']) ? intval($_POST['tot_80_f']) : 0;
    $tot_60_m = isset($_POST['tot_60_m']) ? intval($_POST['tot_60_m']) : 0;
    $tot_60_f = isset($_POST['tot_60_f']) ? intval($_POST['tot_60_f']) : 0;
    $tot_40_m = isset($_POST['tot_40_m']) ? intval($_POST['tot_40_m']) : 0;
    $tot_40_f = isset($_POST['tot_40_f']) ? intval($_POST['tot_40_f']) : 0;
    $tot_20_m = isset($_POST['tot_20_m']) ? intval($_POST['tot_20_m']) : 0;
    $tot_20_f = isset($_POST['tot_20_f']) ? intval($_POST['tot_20_f']) : 0;




    // Religion wise population
    $tot_hindus = isset($_POST['tot_hindus']) ? intval($_POST['tot_hindus']) : 0;
    $tot_muslims = isset($_POST['tot_muslims']) ? intval($_POST['tot_muslims']) : 0;
    $tot_christians = isset($_POST['tot_christians']) ? intval($_POST['tot_christians']) : 0;
    $tot_sikh = isset($_POST['tot_sikh']) ? intval($_POST['tot_sikh']) : 0;
    $tot_others = isset($_POST['tot_others']) ? intval($_POST['tot_others']) : 0;




    // Annual Income wise population
    $inc_above_15 = isset($_POST['inc_above_15']) ? intval($_POST['inc_above_15']) : 0;
    $inc_10_15 = isset($_POST['inc_10_15']) ? intval($_POST['inc_10_15']) : 0;
    $inc_3_10 = isset($_POST['inc_3_10']) ? intval($_POST['inc_3_10']) : 0;
    $inc_below_3 = isset($_POST['inc_below_3']) ? intval($_POST['inc_below_3']) : 0;



    $tot_farmers = isset($_POST['tot_farmers']) ? $_POST['tot_farmers'] : '';
    $tot_govEmp = isset($_POST['tot_govEmp']) ? $_POST['tot_govEmp'] : '';
    $occ_3_name = isset($_POST['occ_3_name']) ? $_POST['occ_3_name'] : '';
    $occ_3 = isset($_POST['occ_3']) ? $_POST['occ_3'] : '';
    $occ_4_name = isset($_POST['occ_4_name']) ? $_POST['occ_4_name'] : '';
    $occ_4 = isset($_POST['occ_4']) ? $_POST['occ_4'] : '';
    $occ_5_name = isset($_POST['occ_5_name']) ? $_POST['occ_5_name'] : '';
    $occ_5 = isset($_POST['occ_5']) ? $_POST['occ_5'] : '';





    $religion_and_population = json_encode([
        'tot_hindus' => $tot_hindus,
        'tot_muslims' => $tot_muslims,
        'tot_christians' => $tot_christians,
        'tot_sikh' => $tot_sikh,
        'tot_others' => $tot_others

    ]);

    $occupation_and_population = json_encode([
        'tot_farmers' => $tot_farmers,
        'tot_govEmp' => $tot_govEmp,
        'occ_3_name' => $occ_3_name,
        'occ_3' => $occ_3,
        'occ_4_name' => $occ_4_name,
        'occ_4' => $occ_4,
        'occ_5_name' => $occ_5_name,
        'occ_5' => $occ_5,


    ]);

    $salary_and_population = json_encode([
        'inc_above_15' => $inc_above_15,
        'inc_10_15' => $inc_10_15,
        'inc_3_10' => $inc_3_10,
        'inc_below_3' => $inc_below_3,

    ]);


    $age_wise_female = json_encode([
        'tot_100_f' => $tot_100_f,
        'tot_80_f' => $tot_80_f,
        'tot_60_f' => $tot_60_f,
        'tot_40_f' => $tot_40_f,
        'tot_20_f' => $tot_20_f

    ]);

    $age_wise_male = json_encode([
        'tot_100_m' => $tot_100_m,
        'tot_80_m' => $tot_80_m,
        'tot_60_m' => $tot_60_m,
        'tot_40_m' => $tot_40_m,
        'tot_20_m' => $tot_20_m,

    ]);
    if (isset($_POST['update'])) {

        $updateid = $_GET['updateid'];
        $qUpdate = "UPDATE population 
            SET totalnoofmale = $tot_males, 
                totalnooffemale = $tot_females, 
                totalnoofchildren = $tot_childs, 
                religionandpopulation = '$religion_and_population', 
                occupationandpopulation = '$occupation_and_population', 
                educationandpopulation = '$education_and_population', 
                salaryandpopulation = '$salary_and_population', 
                birthanddeathratio = '$birth_and_death_ratio', 
                agewisemale = '$age_wise_male', 
                agewisefemale = '$age_wise_female'
            WHERE populationid = $updateid";
        $result = $obj->updatedata("population", $qUpdate);
        if ($result == "Data Updated") {
            // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
            echo "<script>alert('Success! Data Updated');
            window.location.href = 'editform.php?tablename=population';
            </script>";
        } else {
            echo "<script>alert('Error: Failed to update data');</script>";
        }

        // }else if(isset($_POST['insert'])){
        //      $query = "INSERT INTO population ( villageid, totalnoofmale, totalnooffemale, totalnoofchildren, religionandpopulation, occupationandpopulation, educationandpopulation, salaryandpopulation, birthanddeathratio, agewisemale, agewisefemale) VALUES (
        //         $village_id, $tot_males, $tot_females, $tot_childs, '$religion_and_population', '$occupation_and_population', '$education_and_population', '$salary_and_population', '$birth_and_death_ratio', '$age_wise_male', '$age_wise_female'
        //     )";
        //     $result= $obj->insertdata("population",$query);
        //     if($result =="Data Inserted."){
        //         // echo '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Success!</strong> '.$result.' <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        //         echo "<script>alert('Success! Data Inserted');
        //         window.location.href = 'editform.php?tablename=population';
        //         </script>";

        //     }else{
        //         echo "<script>alert('Error: Failed to insert data');</script>";
        //     }

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
    <title> Population | Admin Panel</title>

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
                                <h4 class="card-title">Village Population</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form method="post" action="#">
                                        <div class="row">
                                            <!-- <div class="mb-3 col-md-6">
											<label class="form-label">Village Name</label><br>
											<div class="col-lg-12">
												<div id="row">
													<div class="input-group m-3">
														<div class="input-group-prepend">
															<button class="btn btn-danger" id="DeleteRow"
																type="button">
																<i class="bi bi-trash"></i>
																Delete
															</button>
														</div>
														<input type="text" class="form-control m-input">
														<input type="text" class="form-control m-input">
													</div>
												</div>

												<div id="newinput"></div>
												<button id="rowAdder" type="button" class="btn btn-dark">
													<span class="bi bi-plus-square-dotted">
													</span> ADD
												</button>
											</div>
										</div> -->
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Total No. of Males</label>
                                                <input type="text" name="tot_males" value="<?php echo $tot_males;  ?>"
                                                    class="form-control" placeholder="" id="myInput">
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Total No. of Females</label>
                                                <input type="text" name="tot_females"
                                                    value="<?php echo $tot_females; ?>" class="form-control"
                                                    placeholder="" id="myInput">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Total No. of Childerns</label>
                                                <input type="text" name="tot_childs" value="<?php echo $tot_childs; ?>"
                                                    class="form-control" placeholder="" id="myInput">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label">Birth And Death Ratio</label>
                                                <input type="text" name="birth_death_ratio"
                                                    value="<?php echo $birth_and_death_ratio; ?>" class="form-control"
                                                    placeholder="Birth : Death">
                                            </div>
                                            <div class="mb-3 col-md-6 mt-2">
                                                <label class="form-label">Education Wise Population</label>
                                                <div class="col-lg-11 ms-2">
                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No Of PostGraduated</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" value="<?php echo $tot_pgs; ?>"
                                                                name="tot_pgs" class="form-control" placeholder=""
                                                                id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No Of Graduated</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_ugs"
                                                                value="<?php echo $tot_ugs; ?>" class="form-control"
                                                                placeholder="" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No Of 12th Pass</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_12"
                                                                value="<?php echo $tot_12; ?>" class="form-control"
                                                                id="myInput">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No Of 10th Pass</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" value="<?php echo $tot_10; ?>"
                                                                name="tot_10" class="form-control" id="myInput">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No. Non-Educated</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_nonedus"
                                                                value="<?php echo $tot_nonedus; ?>" class="form-control"
                                                                id="myInput">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>




                                            <div class="mb-3 col-md-6 mt-2">
                                                <label class="form-label">Age Wise Population</label>
                                                <div class="col-lg-11 ms-2">
                                                    <div class="row mt-2">
                                                        <div class="col-sm-3">
                                                            <label class="form-label">Age Group</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <label class="form-label">Population</label>
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3 mt-2">
                                                            <label class="form-label">80-100</label>
                                                        </div>

                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_100_m"
                                                                value="<?php echo $tot_100_m; ?>" class="form-control"
                                                                placeholder="No. of Male" id="myInput">
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_100_f"
                                                                value="<?php echo $tot_100_f; ?>" class="form-control"
                                                                placeholder="No. of Female" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3 mt-2">
                                                            <label class="form-label">60-80</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_80_m"
                                                                value="<?php echo $tot_80_m; ?>" class="form-control"
                                                                placeholder="No. of Male" id="myInput">
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_80_f"
                                                                value="<?php echo $tot_80_f; ?>" class="form-control"
                                                                placeholder="No. of Female" id="myInput">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-3 mt-2">
                                                            <label class="form-label">40-60</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_60_m"
                                                                value="<?php echo $tot_60_m; ?>" class="form-control"
                                                                placeholder="No. of Male" id="myInput">
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_60_f" class="form-control"
                                                                value="<?php echo $tot_60_f; ?>"
                                                                placeholder="No. of Female" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3 mt-2">
                                                            <label class="form-label">20-40</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_40_m" class="form-control"
                                                                value="<?php echo $tot_40_m; ?>"
                                                                placeholder="No. of Male" id="myInput">
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_40_f" class="form-control"
                                                                value="<?php echo $tot_40_f; ?>"
                                                                placeholder="No. of Female" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-3 mt-2">
                                                            <label class="form-label">0-20</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_20_m" class="form-control"
                                                                value="<?php echo $tot_20_m; ?>"
                                                                placeholder="No. of Male" id="myInput">
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_20_f" class="form-control"
                                                                value="<?php echo $tot_20_f; ?>"
                                                                placeholder="No. of Female" id="myInput">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-6 mt-2">
                                                <label class="form-label">Relegion Wise Population</label>
                                                <div class="col-lg-11 ms-2">
                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No. Hindus</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_hindus"
                                                                value="<?php echo $tot_hindus; ?>" class="form-control"
                                                                placeholder="" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No. of Muslims</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_muslims"
                                                                value="<?php echo $tot_muslims; ?>" class="form-control"
                                                                placeholder="" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No. of Christians</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_christians"
                                                                value="<?php echo $tot_christians; ?>"
                                                                class="form-control" id="myInput">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No. of Sikh</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_sikh"
                                                                value="<?php echo $tot_sikh; ?>" class="form-control"
                                                                id="myInput">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-5">
                                                            <label class="form-label">Total No. of Others</label>
                                                        </div>
                                                        <div class="col-sm-7 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_others"
                                                                value="<?php echo $tot_others; ?>" class="form-control"
                                                                id="myInput">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="mb-3 col-md-6 mt-2">
                                                <label class="form-label">Occupation Wise Population</label>
                                                <div class="col-lg-11 ms-2">
                                                    <!-- Total No. of Farmers -->
                                                    <div class="row mt-2">
                                                        <div class="col-sm-7">
                                                            <label class="form-label">Total No. of Farmers</label>
                                                        </div>
                                                        <div class="col-sm-5 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_farmers"
                                                                value="<?php echo isset($tot_farmers) ? htmlspecialchars($tot_farmers) : ''; ?>"
                                                                class="form-control" placeholder="" id="myInput">
                                                        </div>
                                                    </div>

                                                    <!-- Total No. of Government Employees -->
                                                    <div class="row mt-2">
                                                        <div class="col-sm-7">
                                                            <label class="form-label">Total No. of Government
                                                                Employees</label>
                                                        </div>
                                                        <div class="col-sm-5 mt-2 mt-sm-0">
                                                            <input type="text" name="tot_govEmp"
                                                                value="<?php echo isset($tot_govEmp) ? htmlspecialchars($tot_govEmp) : ''; ?>"
                                                                class="form-control" placeholder="" id="myInput">
                                                        </div>
                                                    </div>

                                                    <!-- Occupation 3 -->
                                                    <div class="row mt-2">
                                                        <div class="col-sm-7">

                                                            <input type="text" name="occ_3_name"
                                                                value="<?php echo isset($occ_3_name) ? htmlspecialchars($occ_3_name) : ''; ?>"
                                                                class="form-control" placeholder="Occupation Type Name"
                                                                id="myInput">
                                                        </div>
                                                        <div class="col-sm-5 mt-2 mt-sm-0">
                                                            <input type="text" name="occ_3"
                                                                value="<?php echo isset($occ_3) ? htmlspecialchars($occ_3) : ''; ?>"
                                                                class="form-control" placeholder="Total No."
                                                                id="myInput">
                                                        </div>
                                                    </div>

                                                    <!-- Occupation 4 -->
                                                    <div class="row mt-2">
                                                        <div class="col-sm-7">

                                                            <input type="text" name="occ_4_name"
                                                                value="<?php echo isset($occ_4_name) ? htmlspecialchars($occ_4_name) : ''; ?>"
                                                                class="form-control" placeholder="Occupation Type Name"
                                                                min="0" step="1">
                                                        </div>
                                                        <div class="col-sm-5 mt-2 mt-sm-0">
                                                            <input type="text" name="occ_4"
                                                                value="<?php echo isset($occ_4) ? htmlspecialchars($occ_4) : ''; ?>"
                                                                class="form-control" placeholder="Total No."
                                                                id="myInput">
                                                        </div>
                                                    </div>

                                                    <!-- Occupation 5 -->
                                                    <div class="row mt-2">
                                                        <div class="col-sm-7">

                                                            <input type="text" name="occ_5_name"
                                                                value="<?php echo isset($occ_5_name) ? htmlspecialchars($occ_5_name) : ''; ?>"
                                                                class="form-control" placeholder="Occupation Type Name"
                                                                id="myInput">
                                                        </div>
                                                        <div class="col-sm-5 mt-2 mt-sm-0">
                                                            <input type="text" name="occ_5"
                                                                value="<?php echo isset($occ_5) ? htmlspecialchars($occ_5) : ''; ?>"
                                                                class="form-control" placeholder="Total No."
                                                                id="myInput">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- <div class="mb-3 col-md-6">
											<label class="form-label">Relegion Wise Population</label>
											<div class="col-lg-12">
												<div id="row">
													<div class="input-group m-0">
														<div class="input-group-prepend">
															<button class="btn btn-danger" id="DeleteRow"
																type="button">
																<i class="bi bi-trash"></i>
																Delete
															</button>
														</div>
														<input type="text" class="form-control m-input ms-2"
															placeholder="Religion Name">
														<input type="number" class="form-control m-input ms-2"
															placeholder="Religion Population">
													</div>
												</div>

												<div id="newinput"></div>
												<button id="rowAdder" type="button" class="btn btn-dark mt-2">
													<span class="bi bi-plus-square-dotted">
													</span> ADD
												</button>
											</div>
										</div>
									</div> -->

                                            <div class="mb-3 col-md-6 mt-2">
                                                <label class="form-label">Annual-Income Wise Population</label>
                                                <div class="col-lg-11 ms-2">
                                                    <div class="row mt-2">
                                                        <div class="col-sm-6">
                                                            <label class="form-label">Income Above 15 lakh</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="inc_above_15"
                                                                value="<?php echo $inc_above_15; ?>"
                                                                class="form-control" placeholder="" id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-6">
                                                            <label class="form-label">Income Between 10-15 lakh</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="inc_10_15" class="form-control"
                                                                value="<?php echo $inc_10_15; ?>" placeholder=""
                                                                id="myInput">
                                                        </div>
                                                    </div>

                                                    <div class="row mt-2">
                                                        <div class="col-sm-6">
                                                            <label class="form-label">Income Between 3-10 lak
                                                                lakh</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="inc_3_10"
                                                                value="<?php echo $inc_3_10; ?>" class="form-control"
                                                                id="myInput">
                                                        </div>
                                                    </div>
                                                    <div class="row mt-2">
                                                        <div class="col-sm-6">
                                                            <label class="form-label">Income Below 3 lakh lakh</label>
                                                        </div>
                                                        <div class="col-sm-4 mt-2 mt-sm-0">
                                                            <input type="text" name="inc_below_3"
                                                                value="<?php echo $inc_below_3; ?>" class="form-control"
                                                                id="myInput">
                                                        </div>
                                                    </div>


                                                </div>
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
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Here Edit End -->
                    <!-- Add this right after <div class="content-body"> and before the existing form -->
                    <div class="import-section" style="margin: 30px 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f8f9fa;">
                        <h4>📊 Bulk Import Population Data</h4>
                        <p class="text-muted mb-3">
                            <strong>How it works:</strong> Download the template, fill in the population data, and import.
                            <!-- <strong>Village ID is automatically assigned</strong> - you don't need to fill it. -->
                        </p>

                        <div class="row align-items-center g-3">
                            <div class="col-md-4">
                                <a href="templates/population_template.php" class="btn btn-info w-100">
                                    📥 Download Template
                                </a>
                            </div>
                            <div class="col-md-8">
                                <form action="imports/import_population.php" method="post" enctype="multipart/form-data" class="d-flex gap-2">
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
                                <strong>💡 Required fields:</strong> Total Males, Total Females, Total Children, Entity Name<br>
                                <strong>📝 Optional fields:</strong> Birth/Death Ratio, Religion data, Occupation data, Education data, Salary data, Age-wise data<br>
                                <strong>⚠️ Notes:</strong>
                                All population numbers should be numeric,<br>
                                Religion, Occupation, Education, Salary, and Age data should be in JSON format or separate columns,<br>
                                Village ID automatically assigned from villagebasic table
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
        document.getElementById("myInput").addEventListener("keydown", function(event) {
            // Allow: numbers (0-9), Backspace, Arrow keys, Delete, and Tab
            if (
                (event.keyCode < 48 || event.keyCode > 57) && // Numbers (0-9)
                (event.keyCode < 96 || event.keyCode > 105) && // Numpad numbers (0-9)
                ![8, 9, 37, 38, 39, 40, 46].includes(event.keyCode) // Backspace, Tab, Arrow keys, Delete
            ) {
                event.preventDefault(); // Block all other keys
            }
        });

        jQuery(window).on('load', function() {
            setTimeout(function() {
                JobickCarousel();
            }, 1000);
        });
    </script>
</body>

</html>