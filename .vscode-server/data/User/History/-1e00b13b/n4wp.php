<?php

if (isset($_GET['user']) && isset($_GET['password']) && !empty($_GET['user']) && !empty($_GET['password'])) {
    $user = $_GET['user'];
    $password = $_GET['password'];

    // Fake logic to check if username and password match some condition
    if ($user == 'lindsay' && $password == 'securityismypassion') {
        $response = [
            'user' => $user,
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