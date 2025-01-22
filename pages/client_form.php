<?php
require_once '../includes/db.php';

// Initialize variables
$success_message = '';
$error_message = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING);
    $service = filter_input(INPUT_POST, 'services', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);

    // Validate inputs
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($service) || empty($gender)) {
        $error_message = "All fields are required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        try {
            // Check for existing email
            $stmt = $pdo->prepare("SELECT email FROM clients WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $error_message = "Email already exists";
            } else {
                // Check for existing phone
                $stmt = $pdo->prepare("SELECT phone FROM clients WHERE phone = ?");
                $stmt->execute([$phone]);
                if ($stmt->rowCount() > 0) {
                    $error_message = "Phone number already exists";
                } else {
                    // Insert new client
                    $sql = "INSERT INTO clients (firstname, lastname, email, phone, service, gender) 
                           VALUES (:firstname, :lastname, :email, :phone, :service, :gender)";
                    
                    $stmt = $pdo->prepare($sql);
                    
                    if ($stmt->execute([
                        ':firstname' => $firstname,
                        ':lastname' => $lastname,
                        ':email' => $email,
                        ':phone' => $phone,
                        ':service' => $service,
                        ':gender' => $gender
                    ])) {
                        // Redirect to thank you page after successful submission
                        header("Location: thank_you.php");
                        exit();
                    } else {
                        $error_message = "Error submitting form. Please try again.";
                    }
                }
            }
        } catch(PDOException $e) {
            $error_message = "Database error. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Form</title>
    <link rel="stylesheet" href="../assets/css/client.css">
    <link rel="icon" href="../assets/images/favicon.png" type="images/png">
</head>
<body> 
    <main>
        <div class="main-container">

            <div class="form-container">
                <h1 class="title-header mb10">Hi! You've Made the Right Choice</h1>
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

                <form method="post">
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
        </div>
    </main>
    <script src="assets/js/scripts.js"></script>  <!-- JavaScript file -->
</body>
</html>
