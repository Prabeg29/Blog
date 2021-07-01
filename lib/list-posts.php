<?php

/**
 * Delete the specified post
 * 
 * We first delete the comments attached to the post, and then delete the post
 * itself
 *
 * @param mysqli $conn
 * @param int $postId
 * 
 * @return boolean Returns true on successful deletion
 * 
 * @throws Exception
 */
function deletePost($conn, $postId)
{
    $sqls = array(
        // Delete comments first, to remove the foreign key objection
        "DELETE FROM
            comments
        WHERE
            post_id = $postId",
        // Now we can delete the post
        "DELETE FROM
            post
        WHERE
            id = $postId",
    );
    foreach ($sqls as $sql){
        if(!mysqli_query($conn, $sql)){
            echo 'query error: ' . mysqli_error($conn);
        }
    }
}