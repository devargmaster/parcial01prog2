<?php

class Subcategoria {
  private $id;
  private $nombre;
  private $descripcion;
  private $categoria_id;

  public function __construct() {}


  public function subcategorias_completas(): array
  {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM subcategorias";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    $subcategorias = $PDOStatement->fetchAll();
    return $subcategorias;
  }

  public function obtenerSubcategoriasPorCategoria($categoria_id) {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM subcategorias WHERE categoria_id = :categoria_id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
    $PDOStatement->execute();
    $subcategorias = $PDOStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    return $subcategorias;
  }

  public function getId() {
    return $this->id;
  }

  public function getNombre() {
    return $this->nombre;
  }

  public function getDescripcion() {
    return $this->descripcion;
  }

  public function getCategoriaId() {
    return $this->categoria_id;
  }

  // Métodos setters
  public function setId($id) {
    $this->id = $id;
  }

  public function setNombre($nombre) {
    $this->nombre = $nombre;
  }

  public function setDescripcion($descripcion) {
    $this->descripcion = $descripcion;
  }

  public function setCategoriaId($categoria_id) {
    $this->categoria_id = $categoria_id;
  }


}
?>