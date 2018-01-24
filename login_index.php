<?php

session_start(); // Starting Session
$error = ''; // Variable To Store Error Message

if (isset($_POST['submit'])) 
{
    if (empty($_POST['usernameInput']) || empty($_POST['passwordInput'])) 
    {
        $error = "Username or Password is invalid";
    } 
    else 
    {
        // Define $username and $password
        $username = $_POST['usernameInput'];
        $password = $_POST['passwordInput'];
        
        // Establishing Connection with Server by passing server_name, user_id and password as a parameter
        $connection = mysqli_connect("localhost", "root", "", "test");
        
        // To protect MySQL injection for Security purpose
        $username = stripslashes($username);
        $password = stripslashes($password);
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        
        // SQL query to fetch information of registerd users and finds user match.
        $query = mysqli_query($connection, "select * from login_table where username='$username' AND password='$password'");
        $rows = mysqli_num_rows($query);
        
        if ($rows == 1) 
        {
            $_SESSION['login_user'] = $username; // Initializing Session
            header("location: welcome.php"); // Redirecting To Other Page
        } 
        else 
        {
            $error = "Username or Password is invalid";
        }
        mysqli_close($connection); // Closing Connection
    }
}
?>