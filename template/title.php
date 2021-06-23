<??>

<div style="float: right;">
    <?php if(isset($_SESSION["loggedin"])):?>
        <?php echo "Welcome ".$_SESSION['username']?>
        <a href="logout.php">Logout</a>
    <?php else:?>
        <a href="login.php">Login</a>
    <?php endif; ?>
</div>

<a href="index.php">
    <h1>Blog Title</h1>
</a>