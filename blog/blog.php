<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Basic error handling without logging
error_reporting(0);
ini_set('display_errors', 0);

$search = isset($_GET['search']) ? trim($_GET['search']) : null;
$selected_category = isset($_GET['category']) ? trim($_GET['category']) : null;

try {
    if (!empty($search)) {
        $blog_posts = getBlogPostsBySearch($search, $selected_category);
    } else {
        $blog_posts = getBlogPosts();
    }
} catch(Exception $e) {
    $blog_posts = array();
}

include '../includes/blog_header.php';
?>

<main class="blog-page">
    <?php if ($selected_category): ?>
        <div class="category-header main-wrapper">
            <h2>Posts in <?php echo htmlspecialchars($selected_category); ?></h2>
        </div>
    <?php else: ?>
        <section class="blog-hero">
            <div class="title main-wrapper">
               
                <div class="large-device">
                    <h1>Stay Ahead with Our Latest Digital Marketing Insights & Tips to Elevate Your Brand</h1>
                </div>
                <div class="mobile-device">
                    <h1>Stay Ahead with Our Latest Digital Marketing Insights</h1>
                </div>
                <p>Welcome to our blog, where we explore the latest trends in digital marketing and share best practices for promoting services and products to the right audience. Our goal is to keep you informed with fresh, actionable insights on digital strategies, technological advancements, and proven methods for success.</p>
                <div class="blog-header main-wrapper">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET" class="search-form">
                        <input type="text" 
                            name="search" 
                            placeholder="Search blogs..." 
                            value="<?php echo htmlspecialchars($search ?? ''); ?>"
                            minlength="2">
                        <button type="submit" class="search-btn">
                            <i class='bx bx-search'></i>
                        </button>
                    </form>
                </div>
            </div>
            
        </section>
    <?php endif; ?>
    
    <section class="blog-grid main-wrapper">
        <div class="blog-posts">
            <?php if (!empty($blog_posts)): ?>
                <?php foreach($blog_posts as $post): ?>
                    <article class="blog-card">
                        <div class="blog-image">
                            <?php 
                            $imagePath = $post['featured_image'] ?? '';
                            $defaultImage = '../assets/images/default-blog.jpg';
                            
                            // Clean path
                            $imagePath = str_replace('../', '', $imagePath);
                            $imagePath = '../' . $imagePath;
                            
                            if (empty($imagePath) || !file_exists($imagePath)) {
                                $imagePath = $defaultImage;
                            }
                            ?>
                            <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                                 alt="<?php echo htmlspecialchars($post['title']); ?>">
                        </div>
                        <div class="blog-content">
                            <div class="blog-meta">
                                <span class="category">
                                    <?php echo htmlspecialchars($post['category']); ?>
                                </span>
                            </div>
                            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p><?php echo getExcerpt($post['content']); ?></p>
                            <a href="<?php echo '/liteup-creative/blog/' . urlencode($post['slug']); ?>" class="read-more">
                                Read More <i class='bx bx-right-arrow-alt'></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-posts">
                    <p>No blog posts found. <?php echo $search ? 'Try a different search term.' : ''; ?></p>
                </div>
            <?php endif; ?>
        </div>

        <div class="pagination">
            <a href="#" class="page-link active">1</a>
            <a href="#" class="page-link">2</a>
            <a href="#" class="page-link">3</a>
            <span class="page-dots">...</span>
            <a href="#" class="page-link">10</a>
        </div>
    </section>
</main>

<?php include '../includes/blog_footer.php'; ?>