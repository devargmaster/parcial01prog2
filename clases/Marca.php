<?php

class Marca
{
  private $id;
  private $marca_titulo;
  private $marca_descripcion;

  public function __construct()
  {
  }
  public function todas_las_marcas (): array
  {
    $conexion = (new Conexion())->getConexion();
    $consulta = "SELECT * FROM marcas";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll();
  }

  /**
   * @return mixed
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * @return mixed
   */
  public function getMarcaTitulo()
  {
    return $this->marca_titulo;
  }

  /**
   * @return mixed
   */
  public function getMarcaDescripcion()
  {
    return $this->marca_descripcion;
  }
}
