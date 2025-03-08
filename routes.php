<?php

use App\Controllers\FormController;
use App\Models\TrelloRequest;

function handleRequest($url)
{
  $config = require __DIR__ . '/App/config.php';
  $model = new TrelloRequest($config);
  $controller = new FormController($model);

  if ($url === '/') {
    $controller->index();
  } elseif ($url === '/submit-request') {
    $controller->handleFormSubmission();
  } elseif ($url === '/success') {
    require __DIR__ . '/App/Views/success.php';
  } else {
    header("Location: /");
    exit();
  }
}
