<?php session_start();
if(!isset($_SESSION['user']))
	header('Location: index.php');

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

$result = mysqli_query($conn, 
		"CALL getCourses()");

$courseIDs = array();
while ($row = mysqli_fetch_array($result)) {
    $courseID = $row['id'];
    $courseIDs[] = $row['id'];
    $courseName[$courseID] = $row['name'];
    $courseDescription[$courseID] = $row['description'];
    $courseImage[$courseID] = $row['imageURL'];
}

$_SESSION['courseName'] = $courseName;
$_SESSION['courseDescription'] = $courseDescription;

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
          <a class="navbar-brand" href="#">elcolegio::courses</a>
        </div>
	  <ul class="nav nav-pills pull-right">
            <li><pre><?php echo $_SESSION['user'] ?></pre></li>
            <li role="presentation"><a href="index.php?logout=logout">Logout</a></li>
          </ul>
      </div>
    </nav>

    <div class="container">
<?php
foreach ($courseIDs as $courseID){
      echo '<div class="jumbotron">';
      echo ' <h1>';
      echo $courseName[$courseID];
      echo '&nbsp';
      echo '    <a href="modules.php?id=';
      echo $courseID;
      echo '"><img src="';
      echo $courseImage[$courseID];
      echo '" style="width:12%;"></a>';
      echo ' </h1>';
      echo '  <p>';
      echo $courseDescription[$courseID];
      echo '  </p>';
      echo '</div>';
}
?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
  </body>
</html>

