<?php

    session_start();

    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/view-post.php');
    
    if(isset($_GET['id'])){
        $_SESSION['post'] = getPost($conn, $_GET['id']);
        $_SESSION['comments'] = getCommentsForPost($conn, $_GET['id']);
    }

    $errorMessage = ['name'=>'', 'email'=>'', 'comment'=>''];
    $commentData = [
        'postId'=>'',
        'name'=>'',
        'email'=>'',
        'comment'=>''
    ];
    if(isset($_POST['submit'])){
        $commentData = [
            'postId'=>$_POST['commentOnPostId'],
            'name'=>$_POST['name'],
            'email'=>$_POST['email'],
            'comment'=>$_POST['comment']
        ];

        $errorMessage = addCommentToPost($conn, $commentData, $errorMessage);
    }
?>

<html>
    <head>
        <title>Blog Application</title>
        <?php require 'template/head.php'; ?>
    </head>
    <body>
        <?php require('./template/title.php');?>

        <?php if($_SESSION['post']):?>
            <div class="post">
                <h2>
                    <?php echo htmlspecialchars($_SESSION['post']['title']); ?>
                </h2>
                <div class="date">
                    <?php echo date($_SESSION['post']['created_at']); ?>
                </div>
                <p>
                    <?php echo htmlspecialchars($_SESSION['post']['body']); ?>
                </p>
            </div>

            <div class="comment-list">

                <?php foreach($_SESSION['comments'] as $comment):?>
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
            </div>

            <?php include('./template/comment-form.php');?>
            
        <?php else:?>
            <h5>No Such Blog Exists!</h5>
        <?php endif;?>
    </body>
</html>