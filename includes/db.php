<?php
// Database configuration
$db_host = 'localhost';
$db_name = 'clients_form';
$db_user = 'root';
$db_pass = '';

try {
    // Create PDO instance
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}