<?php

class Producto
{
    private $id;
    private $producto_nombre;
    private $producto_descripcion;
    private $producto_precio;
    private $producto_imagen;
    private $producto_stock;
    private $producto_destacado;
    private $producto_info_adicional;
    private $producto_categoria;
    private ?Oferta $producto_oferta;

    public function getProductoOferta(): ?Oferta
    {
        return $this->producto_oferta;
    }


    private $producto_subcategoria;
    private $producto_estado;

    private $producto_nuevo;
    private $producto_fecha;

    private $fecha_upd;
    private $usuario_upd;

    private $producto_marca;


    private $categoria_id;
    private $subcategoria_id;

    private $producto_id;

    private static $createValues = [
        'id',
        'producto_nombre',
        'producto_descripcion',
        'producto_precio',
        'producto_imagen',
        'producto_stock',
        'producto_destacado',
        'producto_estado',
        'producto_nuevo',
        'producto_fecha',
        'marca_id'
    ];


    private function createProducto($productoData) : Producto
    {
        $producto = new self();


        foreach (self::$createValues as $value) {
            $producto->{$value} = $productoData[$value];
        }
        $producto->producto_marca = (new Marca())->marcaxid($productoData['marca_id']);
        $producto->producto_categoria = (new Productos_Categorias())->producto_x_categoria($productoData['id']);
        $producto->producto_info_adicional = (new Informacion_adicional())->get_x_id($productoData['id']);
        $producto->producto_oferta = (new Oferta())->ofertaxId($productoData['id']);

        return $producto;
    }

    /**
     * Devuelve el catalogo completo de productos frontend
     *
     *
     */
    public function todos_los_productos(): array
    {
        $productos = [];
        $conexion = Conexion::getConexion();
        $consulta = "SELECT p.* FROM productos p 
        JOIN productos_categorias pc ON p.id = pc.producto_id
        JOIN productos_categorias_subcategorias pcs ON p.id = pcs.producto_id where producto_estado = 1";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
//        $catalogo = $PDOStatement->fetchAll();
//        echo "<pre>";
//        print_r($catalogo);
//        echo "</pre>";
        while ($result= $PDOStatement->fetch()) {
            $productos[] = $this->createProducto($result);
        }
    return $productos ?? [];
    }

    /**
     * Devuelve el catalogo completo de productos backend
     *
     *
     */
    public function todos_los_productos_back(): array
    {
        $productos = [];
        $conexion = Conexion::getConexion();
        $consulta = "SELECT * FROM productos";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute();
        while ($result= $PDOStatement->fetch()) {
            $productos[] = $this->createProducto($result);
        }
        return $productos ?? [];
    }

