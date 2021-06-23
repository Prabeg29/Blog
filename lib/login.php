<?php
/*  
 *
 * 
 */
function tryLogin($conn, $credentials, $errorMessage){
    // Check if username is empty
    if(empty(trim($credentials['username']))){
        $errorMessage['username'] = "Please enter username"."</br>";
    }

    // Check if password is empty
    if(empty(trim($credentials['password']))){
        $errorMessage['password'] = "Please enter password"."</br>";
    }

    $username = mysqli_real_escape_string($conn, $credentials['username']);

    $sql = "SELECT * FROM user WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $hash = $user['password'];

        $errorMessage['success'] = password_verify($credentials['password'], $hash);
    }
    else{
        echo "No such username exists";
    }
    
    return $errorMessage;
}

/**
 * Logs the user in
 *
 * For safety, we ask PHP to regenerate the cookie, so if a user logs onto a site that a cracker
 * has prepared for him/her (e.g. on a public computer) the cracker's copy of the cookie ID will be
 * useless.
 *
 * @param string $username
 */
function login($username)
{
    session_start();
                            
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    //$_SESSION["id"] = $id;
    $_SESSION["username"] = $username;                            
    
    // Redirect user to welcome page
    header("location: index.php");
}