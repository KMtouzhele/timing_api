<?php
$to = $_GET['to'];
$subject = $_GET['subject'];
$body = $_GET['body'];

$str = "echo \"$body\" | mail -s \"$subject\" $to";

$last_line = system($str, $retval);

echo '<hr>Last line of the output: ' . $last_line . '<hr>Return value: ' . $retval;
?>
