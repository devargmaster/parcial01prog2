<?php
require_once 'clases/Seccion.php';
require_once 'clases/Producto.php';
$seccion = new Seccion();

//echo "<pre>";
//print_r($seccion->secciones_completas());
//echo "</pre>";


// me quedo con la seccion elegida
$seccion_elegida_ =  isset($_GET['sec']) ? $_GET['sec'] : 'home';

?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bella Casa Decoracion</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link href="css/styles.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Bella Casa</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <?PHP
    // armo los links de las secciones habilitadas
    for ($i=0; $i < count($seccion->secciones_completas()); $i++) {
      if ($seccion->secciones_completas()[$i]['habilitada'] == 1) {
        echo "<ul class='navbar-nav me-auto mb-2 mb-lg-0'>";
        echo "  <li class='nav-item'><a class='nav-link active' href=index.php?sec=" . $seccion->secciones_completas()[$i]['sec'] . " >" . $seccion->secciones_completas()[$i]['nombre'] . "</a> </li>";
        echo "</ul>";
      }
    }
    ?>
  </div>
  </div>
</nav>
<main>
<?PHP
$archivo ='vistas/'.$seccion_elegida_ .'.php';
if (file_exists($archivo)) {
// armo el path de la vista
  require_once 'vistas/' . $seccion_elegida_ . '.php';
} else {
  require_once 'vistas/404.php';
}
?>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
<footer>

</footer>
</html>
