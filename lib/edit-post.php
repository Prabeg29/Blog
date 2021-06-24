<?php
/* *
 * Insert new post 
 * 
 * @param $conn
 * @param int $userId
 * @param arr $postData
 * 
 * @returns array $errorMessage
 */


function addPost($conn, $userId, $postData, $errorMessage){
    // title validation
    if(empty($postData['title'])){
        $errorMessage['post-title'] = "Name is required!"."</br>";
    }
    else{
        if(strlen($postData['title']) > 255){
            $errorMessage['post-title'] = "Please do not enter more than 255 characters"."</br>";
        }
    }
    // email validation
    if(empty($postData['body'])){
        $errorMessage['post-body'] = "Name is required!"."</br>";
    }
    else{
        if(strlen($postData['body']) > 255){
            $errorMessage['post-body'] = "Please do not enter more than 255 characters"."</br>";
        }
    }

    if(!array_filter($errorMessage)){

        foreach($postData as &$pd){
            $pd = trim(mysqli_real_escape_string($conn, $cd));
        }

        // Insert SQL query
        $sql = "INSERT INTO post(title, body, user_id) VALUES('{$postData['title']}', '{$postData['body']}', '$userId')";

        if(mysqli_query($conn, $sql)){
            // success
            header("Location: index.php");
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
    return $errorMessage;

}

/* *
 * Insert new post 
 * 
 * @param $conn
 * @param int $userId
 * @param arr $postData
 * 
 * @returns array $errorMessage
 */


function editPost($conn, $userId, $postData, $errorMessage){
    // title validation
    if(empty($postData['title'])){
        $errorMessage['post-title'] = "Name is required!"."</br>";
    }
    else{
        if(strlen($postData['title']) > 255){
            $errorMessage['post-title'] = "Please do not enter more than 255 characters"."</br>";
        }
    }
    // email validation
    if(empty($postData['body'])){
        $errorMessage['post-body'] = "Name is required!"."</br>";
    }
    else{
        if(strlen($postData['body']) > 255){
            $errorMessage['post-body'] = "Please do not enter more than 255 characters"."</br>";
        }
    }

    if(!array_filter($errorMessage)){

        foreach($postData as &$pd){
            $pd = trim(mysqli_real_escape_string($conn, $cd));
        }

        // Update SQL query
        $sql = "";

        if(mysqli_query($conn, $sql)){
            // success
            header("Location: index.php");
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }
    return $errorMessage;

}