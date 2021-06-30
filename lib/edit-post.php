<?php
/* *
 * Validate the input for Post
 * 
 * @param arr $postData
 * @param arr $errorMessage 
 * 
 * @return bool
 */
function validatePost($postData, &$errorMessage){
    

    // title validation
    if(empty($postData['title'])){
        $errorMessage['postTitle'] = "Title is required!"."</br>";
    }
    else{
        if(strlen($postData['title']) > 255){
            $errorMessage['postTitle'] = "Please do not enter more than 255 characters"."</br>";
        }
    }
    // body validation
    if(empty($postData['body'])){
        $errorMessage['postBody'] = "Body is required!"."</br>";
    }
    else{
        if(strlen($postData['body']) > 255){
            $errorMessage['postBody'] = "Please do not enter more than 255 characters"."</br>";
        }
    }

    return empty($errorMessage['postTitle']) || empty($errorMessage['postBody']) ;
}

/* *
 * Insert new post 
 * 
 * @param my_sqli $conn
 * @param int $userId
 * @param arr $postData
 * 
 * @returns int $postId
 */
function addPost($conn, $userId, $postData){

    foreach($postData as &$pd){
        $pd = trim(mysqli_real_escape_string($conn, $pd));
    }

    // Insert
    $sql = "INSERT INTO post(title, body, user_id) VALUES('{$postData['title']}', '{$postData['body']}', '$userId')";

    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo 'query error: ' . mysqli_error($conn);
    }

    // Statement to get postId 
    $sql = "SELECT id FROM post ORDER BY id DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);
    } 
    else {
        echo 'query error: ' . mysqli_error($conn);
    }

    return (int)$post['id'];
}

/* *
 * Edit existing post 
 * 
 * @param $conn
 * @param arr $postData
 * 
 * @throws exception
 */
function editPost($conn, $postData){
    foreach($postData as &$pd){
        $pd = trim(mysqli_real_escape_string($conn, $pd));
    }

    // Update
    $sql = "UPDATE post SET title = '{$postData['title']}', body = '{$postData['body']}' WHERE id = '{$postData['id']}'";

    $result = mysqli_query($conn, $sql);

    if(!$result){
        echo 'query error: ' . mysqli_error($conn);
    }

    return true;
}