<?php
    session_start();

    if(!isset($_SESSION["loggedin"])){
        header('Location: index.php');
    }

    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/view-post.php');
    require_once('./lib/edit-post.php');

    $errorMessage = ['postTitle'=>'', 'postBody'=>''];

    $postData = [
        'id'=> '',
        'title'=>'',
        'body'=>'',
    ];

    if (isset($_GET['postId']))
    {
        $post = getPost($conn, $_GET['postId']);
        if ($post)
        {
            $postData['id'] = $post['id'];
            $postData['title'] = $post['title'];
            $postData['body'] = $post['body'];
        }
    }

    if(isset($_POST['submit'])){

        $postData = [
            'title'=>trim($_POST['post-title']),
            'body'=>trim($_POST['post-body'])
        ];

        if(validatePost($postData, $errorMessage)){
            if($postData['id']){
                editPost($conn, $_SESSION['user_id'], $postData);
            }
            else{
                $postId = addPost($conn, (int)$_SESSION['user_id'], $postData);
            
                if(!$postId){
                    echo "Post Operation Failed";
                }
            }

            header("Location: view-post.php?id=$postId");
        }
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

        <?php if(isset($_GET['post_id'])):?>
            <h1>Edit Post</h1>
        <?php else:?>
            <h1>New Post</h1>
        <?php endif;?>

        <form method="POST" class="post-form user-form" action="<?php echo $_SERVER['PHP_SELF']?>">

            <div>
                <label for="post-title">Title:</label>
                <input id="post-title" name="post-title" type="text" value="<?php echo htmlspecialchars($postData['title'])?>">
                <div><?php echo $errorMessage['postTitle'];?></div>
            </div>
            <div>
                <label for="post-body">Body:</label>
                <textarea id="post-body" name="post-body" rows="12" cols="70">
                    <?php echo htmlspecialchars($postData['body'])?>
                </textarea>
                <div><?php echo $errorMessage['postBody'];?></div>
            </div>
            <div>
                <input type="submit" name="submit"  value="Save post">
                <a href="index.php">Cancel</a>
            </div>

        </form>
    </body>
</html>