<!DOCTYPE html>
<html>
    <head>
        <title>
            A blog application | Login
        </title>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    </head>
    <body>
        <?php require 'template/title.php' ?>
        <p>Login here:</p>
        <form method="POST" action="">
            <p>
                <label for="username">Username: </label> 
                <input type="text" name="username" />
            </p>
            <p>
                <label for="password">Password: </label>
                <input type="password" name="password" />
            </p>
            <input type="submit" name="submit" value="Login" />
        </form>
    </body>
</html>