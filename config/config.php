<?php
// Define base URL based on environment
function getBaseURL() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    
    // Remove the subdirectory reference
    return $protocol . $host;
}

define('BASE_URL', getBaseURL());
?>