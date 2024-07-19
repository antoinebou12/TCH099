<?php
require_once(__DIR__ . "/utils/utils.php");

function getRandomCatImage() {
    $catApiUrl = 'https://api.thecatapi.com/v1/images/search';
    $catApiResponse = file_get_contents($catApiUrl);
    $catApiData = json_decode($catApiResponse, true);
    return $catApiData[0]['url'];
}

function getRandomHumanImage() {

    $humanApiUrl = 'https://thispersondoesnotexist.com';
    return $humanApiUrl;
}

$imageType = isset($_POST['imageType']) ? $_POST['imageType'] : 'cat';

$response = [];
if ($imageType === 'human') {
    $response["url"] = getRandomHumanImage();
} else {
    $response["url"] = getRandomCatImage();
}

header('Content-Type: application/json');
echo json_encode($response);
?>
