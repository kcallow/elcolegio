<?php

session_start();
if(isset($_GET['logout'])){
	session_destroy();
}

$servername = "localhost";
$username = "root";
$password = "cat789";
$db = "elcolegio";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(!empty($_POST)){
	$user = $_POST['user'];
	$pass = $_POST['pass'];

	$result = mysqli_query($conn, 
	     "CALL validateUser('$user','$pass')");

	echo '<pre>';
	$row = mysqli_fetch_array($result);
	if(empty($row))
		print("Login failed.");
	else {
//		print "User: ".$row['username']."\n";
		$_SESSION['user'] = $user;
		$_SESSION['pass'] = $pass;
		$_SESSION['email'] = $row['email'];
//		var_dump($_SESSION);
		header('Location: courses.php');
	}

	echo '</pre>';
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">elcolegio</a>
        </div>
      </div>
    </nav>

    <div class="container">
      <div class="starter-template">
        <h1><b>Login</b></h1>
        <p class="lead">
	<form action="index.php" method="post">
		<input type="text" name="user" placeholder="Username">
		<br>
		<input type="password" name="pass" placeholder="Password">
		<br><br>
		<input type="submit" value="Go">
	</form> 
	</p>
      </div>
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>

