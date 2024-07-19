<?php

require_once(__DIR__ . "/../config.php");

// Function to get a random cat image URL
function getRandomCatImage() {
    $catApiUrl = 'https://api.thecatapi.com/v1/images/search';
    $catApiResponse = file_get_contents($catApiUrl);
    $catApiData = json_decode($catApiResponse, true);
    return $catApiData[0]['url'];
}

// Function to get a random human image URL
function getRandomHumanImage() {
    return 'https://this-person-does-not-exist.com';
}

// Decide which image to get based on a condition (e.g., a request parameter)
$imageType = isset($_POST['imageType']) ? $_POST['imageType'] : 'cat'; // Default to 'cat'

if ($imageType === 'human') {
    $response["url"] = getRandomHumanImage();
} else {
    $response["url"] = getRandomCatImage();
}

header('Content-Type: application/json');
echo json_encode($response);
