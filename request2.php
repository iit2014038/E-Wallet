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
        <li><a href="profile2.php">My Profile</a></li>
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
          <tr>
            <td>madmax</td>
            <td>100</td>
            <td>
              <div class="row">
                <div class="col-sm-6"><img src="tick-green.png" width="25px" height="25px"></div>
                <div class="col-sm-6"><img src="wrong.png" width="25px" height="25px"></div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-md-3"></div>
  </div>
</div>

</body>
</html>