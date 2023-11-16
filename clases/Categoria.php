<?php
class Categoria
{
  private $id;
  private $nombre;
  private $habilitada;
  private  $descripcion;
    private $producto_id;
    private $categoria_id;

  public function __construct()
  {

  }

  public function categorias_completas(): array
  {
    $conexion = Conexion::getConexion();
    $consulta = "SELECT * FROM categorias";
    $PDOStatement =  $conexion->prepare($consulta);
    $PDOStatement->fetchAll(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll();
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

public function eliminar(): void
    {
        $conexion = Conexion::getConexion();
        $consulta = "DELETE FROM categorias WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(
            [
                ':id' => $this->id
            ]
        );
    }


    public function editar(): void
    {
        $conexion = Conexion::getConexion();
        $consulta = "UPDATE categorias SET nombre = :nombre, descripcion = :descripcion, habilitada = :habilitada WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute(
            [
                ':nombre' => $this->nombre,
                ':descripcion' => $this->descripcion,
                ':habilitada' => $this->habilitada,
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
        return $sentencia->fetch();
    }

    public function categoriaxproducto(mixed $id)
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT * FROM productos_categorias WHERE producto_id = :id";
        $sentencia = $conexion->prepare($consulta);
        $sentencia->setFetchMode(PDO::FETCH_CLASS, self::class);
        $sentencia->execute(
            [
                ':id' => $id
            ]
        );
        return $sentencia->fetch();
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

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->producto_id;
    }

    /**
     * @param mixed $producto_id
     */
    public function setProductoId($producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return mixed
     */
    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    /**
     * @param mixed $categoria_id
     */
    public function setCategoriaId($categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }


}




