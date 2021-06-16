<?php
    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/view-post.php');
    
    if(isset($_GET['id'])){
        $post = getPost($_GET['id']);
        $comments = getCommentsForPost($_GET['id']);
    }
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php require('./template/title.php');?>

        <?php if($post):?>
            <h2>
                <?php echo htmlspecialchars($post['title']); ?>
            </h2>
            <div>
                <?php echo date($post['created_at']); ?>
            </div>
            <p>
                <?php echo htmlspecialchars($post['body']); ?>
            </p>
            <?php foreach($comments as $comment):?>
                <div class="comment">
                    <div class="comment-meta">
                        Comment from
                        <?php echo htmlspecialchars($comment['name']); ?>
                        on
                        <?php echo date($comment['created_at']); ?>
                    </div>
                    <div class="comment-body">
                        <?php echo htmlspecialchars($comment['text']); ?>
                    </div>
                    <br>
                </div>
            <?php endforeach;?>
        <?php else:?>
            <h5>No Such Blog Exists!</h5>
        <?php endif;?>
    </body>
</html>