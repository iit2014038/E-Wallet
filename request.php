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
   
    if($_POST['action']=="request")
    {	
		$username2 = "";
		$username3 = "";
		$username4 = "";
		$username5 = "";
	  $username1       = mysqli_real_escape_string($connection,$_POST['username1']);
	 if(isset($_POST['username2']))
	  $username2       = mysqli_real_escape_string($connection,$_POST['username2']);
	  if(isset($_POST['username3']))
	  $username3      = mysqli_real_escape_string($connection,$_POST['username3']);
	  if(isset($_POST['username4']))
	  $username4       = mysqli_real_escape_string($connection,$_POST['username4']);
	  if(isset($_POST['username5']))
	  $username5       = mysqli_real_escape_string($connection,$_POST['username5']);
	
        $amount  = mysqli_real_escape_string($connection,$_POST['request_amount']);
	   
		
		$receiver_id=$_SESSION['login_id'];
		
		
		$ses_sql=mysqli_query($connection,"select rid from requests where customer_id= $receiver_id ");
		$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
		$receiver_username=$row['rid'];
		
		
		
		
        $query =  "SELECT customer_id FROM customers where user_name='".$username1."'";
        $result = mysqli_query($connection,$query);
		$row=mysqli_fetch_array($result,MYSQLI_ASSOC);
		if( mysqli_num_rows($result) == 0)
			$request_id1 = 0;
		else
			$request_id1=$row['customer_id'];
		
		
		$query2 =  "SELECT customer_id FROM customers where user_name='".$username2."'";
        $result2 = mysqli_query($connection,$query2);
		$row=mysqli_fetch_array($result2,MYSQLI_ASSOC);
		if( mysqli_num_rows($result2) == 0)
			$request_id2= 0;
		else
		$request_id2=$row['customer_id'];
		
		$query3=  "SELECT customer_id FROM customers where user_name='".$username3."'";
        $result3 = mysqli_query($connection,$query3);
		$row=mysqli_fetch_array($result3,MYSQLI_ASSOC);
		if( mysqli_num_rows($result3) == 0)
			$request_id3= 0;
		else
		$request_id3=$row['customer_id'];
		
		$query4 =  "SELECT customer_id FROM customers where user_name='".$username4."'";
        $result4 = mysqli_query($connection,$query4);
		$row=mysqli_fetch_array($result4,MYSQLI_ASSOC);
		if( mysqli_num_rows($result4) == 0)
			$request_id4= 0;
		else
		$request_id4=$row['customer_id'];
		
		$query5 =  "SELECT customer_id FROM customers where user_name='".$username5."'";
        $result5 = mysqli_query($connection,$query5);
		$row=mysqli_fetch_array($result5,MYSQLI_ASSOC);
		if( mysqli_num_rows($result5) == 0)
			$request_id5= 0;
		else
		$request_id5=$row['customer_id'];
		
        $numResults = mysqli_num_rows($result);

        if($numResults ==0)
        {   
            $message = "No user with username  ".$username1;
        }
        else
        {
           $ses_sql=mysqli_query($connection,"select max(rid) from requests ");
			$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
			$r_id= $row['max(rid)'];
		   
            $sql= " insert into requests( customer_id, amount,r_date) values($receiver_id,$amount,CURDATE())";
			$sql1 = "INSERT INTO `request_group`(`rid`, `friend1`, `friend2`, `friend3`, `friend4`, `friend5`, `status`) VALUES ($r_id +1,$request_id1,$request_id2,$request_id3,$request_id4,$request_id5, 0)";
            if($connection->query($sql) === TRUE){
				if($connection->query($sql1) === TRUE){
                $message =  "Request sent!";
			}
			else {
                $message=  "Error: " . $sql1 . "<br>" . $connection->error;
            }
			}
            else {
                $message=  "Error: " . $sql . "<br>" . $connection->error;
                }
			}
        echo $message;


}
}
?>