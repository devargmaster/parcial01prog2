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
      break; // Rompe el bucle ya que solo esperas un resultado.
    }
    return $infoAdicional;
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
