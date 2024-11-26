<?php
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = 'path/to/your/file/' . basename($file); // Path to the file

    // Check if the file exists
    if (file_exists($filePath) && is_readable($filePath)) {
        // Set headers to download the file
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        flush(); // Flush system output buffer
        readfile($filePath); // Read the file and send it to the browser
        exit;
    } else {
        echo "File does not exist or cannot be read: " . htmlspecialchars($filePath);
    }
} else {
    echo "No file to download.";
}
?>