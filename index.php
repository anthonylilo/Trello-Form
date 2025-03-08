<?php

require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/routes.php';

$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

handleRequest($url);
