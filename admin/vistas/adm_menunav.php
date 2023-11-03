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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <!-- Logo o nombre de la marca -->
    <a class="navbar-brand" href="#">MiMarca</a>
    <!-- Botón para dispositivos móviles -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Enlaces de navegación -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Características</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Precios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Acerca de</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
