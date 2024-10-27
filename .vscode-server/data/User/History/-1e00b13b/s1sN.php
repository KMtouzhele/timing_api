<?php
if (isset($_GET['username']) && isset($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];
    if ($username == 'admin' && $password == 'admin') {
        echo 'Welcome admin';
    } else {
        echo 'Invalid username or password';
    }
} else {
    echo 'Please enter username and password';
}