<?php
require_once 'db.php';

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
$user = $_SESSION['user'];

// Sample posts (in practice, these would come from a database)
$posts = [
    1 => [
        'author' => 'JHON',
        'caption' => 'The golden sunset painted the sky in hues of orange and pink, casting a warm glow over the tranquil ocean waves.',
        'image' => 'assets/sunset.jpg'
    ],
    2 => [
        'author' => 'DOE',
        'caption' => 'A sleek black sports car roared down the empty highway, its headlights slicing through the midnight darkness.',
        'image' => 'assets/car.jpg'
    ],
    3 => [
        'author' => 'LOREM',
        'caption' => 'The aroma of freshly brewed coffee filled the cozy café, mingling with the soft chatter of early morning customers.',
        'image' => 'assets/aroma.jpg'
    ],
];

// Initialize likes/comments if not already
if (!isset($_SESSION['likes'])) $_SESSION['likes'] = [];
if (!isset($_SESSION['comments'])) $_SESSION['comments'] = [];

// Handle like
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like'])) {
    $postId = $_POST['post_id'];
    if (!isset($_SESSION['likes'][$postId])) {
        $_SESSION['likes'][$postId] = 0;
    }
    $_SESSION['likes'][$postId]++;
}

// Handle comment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    $postId = $_POST['post_id'];
    $commentText = trim($_POST['comment_text']);
    if ($commentText !== '') {
        $_SESSION['comments'][$postId][] = "{$user}: {$commentText}";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Dashboard</title>
</head>
<body class="background">
    <nav class="nav-bar">
        <a href="#">HOME</a>
        <a href="#">ACCOUNT</a>
        <a href="#">MENU</a>
        <a href="logout.php">LOG-OUT</a>
    </nav>
    

    <div class="content">
        <?php foreach ($posts as $id => $post): ?>
        
            <div class="post" style="margin-top:auto;">
                <img style="width: 500px; height: 400px;" src="<?= $post['image'] ?>" alt="Post image">
                <div>
                    <strong><?= htmlspecialchars(string: $post['author']) ?></strong>
                    <p class="caption"><?= htmlspecialchars(string: $post['caption']) ?></p>

                    <!-- Like Form -->
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?= $id ?>">
                        <button type="submit" name="like">Like ❤️</button>
                        <span><?= $_SESSION['likes'][$id] ?? 0 ?> likes</span>
                    </form>

                    <!-- Comment Form -->
                    <form method="POST" style="margin-top: 10px;">
                        <input type="hidden" name="post_id" value="<?= $id ?>">
                        <input type="text" name="comment_text" placeholder="Add a comment..." required>
                        <button type="submit" name="comment">Post</button>
                    </form>

                    <!-- Display Comments -->
                    <div style="margin-top: 10px;">
                        <strong>Comments:</strong>
                        <ul>
                            <?php if (!empty($_SESSION['comments'][$id])): ?>
                                <?php foreach ($_SESSION['comments'][$id] as $comment): ?>
                                    <li><?= htmlspecialchars($comment) ?></li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li>No comments yet.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
