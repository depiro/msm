<?php
/**
 * Template Name: Style Guide
 */

 get_template_part(THEME_HEADER);  ?>

<div class="container style-guide">

    <div class="row my-2  justify-content-center">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Guía de Estilos</span>
		</div>
    </div>
    <!-- <h1>Guía de Estilos</h1> -->
    <div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1">Guía de Estilos</h2>
			<p class="fz-18">Guía UI y de componentes para tema de Wordpress 'Msmtheme' </p>
		</div>    

    <!-- Tipografía -->
    <section>
        <h2 class="section-title">Tipografía</h2>
        <p>Escala tipográfica usada 'Minor third'con la fuente 'Roboto' de Google.</p>
        
        <div class="mb-4">
            <h1>Encabezado H1</h1>
            <h2>Encabezado H2</h2>
            <h3>Encabezado H3</h3>
            <h4>Encabezado H4</h4>
            <h5>Encabezado H5</h5>
            <h6>Encabezado H6</h6>
            <p>Párrafo p</p>
            <p class=text-muted>Párrafo p - muted</p>
            <caption>Texto de caption</caption>

            <ul>
                <li>Lista item 1</li>
                <li>Lista item 2</li>
                <li>Lista item 3</li>
            </ul>
            
            <ol>
                <li>Lista item 1</li>
                <li>Lista item 2</li>
                <li>Lista item 3</li>
            </ol>

            <section class="container py-5">
                <h2 class="fw-bold mb-4">Trámites gestionados</h2>
                <div class="row text-start">
                    
                    <!-- Columna 1 -->
                    <div class="col-md-4 mb-4">
                        <h6 class="mb-2">Permisos de obra</h6>
                        <ul class="ps-3">
                            <li>Obra nueva.</li>
                            <li>Ampliación.</li>
                            <li>Demolición.</li>
                            <li>Trabajos mínimos <small class="text-muted">(Aviso de obra).</small></li>
                        </ul>
                    </div>

                    <!-- Columna 2 -->
                    <div class="col-md-4 mb-4">
                        <h6 class="mb-2">Informes e inspecciones:</h6>
                        <ul class="ps-3">
                            <li>Informe de avance e inspección.</li>
                            <li>Final de obra.</li>
                        </ul>
                    </div>

                    <!-- Columna 3 -->
                    <div class="col-md-4 mb-4">
                        <h6 class="mb-2">Regularización</h6>
                        <ul class="ps-3">
                            <li>Obras existentes.</li>
                            <li>Cambio de destino.</li>
                        </ul>
                    </div>
                </div>
            </section>


            <section class="container my-5">
                <h1 style="font-size: var(--msm-text-xl); font-weight: 700; line-height: 1.1;">
                    Encabezado H1 - var(--msm-text-xl); font-weight: 700; line-height: 1.1;
                </h1>
                <h2 style="font-size: var(--msm-text-lg); font-weight: 700; line-height: 1.2;">
                    Encabezado H2 - font-size: var(--msm-text-lg); font-weight: 700; line-height: 1.2;
                </h2>
                <h3 style="font-size: var(--msm-text-md); font-weight: 600; line-height: 1.3;">
                    Encabezado H3 - font-size: var(--msm-text-md); font-weight: 600; line-height: 1.3;
                </h3>
                <h4 style="font-size: var(--msm-text-sm); font-weight: 600; line-height: 1.4;">
                    Encabezado H4 - font-size: var(--msm-text-sm); font-weight: 600; line-height: 1.4;
                </h4>
                <h5 style="font-size: var(--msm-text-xs); font-weight: 500; line-height: 1.3;">
                    Encabezado H5 - font-size: var(--msm-text-xs); font-weight: 500; line-height: 1.3;
                </h5>
                <h6 style="font-size: var(--msm-text-xxs); font-weight: 500; line-height: 1.5;">
                    Encabezado H6 - font-size: var(--msm-text-xxs); font-weight: 500; line-height: 1.5;
                </h6>

                <p style="font-size: var(--msm-text-xxs); font-weight: 400; line-height: 1.55;">
                    Párrafo font-size: var(--msm-text-xxs); font-weight: 400; line-height: 1.55;
                </p>

                <p>
                En el corazón del barrio, donde las veredas conocen cada paso y el aroma del pan recién horneado cruza de casa en casa, la convivencia no es solo un ideal: es una práctica diaria. Lorem ipsum portón abierto sit amet, mate compartido adipiscing elit. Tocar timbre y esperar, saludar con una sonrisa, ceder el paso en la esquina: pequeñas acciones que construyen comunidad.
                </p>

                <p class="text-muted" style="font-size: var(--msm-text-xxs); font-weight: 400; line-height: 1.55;"> Párrafo p - muted: Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.</p>

                <caption style="display: block; font-size: 0.75rem; font-weight: 400; line-height: 1.5;">
                    Texto de caption
                </caption>

                <ul style="font-size: var(--msm-text-xxs); line-height: 1.6;">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                </ul>

                <ol style="font-size: var(--msm-text-xxs); line-height: 1.6;">
                    <li>Item 1</li>
                    <li>Item 2</li>
                    <li>Item 3</li>
                </ol>
            </section>
        </div>
    </section>

    <!-- Enlaces -->
    <section>
        <h2 class="section-title">Links</h2>
        <div class="link-group">
            <a href="#">Link Normal</a>
            <a href="#" style="color: var(--blue-msm-400);">Link Azul</a>
            <a href="#" style="color: var(--msm-gray);">Link Gris</a>
        </div>
    </section>
    <!-- Enlaces fin -->

