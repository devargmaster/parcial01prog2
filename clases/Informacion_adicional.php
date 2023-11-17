<?php

class Informacion_adicional
{
  private $id;
  private $medidas;
  private $peso;
  private $material;
  private $origen;
  private $producto_id;

  public function get_x_id(int $idProducto) : ?Informacion_adicional
  {
    $conexion = (new Conexion())->getConexion();
    $consulta = "select * from informacion_adicional WHERE producto_id = $idProducto";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();

    $infoAdicional = null;
    foreach ($PDOStatement as $row) {
      $infoAdicional = $row;
      break;
    }
    return $infoAdicional;
  }
  public function insertarInformacionAdicional(
    string $medidas,
    string $peso,
    string $material,
    string $origen,
    int $producto_id
  ) : int
  {
    $conexion = (new Conexion())->getConexion();
    $consulta = "INSERT INTO informacion_adicional (medidas, peso, material, origen, producto_id) VALUES (?, ?, ?, ?, ?)";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->execute([$medidas, $peso, $material, $origen, $producto_id]);
    return $conexion->lastInsertId();

  }

  // Getters
  public function getId()
  {
    return $this->id;
  }

  public function getMedidas()
  {
    return $this->medidas;
  }

  public function getPeso()
  {
    return $this->peso;
  }

  public function getMaterial()
  {
    return $this->material;
  }

  public function getOrigen()
  {
    return $this->origen;
  }

  public function getProductoId()
  {
    return $this->producto_id;
  }
}
