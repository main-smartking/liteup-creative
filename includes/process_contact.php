<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

$contact_db_config = [
    'host' => 'localhost',
    'dbname' => 'contact_msg_db',
    'username' => 'root',
    'password' => ''
];

try {
    $contact_pdo = new PDO(
        "mysql:host={$contact_db_config['host']};dbname={$contact_db_config['dbname']}",
        $contact_db_config['username'],
        $contact_db_config['password'],
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Debug POST data
        file_put_contents('debug.log', print_r($_POST, true));

        // Validate inputs
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
            throw new Exception('All fields are required');
        }

        // Check if table exists
        $tableCheck = $contact_pdo->query("SHOW TABLES LIKE 'messages'");
        if ($tableCheck->rowCount() == 0) {
            throw new Exception('Database table not found');
        }

        $stmt = $contact_pdo->prepare("
            INSERT INTO messages (name, email, subject, message, ip_address) 
            VALUES (:name, :email, :subject, :message, :ip)
        ");

        $params = [
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':subject' => $_POST['subject'],
            ':message' => $_POST['message'],
            ':ip' => $_SERVER['REMOTE_ADDR']
        ];

        $result = $stmt->execute($params);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Thank you! Your message has been sent successfully.'
            ]);
        } else {
            throw new Exception('Failed to save message');
        }
    }
} catch(Exception $e) {
    error_log("Contact Form Error: " . $e->getMessage());
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
}
?>