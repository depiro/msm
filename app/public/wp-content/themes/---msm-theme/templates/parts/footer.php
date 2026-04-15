<footer class="p-0 d-flex justify-content-center flex-column h-auto">
  <div class="py-3 contacto d-flex justify-content-center">
    <div class="container text-white text-center row justify-content-center align-items-center py-3">

      <!-- Columna izquierda -->
      <div
        class="col-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-start mb-3 mb-md-0">
        <div class="d-flex flex-column align-items-center align-items-md-start p-3 text-white">
          <span class="fz-20 fw-600 text-center text-md-start">2025 Municipalidad de San Miguel</span>
          <span class="fz-16 text-center text-md-start fst-italic">Domingo Faustino Sarmiento 1551, San
            Miguel<br>Provincia de Buenos Aires, Argentina</span>
        </div>
      </div>

      <!-- Logo -->

      <div class="col-12 col-md-4 d-none d-md-flex justify-content-center">
        <a class="logo-footer" href="<?php echo HOME_URI; ?>"
          title="<?php bloginfo('name') ?> | Provincia de Buenos Aires. Argentina">
          <img src="<?php echo THEME_URI; ?>/assets/images/__msmlogo-circulo.svg" alt="logo MSM" width="160">
        </a>
      </div>

      <!-- Columna derecha -->
      <div class="col-12 col-md-4 d-flex flex-column align-items-center align-items-md-start">
        <p class="fz-16 d-flex flex-wrap align-items-center justify-content-center justify-content-md-start mb-1 gap-2">
          <a class="text-white text-decoration-none" href="<?php echo HOME_URI; ?>/terminos-y-condiciones/">Términos y
            Condiciones</a>
          <span>|</span>
          <a href="<?php bloginfo('url'); ?>/feed" target="_blank" class="rss">Suscripción vía RSS</a>
        </p>
        <div class="d-flex justify-content-center justify-content-md-start gap-2">
          <a href="https://www.facebook.com/MuniSanMiguelBA/" target="_blank">
            <img class="icon-footer-redes" src="<?php echo THEME_URI; ?>/assets/images/social/face-icon.svg"
              height="24">
          </a>
          <a href="https://www.instagram.com/munisanmiguel/?hl=es-la" target="_blank">
            <img class="icon-footer-redes" src="<?php echo THEME_URI; ?>/assets/images/social/insta-icon.svg"
              height="24">
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Números de contacto -->
  <div class="d-flex justify-content-center contact-numbers py-3">
    <div class="container phone-container row justify-content-center align-items-center">

      <div class="container">
        <div class="phone-footer-group justify-content-center flex-wrap">
          <?php
          $telefonos = [
            ['SAME', '107'],
            ['Bomberos', '(011) 4664-2222'],
            ['COM', '0800-333-1055'],
            ['Comisaría de la mujer', '(011) 4455-0371'],
            ['Atención al vecino', '147'],
          ];
          $total = count($telefonos);
          foreach ($telefonos as $index => $tel):
            ?>
            <div class="d-flex flex-column align-items-center text-center px-3 mb-4">
              <span class="phone-item-name"><?php echo $tel[0]; ?></span>
              <a class="phone-item-number fw-400" href="tel:<?php echo preg_replace('/[^0-9]/', '', $tel[1]); ?>">
                <?php echo $tel[1]; ?>
              </a>
            </div>

            <?php if ($index < $total - 1): ?>
              <div class="separator d-none d-md-block"></div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
</footer>



<script src="https://web.chat-tonic.com/api/v1/load/san-miguel"></script>
<script src="<?php echo THEME_URI; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo THEME_URI; ?>/assets/js/fullcalendar.global.min.js"></script>

<script src="<?php echo THEME_URI; ?>/assets/js/bootstrap.bundle.min.js"></script>
<?php wp_footer(); ?>
</body>

</html>