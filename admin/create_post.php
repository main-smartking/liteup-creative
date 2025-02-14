<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}

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
        // Debug POST data
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
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tiny.cloud/1/smp2kx4wun6db0qfcsqkak5qrbsiw2zew5787odzgts18rqt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <div class="admin-container">
        <h1>Create New Blog Post</h1>
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
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
                    <option value="Graphic Design">Graphic Design</option>
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
                <textarea name="content" id="editor" rows="20" required></textarea>
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
    <script>
        tinymce.init({
            selector: '#editor',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
            setup: function (editor) {
                editor.on('change', function () {
                    editor.save();
                });
            }
        });
    </script>
</body>
</html>