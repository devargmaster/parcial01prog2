<?php
require_once "../functions/autoload.php";
$alerta = new Alerta();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'] ?? '';
    $apellido = $_POST['apellido'] ?? '';
    $email = $_POST['email'] ?? '';
    $usuario = $_POST['username'] ?? '';
    $clave = $_POST['pass'] ?? '';
    $clave2 = $_POST['pass2'] ?? '';

    if ($clave !== $clave2) {
        $alerta->add_alerta('danger', "Las contraseñas no coinciden.", "Registro");
        header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=registro');
        exit;
    }

    $claveEncriptada = password_hash($clave, PASSWORD_DEFAULT);

    $usuarioObj = new Usuario();
    $usuarioObj->setNombre($nombre);
    $usuarioObj->setApellido($apellido);
    $usuarioObj->setEmail($email);
    $usuarioObj->setUsuario($usuario);
    $usuarioObj->setClave($claveEncriptada);
    $usuarioObj->setRol('usuario');

    if ($usuarioObj->insertar()) {
        $alerta->add_alerta('success', "Usuario registrado correctamente.", "Registro");
        header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=exito_registro');
    } else {
        $alerta->add_alerta('danger', "Error al registrar el usuario.", "Registro");
        header('Location: ' . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=registro');
    }
}