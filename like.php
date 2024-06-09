<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$post_id = $_GET['post_id'];

$stmt = $conn->prepare("INSERT INTO likes (user_id, post_id) VALUES (?, ?)");
$stmt->execute([$user_id, $post_id]);

header("Location: index.php");
