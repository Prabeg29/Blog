<?php

/* *
 * Retreives a single post
 * 
 * @param $conn
 * @param integer $postId
 * @returns array $post
 * @throws exception
 */
function getPost($postId){
    $conn = connectToDatabase();

    $postId = mysqli_real_escape_string($conn, $postId);

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

    return $post;
}

/**
 * Returns all the comments for the specified post
 *
 * @param integer $postId
 */
function getCommentsForPost($postId)
{
    $conn = connectToDatabase();

    $postId = mysqli_real_escape_string($conn, $postId);
    
    // Statement to get comments for the post
    $sql = "SELECT name, text, created_at, website FROM comments WHERE post_id = $postId";

    // Query the database to get the result
    $result = mysqli_query($conn, $sql);
    
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $comments;
}