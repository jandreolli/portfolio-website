<?php

require_once __DIR__ . '/ProjectDatabase.php';
require_once __DIR__ . '/GetForm.php';

new ProjectDatabase();
$searchRequest = new GetForm();

$searchInput = '';
if (isset($_GET['search'])) {
    $searchInput = htmlspecialchars($_GET['search']);
}

$results = $searchRequest->getSearchResults($searchInput);
// affiche correctement les accents
echo json_encode($searchRequest->sendResults($results), JSON_UNESCAPED_UNICODE);