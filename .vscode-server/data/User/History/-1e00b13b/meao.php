<?php

if (isset($_POST['username']) && isset($_POST['password']) && !empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

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