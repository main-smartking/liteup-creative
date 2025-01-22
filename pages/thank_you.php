<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Liteup Creative</title>
    <link rel="icon" href="../assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/utilities.css">
    <style>
        @keyframes slideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes checkmark {
            0% { 
                transform: scale(0) rotate(5deg); 
            }
            50% { 
                transform: scale(1.2) rotate(5deg); 
            }
            100% { 
                transform: scale(1) rotate(5deg); 
            }
        }

        .thank-you-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            background: linear-gradient(135deg, var(--clr-white) 0%, var(--clr-sky-blue2) 100%);
        }

        .thank-you-content {
            max-width: 600px;
            padding: 60px;
            border-radius: 20px;
            background: var(--clr-white);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            text-align: left;
            animation: slideUp 0.8s ease-out;
            position: relative;
            overflow: hidden;
        }

        .check-icon {
            width: 85px;
            height: 85px;
            background: transparent;
            border: 2px solid var(--clr-sky-blue);
            border-radius: 15px; /* Changed from 50% to 15px */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0 40px;
            color: var(--clr-sky-blue);
            font-size: 60px;
            animation: checkmark 0.5s ease-out 0.3s both;
            box-shadow: 0 10px 20px rgba(0,171,240,0.2);
            transform: rotate(5deg); /* Added slight rotation for visual interest */
        }

        .title {
            color: var(--clr-sky-blue);
            margin-bottom: 30px;
            font-size: 42px;
            line-height: 1.2;
            position: relative;
            animation: slideUp 0.8s ease-out 0.5s both;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 3px;
            background: var(--clr-sky-blue);
            border-radius: 2px;
        }

        .message {
            color: var(--clr-gray);
            margin-bottom: 40px;
            line-height: 1.8;
            font-size: 18px;
            animation: slideUp 0.8s ease-out 0.7s both;
        }

        .home-btn {
            display: inline-block;
            padding: 18px 40px;
            background: var(--clr-sky-blue);
            color: var(--clr-white);
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 16px;
            border: 1px solid var(--clr-sky-blue);
            animation: slideUp 0.8s ease-out 0.9s both;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .home-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: var(--clr-white);
            transition: all 0.3s ease;
            z-index: -1;
        }

        .home-btn:hover {
            color: var(--clr-sky-blue);
        }

        .home-btn:hover::before {
            width: 100%;
        }

        @media (max-width: 768px) {
            .thank-you-content {
                padding: 30px;
                text-align: center;
            }
            
            .check-icon {
                margin: 0 auto 30px;
            }
            
            .title {
                font-size: 32px;
            }

            .title::after {
                left: 50%;
                transform: translateX(-50%);
            }
            
            .message {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="thank-you-content">
            <div class="check-icon">✓</div>
            <h1 class="title">Thank You for Choosing Liteup Creative Concept!</h1>
            <p class="message">
                Your submission has been received successfully. Our team will review your information 
                and get back to you within 24 hours. We're excited to work with you!
            </p>
            <a href="index.php" class="home-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>