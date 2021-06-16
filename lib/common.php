<?php

/* 
 * Returns the conn object for database access
 * 
 * @return $conn 
 *  */
function connectToDatabase(){
    $servername = 'localhost';
    $username = 'prabeg';
    $password = 'test1234';
    $database = 'blog';

    // Create Connection
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check Connection
    if($conn->connect_error){
        die("Conneciton failed: " . $conn->connect_error);
    }
    else{
        return $conn;
    }
}

/* 
 * Returns the number of comments for the specified post
 * @param integer $postId
 * @return integer 
 *  */
function countCommentsForPost($postId){
    $conn = connectToDatabase();
 
    $sql = "SELECT COUNT(*) FROM comments WHERE post_id=$postId";
    
    $result = mysqli_query($conn, $sql);

    $commentCount = mysqli_fetch_row($result);
    
    return (int) $commentCount[0];
}