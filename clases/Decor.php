<?php

class Decor
{
  public function todos_los_productos(): array
  {
    $secciones_json = file_get_contents('data/decor.json');
    $secciones_json_decode = json_decode($secciones_json, TRUE);
    return $secciones_json_decode;
  }
}
