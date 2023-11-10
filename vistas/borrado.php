<?php
// Función para eliminar un archivo
function eliminarArchivo($ruta, $nombreArchivo) {
    // Construye la ruta completa del archivo
    $rutaCompleta = $ruta . '/' . $nombreArchivo;
echo "<pre>";
print_r($rutaCompleta);
echo "</pre>";
    // Verifica si el archivo existe
    if (file_exists($rutaCompleta)) {
        // Intenta eliminar el archivo
        if (unlink($rutaCompleta)) {
            echo "El archivo ha sido eliminado con éxito.";
        } else {
            echo "No se pudo eliminar el archivo.";
        }
    } else {
        echo "El archivo no existe.";
    }
}

// Ejemplo de uso de la función
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ruta']) && isset($_POST['nombreArchivo'])) {
    eliminarArchivo($_POST['ruta'], $_POST['nombreArchivo']);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Archivo</title>
</head>
<body>
<h1>Eliminar Archivo</h1>
<form action="borrado.php" method="post">
    <label for="ruta">Ruta del archivo:</label>
    <input type="text" id="ruta" name="ruta" required>
    <label for="nombreArchivo">Nombre del archivo:</label>
    <input type="text" id="nombreArchivo" name="nombreArchivo" required>
    <button type="submit">Eliminar Archivo</button>
</form>
</body>
</html>
