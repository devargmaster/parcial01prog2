<footer class="bg-body-secondary text-light p-4 ">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <p class="estilo_titulo">Walter Arce</p>
        <p>CEO de Decora Tutti</p>
        <p>Dirección: Av. Siempre Viva 742</p>
        <div class="social-icons">
          <a href="https://www.instagram.com/3dvoto/"><i class="fab fa-instagram"></i></a>
          <a href="https://www.linkedin.com/in/walterarce/"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="col-md-4">
        <p>Categorías</p>
        <ul class="list-unstyled">
          <?php foreach ($secciones_completas as $sec_obj) { ?>
            <?php if ($sec_obj['habilitada'] == 1) { ?>
              <li><a href="<?= $basePath ?>index.php?sec=<?= $sec_obj['descripcion']; ?>"><?= $sec_obj['nombre']; ?></a>
              </li>
            <?php } ?>
          <?php } ?>
        </ul>
      </div>
      <div class="col-md-4">
        <p>Contacto</p>
        <p>Email: walter.arce@davinci.edu.ar</p>
        <p>Teléfono: 5551115550</p>
      </div>
    </div>
  </div>
</footer>
