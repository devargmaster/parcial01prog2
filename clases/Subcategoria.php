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

  public function subcategoriaxid($id): ?Subcategoria {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM subcategorias WHERE id = :id";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':id', $id, PDO::PARAM_INT);
    $PDOStatement->execute();
    $result = $PDOStatement->fetchObject(self::class);
    return $result ?: null;
  }


  public function eliminar(): bool
  {
    $conexion = Conexion::getConexion();
    $consulta = "DELETE FROM subcategorias WHERE id = :id";
    $sentencia = $conexion->prepare($consulta);
    return $sentencia->execute(
      [
        ':id' => $this->id
      ]
    );
  }

  public  function insertar(): bool
  {
    $conexion = Conexion::getConexion();
    $consulta = "INSERT INTO subcategorias (nombre, descripcion, categoria_id) VALUES (:nombre, :descripcion, :categoria_id)";
    $sentencia = $conexion->prepare($consulta);
    $resultado = $sentencia->execute(
      [
        ':nombre' => $this->nombre,
        ':descripcion' => $this->descripcion,
        ':categoria_id' => $this->categoria_id
      ]
    );
    if ($resultado) {
      $this->id = $conexion->lastInsertId();
    }
    return $resultado;
  }
  public function actualizar(): bool
  {
    $conexion = Conexion::getConexion();
    $consulta = "UPDATE subcategorias SET nombre = :nombre, descripcion = :descripcion, categoria_id = :categoria_id WHERE id = :id";
    $sentencia = $conexion->prepare($consulta);
    return $sentencia->execute(
      [
        ':nombre' => $this->nombre,
        ':descripcion' => $this->descripcion,
        ':categoria_id' => $this->categoria_id,
        ':id' => $this->id
      ]
    );
  }

  public function subcategoriaxproducto($productoid)
  {
    $conexion = Conexion::getConexion();
    $query = "SELECT * FROM productos_categorias_subcategorias WHERE producto_id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->execute(
      [
        $productoid
      ]
    );
    $resultado = $stmt->fetch();
    return $resultado !== false ? $resultado : null;
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
