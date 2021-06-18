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
function getCommentsForPost($postId){
    $conn = connectToDatabase();

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
 * @param integer $postId
 * @param array $commentData
 * 
 * @return array $errors
 */
function addCommentToPost($postId, $commentData){
    $errorMessage = ['name'=>'', 'email'=>'', 'comment'=>''];

    // name validation
    if(empty($commentData['name'])){
        $errorMessage['name'] = "Name is required"."</br>";
    }
    else{
        if(strlen($commentData['name']) > 255){
            $errorMessage['name'] = "Please do not enter more than 255 characters"."</br>";
        }
        if(!preg_match('/^[a-zA-Z\s]+$/', $commentData['name'])){
            $errorMessage['name'] =  "Name must consist of letters and spaces only"."<br>";
        }
    }

    // email validation
    if(empty($commentData['email'])){
        $errorMessage['email'] = "Email is required"."</br>";
    }
    else{
        if(!filter_var($commentData['email'], FILTER_VALIDATE_EMAIL)){
            $errorMessage['email'] =  "Please enter a valid email address"."<br>";
        }
    }

    // comment validation
    if(empty($commentData['comment'])){
        $errorMessage['comment'] = "Comment is required"."</br>";
    }

    if(!array_filter($errorMessage)){
        $conn = connectToDatabase();

        $postId = trim(mysqli_real_escape_string($conn, $postId));
        $name = trim(mysqli_real_escape_string($conn, $commentData['name']));
        $email = trim(mysqli_real_escape_string($conn, $commentData['email']));
        $comment = trim(mysqli_real_escape_string($conn, $commentData['comment']));

        // Insert SQL query
        $sql = "INSERT INTO comments(post_id, name, website, text) VALUES('$postId', '$name', '$email', '$comment')";

        if(mysqli_query($conn, $sql)){
            // success
            header("Location: ../view-post.php?postId=$postId");
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
    return $errorMessage;
}