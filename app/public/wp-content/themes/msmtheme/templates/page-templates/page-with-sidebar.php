<?php get_template_part(THEME_HEADER); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div id="main-content" class="container mb-5">
        <div class="msm-breadcrumb d-block d-sm-row pt-2">
            <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home</a>/
            <a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de gobierno</a>/
            <?php
            
            $terms = get_the_terms(get_the_ID(), 'area_gobierno');
            if ($terms && !is_wp_error($terms)) :
                $term = array_shift($terms);
            ?>
                <a class="msm-breadcrumb-item" href="<?php echo get_term_link($term); ?>">
                    <?php echo esc_html($term->name); ?>
                </a>/
            <?php endif; ?>
            <span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
        </div>

        <div class="col-12 pt-5 pb-4">
            <h2 class="msm-font-xl mb-1 post-title"><?php the_title(); ?></h2>
        </div>

        <div class="row my-3 my-md-5 px-3 justify-content-center">
            <div class="col-12 col-md-9 gap-3">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>

                    <div class="my-3">
                        <?php
                        if (has_post_thumbnail()) {
                            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
                            echo $thumbnail;
                        }
                        ?>
                    </div>
                    <div class="post-content" style="text-align:justify !important;">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>

            <!-- BANNER -->
            <?php
            set_query_var('banner_consultas', [
            'title' => 'Iniciá tus pedidos o consultas',
            'button_text' => 'Iniciar consultas',
            'button_url' => '/consultas',
            'image' => get_template_directory_uri() . '/assets/images/banner_2_blanca.png'
            ]);
            get_template_part('templates/parts/banner-grande');
            ?>
            <!-- BANNER FIN -->

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

    </div>
    <?php endwhile; else : ?>
        <div id="main-content" class="container mb-5">
            <div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
        </div>
    <?php endif; ?>




    <!-- INFORMACION INSTIUCIONAL FOOTER -->
    <div id="main-content" class="container mb-0">
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
    </div>
    <!-- INFORMACION INSTIUCIONAL FOOTER FIN -->

<!-- template page sidebar -->
<?php get_template_part(THEME_FOOTER); ?>