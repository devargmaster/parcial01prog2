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

    public function producto_x_categoria($producto_id)
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos_categorias WHERE producto_id = ?";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                $producto_id
            ]
        );
        return $PDOStatement->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($producto_id, $categoria_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos_categorias (producto_id, categoria_id) VALUES (:producto_id, :categoria_id)";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
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
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                ':id' => $this->id
            ]
        );
    }

    public function editar($producto_id, $categoria_id)
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE productos_categorias SET producto_id = :nuevo_producto_id, categoria_id = :nueva_categoria_id WHERE producto_id = :id_actual";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                ':nuevo_producto_id' => $producto_id,
                ':nueva_categoria_id' => $categoria_id,
                ':id_actual' => $producto_id
            ]
        );
    }


}