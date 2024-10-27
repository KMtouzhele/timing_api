<?php
$URL_BASE = "https://lab-2105cf46-fd70-4e4b-8ece-4494323c5240.australiaeast.cloudapp.azure.com:7042/tute7/"

//display php errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require 'vendor/autoload.php';
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\BadResponseException;



header('Content-type: text/plain');
echo "=======================================================\n";
$root = simplexml_load_file("calcapi.xml");

foreach($root as $function) 
{
	echo "Name : " . $function->function_name . "\n";
	echo "URL  : " . $function->function_URL . "\n";

	echo "Parameters :\n";
	$query = '';

	foreach($function->parameters->param as $parameter) 
	{
		echo "\t" . $parameter->name . "\n";
		$query .= $parameter->default . "/";
	}

	echo "Test URL [$function->function_name] :  $function->function_URL?$query\n";

	try 
	{
		$client = new GuzzleHttp\Client(['verify' => false]);

		$response = $client->request('GET', $URL_BASE . $function->function_URL . "/" . $query);

		if($response->getStatusCode() == 200) 
		{ 
			// if the request OK
			echo "\tResult: [" . $response->getStatusCode() . 
				", " . $response->getHeaderLine('content-type') . 
				", " . $response->getBody() . 
			"]";
		}
		else 
		{
			echo "Error : " . $response->getStatusCode();
		}

	} 
	catch (Exception $e) 
	{
		// catches all Exceptions
		echo "Error [RES]: \r\n";
		print_r($e);
	} 

	echo "\n----------------------------------------\n";
}


echo "========================================================\n";
?>