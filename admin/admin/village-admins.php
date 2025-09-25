<?php include_once("config.php");
session_start();
if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}

//Session management code

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

//session code ends

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>Village Admins | Super Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="images/villagelogo.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Style css -->
    <link href="css/style.css" rel="stylesheet">

    <script>
        function remove() {
            var r = confirm("Are you sure to delete your village?");
            if (r == true)
                return true;
            else
                return false;

        }
    </script>


</head>

<body>


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <?php include('header.php');  ?>

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                <div class="d-flex align-items-center mb-4 flex-wrap">
                    <h3 class="me-auto">Village/Admin List</h3>
                    <div>
                        <a href="village-creation.php" class="btn btn-primary me-3 btn-sm"><i class="fas fa-plus me-2"></i>Add New Village</a>

                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Profile Datatable</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="display" style="min-width: 845px">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Village Name</th>
                                                <th>Database Name</th>
                                                <th>Database User</th>
                                                <th>Host</th>
                                                <th>Database Password</th>
                                                <th>Admin Email</th>
                                                <th>Admin Password</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $table = mysqli_query($conn, "select * from villages");
                                            while ($row = mysqli_fetch_array($table)) {
                                                echo "
                                                <tr>
                                                    <td>$row[0]</td>
                                                    <td>$row[village_name]</td>
                                                    <td class='wspace-no'>$row[db_name]</td>
                                                    <td>$row[db_user]</td>
                                                    <td>$row[db_host]</td>
                                                    <td>$row[db_pass]</td>
                                                    <td><span class='badge badge-success badge-lg light'>$row[admin_email]</span></td>
                                                    <td>$row[admin_pass]</td>
                                                    <td>
														<div class='d-flex'>
															<a href='edit-admin.php?village=$row[1]' class='btn btn-primary shadow btn-xs sharp me-1'><i class='fas fa-pencil-alt'></i></a>
															<a href='delete-village.php?village=$row[1]' onclick='return remove()' class='btn btn-danger shadow btn-xs sharp'><i class='fa fa-trash'></i></a>
														</div>												
													</td>
                                                </tr>";
                                            } ?>

                                        </tbody>
                                    </table>
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
            <div class="copyright">
                <p>© Copyright <?php echo date("Y"); ?>by Sadar Patel University</p>
            </div>
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
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true">
        <?php include('modal.php'); ?>
    </div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/chartjs/chart.bundle.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Apex Chart -->
    <script src="vendor/bootstrap-datepicker-master/js/bootstrap-datepicker.min.js"></script>

    <!-- Chart piety plugin files -->
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/plugins-init/datatables.init.js"></script>

    <!-- Dashboard 1 -->




    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>





</body>

</html>