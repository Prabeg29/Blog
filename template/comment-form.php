<h3>Add Comment</h3>

<form action="view-post.php" method="POST" class="comment-form user-form">

    <div>
        <input type="hidden" name="commentOnPostId" value="<?php echo $_SESSION['post']['id']?>">
    </div>
        
    <div>
        <label for="name">Name*: </label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($commentData['name']); ?>">
            <div><?php echo $errorMessage['name'];?></div>
    </div>
        
    <div>
        <label for="email">Email*: </label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($commentData['email']); ?>">
        <div><?php echo $errorMessage['email'];?></div>
    </div>

    <div>
        <label for="comment">Comment*: </label>
        <textarea name="comment" id="" cols="70" rows="8"><?php echo htmlspecialchars($commentData['comment']);?></textarea>
        <div><?php echo $errorMessage['comment'];?></div>
    </div>
    
    <div>
        <input type="submit" name="submit" value="submit">
    </div>

</form>