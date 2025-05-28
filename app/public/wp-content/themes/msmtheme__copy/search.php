<?php get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
    <div class="col-12 pt-2">
        <div class="msm-breadcrumb d-block d-sm-row col-12 col-md-10 col-lg-8">
                <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Buscador</span>
        </div>
    </div>

    <div class="row my-3 my-md-5 px-3 justify-content-center">
        <div class="col-12 py-5">
            <h2 class="msm-font-xl mb-1">Resultados para:</h2>			
            <p class="fz-24"><?php echo get_query_var('s') ?></p>
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
                    <div class="card">
                        <?php
                        $type = '';
                        $color = '#fff';
                        switch ($post->post_type) {
                            case 'event':
                                $type = 'Evento';
                                $color = '#7cc3c3';
                                break;
                            case 'post':
                                $type = 'Noticia';
                                $color = '#8dc37c';
                                break;
                            case 'tramite':
                                $type = 'Tramite';
                                $color = '#1ab3ea';
                                break;
                            case 'page':
                                $type = 'Área';
                                $color = '#476c79';
                                break;
                            default:
                                $type = '';
                                break;
                        }

                        ?>
                        <?php if ($post->post_type != 'slide' || $post->post_type != 'botonera'): ?>
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <p class="card-text msm-text-700 fw-600 fz-20"> <?php the_title(); ?></p>
                                    <?php if ($type) : ?>
                                        <span style="background-color:<?php echo $color; ?>;height: fit-content !important;" class="text-white px-2 py-1 rounded"><?php echo $type ?></span>
                                    <?php endif ?>
                                </div>
                                <div class="card-text msm-text-gray fw-400"> <?php the_excerpt(); ?></div>
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
                <span class="fz-16 empty-info mt-3 w-100">
                    No se encontraron resultados
                </span>
            </div>
        <?php } ?>
    </div>
    <?php
    // Elimina el filtro para no afectar otras consultas
    remove_filter('posts_where', 'search_only_title');
    ?>
</div>


<?php get_template_part(THEME_FOOTER); ?>