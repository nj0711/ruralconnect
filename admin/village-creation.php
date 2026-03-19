<?php
set_time_limit(0);
include('config.php');
session_start();

if (!isset($_SESSION['admin_email'])) {
    header("Location: index.php");
    exit();
}

// Session timeout
$timeout_duration = 600;
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();

// Function to recursively copy files and subdirectories
function copyDirectory($source, $destination)
{
    if (!is_dir($source)) return false;
    @mkdir($destination, 0777, true);

    $iterator = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );

    foreach ($iterator as $item) {
        $destPath = $destination . DIRECTORY_SEPARATOR . $iterator->getSubPathName();
        if ($item->isDir()) {
            @mkdir($destPath, 0777, true);
        } else {
            copy($item->getPathname(), $destPath);
        }
    }
    return true;
}

// Function to execute only selected tables from SQL file
function executeSelectedTablesFromSql($conn, $filePath, $allowedTables = [])
{
    if (!file_exists($filePath)) {
        echo "<script>alert('SQL file not found: $filePath');</script>";
        return;
    }

    $sql = file_get_contents($filePath);
    $queries = array_filter(array_map('trim', explode(';', $sql)));

    $createdCount = 0;
    foreach ($queries as $query) {
        if (empty($query)) continue;

        if (preg_match('/CREATE\s+TABLE\s+(IF\s+NOT\s+EXISTS\s+)?[`"]?([a-zA-Z0-9_]+)[`"]?/i', $query, $matches)) {
            $tableName = strtolower($matches[2]);

            if (in_array($tableName, array_map('strtolower', $allowedTables))) {
                if (!mysqli_query($conn, $query . ';')) {
                    echo "<script>console.log('Error creating table $tableName: " . mysqli_error($conn) . "');</script>";
                } else {
                    $createdCount++;
                }

                if ($createdCount >= count($allowedTables)) break;
            }
        }
    }
}

