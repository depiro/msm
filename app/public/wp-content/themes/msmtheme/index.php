<?php get_template_part(THEME_HEADER); ?>

<!-- Topbar avisos -->
<?php msm_render_home_alert(); ?>

<!-- Buscador -->
<?php get_template_part('templates/parts/buscador'); ?>


<!-- HOME SLIDE INICIO -->
<?php
$args = array(
    'post_type'         => 'slide',
    'orderby'           => 'date',
    'order'             => 'DESC',
    'posts_per_page'    => 4
);

$query = new WP_Query($args);
?>
<div id="home-slide" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            $index = 0;
            while ($query->have_posts()) :
                $query->the_post();
                $texto_breve = get_post_meta(get_the_ID(), '_texto_breve', true);

                $enlace = get_post_meta(get_the_ID(), '_enlace', true);
                $imagen_id = get_post_meta($post->ID, '_imagen_id', true);
                $imagen_url = wp_get_attachment_url($imagen_id);
        ?>
                <?php if ($imagen_url) : ?>
                    <a href="<?php echo esc_url($enlace); ?>" class="carousel-item <?php echo $index == 0 ? 'active' : ''; ?>">

                        <img class="d-block w-100" src="<?php echo esc_url($imagen_url) ?>" alt="<?php echo esc_attr(get_the_title()) ?>" style="max-width: 100%;" />
                    </a>
                <?php endif ?>
            <?php $index++;
            endwhile; ?>
        <?php endif; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#home-slide" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#home-slide" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<!-- HOME SLIDE FIN -->

<div id="main-content" class="row d-flex w-100 justify-content-center container m-auto">
    <!-- BOTONERA INICIO -->
    <div class="row justify-content-between d-flex">
        <?php get_template_part(THEME_BOTONERA); ?>
    </div>
    <!-- BOTONERA FIN -->

    <!-- ACCESOS DIRECTOS -->
    <div class="row d-flex justify-content-center mb-4 mt-5">
        <h3 class="text-center mt-3">¡Conocé todos los programas y servicios que tenemos para vos!</h3>

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


    </div>
    <!-- ACCESOS DIRECTOS FIN -->



    <!-- BANNERS INFORMATIVOS -->
    <div class="row d-flex justify-content-center px-3 mb-4">
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
    <!-- BANNERS INFORMATIVOS FIN  -->

    <!-- AREAS DE GOBIERNO -->
    <div class="row d-flex justify-content-center">
        <h3 class="text-center mt-3 mb-4">Áreas de gobierno</h3>
        <div class="page-content row">
            <?php
            set_query_var('mostrar_descripcion', false);
            get_template_part('templates/parts/areas-cards');
            ?>
		</div>
    </div>
    <!-- AREAS DE GOBIERNO FIN -->

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
        <a href="<?php echo HOME_URI; ?>/prensa" class="btn btn-secondary btn-lg text-decoration-none text-white mt-3 mb-4">Más noticias</a>
    </div>
    <!-- CALL TO ACTION DE 'NOTICIAS' FIN -->
</div>

<?php get_template_part(THEME_FOOTER); ?>
<!-- index -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Encuentra el elemento del carousel
        var carouselElement = document.querySelector('#home-slide')

        // Inicializa el carousel usando el método Carousel de Bootstrap
        var carousel = new bootstrap.Carousel(carouselElement, {
            interval: 5000,
            wrap: true,
            pause: false
        });

        carouselElement.querySelector('.carousel-control-prev').addEventListener('click', function() {
            carousel.prev();
        });

        carouselElement.querySelector('.carousel-control-next').addEventListener('click', function() {
            carousel.next();
        });
    });
</script>