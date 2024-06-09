<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$follow_user_id = $_GET['user_id'];

$stmt = $conn->prepare("INSERT INTO followers (user_id, follower_id) VALUES (?, ?)");
$stmt->execute([$follow_user_id, $user_id]);

header("Location: profile.php?user_id=$follow_user_id");
