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

        <?php
            $terms = get_terms(array(
            'taxonomy' => 'area_programa',
            'hide_empty' => false,
            ));

            if (!empty($terms) && !is_wp_error($terms)) :
            echo '<div class="row g-3">';

            foreach ($terms as $term) :
                $title = esc_html($term->name);
                $link = esc_url(get_term_link($term));
                $icono = get_term_meta($term->term_id, 'icono_svg', true);
                $color = get_term_meta($term->term_id, 'color_hex', true);
                $variant = 4;
                $height = '80px'; // podés ajustar este valor

                include get_template_directory() . '/templates/parts/card-base.php';

            endforeach;

            echo '</div>';
            else :
            echo '<p class="text-muted">Actualmente no hay programas disponibles.</p>';
            endif;
        ?>
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
            <!-- <?php
            set_query_var('mostrar_descripcion', false);

            
            get_template_part('templates/parts/areas-cards');
            ?> -->


            <!-- <?php while (have_posts()): the_post(); ?>
                <?php
                    $height = '90px';
                    $variant = 1;
                    $title = get_the_title();

                    include get_template_directory() . '/templates/parts/card-base.php';
                ?>
			<?php endwhile; ?> -->

            <?php
$terms = get_terms(array(
    'taxonomy'   => 'area_gobierno',
    'hide_empty' => false,
));

if (!empty($terms) && !is_wp_error($terms)) :
    foreach ($terms as $term) :
        $variant = 1;
        $title   = $term->name;
        $link    = get_term_link($term);
        $height  = '90px';

        include get_template_directory() . '/templates/parts/card-base.php';
    endforeach;
endif;
?>

		</div>
    </div>
    <!-- AREAS DE GOBIERNO FIN -->

    <!-- NOTICIAS INICIO -->
    <div class="row d-flex justify-content-center">
        <h3 class="text-center mt-3 mb-3">Últimas novedades</h3>
        <div class="row">
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