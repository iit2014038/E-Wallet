<?php
include('lock.php');

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

$var = 0;
$query2 = "SELECT customer_id FROM customers where user_name='".$_SESSION['login_user']."'";
		$receiver_id = mysqli_query($connection,$query2);
		if ($receiver_id->num_rows > 0) 
		{
			while($row = $receiver_id->fetch_assoc()) 
			{
				$sen_id = $row["customer_id"];
			}
		}

$query1 = "SELECT customer_id,amount FROM request_group INNER JOIN requests ON request_group.rid = requests.rid where friend1='".$sen_id."'";
$number = mysqli_query($connection,$query1);
if ($number->num_rows > 0) 
	{
		while($row = $number->fetch_assoc()) 
		{
			$var = $var + 1;
		}
	}
//	$_SESSION['noti_count']=$var;
	echo "$var request pending";


?>
