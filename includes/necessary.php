<?php
session_start();

require(__DIR__ . '/../src/redirect.php');

$request_method = strtoupper($_SERVER['REQUEST_METHOD']);

require(__DIR__ . '/../includes/seo.php');

if (isset($_GET['p'])) {
    $page = $_GET['p'];
} else {
    $page = 'home';
}

$includePage = __DIR__ . '/../pages/' . $page . '.php';
?>