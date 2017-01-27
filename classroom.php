<?php session_start();
if(!isset($_SESSION['user']))
	header('Location: index.php');

$moduleID = $_GET['id'];

$moduleName = $_SESSION['moduleName'][$moduleID];
$moduleDescription = $_SESSION['moduleDescription'][$moduleID];
$modulePDF = $_SESSION['modulePDF'][$moduleID];
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
    <link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
    

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
          <a class="navbar-brand" href="courses.php">elcolegio::classroom</a>
        </div>
	  <ul class="nav nav-pills pull-right">
            <li><pre><?php echo $_SESSION['user'] ?></pre></li>
            <li role="presentation"><a href="index.php?logout=logout">Logout</a></li>
          </ul>
      </div>
    </nav>

	<iframe name="CHATBUTTON_CHATBOX" id="CHATBUTTON_CHATBOX" src="https://www.chatbutton.com/chatroom/18384093/" width=15% height=50% marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no"><a href="https://www.chatbutton.com/chatroom/18384093/">Enter Chat Room</a></iframe>
	<script type="text/javascript">
	CHBT_channel="18384093";
	CHBT_profanityfilter="1";
	CHBT_position="bottom-right";
	</script>
	<script type="text/javascript" src="https://www.chatbutton.com/c.js">
	</script>

    <div class="container">


        <h2><?php echo $_SESSION['name'].' - '.$moduleName ?>
	</h2>
	<p><?php echo $moduleDescription; ?></p>
	<button type="button" class="btn btn-lg btn-primary">Take test</button>
	<object data="<?php echo $modulePDF; ?>" type="application/pdf" width="100%" height="700">
	  <iframe src="<?php echo $modulePDF; ?>" width="100%" height="100%" style="border: none;">
	    This browser does not support PDFs. Please download the PDF to view it: <a href="<?php echo $modulePDF; ?>">Download PDF</a>
	  </iframe>
	</object>
      <div class="jumbotron">
	<iframe src="https://appear.in/english4call" width=100% height=500 frameborder="0"></iframe>
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

