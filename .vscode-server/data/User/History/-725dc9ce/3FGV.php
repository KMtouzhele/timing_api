<?php
include_once("View/ViewErrorMessage.php");  

//TODO: update this line with your own password file
$password = "qgnuQnV8QatX7Y8B";//trim(file_get_contents("/home/ubuntu/password.txt"));

$mysqli = new mysqli('localhost', 'tute9', $password, 'tute9');

if (mysqli_connect_errno()) 
{
	// return a server error with json output here
	header('HTTP/1.1 500 Internal Server Error');
	$error = new ViewErrorMessage();
	$error->output("Database connection error");
	exit();
}
?>