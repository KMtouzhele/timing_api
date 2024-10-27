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

// Debugging output
echo '<hr>Command: ' . htmlspecialchars($str) . '<hr>';
echo '<hr>Last line of the output: ' . htmlspecialchars($last_line) . '<hr>';
echo 'Return value: ' . htmlspecialchars($retval);

// Error handling
if ($retval != 0) {
    echo '<hr>Error occurred while sending the email.<hr>';
}
?>
