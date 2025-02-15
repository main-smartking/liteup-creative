<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        // Log incoming data
        error_log('Received POST data: ' . print_r($_POST, true));
        
        if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
            throw new Exception('All fields are required');
        }
        
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format');
        }
        
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars(trim($_POST['subject']));
        $message = htmlspecialchars(trim($_POST['message']));

        // Log database connection status
        if (!isset($pdo)) {
            throw new Exception('Database connection not established');
        }

        $sql = "INSERT INTO contacts (name, email, subject, message, created_at) 
                VALUES (:name, :email, :subject, :message, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ]);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Message sent successfully!';
        } else {
            throw new Exception('Database insert failed');
        }
    } catch(Exception $e) {
        error_log("Contact Form Error: " . $e->getMessage());
        $response['message'] = $e->getMessage();
        http_response_code(400);
    }
    
    echo json_encode($response);
    exit;
}

http_response_code(405);
echo json_encode(['success' => false, 'message' => 'Invalid request method']);
exit;