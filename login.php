<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ewallet";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
if(isset($_POST['action']))
{          
    if($_POST['action']=="login")
    {	

        $username = mysqli_real_escape_string($connection,$_POST['username']);
        $password = mysqli_real_escape_string($connection,$_POST['password']);
        $strSQL = mysqli_query($connection,"select customer_name from customers where user_name='".$username."' and password='".md5($password)."'");
        $Results = mysqli_fetch_array($strSQL);
		$count= mysqli_num_rows($strSQL);
		/*
        if(count($Results)>=1)
        {
            $message = $Results['customer_name']." Login Sucessfully!!";
        }
        else
        {
            $message = "Invalid username or password!!";
        } 
		echo $message;
    }
	
	*/
	// fetch customer_id using user_name from table
	$loginid= mysqli_query($connection,"select customer_id from customers where user_name='".$username."'");
	$row=mysqli_fetch_array($loginid,MYSQLI_ASSOC);
	$login_id=$row['customer_id'];
	
	
	if($count==1)
	{
	$_SESSION['login_user']=$username;
	$_SESSION['login_id']= $login_id;
	header("location: welcome.php");
	}
	else
	{
	$message="Your Login Name or Password is invalid";
	echo $message;
	}
	
}


}

?>

 <form action="" method="post">
    <p><input id="username" name="username" type="text" placeholder="User Name"></p>
    <p><input id="password" name="password" type="password" placeholder="Password">
    <input name="action" type="hidden" value="login" /></p>
    <p><input type="submit" value="Login" /></p>
  </form>