<?php
//echo "hello";
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
    if($_POST['action']=="change")
    {	

        $oldp = mysqli_real_escape_string($connection,$_POST['old_pwd']);
        $newp = mysqli_real_escape_string($connection,$_POST['new_pwd']);
		
        $resoldp = mysqli_query($connection,"select customer_name from customers where password='".md5($oldp)."' AND customer_id='".$_SESSION['login_id']."'");
    //    $Results = mysqli_fetch_array($resoldp);
		$count= mysqli_num_rows($resoldp);
	
		if($count==1) {
			$qupdate = "UPDATE customers set password='".md5($newp)."' WHERE customer_id='".$_SESSION['login_id']."'";
			//echo $qupdate ;
			$query2 = mysqli_query($connection, $qupdate);
			//$Results = mysqli_fetch_array($query2);
			//$count1= mysqli_num_rows($query2);
			//if($count1==1){
			echo "Password Changed Successfully.";
			//}
		}
		else {
			echo "Not done";
		}
	}
}
?>