<section>
<section class="styleguide-section my-5">
  <h2 class="mb-4">Vista previa de íconos SVG</h2>

  <div class="icon-grid d-grid gap-3" style="grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));">
    <?php
    $icon_dir = get_theme_file_path('/assets/images/icons/');
    $icon_files = glob($icon_dir . '*.svg');

    foreach ($icon_files as $path):
      $name = basename($path, '.svg');
      $content = file_get_contents($path);
    ?>
      <div class="icon-box border rounded p-3 text-center bg-white shadow-sm">
        <div class="icon-preview mb-2" style="color: var(--msm-blue); width: 48px; height: 48px; margin: 0 auto;">
          <?php echo $content; ?>
        </div>
        <div class="icon-name small text-muted"><?php echo esc_html($name); ?></div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

</section>

    <section>
        <h2 class="section-title">Breadcrumb</h2>
        <div class="msm-breadcrumb d-block d-sm-row">
            <a class="msm-breadcrumb-item-first" href="http://msm-dev.local">Home /</a><a class="msm-breadcrumb-item" href="http://msm-dev.local/prensa"> Prensa /</a><span class="msm-breadcrumb msm-breadcrumb-item-last">Ojos en Alerta llegó a un nuevo municipio de Córdoba</span>
        </div>
    </section>

    <section>
    <h2 class="section-title">Encabezados de contenidos 'Noticias'</h2>
        <h1 class="post-title">Ojos en Alerta llegó a un nuevo municipio de Córdoba</h1>

        <h5 class="post-resume">
            <p>Ya hay 44 distritos en 9 provincias del país adheridos a esta herramienta de seguridad originada en San Miguel. El intendente de San Miguel, Jaime Méndez, firmó ayer un convenio con el jefe comunal de Sampacho (Córdoba), Franco Suárez, para implementar Ojos en Alerta en su distrito. Se trata de un programa originado en San […]</p>
        </h5>
        <div class="post-content">
            <p>Una mujer de 52 años con un tumor benigno en el estómago se realizó una importante cirugía con intervenciones mínimas en el Hospital Larcade de San Miguel. A través de esta operación, realizada por un abordaje mixto laparoscópico-endoscópico, se resecó por completo el tumor, evitando una gastrectomía total (resección completa del estómago). Gracias a este procedimiento, se logró evitar complicaciones luego de la cirugía, disminuir el dolor post-operatorio y tener una recuperación mucho más rápida. La paciente tuvo una internación de 24 horas.</p>
            <p>Es la primera intervención de este tipo realizada en el Hospital Larcade. La misma estuvo a cargo del cirujano especialista en cirugía esofogástrica Ignacio Fuente, asistido por los médicos Florencia Ramos, Pilar García Carrillo y Camilo Gómez.</p>
        </div>
    </section> 

    <h2 class="section-title">Encabezados de Páginas</h2>
        <div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1">Áreas de gobierno</h2>
			<p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel</p>
		</div>

    <!-- Banners -->
    <section>
        <h2 class="section-title">Banners</h2>

        <?php
            set_query_var('banner_consultas', [
            'title' => 'Iniciá tus pedidos o consultas',
            'button_text' => 'Iniciar consultas',
            'button_url' => '/consultas',
            'image' => get_template_directory_uri() . '/assets/images/banner_2_blanca.png'
            ]);
            get_template_part('templates/parts/banner-grande');
        ?>

        <!-- <?php
            set_query_var('banner_consultas', [
            'title' => 'Iniciá tus pedidos o consultas',
            'button_text' => 'Iniciar consultas',
            'button_url' => '/consultas',
            'style' => 'shadow-sm rounded',
            'image' => get_template_directory_uri() . '/assets/images/banner_2_celeste.png'
            ]);
            get_template_part('templates/parts/banner-grande');
        ?> -->


