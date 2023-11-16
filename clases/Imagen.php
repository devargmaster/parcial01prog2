<?PHP

class Imagen
{
  public function subirImagen($directorio, $datosArchivo): string
  {

    $og_name = (explode(".", $datosArchivo['name']));
    $extension = end($og_name);
    $filename = time() . ".$extension";

    $fileUpload = move_uploaded_file($datosArchivo['tmp_name'], "$directorio/$filename");

    if (!$fileUpload) {
      throw new Exception("No se pudo subir la imagen");
    } else {
      return $filename;
    }
  }

  public function actualizarImagen($directorio, $datosArchivo, $imagenActual): string
  {
    $this->borrarImagen($directorio . $imagenActual);
    return $this->subirImagen($directorio, $datosArchivo);
  }

  public function borrarImagen($archivo): bool
  {

    if (file_exists(($archivo))) {

      echo "<pre>";
      print_r($archivo);
      echo "</pre>";

      $fileDelete =  unlink($archivo);

      if (!$fileDelete) {
        throw new Exception("No se pudo eliminar la imagen");
      } else {
        return TRUE;
      }
    }else{
      return FALSE;
    }
  }

}
