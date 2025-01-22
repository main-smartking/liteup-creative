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
    global $blog_pdo;
    if (!$blog_pdo) {
        throw new Exception("Database connection not available");
    }
    return $blog_pdo;
}

// Connection verification
function verifyBlogConnection() {
    global $blog_pdo;
    return isset($blog_pdo) && $blog_pdo instanceof PDO;
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
?>