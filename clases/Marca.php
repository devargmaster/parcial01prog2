<?php

class Marca
{
    private $id;
    private $marca_titulo;
    private $marca_descripcion;

    public function __construct()
    {
    }

    public function todas_las_marcas(): array
    {
        $conexion = (new Conexion())->getConexion();
        $consulta = "SELECT * FROM marcas";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll();
    }
    public function todas_las_marcas_con_cantidad(): array
    {
        $conexion = (new Conexion())->getConexion();
        $consulta = "SELECT marcas.id, marcas.marca_titulo, marcas.marca_descripcion, COUNT(productos.id) AS cantidad FROM marcas LEFT JOIN productos ON marcas.id = productos.marca_id GROUP BY marcas.id";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll();
    }

    public function insertar(): bool
    {
        $conexion = Conexion::getConexion();
        $consulta = "INSERT INTO marcas (marca_titulo, marca_descripcion) VALUES (:marca_titulo, :marca_descripcion)";

        $PDOStatement = $conexion->prepare($consulta);

        $resultado = $PDOStatement->execute(
            [
                ':marca_titulo' => $this->marca_titulo,
                ':marca_descripcion' => $this->marca_descripcion
            ]
        );

        if ($resultado) {
            $this->id = $conexion->lastInsertId();
        }

        return $resultado;
    }

    public function eliminar(): bool
    {
        try {
            $conexion = Conexion::getConexion();
            $consulta = "DELETE FROM marcas WHERE id = :id";
            $PDOStatement = $conexion->prepare($consulta);

            return $PDOStatement->execute(
                [
                    ':id' => $this->id
                ]
            );
        } catch (PDOException $e) {
            error_log("Error al eliminar la marca: " . $e->getMessage());
            throw new Exception("Error al eliminar la marca: " . $e->getMessage());
        }
    }

    public function marcaxid(mixed $id)
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT * FROM marcas WHERE id = :id";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(
            [
                ':id' => $id
            ]
        );
        return $PDOStatement->fetch();
    }

    public function editar($nombre, $descripcion): bool
    {
        $conexion = Conexion::getConexion();
        $consulta = "UPDATE marcas SET marca_titulo = :marca_titulo, marca_descripcion = :marca_descripcion WHERE id = :id";
        $sentencia = $conexion->prepare($consulta);
        return $sentencia->execute(
            [
                ':id' => $this->id,
                ':marca_titulo' => $nombre,
                ':marca_descripcion' => $descripcion
            ]
        );
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
