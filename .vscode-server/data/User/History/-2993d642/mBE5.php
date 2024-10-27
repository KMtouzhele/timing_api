<?php
# scraping books to scrape: https://books.toscrape.com/

require 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$response = $httpClient->get('https://www.formula1.com/en/racing/2024/');

$htmlString = (string) $response->getBody();

//add this line to suppress any warnings
libxml_use_internal_errors(true);

$doc = new DOMDocument();
$doc->loadHTML($htmlString);

$xpath = new DOMXPath($doc);

$names = $xpath->evaluate('//p[contains(@class, "f1-heading")]');
// $laps = $xpath->evaluate('');
// $baseLapTimes = $xpath->evaluate('');
// $types = $xpath->evaluate('');
foreach ($names as $key => $name) {
  echo $name->textContent.PHP_EOL;
}
