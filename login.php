<?php
    session_start();

    if(isset($_SESSION['loggedin'])){
        header('Location: index.php');
    }

    require_once('./config/config.php');
    require_once('./lib/db.php');
    require_once('./lib/login.php');

    $errorMessage = ['username'=>'', 'password'=>''];

    $credential = [
        'username'=>'',
        'password'=>''
    ];

    if(isset($_POST['login'])){

        $credential['username'] = trim($_POST['username']);
        $credential['password'] = trim($_POST['password']);

        $errorMessage = fieldEmpty($credential, $errorMessage);

        if(empty($errorMessage['username']) || empty($errorMessage['password'])){
            $errorMessage = tryLogin($conn, $credential, $errorMessage);
            if($errorMessage['username']){
                echo $errorMessage['username'];
            }
            else if($errorMessage['password']){
                echo $errorMessage['password'];
            }
            else{
                login($conn, $credential['username']);
            }
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
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>" class="user-form">
            <div>
                <label for="username">Username: </label> 
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($credential['username']);?>" />
                <div>
                    <?php echo $errorMessage['username']; ?>
                </div>
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($credential['password']);?>"/>
                <div>
                    <?php echo $errorMessage['username']; ?>
                </div>
            </div>
            <input type="submit" name="login" value="Login" />
        </form>
    </body>
</html>