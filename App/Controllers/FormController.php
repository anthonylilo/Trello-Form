<?php

namespace App\Controllers;

use App\Models\TrelloRequest;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

class FormController
{
  private $model;

  public function __construct(TrelloRequest $model)
  {
    $this->model = $model;
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
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
          $this->sendNotificationEmail($title, $description, $dueDate, $urgency);

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
    // Validar el tamaño del archivo
    if ($file['size'] > 50000000) { // 50 MB en bytes
      throw new \Exception("El archivo adjunto es demasiado grande.");
    }

    $uploadDir = __DIR__ . '/../uploads/';
    if (!is_dir($uploadDir)) {
      mkdir($uploadDir, 0777, true);
    }

    // Limpiar el nombre del archivo y evitar espacios en blanco
    $fileName = uniqid() . '-' . str_replace(' ', '_', basename($file['name']));
    $filePath = $uploadDir . $fileName;

    if (move_uploaded_file($file['tmp_name'], $filePath)) {
      return 'uploads/' . $fileName;
    }

    return null;
  }

  private function sendNotificationEmail($title, $description, $dueDate, $urgency)
  {
    $mail = new PHPMailer(true);

    try {
      // Configuración del servidor SMTP
      $mail->isSMTP();
      $mail->Host = $_ENV['SMTP_HOST'];
      $mail->SMTPAuth = true;
      $mail->Username = $_ENV['SMTP_USER'];
      $mail->Password = $_ENV['SMTP_PASS'];
      $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
      $mail->Port = $_ENV['SMTP_PORT'];

      // Remitente y destinatario
      $mail->setFrom($_ENV['SMTP_FROM'], 'Shiro Company');
      $mail->addAddress($_ENV['SMTP_TO']);

      // Contenido del correo
      $mail->isHTML(true);
      $mail->Subject = 'Nueva solicitud creada';
      $mail->Body    = "<p>Se ha creado una nueva solicitud con los siguientes detalles:</p>
                        <p><strong>Título:</strong> $title</p>
                        <p><strong>Descripción:</strong> $description</p>
                        <p><strong>Fecha de entrega:</strong> $dueDate</p>
                        <p><strong>Urgencia:</strong> $urgency</p>";

      // Enviar el correo
      $mail->send();
    } catch (Exception $e) {
      error_log("Error al enviar el correo: {$mail->ErrorInfo}");
    }
  }
}