// ========== FORM SUBMISSION ==========
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize inputs
    $villageName = strtolower(trim(mysqli_real_escape_string($conn, $_POST['village_name'])));
    $dbHost      = trim(mysqli_real_escape_string($conn, $_POST['db_host']));
    $dbName      = trim(mysqli_real_escape_string($conn, $_POST['db_name']));
    $dbUser      = trim(mysqli_real_escape_string($conn, $_POST['db_user']));
    $dbPass      = trim($_POST['db_pass']); // Password not escaped (can contain special chars)
    $adminEmail  = trim(mysqli_real_escape_string($conn, $_POST['admin_email']));
    $adminPass   = trim($_POST['admin_pass']);

    $salt = "villageonweb";
    $password_encrypted = sha1($adminPass . $salt);

    // Validate required fields
    if (empty($villageName) || empty($dbName) || empty($adminEmail) || empty($adminPass)) {
        echo "<script>alert('All fields are required.');</script>";
        goto end_form;
    }

    // Handle image upload
    $villageImg = '';
    if (isset($_FILES['village_img']) && $_FILES['village_img']['error'] == UPLOAD_ERR_OK) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $maxFileSize = 5 * 1024 * 1024; // 5MB
        $fileType = $_FILES['village_img']['type'];
        $fileSize = $_FILES['village_img']['size'];
        $fileTmpName = $_FILES['village_img']['tmp_name'];
        $fileName = $_FILES['village_img']['name'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newFileName = $villageName . '_' . time() . '.' . $fileExt;
        $uploadPath = '../assets/image/village_image/' . $newFileName;

        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('Invalid file type. Only JPG, PNG, GIF allowed.');</script>";
            goto end_form;
        }
        if ($fileSize > $maxFileSize) {
            echo "<script>alert('File size exceeds 5MB.');</script>";
            goto end_form;
        }
        if (!move_uploaded_file($fileTmpName, $uploadPath)) {
            echo "<script>alert('Failed to upload image.');</script>";
            goto end_form;
        }
        $villageImg = 'assets/image/village_image/' . $newFileName;
    } else {
        echo "<script>alert('Please upload a village image.');</script>";
        goto end_form;
    }

    // Prevent duplicate village
    $villageFolder = '../villages/' . $villageName;
    if (is_dir($villageFolder)) {
        echo "<script>alert('Village already exists!');</script>";
        goto end_form;
    }

    // ========== STEP 1: Connect to Admin Panel DB ==========
    $adminPanelConn = mysqli_connect($dbHost, $dbUser, $dbPass, 'ruralconnectadmin_panel');
    if (!$adminPanelConn) {
        die("Admin DB Connection failed: " . mysqli_connect_error());
    }

    // ========== STEP 2: Insert into `villages` table ==========
    $insertVillageQuery = "INSERT INTO villages 
        (village_name, db_host, db_name, db_user, db_pass, admin_email, admin_pass, village_img) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    // Use prepared statement for security
    $stmt = mysqli_prepare($adminPanelConn, $insertVillageQuery);
    mysqli_stmt_bind_param($stmt, "ssssssss", $villageName, $dbHost, $dbName, $dbUser, $dbPass, $adminEmail, $password_encrypted, $villageImg);
    if (!mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Error saving village info: " . mysqli_error($adminPanelConn) . "');</script>";
        mysqli_stmt_close($stmt);
        mysqli_close($adminPanelConn);
        goto end_form;
    }
    $villageId = mysqli_insert_id($adminPanelConn);
    mysqli_stmt_close($stmt);

    // ========== STEP 3: Create Database (Only Once) ==========
    $sql = "CREATE DATABASE IF NOT EXISTS `$dbName`";
    if (!mysqli_query($adminPanelConn, $sql)) {
        echo "<script>alert('Error creating database: " . mysqli_error($adminPanelConn) . "');</script>";
        mysqli_close($adminPanelConn);
        goto end_form;
    }

    // ========== STEP 4: Switch to Village DB ==========
    mysqli_close($adminPanelConn);
    $villageConn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);
    if (!$villageConn) {
        die("Village DB Connection failed: " . mysqli_connect_error());
    }

    // ========== STEP 5: Create Required Tables ==========
    $sqlFilePath = __DIR__ . '/schemas/create.sql';
    $tablesToCreate = ['admin', 'contacts', 'villagebasic'];
    executeSelectedTablesFromSql($villageConn, $sqlFilePath, $tablesToCreate);

    // ========== STEP 6: Insert Admin with AdminID ==========
    $insertAdminQuery = "INSERT INTO admin (email, passwordhash, AdminID) 
                         VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($villageConn, $insertAdminQuery);
    mysqli_stmt_bind_param($stmt, "ssi", $adminEmail, $password_encrypted, $villageId);
    if (!mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Error inserting admin: " . mysqli_error($villageConn) . "');</script>";
        mysqli_stmt_close($stmt);
        mysqli_close($villageConn);
        goto end_form;
    }
    mysqli_stmt_close($stmt);

    // ========== STEP 7: Insert into villagebasic ==========
    $insertBasic = "INSERT INTO villagebasic (AdminID, Name) VALUES (?, ?)";
    $stmt = mysqli_prepare($villageConn, $insertBasic);
    mysqli_stmt_bind_param($stmt, "is", $villageId, $villageName);
    if (!mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Error inserting village basic info: " . mysqli_error($villageConn) . "');</script>";
    }
    mysqli_stmt_close($stmt);

    // ========== STEP 8: Create Village Folder & Copy Files ==========
    if (!mkdir($villageFolder, 0755, true)) {
        echo "<script>alert('Failed to create village folder.');</script>";
        mysqli_close($villageConn);
        goto end_form;
    }

    $source = '../raw/';
    if (!copyDirectory($source, $villageFolder)) {
        echo "<script>alert('Failed to copy village files.');</script>";
        mysqli_close($villageConn);
        goto end_form;
    }

    // ========== STEP 9: Write config.php for Village ==========
    $configContent = "<?php
    \$db = \"$dbName\";

    class ConnDb {
        private \$server = \"$dbHost\";
        private \$user = \"$dbUser\";
        private \$user_pass = \"$dbPass\";
        public \$mysqli = null;
        public \$conn = false;
        private \$result = array();
        private \$db;

        public function __construct() {
            global \$db;
            \$this->db = \$db;

            if (!\$this->conn) {
                \$this->mysqli = new mysqli(\$this->server, \$this->user, \$this->user_pass);
                if (\$this->mysqli->connect_error) {
                    array_push(\$this->result, \$this->mysqli->connect_error);
                    \$this->conn = false;
                    return;
                }

                if (\$this->databaseExists(\$this->db)) {
                    \$this->mysqli = new mysqli(\$this->server, \$this->user, \$this->user_pass, \$this->db);
                    \$this->conn = true;
                }
            }
        }

        public function databaseExists(\$db) {
            \$sql = \"SHOW DATABASES LIKE '\$db'\";
            \$res = \$this->mysqli->query(\$sql);
            return \$res && \$res->num_rows == 1;
        }

        public function tableExists(\$table) {
            \$sql = \"SHOW TABLES FROM \$this->db LIKE '\$table'\";
            \$res = \$this->mysqli->query(\$sql);
            return \$res && \$res->num_rows == 1;
        }

        public function insertdata(\$table, \$values) {
            if (\$this->tableExists(\$table)) {
                return \$this->mysqli->query(\$values) ? \"Data Inserted.\" : \"Error: \" . \$this->mysqli->error;
            }
            return \"Table \$table does not exist!\";
        }

        public function insertdata2(\$table, \$values) {
            if (\$this->tableExists(\$table)) {
                \$this->mysqli->query(\$values);
                return \$this->mysqli->insert_id;
            }
            return 0;
        }

        public function selectdata(\$table, \$values) {
            if (\$this->tableExists(\$table) && \$res = \$this->mysqli->query(\$values)) {
                \$data = [];
                while (\$row = \$res->fetch_assoc()) \$data[] = \$row;
                return !empty(\$data) ? \$data : 'No Data Found!';
            }
            return 'Table does not exist!';
        }

        public function updatedata(\$table, \$values) {
            return \$this->tableExists(\$table) && \$this->mysqli->query(\$values);
        }

        public function deletedata(\$table, \$values) {
            return \$this->tableExists(\$table) && \$this->mysqli->query(\$values);
        }

        public function escape(\$value) {
            return \$this->mysqli->real_escape_string(\$value);
        }

        public function __destruct() {
            if (\$this->mysqli) \$this->mysqli->close();
        }
    }
    ?>";

    if (!file_put_contents($villageFolder . '/admin/config.php', $configContent)) {
        echo "<script>alert('Failed to write config.php');</script>";
        mysqli_close($villageConn);
        goto end_form;
    }

    mysqli_close($villageConn);

    // Success!
    echo "<script>alert('Village \"$villageName\" created successfully!'); window.location='villages.php';</script>";
    exit;
}

