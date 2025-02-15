<?php
header('Content-Type: application/json');
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'message' => ''];
    
    try {
        // Validate inputs
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

        // Make sure you have this table in your database
        $sql = "INSERT INTO contacts (name, email, subject, message, created_at) 
                VALUES (:name, :email, :subject, :message, NOW())";
        
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':subject' => $subject,
            ':message' => $message
        ])) {
            $response['success'] = true;
            $response['message'] = 'Message sent successfully!';
        } else {
            throw new Exception('Failed to send message');
        }
    } catch(Exception $e) {
        error_log("Contact Form Error: " . $e->getMessage());
        $response['message'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit;
}

http_response_code(400);
echo json_encode(['success' => false, 'message' => 'Invalid request method']);
exit;
?>