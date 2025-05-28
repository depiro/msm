<?php get_template_part(THEME_HEADER); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="main-content" class="container mb-5">
            <div class="row my-3 my-md-5 px-3 justify-content-center">
                <?php
                // Obtenemos el post_meta donde meta_key es '_wp_page_template'
                $template = get_post_meta(get_the_ID(), '_wp_page_template', true);

                // Definir la ruta de la plantilla
                if ($template && file_exists(get_template_directory() . '/templates/page-templates/' . $template)) {
                    include(get_template_directory() . '/templates/page-templates/' . $template);
                } else {
                    // Cargar la plantilla predeterminada si no hay una plantilla personalizada
                    include(get_template_directory() . '/templates/defaults/page-default.php');
                }
                ?>
            </div>
        </div>
    <?php endwhile;
else : ?>
    <div id="main-content" class="container mb-5">
        <p><?php _e('No se encontró la publicación.', 'mi-tema'); ?></p>
    </div>
<?php endif; ?>

<!-- Page -->
<?php get_template_part(THEME_FOOTER); ?>