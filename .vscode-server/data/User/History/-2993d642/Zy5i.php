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

$names = $xpath->evaluate('//fieldset//p[f1-heading tracking-normal text-fs-12px leading-tight normal-case font-normal non-italic f1-heading__body font-formulaOne]');
$laps = $xpath->evaluate('');
$baseLapTimes = $xpath->evaluate('');
$types = $xpath->evaluate('');
foreach ($$names as $key => $name) {
  echo $name->textContent.PHP_EOL;
}
