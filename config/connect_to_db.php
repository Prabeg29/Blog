<?php

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

?>
