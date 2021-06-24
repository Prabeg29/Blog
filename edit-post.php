<?php

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
                <input id="post-title" name="post-title" type="text">
            </div>
            <div>
                <label for="post-body">Body:</label>
                <textarea id="post-body" name="post-body" rows="12" cols="70"></textarea>
            </div>
            <div>
                <input type="submit" value="Save post">
            </div>
            
        </form>
    </body>
</html>