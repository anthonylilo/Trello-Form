<?php

spl_autoload_register(function ($className) {
  // Convierte el namespace/clase en una ruta de archivo
  $path = __DIR__ . '/' . str_replace('\\', '/', $className) . '.php';

  if (file_exists($path)) {
    require_once $path;
  } else {
    // Manejo opcional si no se encuentra la clase
    error_log("Clase no encontrada: $className (ruta: $path)");
  }
});
