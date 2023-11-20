<?php
(new Autenticacion())->log_out();
$_SESSION['logout_message'] = "Has cerrado sesión correctamente.";
header("Location: " . dirname($_SERVER['PHP_SELF']) . '/index.php?sec=home&ruta=vistas');
