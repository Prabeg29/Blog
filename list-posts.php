<?php

require_once('./config/config.php');
require_once('./lib/db.php');
require_once('./lib/home.php');
require_once('./lib/list-posts.php');

session_start();

// Don't let non-auth users see this screen
if (!$_SESSION["loggedin"]){
    header('Location: index.php');
}

$posts = getAllPosts($conn);

if($_POST){
    $deleteResponse = $_POST['delete-post'];
    if ($deleteResponse){
        $keys = array_keys($deleteResponse);
        $deletePostId = $keys[0];
        if ($deletePostId){
            deletePost($conn, $deletePostId);
            header('Location: list-posts.php');
        }
    }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Blog application | Blog posts</title>
        <?php require 'template/head.php' ?>
    </head>
    <body>
        <?php require 'template/top-menu.php' ?>
        <h1>Post List</h1>
        <p>You have <?php echo count($posts) ?> posts.
        <form method="POST" action = "<?php echo $_SERVER['PHP_SELF']?>">
            <table id="post-list">
                <tbody>

                    <?php foreach($posts as $post): ?>
                        <tr>
                            <td>
                                <?php echo htmlspecialchars($post['title']); ?>
                            </td>
                            <td>
                                <?php echo date($post['created_at']); ?>
                            </td>
                            <td>
                                <a href="edit-post.php?id=<?php echo $post['id'] ?>">Edit</a>
                            </td>
                            <td>
                                <input
                                    type="submit"
                                    name="delete-post[<?php echo $post['id']?>]"
                                    value="Delete"
                                />
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
            </table>
        </form>
    </body>
</html>
