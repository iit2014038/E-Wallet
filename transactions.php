<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ewallet";

	//$connection=new mysqli($db_hostname,$db_username,$d_password,'ewallet');
	$connection = new mysqli($servername, $username, $password, $dbname);
	//if($connection->connect_error) die($connection->connect_error);
	if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

	$sen_id = $_SESSION['login_id'];
	
	$query = "SELECT * FROM transactions where sender_id='".$sen_id."' || reciever_id='".$sen_id."' order by t_date desc";
	$result=mysqli_query($connection,$query);
	
	if($result->num_rows > 0)
	{
		while($row=$result->fetch_assoc())
		{
			if($row['sender_id']==$sen_id)
			{
			$query3 = "SELECT user_name FROM customers where customer_id='".$row['reciever_id']."'";
			$receiver_id2 = mysqli_query($connection,$query3);
			$rec_id='admin';
			if ($receiver_id2->num_rows > 0) 
			{
				while($row3 = $receiver_id2->fetch_assoc()) 
				{
					$rec_id = $row3["user_name"];
				}
			}
				if($row['transaction_type']=='g')
				{
					echo $row['tid'] . " " .$row['t_date']. " You gifted " .$rec_id ." ".$row['amount'] ;
					echo "<br>";
				}
				if($row['transaction_type']=='l')
				{
					echo $row['tid'] . " " .$row['t_date']. " You loaned " .$rec_id ." ".$row['amount'] ;
					echo "<br>";
				}
			}
			else
			{
			$query4 = "SELECT user_name FROM customers where customer_id='".$row['sender_id']."'";
			$receiver_id3 = mysqli_query($connection,$query4);
			$rec_id = 'admin';
			if ($receiver_id3->num_rows > 0) 
			{
				while($row2 = $receiver_id3->fetch_assoc()) 
				{
					$rec_id = $row2["user_name"];
				}
			}
				if($row['transaction_type']=='g')
				{
					echo $row['tid'] . " " .$row['t_date']. " ".$rec_id ." gifted you ".$row['amount'];
					echo "<br>";
				}
				if($row['transaction_type']=='l')
				{
					echo $row['tid'] . " " .$row['t_date']. " ".$rec_id ." loaned you ".$row['amount'];
					echo "<br>";
				}
			}
		}
	}
?>