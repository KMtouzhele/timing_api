<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['to'], $_GET['subject'], $_GET['body'])) {
    // Retrieve and sanitize input data
    $to = $_GET['to'];
    $subject = $_GET['subject'];
    $body = $_GET['body'];

    // Command to send email
    $cmd = "echo $body | mail -s $subject $to";

    // Execute the command
    $last_line = system($cmd, $retval);

    // Display the result
    echo '<hr>Last line of the output: ' . $last_line . '<hr>Return value: ' . $retval;
} else {
    // Display the form
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Send Email</title>
    </head>
    <body>
        <h2>New Email</h2>
        <form method="get" action="email_form.php">
            <label for="to">To:</label>
            <input type="text" id="to" name="to" required><br><br>
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required><br><br>
            <label for="body">Body:</label>
            <input type="text" id="body" name="body" required><br><br>
            <input type="submit" value="Send">
        </form>
    </body>
    </html>
    <?php
}
?>
