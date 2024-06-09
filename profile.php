<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bio = $_POST['bio'];

    $stmt = $conn->prepare("UPDATE users SET bio = ? WHERE id = ?");
    $stmt->execute([$bio, $user_id]);
}

$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<h1>Profile</h1>
<p>Username: <?php echo $user['username']; ?></p>
<p>Bio: <?php echo $user['bio']; ?></p>

<form method="POST" action="profile.php">
    <textarea name="bio"><?php echo $user['bio']; ?></textarea>
    <button type="submit">Update</button>
</form>

<a href="index.php">Home</a>
