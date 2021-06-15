<?php
    require('./config/connect_to_db.php');

    // Statement to get all posts
    $sql = "SELECT id, title, body, created_at FROM post ORDER BY created_at DESC";

    // Query the database and get posts
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } 
    else {
        echo "0 results";
    }

    // free result
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>A Blog Application</title>
    </head>
    <body>

        <h1>Blog Title</h1>
        <p>This paragraph summarises what the blog is about.</p>

        <?php foreach($posts as $post): ?>
            <h2><?php echo htmlspecialchars($post['title']); ?></h2>
            <div><?php echo date($post['created_at']); ?></div>
            <p><?php echo htmlspecialchars($post['body']);?></p>
            <p>
                <a href="#">Read more...</a>
            </p>
        <?php endforeach;?>

    </body>
</html>