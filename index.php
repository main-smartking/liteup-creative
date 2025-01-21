<?php
// Add error handling at the top
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'errors.log');
?>

<?php
require_once 'includes/blog_function.php';

try {
    // Get latest 3 blog posts for homepage
    $stmt = $blog_pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC LIMIT 3");
    $featured_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $featured_posts = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Marketing Agency</title>
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/breakpoint.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
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
            <a href="/index.php">
                <img src="assets/images/logo.png" class="navbar-logo" alt="Liteup Creative logo" loading="lazy">
            </a>
            
            <nav class="navbar-menu" aria-label="Main navigation">
                <a href="#starting" class="navbar-link active">Start</a>
                <a href="#services" class="navbar-link">What we do</a>
                <a href="#about" class="navbar-link">Who we are</a>
                <a href="#our-blog" class="navbar-link">Our Blog</a>
                <div class="nav-cta">
                <a class="btn btn-sm menu" aria-label="Get Started" href="client_form.php">
    Get Started
                </a>

                </div>
            </nav>
            
            <button class="bx bx-menu" id="menu-icon" aria-label="Toggle menu"></button>
        </div> 
    </div>
</header>

    <!-- Hero Section -->
    <section class="homepage-container main-wrapper" id="starting">
        <!-- Particle.js Background Container -->
        <div id="particles-js"></div>
        
        <div class="homepage">
            <!-- Hero Content -->
            <div class="hero-content">
                <h1 class="mb20">Where Businesses<br>Meet Ready Customers</h1>
                <p>Expand your reach, boost sales, and unlock growth with compelling offers 
                   that deliver results. Drive customer engagement and success with strategies 
                   designed to grow your brand.</p>
            </div>

            <!-- CTA Button -->
            <div>
                <a class="btn" href="client_form.php">Let's Get Started</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="feature-section main-wrapper">   
        <div class="section-header">
            <div class="header-box">
                <div class="header-label">
                    <p>Features</p>
                </div>
                <div class="header-title">
                    <h1>See What Makes Our Service Unique</h1>
                </div>
                <div class="header-subtitle">
                    <p>Features that you can't take off eyes over it</p>
                </div>
            </div>
        </div>
    
        <div class="feature-content feature-one">               
    
            <div class="feature-image box-wrapper">
                <div class="image">
                    <img src="assets/images/website.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Conversion-Focused Web Design</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Revolutionize your online presence with captivating, functional websites. Our designs don’t just attract attention—they convert visitors into customers, driving your business toward unparalleled success.</p>
                        </div>
    
                        <div class="cta-link">
                            <a href="">Get Started<span class="cta-arrow"><i class='bx bx-right-arrow-alt'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

        <div class="feature-content feature-two reverse">               
    
            <div class="feature-image box-wrapper">
                <div class="image">
                    <img src="assets/images/smm-campaign.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Social Media Campaigns</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Dominate the social sphere with precision-targeted campaigns. We design, execute, and optimize strategies that turn clicks into loyal customers, building a vibrant community around your brand.</p>
                        </div>
    
                        <div class="cta-link">
                            <a href="">Get Started<span class="cta-arrow"><i class='bx bx-right-arrow-alt'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

        <div class="feature-content feature-three">               
    
            <div class="feature-image box-wrapper">
                <div class="image">
                    <img src="assets/images/seo-amico.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Search Engine Mastery Optimization (SEO)</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Command the digital stage with expert SEO services. From dominating rankings to driving organic traffic, we ensure your brand is always seen, always relevant, and always growing.</p>
                        </div>
    
                        <div class="cta-link">
                            <a href="">Get Started <span class="cta-arrow"><i class='bx bx-right-arrow-alt'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>

        <div class="feature-content feature-four reverse">               
    
            <div class="feature-image box-wrapper">
                <div class="image">
                    <img src="assets/images/data-driven.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Data-Driven Digital Strategies</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Harness the power of analytics to shape winning campaigns. We transform raw data into actionable insights, creating tailored strategies that amplify your brand’s reach and deliver measurable results.</p>
                        </div>
    
                        <div class="cta-link">
                            <a href="">Get Started <span class="cta-arrow"><i class='bx bx-right-arrow-alt'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>        

        <div class="feature-content feature-five">               
    
            <div class="feature-image box-wrapper">
                <div class="image">
                    <img src="assets/images/brand-construction.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Branding That Resonates</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Craft a lasting identity with expert branding services. We align every detail of your brand—logo, tone, and visuals—to create a magnetic presence that speaks directly to your target audience.</p>
                        </div>
    
                        <div class="cta-link">
                            <a href="">Get Started <span class="cta-arrow"><i class='bx bx-right-arrow-alt'></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
    
        </div>        


    </section>

    <section class="services-section container main-wrapper" id="services">

        <div class="our-services-section-container">

            <div class="section-header">
                <div class="header-box">
                    <div class="header-label">
                        <p>Services</p>
                    </div>
                    <div class="header-title">
                        <h1>What We Can Provide and Beyond</h1>
                    </div>
                    <div class="header-subtitle">
                        <p>The greatest of our deed unto business</p>
                    </div>
                </div>
            </div>

            <div class="services-main-container">

                    <div class="boxes-container">

                        <div class="box">
                              <a href="#" class="content">
                                    <div class="icon">
                                        <i class='bx bxl-html5'></i>
                                    </div>
                                    <h2>Website Development</h2>
                                    <p>Create websites that are easy to use, look great, work fast, and are optimized for SEO.</p>
                              </a>
                        </div>

                        <div class="box">
                                <a href="#" class="content">
                                    <div class="icon">
                                        <i class='bx bx-search-alt-2'></i>
                                    </div>
                                    <h2>Search Engine Optimization</h2>
                                    <p>Improve your website’s search engine ranking with proven SEO</p>
                                </a>
                        </div>

                        <div class="box">
                                <a href="#" class="content">
                                    <div class="icon">
                                        <i class='bx bx-store'></i>
                                    </div>
                                    <h2>Digital Marketing</h2>
                                    <p>Grow your brand online with custom digital marketing strategies, including ads and social media.</p>
                                </a>
                        </div>
                        
                        <div class="box">

                                <a href="#" class="content">
                                    <div class="icon">
                                        <i class='bx bx-mail-send'></i>
                                    </div>
                                    <h2>SMM</h2>
                                    <p>Grow your brand’s presence with targeted social media campaigns with boosting conversions.</p>
                                </a>
                        </div>

                        <div class="box">
                             <a href="#" class="content">
                                    <div class="icon">
                                        <i class='bx bxs-pen'></i>
                                    </div>
                                    <h2>Graphic Design</h2>
                                    <p>Design custom visuals that reflect your brand identity, from logos to marketing materials.</p>
                             </a>
                        </div>

                        <div class="box">
                             <a href="#" class="content">
                                    <div class="icon">
                                        <i class='bx bxs-message-alt-check'></i>
                                    </div>
                                    <h2>Content Marketing</h2>
                                    <p>Craft engaging, high-quality content tailored to your audience.</p>
                              </a>
                        </div>

                    </div>
            </div>
        </div>
 </section>

 <section class="about-section" id="about">

<div class="about-container main-wrapper">
    <div class="about-content">
        <div class="about-image">
            <img src="assets/images/about-team.png" alt="Our Team">
        </div>
        
        <div class="about-details">
            <h3>About Us!</h3>
            <p class="main-text">
                We are your growth companion. At Liteup Creative, we transform businesses through innovative digital solutions, we've also helped numerous brands achieve 
                their digital transformation goals. Best of our habits are but not limited to;
            </p>
            <div class="about-features">
                <div class="feature-item">
                    <i class='bx bx-check-circle'></i>
                    <span>Result-Driven Strategies</span>
                </div>
                <div class="feature-item">
                    <i class='bx bx-check-circle'></i>
                    <span>Innovative Solutions</span>
                </div>
                <div class="feature-item">
                    <i class='bx bx-check-circle'></i>
                    <span>Dedicated Support</span>
                </div>
            </div>
            <a class="btn" href="#about.php">Learn More
</a>
        </div>
    </div>
</div>
</section>

<section class="blog section main-wrapper" id="our-blog">
    <div class="section-header">
        <div class="header-box">
            <div class="header-label">
                <p>blog</p>
            </div>
            <div class="header-title">
                <h1>Read Our Latest Digital Marketing Blog</h1>
            </div>
            <div class="header-subtitle">
                <p>Blogs made for digital marketing expertise</p>
            </div>
        </div>
    </div>

    <div class="blog-container">
        <div class="row">
            <?php if (!empty($featured_posts)): ?>
                <?php foreach($featured_posts as $post): ?>
                    <div class="blog-item padd-15">
                        <div class="blog-item-inner shadow-dark">
                            <div class="blog-img">
                                <?php 
                                    $imagePath = $post['featured_image'] ?? '';
                                    $defaultImage = 'assets/images/default-blog.jpg';
                                    
                                    // Remove '../' if present
                                    $imagePath = str_replace('../', '', $imagePath);
                                    
                                    // If image path is empty or file doesn't exist, use default
                                    if (empty($imagePath) || !file_exists($imagePath)) {
                                        $imagePath = $defaultImage;
                                    }
                                ?>
                                <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                                     alt="<?php echo htmlspecialchars($post['title']); ?>">
                            </div>
                            <div class="blog-info">
                                <div class="blog-meta">
                                    <span class="date">
                                        <?php echo date('F d, Y', strtotime($post['created_at'])); ?>
                                    </span>
                                    <span class="category">
                                        <?php echo htmlspecialchars($post['category']); ?>
                                    </span>
                                </div>
                                <h3 class="blog-title">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </h3>
                                <p class="blog-description">
                                    <?php echo substr(htmlspecialchars($post['content']), 0, 150) . '...'; ?>
                                </p>
                                <a href="blog/post.php?id=<?php echo $post['id']; ?>" class="read-more">
                                    Read More <i class='bx bx-right-arrow-alt'></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="section-button">
        <a href="blog/blog.php" class="btn">View All Posts</a>
    </div>
</section>

<section class="contact-us contact" id="contact">
        <div class="contact-container main-wrapper">
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3905.5050798510365!2d13.191597472306418!3d11.799856813909656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1104a03617ab3d59%3A0xaada1a0d5dee8797!2sTashan%20Bama%20Bus%20Stop!5e0!3m2!1sen!2sng!4v1732714198469!5m2!1sen!2sng" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text">
                        <h4>Say Hello</h4>
                        <p>Liteup Creative<br>Shop NO13 Block (B)<br>New Tashan Bama,<br>Maiduguri<br>Nigeria.</p>
                        <p>Tel: +234 701 129 9203 <br> E: <a class="mail-text" href="mailto:info@liteupcreative.com">info@liteupcreative.com</a>
                        </p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text gray">
                        <div>
                            <h4>Good News</h4>
                            <p>Contact us for any of your promotions and services, we are ready to pilots your brand to it brim</p>
                        </div>   
                        <div>
                        <a class="btn" aria-label="Get Started" href="client_form.php">Reach Out
                        </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>

<?php
require_once 'includes/footer.php';

?>
</body>
</html>
