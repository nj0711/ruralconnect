<?php include_once("config.php");
// session_start();
// if (!isset($_SESSION['village_admin_email'])) {
//     header("Location: index.php");
//     exit();
// }

// // Set the timeout duration (in seconds)
// $timeout_duration = 600; // 10 minutes

// // Check if last activity is set and calculate the inactivity period
// if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
//     // Last request was over 10 minutes ago, so destroy the session
//     session_unset();     // Unset session variables
//     session_destroy();   // Destroy the session
//     header("Location: index.php"); // Redirect to login page
//     exit();
// }

// // Update the last activity timestamp to the current time
// $_SESSION['LAST_ACTIVITY'] = time();

// 	$obj = new ConnDb();

//     $tableName=$_GET['tablename'];

//     if(!$obj->tableExists($tableName)){
//         header('Location: index.php');

//     }
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>Contact | Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="images/villagelogo.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Style css -->
    <link href="css/style.css" rel="stylesheet">


    <script>
        function remove() {
            var r = confirm("Are you sure to delete your record?");
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Contact Datatable</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example3" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Subject</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Message</th>

                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $obj = new ConnDb();
                                        $table = 'contacts';
                                        $values = 'SELECT * FROM  contacts';

                                        $result = $obj->selectdata($table, $values);

                                        foreach ($result as $r => $row) {

                                        ?>
                                            <tr>
                                                <td><?php echo "$row[contactid]"; ?></td>
                                                <td><?php echo "$row[name]"; ?></td>
                                                <td><?php echo "$row[subject]"; ?></td>
                                                <td><?php echo "$row[email]"; ?></td>
                                                <td><?php echo "$row[phoneno]"; ?></td>
                                                <td><textarea id="" disabled><?php echo "$row[msg]"; ?></textarea></td>

                                                <td>
                                                    <div class="d-flex">
                                                        <a href="mailto:<?php echo "$row[email]"; ?>"
                                                            class="btn btn-primary shadow btn-xs sharp me-1"><i
                                                                class="fa-regular fa-envelope"></i></a>
                                                        <a href="delete-contact.php?id=<?php echo "$row[contactid]"; ?>"
                                                            class="btn btn-danger shadow btn-xs sharp"><i
                                                                class="fa fa-trash" onclick='return remove()'></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
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