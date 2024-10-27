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
        $fullUrl = "https://www.formula1.com/" . $href . "/circuit";
        echo $fullUrl . PHP_EOL;
        $linkResponse = $httpClient->get($fullUrl);
        $linkHtmlString = (string) $linkResponse->getBody();
        libxml_use_internal_errors(true);
        $linkDoc = new DOMDocument();
        $linkDoc->loadHTML($linkHtmlString);
        $linkXpath = new DOMXPath($linkDoc);
        $circuitName = $linkXpath->evaluate('//p[contains(@class, "f1-heading tracking-normal text-fs-18px")]')->item(0)->nodeValue;
        $numberOfLaps = $linkXpath->evaluate('//span[contains(text(), "Number of Laps")]/following-sibling::h2[1][preceding::span[contains(text(), "Circuit Length")]]')->item(0)->nodeValue;
        $basedLapTime = $linkXpath->evaluate('//span[contains(text(), "Lap Record")]/following::h2[1]')->item(0)->nodeValue;
        $intro = $linkXpath->evaluate('//div[contains(@class, "prose man-w-none")]')->item(0);
        $introText = $linkDoc->textContent;
        echo $circuitName . PHP_EOL;
        echo $numberOfLaps . PHP_EOL;
        echo matchTime($basedLapTime) . PHP_EOL;
        echo isStreet($introText) . PHP_EOL;
      }
} else {
    echo "No links found." . PHP_EOL;
}

function isStreet($text) {
    // Check if the text contains the word "street" or "streets"
    $result = strpos($text, "street") || strpos($text, "streets") !== false;
    if ($result === false) {
        return "Race";
    } else {
        return "Street";
    }
}

function matchTime($text) {
    preg_match('/^\d+:\d+\.\d+/', $text, $matches);
    return $matches[0];
}
?>
