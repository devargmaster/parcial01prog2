<?php
  spl_autoload_register('autoloadClasses');
  function autoloadClasses($nombreClase)
  {
    $path = __DIR__ . '/../clases/';
    $extension = '.php';
    $fullPath = $path . $nombreClase . $extension;
    if (!file_exists($fullPath)) {
      echo 'No existe la clase';
      return false;
    }
    include_once $fullPath;
  }
