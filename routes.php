<?php

use App\Controllers\FormController;
use App\Models\TrelloRequest;

function handleRequest($url)
{
  $config = require __DIR__ . '/App/config.php';
  $model = new TrelloRequest($config);
  $controller = new FormController($model);

  if ($url === '/') {
    $title = "Formulario de Solicitud | Shiro Company";
    $pageType = "form";
    include __DIR__ . '/App/Views/body.php';
  } elseif ($url === '/submit-request') {
    $controller->handleFormSubmission();
  } elseif ($url === '/success') {
    $title = "Solicitud Enviada | Shiro Company";
    $pageType = "success";
    include __DIR__ . '/App/Views/body.php';
  } else {
    header("Location: /");
    exit();
  }
}
