<?php
$square = 0;
if(isset($_GET['value'])) 
{
  $square = $_GET['value'] * $_GET['value'];
}

// Comment the appropriate line for the corresponding server
echo 'From Backend Server 1: ' . $square;
//echo 'From Backend Server 2: ' . $square;
?>