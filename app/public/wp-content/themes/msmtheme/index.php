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
        <?php get_template_part('templates/parts/accesos-programas'); ?>
    </div>
    <!-- ACCESOS DIRECTOS FIN -->


    <?php
set_query_var('banners_home', [
  [
    'url' => '/debito-automatico',
    'icon' => 'debito.svg',
    'title' => '¡Adherite al débito automático!',
    'text'  => 'y ganá tranquilidad todos los meses',
    'style' => 'bg-white shadow-sm'
  ],
  [
    'url' => '/vacunacion',
    'icon' => 'vacunas.svg',
    'title' => 'Poné las <strong>VACUNAS AL DÍA</strong>',
    'text'  => 'completá el calendario de vacunación',
    'style' => 'border border-primary'
  ]
]);
get_template_part('templates/parts/banners-home');
?>


<!-- BANNERS INFORMATIVOS -->
<div class="row d-flex justify-content-center px-3  mb-4">
<h3 class="text-center mb-0">¡Sumate!</h3>
    <div class="row gy-3">
    <!-- Banner 1: Débito automático -->
    <div class="col-12 col-md-6">
        <a href="#" class="d-flex align-items-center justify-content-between py-5 px-4 rounded-3 shadow text-decoration-none banner-card bg-white">
        <div class="d-flex align-items-center gap-5">
            <!-- Ícono SVG inline -->
            <div class="icon-svg">
                <!-- SVG de ejemplo: documento con dólar -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M8 3h7a2 2 0 0 1 2 2v2h-2V5H8v14h7v-2h2v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm8.293 9.707L18 12l-1.293-1.293a1 1 0 0 0-1.414 1.414L16.586 12l-1.293 1.293a1 1 0 0 0 1.414 1.414z"/>
                </svg>
            </div>
            <!-- Contenido -->
            <div>
            <div class="fw-bold text-dark">¡Adherite al débito automático!</div>
            <div class="text-secondary small">y ganá tranquilidad todos los meses</div>
            </div>
        </div>
        </a>
    </div>

    <!-- Banner 2: Vacunas -->

    <div class="col-12 col-md-6">
        <a href="#" class="d-flex align-items-center justify-content-between py-5 px-4 rounded-3 banner-card shadow text-decoration-none">
        <div class="d-flex align-items-center gap-3">
            <!-- Ícono SVG inline -->
            <div class="icon-svg">
            <!-- SVG de ejemplo: jeringa -->
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                <path d="M19.778 4.222a1 1 0 0 0-1.414 0l-2.585 2.585-.586-.585-1.414 1.414.586.586-5.379 5.379a3 3 0 0 0-.683 3.168l-3.471 3.471a1 1 0 1 0 1.414 1.414l3.471-3.471a3 3 0 0 0 3.168-.683l5.379-5.379.586.586 1.414-1.414-.586-.586 2.585-2.585a1 1 0 0 0 0-1.414l-1-1z"/>
            </svg>
            </div>
            <!-- Contenido -->
            <div>
            <div class="fw-bold text-dark">Poné las <span class="fw-bolder">VACUNAS AL DÍA</span></div>
            <div class="text-secondary small">completá el calendario de vacunación</div>
            </div>
        </div>
        </a>
    </div>
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

    <div class="d-flex justify-content-center mb-5">
        <!-- <a href="<?php echo HOME_URI; ?>/prensa" class="msm-bg-black btn msm-opacity border-0 text-white mt-3 mb-3 fz-18" style="border-radius: 11px !important">MÁS NOTICIAS</a> -->
        <a href="<?php echo HOME_URI; ?>/prensa" class="btn btn-secondary btn-lg text-decoration-none text-white mt-3 mb-4">Más noticias</a>
    </div>
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