<?php
// Add error handling at the top
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'errors.log');

// Ensure this is at the very top
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';

// Verify database connection
if (!verifyConnection()) {
    die("Database connection failed. Please try again later.");
}

try {
    // Get categories for navigation
    $stmt = $pdo->query("SELECT DISTINCT category FROM blog_posts ORDER BY category");
    $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch(PDOException $e) {
    error_log("Error fetching categories: " . $e->getMessage());
    $categories = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Marketing Agency</title>
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/blog.css">
    <link rel="stylesheet" href="../assets/css/post.css">
    <link rel="stylesheet" href="../assets/css/footer.css">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="../assets/images/favicon.png" type="image/png">
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
                <a href="../blog/blog.php" class="navbar-link">All Posts</a>
                <div class="dropdown">
                    <button class="navbar-link dropdown-toggle">
                        Categories <i class='bx bx-chevron-down'></i>
                    </button>
                    <ul class="dropdown-menu">
                        <?php
                        try {
                            if (verifyConnection()) {
                                $stmt = $pdo->query("SELECT DISTINCT category FROM blog_posts ORDER BY category");
                                $categories = $stmt->fetchAll(PDO::FETCH_COLUMN);
                                
                                foreach($categories as $category): ?>
                                    <li>
                                        <a href="../blog/blog.php?category=<?php echo urlencode($category); ?>" 
                                           class="category-link">
                                            <?php echo htmlspecialchars($category); ?>
                                        </a>
                                    </li>
                                <?php endforeach;
                            }
                        } catch(Exception $e) {
                            error_log("Category Query Error: " . $e->getMessage());
                        }
                        ?>
                    </ul>
                </div>
                <div class="nav-cta">
                <a href="#" class="contact-trigger btn btn-sm">Contact Us</a>
                </div>
            </nav>
            
            <button class="bx bx-menu" id="menu-icon" aria-label="Toggle menu"></button>
        </div> 
    </div>
</header>