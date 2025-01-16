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

<main class="single-post-page">
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
            <img src="<?php echo htmlspecialchars($post['featured_image'] ?? ''); ?>" alt="<?php echo htmlspecialchars($post['title'] ?? ''); ?>">
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
        <h2>Related Articles</h2>
        <div class="related-grid">
            <!-- Similar blog cards -->
        </div>
    </section>
</main>

<?php include '../includes/footer.php'; ?>