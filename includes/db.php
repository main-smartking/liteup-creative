<?php
// Database configuration
$db_host = 'localhost'; // Change this to your hosting MySQL server
$db_name = 'clients_form';
$db_user = 'root';
$db_pass = '';

try {
    // Create PDO connection with proper MySQL socket path
    $pdo = new PDO(
        "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4",
        $db_user,
        $db_pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch(PDOException $e) {
    // Log error and show user-friendly message
    error_log("Database Connection Error: " . $e->getMessage());
    die("We're experiencing technical difficulties. Please try again later.");
}
?>