<div class="row d-flex justify-content-center px-3  mb-4">
    <h3 class="text-center mb-0">¡Sumate!</h3>
    
    <div class="row gy-3">
    <?php
            set_query_var('banners_home', [
            [
                'url' => '/debito-automatico',
                'icon' => 'facturas.svg',
                'title' => '¡Adherite al débito automático!',
                'text'  => 'y ganá tranquilidad todos los meses',
                'style' => 'shadow-sm'
            ],
            [
                'url' => '/vacunacion',
                'icon' => 'vacunas.svg',
                'title' => 'Poné las <strong>VACUNAS AL DÍA</strong>',
                'text'  => 'completá el calendario de vacunación',
                'style' => 'shadow-sm'
            ]
            ]);
            get_template_part('templates/parts/banners-home');
        ?>
    </div>
</div>
</section>

    <!-- Botones -->
    <section>
        <h2 class="section-title">Botones</h2>
        
        <div class="button-group">
            <h3>Bootstrap buttons</h3>
            <button type="button" class="btn btn-primary">Primary</button>
            <button class="btn btn-outline-primary">Outlined</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button class="btn btn-outlimed-primary" disabled>Outlined Deshabilitado</button>
        </div>

        <div class="button-group mt-4">
            <h4>Bootstrap buttons 'sm'</h4>
            <button type="button" class="btn btn-primary btn-sm">Primary</button>
            <button class="btn btn-outline-primary btn-sm">Outlined</button>
            <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
            <button class="btn btn-outlimed-primary btn-sm" disabled>Deshabilitado</button>
        </div>
    </section>

    <section class="mb-5">
        <h2 class="section-title">Cards</h2>

        <a href="#" class="text-decoration-none areas-gobierno-item py-3">
            <div class="card areas-card d-flex flex-row shadow-sm rounded overflow-hidden align-items-stretch mb-5">
                <!-- Franja celeste lateral -->
                <div class="areas-barra d-flex align-items-center justify-content-center"></div>

                <!-- Contenido -->
                <div class="acceso-content p-4">
                    <h5 class="areas-title  mb-1">Jefatura de Gabinete</h5>
                    <p class="areas-description text-secondary mb-0"> La Jefatura de Gabinete se encarga de coordinar el gobierno municipal, promoviendo la comunicación entre áreas.</p>
                    <!-- <span class="text-primary text-decoration-underline">Ver más</span> -->
                </div>
            </div>
        </a>


        <a href="#" class="text-decoration-none areas-gobierno-item">
            <div class="card areas-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                <!-- Franja celeste con ícono centrado -->
                <div class="card-icon d-flex align-items-center justify-content-center">
                    <?php inline_svg('images'); ?>
                </div>

                <!-- Contenido -->
                <div class="areas-content p-4">
                    <h5 class="areas-title mb-1">CULTURA</h5>
                    <p class="areas-description text-secondary mb-0">Descubrí talleres, eventos y actividades.</p>
                </div>
            </div>
        </a>
    </section> 


    <section>
        <!-- AREAS DE GOBIERNO -->
        <div class="row d-flex justify-content-center">
            <h3 class="text-center mt-1 mb-4">Áreas de gobierno</h3>
            <div class="page-content row">
                <?php
                set_query_var('mostrar_descripcion', false);
                get_template_part('templates/parts/areas-cards');
                ?>
            </div>
        </div>
    </section>
    <!-- AREAS DE GOBIERNO FIN -->

    <section>
        <h3 class="text-center mt-3">Cards programas y servicios (taxonomias)</h3>
        <?php get_template_part('inc/programas-servicios'); ?>
    <section/>



