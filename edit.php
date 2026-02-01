<?php
session_start();
include 'db.php';

// Only users can edit their own posts
if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user'){
    header("Location: login.php");
    exit();
}

$post_id = $_GET['id'] ?? 0;

// Fetch post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = :id AND user_id = :user_id");
$stmt->execute(['id' => $post_id, 'user_id' => $_SESSION['user_id']]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post){
    die("Post not found or you don't have permission to edit it.");
}

// Update post
if(isset($_POST['update_post'])){
    $title = $_POST['title'];
    $content = $_POST['content'];

    $update = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id AND user_id = :user_id");
    $update->execute([
        'title' => $title,
        'content' => $content,
        'id' => $post_id,
        'user_id' => $_SESSION['user_id']
    ]);

    header("Location: dashboard.php");
    exit();
}
?>

<h2>Edit Post</h2>
<form method="POST">
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br>
    <textarea name="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea><br>
    <button type="submit" name="update_post">Update Post</button>
</form>
<a href="dashboard.php">Back to Dashboard</a>
