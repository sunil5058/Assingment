<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SESSION['user_role'] !== 'admin') {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
</head>
<body>

<h2>Welcome Admin</h2>

<form action="addcategory.php" method="POST">
    <input type="text" name="name" placeholder="Category Name" required>
    <input type="submit" name="submit" value="Add Category">
</form>

</body>
</html>
