<?php
    require('./config/connect_to_db.php');

    if(isset($_GET['id'])){
        $postId = mysqli_real_escape_string($conn, $_GET['id']);

        // Statement to get post of particular id
        $sql = "SELECT * FROM post WHERE id=$postId";

        // Query the database to get the result
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $post = mysqli_fetch_assoc($result);
        } 
        else {
            echo "0 results";
        }

        // free $result
        mysqli_free_result($result);

        //close connection
        mysqli_close($conn);
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
    </body>
</html>