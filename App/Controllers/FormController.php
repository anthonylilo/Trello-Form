<?php

namespace App\Controllers;

use App\Models\TrelloRequest;

class FormController
{
  private $model;

  public function __construct(TrelloRequest $model)
  {
    $this->model = $model;
  }

  public function index()
  {
    include __DIR__ . '/../Views/form.php';
  }

  public function handleFormSubmission()
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Recoger los datos del formulario
      $title = $_POST['title'] ?? null;
      $urgency = $_POST['urgency'] ?? null;
      $description = $_POST['description'] ?? null;
      $dueDate = $_POST['due_date'] ?? null;

      // Adjuntar archivo si existe
      $attachment = null;
      if (!empty($_FILES['attachment']['tmp_name'])) {
        $attachment = $this->uploadFile($_FILES['attachment']);
      }

      // Construir la descripción, sin la urgencia, ya que ahora la pasamos como label
      $description .= "\n\n**Nivel de urgencia:** $urgency";

      // Llamar al modelo para crear la tarjeta
      try {
        $result = $this->model->createCard($title, $description, $dueDate, $attachment, $urgency);
        if ($result) {
          header("Location: /success");
        } else {
          echo "Error al crear la tarjeta en Trello.";
        }
      } catch (\Exception $e) {
        echo $e->getMessage();
      }
      exit();
    } else {
      http_response_code(405);
      echo "Método no permitido.";
    }
  }

  private function uploadFile($file)
  {
    // Carpeta donde se guardarán los archivos
    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    // Generar un nombre único para el archivo
    $fileName = uniqid() . '-' . basename($file['name']);
    $filePath = $uploadDir . $fileName;

    // Mover el archivo a la carpeta de subida
    if (move_uploaded_file($file['tmp_name'], $filePath)) {
      // Retornar la URL del archivo en el servidor
      return '/uploads/' . $fileName;
    }

    return null;
  }
}
