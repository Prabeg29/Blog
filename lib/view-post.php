<?php

/* *
 * Retreives a single post
 * 
 * @param $conn
 * @param integer $postId
 * 
 * @return array $post
 * @throws exception
 */
function getPost($conn, $postId){
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
function getCommentsForPost($conn, $postId){

    $postId = mysqli_real_escape_string($conn, $postId);
    
    // Statement to get comments for the post
    $sql = "SELECT name, text, created_at, website FROM comments WHERE post_id = $postId";

    // Query the database to get the result
    $result = mysqli_query($conn, $sql);
    
    $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    return $comments;
}

/**
 * Write comment to a particular post
 *
 * @param array $commentData
 * 
 * @return array $errorMessage
 */
function addCommentToPost($conn, $commentData, $errorMessage){
    // name validation
    if(empty($commentData['name'])){
        $errorMessage['name'] = "Name is required!"."</br>";
    }
    else{
        if(strlen($commentData['name']) > 255){
            $errorMessage['name'] = "Please do not enter more than 255 characters"."</br>";
        }
        else if(!preg_match('/^[a-zA-Z\s]+$/', $commentData['name'])){
            $errorMessage['name'] =  "Name must consist of letters and spaces only"."<br>";
        }
    }

    // email validation
    if(empty($commentData['email'])){
        $errorMessage['email'] = "Email is required!"."</br>";
    }
    else{
        if(strlen($commentData['email']) > 255){
            $errorMessage['name'] = "Please do not enter more than 255 characters"."</br>";
        }
        else if(!filter_var($commentData['email'], FILTER_VALIDATE_EMAIL)){
            $errorMessage['email'] =  "Please enter a valid email address"."<br>";
        }
    }

    // comment validation
    if(empty($commentData['comment'])){
        $errorMessage['comment'] = "Comment is required!"."</br>";
    }

    if(!array_filter($errorMessage)){

        foreach($commentData as &$cd){
            $cd = trim(mysqli_real_escape_string($conn, $cd));
        }

        // Insert SQL query
        $sql = "INSERT INTO comments(post_id, name, website, text) VALUES('{$commentData['postId']}', '{$commentData['name']}', '{$commentData['email']}', '{$commentData['comment']}')";

        if(mysqli_query($conn, $sql)){
            // success
            header("Location: view-post.php?id={$commentData['postId']}");
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
    return $errorMessage;
}