<?php
session_start();
require_once '../includes/functions.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!verifyConnection()) {
    die("Database connection failed");
}

$error = '';
$success = '';
$post_id = $_GET['id'] ?? null;

if (!$post_id) {
    die("Post ID is required");
}

try {
    $stmt = $blog_pdo->prepare("SELECT * FROM blog_posts WHERE id = ?");
    $stmt->execute([$post_id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$post) {
        die("Post not found");
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    die("Database error");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Debug POST data
        error_log("POST data received: " . print_r($_POST, true));
        error_log("FILES data received: " . print_r($_FILES, true));
        
        // Prepare data
        $data = [
            ':id' => $post_id,
            ':title' => trim($_POST['title']),
            ':slug' => createSlug($_POST['title']),
            ':category' => trim($_POST['category']),
            ':author' => trim($_POST['author']),
            ':author_role' => trim($_POST['author_role']),
            ':content' => $_POST['content'],
            ':read_time' => trim($_POST['read_time']),
            ':excerpt' => trim($_POST['excerpt']),
            ':featured_image' => $post['featured_image']
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
        
        // Update post
        $sql = "UPDATE blog_posts SET 
                    title = :title, 
                    slug = :slug, 
                    category = :category, 
                    author = :author, 
                    author_role = :author_role, 
                    content = :content, 
                    read_time = :read_time, 
                    excerpt = :excerpt, 
                    featured_image = :featured_image 
                WHERE id = :id";
        
        $stmt = $blog_pdo->prepare($sql);
        
        if ($stmt->execute($data)) {
            $_SESSION['success'] = 'Post updated successfully!';
            header('Location: ../blog/blog.php');
            exit();
        } else {
            throw new Exception("Failed to update post");
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
    <title>Edit Blog Post</title>
    <link rel="stylesheet" href="assets/css/variables.css">
    <link rel="stylesheet" href="assets/css/utilities.css">
    <link rel="stylesheet" href="assets/css/admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tiny.cloud/1/smp2kx4wun6db0qfcsqkak5qrbsiw2zew5787odzgts18rqt/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body>
    <div class="admin-container">
        <h1>Edit Blog Post</h1>
        <?php if ($error): ?>
            <div class="error-message"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="error-message"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo $_SERVER['PHP_SELF'] . '?id=' . $post_id; ?>" enctype="multipart/form-data" class="blog-form" id="postForm">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Category</label>
                <select name="category" required>
                    <option value="Digital Marketing" <?php echo $post['category'] == 'Digital Marketing' ? 'selected' : ''; ?>>Digital Marketing</option>
                    <option value="Social Media" <?php echo $post['category'] == 'Social Media' ? 'selected' : ''; ?>>Social Media</option>
                    <option value="SEO" <?php echo $post['category'] == 'SEO' ? 'selected' : ''; ?>>SEO</option>
                    <option value="Content Strategy" <?php echo $post['category'] == 'Content Strategy' ? 'selected' : ''; ?>>Content Strategy</option>
                    <option value="Graphic Design" <?php echo $post['category'] == 'Graphic Design' ? 'selected' : ''; ?>>Graphic Design</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Author</label>
                <input type="text" name="author" value="<?php echo htmlspecialchars($post['author']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Author Role</label>
                <input type="text" name="author_role" value="<?php echo htmlspecialchars($post['author_role']); ?>" required>
            </div>
            
            <div class="form-group">
                <label>Featured Image</label>
                <input type="file" name="featured_image" accept="image/*">
                <?php if ($post['featured_image']): ?>
                    <img src="<?php echo htmlspecialchars($post['featured_image']); ?>" alt="Featured Image" style="max-width: 200px;">
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" id="editor" rows="20" required><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Excerpt</label>
                <textarea name="excerpt" rows="3" required><?php echo htmlspecialchars($post['excerpt']); ?></textarea>
            </div>
            
            <div class="form-group">
                <label>Read Time</label>
                <input type="text" name="read_time" value="<?php echo htmlspecialchars($post['read_time']); ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Update Post</button>
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
