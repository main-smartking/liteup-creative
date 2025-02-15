<?php
// Add error handling at the top
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'errors.log');

require_once __DIR__ . '/path_helper.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liteup Creative</title>
    <link rel="stylesheet" href="../assets/css/variables.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/about.css">
    <link rel="stylesheet" href="../assets/css/blog.css">
    <link rel="stylesheet" href="../assets/css/post.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="icon" href="../assets/images/favicon.png" type="image/png">
    <link rel="stylesheet" href="<?php echo getAssetPath('assets/css/modal.css'); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="description" content="Digital Marketing Agency specializing in business growth and customer engagement">
    <meta name="keywords" content="digital marketing, SEO, web development, social media marketing">
    <meta name="author" content="LiteUp Creative">
    <meta property="og:title" content="Digital Marketing Agency">
    <meta property="og:description" content="Your digital marketing solution">
    <meta property="og:image" content="assets/images/logo.png">
</head>
<body>
   <header class="navbar" id="navbar-section">
    <div class="navbar-container">
        <div class="navbar-header main-wrapper">
            <a href="https://www.liteupcreative.com">
                <img src="../assets/images/logo.png" class="navbar-logo" alt="Liteup Creative logo" loading="lazy">
            </a>
            
            <nav class="navbar-menu" aria-label="Main navigation">
                <a href="#starting" class="navbar-link active">Home</a>
                <a href="#services" class="navbar-link">What we do</a>
                <a href="#about" class="navbar-link">Who we are</a>
                <a href="#our-blog" class="navbar-link">Our Blog</a>
                <div class="nav-cta">
                <a class="btn btn-sm menu" aria-label="Get Started" href="client">Get Started</a>

                </div>
            </nav>
            
            <button class="bx bx-menu" id="menu-icon" aria-label="Toggle menu"></button>
        </div> 
    </div>
</header>