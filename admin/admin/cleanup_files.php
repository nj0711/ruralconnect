<?php
// List of files to check and delete
$filesToDelete = [
    __DIR__ . '/forgot-account.php',
    __DIR__ . '/update-account.php'
];

// Timeout duration in seconds (e.g., 1 hour)
$timeout = 3600;

foreach ($filesToDelete as $filePath) {
    if (file_exists($filePath)) {
        // Get the last modification time of the file
        $fileModTime = filemtime($filePath);

        // Check if the file's modification time exceeds the timeout
        if ((time() - $fileModTime) > $timeout) {
            // Attempt to delete the file
            if (unlink($filePath)) {
                echo "File deleted successfully: " . basename($filePath) . PHP_EOL;
            } else {
                echo "Failed to delete file: " . basename($filePath) . PHP_EOL;
            }
        } else {
            echo "File not old enough to delete: " . basename($filePath) . PHP_EOL;
        }
    } else {
        echo "File does not exist: " . basename($filePath) . PHP_EOL;
    }
}
?>
