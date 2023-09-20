<?php


class Seccion {
public $id;
public $nombre;
public $url;
public $habilitada;
  public function secciones_completas(): array
  {
    $rutadelarchivo = dirname(__FILE__) . '/../data/secciones.json';
    $secciones_json = file_get_contents($rutadelarchivo);
    $secciones_json_decode = json_decode($secciones_json, TRUE);
    return $secciones_json_decode;
  }
}
