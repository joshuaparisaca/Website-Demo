<?php
include('login_index.php'); // Includes Login Script

if(isset($_SESSION['login_user']))
{
    header("location: welcome.php");
}

?>
<!DOCTYPE html>
<!-- Save all html files as .php files -->
<!-- Do not create a database to to enter a username or password -->
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta charset="utf-8" />
        <title>Login</title>
        <link rel="stylesheet" href="StyleSheet1.css" />
        <link rel="shortcut icon" href="letter_J.png" />

        <link rel="shortcut icon" href="http://www.example.com/myicon.ico" /> <!--The little icon in the tab-->
    </head>

    <body>
        <div class="container">
            <div class="label">Login</div>
            <form method="POST" autocomplete="OFF" action="">
                <input type="text" placeholder="Username" spellcheck="false" class="loginField" name="usernameInput" />
                <input type="password" placeholder="Password" class="loginField" name="passwordInput"/>
                <button type="submit" class="buttonField" name="submit">Login</button>
                <div class="tooltip">
                    Forgot Password?
                    <span class="tooltiptext">Username: root Password: toor</span>
                </div>
                <span> <?php echo $error ?> </span>
            </form>
        </div>
    </body>
</html>