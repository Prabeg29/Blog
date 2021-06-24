<?php
    session_start();

    if(!isset($_SESSION["loggedin"])){
        header('Location: index.php');
    }

    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/edit-post.php');


    $errorMessage = ['post-title'=>'', 'post-body'=>''];
    $postData = [
        'title'=>'',
        'body'=>'',
    ];
    if(isset($_POST['submit'])){
        $postData = [
            'title'=>$_POST['post-title'],
            'body'=>$_POST['post-body']
        ];

        $errorMessage = addPost($conn, $_SESSION['user_id'], $postData);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Blog application | New post</title>
        <?php require 'template/head.php' ?>
    </head>
    <body>
        <?php require 'template/title.php' ?>
        <form method="POST" class="post-form user-form">

            <div>
                <label for="post-title">Title:</label>
                <input id="post-title" name="post-title" type="text" value="<?php echo htmlspecialchars($postData['title'])?>">
            </div>
            <div>
                <label for="post-body">Body:</label>
                <textarea id="post-body" name="post-body" rows="12" cols="70">
                    <?php echo htmlspecialchars($postData['body'])?>
                </textarea>
            </div>
            <div>
                <input type="submit" name="submit"  value="Save post">
            </div>

        </form>
    </body>
</html>