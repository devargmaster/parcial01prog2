<?php

class Carrito
{
    private $id;
    private $usuario_id;

    private $producto_id;
    private $cantidad;
    private $carrito_guid;
    private $precio;
    public function create_cart(): void
    {
        $carritoGUID = $this->generate_guid();
        $_SESSION['carritoGUID'] = $carritoGUID;
        $_SESSION['carrito'] = [];
    }
    private function generate_guid(): string
    {
        if (function_exists('com_create_guid') === true) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
    }

    /**
     * Agrega un item al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */
    public function add_item(int $productoID, int $cantidad): void
    {
        $catalogo = new Producto();
        $productos = $catalogo->producto_x_id($productoID);
        foreach ($productos as $producto) {
            $this->add_session_item($producto->getID(), $cantidad);
        }
    }

    /**
     * Agrega un item al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */
    private function add_session_item(int $productoID, int $cantidad): void
    {

        $catalogo = new Producto();
        $productos = $catalogo->producto_x_id($productoID);
        foreach ($productos as $producto) {
            $_SESSION['carrito'][$productoID] = [
                'id' => $productoID,
                'producto' =>  $producto->getProducto_nombre(),
                'precio' => $producto->getProducto_precio(),
                'imagen' => $producto->getProducto_imagen(),
                'cantidad' => $cantidad
            ];
        }
    }

    /**
     * Agrega un item al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */
    public function add_db_item(int $productoID, int $cantidad, int $usuarioID, string $carritoGUID, float $precio): void
    {
        try {
            $conexion = new Conexion();
            $db = $conexion->getConexion();
            $query = "INSERT INTO carrito (usuario_id, producto_id, cantidad, carrito_guid, precio) VALUES (?, ?, ?, ?, ?)";
            $PDOStatement = $db->prepare($query);
            $PDOStatement->execute(
                [
                    $usuarioID,
                    $productoID,
                    $cantidad,
                    $carritoGUID,
                    $precio
                ]
            );
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
/**
     * Agrega un item al carrito de compras
     * @param int $productoID El ID del producto que se va a agregar.
     * @param int $cantidad La cantidad de unidades del producto que se van a agregar
     */
    public function save_session_items_to_db(int $usuarioID): void
    {
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0) {
            $carritoGUID = $_SESSION['carritoGUID'];
            foreach ($_SESSION['carrito'] as $productoID => $item) {
                $this->add_db_item($productoID, $item['cantidad'], $usuarioID, $carritoGUID, $item['precio']);
            }
        }
    }

    /**
     * Elimina un item del carrito de compras
     * @param int $productoID El id del producto a elminar
     */
    public function remove_item(int $productoID): void
    {
        if (isset($_SESSION['carrito'][$productoID])) {
            unset($_SESSION['carrito'][$productoID]);
        }
    }

    /**
     * Vacia el carrito de compras
     */
    public function clear_items(): void
    {
        $_SESSION['carrito'] = [];
    }

    /**
     * Actualiza las cantidades de los ids provistos
     * @param array $cantidades Array asociativo con las cantidades de cada ID
     */
    public function update_quantities(array $cantidades): void
    {
        foreach ($cantidades as $key => $value) {
            if (isset($_SESSION['carrito'][$key])) {
                $_SESSION['carrito'][$key]['cantidad'] = $value;
            }
        }
    }

    /**
     * devuelve el contenido del carrito de compras actual
     */
    public function get_carrito(): array
    {
        if (!empty($_SESSION['carrito'])) {
            return $_SESSION['carrito'];
        } else {
            return [];
        }
    }

    /**
     * Devuelve el precio total actual del carrito de compras
     */
    public function precio_total(): float
    {
        $total = 0;
        if (!empty($_SESSION['carrito'])) {
            foreach ($_SESSION['carrito'] as $item) {
                $total += $item['precio'] * $item['cantidad'];
            }
        }
        return $total;
    }
    public function todos_los_carritos(): array
    {
        try {
            $conexion = new Conexion();
            $db = $conexion->getConexion();
            $query = "SELECT c.*, p.producto_nombre, p.producto_imagen FROM carrito c JOIN productos p ON c.producto_id = p.id ORDER BY carrito_guid";
            $PDOStatement = $db->prepare($query);
            $PDOStatement->execute();
            $result = $PDOStatement->fetchAll(PDO::FETCH_ASSOC);

            $carritos = [];
            foreach ($result as $row) {
                $carrito = new self();
                $carrito->setId($row['id']);
                $carrito->setUsuarioId($row['usuario_id']);
                $carrito->setProductoId($row['producto_id']);
                $carrito->setCantidad($row['cantidad']);
                $carrito->setCarritoGuid($row['carrito_guid']);
                $carrito->setPrecio($row['precio']);
                $carrito->producto_nombre = $row['producto_nombre'];
                $carrito->producto_imagen = $row['producto_imagen'];
                $carritos[] = $carrito;
            }

            return $carritos;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return [];
        }
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }
    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getProductoId()
    {
        return $this->producto_id;
    }

    /**
     * @param mixed $producto_id
     */
    public function setProductoId($producto_id): void
    {
        $this->producto_id = $producto_id;
    }

    /**
     * @return mixed
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * @param mixed $cantidad
     */
    public function setCantidad($cantidad): void
    {
        $this->cantidad = $cantidad;
    }

    /**
     * @return mixed
     */
    public function getCarritoGuid()
    {
        return $this->carrito_guid;
    }

    /**
     * @param mixed $carrito_guid
     */
    public function setCarritoGuid($carrito_guid): void
    {
        $this->carrito_guid = $carrito_guid;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @param mixed $precio
     */
    public function setPrecio($precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return mixed
     */
    public function getId(): mixed
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId(mixed $id): void
    {
        $this->id = $id;
    }
}