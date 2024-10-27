<?php
//connect to mysql
$mysqli = new mysqli('localhost', 'tutorial2', 'tutorial2', 'tutorial2');

if (mysqli_connect_errno()) {
	    printf("Connect failed: %s\n", mysqli_connect_error());
	    exit();
	}
?>