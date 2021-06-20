<?php
    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/home.php');

    $posts = getAllPosts();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>A Blog Application</title>
    </head>
    <body>

        <?php require('./template/title.php');?>
        <p>This paragraph summarises what the blog is about.</p>
        
        <div>
            <h2>Recent Articles</h2>
            <?php foreach($posts as $post): ?>
                <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                <div><?php echo date($post['created_at']); ?></div>
                <p><?php echo htmlspecialchars($post['body']);?></p>
                <p>
                    <a href="view-post.php?id=<?php echo $post['id'];?>">Read more...</a>
                </p>
                <div><?php echo commentCountForPost($post['id']);?> comments</div>
            <?php endforeach;?>
        </div>

    </body>
</html>