<?php
// Add error handling at the top
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'errors.log');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Marketing Agency</title>
    <link rel="stylesheet" href="assets/css/main.css">
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
            <a href="index.php">
                <img src="assets/images/logo.png" class="navbar-logo" alt="Liteup Creative logo" loading="lazy">
            </a>
            
            <nav class="navbar-menu" aria-label="Main navigation">
                <a href="#starting" class="navbar-link active">Starting</a>
                <a href="#services" class="navbar-link">What we do</a>
                <a href="#about" class="navbar-link">Who we are</a>
                <a href="#our-blog" class="navbar-link">Our Blog</a>
                <div class="nav-cta">
                    <button class="btn btn-sm menu" aria-label="Get Started" href="client_form.php";>
                        Get Started
                    </button>
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
                <button class="btn" onclick="window.location.href='client_form.php';">
                    Let's Get Started
                </button>
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
                    <img src="assets/images/mobile-marketting.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Content Management</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Transform your brand's voice with tailored content management. We optimize and distribute impactful narratives, aligning with your goals to build engagement, loyalty, and a strong online presence.</p>
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
                    <img src="assets/images/Holistic-marketing.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>The Holistic Marketing Approach</h2>
                        </div>
    
                        <div class="details-description">
                            <p>We offer a full-circle marketing experience, aligning all touchpoints from SEO to social media to ensure your brand story consistently reaches the right audience at every stage of the buyer journey.</p>
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
                    <img src="assets/images/telecommuting-rafiki.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Relationship-Driven Success</h2>
                        </div>
    
                        <div class="details-description">
                            <p>Our focus isn’t just on acquiring clients — it's about building lasting relationships. We foster brand loyalty by engaging with your audience in ways that build trust and long-term connections.</p>
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
                    <img src="assets/images/client-focus.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Targeted Audience Engagement</h2>
                        </div>
    
                        <div class="details-description">
                            <p>We specialize in identifying and connecting businesses with their perfect clients. Our tailored marketing strategies focus on reaching and engaging the audience that matters most to your brand.</p>
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
                    <img src="assets/images/Closed Stores-rafiki.png" alt="feature-image-one">
                </div>
            </div>
    
            <div class="feature-details wrapper">
                <div class="details-wrapper">
                    <div class="details-content">
                        <div class="details-title mb10 font20">
                            <h2>Brand Positioning</h2>
                        </div>
    
                        <div class="details-description">
                            <p>We help you carve out a unique space in the market. Our approach focuses on positioning your brand in a way that attracts your ideal clients, making you stand out from competitors.</p>
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
            <h3>Your Digital Growth Partner</h3>
            <p class="main-text">
                At Liteup Creative, we transform businesses through innovative digital solutions. 
                With years of experience and a passionate team, we've helped numerous brands achieve 
                their digital transformation goals.
            </p>
            
            <div class="stats-container">
                <div class="stat-item">
                    <span class="stat-number">150+</span>
                    <p>Projects Completed</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <p>Happy Clients</p>
                </div>
                <div class="stat-item">
                    <span class="stat-number">5+</span>
                    <p>Years Experience</p>
                </div>
            </div>

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

            <button class="btn" onclick="window.location.href='client_form.php';">
                Start Your Project
            </button>
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
                <div class="blog-item padd-15">
                    <div class="blog-item-inner shadow-dark">
                        <div class="blog-img">
                            <img src="https://cdn.pixabay.com/photo/2023/06/30/10/19/man-8098085_1280.jpg" alt="Blog">
                        </div>
                        <div class="blog-info">
                            <h3 class="blog-title">Maximizing ROI: Proven Strategies for Business to Business Success</h3>
                            <p class="blog-description">Discover actionable strategies that can boost your return on investment and elevate your B2B marketing efforts.</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div> <!-- End Blog-item -->
                <div class="blog-item padd-15">
                    <div class="blog-item-inner shadow-dark">
                        <div class="blog-img">
                            <img src="https://cdn.pixabay.com/photo/2023/06/30/10/19/man-8098085_1280.jpg" alt="Blog">
                        </div>
                        <div class="blog-info">
                            <h3 class="blog-title">Power of Data-Driven Marketing in Business to Business</h3>
                            <p class="blog-description">Learn how leveraging data analytics can transform your marketing campaigns and deliver measurable results for your clients.</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div> <!-- End Blog-item -->
                <div class="blog-item padd-15">
                    <div class="blog-item-inner shadow-dark">
                        <div class="blog-img">
                            <img src="https://cdn.pixabay.com/photo/2023/06/30/10/19/man-8098085_1280.jpg" alt="Blog">
                        </div>
                        </div>
                        <div class="blog-info">
                            <h3 class="blog-title">Creating Compelling Content: A Key to Business to Business Engagement</h3>
                            <p class="blog-description">Explore effective content strategies that resonate with your audience and drive engagement, leading to better business relationships.</p>
                            <a href="#">Read More</a>
                        </div>
                    </div>
                </div> <!-- End Blog-item -->
            </div>
        </div>
        <div class="section-button">
            <button class="btn">Load More...</button>
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
                        <p>Liteup Creative<br>B-NO16 Tashan Bama,<br>Borno,<br>Nigeria.</p>
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
                            <h4>The News Letter</h4>
                            <p>Contact us for any of your promotions and services, we are ready to pilots your brand to it brim</p>
                        </div>   
                        <div class="mb20">
                            <button class="btn" href="#about-us">Join us</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
    </section>

<footer class="footer">
    <ul>
        <li>&copy; 2024 LiteUp Creative Concept. All rights reserved.</li>
        <li><a href="">Terms & Conditions</a></li>
        <li><a href="">Privacy Policy</a></li>
        <li><a href="">Compliances</a></li>
    </ul>
</footer>
<script src="assets/js/main.js" defer></script>
<script src="assets/js/particles.js" defer></script>
<script src="assets/js/particles.min.js"></script>
<script>
    particlesJS.load('particles-js', 'assets/js/particles.json', function() {
        console.log('particles.js loaded');
    });
</script>
</body>
</html>
