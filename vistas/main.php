<?php
// lo mantengo para algunas vistas estaticas
$archivo = 'vistas/' . $seccion_elegida_ . '.php';

if (!isset($_GET['sec']) && !isset($_GET['producto'])) {
  require_once 'vistas/bannerhome.php';
  require_once 'vistas/destacadoshome.php';
}
elseif (isset($_GET['sec'])) {
  if ($_GET['sec'] == 'home') {
    require_once 'vistas/bannerhome.php';
    require_once 'vistas/destacadoshome.php';
  }
  if ($_GET['sec']=='usuario' && $_GET['subsec']=='logout'){
    require_once 'accion/logout.php';
  }
  elseif ($_GET['sec'] == 'catalogo') {
    require_once 'vistas/catalogo.php';
  } elseif (file_exists($archivo)) {
    require_once $archivo;
  } else {
    require_once 'vistas/catalogo.php';
  }
} elseif (isset($_GET['producto'])) {
  require_once 'vistas/catalogo.php';
} else {
  require_once 'vistas/404.php';
}
?>
