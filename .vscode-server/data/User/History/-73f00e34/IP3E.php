<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get parameters from POST
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    // Create the shell command
    $str = "echo \"$body\" | mail -s \"$subject\" $to";

    // Outputs all the result of shell command $str,
    // and returns the last output line into $last_line.
    // Stores the return value of the shell command in $retval.
    $last_line = system($str, $retval);

    // Printing additional info
    echo '<hr>Last line of the output: ' . htmlspecialchars($last_line) . '<hr>';
    echo 'Return value: ' . htmlspecialchars($retval);
} else {
    // Display the form if the request is not POST
    ?>
    <form method="post" action="">
        <label for="to">To:</label>
        <input type="email" id="to" name="to" required><br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br><br>
        <label for="body">Body:</label><br>
        <textarea id="body" name="body" rows="5" cols="40" required></textarea><br><br>
        <input type="submit" value="Send Email">
    </form>
    <?php
}
?>
