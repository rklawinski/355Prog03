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
	$name = $_POST['name'];
	$username = $_POST['username']; // username is email address
	$password = $_POST['password'];
	$passwordhash = MD5($password);
	$labelError = "";
		
	// verify the username/password
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "INSERT INTO customers (name,email,mobile, password_hash) values($name, $username, ?, $passwordhash)";
	$q = $pdo->prepare($sql);
	$q->execute(array($username,$passwordhash));
	$data = $q->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
	<head>
        <meta charset='UTF-8'>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css' rel='stylesheet'>
        <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js'></script>
	</head>

<body>
    <div class="container">
		<div class="span10 offset1">

			<div class="row">
				<h3>Login</h3>
			</div>

			<form class="form-horizontal" action="join.php" method="post">

			<div class="control-group">
					<label class="control-label">Name</label>
					<div class="controls">
						<input name="name" type="text"  placeholder="me@email.com" required> 
					</div>	
				</div> 
								  
				<div class="control-group">
					<label class="control-label">Username (Email)</label>
					<div class="controls">
						<input name="username" type="text"  placeholder="me@email.com" required> 
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
				
				<div>
					<?php
						echo "<br>";
						echo "<span style='color: red;' class='help-inline'>";
						echo "&nbsp;&nbsp;" . $labelError;
						echo "</span>";
						echo "<br>";
					?>
				</div>
				
				<footer>
					<small>&copy; Copyright 2019, George Corser Roman :)
					</small>
				</footer>
				
			</form>


		</div> <!-- end div: class="span10 offset1" -->
				
    </div> <!-- end div: class="container" -->

  </body>
  
</html>