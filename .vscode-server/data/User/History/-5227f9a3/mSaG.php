<?php
require_once("recommender.php");
require_once("sample_list.php"); // Ensure this file contains the $books variable

// Set the content type to JSON
header('Content-Type: application/json');

// Check if a user parameter is provided
if (isset($_GET['user']) && !empty($_GET['user'])) {
    $user = $_GET['user'];
    
    // Create an instance of the Recommender class
    $recommender = new Recommender();
    
    // Get recommendations for the specified user
    $ratinglist = $recommender->getRecommendations($books, $user);
    
    // Sort the ratings
    arsort($ratinglist);
    
    // Get the top three recommendations
    $topThreeRecommendations = array_slice($ratinglist, 0, 3, true);
    
    // Prepare the response data
    $response = [
        'user' => $user,
        'recommendations' => $topThreeRecommendations
    ];
    
    // Output the response as JSON
    echo json_encode($response);
} else {
    // Handle the case where no user is provided
    echo json_encode(['error' => 'User parameter is missing']);
}
?>
