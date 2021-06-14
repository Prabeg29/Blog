<!DOCTYPE html>
<html>
    <head>
        <title>A Blog Application</title>
    </head>
    <body>

        <h1>Blog Title</h1>
        <p>This paragraph summarises what the blog is about.</p>

        <?php for($postId = 1; $postId < 3; $postId++): ?>
            <h2>Article <?php echo $postId;?> title</h2>
            <div>dd mm yyyy</div>
            <p>A paragraph summarising article <?php echo $postId;?></p>
            <p>
                <a href="#">Read more...</a>
            </p>
        <?php endfor;?>

    </body>
</html>