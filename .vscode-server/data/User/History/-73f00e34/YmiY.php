<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <h2>New Email</h2>
    <form action="result.php" method="post">
        <label for="to">To:</label>
        <input type="text" id="email" name="email" required><br><br>
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required><br><br>
        <label for="body">Body:</label>
        <input type="text" id="body" name="body" required><br><br>
        <input type="submit" value="Send">
    </form>
</body>
</html>