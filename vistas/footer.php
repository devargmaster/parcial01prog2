<footer class="bg-body-secondary text-light p-4 ">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <p class="estilo_titulo">Walter Arce</p>
        <p>CEO de Decora Tutti</p>
        <p>Dirección: Av. Siempre Viva 742</p>
        <div class="social-icons">
          <a href="[URL de Instagram]"><i class="fab fa-instagram"></i></a>
          <a href="[URL de Facebook]"><i class="fab fa-facebook"></i></a>
          <a href="[URL de LinkedIn]"><i class="fab fa-linkedin"></i></a>
        </div>
      </div>
      <div class="col-md-4">
        <p>Categorías</p>
        <ul class="list-unstyled">
          <?php foreach ($secciones_completas as $sec_obj) { ?>
            <?php if ($sec_obj->getHabilitada() == 1) { ?>
              <li><a href="<?= $basePath ?>index.php?sec=<?= $sec_obj->getSec(); ?>"><?= $sec_obj->getNombre(); ?></a></li>
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
