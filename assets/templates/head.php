<?php
require_once __DIR__ . '/../php/config.php';
?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <title>Portfolio | Justine ANDREOLLI</title>
    <link rel="shortcut icon" href="assets/img/icone.png" type="image/x-icon" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Justine Andreolli" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css" />

    <link rel="stylesheet" href="assets/css/style.css" />
   
    <?= $specificCSS ?? '' ?>
    <?= $specificJS ?? '' ?>
</head>