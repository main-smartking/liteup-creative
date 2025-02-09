<?php
// Database configuration
$host = 'localhost';
$dbname = 'blog_db';
$username = 'root';
$password = '';

// Create PDO instance as global
global $blog_pdo;

if (!isset($blog_pdo)) {
    try {
        $blog_pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $blog_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Test connection
        $blog_pdo->query("SELECT 1");
    } catch(PDOException $e) {
        error_log("Database Connection Error: " . $e->getMessage());
        die("Connection failed");
    }
}

// Helper function to get PDO instance
function getBlogPDO() {
    try {
        $pdo = new PDO(
            "mysql:host=localhost;dbname=blog_db;charset=utf8mb4",
            "root",
            "",
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
        return $pdo;
    } catch(PDOException $e) {
        error_log("PDO Error: " . $e->getMessage());
        throw new Exception("Database connection failed");
    }
}

// Connection verification
function verifyBlogConnection() {
    try {
        $pdo = getBlogPDO();
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
    global $blog_pdo;
    
    try {
        $params = [];
        $conditions = [];
        
        if ($search) {
            $conditions[] = "(title LIKE ? OR content LIKE ?)";
            $params[] = "%$search%";
            $params[] = "%$search%";
        }
        
        if ($category) {
            $conditions[] = "category = ?";
            $params[] = $category;
        }
        
        $where = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";
        
        $sql = "SELECT * FROM blog_posts $where ORDER BY created_at DESC";
        $stmt = $blog_pdo->prepare($sql);
        $stmt->execute($params);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        error_log("Search Query Error: " . $e->getMessage());
        return [];
    }
}

function createSlug($string) {
    return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
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
        
        // Debug
        error_log("Attempting to insert post: " . print_r($data, true));
        
        $sql = "INSERT INTO blog_posts (
            title, slug, category, author, author_role,
            content, featured_image, read_time, excerpt
        ) VALUES (
            :title, :slug, :category, :author, :author_role,
            :content, :featured_image, :read_time, :excerpt
        )";
        
        $stmt = $pdo->prepare($sql);
        $result = $stmt->execute($data);
        
        if (!$result) {
            error_log("Insert failed: " . print_r($stmt->errorInfo(), true));
            return false;
        }
        
        return true;
    } catch(PDOException $e) {
        error_log("Database Error: " . $e->getMessage());
        throw new Exception("Failed to create post: " . $e->getMessage());
    }
}
?>