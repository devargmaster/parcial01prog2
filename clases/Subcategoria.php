<?php

class Subcategoria {
  private $id;
  private $nombre;
  private $descripcion;
  private $categoria_id;

  public function __construct() {}

  /**
   * @return array
   * Devuelve todas las subcategorías
   */
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

  /**
   * @param $categoria_id
   * @return array|false
   * Devuelve todas las subcategorías de una categoría
   */

  public function obtenerSubcategoriasPorCategoria($categoria_id) {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM subcategorias WHERE categoria_id = :categoria_id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
    $PDOStatement->execute();
    $subcategorias = $PDOStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    return $subcategorias;
  }

  /**
   * @return mixed
   * Devuelve la categoría relacionada con la subcategoría
   * @return Categoria
   * @throws Exception
   * @throws PDOException
   *
   */

  public function getCategoria() {
    // Obten la conexión a la base de datos
    $conexion = Conexion::getConexion();
    // Prepara la consulta SQL para obtener la categoría relacionada
    $consulta = "SELECT * FROM categorias WHERE id = :categoria_id";
    $PDOStatement = $conexion->prepare($consulta);
    // Vincula el categoria_id para la consulta
    $PDOStatement->bindParam(':categoria_id', $this->categoria_id, PDO::PARAM_INT);
    $PDOStatement->execute();
    // Establece el modo de recuperación para que devuelva una instancia de Categoria
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, Categoria::class);
    // Obtiene la categoría y la devuelve
    return $PDOStatement->fetch();
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
