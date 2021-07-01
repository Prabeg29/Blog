<form
    action="view-post.php?action=delete-comment&amp;id=<?php echo $_SESSION['post']['id']?>"
    method="POST"
    class="comment-list"
>

    <?php foreach($_SESSION['comments'] as $comment):?>
        <div class="comment">
            <div class="comment-meta">
                Comment from
                <?php echo htmlspecialchars($comment['name']); ?>
                on
                <?php echo date($comment['created_at']); ?>
                <?php if($_SESSION['loggedin']): ?>
                    <input
                        type="submit"
                        name="delete-comment[<?php echo $comment['id'] ?>]"
                        value="Delete"
                    />
                <?php endif ?>
            </div>
            <div class="comment-body">
                <?php echo htmlspecialchars($comment['text']); ?>
            </div>
            <br>
        </div>
    <?php endforeach;?>

</form>