<?php
    require_once('lib/common.php');
    require_once('lib/view-post.php');
    
    if(isset($_GET['id'])){

        $conn = connectToDatabase();

        $postId = mysqli_real_escape_string($conn, $_GET['id']);

        $post = getPost($conn, $postId);
    }
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <?php require('./template/title.php');?>

        <h2>
            <?php echo htmlspecialchars($post['title']); ?>
        </h2>
        <div>
            <?php echo date($post['created_at']); ?>
        </div>
        <p>
            <?php echo htmlspecialchars($post['body']); ?>
        </p>
        <?php foreach(getCommentsForPost($postId) as $comment):?>
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
    </body>
</html>