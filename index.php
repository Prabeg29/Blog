<?php
    session_start();

    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/home.php');

    $posts = getAllPosts($conn);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Blog Application</title>
        <?php require 'template/head.php';?>
    </head>
    <body>

        <?php require('./template/title.php');?>
        <p>This paragraph summarises what the blog is about.</p>
        
        <div>
            <h2>Recent Articles</h2>
            <div class="post-list">
                <?php foreach($posts as $post): ?>
                    <div class="post-synopsis">
                        <h3>
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h3>
                        <div class="meta">
                            <?php echo date($post['created_at']); ?>
                        </div>
                        <p>
                            <?php echo htmlspecialchars($post['body']);?>
                        </p>
                        <div class="post-controls">
                            <a href="view-post.php?id=<?php echo $post['id'];?>">Read more...</a>
                            <?php if(isset($_SESSION["loggedin"])):?>
                                |
                                <a href="edit-post.php?postId=<?php echo $post['id'] ?>">Edit</a>
                            <?php endif;?>
                        </div>
                        <div>
                            <?php echo commentCountForPost($conn, $post['id']);?> comments
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>

    </body>
</html>