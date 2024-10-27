<?php
header("Content-Type: application/json");

if(isset($_GET["user"]) && !empty($_GET["user"])) 
{		
	echo json_encode(array("response" => "Hello " . $_GET["user"]));
}
else 
{		
	// the input GET parameter is not given
	header("HTTP/1.1 400 Bad Request"); 
}
?>