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
	<script>
		function focus1() {
			document.getElementById("user2").disabled = false;
		}
		
		function focus2() {
			document.getElementById("user3").disabled = false;
		}
		
		function focus3() {
			document.getElementById("user4").disabled = false;
		}
		
		function focus4() {
			document.getElementById("user5").disabled = false;
		}
	</script>
	</head>
	<body>
<!-- Header -->
<div id="top-nav" class="navbar navbar-inverse">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-toggle"></span>
      </button>
      <a class="navbar-brand" href="#">Plutus</a>
    </div>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.php"><?php include('dashboard2.php');echo $_SESSION['login_user'];?></a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </div>
</div>
<!-- /Header -->

<!-- Main -->
<div class="container">
  
  <!-- upper section -->
  <div class="row">
            <!-- tabs left -->
      <div class="col-md-3">
        <ul class="nav nav-pills nav-stacked" id="myTabs">
          <li class="active"><a href="#home" data-toggle="pill">Dashboard</a></li>
          
          <li><a href="#request" data-toggle="pill"> Request Money</a></li>
          <li><a href="#gift" data-toggle="pill"> Send Money</a></li>
          <li><a href="#trans" data-toggle="pill"> My transactions</a></li>
        </ul>
      </div>

  <!-- Content -->
      <div class="col-md-9">
        <div class="tab-content">
          <div class="tab-pane active fade in" id="home">
            <div class="col-md-8">
              <div class="page-header"><h3>Hi, <?php echo $_SESSION['login_user'];?>!</h3></div>
			  <?php
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
				$_SESSION['notifs']=$var;	
			  ?>
              You have <?php echo $_SESSION['notifs'];?> money
              <a href="#" data-toggle="popover" data-placement="bottom" data-content="Money requests are left for you to accept or reject.">requests</a> pending.
              <hr>
              Go to <a href="grant_req_final.php">request fulfillment</a> page
            </div>
            <div class="col-md-4">
              <img src = "wallet.png" width = "200" height="200">
              <hr>
              Your wallet balance is Rs. <?php echo $_SESSION['balance'];?>
            </div>
          </div>
    <!--      <div class="tab-pane fade" id="send">
            <div class="col-md-8">
              <div class="page-header">
                <h4>You can send money to any person in the database from here</h4>
              </div>
              <div class="col-sm-6">
                <form role="form">
                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username">
                  </div>
                  <div class="form-group">
                    <label for="amount">Amount (in INR):</label>
                    <input type="text" class="form-control" id="amount">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-default">Go!</button>
                  </div>
                </form>
              </div>

            </div>
            <div class="col-md-4">
              <img src = "rocket-flat.png" width = "200" height="200">
              <hr>
            </div>
          </div>	-->
          <div class="tab-pane fade" id="request">
            <div class="page-header">
              <h4>You can request money from upto 5 people</h4>
            </div>
            <div class="col-sm-6">
              <form role="form" action="request.php" method="post">
			  
                <div class="form-group col-sm-6">
                  <label for="user1">Person 1</label>
                  <input type="text" class="form-control" id="user1" name="username1" onblur="focus1()" required>
                </div>
                <div class="form-group col-sm-6">
                  <label for="user2">Person 2</label>
                  <input type="text" class="form-control" id="user2" name="username2" onblur="focus2()" disabled>
                </div>
                <div class="form-group col-sm-6">
                  <label for="user3">Person 3</label>
                  <input type="text" class="form-control" id="user3" name="username3" onblur="focus3()" disabled>
                </div>
                <div class="form-group col-sm-6">
                  <label for="user4">Person 4</label>
                  <input type="text" class="form-control" id="user4" name="username4" onblur="focus4()" disabled>
                </div>
				<input name="action" type="hidden" value="request" /></p>
                <div class="form-group col-sm-6">
                  <label for="user5">Person 5</label>
                  <input type="text" class="form-control" id="user5" name="username5" disabled>
                </div>
                <div class="form-group col-sm-7">
                  <label for="amount">Amount (in INR)</label>
                  <input type="text" class="form-control" id="amount" name="request_amount" required>
                </div>
                <div class="form-group col-sm-12">
                    <button type="submit" class="btn btn-default">Go!</button>
                </div>
              </form>
            </div>
          </div>
          <div class="tab-pane fade" id="gift">
            <div class="col-md-8">
              <div class="page-header">
                <h4>You can send money to any person in the database from here</h4>
              </div>
              <div class="col-sm-6">
                <form role="form" action="gift.php" method="post">
				
                  <div class="form-group">
                    <label for="gift_username">Username:</label>
                    <input type="text" class="form-control" id="gift_username" name="username">
                  </div>
				  <input name="action" type="hidden" value="send" />
                  <div class="form-group">
                    <label for="gift_amount">Amount (in INR):</label>
                    <input type="text" class="form-control" id="gift_amount" name="amount">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-default">Go!</button>
                  </div>
                </form>
              </div>

            </div>
            <div class="col-md-4">
              <img src = "gift-flat.png" width = "200" height="200">
              <hr>
            </div>
          </div>
          <div class="tab-pane fade" id="trans">
            <div class="page-header">
              <h4>You can view all your transactions from here.</h4>
            </div>
			<?php
				
			?>
            <div class="col-md-8">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Sender</th>
					<th>Reciever</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
					$sen_id = $_SESSION['login_id'];
					$query = "SELECT sender_id, reciever_id, t_date, amount FROM transactions where sender_id='".$sen_id."' || reciever_id='".$sen_id."' order by t_date desc";
					$result=mysqli_query($connection,$query);
					if($result->num_rows){
						while($row=mysqli_fetch_row($result)){
							$query3 = "SELECT customer_name FROM customers where customer_id='".$row[0]."'";
							$query4 = "SELECT customer_name FROM customers where customer_id='".$row[1]."'";
							$resq3 = mysqli_query($connection, $query3)->fetch_assoc()["customer_name"];
							$resq4 = mysqli_query($connection, $query4)->fetch_assoc()["customer_name"];
							echo "
							<tr>
								<td>$resq3</td>
								<td>$resq4</td>
								<td>$row[3]</td>
								<td>$row[2]</td>
							</tr>";
						}
					}
				  ?>
                </tbody>

              </table>
            </div>
            <div class="col-md-4">
            </div>
          </div>
        </div>
      </div>
  </div>
  <script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
  <!-- /upper section -->
  
  <!-- lower section -->
  
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>