<section>
<section class="accesos-programas container py-5">
  <h2 class="text-center mb-4">¡Conocé todos los programas y servicios que tenemos para vos!</h2>
  <div class="row g-3">    
    <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #00B4EC;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">ATENCIÓN AL VECINO</h5>
                    </div>
                </div>
            </a>
        </div>
    
    <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
            <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                <!-- Franja celeste con ícono centrado -->
                <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #F7921E;">
                    <?php inline_svg('images'); ?>
                </div>

                <!-- Contenido -->
                <div class="acceso-content p-4">
                    <h5 class="acceso-title mb-1">CULTURA</h5>
                </div>
            </div>
        </a>
    </div>
      
    <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #F7921E;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">SALUD</h5>
                    </div>
                </div>
            </a>
        </div>

    <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #E96674;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">EMPRENDEDORES</h5>
                    </div>
                </div>
            </a>
        </div>


    <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #949494;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">DEPORTES</h5>
                    </div>
                </div>
            </a>
        </div>        
        
        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #E6D74F;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">ZOONOSIS</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #62ACDF;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">SALUD</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #1C78FF;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">TECNOLOGÍA</h5>
                    </div>
                </div>
            </a>
        </div>
        
        
        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #EC672F;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">ADULTOS MAYORES</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #B864A3;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">INFANCIA Y FAMILIA</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #3D5762;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">EDUCACION</h5>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #BF7564;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">DISCAPACIDAD</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #3DB6AD;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">ADICCIONES</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #E0B670;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">TIERRA Y VIVIENDAS</h5>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #43B183;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">RECICLAJE</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #775F57;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">AMBIENTE</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #3072A4;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">EMPLEO</h5>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #FFB800;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">INDUSTRIA Y COMERCIO</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #C2717A;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">HABILITACIONES</h5>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-md-4">
        <a href="#" class="text-decoration-none areas-gobierno-item">
                <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                    <!-- Franja celeste con ícono centrado -->
                    <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: #F6A340;">
                        <?php inline_svg('images'); ?>
                    </div>

                    <!-- Contenido -->
                    <div class="acceso-content p-4">
                        <h5 class="acceso-title mb-1">CULTURA</h5>
                    </div>
                </div>
            </a>
        </div>




    <!-- Agregá más accesos... -->

  </div>
</section>

