<?php

class Productos_Categorias
{
    private $id;
    private $producto_id;
    private $categoria_id;

    public function __construct()
    {
        $this->id = null;
        $this->producto_id = null;
        $this->categoria_id = null;
    }

    public function producto_x_categoria($categoria_id)
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos_categorias WHERE categoria_id = $categoria_id";
        $stmt = $conexion->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($producto_id, $categoria_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos_categorias (producto_id, categoria_id) VALUES (:producto_id, :categoria_id)";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                ':producto_id' => $producto_id,
                ':categoria_id' => $categoria_id
            ]
        );
        $this->id = $conexion->lastInsertId();
    }

    public function eliminar()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos_categorias WHERE producto_id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                ':id' => $this->id
            ]
        );
    }

    public function editar()
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE productos_categorias SET producto_id = :producto_id, categoria_id = :categoria_id WHERE id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                ':producto_id' => $this->producto_id,
                ':categoria_id' => $this->categoria_id,
                ':id' => $this->id
            ]
        );
    }

}