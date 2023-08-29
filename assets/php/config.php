<?php
session_start();

if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = "fr"; // default language
    // vérifie si url contient la langue, si session courante != paramètre de langue, si le paramètre langue n'est pas vide
} else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
    if ($_GET['lang'] == "fr") {
        $_SESSION['lang'] = "fr";
    } else if ($_GET['lang'] == "en") {
        $_SESSION['lang'] = "en";
    }
}

// Include the correct language file
require_once __DIR__ . "/../langue/" . $_SESSION['lang'] . ".php";
?>