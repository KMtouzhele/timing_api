<?php
$to = isset($_GET['to']) ? $_GET['to'] : 'default@example.com';
$subject = isset($_GET['subject']) ? $_GET['subject'] : 'Default Subject';
$body = isset($_GET['body']) ? $_GET['body'] : 'Default body of the email';

$str = "echo \"$body\" | mail -s \"$subject\" $to";

// Outputs all the result of shellcommand $str, and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
$last_line = system($str, $retval);

// Printing additional info
echo '<hr>Last line of the output: ' . $last_line . ' <hr>Return value: ' . $retval;
?>