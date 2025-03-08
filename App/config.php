<?php
require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

return [
    'trello' => [
        'key' => getenv('TRELLO_KEY'),
        'token' => getenv('TRELLO_TOKEN'),
        'idList' => getenv('TRELLO_ID_LIST')
    ],
    'log_file' => __DIR__ . '/../' . getenv('LOG_FILE_PATH')
];
