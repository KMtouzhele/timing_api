<?php
// Get parameters from URL
$to = $_GET['to'];
$subject = $_GET['subject'];
$body = $_GET['body'];

// Create the shell command
$str = "echo \"$body\" | mail -s \"$subject\" $to";

// Outputs all the result of shell command $str,
// and returns the last output line into $last_line.
// Stores the return value of the shell command in $retval.
$last_line = system($str, $retval);

// Printing additional info
echo '<hr>Last line of the output: ' . $last_line . '<hr>Return value: ' . $retval;
?>
