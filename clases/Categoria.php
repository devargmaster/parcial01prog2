<?php
class Categoria
{
  private $id;
  private $nombre;
  private $habilitada;
  private  $descripcion;


  public function __construct()
  {

  }

  public function categorias_completas(): array
  {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM categorias";
    $PDOStatement =  $conexion->prepare($consulta);
    $PDOStatement->execute();
    $categorias = [];

    foreach ($PDOStatement as $row) {
      $c = new Categoria();
      $c->setNombre($row['nombre']);
      $c->setDescripcion($row['descripcion']);
      $c->setID($row['id']);
      $c->setHabilitada($row['habilitada']);
      $categorias[] = $c;
    }

    return $categorias;
  }
  public function subcategorias_completas(): array {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM subcategorias WHERE categoria_id = :categoria_id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':categoria_id', $this->id, PDO::PARAM_INT);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, Subcategoria::class);
    $PDOStatement->execute();

    $subcategorias = $PDOStatement->fetchAll();
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


  private function setDescripcion(mixed $descripcion)
  {
    $this->descripcion = $descripcion;
  }
}




