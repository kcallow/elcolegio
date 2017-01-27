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

$courseID = $_GET['id'];
$_SESSION['courseID'] = $courseID;
$_SESSION['name'] = $_SESSION['courseName'][$courseID];

$result = mysqli_query($conn, 
		"CALL getCourseModules($courseID)");

$moduleIDs = array();
while ($row = mysqli_fetch_array($result)) {
    $moduleID = $row['id'];
    $moduleIDs[] = $row['id'];
    $moduleName[$moduleID] = $row['name'];
    $moduleDescription[$moduleID] = $row['description'];
    $modulePDF[$moduleID] = $row['pdf'];
}

$_SESSION['moduleName'] = $moduleName;
$_SESSION['moduleDescription'] = $moduleDescription;
$_SESSION['modulePDF'] = $modulePDF;
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
    <link href="jumbotron-narrow.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="courses.php">elcolegio::modules</a>
        </div>
	  <ul class="nav nav-pills pull-right">
            <li><pre><?php echo $_SESSION['user']?></pre></li>
            <li role="presentation"><a href="index.php?logout=logout">Logout</a></li>
          </ul>
      </div>
    </nav>

    <div class="container">
      <div class="jumbotron">
        <h1><?php echo $_SESSION['name']; ?>
	</h1>
      </div>

<?php
echo '<div class="row">';
foreach ($moduleIDs as $moduleID){
      echo '  <div class="col-sm-4">';
      echo '   <h2>';
      echo $moduleName[$moduleID];
      echo ' </h2>';
      echo '    <p>';
      echo $moduleDescription[$moduleID];
      echo '    </p>';
      echo    '<p><a class="btn btn-default" href="classroom.php?id=';
      echo $moduleID;
      echo '" role="button">Go to class »</a></p>';
      echo '  </div>';
}
      echo '</div>';
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

