<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="bootstrap.min.css">
		<link rel="stylesheet" href="style_register2.css">
		<link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Cabin' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Josefin+Sans' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="container-fluid login-cont" id="ok">

			<div class="row">
				<div class="col-md-4">
					<br><br><br><br>
					<a href="new.php"><img src="arrow-left.png" width="50px" height="50px"></a>
				</div>
				<div class="col-md-4">
			<div class="login-block text-center">
				<h3>Register</h3>
				<form role="form" action="signup.php" method="post">
					<div class="form-group">
						<input type="text" class="form-control" id="username" placeholder="Enter Name" name="name" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
					</div>

					<div class="form-group">
						<input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
					</div>
					<div class="form-group">
						<input type="email" class="form-control" id="username" placeholder="Email ID" name="email" required>
					</div>
					<input name="action" type="hidden" value="signup" />
					<div class="form-group">
						
						<input type="text" class="form-control" id="username" placeholder="Card number" name="card_number" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="username" placeholder="CVV" name="cvv" required>
					</div>
					<div class="form-group">
						<input type="submit" value="Submit" class="form-control" id="submit-but"/>
						<!--	<button class="form-control" id="submit-but">Submit</button>	-->
					</div>
				</form>

			</div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</body>
</html>