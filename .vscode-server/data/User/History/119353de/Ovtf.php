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
if (isset($_GET['customer']))
{
    $controller->execute(Controller::ACTION_VIEW_ONE, $_GET['customer']);
}
else if (isset($_GET['name']))
{
    $controller->execute(Controller::ACTION_VIEW_BY_NAME, $_GET['name']);
}
else
{
    $controller->execute(Controller::ACTION_VIEW_ALL);
} 

?>
