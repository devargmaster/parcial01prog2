<h1>Decora Tutti</h1>
<?php


// aca obtengo la ruta actual del archivo, esto me sirvio mucho para meterlo en el hosting y que quede ordenado
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

if (str_contains($currentPath, '/vistas/')) {
    $basePath = '../';
}


if (isset($_GET['producto'])) {
    $seccion_elegida_ = 'catalogo';
} else {
    $seccion_elegida_ = $_GET['sec'] ?? 'home';
}

//echo "<pre>";
//print_r($secciones_completas);
//echo "</pre>";
?>
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-1">

        <a class="navbar-brand" href="index.php"><img src="../img/logo.png" class="logo" alt="Decora Tutti"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                       href="<?= $basePath ?>index.php?sec=home&ruta=vistas">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProductos" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Productos
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownProductos">
                        <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=productos&ruta=vistas">Productos
                                ABM</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=categoria&ruta=vistas">Categorías
                                ABM</a></li>
                        <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=subcategoria&ruta=vistas">Subcategorías
                                ABM</a></li>
                        <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=marca&ruta=vistas">Marcas
                                ABM</a></li>
                        <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=oferta&ruta=vistas">Ofertas
                                ABM</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">

                        <li><a class="dropdown-item" href="index.php?sec=carritos&ruta=vistas">Administrar Carritos</a>
                        </li>
                        <li><a class="dropdown-item" href="../admin/accion/auth_logout.php">Salir</a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </nav>
</div>