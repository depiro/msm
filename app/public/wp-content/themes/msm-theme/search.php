<?php get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
    <div class="col-12 pt-1 small">
        <div class="msm-breadcrumb d-block d-sm-row col-12 col-md-10 col-lg-8">
            <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Buscador</span>
        </div>
    </div>

    <div class="row px-3 justify-content-center">
        <!-- Buscador -->
        <?php
        $titulo_buscador = __('Buscador', 'tu-textdomain');
        include get_template_directory() . '/templates/parts/buscador.php';
        ?>

        <div class="col-12 pb-3">
            <h3 class="text-center">Tu búsqueda: <span class="msm-text-b"><?php echo get_query_var('s') ?> <span></h3>
		</div>
        
        <?php
        global $wpdb;
        $s = get_search_query();
        $args = array(
            's' => esc_html($s),
            'post_type' => array('event', 'post', 'tramite', 'page'),
            'posts_per_page' => -1
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
        ?>
                <div class="col-12 col-md-10 col-lg-8 p-2 mb-2">
                    <div class="card p-3 pb-1">
                        <?php
                        $type = '';
                        $color = '#fff';
                        switch ($post->post_type) {
                            case 'event':
                                $type = 'Evento';
                                $color = '#00B6ED';
                                break;
                            case 'post':
                                $type = 'Noticia';
                                $color = '#00B6ED';
                                break;
                            case 'tramite':
                                $type = 'Tramite';
                                $color = '#00B6ED';
                                break;
                            case 'page':
                                $type = 'Área';
                                $color = '#00B6ED';
                                break;
                            default:
                                $type = '';
                                break;
                        }

                        ?>
                        <?php if ($post->post_type != 'slide' || $post->post_type != 'botonera'): ?>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-text"> <?php the_title(); ?></h4>
                                    <?php if ($type) : ?>
                                        <span style="background-color:<?php echo $color; ?>;height: fit-content !important;" class=" fz-12 text-white px-2 py-1 rounded-1"><?php echo $type ?></span>
                                    <?php endif ?>

                                </div>
                                <div class="card-text"> <?php the_excerpt(); ?></div>
                                <div class="d-flex justify-content-end w-100">
                                    <a href="<?php the_permalink(); ?>" class="w-100 d-flex justify-content-end">
                                        <img src="<?php echo THEME_URI; ?>/assets/images/right-arrow.svg" alt="...">
                                    </a>
                                </div>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            <?php
            }
        } else {
            ?>
            <div class="col-12 col-md-10 col-lg-8 p-2 mb-2 mt-3">
                <h5 class="fz-16 empty-info mt-3 w-100 text-center">
                    No se encontraron resultados para tu búsqueda.
        </h5>
            </div>
        <?php } ?>
    </div>
    <?php
    // Elimina el filtro para no afectar otras consultas
    remove_filter('posts_where', 'search_only_title');
    ?>
</div>

<?php get_template_part('templates/parts/encuesta_utilidad');  ?>
<?php get_template_part(THEME_FOOTER); ?>