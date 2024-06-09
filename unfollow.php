<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$unfollow_user_id = $_GET['user_id'];

$stmt = $conn->prepare("DELETE FROM followers WHERE user_id = ? AND follower_id = ?");
$stmt->execute([$unfollow_user_id, $user_id]);

header("Location: profile.php?user_id=$unfollow_user_id");
