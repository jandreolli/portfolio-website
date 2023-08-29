<?php

require_once __DIR__ . '/ProjectDatabase.php';
$db = new ProjectDatabase();

$page = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}

echo json_encode($db->getProjects($page * 3, 3));