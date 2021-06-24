<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }
    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/login.php');

    $errorMessage = ['username'=>'', 'password'=>''];
    $credentials = [
        'username'=>'',
        'password'=>''
    ];
    if(isset($_POST['login'])){

        $credentials['username'] = $_POST['username'];
        $credentials['password'] = $_POST['password'];

        $errorMessage = tryLogin($conn, $credentials, $errorMessage);
        if ($errorMessage['success']){
            login($credentials['username']);
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            A blog application | Login
        </title>
        <?php require 'template/head.php'?>
    </head>
    <body>
        <?php require 'template/title.php' ?>
        <p>Login here:</p>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
            <p>
                <label for="username">Username: </label> 
                <input type="text" name="username" value="<?php echo htmlspecialchars($credentials['username']);?>" />
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="password" name="password" value="<?php echo htmlspecialchars($credentials['password']);?>"/>
            </p>
            <input type="submit" name="login" value="Login" />
        </form>
    </body>
</html>