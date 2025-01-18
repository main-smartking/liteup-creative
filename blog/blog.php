<?php include '../includes/blog_header.php'; 
require_once '../includes/blog_function.php';

// Add search functionality
$search = isset($_GET['search']) ? $_GET['search'] : '';
$where = '';
if ($search) {
    $where = "WHERE title LIKE :search OR content LIKE :search";
}

try {
    // Prepare and execute query
    $query = "SELECT * FROM blog_posts $where ORDER BY created_at DESC";
    $stmt = $pdo->prepare($query);
    
    if ($search) {
        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm);
    }
    
    $stmt->execute();
    $blog_posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
} catch(PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    $blog_posts = [];
}
?>

<main class="blog-page">
    <section class="blog-hero">
        <div class="title main-wrapper">
            <h1>Our Latest Digital Marketing Insights</h1>
            <p>
                Stay up to date with the latest trends in digital marketing. Our blog features articles on SEO, social media marketing, web development, and more. This is your place and your resource for all things digital marketing.
            </p>
            <div class="search-container">
                <form action="blog.php" method="GET">
                    <input type="text" name="search" placeholder="Search articles...">
                    <button type="submit"><i class='bx bx-search'></i></button>
                </form>
            </div>
        </div>
    </section>

    <section class="blog-grid main-wrapper">
        <div class="blog-posts">
            <?php if (!empty($blog_posts)): ?>
                <?php foreach($blog_posts as $post): ?>
                    <article class="blog-card">
                        <div class="blog-image">
                            <?php 
                                // Fix image path handling
                                $imagePath = $post['featured_image'] ?? '';
                                $defaultImage = '../assets/images/default-blog.jpg';
                                
                                // Clean path - remove any existing '../' and add it back properly
                                $imagePath = trim($imagePath, '/');
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
                                <span class="date">
                                    <?php echo date('F d, Y', strtotime($post['created_at'])); ?>
                                </span>
                                <span class="category">
                                    <?php echo htmlspecialchars($post['category']); ?>
                                </span>
                            </div>
                            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p><?php echo substr(htmlspecialchars($post['content']), 0, 150) . '...'; ?></p>
                            <a href="post.php?id=<?php echo $post['id']; ?>" class="read-more">
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

<?php include '../includes/blog_footer.php'; 


?>