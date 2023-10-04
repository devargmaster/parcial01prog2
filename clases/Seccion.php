<?php
$obj = new Producto();
$catalogo = $obj->todos_los_productos();
class Seccion
{
  private $id;
  private $sec;
  private $subsecciones = [];
  private $nombre;
  private $url;
  private $habilitada;


  public function __construct()
  {
    $this->subsecciones = [];
  }

  public function secciones_completas(): array
  {
    $rutadelarchivo = dirname(__FILE__) . '/../data/secciones.json';
    $secciones_json = file_get_contents($rutadelarchivo);
    $secciones_json_decode = json_decode($secciones_json);
    $secciones = [];

    foreach ($secciones_json_decode as $seccion_data) {
      $seccion = new Seccion();
      $seccion->setSec($seccion_data->sec);
      $seccion->setNombre($seccion_data->nombre);
      $seccion->setHabilitada($seccion_data->habilitada);


      if (property_exists($seccion_data, 'subsecciones')) {
        $seccion->setSubsecciones($seccion_data->subsecciones);
      }
      else{
        $seccion->setSubsecciones([]);
      }
      $secciones[] = $seccion;
    }

    return $secciones;
  }
  public function getSubseccionesSubsec(): array
  {
    $subseccionesSubsec = [];
    foreach ($this->subsecciones as $subseccion) {
      if (property_exists($subseccion, 'subsec')) {
        $subseccionesSubsec[] = [
         'nombre' => $subseccion->nombre,
          'subsec' => $subseccion->subsec
        ];
      }
    }
    return $subseccionesSubsec;
  }

  public function getSec()
  {
    return $this->sec;
  }

  public function setSec($sec)
  {
    $this->sec = $sec;
  }

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setNombre($nombre)
  {
    $this->nombre = $nombre;
  }

  public function getUrl()
  {
    return $this->url;
  }

  public function getHabilitada()
  {
    return $this->habilitada;
  }

  public function setHabilitada($habilitada)
  {
    $this->habilitada = $habilitada;
  }

  public function getID()
  {
    return $this->id;
  }

  public function getSubsecciones()
  {
    return $this->subsecciones;
  }

  public function setSubsecciones($subsecciones)
  {
    $this->subsecciones = $subsecciones;
  }
}




