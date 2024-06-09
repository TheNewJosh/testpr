<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
    $stmt->execute([$user_id, $content]);

    header("Location: index.php");
}
?>

<form method="POST" action="post.php">
    <textarea name="content" required placeholder="What's on your mind?"></textarea>
    <button type="submit">Post</button>
</form>

<a href="index.php">Home</a>
