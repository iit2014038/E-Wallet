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
	if(isset($_GET['a'])) {
    	$userid = $_GET['a'];
		$getrid = $_GET['b'];
		//echo "$userid"." $getrid";
		
		$query2 = "SELECT customer_id FROM customers where user_name='".$_SESSION['login_user']."'";
		$sender_id = mysqli_query($connection,$query2);
		if ($sender_id->num_rows > 0) 
		{
			while($row = $sender_id->fetch_assoc()) 
			{
				$granter_id = $row["customer_id"];
			}
		}
		
		$query3 = "SELECT amount FROM requests where rid='".$getrid."'";
		$r_id = mysqli_query($connection,$query3);
		if ($r_id->num_rows > 0) 
		{
			while($row = $r_id->fetch_assoc()) 
			{
				$amt = $row["amount"];
			}
		}

		
		$sql= "insert into transactions( amount , sender_id , reciever_id , t_date , transaction_type ) values
			( $amt , $granter_id , $userid , '2015-03-20' , 'r' )";
		if($connection->query($sql) == TRUE)
				echo "";
			else {
				echo "Error";
				}
				
		$query4 = "DELETE FROM request_group where rid='".$getrid."'";
		if($connection->query($query4) == TRUE)
				echo "";
			else {
				echo "Error";
				}
		
		$query5 = "DELETE FROM requests where rid='".$getrid."'";
		if($connection->query($query5) == TRUE)
				echo "";
			else {
				echo "Error";
				}
				
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "bank";

// Create connection
	$connection2 = new mysqli($servername, $username, $password, $dbname);
// Check connection
	if ($connection2->connect_error) {
		die("Connection failed: " . $connection2->connect_error);
		
  	}
	$query5 = "SELECT card_number FROM customers where user_name='".$_SESSION['login_user']."'";
	$card_number = mysqli_query($connection,$query5);
	
	if ($card_number->num_rows > 0) 
			{
				while($row = $card_number->fetch_assoc()) 
				{
					$query4 = "UPDATE Accounts SET balance = balance-$amt WHERE credit_card_number='".$row["card_number"]."'";
					if ($connection2->query($query4) === TRUE) 
						echo "";
					else 
					{
						echo "";
					}
				}
			}
			$_SESSION['balance'] = $_SESSION['balance'] - $amt;
	
	
	$query6 = "SELECT card_number FROM customers where customer_id='".$userid."'";
	$rec_card_number = mysqli_query($connection,$query6);
	
	if ($rec_card_number->num_rows > 0) 
			{
				while($row = $rec_card_number->fetch_assoc()) 
				{
					$query7 = "UPDATE Accounts SET balance = balance+$amt WHERE credit_card_number='".$row["card_number"]."'";
					
					if ($connection2->query($query7) === TRUE) 
						echo "";
					else 
					{
						echo "";
					}
				}
			}
		
	}
	if(isset($_GET['c']))
	{
		$query2 = "SELECT customer_id FROM customers where user_name='".$_SESSION['login_user']."'";
		$receiver_id = mysqli_query($connection,$query2);
		if ($receiver_id->num_rows > 0) 
		{
			while($row = $receiver_id->fetch_assoc()) 
			{
				$sen_id = $row["customer_id"];
			}
		}
		
		$getid=$_GET['d'];
		$query6="update request_group set friend1=NULL where rid='".$getid."' and friend1='".$sen_id."'";
		if($connection->query($query6) == TRUE)
				echo "";
			else {
				echo "Error";
				}
		$query6="update request_group set friend2=NULL where rid='".$getid."' and friend2='".$sen_id."'";
		if($connection->query($query6) == TRUE)
				echo "";
			else {
				echo "Error";
				}
		$query6="update request_group set friend3=NULL where rid='".$getid."' and friend3='".$sen_id."'";
		if($connection->query($query6) == TRUE)
				echo "";
			else {
				echo "Error";
				}
		$query6="update request_group set friend4=NULL where rid='".$getid."' and friend4='".$sen_id."'";
		if($connection->query($query6) == TRUE)
				echo "";
			else {
				echo "Error";
				}
		$query6="update request_group set friend5=NULL where rid='".$getid."' and friend5='".$sen_id."'";
		if($connection->query($query6) == TRUE)
				echo "";
			else {
				echo "Error";
				}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Plutus</title>
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	</head>
	<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Plutus</a>
    </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php">My Profile</a></li>
        <li><a href="new.php">Logout</a></li>
      </ul>
    </div>

</div>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6">
      <div class="page-header">
        <center><h3>Pending Requests</h3></center>
      </div>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>User</th>
            <th>Amount</th>
            <th>Option</th>
          </tr>
        </thead>
        <tbody>
		<?php
		$cusid = array();
		$amount = array();
		$rid = array();
		
		$query2 = "SELECT customer_id FROM customers where user_name='".$_SESSION['login_user']."'";
		$receiver_id = mysqli_query($connection,$query2);
		if ($receiver_id->num_rows > 0) 
		{
			while($row = $receiver_id->fetch_assoc()) 
			{
				$sen_id = $row["customer_id"];
			}
		}
		
		
		
		$var = "SELECT requests.customer_id, requests.amount,requests.rid FROM request_group INNER JOIN requests ON request_group.rid = requests.rid where request_group.friend1='".$sen_id."' ||request_group.friend2='".$sen_id."'||request_group.friend3='".$sen_id."'||request_group.friend4='".$sen_id."'||request_group.friend5='".$sen_id."'";
		
		$result = mysqli_query($connection,$var);
		$num = $result->num_rows;
		
		
		if($result->num_rows){
			while($row=mysqli_fetch_row($result)){
				$cusid[] = $row[0];
				$amount[] = $row[1];
				$rid[] = $row[2];
			}
		}
		
		else{
 			echo "no pending requests";
		}
		//$patientname = $row[0];
		for($i=0; $i<($num); $i++){
			$q1 = "SELECT customer_name FROM customers where customer_id='".$cusid[$i]."'";
			$resq1 = mysqli_query($connection, $q1);
			$cuss = $resq1->fetch_assoc()["customer_name"];
			$confirm = 'grant_req_final.php'.'?'.'a='.$cusid[$i].'&'.'b='.$rid[$i];
			$confirm2 = 'grant_req_final.php'.'?'.'c='.$cusid[$i].'&'.'d='.$rid[$i];
				echo "<tr>
			<td>$cuss</td>
            <td>$amount[$i]</td>
            <td>
              <div class='row'>
                <div class='col-sm-6'><a href='$confirm'><img src='tick-green.png' width='25px' height='25px'></a></div>
                <div class='col-sm-6'><a href='$confirm2'><img src='wrong.png' width='25px' height='25px'></a></div>
              </div>
            </td>
          </tr>";
		}
		?>
        </tbody>
      </table>
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

</body>
</html>