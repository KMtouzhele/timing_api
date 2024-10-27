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

$names = $xpath->evaluate('//p[contains(@class, "f1-heading__body")]');
// $laps = $xpath->evaluate('');
// $baseLapTimes = $xpath->evaluate('');
// $types = $xpath->evaluate('');
if ($names->length > 0) {
  foreach ($names as $name) {
      echo $name->textContent . PHP_EOL;
  }
} else {
  echo "No names found." . PHP_EOL;
}
