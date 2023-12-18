<?php

class Oferta
{
    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }
    private $oferta_titulo;
    private $oferta_descripcion;
    private $producto_id;
    private $nombre_producto;
    public function __construct() {}

    public function obtenerOfertas(): bool|array
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT ofertas.*, productos.producto_nombre as nombre_producto FROM ofertas  JOIN productos ON ofertas.producto_id = productos.id";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll();
    }

    public function insertar(): bool
    {
        $conexion = Conexion::getConexion();
        $consulta = "INSERT INTO ofertas (oferta_titulo, oferta_descripcion, producto_id) VALUES (:oferta_titulo, :oferta_descripcion, :producto_id)";

        $sentencia = $conexion->prepare($consulta);

        $resultado = $sentencia->execute([
            ':oferta_titulo' => $this->oferta_titulo,
            ':oferta_descripcion' => $this->oferta_descripcion,
            ':producto_id' => $this->producto_id
        ]);

        if ($resultado) {
            $this->id = $conexion->lastInsertId();
        }

        return $resultado;
    }

    public function eliminar(): bool
    {
        $conexion = Conexion::getConexion();
        $consulta = "DELETE FROM ofertas WHERE id = :id";

        $sentencia = $conexion->prepare($consulta);
        return $sentencia->execute([':id' => $this->id]);
    }

    public function editar(): bool
    {
        $conexion = Conexion::getConexion();
        $consulta = "UPDATE ofertas SET oferta_titulo = :oferta_titulo, oferta_descripcion = :oferta_descripcion, producto_id = :producto_id WHERE id = :id";

        $sentencia = $conexion->prepare($consulta);

        return $sentencia->execute([
            ':oferta_titulo' => $this->oferta_titulo,
            ':oferta_descripcion' => $this->oferta_descripcion,
            ':producto_id' => $this->producto_id,
            ':id' => $this->id
        ]);
    }
    public function ofertaxId($id): ?self
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT ofertas.*, productos.producto_nombre as nombre_producto FROM ofertas JOIN productos ON ofertas.producto_id = productos.id WHERE ofertas.id = :id";

        $sentencia = $conexion->prepare($consulta);
        $sentencia->execute([':id' => $id]);

        $sentencia->setFetchMode(PDO::FETCH_CLASS, self::class);
        $oferta = $sentencia->fetch();

        return $oferta ?: null;
    }
    /**
     * @return mixed
     */
    public function getOfertaTitulo()
    {
        return $this->oferta_titulo;
    }

    /**
     * @param mixed $oferta_titulo
     */
    public function setOfertaTitulo($oferta_titulo): void
    {
        $this->oferta_titulo = $oferta_titulo;
    }

    /**
     * @return mixed
     */
    public function getOfertaDescripcion()
    {
        return $this->oferta_descripcion;
    }

    /**
     * @param mixed $oferta_descripcion
     */
    public function setOfertaDescripcion($oferta_descripcion): void
    {
        $this->oferta_descripcion = $oferta_descripcion;
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
    public function getNombreProducto()
    {
        return $this->nombre_producto;
    }


}
