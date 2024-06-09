<?php
session_start();
include 'includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC");
$stmt->execute();
$posts = $stmt->fetchAll();
?>

<h1>Home</h1>

<a href="profile.php">My Profile</a> | 
<a href="post.php">Create Post</a> | 
<a href="logout.php">Logout</a>

<h2>Posts</h2>
<?php foreach ($posts as $post): ?>
    <div>
        <p><?php echo $post['username']; ?>: <?php echo $post['content']; ?></p>
        <a href="like.php?post_id=<?php echo $post['id']; ?>">Like</a>
    </div>
<?php endforeach; ?>
