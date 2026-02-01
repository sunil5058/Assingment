<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user'){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'] ?? 'User';

// My posts
$my_posts_stmt = $pdo->prepare("SELECT * FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
$my_posts_stmt->execute(['user_id' => $user_id]);
$my_posts = $my_posts_stmt->fetchAll(PDO::FETCH_ASSOC);

// All posts
$all_posts = $pdo->query("SELECT posts.*, users.name AS author FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Welcome, <?php echo htmlspecialchars($user_name); ?></h1>
<a href="logout.php">Logout</a>
<a href="create_post.php">Create New Post</a>

<h2>My Posts</h2>
<table border="1" cellpadding="5">
<tr><th>Title</th><th>Created At</th><th>Actions</th></tr>
<?php foreach($my_posts as $post): ?>
<tr>
    <td><?php echo htmlspecialchars($post['title']); ?></td>
    <td><?php echo $post['created_at']; ?></td>
    <td>
        <a href="edit_post.php?id=<?php echo $post['id']; ?>">Edit</a> | 
        <a href="delete_post.php?id=<?php echo $post['id']; ?>" onclick="return confirm('Delete this post?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h2>All Posts</h2>
<table border="1" cellpadding="5">
<tr><th>Title</th><th>Author</th><th>Created At</th></tr>
<?php foreach($all_posts as $post): ?>
<tr>
    <td><?php echo htmlspecialchars($post['title']); ?></td>
    <td><?php echo htmlspecialchars($post['author']); ?></td>
    <td><?php echo $post['created_at']; ?></td>
</tr>
<?php endforeach; ?>
</table>
