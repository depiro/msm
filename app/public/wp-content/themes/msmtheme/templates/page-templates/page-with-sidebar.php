<?php get_template_part(THEME_HEADER); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <div id="main-content" class="container mb-5">
        <div class="msm-breadcrumb d-block d-sm-row pt-1 small">
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
            <h2 post-title"><?php the_title(); ?></h2>
            
            <?php
            $subtitulo = get_post_meta(get_the_ID(), '_msm_subtitulo', true);
            if (!empty($subtitulo)) : ?>
            <p class="msm-subtitle text-muted">
                <?php echo apply_filters('the_content', $subtitulo); ?>
            </p>
            <?php endif; ?>
        </div>

        <!-- <div class="row my-3 my-md-5 px-3 gap-3"> -->
        <div class="row">
            <div class="col-12 col-md-9">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <div class="my-3">
                        <?php
                        if (has_post_thumbnail()) {
                            $thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
                            echo $thumbnail;
                        }
                        ?>
                    </div>
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            </div>

            <div class="col-12 col-md-3">
                <aside class="sidebar-card rounded shadow-sms">
                        <?php
                            $sidebar_info = get_post_meta(get_the_ID(), '_msm_sidebar_info', true);
                            if (!empty($sidebar_info)) : ?>
                            <aside class="sidebar p-3">
                                <?php echo apply_filters('the_content', $sidebar_info); ?>
                            </aside>
                        <?php endif; ?>
                </aside>
            </div> 
        </div>
        
        <div class="row">
            <div class="col-12 pt-5 pb-4">
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


                <?php get_template_part('templates/sections/home_news_category'); ?>

                
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
                    <a href="<?php echo HOME_URI; ?>/prensa" class="btn btn-secondary btn-lg text-decoration-none text-white mt-3 mb-4">VER TODAS LAS NOVEDADES</a>
                </div>
                <!-- CALL TO ACTION DE 'NOTICIAS' FIN -->
            </div>
        </div>
    </div>
  
            <?php endwhile; else : ?>
        <div id="main-content" class="container mb-5">
            <div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
        </div>
    <?php endif; ?>

<!-- template page sidebar -->
<?php get_template_part(THEME_FOOTER); ?>