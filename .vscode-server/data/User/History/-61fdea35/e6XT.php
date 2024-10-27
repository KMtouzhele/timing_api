<?php
$URL_BASE = "https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/tute7/";

require 'vendor/autoload.php';
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\BadResponseException;

$xml = simplexml_load_file('calcai.xml');

foreach ($xml->function as $function) {
    $functionName = (string) $function->function_name;
    $functionURL = (string) $function->function_URL;

    echo '<form action="' . $functionURL . '" method="get">';
    echo '<h3>' . $functionName . '</h3>';

    foreach ($function->parameters->param as $param) {
        $paramName = (string) $param->name;
        $paramDefault = (string) $param->default;

        echo '<div>' . htmlspecialchars($paramName) . ': ';
        echo '<input type="text" name="' . htmlspecialchars($paramName) . '" value="' . htmlspecialchars($paramDefault) . '" size="30">';
        echo '</div>';
    }

    echo '<div><input type="submit" value="Submit"></div>';
    echo '</form><br>';
}
?>
