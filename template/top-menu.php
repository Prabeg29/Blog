<div class="top-menu">
    <div class="menu-options">
        <?php if(isset($_SESSION["loggedin"])):?>
            <a href="index.php">Home</a>
            |
            <a href="list-posts.php">All Posts</a>
            |
            <a href="edit-post.php">New Post</a>
            |
            <?php echo "Welcome ". htmlspecialchars($_SESSION['username']); ?>
            <a href="logout.php">Logout</a>
        <?php else:?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </div>
</div>
