<?php

//USE THIS FOR welcome.php AND ALL PAGES THAT LINKS FROM IT
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysqli_connect("localhost", "root", "", "test");

// Starting Session
session_start();

// Storing Session
$user_check = $_SESSION['login_user'];

// SQL Query To Fetch Complete Information Of User
$ses_sql = mysqli_query($connection, "select username from login_table where username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session = $row['username'];

//This will return you to login.php if you try to access the the welcome.php forcibly without logging in
if (!isset($login_session)) {
    mysqli_close($connection); // Closing Connection
    header('Location: login.php'); // Redirecting To Home Page
}
