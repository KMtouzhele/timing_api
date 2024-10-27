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
        $fullUrl = "https://www.formula1.com/$href/circuit";
        echo $fullUrl . PHP_EOL;
        $linkResponse = $httpClient->get($fullUrl);
        $linkHtmlString = (string) $linkResponse->getBody();
        $linkDoc = new DOMDocument();
        @$linkDoc->loadHTML($linkHtmlString);
        $linkXPath = new DOMXPath($linkDoc);
        $laps = $linkXPath->evaluate('//h2[contains(@class, "f1-heading tracking-normal text-fs-22px tablet:text-fs-32px leading-tight normal-case font-bold non-italic f1-heading__body font-formulaOne")]');
        echo $laps . PHP_EOL;
      }
} else {
    echo "No links found." . PHP_EOL;
}
?>
