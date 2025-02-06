<?php
session_start();
require_once '../includes/blog_function.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!verifyBlogConnection()) {
    die("Database connection failed");
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Debug
        error_log("POST data received: " . print_r($_POST, true));
        error_log("FILES data received: " . print_r($_FILES, true));
        
        // Prepare data
        $data = [
            ':title' => trim($_POST['title']),
            ':slug' => createSlug($_POST['title']),
            ':category' => trim($_POST['category']),
            ':author' => trim($_POST['author']),
            ':author_role' => trim($_POST['author_role']),
            ':content' => $_POST['content'],
            ':read_time' => trim($_POST['read_time']),
            ':excerpt' => trim($_POST['excerpt']),
            ':featured_image' => ''
        ];
        
        // Handle image
        if (isset($_FILES['featured_image']) && $_FILES['featured_image']['error'] === 0) {
            $upload_dir = '../assets/images/blog/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_ext = strtolower(pathinfo($_FILES['featured_image']['name'], PATHINFO_EXTENSION));
            $filename = $data[':slug'] . '.' . $file_ext;
            $target_path = $upload_dir . $filename;
            
            if (move_uploaded_file($_FILES['featured_image']['tmp_name'], $target_path)) {
                $data[':featured_image'] = 'assets/images/blog/' . $filename;
            }
        }
        
        // Insert post
        if (insertBlogPost($data)) {
            $_SESSION['success'] = 'Post created successfully!';
            header('Location: ../blog/blog.php');
            exit();
        } else {
            throw new Exception("Failed to insert post");
        }
        
    } catch(Exception $e) {
        error_log("Error: " . $e->getMessage());
        $_SESSION['error'] = $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/liteup-creative/">
    <meta charset="UTF-8">
    <title>Create Blog Post</title>
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/utilities.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <div class="admin-container">
        <h1>Create New Blog Post</h1>
        
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="blog-form" id="postForm">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" required>
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="Digital Marketing">Digital Marketing</option>
                    <option value="Social Media">Social Media</option>
                    <option value="SEO">SEO</option>
                    <option value="Content Strategy">Content Strategy</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" required>
            </div>

            <div class="form-group">
                <label>Author Role</label>
                <input type="text" name="author_role" required>
            </div>
            
            <div class="form-group">
                <label>Featured Image</label>
                <input type="file" name="featured_image" accept="image/*" required>
            </div>
            
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" rows="20" required></textarea>
            </div>

            <div class="form-group">
                <label>Excerpt</label>
                <textarea name="excerpt" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Read Time</label>
                <input type="text" name="read_time" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Publish Post</button>
        </form>
    </div>
</body>
</html>