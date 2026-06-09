<?php
$filePath = './';

// 1. Verify that the file exists locally
if (file_exists($filePath)) {
    
    // 2. Clear any existing output buffering
    clean_all_buffers(); 

    // 3. Set the appropriate Content-Type header
    header('Content-Type: application/rtf');

    // 4. Send the file length header for a precise progress bar
    header('Content-Length: ' . filesize($filePath));

    // 5. Output the binary data stream
    readfile($filePath);
    exit;
} else {
    // Return a 404 response if the file cannot be located
    http_response_code(404);
    echo "File not found.";
}

// Helper function to stop output corruption
function clean_all_buffers() {
    while (ob_get_level()) {
        ob_end_clean();
    }
}
