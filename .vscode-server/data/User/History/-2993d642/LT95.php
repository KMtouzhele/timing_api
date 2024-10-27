<?php
require 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$response = $httpClient->get('https://www.formula1.com/en/racing/2024/');

$htmlString = (string) $response->getBody();

// Suppress any warnings
libxml_use_internal_errors(true);

$doc = new DOMDocument();
$doc->loadHTML($htmlString);

$xpath = new DOMXPath($doc);

// Use XPath to find all links with the specified class
$links = $xpath->evaluate('//a[contains(@class, "outline-offset-4 outline-scienceBlue group outline-0")]');

if ($links->length > 0) {
    foreach ($links as $link) {
        // Extract the href attribute for each link
        $href = $link->getAttribute('href');
        echo "Extracted href: $href" . PHP_EOL; // Output the extracted link
    }
} else {
    echo "No links found." . PHP_EOL;
}
?>
