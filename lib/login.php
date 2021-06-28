<?php
/*  
 * Check if the login field(s) is empty.
 *
 *@param arr $credential
 *@param arr $errorMessage
 *
 *@return arr $errorMessage 
 */
function fieldEmpty($credential, $errorMessage){
    // Check if username is empty
    if(empty(trim($credential['username']))){
        $errorMessage['username'] = "Please enter username"."</br>";
    }

    // Check if password is empty
    if(empty(trim($credential['password']))){
        $errorMessage['password'] = "Please enter password"."</br>";
    }

    return $errorMessage;
}

/*  
 *@param mysqli $conn
 *@param arr $user_id
 *@param arr $errorMessage
 * 
 */
function tryLogin($conn, $credential, $errorMessage){
    
    $username = mysqli_real_escape_string($conn, trim($credential['username']));

    $sql = "SELECT id, username, password FROM user WHERE username='$username'";

    $result = mysqli_query($conn, $sql);

    if (!mysqli_num_rows($result)) {
        $errorMessage['username'] = "No such username exists";
    }
    else{
        $user = mysqli_fetch_assoc($result);
        $sucess = password_verify($credential['password'], $user['password']);
        if(!$sucess){
            $errorMessage['password'] = "Invalid password";
        }
    }
    
    return $errorMessage;
}

/**
 * Set Session Variables for logged in user
 *
 * @param mysqli $conn
 * @param string $username
 */
function login($conn, $username)
{
    $username = mysqli_real_escape_string($conn, $username);

    $sql = "SELECT id, username FROM user WHERE username='$username'";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
                            
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["user_id"] = $user['id'];
    $_SESSION["username"] = $user['username'];                            
    
    // Redirect user to welcome page
    header("location: index.php");
}