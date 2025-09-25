<?php
// Include database connection for the admin panel
include('config.php');
session_start(); // Start the session at the beginning

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

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering
ob_start();

function copyDirectory($src, $dst)
{
    if (!is_dir($src)) {
        die("Source directory does not exist: $src");
    }

    $dir = opendir($src);
    if ($dir === false) {
        die("Failed to open directory: $src");
    }

    @mkdir($dst);

    while (($file = readdir($dir)) !== false) {
        if ($file != '.' && $file != '..') {
            if (is_dir($src . '/' . $file)) {
                copyDirectory($src . '/' . $file, $dst . '/' . $file);
            } else {
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}

// Function to execute SQL file to create tables
function executeSqlFile($conn, $filePath)
{
    $sql = file_get_contents($filePath);
    if (mysqli_multi_query($conn, $sql)) {
        do {
            if ($result = mysqli_store_result($conn)) {
                mysqli_free_result($result);
            }
        } while (mysqli_next_result($conn));
    } else {
        echo "<script>alert('Error executing SQL file: " . mysqli_error($conn) . "');</script>";
    }
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $villageName = strtolower(trim(mysqli_real_escape_string($conn, $_POST['village_name'])));

    $dbHost = trim(mysqli_real_escape_string($conn, $_POST['db_host']));
    $dbName = trim(mysqli_real_escape_string($conn, $_POST['db_name']));
    $dbUser = trim(mysqli_real_escape_string($conn, $_POST['db_user']));
    $dbPass = trim($_POST['db_pass']);
    $adminEmail = trim(mysqli_real_escape_string($conn, $_POST['admin_email']));
    $adminPass = trim($_POST['admin_pass']);

    $salt = "villageonweb";
    $password_encrypted = sha1($adminPass . $salt);

    // Create village folder dynamically
    $villageFolder = '../villages/' . $villageName;

    if (!is_dir($villageFolder)) {
        if (mkdir($villageFolder, 0755, true)) {
            // Copy files to the new village folder
            $source = '../../raw/';
            copyDirectory($source, $villageFolder);

            // Write config.php file for the new village
            $configContent = "<?php
            // Define the database name globally
            \$db = \"$dbName\";  // Replace with your actual database name
            
            class ConnDb
            {
                private \$server = \"$dbHost\";
                private \$user = \"$dbUser\";
                private \$user_pass = \"$dbPass\";
                public \$mysqli = null;
                public \$conn = false;
                private \$result = array();
                private \$db;
            
                // Modify the constructor to use the global \$db
                public function __construct()
                {
                    global \$db;  // Access the global \$db
                    \$this->db = \$db;
            
                    if (!\$this->conn) {
                        \$this->mysqli = new mysqli(\$this->server, \$this->user, \$this->user_pass);
                        \$this->conn = true;
            
                        if (\$this->mysqli->connect_error) {
                            array_push(\$this->result, \$this->mysqli->connect_error);
                            print_r(\$this->result);
                            \$this->conn = false;
                        }
            
                        if (\$this->databaseExists(\$this->db)) {
                            \$this->mysqli = new mysqli(\$this->server, \$this->user, \$this->user_pass, \$this->db);
                        } else {
                            print_r(\$this->result[0]);
                        }
                    }
                }
            
                public function databaseExists(\$db)
                {
                    \$sql = \"SHOW DATABASES LIKE '\$db'\";
                    \$res = \$this->mysqli->query(\$sql);
                    if (\$res) {
                        if (\$res->num_rows == 1) {
                            return true;
                        } else {
                            array_push(\$this->result, \$db . \"  does not exist!\");
                            return false;
                        }
                    }
                }
            
                public function insertdata(\$table, \$values)
                {
                    if (\$this->tableExists(\$table)) {
                        \$sql = \$values;
                        try {
                            \$this->mysqli->query(\$sql);
                            return \"Data Inserted.\";
                        } catch (Exception \$e) {
                            return \"Data Already Exists!\" . \$e;
                        }
                    } else {
                        print_r(\$this->result[0]);
                    }
                }
            
                public function insertdata2(\$table, \$values)
                {
                    if (\$this->tableExists(\$table)) {
                        \$sql = \$values;
                        try {
                            \$this->mysqli->query(\$sql);
                            return \$this->mysqli->insert_id;
                        } catch (Exception \$e) {
                            return \"Data Already Exists!\";
                        }
                    } else {
                        print_r(\$this->result[0]);
                    }
                }
            
                public function selectdata(\$table, \$values)
                {
                    if (\$this->tableExists(\$table)) {
                        \$sql = \$values;
                        if (\$res = \$this->mysqli->query(\$sql)) {
                            if (\$res->num_rows > 0) {
                                while (\$row = \$res->fetch_assoc()) {
                                    \$val[] = \$row;
                                }
                                return \$val;
                            } else {
                                array_push(\$this->result, \"No Data Found!\");
                                // print_r(\$this->result[0]);
                                return 'No Data Found!';
                            }
                        }
                    } else {
                        print_r(\$this->result[0]);
                    }
                }
            
                public function updatedata(\$table, \$values)
                {
                    if (\$this->tableExists(\$table)) {
                        \$sql = \$values;
                        if (\$this->mysqli->query(\$sql)) {
                            return \"Data Updated\";
                        } else {
                            array_push(\$this->result, \" Data updated Failed!\");
                            print_r(\$this->result[0]);
                        }
                    } else {
                        print_r(\$this->result[0]);
                    }
                }
            
                public function deletedata(\$table, \$values)
                {
                    if (\$this->tableExists(\$table)) {
                        \$sql = \$values;
                        if (\$this->mysqli->query(\$sql)) {
                            return \"Data Deleted\";
                        }
                    } else {
                        print_r(\$this->result[0]);
                    }
                }
            
                public function tableExists(\$table)
                {
                    \$sql = \"SHOW TABLES FROM \$this->db LIKE '\$table'\";
                    \$res = \$this->mysqli->query(\$sql);
                    if (\$res->num_rows == 1) {
                        return true;
                    } else {
                        array_push(\$this->result, \$table . \"  does not exist in DB!\");
                        return false;
                    }
                }
            
                public function escape(\$value)
                {
                    return \$this->mysqli->real_escape_string(\$value);
                }
            
                public function __destruct()
                {
                    if (\$this->mysqli) {
                        if (\$this->mysqli->close()) {
                            \$this->conn = false;
                        }
                    }
                }
            }
            ?>";

            file_put_contents($villageFolder . '/admin/config.php', $configContent);

            // Connect to the new village database and execute the SQL file
            $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
            if (!$conn) {
                die("Failed to connect to village database: " . mysqli_connect_error());
            }

            $sqlFilePath = __DIR__ . '/schemas/create.sql';
            executeSqlFile($conn, $sqlFilePath);

            // Insert admin credentials into the village database
            $insertAdminQuery = "INSERT INTO admin (email, passwordhash) VALUES ('$adminEmail', '$password_encrypted')";
            mysqli_query($conn, $insertAdminQuery) or die("Error inserting admin: " . mysqli_error($conn));

            mysqli_close($conn);

            // Now connect to the admin panel database
            $conn = mysqli_connect($dbHost, $dbUser, $dbPass, 'villageonweb_admin_panel'); // Replace with your actual admin database
            if (!$conn) {
                die("Failed to connect to admin panel database: " . mysqli_connect_error());
            }

            // Insert village info into admin panel
            $query = "INSERT INTO villages (village_name, db_host, db_name, db_user, db_pass, admin_email, admin_pass) 
                      VALUES ('$villageName', '$dbHost', '$dbName', '$dbUser', '$dbPass', '$adminEmail', '$password_encrypted')";
            mysqli_query($conn, $query) or die("Error inserting village: " . mysqli_error($conn));


            //jagdish code start 

            $conn = mysqli_connect($dbHost, $dbUser, $dbPass, 'villageonweb_admin_panel');
            $id_of_admin_query = "select * from villages where village_name='" . $villageName . "'";
            $id_of_admin = mysqli_query($conn, $id_of_admin_query);
            $id_a = mysqli_fetch_assoc($id_of_admin)['id'];

            mysqli_close($conn);


            $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
            $admin_id_query = "UPDATE admin set AdminID= $id_a";
            $admin_id_res = mysqli_query($conn, $admin_id_query);
            mysqli_close($conn);


            $conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
            echo $ins = "INSERT INTO villagebasic (AdminID,Name) VALUES ($id_a,'$villageName')";
            echo "<script>alert($ins);</script>";
            if (mysqli_query($conn, $ins)) {
                // echo "<script>alert('Now you can insert data');</script>";
                echo $insp = "INSERT INTO population (populationid,villageid) VALUES (1,1)";
                echo "<script>alert($ins);</script>";
                if (mysqli_query($conn, $insp)) {
                    echo "<script>alert('Now you can insert data');</script>";
                } else {
                    echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
                }
            } else {
                // echo "<script>alert('Error: " . mysqli_error($conn) . "');</script>";
            }

            mysqli_close($conn);

            // Redirect after village creation
            header("Location: villages.php");
            exit;
        } else {
            echo "<script>alert('Failed to create village folder.');</script>";
        }
    } else {
        echo "<script>alert('Village already exists!');</script>";
    }
}
ob_end_flush();

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- PAGE TITLE HERE -->
    <title>Village Creation | Super Admin Panel</title>

    <!-- Favicon icon -->
    <link rel="shortcut icon" type="image/png" href="images/villagelogo.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Style css -->
    <link href="css/style.css" rel="stylesheet">

    <style>
        /* Loader styles */
        .loader {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 9999;
            /* Above everything */
            top: 40%;
            /* Adjust to move loader a bit higher */
            left: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid #3498db;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Overlay to disable background interaction */
        .overlay {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 9998;
            /* Just below the loader */
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black */
        }

        /* Warning text for "Do not refresh" */
        .loader-text {
            display: none;
            /* Hidden by default */
            position: fixed;
            z-index: 9999;
            /* Above everything */
            top: 60%;
            /* Adjust to appear just below the loader */
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
        }
    </style>

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

                <div class="row">
                    <div class="col-12">
                        <div class="basic-form">
                            <h2>Add New Village</h2>
                            <hr>
                            <form method="POST" class="mb-5">

                                <h3>Database Details</h3><br>

                                <label for="db_host">Database Host:</label><br>
                                <input type="text" id="db_host" class="form-control input-default" value="localhost" name="db_host" required><br><br>

                                <label for="db_name">Database Name:</label><br>
                                <input type="text" id="db_name" name="db_name" class="form-control input-default" required><br><br>

                                <label for="db_user">Database Username:</label><br>
                                <input type="text" id="db_user" name="db_user" class="form-control input-default" required><br><br>

                                <label for="db_pass">Database Password:</label><br>
                                <input type="password" id="db_pass" class="form-control input-default" name="db_pass"><br><br>

                                <h3>Village Details</h3><br>

                                <label for="village_name">Village Name:</label><br>
                                <input type="text" class="form-control input-default" id="village_name" placeholder="Database name and village name will be same" name="village_name" required><br><br>

                                <label for="admin_email">Village Admin Email:</label><br>
                                <input type="email" id="admin_email" name="admin_email" class="form-control input-default" required><br><br>

                                <label for="admin_pass">Village Admin Password:</label><br>
                                <input type="password" id="admin_pass" name="admin_pass" class="form-control input-default" required><br><br>

                                <input type="submit" class="btn btn-primary mb-5" value="Create Village">
                            </form>


                        </div>
                    </div>
                </div>
            </div>

            <!-- Loader and Overlay elements -->
            <div class="overlay" id="overlay"></div>
            <div class="loader" id="loader"></div>
            <div id="loader-text" class="loader-text" style="align-items: center; align-text:center;">Please wait, do not refresh the page...</div>


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




        </div>
        <!--**********************************
        Main wrapper end
    ***********************************-->




        <!--**********************************
        Scripts
    ***********************************-->



        <script>
            document.querySelector('form').addEventListener('submit', function(event) {
                // Show loader, overlay, and "do not refresh" text
                document.getElementById('loader').style.display = 'block';
                document.getElementById('overlay').style.display = 'block';
                document.getElementById('loader-text').style.display = 'block';

                // Disable form submission (for demo purpose, remove this line in production)
                // event.preventDefault();
            });
        </script>


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