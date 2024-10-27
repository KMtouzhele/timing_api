<?php
require 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$response = $httpClient->get('https://www.formula1.com/en/racing/2024/');

$htmlString = (string) $response->getBody();

libxml_use_internal_errors(true);

$doc = new DOMDocument();
$doc->loadHTML($htmlString);

$xpath = new DOMXPath($doc);


$links = $xpath->evaluate('//a[contains(@class, "outline-offset-4 outline-scienceBlue group outline-0")]');

if ($links->length > 0) {
    foreach ($links as $link) {

        $href = $link->getAttribute('href');
        echo "https://www.formula1.com/$href/circuit" . PHP_EOL;
    }
} else {
    echo "No links found." . PHP_EOL;
}
?>
