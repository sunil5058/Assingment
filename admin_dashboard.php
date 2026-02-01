<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin'){
    header("Location: login.php");
    exit();
}

$admin_name = $_SESSION['user_name'];

// List all users
$users = $pdo->query("SELECT id, name, email, user_role FROM users")->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Admin Dashboard</h1>
<p>Welcome, <?php echo htmlspecialchars($admin_name); ?></p>
<a href="logout.php">Logout</a>

<h2>All Users</h2>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th></tr>
<?php foreach($users as $user): ?>
<tr>
    <td><?php echo $user['id']; ?></td>
    <td><?php echo htmlspecialchars($user['name']); ?></td>
    <td><?php echo htmlspecialchars($user['email']); ?></td>
    <td><?php echo $user['user_role']; ?></td>
</tr>
<?php endforeach; ?>
</table>
