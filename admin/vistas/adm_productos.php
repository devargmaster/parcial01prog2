<?php
$listaDeProductos = (new Producto())->todos_los_productos_back();
//echo "<pre>";
//print_r($listaDeProductos);
//echo "</pre>";
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';


if (strpos($currentPath, '/vistas/') !== false) {
    $basePath = '../';
}
?>
<div class="container mt-5">

    <div class="mb-4">
        <a href="index.php?sec=alta_producto&ruta=vistas" class="btn btn-primary btn-back" data-toggle="modal"
           data-target="#modalProducto">Nuevo Producto</a>
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Marca</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($listaDeProductos as $producto) { ?>
            <tr>
                <td><?= $producto->getID(); ?></td>
                <td>
                    <img src="../img/productos/<?= $producto->getProducto_imagen() ?>"
                         alt="<?= $producto->getProducto_nombre(); ?>" style="width: 50px; height: auto;">
                </td>
                <td><?= $producto->getProducto_nombre(); ?></td>
                <td><?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS</td>
                <td><?= $producto->getProductoMarca(); ?></td>
                <td>
                    <a href="<?= $basePath ?>index.php?sec=editar_producto&ruta=vistas&id=<?= $producto->getID() ?>"
                       class="btn btn-primary btn-sm">Editar</a>
                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                            data-producto-id="<?= $producto->getID(); ?>">Eliminar
                    </button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <p class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</p>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este producto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
            </div>
        </div>
    </div>
</div>


<script>
    var confirmDeleteModal = document.getElementById('confirmDeleteModal');
    confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var productoId = button.getAttribute('data-producto-id');

        var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
        confirmDeleteButton.onclick = function () {
            window.location.href = 'accion/acc_borra_producto.php?id=' + productoId;
        };
    });
</script>
