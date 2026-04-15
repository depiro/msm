<!doctype html>
<html lang="es">

<head>
  <!-- Google Tag Manager -->
  <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
  'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
  })(window,document,'script','dataLayer','GTM-MQ56MXW7');</script>
  <!-- End Google Tag Manager -->

  <meta charset="<?php bloginfo('charset'); ?>">
  <meta http-equiv="Content-Language" content="es">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name') ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
  <link href="<?php echo THEME_URI ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?php echo THEME_URI ?>/assets/css/main.css" rel="stylesheet" />
  <link href="<?php echo THEME_URI ?>/assets/css/responsive.css" rel="stylesheet" />
  <?php wp_head(); ?>
</head>

<body class="wrapper">
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MQ56MXW7"
  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <header class="navbar navbar-expand-lg navbar-light msm-header-v1 d-flex flex-column">
    <div class="container px-0">
      <div class="w-100 d-flex justify-content-between px-2">
        <a class="navbar-brand text-decoration-none" href="<?php echo HOME_URI; ?>" title="<?php echo get_bloginfo('name'); ?> | Provincia de Buenos Aires. Argentina">
          <img class="msm-header-logo" src="<?php echo THEME_URI; ?>/assets/images/_msmlogo-circulo.svg" alt="logo Municipalidad de San Miguel">
        </a>

         <button class="navbar-toggler menu-container-toggle d-block d-xl-none"
        type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Desktop links con íconos -->
        <div class="justify-content-end align-items-center menu-container gap-3 d-none d-xl-flex">

          <a class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" href="/guia-tramites">
            Trámites
            <?php inline_svg('note_stack'); ?>
          </a>
          <a class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" href="/areas-gobierno">
            Áreas de Gobierno
            <?php inline_svg('flowchart'); ?>
          </a>
          <a class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" href="/areas-gobierno/gobierno-abierto">
            Gobierno Abierto
            <?php inline_svg('account_balance'); ?>
          </a>
          <a class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" href="https://online.fliphtml5.com/hxrqr/mdra/" target="_blank">
            San Miguel en Imágenes
            <?php inline_svg('images'); ?>
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Menú mobile -->
  <div class="collapse d-xl-none w-100 bg-white" id="navbarNavAltMarkup">
    <div class="w-100 p-3 d-flex flex-column gap-2">
      <a class="msm-menu-link py-2" href="/guia-tramites">  
        Trámites
        <?php inline_svg('note_stack'); ?>
      </a>
      <a class="msm-menu-link py-2" href="/areas-gobierno">
        Áreas de Gobierno
        <?php inline_svg('flowchart'); ?>
      </a>
      
      <a class="msm-menu-link py-2" href="/areas-gobierno/gobierno-abierto">
        Gobierno Abierto
        <?php inline_svg('account_balance'); ?>
      </a>
      <a class="msm-menu-link py-2" href="https://online.fliphtml5.com/hxrqr/mdra/" target="_blank">
        San Miguel en Imágenes
        <?php inline_svg('images'); ?>
      </a>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const iconSearch = document.querySelectorAll('#icon-search');
      iconSearch.forEach(icon => {
        icon.addEventListener('click', function (event) {
          event.preventDefault();
          let formBusqueda = this.previousElementSibling;
          let inputBusqueda = formBusqueda.firstElementChild;

          if ((formBusqueda.style.display === 'none' || formBusqueda.style.display === '') && window.innerWidth >= 768) {
            formBusqueda.style.display = 'block';
            inputBusqueda.focus();
          } else {
            let query = inputBusqueda.value.trim();
            if (query !== '') {
              formBusqueda.submit();
            } else {
              formBusqueda.style.display = 'none';
            }
          }
        });
      });
    });
  </script>
