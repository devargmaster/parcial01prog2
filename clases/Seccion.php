<?php


class Seccion {
private $id;
private $nombre;
private $url;
private $habilitada;
private $subsecciones;
  public function secciones_completas(): array
  {
    $rutadelarchivo = dirname(__FILE__) . '/../data/secciones.json';
    $secciones_json = file_get_contents($rutadelarchivo);
    $secciones_json_decode = json_decode($secciones_json, TRUE);
    return $secciones_json_decode;
  }
  public function subsecciones(): array
  {
    $seccionescompleta = $this->secciones_completas();
    $subsecciones = [];
    foreach ($seccionescompleta as $seccion) {
      if ($seccion['habilitada'] == 1) {
        $subsecciones[] = $seccion;
      }
    }
    return $subsecciones;
  }
  public function getNombre(): string
  {
    return $this->nombre;
  }
  public function getUrl(): string
  {
    return $this->url;
  }
  public function getHabilitada(): int
  {
    return $this->habilitada;
  }
  public function getID(): int
  {
    return $this->id;
  }

  public function setNombre(string $nombre): void
  {
    $this->nombre = $nombre;
  }
  public function setUrl(string $url): void
  {
    $this->url = $url;
  }
}



