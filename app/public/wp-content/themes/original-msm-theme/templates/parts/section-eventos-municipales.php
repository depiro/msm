<?php
/**
 * Componente: Sección de Eventos Municipales Recientes
 * Ubicación: templates/parts/section-eventos-municipales.php
 * Muestra una fila con los últimos 4 eventos municipales.
 */

$default_args = array(
    'post_type' => 'evento_municipal',
    'posts_per_page' => 4,
    'post_status' => 'publish',
    'orderby' => 'date',
    'order' => 'DESC',
);

// Allow overriding args (e.g. to exclude current post)
$args = isset($args) ? array_merge($default_args, $args) : $default_args;

$events_query = new WP_Query($args);

// Allow overriding title
$section_title = $section_title ?? 'Agenda';

if ($events_query->have_posts()): ?>
    <div class="row mt-5">
        <div class="col-12 mb-3">
            <h3 class="fw-bold text-gradient-msm"><?php echo esc_html($section_title); ?></h3>
        </div>

        <div class="col-12">
            <div class="row">
                <?php
                // Clean up variables from previous scopes (e.g. taxonomy loop)
                unset($title, $link, $thumb_url, $tags);

                while ($events_query->have_posts()):
                    $events_query->the_post(); ?>
                    <?php include get_template_directory() . '/templates/parts/card-event.php'; ?>
                <?php endwhile; ?>
            </div>
        </div>

        <div class="col-12 d-flex justify-content-center">
            <?php
            $hide_cta = $hide_cta ?? false;
            if (!$hide_cta):
                msm_cta_button('Ver todos los eventos', get_post_type_archive_link('evento_municipal'), 'gradient');
            endif;
            ?>
        </div>
    </div>
    <?php wp_reset_postdata(); ?>
<?php endif; ?>