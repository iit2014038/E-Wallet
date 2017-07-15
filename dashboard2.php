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
        $strSQL = mysqli_query($connection,"select customer_name from customers where user_name='".$username."' and password='".md5($password)."' and active='1' ");
        $Results = mysqli_fetch_array($strSQL);
		$count= mysqli_num_rows($strSQL); // an user cant login if active = 0;
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
	
	$cardno= mysqli_query($connection,"select card_number from customers where user_name='".$username."'");
	$row=mysqli_fetch_array($cardno,MYSQLI_ASSOC);
	$card_no =$row['card_number'];
	
	$connection2 = new mysqli($servername, "root", "", "bank");
// Check connection
	if ($connection2->connect_error) {
    die("Connection failed: " . $connection2->connect_error);
	}else{
		$bal= mysqli_query($connection2,"select balance from accounts where credit_card_number=$card_no");
		$row=mysqli_fetch_array($bal,MYSQLI_ASSOC);
		$balance =$row['balance'];
	}
	
	if($count==1)
	{
	$_SESSION['login_user']=$username;
	$_SESSION['login_id']= $login_id;
	$_SESSION['balance']= $balance;
	$_SESSION['cardnumber'] = $card_no;
	header("location: dashboard.php");
	}
	else
	{
		header("location: new.php");
	}
	
}


}

?>