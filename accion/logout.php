<?php
ob_start();
(new Autenticacion())->log_out();
$_SESSION['logout_message'] = "Has cerrado sesión correctamente.";

echo "<pre>";
print_r($_SESSION);
echo "</pre>";

    header("Location: " . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=home');

