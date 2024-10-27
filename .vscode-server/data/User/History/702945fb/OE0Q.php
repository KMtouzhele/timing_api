<?php 
require_once("recommender.php"); 
require_once("sample_list.php"); 

//use the recommender class to get recommendations for Yutao (hard-coded)
$recommender = new Recommender(); 
$ratinglist = $recommender->getRecommendations($books, "Navdeep"); 

//sort the ratings
arsort($ratinglist); 

//print out ALL recommendations
echo "<pre>"; 
print_r($ratinglist); 
echo "</pre>"; 

//get the top three recommendations
$topThreeRecommendations = array_slice($ratinglist, 0, 3, true);
foreach($topThreeRecommendations as $key => $value) 
{
    echo $key . "<br/>";
}
?>