    /**
     * Devuelve los productos por categoria
     * @param string $categoria Un string con el nombre de categoria a buscar
     *
     */
    public  function obtenerPorCategoria($categoria): array
    {
        $productos = [];
        $conexion = Conexion::getConexion();
        $consulta = "SELECT p.* FROM productos p
        JOIN productos_categorias pc ON p.id = pc.producto_id
        JOIN categorias c ON c.id = pc.categoria_id
        WHERE c.nombre = ? and  p.producto_estado = 1";

        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$categoria]);
        while ($result= $PDOStatement->fetch()) {
            $productos[] = $this->createProducto($result);
        }
        return $productos;
    }

    /**
     * Devuelve los productos por subcategoria
     * @param string $subcategoria Un string con el nombre de subcategoria a buscar
     *
     */
    public function obtenerProductosPorSubCategoriaDescripcion($subcategoriaDescripcion): array
    {
        $productos = [];
        $conexion = Conexion::getConexion();
        $consulta = "SELECT p.*
            FROM productos p
            JOIN productos_categorias_subcategorias pcs ON p.id = pcs.producto_id
            JOIN subcategorias s ON pcs.subcategoria_id = s.id
            JOIN categorias c ON s.categoria_id = c.id
            WHERE s.descripcion = :subcategoriaDescripcion and  p.producto_estado = 1";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute(['subcategoriaDescripcion' => $subcategoriaDescripcion]);
        while ($result= $PDOStatement->fetch()) {
            $productos[] = $this->createProducto($result);
        }
        return $productos ?? [];
    }


    public function productos_x_busqueda($nombre_producto): array
    {
        $productos = [];
        $conexion = Conexion::getConexion();
        $consulta = "SELECT * FROM productos WHERE producto_nombre LIKE ?";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute(["%$nombre_producto%"]);
        while ($result= $PDOStatement->fetch()) {
            $productos[] = $this->createProducto($result);
        }
        return $productos ?? [];
    }

    public function productos_destacados_cantidad_subcategoria()
    {
        $conexion = Conexion::getConexion();
        $consulta = "SELECT 
            p.producto_nombre, 
            (SELECT COUNT(DISTINCT pcs.subcategoria_id) 
             FROM productos_categorias_subcategorias pcs 
             WHERE pcs.producto_id = p.id) AS cantidad_subcategorias 
        FROM 
            productos p 
        JOIN 
            productos_categorias pc ON pc.producto_id = p.id 
        WHERE 
            p.producto_destacado = 1 
        LIMIT 3;";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->execute();
        return $PDOStatement->fetchAll();
    }
    /**
     * Devuelve un producto en particular caso contrario retorna nulo
     * @param string $idProducto Un entero con el id de producto a buscar
     * @return $producto un producto en particular.
     */
    public function producto_x_id(int $idProducto): array
    {
        $productos =[];
        $conexion = Conexion::getConexion();
        $catalogo = "SELECT * FROM productos WHERE id = ?";
        $PDOStatement = $conexion->prepare($catalogo);
        $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
        $PDOStatement->execute([$idProducto]);
        while ($result= $PDOStatement->fetch()) {
            $productos[] = $this->createProducto($result);
        }
        return $productos ?? [];
    }

    public function insertarProducto($producto_nombre, $producto_descripcion, $producto_precio, $producto_imagen, $producto_stock, $producto_destacado, $producto_estado, $producto_nuevo, $marca_id)
    {
        $conexion = Conexion::getConexion();
        $consulta = "INSERT INTO productos (producto_nombre, 
                     producto_descripcion, producto_precio, producto_imagen, 
                     producto_stock, producto_destacado, 
                      producto_estado,  producto_nuevo, marca_id) VALUES (:producto_nombre, :producto_descripcion, :producto_precio, :producto_imagen, :producto_stock, :producto_destacado, :producto_estado,  :producto_nuevo,  :marca_id)";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->execute(
            [
                'producto_nombre' => $producto_nombre,
                'producto_descripcion' => $producto_descripcion,
                'producto_precio' => $producto_precio,
                'producto_imagen' => $producto_imagen,
                'producto_stock' => $producto_stock,
                'producto_destacado' => $producto_destacado,
                'producto_estado' => $producto_estado,
                'producto_nuevo' => $producto_nuevo,
                'marca_id' => $marca_id
            ]
        );

        return $conexion->lastInsertId();
    }

    /**
     * Actualiza esta instancia en la base de datos
     * @param string $producto_nombre
     * @param string $producto_descripcion
     * @param float $producto_precio
     * @param string $producto_imagen
     * @param int $producto_stock
     * @param int $marca_id
     * @param int $producto_estado
     * @param $categoria_id
     * @param int $producto_nuevo
     * @param string $producto_fecha
     * @param int $producto_destacado
     */


    public function actualizar_producto($id, $nombre, $descripcion, $precio, $stock, int $marca_id, $categoria_id, int $producto_estado, int $producto_destacado, $imagen = null): void
    {
        $conexion = Conexion::getConexion();
        $consulta = "UPDATE productos SET producto_nombre = :producto_nombre, producto_descripcion = :producto_descripcion, producto_precio = :producto_precio,producto_stock = :producto_stock, marca_id = :marca_id , producto_estado= :producto_estado ,producto_destacado= :producto_destacado ,producto_imagen=:producto_imagen  WHERE id = :id";
        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->execute(
            [
                'producto_nombre' => $nombre,
                'producto_descripcion' => $descripcion,
                'producto_precio' => $precio,
                'producto_stock' => $stock,
                'marca_id' => $marca_id,
                'producto_estado' => $producto_estado,
                'producto_destacado' => $producto_destacado,
                'producto_imagen' => $imagen,
                'id' => $id
            ]
        );

        $productos_categorias = (new Productos_Categorias())->producto_x_categoria($id);
        if ($productos_categorias) {
            (new Productos_Categorias())->editar($id, $categoria_id);
        } else {
            (new Productos_Categorias())->insertar($id, $categoria_id);
        }

    }


    /**
     * Elimina esta instancia de la base de datos
     */
    public function delete(): void
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM productos WHERE id = ?";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute([$this->id]);
    }

    public function producto_x_rango_precio(int $precioMinimo = 0, int $precioMaximo = 0): array
    {
        $conexion = Conexion::getConexion();
        if ($precioMaximo) {
            $consulta = "SELECT * FROM productos WHERE producto_precio BETWEEN :precioMinimo AND :precioMaximo";
        } else {
            $consulta = "SELECT * FROM productos WHERE producto_precio >= :precioMinimo";
        }

        $PDOStatement = $conexion->prepare($consulta);
        $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
        $PDOStatement->execute(['precioMinimo' => $precioMinimo, 'precioMaximo' => $precioMaximo]);
        return $PDOStatement->fetchAll();
    }


    public function actualizarSubcategoriasDelProducto($productoId, array $subcategoriasSeleccionadas): void
    {
        (new Productos_Categorias_Subcategorias())->actualizarSubcategoriasDelProducto($productoId, $subcategoriasSeleccionadas);
    }

    /**
     * Devuelve una lista de productos destacados
     *
     * @return productos[] array de productos que cumplen con la condicion de tener la marca de destacado.
     */
    public function productos_destacados(): array
    {
        $catalogo = $this->todos_los_productos();
        $productos = [];
        foreach ($catalogo as $producto) {
            if ($producto->producto_destacado == true) {
                $productos[] = $producto;
            }
        }
        return array_slice($productos, 0, 3);
    }

    /**
     * Devuelve una lista de productos destacados
     *
     * @return productos[] array de productos que cumplen con la condicion de tener la marca de destacado.
     */
    public function descripcion_limite(int $cantidad = 20): string
    {
        $texto = $this->producto_descripcion;

        $array = explode(" ", $texto);
        if (count($array) <= $cantidad) {
            $resultado = $texto;
        } else {
            array_splice($array, $cantidad);
            $resultado = implode(" ", $array) . "...";
        }

        return $resultado;
    }

    public function getID()
    {
        return $this->id;
    }

    public function getProducto_nombre()
    {
        return $this->producto_nombre;
    }

    public function getProducto_descripcion(): string
    {
        return $this->producto_descripcion;
    }

    public function getProducto_precio(): float
    {
        return $this->producto_precio;
    }


    public function getProducto_imagen(): string
    {
        return $this->producto_imagen ?? '';
    }




    /**
     * @return mixed
     */
    public function getProductoEstado()
    {
        return $this->producto_estado;
    }


    /**
     * @return mixed
     */
    public function getProductoStock()
    {
        return $this->producto_stock;
    }

    /**
     * @return mixed
     */
    public function getProductoDestacado()
    {
        return $this->producto_destacado;
    }
    /**
     * @return mixed
     */
    public function getProductoMarca()
    {
        return $this->producto_marca->getMarcaTitulo();
    }
    public function getInformacionAdicional(): array
    {
        return $this->producto_info_adicional;
    }
    /**
     * @return mixed
     */
    public function getProductoCategoria()
    {
        return $this->producto_categoria->getCategoriaNombre();
    }
    public function clear_info_adicional()
    {
        $conexion = Conexion::getConexion();
        $query = "DELETE FROM informacion_adicional WHERE producto_id = :producto_id";

        $PDOStatement = $conexion->prepare($query);
        $PDOStatement->execute(
            [
                'producto_id' => $this->id
            ]
        );
    }
}
