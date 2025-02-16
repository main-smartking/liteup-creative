<?php
require_once '../includes/db.php';
require_once '../includes/functions.php';

// Get slug from URL and sanitize it
$slug = isset($_GET['slug']) ? trim($_GET['slug']) : '';

try {
    global $pdo;
    
    if (empty($slug)) {
        throw new Exception("No post specified");
    }

    // Fetch the post
    $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE slug = ?");
    $stmt->execute([$slug]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        throw new Exception("Post not found");
    }

} catch(Exception $e) {
    error_log("Blog Error: " . $e->getMessage());
    header('Location: /liteup-creative/blog');
    exit();
}

// Include header after getting post data
include '../includes/blog_header.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo generateMetaTitle($post['title']); ?></title>
    <meta name="description" content="<?php echo generateMetaDescription($post['content']); ?>">
    
    <!-- Open Graph Tags -->
    <meta property="og:type" content="article">
    <meta property="og:title" content="<?php echo htmlspecialchars($post['title']); ?>">
    <meta property="og:description" content="<?php echo generateMetaDescription($post['content']); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($post['featured_image']); ?>">
    <meta property="article:published_time" content="<?php echo $post['created_at']; ?>">
</head>

<main class="single-post-page main-wrapper">
    <?php if ($post): ?>
    <article class="post-content">
        <div class="post-header">
            <div class="post-meta">
                <span class="category"><?php echo htmlspecialchars($post['category'] ?? ''); ?></span>
                <span class="date"><?php echo $post['created_at'] ? date('F d, Y', strtotime($post['created_at'])) : ''; ?></span>
                <span class="read-time"><?php echo htmlspecialchars($post['read_time'] ?? ''); ?> min read</span>
            </div>
            <h1><?php echo htmlspecialchars($post['title'] ?? ''); ?></h1>
            <div class="author-info">
                <div class="author-details">
                    <span class="author-name"><?php echo htmlspecialchars($post['author'] ?? ''); ?></span>
                    <span class="author-role"><?php echo htmlspecialchars($post['author_role'] ?? ''); ?></span>
                </div>
            </div>
        </div>

        <div class="featured-image">
            <?php 
                $imagePath = $post['featured_image'] ?? '';
                $defaultImage = '../assets/images/default-blog.jpg';

                // Remove '../' if present and ensure correct path
                $imagePath = str_replace('../', '', $imagePath);
                $imagePath = '../' . $imagePath;  // Add back ../ since we're in pages/

                // Verify image exists
                if (empty($imagePath) || !file_exists($imagePath)) {
                    $imagePath = $defaultImage;
                }
            ?>
            <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                 alt="<?php echo htmlspecialchars($post['title'] ?? ''); ?>">
        </div>

        <div class="post-body">
            <?php echo html_entity_decode($post['content']); ?>
        </div>
    </article>
    <?php else: ?>
    <div class="error-message">
        <h2>Post not found</h2>
        <p>The requested blog post could not be found.</p>
        <a href="blog.php" class="btn">Return to Blog</a>
    </div>
    <?php endif; ?>
    <section class="related-posts">
        <div class="main-wrapper">
            <h2>Related Articles</h2>
            <div class="related-grid">
                <?php
                try {
                    $stmt = $pdo->prepare("
                        SELECT id, title, content, category, featured_image, slug 
                        FROM blog_posts 
                        WHERE category = ? AND id != ? 
                        ORDER BY RAND() 
                        LIMIT 3
                    ");
                    $stmt->execute([$post['category'], $post['id']]);
                    $related_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach($related_posts as $related): 
                        $imagePath = $related['featured_image'] ?? '';
                        $defaultImage = '../assets/images/default-blog.jpg';
                        
                        // Clean path
                        $imagePath = str_replace('../', '', $imagePath);
                        $imagePath = '../' . $imagePath;
                        
                        if (empty($imagePath) || !file_exists($imagePath)) {
                            $imagePath = $defaultImage;
                        }
                ?>
                        <article class="related-card">
                            <div class="related-image">
                                <img src="<?php echo htmlspecialchars($imagePath); ?>" 
                                     alt="<?php echo htmlspecialchars($related['title']); ?>">
                            </div>
                            <div class="related-content">
                                <span class="related-category">
                                    <?php echo htmlspecialchars($related['category']); ?>
                                </span>
                                <h3><?php echo htmlspecialchars($related['title']); ?></h3>
                                <?php 
                                // Clean the content and get excerpt
                                $clean_content = strip_tags(html_entity_decode($related['content']));
                                $excerpt = substr($clean_content, 0, 100) . '...';
                                ?>
                                <p><?php echo $excerpt; ?></p>
                                <a href="<?php echo '/liteup-creative/blog/' . urlencode($related['slug']); ?>" class="read-more">
                                    Read Article <i class='bx bx-right-arrow-alt'></i>
                                </a>
                            </div>
                        </article>
                <?php 
                    endforeach;
                } catch(PDOException $e) {
                    error_log("Database Error: " . $e->getMessage());
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php 
// Include blog footer with contact modal
require_once '../includes/blog_footer.php';
?>