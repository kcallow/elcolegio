<?php
echo '<pre>';
$servername = "localhost";
$username = "root";
$password = "cat789";
$db = "elcolegio";
$user = $_POST['user'];
$pass = $_POST['pass'];

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully\n";

$result = mysqli_query($conn, 
     "CALL validateUser('$user','$pass')");

$row = mysqli_fetch_array($result);
if(empty($row))
	print("Login failed.");
else {
	print "User: ".$row['username']."\n";
}

echo '</pre>';
?>
