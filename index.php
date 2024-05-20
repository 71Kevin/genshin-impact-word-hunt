<?php

error_reporting(E_ALL);

require_once 'controllers/WordSearchController.php';

$controller = new WordSearchController();
$controller->handleRequest();
?>
