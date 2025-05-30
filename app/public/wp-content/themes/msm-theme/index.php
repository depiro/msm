<?php get_template_part(THEME_HEADER);  ?>

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

<div id="main-content" class="row d-flex w-100 justify-content-center container m-auto home-content">
    <!-- BOTONERA INICIO -->
    <div class="row justify-content-between d-flex">
        <?php get_template_part(THEME_BOTONERA); ?>
    </div>
    <!-- BOTONERA FIN -->


    <!-- PROGRAMAS Y SERVICIOS -->
    <section class="home-programas row d-flex justify-content-center">
        <h3 class="text-center">¡Conocé todos los programas y servicios que tenemos para vos!</h3>

        <?php
$terms = get_terms(array(
    'taxonomy' => 'area_programa',
    'hide_empty' => false,
));

if (!empty($terms) && !is_wp_error($terms)) {

    // Ordenar los términos por el campo 'prioridad'
    usort($terms, function($a, $b) {
        $prioridad_a = intval(get_term_meta($a->term_id, 'prioridad', true) ?: 999);
        $prioridad_b = intval(get_term_meta($b->term_id, 'prioridad', true) ?: 999);
        return $prioridad_a - $prioridad_b; // menor número va antes
    });

    echo '<div class="row g-3">';

    foreach ($terms as $term) :
        $title = esc_html($term->name);
        $link = esc_url(get_term_link($term));
        $icono = get_term_meta($term->term_id, 'icono_svg', true);
        $color = get_term_meta($term->term_id, 'color_hex', true);
        $variant = 4;
        $height = '80px';

        include get_template_directory() . '/templates/parts/card-base.php';

    endforeach;

    echo '</div>';

} else {
    echo '<p class="text-muted">Actualmente no hay programas disponibles.</p>';
}
?>

     
    </section>
    <!-- PROGRAMAS Y SERVICIOS FIN -->


    <!-- BANNERS INFORMATIVOS -->
    <section class="home-banners row d-flex justify-content-center">
        <h3 class="text-center">¡Sumate!</h3>
        
        <div class="row gy-3 p-0">
        <?php
        set_query_var('banners_home', [
            [
            'url' => '/debito-automatico',
            'icon' => 'facturas.svg',
            'title' => '¡Adherite al débito automático!',
            'text' => 'Y ganá tranquilidad todos los meses',
            'style' => 'bg-white'
            ],
            [
            'url' => '/vacunacion',
            'icon' => 'vacunas.svg',
            'title' => 'Poné las <strong>VACUNAS AL DÍA</strong>',
            'text' => 'Completá el calendario de vacunación',
            'style' => 'bg-white',
            'icon_right' => true
            ],
        ]);
  
            get_template_part('templates/parts/banners-home');
        ?>
        </div>
    </section>
    <!-- BANNERS INFORMATIVOS FIN  -->




    <?php
// Test de SVG inline desde uploads

$svg_url_de_prueba = 'http://msm-dev.local/wp-content/uploads/2025/05/licencia-1.svg'; // reemplazá esta URL por una real que tengas cargada

?>

<div class="icon-svg-test" style="padding: 2rem; background: #f8f8f8; border: 1px solid #ccc;">
    <h3>Test de SVG inline desde URL</h3>
    <p><strong>Intentando renderizar:</strong> <?php echo esc_url($svg_url_de_prueba); ?></p>

    <?php
    if (function_exists('render_inline_svg_from_url')) {
        render_inline_svg_from_url($svg_url_de_prueba);
    } else {
        echo '<p style="color:red;">⚠️ La función <code>render_inline_svg_from_url()</code> no está disponible.</p>';
    }
    ?>
</div>


    
    <!-- AREAS DE GOBIERNO -->
    <section class="home-areas row d-flex justify-content-center ">
        <h3 class="text-center">Áreas de Gobierno</h3>
        
        <div class="row">
        <?php
$terms = get_terms(array(
    'taxonomy'   => 'area_gobierno',
    'hide_empty' => false,
));

if (!empty($terms) && !is_wp_error($terms)) :
    // Ordenar por campo 'order'
    usort($terms, function ($a, $b) {
        $order_a = (int) get_term_meta($a->term_id, 'order', true);
        $order_b = (int) get_term_meta($b->term_id, 'order', true);
        return $order_a <=> $order_b;
    });

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
    </section>
    <!-- AREAS DE GOBIERNO FIN -->


    <!-- NOTICIAS INICIO -->
    <section class="home-noticias row d-flex justify-content-center">
        <h3 class="text-center">Últimas novedades</h3>
        <div class="row">
            <?php get_template_part(THEME_NEWS); ?>
        </div>
    </section>
    <!-- NOTICIAS FIN -->

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