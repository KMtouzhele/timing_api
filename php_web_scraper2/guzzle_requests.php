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

$tracks = [];

if ($links->length > 0) {
    foreach ($links as $link) {

        $href = $link->getAttribute('href');
        $fullUrl = "https://www.formula1.com/" . $href . "/circuit";
        //echo $fullUrl . PHP_EOL;
        $linkResponse = $httpClient->get($fullUrl);
        $linkHtmlString = (string) $linkResponse->getBody();
        libxml_use_internal_errors(true);
        $linkDoc = new DOMDocument();
        $linkDoc->loadHTML($linkHtmlString);
        $linkXpath = new DOMXPath($linkDoc);
        $circuitName = $linkXpath->evaluate('//p[contains(@class, "f1-heading tracking-normal text-fs-18px")]')->item(0)->nodeValue;
        $numberOfLapsElement = $linkXpath->evaluate('//span[contains(text(), "Number of Laps")]/following-sibling::h2[1]')->item(0);
        if ($numberOfLapsElement) {
            $numberOfLaps = $numberOfLapsElement->nodeValue;
        } else {
            $numberOfLaps = 'N/A';
        }
        $basedLapTime = $linkXpath->evaluate('//span[contains(text(), "Lap Record")]/following::h2[1]')->item(0)->nodeValue;
        $intro = $linkXpath->evaluate('//div[contains(@class, "prose man-w-none")]')->item(0);
        $introText = $linkDoc->textContent;

        $trackData = [
            'name' => $circuitName,
            'type' => isStreet($introText),
            'laps' => $numberOfLaps,
            'baseLapTime' => convertToSeconds(matchTime($basedLapTime)),

        ];

        $tracks[] = $trackData;
      }
} else {
    echo json_encode(['error' => 'No links found']);
    exit();
}
header('Content-Type: application/json');
echo json_encode($tracks);

function isStreet($text) {
    // Check if the text contains the word "street" or "streets"
    $result = strpos($text, "street") || strpos($text, "streets");
    if ($result === false) {
        return "race";
    } else {
        return "street";
    }
}

function matchTime($text) {
    preg_match('/\d+:\d{1,2}\.\d{1,3}/', $text, $matches);
    return $matches[0] ?? 'No lap time found';
}

function convertToSeconds($time) {
    if (preg_match('/^(\d+):(\d{1,2})\.(\d{1,3})$/', $time, $timeParts)) {
        $minutes = (int)$timeParts[1];
        $seconds = (int)$timeParts[2];
        $milliseconds = $timeParts[3];
        return ($minutes * 60) + $seconds + ($milliseconds / 1000);
    }
    return 0;
}
?>