<section/>


    <!-- Colores -->
    <section>
        <h2 class="section-title">Colores Bootstrap</h2>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-primary);">
                    <h5 class="color-text">Primary</h5>
                    <p class="color-hex">#3dbfee</p>
                    <p class="color-var">--bs-primary</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-secondary);">
                    <h5 class="color-text">Secondary</h5>
                    <p class="color-hex">#1a85ac</p>
                    <p class="color-var">--bs-secondary</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-success);">
                    <h5 class="color-text">Success</h5>
                    <p class="color-hex">#198754</p>
                    <p class="color-var">--bs-success</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-info);">
                    <h5 class="color-text">Info</h5>
                    <p class="color-hex">#0dcaf0</p>
                    <p class="color-var">--bs-info</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-warning);">
                    <h5 class="color-text light-text">Warning</h5>
                    <p class="color-hex light-text">#ffc107</p>
                    <p class="color-var light-text">--bs-warning</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-danger);">
                    <h5 class="color-text">Danger</h5>
                    <p class="color-hex">#dc3545</p>
                    <p class="color-var">--bs-danger</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--bs-light);">
                    <h5 class="color-text">Light</h5>
                    <p class="color-hex">#f8f9fa</p>
                    <p class="color-var">--bs-light</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-dark);">
                    <h5 class="color-text">Dark</h5>
                    <p class="color-hex">#212529</p>
                    <p class="color-var">--bs-dark</p>
                </div>
            </div>
        </div>

        <h2 class="section-title">MSM Colores</h2>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue);">
                    <h5 class="color-text">MSM Blue</h5>
                    <p class="color-hex">#3dbfee</p>
                    <p class="color-var">--msm-blue</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-v2);">
                    <h5 class="color-text">MSM Blue v2</h5>
                    <p class="color-hex">#1a85ac</p>
                    <p class="color-var">--msm-blue-v2</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-v3);">
                    <h5 class="color-text">MSM Blue v3</h5>
                    <p class="color-hex">#5d6988</p>
                    <p class="color-var">--msm-blue-v3</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-v4);">
                    <h5 class="color-text">MSM Blue v4</h5>
                    <p class="color-hex">#364262</p>
                    <p class="color-var">--msm-blue-v4</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-light);">
                    <h5 class="color-text">MSM Blue Light</h5>
                    <p class="color-hex">#6fcbed</p>
                    <p class="color-var">--msm-blue-light</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-gray);">
                    <h5 class="color-text">MSM Gray</h5>
                    <p class="color-hex">#717075</p>
                    <p class="color-var">--msm-gray</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-black);">
                    <h5 class="color-text">MSM Black</h5>
                    <p class="color-hex">#575756</p>
                    <p class="color-var">--msm-black</p>
                </div>
            </div>
        </div>

        <h2 class="section-title">MSM Blue Scale</h2>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--blue-msm-50);">
                    <h5 class="color-text">Blue MSM 50</h5>
                    <p class="color-hex">#e2f3fc</p>
                    <p class="color-var">--blue-msm-50</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--blue-msm-100);">
                    <h5 class="color-text">Blue MSM 100</h5>
                    <p class="color-hex">#bfe6f8</p>
                    <p class="color-var">--blue-msm-100</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--blue-msm-200);">
                    <h5 class="color-text">Blue MSM 200</h5>
                    <p class="color-hex">#86d4f3</p>
                    <p class="color-var">--blue-msm-200</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-300);">
                    <h5 class="color-text">Blue MSM 300</h5>
                    <p class="color-hex">#35b7e8</p>
                    <p class="color-var">--blue-msm-300</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-400);">
                    <h5 class="color-text">Blue MSM 400</h5>
                    <p class="color-hex">#1ea5d9</p>
                    <p class="color-var">--blue-msm-400</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-500);">
                    <h5 class="color-text">Blue MSM 500</h5>
                    <p class="color-hex">#1085b9</p>
                    <p class="color-var">--blue-msm-500</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-600);">
                    <h5 class="color-text">Blue MSM 600</h5>
                    <p class="color-hex">#0f6a95</p>
                    <p class="color-var">--blue-msm-600</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-700);">
                    <h5 class="color-text">Blue MSM 700</h5>
                    <p class="color-hex">#105a7c</p>
                    <p class="color-var">--blue-msm-700</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-800);">
                    <h5 class="color-text">Blue MSM 800</h5>
                    <p class="color-hex">#134b67</p>
                    <p class="color-var">--blue-msm-800</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-900);">
                    <h5 class="color-text">Blue MSM 900</h5>
                    <p class="color-hex">#0d3044</p>
                    <p class="color-var">--blue-msm-900</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-950);">
                    <h5 class="color-text">Blue MSM 950</h5>
                    <p class="color-hex">#0a1d2c</p>
                    <p class="color-var">--blue-msm-950</p>
                </div>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Info institucional - pre footer</h2>
                <?php
            set_query_var('info_institucional', [
            'titulo' => 'Información institucional',
            'nombre' => 'Joaquín Miguel Estrada',
            'cargo' => 'Secretario de Educación y Trabajo',
            'telefono' => '03525 - 443776 / 7',
            'email' => 'sme@sanmiguel.gob.ar',
            'foto' => get_template_directory_uri() . '/assets/images/profile-pic.png',
            'mapa_embed' => '<iframe src="https://www.google.com/maps/embed?..."
                            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
            ]);
            get_template_part('templates/parts/info-institucional');
            ?>
    </section>

    <section>
        <h2 class="section-title">Sección de Noticias</h2>
            <!-- NOTICIAS INICIO -->
            <div class="row d-flex justify-content-center">
                <h3 class="text-center mt-3">Últimas novedades</h3>
                <div class="page-content row">
                    <?php get_template_part(THEME_NEWS); ?>
                </div>
            </div>
            <!-- NOTICIAS FIN -->

            <!-- CALL TO ACTION DE 'NOTICIAS' -->
            <div class="d-flex justify-content-center mb-5">
                <!-- <a href="<?php echo HOME_URI; ?>/prensa" class="msm-bg-black btn msm-opacity border-0 text-white mt-3 mb-3 fz-18" style="border-radius: 11px !important">MÁS NOTICIAS</a> -->
                <a href="<?php echo HOME_URI; ?>/prensa" class="btn btn-secondary btn-lg text-decoration-none text-white mt-3 mb-4">VER TODAS LAS NOVEDADES</a>
            </div>
            <!-- CALL TO ACTION DE 'NOTICIAS' FIN -->
        </div>    
    </section>
</div>

<?php get_template_part(THEME_FOOTER); ?>