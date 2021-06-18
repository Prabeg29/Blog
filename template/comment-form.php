<h3>Add Comment</h3>

<form action="view-post.php" method="POST">
    <p>
        <input type="hidden" name="commentOnPostId" value="<?php echo $_SESSION['post']['id']?>">
    </p>
    <p>
        <label for="name">Name*: </label>
        <input type="text" name="name" value="<?php echo $commentData['name']; ?>">
        <div><?php echo $errorMessage['name'];?></div>
    </p>
    
    <p>
        <label for="email">Email*: </label>
        <input type="email" name="email" value="<?php echo $commentData['email']; ?>">
        <div><?php echo $errorMessage['email'];?></div>
    </p>

    <p>
        <label for="comment">Comment*: </label>
        <textarea name="comment" id="" cols="70" rows="8"></textarea>
        <div><?php echo $errorMessage['comment'];?></div>
    </p>
    
    <input type="submit" name="submit" value="submit">
</form>