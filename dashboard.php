<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user'){
    header("Location: login.php");
    exit();
}

$post_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id=:id AND user_id=:user_id");
$stmt->execute(['id'=>$post_id, 'user_id'=>$_SESSION['user_id']]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$post) die("Post not found.");

if(isset($_POST['update_post'])){
    $stmt = $pdo->prepare("UPDATE posts SET title=:title, content=:content WHERE id=:id AND user_id=:user_id");
    $stmt->execute([
        'title'=>$_POST['title'],
        'content'=>$_POST['content'],
        'id'=>$post_id,
        'user_id'=>$_SESSION['user_id']
    ]);
    header("Location: dashboard.php");
    exit();
}
?>

<h2>Edit Post</h2>
<form method="POST">
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br>
    <textarea name="content" rows="5" required><?php echo htmlspecialchars($post['content']); ?></textarea><br>
    <button type="submit" name="update_post">Update</button>
</form>
<a href="dashboard.php">Back</a>
