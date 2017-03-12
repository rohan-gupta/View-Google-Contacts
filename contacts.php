<!DOCTYPE html>

<?php
	session_start();

	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$dbhost = $url["host"];
	$dbuser = $url["user"];
	$dbpassword = $url["pass"];
	$dbname = substr($url["path"], 1);
	
	
    if(isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $password = $_SESSION['password'];

        $sql = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
        $result = mysqli_query($sql, "Select * from `". $dbname ."`.`" . $email."`");
        mysqli_close($sql);
    }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>Welcome <?php echo $email; ?></title>

	
	<style type="text/css">
		button:hover{
			cursor: pointer;
		}
		.extra-margin{
			margin-top: 5em;
		}

	</style>

</head>
<body>

<div class="container">
	<div class="jumbotron">
		<div class="text-right "><a href="https://www.google.com/accounts/Logout?continue=https://appengine.google.com/_ah/logout?continue=http://localhost:8080" class="text-muted">logout</a></div>
		<div class="display-3">Contacts</div>
		<hr class="my-4">
		<p>Toggle contacts using the button below.</p>
		<p class="lead">
		<a href="authorization.php" class="btn btn-primary">Sync Contacts with GMail account</a>
		</p>
		
	</div>

	<table class="table table-bordered table-hover">
		
		<thead class="thead-inverse">
			<tr>
				<th>#</th>
				<th>Name</th>
				<th>Phone Number</th>
			</tr>
		</thead>

		<tbody>
        <?php

            if(isset($result)){
            foreach ($result as $row){?>
			<tr>
				<th scope="row"><?php echo $row['id'];?></th>
				<th><?php echo $row['fullName'];?></th>
				<th><?php echo $row['phoneNumber'];?></th>
			</tr>
        <?php }} ?>
		</tbody>
	</table>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>