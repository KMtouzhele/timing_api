<?php
// Import the Headless Chrome Library
require './vendor/autoload.php';
use daandesmedt\PHPHeadlessChrome\HeadlessChrome;

// Create a new Headless Chrome instance, and navigate to the URL
$headlessChromer = new HeadlessChrome();
$headlessChromer->setUrl('https://www.coles.com.au/search?q=ice%20cream');
$headlessChromer->setBinaryPath('google-chrome');

//some extra options are needed to combat Coles' anti-bot checking
$headlessChromer->useMobile(); //this set's the User-Agent to not say "headless"
$headlessChromer->setArgument('--headless','new');
$headlessChromer->setWindowSize(1920, 1080);

// Set the output directory to the current directory
$headlessChromer->setOutputDirectory(__DIR__);

// Turn the output into a HTML string and write it to a file
// File is only needed for if we want to debug things and check the output later
$htmlString = $headlessChromer->getDOM();
file_put_contents("fileicecream.html", $htmlString); 

//you may like to uncomment this line
//var_dump($htmlString);

//add this line to suppress any warnings
libxml_use_internal_errors(true);

// The rest is the same as before, since we have the HTML result as a string
$doc = new DOMDocument();
$doc->loadHTML($htmlString);

$xpath = new DOMXPath($doc);

// Notice the use of contains(@class, "product__title") to PARTIALLY match the class name
// (i.e. part of the class name contains this, but the element is allowed to have multiple classes)
$titlesX = $xpath->evaluate('//section[@data-testid="product-tile"]//h2[contains(@class, "product__title")]');
$prices  = $xpath->evaluate('//section[@data-testid="product-tile"]//span[contains(@class, "price__value")]');
foreach ($titlesX as $key => $title) {
    echo "\r\n----------------------$key---------------------------------\r\n";
    echo trim($title->textContent) . " @ " . trim($prices[$key]->textContent);
}

echo "\r\n";
?>