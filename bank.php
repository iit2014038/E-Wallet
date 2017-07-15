<?php
	$db_hostname="localhost";
	$db_username = "root";
	$db_password = "";
	$db_name = "bank";
	
	$connection=new mysqli($db_hostname,$db_username,$db_password,$db_name);
	if($connection->connect_error) die($connection->connect_error);
	if(isset($_POST['name'])&& isset($_POST['an'])&& isset($_POST['ccn'])&& isset($_POST['cvv'])&& isset($_POST['balance']))
	{
		$name=get_post($connection,'name');
		$an=get_post($connection,'an');
		$ccn=get_post($connection,'ccn');
		$cvv=get_post($connection,'cvv');
		$balance=get_post($connection,'balance');	
		$query="insert into accounts values"."('$an','$ccn','$name','$cvv','$balance')";
		$result=$connection->query($query);
		if(!$result) {
			$message = "Error in creating account!";
			echo "<script> window.alert('".$message."');</script>";
			header("Refresh:0.2 bank_admin.php");
		}
		else {
			$message = "Bank Account successfully created.";
			echo "<script> window.alert('".$message."');</script>";
			header("Refresh:0.2 bank_admin.php");
		}
	}
	$connection->close();
	function  get_post($connection,$var)
	{
		return $connection->real_escape_string($_POST[$var]);
	}
	
?>