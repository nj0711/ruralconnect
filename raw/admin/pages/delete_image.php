<?php
// Include database connection
include '../config.php';


// Check if the image parameter is set
if (isset($_GET['image'])) {
    $image = $_GET['image'];
    $id=$_GET['updateid'];
    $tablename=$_GET['tablename'];
    // Define the path to the image
    $imagePath = 'uploadedimages/' . $image;

    // Check if the file exists and delete it
    if (file_exists($imagePath)) {
        unlink($imagePath);

        // Update the database to remove the image reference
        // Example code to remove the image from the database
        $obj = new ConnDb();

// Select the existing Photo column for the given record
$selQ = "SELECT photo FROM {$tablename} WHERE {$tablename}id = " . $id;
$res = $obj->selectdata($tablename, $selQ);

// echo $id;
// Assuming the Photo column contains a JSON array of image names
$p = $res[0]['photo'];
$array = json_decode($p, true);  // Decode the JSON into an array

// Filter out the image that you want to delete
$array = array_filter($array, function($item) use ($image) {
    return $item !== $image;
});

// Re-encode the array into a JSON string without keys
$enarr = json_encode(array_values($array));  // Use array_values to reset keys

// Update the Photo column with the new JSON array
$q = "UPDATE {$tablename} SET photo = '" . $enarr . "' WHERE {$tablename}id = " . $id;
$res2 = $obj->updatedata($tablename, $q);

// Redirect back to the previous page or a success page
header('Location: '.$tablename.'.php?updateid='.$id);
exit();

    } else {
        // File does not exist
        echo 'File not found';
    }
} else {
    // Invalid input
    echo 'Invalid input';
}