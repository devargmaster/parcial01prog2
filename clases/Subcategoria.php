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
    $consulta = "SELECT subcategorias.*, categorias.nombre as categoria_nombre FROM subcategorias LEFT JOIN categorias ON subcategorias.categoria_id = categorias.id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll(PDO::FETCH_ASSOC);
  }

  /**
   * @param $categoria_id
   * @return array|false
   * Devuelve todas las subcategorías de una categoría
   */

  public function subcategoriaxid($categoria_id): bool|array
  {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM subcategorias WHERE categoria_id = :categoria_id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll(PDO::FETCH_CLASS, self::class);
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
