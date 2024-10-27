<html>
<head><title> MVC Webpage </title></head>
<body>

<h1>Welcome to MVC (Customer Example)</h1>

<?php
// include controller  
include_once("controller/Controller.php");  
  
//Initilize controller
$controller = new Controller();  

//Run logic
$controller->execute();  

?>
