<?php
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

	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
	{
    	// Verify data
	    $email = mysqli_real_escape_string($connection,$_GET['email']); // Set email variable
	    $hash = mysqli_real_escape_string($connection,$_GET['hash']); // Set hash variable	
	    $query = "SELECT email FROM customers WHERE email='".$email."' AND password='".$hash."' AND active='0'";
		$search = mysqli_query($connection,$query);
		$match  = mysqli_num_rows($search);

		if($match > 0)
		{
	 	   // We have a match, activate the account
			$query2 = "UPDATE customers SET active='1' WHERE email='".$email."' AND password='".$hash."' AND active='0'";
			if($connection->query($query2) === TRUE)
			{
				echo "Your accont has been successfully activated !";
			}

		}
		else
		{
	    	echo "sorry , entered link doesn't exist";
		}

	}

?>