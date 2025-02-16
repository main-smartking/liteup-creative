<?php
require_once __DIR__ . '/db.php';

function getBlogPDO() {
    global $pdo;
    return $pdo;
}

// Blog functions
function getBlogPosts($limit = null) {
    global $pdo;
    try {
        $sql = "SELECT * FROM blog_posts ORDER BY created_at DESC";
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Error: " . $e->getMessage());
        return [];
    }
}

function createSlug($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
}

// Admin functions
function verifyAdmin($username, $password) {
    global $pdo;
    try {
        $stmt = $pdo->prepare("SELECT password FROM admin_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();
        
        return $user && password_verify($password, $user['password']);
    } catch(PDOException $e) {
        error_log("Admin verification error: " . $e->getMessage());
        return false;
    }
}

// Database verification
function verifyConnection() {
    global $pdo;
    try {
        $pdo->query("SELECT 1");
        return true;
    } catch(Exception $e) {
        error_log("Connection Error: " . $e->getMessage());
        return false;
    }
}

function getBlogPostsByCategory($category = null) {
    global $blog_pdo;
    
    try {
        if ($category) {
            $stmt = $blog_pdo->prepare("SELECT * FROM blog_posts WHERE category = ? ORDER BY created_at DESC");
            $stmt->execute([$category]);
        } else {
            $stmt = $blog_pdo->query("SELECT * FROM blog_posts ORDER BY created_at DESC");
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Blog Query Error: " . $e->getMessage());
        return [];
    }
}

function getBlogPostsBySearch($search = null, $category = null) {
    global $pdo;
    
    try {
        $params = [];
        $sql = "SELECT * FROM blog_posts WHERE 1=1";
        
        if ($search) {
            $sql .= " AND (title LIKE :search OR content LIKE :search)";
            $params[':search'] = '%' . $search . '%';
        }
        
        if ($category) {
            $sql .= " AND category = :category";
            $params[':category'] = $category;
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll();
    } catch(PDOException $e) {
        error_log("Search Query Error: " . $e->getMessage());
        return [];
    }
}

function cleanContent($content) {
    // Keep HTML formatting but clean it
    $config = array(
        'clean' => true,
        'html' => true,
        'valid_elements' => 'p,h1,h2,h3,h4,h5,h6,strong,em,b,i,ul,ol,li,a[href],br',
        'remove_empty_paragraphs' => true
    );
    
    // Remove extra spaces and line breaks
    $content = preg_replace('/\s+/', ' ', $content);
    
    // Clean up multiple empty paragraphs
    $content = preg_replace('/<p[^>]*>(\s|&nbsp;)*<\/p>/', '', $content);
    
    return trim($content);
}

function insertBlogPost($data) {
    try {
        $pdo = getBlogPDO();
        
        $stmt = $pdo->prepare("
            INSERT INTO blog_posts 
            (title, slug, category, author, author_role, content, featured_image, read_time, excerpt) 
            VALUES 
            (:title, :slug, :category, :author, :author_role, :content, :featured_image, :read_time, :excerpt)
        ");
        
        return $stmt->execute($data);
    } catch(PDOException $e) {
        error_log("Insert Error: " . $e->getMessage());
        throw new Exception("Failed to create post");
    }
}

function getExcerpt($content, $length = 150) {
    $content = html_entity_decode($content);
    $content = strip_tags($content);
    
    if (strlen($content) > $length) {
        $content = substr($content, 0, $length);
        $content = substr($content, 0, strrpos($content, ' ')) . '...';
    }
    
    return $content;
}

function changeAdminPassword($username, $currentPassword, $newPassword) {
    global $blog_pdo;
    
    try {
        // Verify current password
        if (!verifyAdmin($username, $currentPassword)) {
            return false;
        }
        
        // Hash new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        
        // Update password
        $stmt = $blog_pdo->prepare("UPDATE admin_users SET password = ? WHERE username = ?");
        return $stmt->execute([$hashedPassword, $username]);
        
    } catch(PDOException $e) {
        error_log("Password change error: " . $e->getMessage());
        return false;
    }
}

function isAdmin() {
    return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
}

function getBlogURL($slug = '') {
    if (!empty($slug)) {
        return "/liteup-creative/blog/{$slug}";
    }
    return "/liteup-creative/blog";
}

function generateMetaTitle($title = '') {
    $base = 'Liteup Creative';
    if (!empty($title)) {
        return htmlspecialchars($title . ' - ' . $base);
    }
    return htmlspecialchars($base . ' - Brand Design & Digital Marketing Agency');
}

function generateMetaDescription($content = '') {
    if (empty($content)) {
        return 'Professional Brand Design and Digital Marketing Agency in Nigeria. We specialize in brand identity, digital marketing, and creative solutions.';
    }
    return htmlspecialchars(substr(strip_tags($content), 0, 160));
}
?>