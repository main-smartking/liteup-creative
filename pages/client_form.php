<?php
session_start(); // Add this at the top
require_once '../config/config.php';
require_once '../includes/db.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize variables
$success_message = '';
$error_message = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs using newer methods
    $firstname = htmlspecialchars(trim($_POST['firstname'] ?? ''));
    $lastname = htmlspecialchars(trim($_POST['lastname'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $service = htmlspecialchars(trim($_POST['services'] ?? ''));
    $gender = htmlspecialchars(trim($_POST['gender'] ?? ''));

    // Validate inputs
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($service) || empty($gender)) {
        $error_message = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        try {
            $sql = "INSERT INTO clients (firstname, lastname, email, phone, service, gender, created_at) 
                   VALUES (:firstname, :lastname, :email, :phone, :service, :gender, NOW())";
            
            $stmt = $pdo->prepare($sql);
            
            if ($stmt->execute([
                ':firstname' => $firstname,
                ':lastname' => $lastname,
                ':email' => $email,
                ':phone' => $phone,
                ':service' => $service,
                ':gender' => $gender
            ])) {
                $_SESSION['form_submitted'] = true; // Set session variable
                header("Location: thank-you"); // Changed from ../thank-you
                exit();
            } else {
                $error_message = "Error submitting form. Please try again.";
            }
        } catch(PDOException $e) {
            $error_message = "Database error: " . $e->getMessage();
            error_log("Client Form Error: " . $e->getMessage());
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <base href="/liteup-creative/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="assets/css/client.css">
</head>
<body> 
    <main>
            <div class="form-container">
                <h1 class="title-header mb10">Hey! You've Made the Right Choice</h1>
                <p class="description mb20">Kindly fill your details below and 
                    select the appropriate service
                </p>

                <?php if (!empty($error_message)): ?>
                    <div class="error-message mb20">
                        <?php echo htmlspecialchars($error_message); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($success_message)): ?>
                    <div class="success-msg mb20">
                        <?php echo htmlspecialchars($success_message); ?>
                    </div>
                <?php endif; ?>

                <form method="post" action="">
                    <div class="input-group mb10">
                        <div class="input-wrapper">
                            <input class="input-field" type="text" name="firstname" placeholder autocomplete="given-name" autocapitalize="word" required>
                            <label class="field-label" for="firstname">First Name</label>
                        </div>
                        <div class="input-wrapper">
                            <input class="input-field" type="text" name="lastname" placeholder autocomplete="given-name" autocapitalize="word" required>
                            <label class="field-label" for="lastname">Last Name</label>
                        </div>
                    </div>
                    <div class="input-group mb10">
                        <div class="input-wrapper">
                            <input class="input-field" name="email" placeholder required>
                            <label class="field-label" for="email">Email Address</label>
                        </div>
                        <div class="input-wrapper">
                            <input class="input-field" type="tel" name="phone" placeholder inputmode="tel" required>
                            <label class="field-label" for="phone">Phone Number</label>
                        </div>
                    </div>
                    <select name="services" class="mb20 mt20" id="" required>
                        <option selected disabled> &nbsp;&nbsp; Select Services </option>
                        <option value="Graphic Design"> &nbsp;&nbsp; Graphic Design </option>
                        <option value="UI/UX Design"> &nbsp;&nbsp; UI/UX Design </option>
                        <option value="Facebook Ads"> &nbsp;&nbsp; Facebook Ads </option>
                        <option value="Youtube SEO"> &nbsp;&nbsp; Youtube SEO </option>
                        <option value="Website Management"> &nbsp;&nbsp; Website Management </option>
                        <option value="Social Media Marketting"> &nbsp;&nbsp; Social Media Marketing </option>
                        <option value="Content Marketing"> &nbsp;&nbsp; Content Marketing </option>
                        <option value="Email Marketting"> &nbsp;&nbsp; Email Marketing </option>
                        <option value="Per-Per-Click Ads"> &nbsp;&nbsp; Per-Per-Click Ads </option>
                        <option value="Affiliate Marketing"> &nbsp;&nbsp; Affiliate Marketing </option>
                        <option value="Analytics and Reporting"> &nbsp;&nbsp; Analytics and Reporting </option>
                    </select>
                    <p class="mb10">Select Gender:</p>
                    <div class="input-group mb10">
                        <div class="radio-checkbox-wrapper">
                            <input type="radio" name="gender" value="Male">
                            <label for="gender">Male</label>
                        </div>
                        <div class="radio-checkbox-wrapper">
                            <input type="radio" name="gender" value="Female">
                            <label for="gender">Female</label>
                        </div>
                    </div>

                    <!-- <select name="source" id="">
                        <option value selected disabled> &nbsp;&nbsp; How did you hear of this training?</option>
                        <option value="Radio Advertisement"> &nbsp;&nbsp; Radio Advertisement </option>
                        <option value="TV Advertisement"> &nbsp;&nbsp; TV Advertisement </option>
                        <option value="Whatsapp"> &nbsp;&nbsp; Whatsapp </option>
                        <option value="Twitter"> &nbsp;&nbsp; Twitter </option>
                        <option value="Facebook"> &nbsp;&nbsp; Facebook </option>
                        <option value="Instagram"> &nbsp;&nbsp; Instagram </option>
                        <option value="Tiktok"> &nbsp;&nbsp; Tiktok </option>
                        <option value="Banner/Flyer"> &nbsp;&nbsp; Banner/Flyer </option>
                        <option value="Others"> &nbsp;&nbsp; Others </option>
                    </select> -->

                    <input type="submit" name="submit" class="btn w100 mb20 mt20" value="Click to Submit">
                    <div class="back-to-homepage">
                        <a href="index.php" mt20 >Back to main site</a>
                    </div>
                </form>
            </div>
    </main>
    <script src="assets/js/scripts.js"></script>  <!-- JavaScript file -->
</body>
</html>
