<!DOCTYPE html>
<?php
	
	$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

	$dbhost = $url["host"];
	$dbuser = $url["user"];
	$dbpassword = $url["pass"];
	$dbname = substr($url["path"], 1);
	
	$sql = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);

	if(isset($_POST['fullname'])){
	    $name = $_POST['fullname'];
	    $username = $_POST['email'];
	    $password = $_POST['password'];

	    $query = "SELECT * FROM  `".$dbname."`.`users` WHERE userName='".$username."'";
	    $result = mysqli_query($sql, $query);
	    
	    if(mysqli_num_rows($result)>0){
	    	echo "<script>alert('Account already exists. Use another username')</script>";
	    }
	    else{
	    	$query = "INSERT INTO `".$dbname."`.`users`(fullName,userName,password) VALUES ('$name','$username','$password')";
		    mysqli_query($sql, $query);
		    echo "<script>alert('Registration complete, login now.')</script>";
	    }
	    
	    $query = "CREATE TABLE `".$dbname."`.`". $username . "` (
	                `id` INT NOT NULL AUTO_INCREMENT,
	                `fullName` VARCHAR(45) NULL,
	                `phoneNumber` VARCHAR(45) NULL,
	                PRIMARY KEY (`id`))";
	                
	    mysqli_query($sql, $query);
	    mysqli_close($sql);
	}
?>

<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<title>Page 1 | Sign Up</title>
	
	<style type="text/css">
		button:hover{
			cursor: pointer;
		}
		.extra-margin{
			margin-top: 1em;
		}
		#namealert, #emailalert, #confirmpasswordalert{
			display: none;
		}
	</style>

</head>
<body>

<div class="container">
	<div class="jumbotron">
		  <h1 class="display-3">Task</h1>
		  <hr class="my-4">
		  <p>Please fill in the form below to register yourself.</p>
	</div>
	<form action="./index.php" method="post" onsubmit="return(validate());">
		<div class="form-group row">
			<div class="hidden-sm-down col-sm-2">
				<label class="col-form-label">Full Name: </label>
			</div>
			<div class="col-sm-10">
				<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Full Name">
				<p class="small text-danger text-right mt-1" id="namealert">Name can contain only alphabets</p>
			</div>
		</div>
		<div class="form-group row">
			<div class="hidden-sm-down col-sm-2">
				<label class="col-form-label">EMail (Gmail only): </label>
			</div>
			<div class="col-sm-10">
				<input type="email" name="email" id="email" class="form-control" placeholder="Email">
				<p class="small text-danger text-right mt-1" id="emailalert">Email not valid</p>
			</div>
		</div>
		<div class="form-group row">
			<div class="hidden-sm-down col-sm-2">
				<label class="col-form-label">Password: </label>
			</div>
			<div class="col-sm-10">
				<input type="password" name="password" id="password" class="form-control" placeholder="Password">
				<p class="small text-muted text-right mt-1" id="passwordalert">Your password should be 8 or more characters long</p>

			</div>
		</div>
		<div class="form-group row">
			<div class="hidden-sm-down col-sm-2">
				<label class="col-form-label">Confirm Password: </label>
			</div>
			<div class="col-sm-10">
				<input type="password" name="password" id="confirmpassword" class="form-control" placeholder="Password">
				<p class="small text-danger text-right mt-1" id="confirmpasswordalert">Passwords do not match</p>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Register</button>
	</form>
	<p class="text-muted mt-4">Already a member? <a href="login.php">Login here</a></p>
</div>

<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
<script src="./validation.js"></script>
</body>
</html>