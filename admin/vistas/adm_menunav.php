  <h1>Decora Tutti</h1>
  <?php
  $auth = new Autenticacion();

  if (!$auth->verify()) {
  header('Location: ../admin/vistas/login.php');
  exit;
  }
  // aca obtengo la ruta actual del archivo, esto me sirvio mucho para meterlo en el hosting y que quede ordenado
  $currentPath = $_SERVER['PHP_SELF'];
  $basePath = '';

  // Aca lo hago retroceder un nivel para manejar la jerarquia del index respecto a las vistas
  if (strpos($currentPath, '/vistas/') !== false) {
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
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">DECORA TUTTI ADMIN</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="<?= $basePath ?>index.php?sec=home&ruta=vistas">Inicio</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProductos" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Productos
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownProductos">
              <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=productos&ruta=vistas">Productos ABM</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=categoria&ruta=vistas">Categorías ABM</a></li>
            <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=subcategoria&ruta=vistas">Subcategorías ABM</a></li>
            <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=marca&ruta=vistas">Marcas ABM</a></li>
            <li><a class="dropdown-item" href="<?= $basePath ?>index.php?sec=oferta&ruta=vistas">Ofertas ABM</a></li>
          </ul>
        </li>
        <!-- Usuarios -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUsuarios" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Usuarios
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownUsuarios">
            <li><a class="dropdown-item" href="#">Alta</a></li>
            <li><a class="dropdown-item" href="#">Baja</a></li>
            <li><a class="dropdown-item" href="#">Modificación</a></li>

              <li><a class="dropdown-item" href="../admin/accion/auth_logout.php">Desloguearse</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>