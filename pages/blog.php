<?php include '../includes/header.php'; 

?>

<main class="blog-page">
    <section class="blog-hero">
        <div class="title main-wrapper">
            <h1>Our Latest Digital Marketing Insights</h1>
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
            <!-- Blog Post Card -->
            <article class="blog-card">
                <div class="blog-image">
                    <img src="../assets/images/blog1.jpg" alt="Blog Post">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="date">March 15, 2024</span>
                        <span class="category">Digital Marketing</span>
                    </div>
                    <h2>Understanding SEO in 2024</h2>
                    <p>Learn the latest trends and strategies in Search Engine Optimization...</p>
                    <a href="single-blog.php?id=1" class="read-more">
                        Read More <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </article>
            <!-- Repeat for other blog posts -->
            <article class="blog-card">
                <div class="blog-image">
                    <img src="../assets/images/blog1.jpg" alt="Blog Post">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="date">March 15, 2024</span>
                        <span class="category">Digital Marketing</span>
                    </div>
                    <h2>Understanding SEO in 2024</h2>
                    <p>Learn the latest trends and strategies in Search Engine Optimization...</p>
                    <a href="single-blog.php?id=1" class="read-more">
                        Read More <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </article>
             <!-- Repeat for other blog posts -->
            <article class="blog-card">
                <div class="blog-image">
                    <img src="../assets/images/blog1.jpg" alt="Blog Post">
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span class="date">March 15, 2024</span>
                        <span class="category">Digital Marketing</span>
                    </div>
                    <h2>Understanding SEO in 2024</h2>
                    <p>Learn the latest trends and strategies in Search Engine Optimization...</p>
                    <a href="single-blog.php?id=1" class="read-more">
                        Read More <i class='bx bx-right-arrow-alt'></i>
                    </a>
                </div>
            </article>
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

<?php include '../includes/footer.php'; 


?>