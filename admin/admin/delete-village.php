<?php

include_once("config.php");

// Check if the village name is provided in the URL
if (isset($_GET['village'])) {
    $villageName = strtolower($_GET['village']);
    $errors = [];

    // Step 1: Delete the village folder
    if (!deleteVillageFolder($villageName)) {
        $errors[] = "Failed to delete village folder.";
    }

    // Step 2: Delete the village entry from the admin_panel database
    if (!deleteVillageEntry($villageName, $conn)) {
        $errors[] = "Failed to delete village entry from the database.";
    }

    // Step 3: Drop the village-specific database
    if (!deleteVillageDatabase($villageName, $conn)) {
        $errors[] = "Failed to delete the village-specific database.";
    }

    // Close connection
    mysqli_close($conn);

    // Check for errors
    if (empty($errors)) {
        // Successful deletion
        echo "<script>
                alert('Village deleted successfully.');
                window.location.href = 'village-admins.php';
              </script>";
    } else {
        // Unsuccessful deletion
        $errorMessage = implode("\\n", $errors); // Combine errors into one message with new lines
        echo "<script>
                alert('$errorMessage');
                window.location.href = 'village-admins.php';
              </script>";
    }
    exit();
} else {
    echo "No village specified.";
}

// Function to delete the folder
function deleteVillageFolder($villageName) {
    $folderPath = "/home/hownewsx/village.hownews.xyz/villages/" . $villageName;

    if (!is_dir($folderPath)) {
        return false;
    }

    function deleteDirectory($dir) {
        if (!file_exists($dir)) return true;
        if (!is_dir($dir) || is_link($dir)) return unlink($dir);
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') continue;
            if (!deleteDirectory($dir . "/" . $item)) return false;
        }
        return rmdir($dir);
    }

    return deleteDirectory($folderPath);
}

// Function to delete the village entry from the database
function deleteVillageEntry($villageName, $conn) {
    $sql = "DELETE FROM villages WHERE village_name = '$villageName'";
    return mysqli_query($conn, $sql);
}

// Function to drop the village database
function deleteVillageDatabase($villageName, $conn) {
    $fullDbName = "hownewsx_" . $villageName;
    $sql = "DROP DATABASE `$fullDbName`";
    return mysqli_query($conn, $sql);
}
?>
