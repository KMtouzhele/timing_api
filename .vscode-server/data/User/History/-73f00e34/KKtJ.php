<?php
$str = 'echo "This is the body of the email" | mail -s "This is the subject line" youremailaddress@yahoo.com';

// Outputs all the result of shellcommand $stri, and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
$last_line = system($str, $retval);

// Printing additional info
echo ' <hr>Last line of the output: ' . $last_line . ' <hr>Return value: ' . $retval;
?>