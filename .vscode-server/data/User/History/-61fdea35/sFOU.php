<?php
$URL_BASE = "https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/tute7/";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
require 'vendor/autoload.php';
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\BadResponseException;

$xml = simplexml_load_file('calcapi.xml');

foreach ($xml->function as $function) {
    $functionName = (string) $function->function_name;
    $functionURL = (string) $function->function_URL;
    
    // Initialize URL path with base
    $urlPath = $URL_BASE . $functionURL;
    $params = [];
    
    // Collect parameters for the path
    foreach ($function->parameters->param as $param) {
        $paramName = (string) $param->name;
        $paramDefault = (string) $param->default;
        
        $params[$paramName] = $paramDefault;
    }
    
    // Append parameters to URL path
    $urlPath .= '/' . implode('/', array_keys($params));
    
    echo '<form action="' . htmlspecialchars($urlPath) . '" method="get">';
    echo '<h3>' . htmlspecialchars($functionName) . '</h3>';

    // Generate input fields
    foreach ($params as $paramName => $paramDefault) {
        echo '<div>' . htmlspecialchars($paramName) . ': ';
        echo '<input type="text" name="' . htmlspecialchars($paramName) . '" value="' . htmlspecialchars($paramDefault) . '" size="30">';
        echo '</div>';
    }

    echo '<div><input type="submit" value="Submit"></div>';
    echo '</form><br>';
}
?>
