<?php
session_start();

// Check if coming from form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_SESSION['form_submitted'])) {
    header("Location: client_form.php");
    exit();
}

// Process form data here if needed
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form submission
    // Set session if needed
    $_SESSION['form_submitted'] = true;
}

// Clear the session variable
unset($_SESSION['form_submitted']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/liteup-creative/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Liteup Creative</title>
    <link rel="icon" href="./assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="./assets/css/variables.css">
    <style>
        .thank-you-container {
            min-height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .thank-you-content {
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 0.8s ease forwards;
            max-width: 600px;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .title {
            color: var(--clr-sky-blue);
            font-size: 58px;
            margin-bottom: 20px;
            font-weight: 700;
            max-width: 400px;
            margin: 0 auto;
        }

        .message {
            color: #666;
            font-size: 16px;
            max-width: 450px;
            margin: 0px auto;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .home-btn {
            display: inline-block;
            padding: 12px 30px;
            background: var(--clr-sky-blue);
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .home-btn:hover {
            background-color: #0088cc;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="thank-you-content">
            <h1 class="title">Thank You Great Mind!</h1>
            <p class="message">
                Your submission has been received. Our team is working on it and will get back to you soon. Thank you for choosing Liteup Creative.
            </p>
            <a href="/index.php" class="home-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>