<?php

// Enable PHP errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Import the Guzzle plugin via Composer (autoload.php)
require 'vendor/autoload.php';
use GuzzleHttp\Exception\RequestException;

// We are rendering out a plain-text file in this example, not an HTML file
header('Content-type: application/json');
echo "==========================================================\n";

try 
{
    $client = new GuzzleHttp\Client(['verify' => false]);
    
    $url = "https://numbersapi.p.rapidapi.com/666/math";
    $headers = [
        'x-rapidapi-host' => 'numbersapi.p.rapidapi.com',
        'x-rapidapi-key' => '33a5fd9d3amsh4ff85e00c7208f1p14e4f8jsnc35e327404ac'
    ];
    
    $response = $client->request('GET', $url, [
        'headers' => $headers
    ]);
    
    if($response->getStatusCode() == 200) 
    {
        $body = $response->getBody();
        echo "\tResult: [" . $response->getStatusCode()
        . ", " 
        . $response->getHeaderLine('content-type')
        . ", " 
        . $response->getBody() . "]"
        ;
        
    } 
    else 
    {
        echo "Error : " . $response->getStatusCode();
    }
}
catch (RequestException $e) 
{

    echo "Error: " . $e->getMessage();
}

echo "\n==========================================================";

?>
