<?php
/* ---------------------------------------------------------------------------
 * filename    : login.php
 * author      : George Corser, gcorser@gmail.com
 * description : This program logs the user in by setting $_SESSION variables
 * ---------------------------------------------------------------------------
 */
// Start or resume session, and create: $_SESSION[] array
session_start(); 
// include the class that handles database connections
require "../PhpProject/database.php";

if ( !empty($_POST)) { // if $_POST filled then process the form
    // initialize $_POST variables
    $name = $_POST['name']; // username is email address
    $username = $_POST['username']; // username is email address
    $mobile = $_POST['mobile']; // username is email address
	$password = $_POST['password'];
	$passwordhash = MD5($password);
	$labelError = "";
		
	// verify the username/password
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO customers (name,email,mobile, password_hash) values(?, ?, ?, ?)";
	$q = $pdo->prepare($sql);
	$q->execute(array($this->name, $this->email, $this->mobile, $this->password_hashed));
	$data = $q->fetch(PDO::FETCH_ASSOC);
	Database::disconnect();



} 
// if $_POST NOT filled then display login form, below.
?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset='UTF-8'>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
	</head>

<body>
<a href='https://github.com/rklawinski/355Prog03' target='_blank'>JRKLAWIN Github</a><br />
    <div class="container">
		<div class="span10 offset1">

			<div class="row">
				<h3>New User</h3>
			</div>

			<form class="form-horizontal" action="login.php" method="post">

                <div class="control-group">
					<label class="control-label">Name
					<div class="controls">
						<input name="name" type="text" required> 
					</div>	
				</div> 

				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="username" type="text"  placeholder="me@email.com" required> 
					</div>	
				</div>

                <div class="control-group">
					<label class="control-label">Number
					<div class="controls">
						<input name="mobile" type="text" required> 
					</div>	
				</div> 
				
				<div class="control-group">
					<label class="control-label">Password</label>
					<div class="controls">
						<input name="password" type="password" placeholder="not your SVSU password, please" required> 
					</div>	
				</div> 

				<div class="form-actions">
					<a class="btn btn-primary" href="login.php">Join (New Volunteer)</a>
				</div>
				
				<footer>
					<small>&copy; Copyright 2019, George Corser and Roman :)
					</small>
				</footer>
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>