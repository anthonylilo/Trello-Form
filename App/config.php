<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

return [
    'trello' => [
        'key' => $_ENV['TRELLO_KEY'] ?? getenv('TRELLO_KEY') ?? null,
        'token' => $_ENV['TRELLO_TOKEN'] ?? getenv('TRELLO_TOKEN') ?? null,
        'idList' => $_ENV['TRELLO_ID_LIST'] ?? getenv('TRELLO_ID_LIST') ?? null
    ],
    'log_file' => __DIR__ . '/../logs/error.log'
];
