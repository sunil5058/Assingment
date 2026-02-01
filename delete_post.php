<?php
session_start();
include 'db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'user'){
    header("Location: login.php");
    exit();
}

$post_id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("DELETE FROM posts WHERE id=:id AND user_id=:user_id");
$stmt->execute(['id'=>$post_id, 'user_id'=>$_SESSION['user_id']]);

header("Location: dashboard.php");
exit();
