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

    $tableName=$_GET['tablename'];

    if(!$obj->tableExists($tableName)){
        header('Location: index.php');

    }

	?>
<!DOCTYPE html>
<html lang="en">

<head>
    <script>
    // Force reload on back
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    });
    </script>

    <!-- Meta -->
    <meta charset="utf-8">

    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Page Title -->
    <title> Edit Form | Admin Panel</title>

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
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-xxl-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?php echo strtoupper($tableName); ?></h4>
                        <?php 
                        if ($tableName != "villagebasic" && $tableName != "population") { ?>
                            <a href="<?php echo $tableName . '.php'; ?>">
                                <button class="btn btn-primary">Add Data</button>
                            </a>
                        <?php } ?>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form method="post" action="#" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-xxl-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="table-responsive recentOrderTable">
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <?php 
                                                            $selC = "SHOW COLUMNS FROM $tableName";
                                                            $resCol = $obj->selectdata($tableName, $selC);
                                                            ?>
                                                            <tr>
                                                                <th><strong><?php echo $resCol[0]['Field']; ?></strong></th>
                                                                <th><strong><?php echo $resCol[2]['Field']; ?></strong></th>
                                                                <?php if($tableName != 'villagebasic' && $tableName != 'population'){ ?>
                                                                <th><strong>Visibility</strong></th>
                                                                <?php }?>
                                                                <th><strong>Edit</strong></th>
                                                                
                                                                <?php if ($tableName != 'villagebasic' && $tableName != 'population') { ?>
                                                                    <th><strong>Delete</strong></th>
                                                                <?php } ?>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $selQ = "SELECT * FROM $tableName";
                                                            $result = $obj->selectdata($tableName, $selQ);

                                                            if ($result) {
                                                                for ($i = 0; $i < count($result); $i++) {
                                                                    $res = array_values($result[$i]);
                                                                    echo '<tr>';
                                                                    echo '<td>' . $res[0] . '</td>';
                                                                    echo '<td>' . $res[2] . '</td>';
                                                                    if($tableName != 'villagebasic' && $tableName != 'population'){
                                                                    $tableNameID = $tableName.'id';
                                                                    $vr = $obj->selectdata($tableName,"select visibility from $tableName where $tableNameID = $res[0]");
                                                                    $visi = $vr[0]['visibility'];
                                                                    
                                                                    
                                                                    // echo '<td>' .$visi. '</td>';
                                                                    if ($visi=="off") 
				  	                                                    $ls="on";
                                                                    elseif ($visi=="on") 
                                                                          $ls="off";
                                                                    echo '<td>
                                                                        <a href="update_visibility.php?tablename=' . $tableName . '&updateid=' . $res[0] . '&vi='.$ls.'"  class="btn btn-danger">' . $visi . '</a>
                                                                    </td>';
                                                                    }
                                                                    echo '<td>
                                                                            <a href="' . $tableName . '.php?updateid=' . $res[0] . '" class="btn btn-primary shadow btn-xs sharp me-1" style="padding:0.2rem;">
                                                                                <i class="fas fa-pencil-alt"></i>
                                                                            </a>
                                                                          </td>';
                                                                    
                                                                    if ($tableName != 'villagebasic' && $tableName != 'population') {
                                                                        echo '<td>
                                                                                <a href="' . $tableName . '.php?deleteid=' . $res[0] . '" class="btn btn-danger shadow btn-xs sharp">
                                                                                    <i class="fa fa-trash"></i>
                                                                                </a>
                                                                              </td>';
                                                                    }
                                                                    echo '</tr>';
                                                                }
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
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

            <?php include('../footer.php'); ?>
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
</body>

</html>
