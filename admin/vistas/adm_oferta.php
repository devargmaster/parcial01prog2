<?php
$ofertas = (new Oferta())->obtenerOfertas();
$currentPath = $_SERVER['PHP_SELF'];
$basePath = '';

echo (new Alerta())->get_alertas();
if (str_contains($currentPath, '/vistas/')) {
    $basePath = '../';
}
?>
<div class="container mt-5">
    <div class="mb-4">
        <a href="index.php?sec=alta_oferta&ruta=vistas" class="btn btn-primary" data-toggle="modal" data-target="#modalProducto">Nueva Oferta</a>
    </div>
  <h1 class="text-center">Ofertas</h1>
  <table class="table table-striped">
    <thead>
    <tr>
      <th>Nombre</th>
      <th>Descripción</th>
        <th>Produto</th>
      <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($ofertas as $oferta) { ?>
      <tr>
        <td><?= $oferta->getOfertaTitulo() ?></td>
        <td><?= $oferta->getOfertaDescripcion(); ?></td>
          <td><?= $oferta->getNombreProducto(); ?></td>
        <td>
          <a href="<?= $basePath ?>index.php?sec=editar_oferta&ruta=vistas&id=<?= $oferta->getId() ?>" class="btn btn-primary btn-sm">Editar</a>
            <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-oferta-id="<?= $oferta->getId(); ?>">Eliminar</button>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>



    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <p class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta oferta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Eliminar</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var ofertaId = button.getAttribute('data-oferta-id');

            var confirmDeleteButton = confirmDeleteModal.querySelector('#confirmDeleteButton');
            confirmDeleteButton.onclick = function() {
                window.location.href = 'accion/acc_borra_oferta.php?id=' + ofertaId;
            };
        });
    </script>