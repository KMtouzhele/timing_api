<?php
// Set the content type to XML
header("Content-Type: application/xml");

// Check if the 'user' GET parameter is set and not empty
if (isset($_GET["user"]) && !empty($_GET["user"])) {
    // Output a valid XML response
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    echo "<response>Hello " . htmlspecialchars($_GET["user"]) . "</response>";
} else {
    // Output a 400 Bad Request status if the 'user' parameter is missing
    header("HTTP/1.1 400 Bad Request");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    echo "<error>Bad Request: Missing 'user' parameter</error>";
}
?>
