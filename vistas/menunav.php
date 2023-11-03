<h1>Decora Tutti</h1>
<?php

// aca obtengo la ruta actual del archivo, esto me sirvio mucho para meterlo en el hosting y que quede ordenado
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

// Aca lo hago retroceder un nivel para manejar la jerarquia del index respecto a las vistas
if (strpos($currentPath, '/vistas/') !== false) {
  $basePath = '../';
}

$seccion = new Categoria();
$secciones_completas = $seccion->categorias_completas();

if (isset($_GET['producto'])) {
  $seccion_elegida_ = 'catalogo';
} else {
  $seccion_elegida_ = $_GET['sec'] ?? 'home';
}


//echo "<pre>";
//print_r($secciones_completas);
//echo "</pre>";
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
        <?php if ($sec_obj->getHabilitada() == 1) {
        $subcategorias = $sec_obj->subcategorias_completas();
        if (count($subcategorias) > 0) { ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
             href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getDescripcion(); ?>"><?= $sec_obj->getNombre(); ?></a>
          <ul class="dropdown-menu">
            <?php foreach ($subcategorias as $subcategoria) { ?>
              <li>
                <a class="dropdown-item"
                   href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getDescripcion(); ?>&subsec=<?= $subcategoria->getDescripcion(); ?>">
                  <?= $subcategoria->getNombre(); ?>
                </a>

              </li>
            <?php } ?>
          </ul>
        </li>
        <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getDescripcion(); ?>"><?= $sec_obj->getNombre(); ?></a>
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
