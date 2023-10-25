<?php
class Categoria
{
  private $id;
  private $nombre;
  private $habilitada;
  private mixed $url;
  private  $descripcion;


  public function __construct()
  {

  }

  public function categorias_completas(): array
  {
    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();
    $consulta = "SELECT * FROM categorias";

    $resultado = $conexion->ejecutarConsulta($consulta);
    $categorias = [];

    foreach ($resultado as $row) {
      $c = new Categoria();
      $c->setNombre($row['nombre']);
      $c->setDescripcion($row['descripcion']);
      $c->setID($row['id']);
      $c->setSec($row['url']);
      $c->setHabilitada($row['habilitada']);
      $categorias[] = $c;
    }

    return $categorias;
  }
  public function obtenerSubcategorias(): array {
    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();
    $consulta = "SELECT * FROM subcategorias WHERE categoria_id = " . $this->id;

    $resultado = $conexion->ejecutarConsulta($consulta);
    $subcategorias = [];

    foreach ($resultado as $row) {
      $s = new Subcategoria();
      $s->setNombre($row['nombre']);
      $s->setID($row['id']);
      $subcategorias[] = $s;
    }

    return $subcategorias;
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

  public  function getDescripcion()
  {
    return $this->descripcion;
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

  private function setID(mixed $id)
  {
    $this->id = $id;
  }

  private function setSec(mixed $url)
  {
    $this->url = $url;
  }

  private function setDescripcion(mixed $descripcion)
  {
    $this->descripcion = $descripcion;
  }
}




