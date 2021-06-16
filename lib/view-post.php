<?php

/* *
 * Retreives a single post
 * 
 * @param $conn
 * @param integer $postId
 * @returns array $post
 * @throws exception
 */
function getPost($conn, $postId){
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