<?php
if (isset($_GET['num1']) && isset($_GET['num2']) && !empty($_GET['num1']) && !empty($_GET['num2'])) {
    $num1 = $_GET['num1'];
    $num2 = $_GET['num2'];
    $sum = $num1 + $num2;
    $response = [
        'num1' => $num1,
        'num2' => $num2,
        'sum' => $sum
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    http_response_code(400); // Bad Request
}