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

$links = $xpath->evaluate('//a[contains(@class, "outline-offset-4 outline-scienceBlue group outline-0")]');
// $laps = $xpath->evaluate('');
// $baseLapTimes = $xpath->evaluate('');
// $types = $xpath->evaluate('');
if ($link->length > 0) {
  // Extract the href attribute
  $href = $link->item(0)->getAttribute('href');
  echo "Extracted href: $href" . PHP_EOL; // Output the extracted link
} else {
  echo "Link not found." . PHP_EOL;
}