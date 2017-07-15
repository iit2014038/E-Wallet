<html>
<head>
	<meta charset="utf-8">
	<title>Bank</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<form role="form" action="bank.php" method="post">
				
                  <div class="form-group">
                    <label for="gift_username">Account No:</label>
                    <input type="text" class="form-control" id="username" name="an" required>
                  </div>
				  <input name="action" type="hidden" value="send" />
                  <div class="form-group">
                    <label for="gift_amount">Account Holder Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
				  <div class="form-group">
                    <label for="gift_amount">Credit Card No:</label>
                    <input type="text" class="form-control" id="ccn" name="ccn" required>
                  </div>
				  <div class="form-group">
                    <label for="gift_amount">CVV:</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" required>
                  </div>
				  <div class="form-group">
                    <label for="gift_amount">Balance:</label>
                    <input type="text" class="form-control" id="balance" name="balance" required>
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-default">Go!</button>
                  </div>
                </form>
			</div>
			<div class="col-sm-4">
				<div class="col-sm-6"></div>
				<div class="col-sm-6">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Useful Links</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><a href="new.php">Plutus Home</a></td>
						</tr>
						<tr>
							<td><a href="register2.php">Plutus Registration</a></td>
						</tr>
					</tbody>
				</table>
				</div>
			</div>
		</div>
	</div>
</body>
</html>