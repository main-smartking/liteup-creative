<?php
// Define base URL based on environment
function getBaseURL() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    
    // Check if we're in development or production
    if ($host === 'localhost') {
        return $protocol . $host . '/liteup-creative';
    } else {
        return $protocol . $host;
    }
}

define('BASE_URL', getBaseURL());
?>