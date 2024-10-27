<?php

if (isset($_GET['username']) && isset($_GET['password']) && !empty($_GET['username']) && !empty($_GET['password'])) {
    $username = $_GET['username'];
    $password = $_GET['password'];

    // Fake logic to check if username and password match some condition
    if ($username == 'admin' && $password == 'admin') {
        $response = [
            'username' => $username,
            'timestamp' => date('Y-m-d H:i:s')
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        http_response_code(401); // Unauthorized
    }
} else {
    http_response_code(400); // Bad Request
}
?>