<?php 
require_once '../includes/blog_function.php';
include '../includes/header.php';

// Initialize post variable
$post = null;

// Validate post ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $post_id = intval($_GET['id']);
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
        $stmt->execute([$post_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        // If no post found, redirect
        if (!$post) {
            header("Location: blog.php");
            exit();
        }
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        header("Location: blog.php");
        exit();
    }
} else {
    header("Location: blog.php");
    exit();
}
?>

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
                <img src="../assets/images/author.jpg" alt="<?php echo htmlspecialchars($post['author'] ?? ''); ?>">
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
            <?php echo nl2br(htmlspecialchars($post['content'] ?? '')); ?>
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
                        SELECT id, title, content, category, featured_image 
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
                                <p><?php echo substr(htmlspecialchars($related['content']), 0, 100) . '...'; ?></p>
                                <a href="post.php?id=<?php echo $related['id']; ?>" class="read-more">
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

<?php include '../includes/footer.php'; ?>