<?php

namespace App\Models;

class TrelloRequest
{
  private $apiKey;
  private $token;
  private $listId;

  public function __construct(array $config)
  {
    // Extrae valores desde la clave 'trello'
    $this->apiKey = $config['trello']['key'] ?? null;
    $this->token = $config['trello']['token'] ?? null;
    $this->listId = $config['trello']['idList'] ?? null;

    // Verifica que las claves necesarias estén configuradas
    if (!$this->apiKey || !$this->token || !$this->listId) {
      throw new \Exception('Faltan configuraciones necesarias para Trello.');
    }
  }

  public function createCard($title, $description, $dueDate, $attachmentUrl, $urgency)
  {
    $url = "https://api.trello.com/1/cards";
    $label = $this->getLabelByUrgency($urgency);

    if (!$label) {
      throw new \Exception('Etiqueta de urgencia inválida.');
    }

    // Datos para la tarjeta
    $data = [
      'key' => $this->apiKey,
      'token' => $this->token,
      'idList' => $this->listId,
      'name' => $title,
      'desc' => $description,
      'due' => $dueDate,
      'idLabels' => [$label]
    ];

    // Crear tarjeta en Trello
    $postData = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/x-www-form-urlencoded',
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Verificar si la tarjeta se creó correctamente
    if ($httpCode !== 200) {
      throw new \Exception("Error al crear la tarjeta en Trello: $response");
    }

    // Decodificar la respuesta JSON
    $cardData = json_decode($response, true);
    if (!isset($cardData['id'])) {
      throw new \Exception("No se pudo obtener el ID de la tarjeta.");
    }

    $cardId = $cardData['id'];

    // Si hay un archivo adjunto, subirlo
    if ($attachmentUrl) {
      $this->attachFileToCard($cardId, $attachmentUrl);
    }

    return $cardData;
  }

  private function attachFileToCard($cardId, $attachmentUrl)
  {
    // Asegurar que la URL sea válida y sin doble slash
    $attachmentUrl = rtrim("http://formrym.shirocompany.com/App/", '/') . '/' . ltrim($attachmentUrl, '/');

    $url = "https://api.trello.com/1/cards/$cardId/attachments";
    $data = [
      'key' => $this->apiKey,
      'token' => $this->token,
      'url' => $attachmentUrl
    ];

    $postData = http_build_query($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
      'Content-Type: application/x-www-form-urlencoded',
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode !== 200) {
      throw new \Exception("Error al adjuntar archivo en Trello: $response");
    }
  }


  private function getLabelByUrgency($urgency)
  {
    $labels = [
      'AYER' => '6743ce23b6d598df2c2c4cbb',  // ID de la etiqueta 'AYER'
      'Urgente' => '6744988be3de6cf775117bef', // ID de la etiqueta 'Urgente'
      'Medio' => '674498997c53ce950ae3660b',  // ID de la etiqueta 'Medio'
      'Baja' => '6743ce23b6d598df2c2c4cc4',    // ID de la etiqueta 'Baja'
    ];
    return isset($labels[$urgency]) ? $labels[$urgency] : null;
  }
}
