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
    public function asignarProductoASubcategorias($productoId, $subcategorias): void
    {
        $conexion = Conexion::getConexion();
        foreach ($subcategorias as $subcategoriaId) {
            $query = "INSERT INTO productos_categorias_subcategorias (producto_id, subcategoria_id) VALUES (?, ?)";
              $stmt = $conexion->prepare($query);
                $stmt->execute([$productoId, $subcategoriaId]);
        }
    }


    /**
     * Actualiza las subcategorías de un producto.
     *
     * @param int $productoId ID del producto.
     * @param array $subcategorias IDs de las subcategorías seleccionadas.
     */
    public function actualizarSubcategoriasDelProducto($productoId, $subcategorias): void
    {
        $this->eliminarSubcategoriasProducto($productoId);
        $this->asignarProductoASubcategorias($productoId, $subcategorias);
    }

    /**
     * Elimina todas las subcategorías asociadas a un producto.
     *
     * @param int $productoId ID del producto.
     */
    private function eliminarSubcategoriasProducto($productoId): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos_categorias_subcategorias WHERE producto_id = ?";
        $stmt = $conexion->prepare($query);
        $stmt->execute([$productoId]);
    }

}