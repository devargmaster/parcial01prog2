<?php require_once '../functions/autoload.php'; ?>
<?php

if (isset($_SESSION['loggedIn']['rol'])) {
    $rolUsuario = $_SESSION['loggedIn']['rol'];
    // solo si soy administrador me deja entrar al admin
    if ($rolUsuario == 'administrador') {

        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Decora Tutti Decoracion</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
                  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor"
                  crossorigin="anonymous">
            <link href="../css/estilos_generales.css" rel="stylesheet">
            <link rel="icon" type="image/png" href="img/apple-icon-60x60.png">
        </head>
        <body>

        <main class="container">
            <?PHP require_once 'vistas/adm_menunav.php'; ?>
            <div class="row">
                <?PHP require_once 'vistas/adm_main.php'; ?>
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N"
                crossorigin="anonymous"></script>


        <?PHP require_once 'vistas/adm_footer.php'; ?>
        </body>
        </html>
        <?php
    } elseif ($rolUsuario == 'usuario') {
        // si es rol usuario lo redirijo al front
        header("Location: " . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=home');
    }
} //si no estoy logueado, me redirige al login del front
else {
    header("Location: " . dirname($_SERVER['PHP_SELF'], 2) . '/index.php?sec=home');
}