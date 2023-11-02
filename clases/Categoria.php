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
    $conexion = new Conexion();
    //$conexion->conectar();
    $consulta = "SELECT * FROM categorias";
    $PDOStatement = $conexion->getConexion()->prepare($consulta);
    $PDOStatement->execute();
    //$resultado = $conexion->getConexion($consulta);
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
    $conexion = (new Conexion())->getConexion();
    $consulta = "SELECT * FROM subcategorias WHERE categoria_id = :categoria_id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':categoria_id', $this->id, PDO::PARAM_INT); // Asume que tienes un atributo $id en Categoria.
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, Subcategoria::class); // Usa la clase Subcategoria para obtener los resultados
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


  private function setDescripcion(mixed $descripcion)
  {
    $this->descripcion = $descripcion;
  }
}




