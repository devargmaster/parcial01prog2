<h1>Decora Tutti</h1>
<?php
ob_start();
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/vistas/')) {
    $basePath = '../';
}

$secciones_completas = (new Categoria())->categorias_completas();
$subcategorias_completas = (new Subcategoria())->subcategorias_completas_nofiltrada();
$subcategorias_por_categoria = [];
foreach ($subcategorias_completas as $subcategoria) {
    $subcategorias_por_categoria[$subcategoria['categoria_id']][] = $subcategoria;
}

if (isset($_GET['producto'])) {
    $seccion_elegida_ = 'catalogo';
} else {
    $seccion_elegida_ = $_GET['sec'] ?? 'home';
}
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="img/logo.png" class="logo" alt="Decora Tutti"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php foreach ($secciones_completas as $sec_obj) { ?>
                    <?php if ($sec_obj['habilitada'] == 1) {
                        if (isset($subcategorias_por_categoria[$sec_obj['id']])) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                                   href="<?= $basePath ?>index.php?sec=<?= $sec_obj['descripcion']; ?>"><?= $sec_obj['nombre']; ?></a>
                                <ul class="dropdown-menu">
                                    <?php foreach ($subcategorias_por_categoria[$sec_obj['id']] as $subcategoria) { ?>
                                        <li>
                                            <a class="dropdown-item"
                                               href="<?= $basePath ?>index.php?sec=<?= $sec_obj['descripcion']; ?>&subsec=<?= $subcategoria['descripcion']; ?>">
                                                <?= $subcategoria['nombre'];?>
                                            </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= $basePath ?>index.php?sec=<?= $sec_obj['descripcion']; ?>"><?= $sec_obj['nombre']; ?></a>
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ul>
            <form class="d-flex" action="index.php" method="get" role="search">
                <input class="form-control me-2" type="search" name="producto" placeholder="Buscar" aria-label="Search">
                <button class="btn carrito_boton_estilo" type="submit">Buscar</button>
            </form>
        </div>
    </div>
</nav>
