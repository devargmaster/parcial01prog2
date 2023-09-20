<?php

class Producto
{
  public $id;
  public $producto_nombre;
  public $producto_descripcion;
  public $producto_precio;
  public $producto_categoria;
  public $producto_imagen;
  public $producto_stock;

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
      $p->producto_imagen = $producto->producto_imagen;
      $p->producto_stock = $producto->producto_stock;
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
}
