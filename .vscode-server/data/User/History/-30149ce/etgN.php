<?php
$servername = "localhost";
$username = "tutorial1";
$password = "tutorial1";
$dbname = "tutorial1";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>