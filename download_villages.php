<?php
// Step 1: Database connection (Adjust with your database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'villageonweb_admin_panel';

// Create connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Fetch village names from the database
$sql = "SELECT village_name FROM villages";
$result = mysqli_query($conn, $sql);

// Step 3: Generate CSV file dynamically
if (mysqli_num_rows($result) > 0) {
    // Open a temporary file in write mode
    $filename = "villages_list_" . date('Y-m-d_H-i-s') . ".csv";
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '"');

    $output = fopen('php://output', 'w');

    // Add column headers to CSV
    fputcsv($output, array('Village Name'));

    // Fetch and write each row to the CSV
    while ($row = mysqli_fetch_assoc($result)) {
        fputcsv($output, $row);
    }

    fclose($output);
} else {
    echo "No villages found!";
}

// Close the database connection
mysqli_close($conn);
?>
