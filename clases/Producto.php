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
  private $producto_subcategoria;
  private $producto_estado;
  private $producto_oferta_id;
  private $producto_nuevo;
  private $producto_fecha;
  private $marca_id;



  /**
   * Devuelve el catalogo completo de productos
   *
   *
   */
  public function todos_los_productos(): array
  {
    $conexion = (new Conexion())->getConexion();
    $consulta = "SELECT * FROM productos";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    return $PDOStatement->fetchAll();
  }


  /**
   * Devuelve los productos por categoria
   * @param string $categoria Un string con el nombre de categoria a buscar
   *
   */
  public static function obtenerPorCategoria($categoria): array
  {
    $conexion = (new Conexion())->getConexion();
    $consulta = "SELECT p.* FROM productos p
        JOIN productos_categorias pc ON p.id = pc.producto_id
        JOIN categorias c ON c.id = pc.categoria_id
        WHERE c.nombre = ?";

    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute([$categoria]);
    $productos = $PDOStatement->fetchAll();
    return $productos;
  }

  /**
   * Devuelve los productos por subcategoria
   * @param string $subcategoria Un string con el nombre de subcategoria a buscar
   *
   */
  public function obtenerProductosPorSubCategoriaDescripcion($subcategoriaDescripcion): ?array
  {
    $conexion = (new Conexion())->getConexion();
    $consulta = "SELECT p.*
            FROM productos p
            JOIN productos_categorias_subcategorias pcs ON p.id = pcs.producto_id
            JOIN subcategorias s ON pcs.subcategoria_id = s.id
            JOIN categorias c ON s.categoria_id = c.id
            WHERE s.descripcion = :subcategoriaDescripcion";
    $PDOStatement = $conexion->prepare($consulta);
    $PDOStatement->bindParam(':subcategoriaDescripcion', $subcategoriaDescripcion);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute();
    $productos = $PDOStatement->fetchAll();
    return $productos ?? null;
  }



  public function productos_x_busqueda($nombre_producto): array
  {
    $catalogo = $this->todos_los_productos();
    $productos = [];
    foreach ($catalogo as $producto) {
      if (str_contains(strtolower($producto->producto_nombre), strtolower($nombre_producto))) {
        $productos[] = $producto;
      }
    }
    return $productos;
  }

  /**
   * Devuelve un producto en particular caso contrario retorna nulo
   * @param string $idProducto Un entero con el id de producto a buscar
   * @return $producto un producto en particular.
   */
  public function producto_x_id(int $idProducto): ?Producto
  {
    $conexion = (new Conexion())->getConexion();
    $catalogo = "SELECT * FROM productos WHERE id = ?";
    $PDOStatement = $conexion->prepare($catalogo);
    $PDOStatement->setFetchMode(PDO::FETCH_CLASS, self::class);
    $PDOStatement->execute([$idProducto]);
    $producto = $PDOStatement->fetch();
    return $producto ?? null;
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
    $productosDestacados = array_slice($productos, 0, 3);
    return $productosDestacados;
  }

  /**
   * Devuelve la descripcion acotada a la cantidad de palabras que se le pase por parametro
   * @param int $cantidad cantidad de palabras a mostrar
   * @return resultado[] para cada producto devuelve el texto limitado a 20 palabras.
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

  public function getProducto_categoria()
  {
    return $this->producto_categoria;
  }

  public function getProducto_subcategoria()
  {
    return $this->producto_subcategoria;
  }

  public function getProducto_imagen(): string
  {
    return $this->producto_imagen;
  }

  public function getProductoInfoAdicional(): ?Informacion_adicional
  {
    return (new Informacion_adicional())->get_x_id($this->id);
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
  public function getProductoOfertaId()
  {
    return $this->producto_oferta_id;
  }

  /**
   * @return mixed
   */
  public function getProductoNuevo()
  {
    return $this->producto_nuevo;
  }

  /**
   * @return mixed
   */
  public function getProductoFecha()
  {
    return $this->producto_fecha;
  }

  /**
   * @return mixed
   */
  public function getMarcaId()
  {
    return $this->marca_id;
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

}
