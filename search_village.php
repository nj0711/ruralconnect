<?php
if (isset($_GET['village_name'])) {
    // Get the search term from the query string
    $villageName = strtolower(trim($_GET['village_name'])); // Ensure lowercase for matching
    // Redirect to the village page with the village name in the URL
    header("Location: /villages/" . urlencode($villageName)); 
    exit(); // Always call exit after header redirect to prevent further code execution
}
?>