end_form:
ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Village Creation | Super Admin Panel</title>
    <link rel="shortcut icon" type="image/png" href="images/villagelogo.png">
    <link href="vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <style>
        .loader,
        .overlay,
        .loader-text {
            display: none;
        }

        .loader {
            position: fixed;
            z-index: 9999;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            border: 16px solid #f3f3f3;
            border-top: 16px solid #3498db;
            border-radius: 50%;
            width: 120px;
            height: 120px;
            animation: spin 2s linear infinite;
        }

        .overlay {
            position: fixed;
            z-index: 9998;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .loader-text {
            position: fixed;
            z-index: 9999;
            top: 60%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <?php include('header.php'); ?>

        <div class="content-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="basic-form">
                            <h2>Add New Village</h2>
                            <hr>
                            <form method="POST" enctype="multipart/form-data" id="villageForm">
                                <h3>Database Details</h3><br>
                                <label>Database Host:</label>
                                <input type="text" class="form-control" name="db_host" value="localhost" required><br><br>

                                <label>Database Name:</label>
                                <input type="text" class="form-control" name="db_name" required><br><br>

                                <label>Database Username:</label>
                                <input type="text" class="form-control" name="db_user" required><br><br>

                                <label>Database Password:</label>
                                <input type="password" class="form-control" name="db_pass"><br><br>

                                <h3>Village Details</h3><br>
                                <label>Village Name:</label>
                                <input type="text" class="form-control" name="village_name" placeholder="Will be used as folder & DB prefix" required><br><br>

                                <label>Village Admin Email:</label>
                                <input type="email" class="form-control" name="admin_email" required><br><br>

                                <label>Village Admin Password:</label>
                                <input type="password" class="form-control" name="admin_pass" required><br><br>

                                <label>Village Image:</label>
                                <input type="file" class="form-control" name="village_img" accept="image/jpeg,image/png,image/gif" required><br><br>

                                <button type="submit" class="btn btn-primary">Create Village</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer">
            <div class="copyright">
                <p>© Copyright <?php echo date("Y"); ?> by Sadar Patel University</p>
            </div>
        </div>
    </div>

    <!-- Loader Elements -->
    <div class="overlay" id="overlay"></div>
    <div class="loader" id="loader"></div>
    <div class="loader-text" id="loader-text">Please wait, do not refresh the page...</div>

    <script>
        document.getElementById('villageForm').addEventListener('submit', function() {
            document.getElementById('loader').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
            document.getElementById('loader-text').style.display = 'block';
        });
    </script>

    <script src="vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script>
</body>

</html>