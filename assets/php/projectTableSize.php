<?php

require_once __DIR__ . '/../php/ProjectDatabase.php';
$db = new ProjectDatabase();

echo json_encode($db->getProjectTableSize());