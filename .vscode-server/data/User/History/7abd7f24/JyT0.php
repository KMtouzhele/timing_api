<?php
# scraping books to scrape: https://books.toscrape.com/

require 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client();

$response = $httpClient->get('https://www.coles.com.au/search?q=ice%20cream');

$htmlString = (string) $response->getBody();

//add this line to suppress any warnings
libxml_use_internal_errors(true);

$doc = new DOMDocument();
$doc->loadHTML($htmlString);

$xpath = new DOMXPath($doc);

//$titles = $xpath->evaluate('//ol[@class="row"]//li//article//h3/a');
//$prices = $xpath->evaluate('//ol[@class="row"]//li//article//div[@class="product_price"]//p[@class="price_color"]');
$titlesX = $xpath->evaluate('//section[@data-testid="product-tile"]//h2[contains(@class, "product__title")]');
$prices  = $xpath->evaluate('//section[@data-testid="product-tile"]//span[contains(@class, "price__value")]');

foreach ($titles as $key => $title) {
  echo $title->textContent . ' @ '. $prices[$key]->textContent.PHP_EOL;
}
