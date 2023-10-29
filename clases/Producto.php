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

  /**
   * Devuelve el catalogo completo de productos
   *
   *
   */
  public function todos_los_productos(): array
  {
    $productos = [];
//    $rutadelarchivo = dirname(__FILE__) . '/../data/datos.json';
//    $productos_json = file_get_contents($rutadelarchivo);
//    $productos_json_decode = json_decode($productos_json);
//    foreach ($productos_json_decode as $producto) {
//      $p = new self();
//      $p->id = $producto->id;
//      $p->producto_nombre = $producto->producto_nombre;
//      $p->producto_descripcion = $producto->producto_descripcion;
//      $p->producto_precio = $producto->producto_precio;
//      $p->producto_categoria = $producto->producto_categoria;
//      if (property_exists($producto, 'producto_subcategoria')) {
//        $p->producto_subcategoria = $producto->producto_subcategoria;
//      }
//      $p->producto_imagen = $producto->producto_imagen;
//      $p->producto_stock = $producto->producto_stock;
//      $p->producto_destacado = property_exists($producto, 'producto_destacado') ? $producto->producto_destacado : [];
//      $p->producto_info_adicional = property_exists($producto, 'producto_info_adicional') ? $producto->producto_info_adicional : [];
//      $productos[] = $p;
//    }

    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();

    $consulta = "SELECT * FROM productos";
    $resultado = $conexion->ejecutarConsulta($consulta);


    foreach ($resultado as $producto) {
      $p = new self();
      $p->id = $producto['id'];
      $p->producto_nombre = $producto['producto_nombre'];
      $p->producto_descripcion = $producto['producto_descripcion'];
      $p->producto_precio = $producto['producto_precio'];
      $p->producto_imagen = $producto['producto_imagen'];
      $p->producto_stock = $producto['producto_stock'];
      $p->producto_destacado = $producto['producto_destacado'];
      $p->producto_info_adicional = $this->getInfoAdicional($p->id);
      $p->producto_categoria = isset($producto['producto_categoria']) ? $producto['producto_categoria'] : null;
      $p->producto_subcategoria = isset($producto['producto_subcategoria']) ? $producto['producto_subcategoria'] : null;
      $productos[] = $p;
    }
    $conexion->cerrarConexion();
    return $productos;
  }


  public function getInfoAdicional($idProducto): array {
    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();
    $consulta = "select ia.caracteristica_nombre, ia.caracteristica_valor from decotutti.productos right join decotutti.informacion_adicional ia on ia.producto_id = productos.id WHERE ia.producto_id = :idProducto";

    $parametros = [':idProducto' => $idProducto];
    $resultado = $conexion->ejecutarConsulta($consulta, $parametros);

    $infoAdicional = [];
    foreach ($resultado as $info_adicional) {

        $infoAdicional[$info_adicional['caracteristica_nombre']] = $info_adicional['caracteristica_valor'];


    }
    $conexion->cerrarConexion();
    return $infoAdicional;
  }




  /**
   * Devuelve los productos por categoria
   * @param string $categoria Un string con el nombre de categoria a buscar
   *
   */
  public static function obtenerPorCategoria($categoria) {
    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();
    $resultados = [];

    $sql = "SELECT p.* FROM productos p 
        JOIN productos_categorias pc ON p.id = pc.producto_id
        JOIN categorias c ON c.id = pc.categoria_id
        WHERE c.nombre = :categoria";

    $stmt = $conexion->ejecutarConsulta($sql, [':categoria' => $categoria]);

    $stmt->bindValue(':categoria', $categoria);
    $stmt->execute();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      $resultados[] = $row; // Aquí deberías transformar cada fila en un objeto Producto si es necesario
    }

    return $resultados;
  }
  public function obtenerProductosPorCategoriaDescripcion($categoriaDescripcion) {
    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();
    $consulta = "SELECT p.* 
    FROM productos p
    JOIN productos_categorias pc ON p.id = pc.producto_id
    JOIN categorias c ON pc.categoria_id = c.id
    WHERE c.descripcion = ?";
    $parametros = [$categoriaDescripcion];
    $resultado = $conexion->ejecutarConsulta($consulta, $parametros);
    $conexion->cerrarConexion();
    return $resultado;
  }
  public function obtenerProductosPorSubCategoriaDescripcion($subcategoriaDescripcion) {
    $conexion = new Conexion('localhost', 'decotutti', 'root', 'Nvidia2022');
    $conexion->conectar();
    $consulta = "SELECT p.* 
    FROM productos p
    JOIN productos_categorias pc ON p.id = pc.producto_id
    JOIN categorias c ON pc.categoria_id = c.id
    WHERE c.descripcion = :categoriaDescripcion";
    $categoriaDescripcion = $subcategoriaDescripcion;
    $parametros = [':categoriaDescripcion' => $categoriaDescripcion];
    $resultado = $conexion->ejecutarConsulta($consulta, $parametros);
    $conexion->cerrarConexion();
    return $resultado;
  }




  /**
   * Devuelve el catalogo de productos por subcategoria
   * @param string $subcategoria Un string con subcategoria a buscar
   * @return productos[] Un Array con los elementos filtrados.
   */
public function productos_x_subcategoria($subcategoria): array
  {
    $catalogo_x_seccion = $this->todos_los_productos();
    $productos = [];
    foreach ($catalogo_x_seccion as $seccion) {
      if ($seccion->producto_subcategoria == $subcategoria) {
        $productos[] = $seccion;
      }
    }
    return $productos;
  }
  /**
   * Devuelve el catalogo de productos por subcategoria
   * @param string $nombre_producto Un string con el nombre de producto a buscar
   * @return productos[] Un Array con los elementos filtrados por nombre o parte del nombre.
   */
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
    $catalogo = $this->todos_los_productos();
    foreach ($catalogo as $producto) {
      if ($producto->id == $idProducto) {
        return $producto;
      }
    }
    return null;
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

  public function getProductoInfoAdicional(): array
  {
    return $this->producto_info_adicional;
  }

}
