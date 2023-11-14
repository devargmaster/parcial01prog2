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

    public function insertar() {
        $conexion = Conexion::getConexion();
        $consulta = "INSERT INTO categorias (nombre, descripcion, habilitada) VALUES (:nombre, :descripcion, :habilitada)";

        $sentencia = $conexion->prepare($consulta);

        $resultado = $sentencia->execute(
            [
                ':nombre' => $this->nombre,
                ':descripcion' => $this->descripcion,
                ':habilitada' => $this->habilitada
            ]
        );

        if($resultado) {
            $this->id = $conexion->lastInsertId();
        }

        return $resultado;
    }
    public function eliminar() {
        $conexion = Conexion::getConexion();
        $consulta = "DELETE FROM categorias WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);

        return $sentencia->execute(
            [
                ':id' => $this->id
            ]
        );
    }
    public function categoriaxid(mixed $id)
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT * FROM categorias WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->setFetchMode(PDO::FETCH_CLASS, self::class);
        $sentencia->execute(
            [
                ':id' => $id
            ]
        );
        $categoria = $sentencia->fetch();
        return $categoria;
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

  public function setID(mixed $id)
  {
    $this->id = $id;
  }

  public function setDescripcion(mixed $descripcion)
  {
    $this->descripcion = $descripcion;
  }


}




