<?php


    /* *
    * Returns all the published posts
    * 
    * @return array $posts 
    *  */
    function getAllPosts($conn){
        // Statement to get all posts
        $sql = "SELECT id, title, body, created_at FROM post ORDER BY created_at DESC";

        // Query the database and get posts
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
        }
        
        return $posts;
    }

    /* 
    * Returns the number of comments for the specified post
    * 
    * @param integer $postId
    * @param $conn
    * 
    * @return integer 
    *  */
    function commentCountForPost($conn, $postId){
    
        $sql = "SELECT COUNT(*) FROM comments WHERE post_id=$postId";
        
        $result = mysqli_query($conn, $sql);

        $commentCount = mysqli_fetch_row($result);

        return (int) $commentCount[0];
    }