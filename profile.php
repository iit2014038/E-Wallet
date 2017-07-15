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
        <li><a href="#">My Profile</a></li>
        <li><a href="new.php">Logout</a></li>
      </ul>
    </div>
</div>
	<div class="container">
	<div class="row">
	<!--	<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" > -->
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<div class="panel panel-info">
				<div class="panel-heading">
				<h3 class="panel-title"><?php include('dashboard2.php');echo $_SESSION['login_user'];?></h3>
				</div>
				<div class="panel-body">
					<div class="row">
					
					<div class=" col-md-12 col-lg-12 "> 
					<table class="table table-user-information">
						<tbody>
							<tr>
								<td>User ID:</td>
								<td><?php echo $_SESSION['login_id']?></td>
							</tr>
							<tr>
								<td>Amount:</td>
								<td><?php echo $_SESSION['balance']?></td>
							</tr>
							<tr>
								<td>Card No:</td>
								<td><?php echo $_SESSION['cardnumber'] ?></td>
							</tr>
						</tbody>
					</table>
					
					</div>
					</div>
					</div></div></div>
					</div>
					<div class="col-md-4"></div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-5"></div>
						<div class="col-md-2">
						<form action="pwd_change.php" method="post">
							<div class="form-group">
								<label for="old_pwd">Enter Old Password:</label>
								<input type="password" class="form-control" name="old_pwd" id="old_pwd" required>
							</div>
							<input name="action" type="hidden" value="change" />
							<div class="form-group">
								<label for="new_pwd">Enter New Password:</label>
								<input type="password" name="new_pwd" id="new_pwd"class="form-control" required>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-default" class="form-control">Change</button>
							</div>
						</form>
						</div>
						<div class="col-md-5"></div>
					</div>
		<!--</div>-->
			
		</div>
		</div>
	</div>


</body>
</html>