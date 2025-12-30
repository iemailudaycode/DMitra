
<?php
// get_posts.php
require_once 'config.php';

// Ensure a category_id is provided
$category_id = filter_input(INPUT_GET, 'category_id', FILTER_SANITIZE_NUMBER_INT);

if (!$category_id) {
    echo json_encode([]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT id, title FROM jobs WHERE category_id = ?");
    $stmt->execute([$category_id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($posts);
} catch (PDOException $e) {
    // Log the error and return an empty array
    error_log("Database error: " . $e->getMessage());
    echo json_encode([]);
}
?>