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
   
    if($_POST['action']=="send")
    {	
        $username    = mysqli_real_escape_string($connection,$_POST['username']);
        $amount      = mysqli_real_escape_string($connection,$_POST['amount']);
        $query = "SELECT user_name FROM customers where user_name='".$username."'";
        $result = mysqli_query($connection,$query);
		$numResults = mysqli_num_rows($result);
				
		if($numResults !=1)
        {	
				echo "<script> window.alert('".$username." does not exist');</script>";
				header("Refresh:0.2 dashboard.php#gift");
		
       //     echo " User Name doesn't exist!!";
        }
	
		else
		{	
			$query2 = "SELECT customer_id FROM customers where user_name='".$username."'";
			$receiver_id = mysqli_query($connection,$query2);
			if ($receiver_id->num_rows > 0) 
			{
				while($row = $receiver_id->fetch_assoc()) 
				{
					$rec_id = $row["customer_id"];
				}
				//echo $rec_id;
			}
		
			$query6 = "SELECT card_number FROM customers where user_name='".$username."'";
			$rec_card_number = mysqli_query($connection,$query6);
		
			$query3 = "SELECT customer_id FROM customers where user_name='".$_SESSION['login_user']."'";
			$sender_id = mysqli_query($connection,$query3);
			if ($sender_id->num_rows > 0) 
			{
				while($row = $sender_id->fetch_assoc()) 
				{
					$sen_id = $row["customer_id"];
				}
				//echo $sen_id;
			}
		
			$query5 = "SELECT card_number FROM customers where user_name='".$_SESSION['login_user']."'";
			$card_number = mysqli_query($connection,$query5);
		
			// Create connection
			$connection2 = new mysqli($servername, "root", "", "bank");
		// Check connection
			if ($connection2->connect_error) {
				die("Connection failed: " . $connection2->connect_error);
			}
			if ($card_number->num_rows > 0) 
			{
				while($row = $card_number->fetch_assoc()) 
				{
					$query4 = "UPDATE Accounts SET balance = balance-$amount WHERE credit_card_number='".$row["card_number"]."'";
					if ($connection2->query($query4) === TRUE) 
						echo "";
					else 
					{
						echo "";
					}
				}
			}
			$_SESSION['balance'] = $_SESSION['balance'] - $amount;
			if ($rec_card_number->num_rows > 0) 
			{
				while($row = $rec_card_number->fetch_assoc()) 
				{
					$query7 = "UPDATE Accounts SET balance = balance+$amount WHERE credit_card_number='".$row["card_number"]."'";
					
					if ($connection2->query($query7) === TRUE) 
						echo "";
					else 
					{
						echo "";
					}
				}
			}
			mysqli_close($connection2);
			$sql= "insert into transactions( amount , sender_id , reciever_id , t_date , transaction_type ) values
			( $amount , $sen_id , $rec_id , NOW() , 'g' )"; 	// fill in date properly spelling of receiver_id is wrong is transactions table take care
            
			if ($connection->connect_error) {
				die("Connection failed: " . $connection->connect_error);
				}

			if($connection->query($sql) == TRUE) {
					$message = "Gifted Successfully!";
					echo "<script> window.alert('".$message."');</script>";
					header("Refresh:0.2 dashboard.php");
		
			}
			else {
					$message="Failed!";
					echo "<script> window.alert('".$message."');</script>";
					header("Refresh:0.2 dashboard.php");
		
				}
        }
	
		
	}
}

?>
