<?php
require_once 'clases/Seccion.php';
require_once 'clases/Producto.php';
$seccion = new Seccion();
$secciones_completas = $seccion->secciones_completas();

//echo "<pre>";
//print_r($seccion->secciones_completas());
//echo "</pre>";

if (isset($_GET['subsec']) && isset($_GET['sec'])) {
  $subsec = $_GET['subsec'];
  $sec = $_GET['sec'];
  $seccion_elegida_ = isset($_GET['sec']) ? $_GET['sec'] : 'home';
  $subseccion_elegida_ = isset($_GET['subsec']) ? $_GET['subsec'] : 'bazar';
} else {
  $seccion_elegida_ = isset($_GET['sec']) ? $_GET['sec'] : 'home';
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bella Casa Decoracion</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown"
            aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <?PHP foreach ($secciones_completas as $sec_obj) { ?>
          <?PHP if ($sec_obj->getHabilitada() == 1) { ?>
            <?PHP if (!empty($sec_obj->getSubseccionesSubsec())) { ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                   href="index.php?sec=<?= $sec_obj->getSec(); ?>"><?= $sec_obj->getNombre(); ?></a>
                <ul class="dropdown-menu">
                  <?PHP foreach ($sec_obj->getSubseccionesSubsec() as $subsec) { ?>
                    <li><a class="dropdown-item" href="index.php?sec=<?= $sec_obj->getSec(); ?>&subsec=<?=$subsec['subsec']?>"><?= $subsec['nombre']; ?></a></li>
                  <?PHP } ?>
                </ul>
              </li>
            <?PHP } else { ?>
              <li class="nav-item">
                <a class="nav-link" href="index.php?sec=<?= $sec_obj->getSec(); ?>"><?= $sec_obj->getNombre(); ?></a>
              </li>
            <?PHP } ?>
          <?PHP } ?>
        <?PHP } ?>
      </ul>
    </div>

  </div>
</nav>
<main>
  <?PHP
  $archivo = 'vistas/' . $seccion_elegida_ . '.php';
  if (file_exists($archivo)) {
// armo el path de la vista
    require_once 'vistas/' . $seccion_elegida_ . '.php';
  } else {
    require_once 'vistas/404.php';
  }
  ?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>
<footer>

</footer>
</html>
