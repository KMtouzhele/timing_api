<?php

// Enable PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Import the Guzzle plugin via Composer (autoload.php)
require 'vendor/autoload.php';
use GuzzleHttp\Exception\RequestException;

// Set content-type header to application/json
header('Content-Type: application/json');

try {
    $client = new GuzzleHttp\Client(['verify' => false]);

    $url = "https://numbersapi.p.rapidapi.com/666/math";
    $headers = [
        'x-rapidapi-host' => 'numbersapi.p.rapidapi.com',
        'x-rapidapi-key' => '33a5fd9d3amsh4ff85e00c7208f1p14e4f8jsnc35e327404ac'
    ];

    $response = $client->request('GET', $url, [
        'headers' => $headers
    ]);

    if ($response->getStatusCode() == 200) {
        $body = $response->getBody();
        $bodyContent = (string) $body;

        // Remove extra quotation marks around JSON response
        $bodyContent = trim($bodyContent, '"');

        // Output the raw response body for debugging
        echo "Raw Response Body:\n";
        echo $bodyContent;
        echo "\n";

        // Decode the JSON response
        $json = json_decode($bodyContent, true);

        // Check if JSON decoding was successful
        if (json_last_error() === JSON_ERROR_NONE) {
            // Output formatted JSON
            echo "Decoded JSON:\n";
            echo json_encode($json, JSON_PRETTY_PRINT);
        } else {
            echo "JSON decoding error: " . json_last_error_msg();
        }
    } else {
        echo json_encode(['error' => 'Error: ' . $response->getStatusCode()]);
    }
} catch (RequestException $e) {
    ec