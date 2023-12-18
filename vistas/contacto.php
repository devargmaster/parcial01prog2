<div class="container">
  <form action="index.php?sec=procesar_formulario" method="post">
    <div class="form-row">
      <div class="col-md-6">
        <label for="nombre">Nombre:</label>
        <input type="text" class="form-control campos_estilos" id="nombre" name="nombre" required>
      </div>
      <div class="col-md-6">
        <label for="apellido">Apellido:</label>
        <input type="text" class="form-control campos_estilos" id="apellido" name="apellido" required>
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <label for="email">Email:</label>
        <input type="email" class="form-control campos_estilos" id="email" name="email" required>
      </div>
      <div class="col-md-6">
        <label for="telefono">Teléfono:</label>
        <input type="tel" class="form-control campos_estilos" id="telefono" name="telefono">
      </div>
    </div>
    <div class="form-row">
      <div class="col-md-6">
        <label for="consulta">Consulta:</label>
        <textarea class="form-control campos_estilos" id="consulta" name="consulta" required></textarea>
      </div>
    </div>
    <div class="form-group">
      <input type="submit" class="btn botones_general mt-2 mb-2" value="Enviar">
    </div>
  </form>
</div>
