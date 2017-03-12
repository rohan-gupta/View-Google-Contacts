<!DOCTYPE html>
<?php
	
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$dbhost = $url["host"];
	$dbuser = $url["user"];
	$dbpassword = $url["pass"];
	$dbname = substr($url["path"], 1);
	
	$sql = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

    if(isset($_POST['email'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "Select * from users where userName='$email' and password='$password'";
        $result = mysqli_query($sql, $query);

        if(mysqli_num_rows($result)>0){
            echo '<script>alert("Sign Up Successful")</script>';
            session_start();
            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;
            header('Location: contacts.php');
        }
        else{
        	echo '<script>alert("Sign Up Not Successful")</script>';
        }
        mysqli_close($sql);
    }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>Page 1 | Login</title>
	
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
		  <h1 class="display-3">Task</h1>
		  <hr class="my-4">
		  <p>Please login below.</p>
	</div>
	<form action="" method="post">
		<div class="form-group row">
			<div class="hidden-sm-down col-sm-2">
				<label class="col-form-label">EMail: </label>
			</div>
			<div class="col-sm-10">
				<input type="email" name="email" class="form-control" placeholder="Email">
			</div>
		</div>
		<div class="form-group row">
			<div class="hidden-sm-down col-sm-2">
				<label class="col-form-label">Password: </label>
			</div>
			<div class="col-sm-10">
				<input type="password" name="password" class="form-control" placeholder="Password">
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Login</button>
	</form>
	<p class="text-muted extra-margin">Not a member? <a href="index.php">Sign up here</a></p>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</body>
</html>