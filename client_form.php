<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Client Form</title>
    <link rel="stylesheet" href="assets/css/apply.css">
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
</head>
<body> 
    <main>
     <div class="main-container">      
        <div class="form-container">
          <img src="assets/images/logo.png" alt="logo">
          <h1 class="title-header">Welcome to The Result Driven Agency</h1>
          <p class="description mb20">Kindly fill your details below and 
            select the appropriate service
          </p>
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

            <!-- <p class="success-msg"> Thank you for reaching out to us, kindly wait for our responds</p> -->
            <input type="submit" name="submit" class="btn w100 mb20 mt10" value="Click to Submit">
            <a href="index.php" target="_blank">Back to main site</a>
          </form>
        </div>
      </div>
    </main>
    <script src="assets/js/scripts.js"></script>  <!-- JavaScript file -->
</body>
</html>
