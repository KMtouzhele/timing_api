<?php

// Enable PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Import the Guzzle plugin via Composer (autoload.php)
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// We are rendering out a plain-text file in this example, not an HTML file
header('Content-type: text/plain');
echo "==========================================================\n";

try 
{
    $client = new Client(['verify' => false]);
    
    $url = "https://numbersapi.p.rapidapi.com/666/math";
    $headers = [
        'x-rapidapi-host' => 'numbersapi.p.rapidapi.com',
        'x-rapidapi-key' => '33a5fd9d3amsh4ff85e00c7208f1p14e4f8jsnc35e327404ac'
    ];
    
    $response = $client->request('GET', $url, [
        'headers' => $headers
    ]);
    
    if ($response->getStatusCode() == 200) 
    {
        $body = $response->getBody()->getContents();
        $data = json_decode($body, true);

        // Print the JSON response
        echo "Response JSON:\n";
        echo json_encode($data, JSON_PRETTY_PRINT);

        // Print other details
        echo "\n\nResponse Details:\n";
        echo "Status Code: " . $response->getStatusCode() . "\n";
        echo "Content-Type: " . $response->getHeaderLine('content-type') . "\n";
        echo "Response Body: " . $body . "\n";
        
    } 
    else 
    {
        echo "Error: " . $response->getStatusCode();
    }
}
catch (RequestException $e) 
{
    echo "Error: " . $e->getMessage();
}

echo "\n==========================================================";

?>
