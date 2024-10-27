<?php
header("Content-Type: application/xml");
echo "SayHello.php is being accessed";

if(isset($_GET["user"]) && !empty($_GET["user"])) 
{		
    echo "<response>Hello " . $_GET["user"] . "</response>";
}
else 
{		
    // the input GET parameter is not given
    header("HTTP/1.1 400 Bad Request"); 
}
?>