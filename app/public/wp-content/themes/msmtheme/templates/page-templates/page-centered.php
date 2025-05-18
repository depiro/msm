<?php get_template_part(THEME_HEADER); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div id="main-content" class="container mb-5">
            <div class="row my-3 my-md-5 px-3 justify-content-center">
                <div class="col-12 col-md-11 col-lg-10">
                    <div class="msm-breadcrumb d-block d-sm-row">
                        <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
                        <a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de gobierno /</a>
                        <?php
                        // Obtener el área del trámite
                        $terms = get_the_terms(get_the_ID(), 'area_gobierno');
                        if ($terms && !is_wp_error($terms)) :
                            $term = array_shift($terms);
                        ?>
                            <a class="msm-breadcrumb-item px-0" href="<?php echo get_term_link($term); ?>">
                                <?php echo esc_html($term->name); ?> /
                            </a>
                        <?php endif; ?>
                        <span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
                    </div>
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <div class="row d-flex justify-content-between">
                            <span class="post-title"><?php the_title(); ?></span>
                        </div>
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
                        <!-- <div class="post-meta d-flex justify-content-end my-3">
                            <span class="post-date me-2 msm-text-gray"><?php the_time('F j, Y'); ?></span>
                            <span class="post-author msm-text-gray"> por <?php the_author(); ?></span>
                        </div> -->
                    </article>
                </div>
            </div>
        </div>
    <?php endwhile;
else : ?>
    <div id="main-content" class="container mb-5">
        <div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
    </div>
<?php endif; ?>

<!-- template page centered -->
<?php get_template_part(THEME_FOOTER); ?>