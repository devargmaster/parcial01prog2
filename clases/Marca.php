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
    public function insertar(): bool
    {
        $conexion = Conexion::getConexion();
        $consulta = "INSERT INTO marcas (marca_titulo, marca_descripcion) VALUES (:marca_titulo, :marca_descripcion)";

        $sentencia = $conexion->prepare($consulta);

        $resultado = $sentencia->execute(
          [
            ':marca_titulo' => $this->marca_titulo,
            ':marca_descripcion' => $this->marca_descripcion
          ]
        );

        if($resultado) {
            $this->id = $conexion->lastInsertId();
        }

        return $resultado;
    }
      public function eliminar(): bool
      {
            $conexion = Conexion::getConexion();
            $consulta = "DELETE FROM marcas WHERE id = :id";
            $sentencia = $conexion->prepare($consulta);

            return $sentencia->execute(
                [
                    ':id' => $this->id
                ]
            );
        }
        public function marcaxid(mixed $id)
        {
            $conexion = Conexion::getConexion();
            $consulta = "SELECT * FROM marcas WHERE id = :id";
            $sentencia = $conexion->prepare($consulta);
            $sentencia->setFetchMode(PDO::FETCH_CLASS, self::class);
            $sentencia->execute(
                [
                    ':id' => $id
                ]
            );
            $marca = $sentencia->fetch();
            return $marca;
        }
    public function getId()
    {
      return $this->id;
    }

    public function setId($id)
    {
      $this->id = $id;
    }

    public function getMarcaTitulo()
    {
      return $this->marca_titulo;
    }

    public function setMarcaTitulo($marca_titulo)
    {
      $this->marca_titulo = $marca_titulo;
    }

    public function getMarcaDescripcion()
    {
      return $this->marca_descripcion;
    }

    public function setMarcaDescripcion($marca_descripcion)
    {
      $this->marca_descripcion = $marca_descripcion;
    }

}
