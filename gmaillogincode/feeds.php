<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user'])) {
    header("Location: google-login.php");
    exit();
}

$user = $_SESSION['user'];

// Fetch dummy feeds
$result = $conn->query("SELECT * FROM feeds ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Feeds | CollabXInfluencer</title>
</head>
<body>
    <h1>Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
    <h3>Your Feeds</h3>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h4><?php echo htmlspecialchars($row['caption']); ?></h4>
            <?php if ($row['content_type'] === 'image'): ?>
                <img src="<?php echo $row['content_url']; ?>" width="300" />
            <?php elseif ($row['content_type'] === 'video' || $row['content_type'] === 'reel'): ?>
                <video width="300" controls>
                    <source src="<?php echo $row['content_url']; ?>" type="video/mp4">
                </video>
            <?php endif; ?>
        </div>
        <hr>
    <?php endwhile; ?>
    <a href="logout.php">Logout</a>
</body>
</html>
