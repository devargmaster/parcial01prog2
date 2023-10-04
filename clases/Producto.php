<?php

class Producto
{
  private $id;
  private $producto_nombre;
  private $producto_descripcion;
  private $producto_precio;
  private $producto_categoria;
  private $producto_subcategoria;
  private $producto_imagen;
  private $producto_stock;
  private $producto_destacado;
  private $producto_info_adicional;

  public function todos_los_productos(): array
  {
    $productos = [];
    $rutadelarchivo = dirname(__FILE__) . '/../data/datos.json';
    $productos_json = file_get_contents($rutadelarchivo);
    $productos_json_decode = json_decode($productos_json);
    foreach ($productos_json_decode as $producto) {
      $p = new self();
      $p->id = $producto->id;
      $p->producto_nombre = $producto->producto_nombre;
      $p->producto_descripcion = $producto->producto_descripcion;
      $p->producto_precio = $producto->producto_precio;
      $p->producto_categoria = $producto->producto_categoria;
      if (property_exists($producto, 'producto_subcategoria')) {
        $p->producto_subcategoria = $producto->producto_subcategoria;
      }
      $p->producto_imagen = $producto->producto_imagen;
      $p->producto_stock = $producto->producto_stock;
      $p->producto_destacado = property_exists($producto, 'producto_destacado') ? $producto->producto_destacado : [];
      $p->producto_info_adicional = property_exists($producto, 'producto_info_adicional') ? $producto->producto_info_adicional : [];
      $productos[] = $p;
    }
    return $productos;
  }

  public function productos_x_categoria($categoria): array
  {
    $catalogo_x_seccion = $this->todos_los_productos();
    $productos = [];
    foreach ($catalogo_x_seccion as $seccion) {
      if ($seccion->producto_categoria == $categoria) {
        $productos[] = $seccion;
      }
    }
    return $productos;
  }

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
  public function getProducto_stock(): int
  {
    return $this->producto_stock;
  }
  public function getProducto_destacado(): array
  {
    return $this->producto_destacado;
  }

  public function getProductoInfoAdicional(): array
  {
    return $this->producto_info_adicional;
  }


}
