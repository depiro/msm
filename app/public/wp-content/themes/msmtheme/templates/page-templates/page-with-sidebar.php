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
	<!-- 		<h2 class="msm-font-xl mb-1">Áreas de gobierno</h2>
			    <p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel</p> -->
		    </div>

            <div class="row my-3 my-md-5 px-3 justify-content-center">
                <div class="col-12 col-md-9 gap-3">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<!--                         <div class="d-flex justify-content-between col-12 py-5">
                            <h2 class="msm-font-xl mb-1 post-title"><?php the_title(); ?></h2>
                        </div> -->

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
                <div class="col-12 col-md-3 gap-3">
                    <?php
                    // Obtener el término de taxonomía asociado con el post actual
                    $terms = get_the_terms(get_the_ID(), 'area_gobierno');
                    if ($terms && !is_wp_error($terms)) {
                        $term = $terms[0]; // Suponiendo que hay al menos un término
                        $term_slug = $term->slug;

                        // Consulta para obtener otras páginas en la misma área
                        $args = array(
                            'post_type' => 'page',
                            'posts_per_page' => 10, // Número de posts a mostrar
                            'post__not_in' => array(get_the_ID()), // Excluir el post actual
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'area_gobierno',
                                    'field'    => 'slug',
                                    'terms'    => $term_slug,
                                ),
                            ),
                            'orderby' => 'title',
                            'order'   => 'ASC',
                        );

                        $related_query = new WP_Query($args);

                        if ($related_query->have_posts()) : ?>
                        
                            <div class="menuCul">
                                <h5 class="py-2"><?php echo esc_html($term->name); ?></h5>
                                <ul class="msm-submenu">
                                    <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                    <?php if(get_the_title() == 'Reclamos') continue; ?>
                                        <li class="cat-item">
                                            <a href="<?php the_permalink() ?>" style="font-size: 16px;">
                                                <?php the_title(); ?>
                                            </a>
                                        </li>
                                    <?php endwhile; ?>
                                </ul>
                            </div>
                    <?php endif;

                        // Restablecer post data
                        wp_reset_postdata();
                    }
                    ?>
            </div>
            </div>

        </div>
    <?php endwhile;
else : ?>
    <div id="main-content" class="container mb-5">
        <div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
    </div>
<?php endif; ?>

<!-- template page sidebar -->
<?php get_template_part(THEME_FOOTER); ?>