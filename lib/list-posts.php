<?php

/**
 * Delete the specified post
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
    $sql = "DELETE FROM post WHERE id = $postId";

    if(!mysqli_query($conn, $sql)){
        echo 'query error: ' . mysqli_error($conn);
    }
}