<?php

class Productos_Categorias_Subcategorias
{
    private $id;
    private $producto_id;
    private $categoria_id;
    private $subcategoria_id;

    public function __construct()
    {
        $this->id = null;
        $this->producto_id = null;
        $this->categoria_id = null;
        $this->subcategoria_id = null;
    }

    public function subcategoria_x_productoid($productoid)
    {
        $conexion = Conexion::getConexion();
        $query = "SELECT * FROM productos_categorias_subcategorias WHERE producto_id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                $productoid
            ]
        );
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertar($producto_id,  $subcategoria_id)
    {
        $conexion = Conexion::getConexion();
        $query = "INSERT INTO productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (:producto_id,  :subcategoria_id)";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                ':producto_id' => $producto_id,
                ':subcategoria_id' => $subcategoria_id
            ]
        );
        $this->id = $conexion->lastInsertId();
    }

    public function eliminar()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos_categorias_subcategorias WHERE producto_id = :id";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                ':id' => $this->id
            ]
        );
    }

    public function editar($producto_id,  $subcategoria_id)
    {
        $conexion = Conexion::getConexion();
        $query = "UPDATE productos_categorias_subcategorias SET subcategoria_id = :subcategoria_id WHERE producto_id = :id_producto";
        $stmt = $conexion->prepare($query);
        $stmt->execute(
            [
                ':subcategoria_id' => $subcategoria_id,
                ':id_producto' => $producto_id
            ]
        );
    }


}