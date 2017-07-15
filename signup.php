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
if(isset($_POST['action']))
{          
   
    if($_POST['action']=="signup")
    {	
	  
		
        $name       = mysqli_real_escape_string($connection,$_POST['name']);
        $username      = mysqli_real_escape_string($connection,$_POST['username']);
        $password   = mysqli_real_escape_string($connection,$_POST['password']);
		$cardnumber = mysqli_real_escape_string($connection,$_POST['card_number']);
		$email = mysqli_real_escape_string($connection,$_POST['email']);
		$cvv = mysqli_real_escape_string($connection,$_POST['cvv']);
        $query = "SELECT user_name FROM customers where user_name='".$username."'";
        $result = mysqli_query($connection,$query);
		$numResults = mysqli_num_rows($result);
		
		
		// Create connection
		$connection2 = new mysqli($servername, "root", "", "bank");
       // Check connection
		if ($connection2->connect_error) {
			die("Connection failed: " . $connection2->connect_error);
		}
		$cardnumber2 = mysqli_real_escape_string($connection2,$_POST['card_number']);
		$query1 = "select * from accounts where credit_card_number= '".$cardnumber2."' AND cvv='".$cvv."'";
		$result1= mysqli_query($connection2,$query1);
		$numResults1 = mysqli_num_rows($result1);
		
		
		if($numResults >=1)
        {	
			
			//functio prompt($prompt_msg){
			//	echo("<script type='text/javascript'> var answer = alert('".$prompt_msg."'); </script>");
			//}
			
			$message = "Username ".$username." already exists.";
			
        }
		else if($numResults1 == 0)
		{
			 $message = "Card details do not match. Invalid CVV or Card no.";
		}
        else
        {	
			$sql= "insert into customers( `customer_name`, `user_name`, `password`, `card_number`,email,active) values
			('".$name."','".$username."','".md5($password)."','".$cardnumber."','".$email."','0')"; 
            
			if($connection->query($sql) === TRUE){
				
				$message =  "signup successful!	activation link has been sent to ur specfied email";
				/*
				$to = $email;
				$subject = "Hello".$name;
				$txt = "Welcome to Rokda.com. You have successfully signed up.";
				mail($to,$subject,$txt,'From: exyash06@gmail.com'); 
				*/

				require("class.phpmailer.php");
				$mail = new PHPMailer(true);

				//Send mail using gmail
				    $mail->IsSMTP(); // telling the class to use SMTP
				    $mail->SMTPDebug = 2;
				    $mail->From = "goplutus@gmail.com";
				    $mail->Fromname = "anupam";
				    $mail->Host = "smtp.gmail.com"; // sets GMAIL as the SMTP server
				    $mail->SMTPSecure = "ssl";
				    $mail->Port = 465; // set the SMTP port for the GMAIL server
				    $mail->SMTPAuth = true;
				    $mail->Username = "goplutus@gmail.com"; // GMAIL username
				    $mail->Password = "plutusewallet"; // GMAIL password


				//Typical mail data
				$mail->AddAddress("$email", "$name");
				$mail->IsHTML(true);
				$mail->Subject = "My plutus Account Activation";
				$mail->Body = ' Thanks for signing up! <br>

							Please click this link to activate your account<br>
							http://localhost/ewallet/final/verify.php?email='.$email.'&hash='.md5($password).'	';

				try{
				    $mail->Send();
				    echo "Success!";
				} catch(Exception $e){
				    //Something went bad
				    echo "Fail :(";
				}


			}
			else {
				$message=  "Error: " . $sql . "<br>" . $connection->error;
				}
        }
		//echo $message;
		echo "<script> window.alert('".$message."');</script>";
            
			header("Refresh:0.2 register2.php");
		
}
}
?>

  
<!--
    <form action="" method="post">
    <p><input id="name" name="name" type="text" placeholder="Name"></p>
    <p><input id="username" name="username" type="text" placeholder="User Name"></p>
    <p><input id="password" name="password" type="password" placeholder="Password">
    <input name="action" type="hidden" value="signup" /></p>
	<p><input id="email" name="email" type="text" placeholder="E-mail ID"></p>
	<p><input id="card_number" name="card_number" type="text" placeholder="Card Number"></p>
    <p><input type="submit" value="Signup" /></p>
  </form>
-->