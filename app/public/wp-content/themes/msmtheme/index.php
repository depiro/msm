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
    <div class="row d-flex justify-content-center">
        <h3 class="text-enter">¡Conocé todos los programas y servicios que tenemos para vos!</h3>
        <?php get_template_part('templates/parts/accesos-programas'); ?>
    </div>
    <!-- ACCESOS DIRECTOS FIN -->


    <!-- NOTICIAS INICIO -->
    <div class="row d-flex justify-content-center">
        <?php get_template_part(THEME_NEWS); ?>
    </div>
    <!-- NOTICIAS FIN -->

    <div class="d-flex justify-content-center mb-5">
        <a href="<?php echo HOME_URI; ?>/prensa" class="msm-bg-black btn msm-opacity border-0 text-white mt-3 mb-3 fz-18" style="border-radius: 11px !important">MÁS NOTICIAS</a>
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