<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ewallet";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);
session_start();
$user_check=$_SESSION['login_user'];

$ses_sql=mysqli_query($db,"select user_name from customers where user_name='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_session=$row['user_name'];

if(!isset($login_session))
{
header("Location: login.php");
}
?>