<?php


class Seccion {
public $id;
public $nombre;
public $url;
public $habilitada;
  public function secciones_completas(): array
  {
    $secciones_json = file_get_contents('data/secciones.json');
    $secciones_json_decode = json_decode($secciones_json, TRUE);
    return $secciones_json_decode;
  }
}
