<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
$catalogo = new Producto();

if (isset($_GET['sec'])) {
    $sec = $_GET['sec'];
    if ($sec == 'catalogo') {
        $productos = $catalogo->todos_los_productos();
    } elseif (isset($_GET['subsec'])) {
        $subsec = $_GET['subsec'];
        $productos = $catalogo->obtenerProductosPorSubCategoriaDescripcion($subsec);
    } else {
        $productos = $catalogo->obtenerPorCategoria($sec);
    }
} elseif (isset($_GET['producto'])) {
    $busqueda = $_GET['producto'];
    $productos = $catalogo->productos_x_busqueda($busqueda);
} else {
    $productos = $catalogo->todos_los_productos();
}
$oferta = new Oferta();
foreach ($productos as $producto) {
    $ofertaProducto = $oferta->ofertaxId($producto->getID());
    ?>
    <div class="col-12 col-md-4 ">
        <div class='card mb-3'>
            <div class="card-img-container">
                <img src="img/productos/<?= $producto->getProducto_imagen() ?>" class='card-img-top'
                     alt='<?= $producto->getProducto_nombre(); ?>'>
                <?php if ($producto->getProductoOferta()) { ?>
                    <span class="ofertaestilo"><?= $ofertaProducto ? $ofertaProducto->getOfertaTitulo() : 'Oferta' ?></span>
                <?php } ?>
            </div>
            <div class="card-body">

                <h2 class="card-title mb-2"><a href="index.php?sec=producto&id=<?= $producto->getID(); ?>"
                                               class="producto_titulo_estilo"><?= $producto->getProducto_nombre(); ?></a>
                </h2>

                <span class="badge bg-primary badge_categoria">
    <a href="index.php?sec=<?= urlencode($producto->getProductoCategoria()) ?>"
       class="text-white text-decoration-none">
        <?php echo $producto->getProductoCategoria(); ?>
    </a>
</span>
                <?php foreach ($producto->getProductoSubcategoria() as $subcategoria): ?>
                    <span class="badge bg-secondary badge_subcategoria">
        <a href="index.php?sec=<?= urlencode($producto->getProductoCategoria()) ?>&subsec=<?= urlencode($subcategoria->getDescripcion()) ?>"
           class="text-white text-decoration-none">
            <?= $subcategoria->getNombre(); ?>
        </a>
    </span>
                <?php endforeach; ?>

                <p class="card-text mb-2"><?= $producto->descripcion_limite() ?></p>
                <div class="fs-3 mb-3 fw-bold text-center producto_precio_estilo">
                    <?= number_format($producto->getProducto_precio(), 2, ",", ".") ?> ARS
                </div>
                <a href="index.php?sec=producto&id=<?= $producto->getID() ?>"
                   class="btn botones_general  w-100 fw-bold mt-2 ">VER MÁS</a>
            </div>
        </div>
    </div>
    <?php
} ?>
