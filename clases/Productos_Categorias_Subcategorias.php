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


    /**
     * Asigna un producto a una o más subcategorías.
     *
     * @param int $productoId ID del producto.
     * @param array $subcategorias IDs de las subcategorías seleccionadas.
     */
    public function asignarProductoASubcategorias(int $productoId, array $subcategorias): void
    {
        $conexion = Conexion::getConexion();
        foreach ($subcategorias as $subcategoriaId) {
            $query = "INSERT INTO productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (?, ?)";
            $PDOStatement = $conexion->prepare($query);
            $PDOStatement->execute([$productoId, $subcategoriaId]);
        }
    }


    /**
     * Actualiza las subcategorías de un producto.
     *
     * @param int $productoId ID del producto.
     * @param array $subcategorias IDs de las subcategorías seleccionadas.
     */

    public function actualizarSubcategoriasDelProducto(int $productoId, array $subcategoriasSeleccionadas): void
    {
        $this->eliminarSubcategoriaEspecificaDelProducto($productoId);
        if (!empty($subcategoriasSeleccionadas)) {
            $this->asignarProductoASubcategorias($productoId, $subcategoriasSeleccionadas);
        }

    }

    /**
     * Elimina todas las subcategorías asociadas a un producto.
     *
     * @param int $productoId ID del producto.
     */
    private function eliminarSubcategoriaEspecificaDelProducto($productoId): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos_categorias_subcategorias WHERE producto_id = :productoId";
        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->bindParam(':productoId', $productoId, PDO::PARAM_INT);
        $PDOStatement->execute();

    }
}