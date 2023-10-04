<h1>Decora Tutti</h1>
<?php
require_once dirname(__DIR__) . '/clases/Seccion.php';
// aca obtengo la ruta actual del archivo, esto me sirvio mucho para meterlo en el hosting y que quede ordenado
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

// Aca lo hago retroceder un nivel para manejar la jerarquia del index respecto a las vistas
if (strpos($currentPath, '/vistas/') !== false) {
  $basePath = '../';
}

$seccion = new Seccion();
$secciones_completas = $seccion->secciones_completas();
if (isset($_GET['subsec']) && isset($_GET['sec'])) {
  $subsec = $_GET['subsec'];
  $sec = $_GET['sec'];
  $seccion_elegida_ = isset($_GET['sec']) ? $_GET['sec'] : 'home';
}
if (isset($_GET['producto'])) {
  $seccion_elegida_ = isset($_GET['sec']) ? $_GET['sec'] : 'catalogo';
} else {
  $seccion_elegida_ = isset($_GET['sec']) ? $_GET['sec'] : 'home';
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
        <?PHP foreach ($secciones_completas as $sec_obj) { ?>
          <?PHP if ($sec_obj->getHabilitada() == 1) { ?>
            <?PHP if (!empty($sec_obj->getSubseccionesSubsec())) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                   href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getSec(); ?>"><?= $sec_obj->getNombre(); ?></a>
                <ul class="dropdown-menu">
                  <?PHP foreach ($sec_obj->getSubseccionesSubsec() as $subsec) { ?>
                    <li><a class="dropdown-item"
                           href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getSec(); ?>&subsec=<?= $subsec['subsec'] ?>"><?= $subsec['nombre']; ?></a>
                    </li>
                  <?PHP } ?>
                </ul>
              </li>
            <?PHP } else { ?>
              <li class="nav-item">
                <a class="nav-link"
                   href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getSec(); ?>"><?= $sec_obj->getNombre(); ?></a>
              </li>
            <?PHP } ?>
          <?PHP } ?>
        <?PHP } ?>
      </ul>
      <form class="d-flex" action="index.php" method="get" role="search">
        <input class="form-control me-2" type="search" name="producto" placeholder="Buscar" aria-label="Search">

        <button class="btn carrito_boton_estilo" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>
