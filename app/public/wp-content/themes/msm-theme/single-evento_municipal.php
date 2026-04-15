<?php get_template_part(THEME_HEADER); ?>

<?php if (have_posts()):
    while (have_posts()):
        the_post(); ?>

        <div id="main-content" class="container mb-5">
            <!-- Breadcrumbs -->
            <div class="msm-breadcrumb d-block d-sm-row pt-1 small mb-4">
                <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
                <a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno /</a>
                <?php
                $term_comunicacion = get_term_by('slug', 'secretaria-de-comunicacion-y-deportes', 'area_gobierno');
                if ($term_comunicacion && !is_wp_error($term_comunicacion)) {
                    echo '<a class="msm-breadcrumb-item" href="' . esc_url(get_term_link($term_comunicacion)) . '"> ' . esc_html($term_comunicacion->name) . ' /</a>';
                }
                ?>
                <a class="msm-breadcrumb-item" href="<?php echo get_post_type_archive_link('evento_municipal'); ?>"> Eventos /</a>
                <span class="msm-breadcrumb-item-last"> <?php the_title(); ?></span>
            </div>

            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <h1 class="post-title mb-3"><?php the_title(); ?></h1>
                        <?php
                        // Event Info Panel (Date, Time, Location, Photo)
                        // Placed after title/excerpt as requested
                        get_template_part('templates/parts/event-info-panel');
                        ?>
                        <!-- <h5 class="post-resume mb-4"><?php the_excerpt(); ?></h5>

                        <div class="post-meta d-flex justify-content-end my-3 border-bottom pb-2">
                            <span class="post-date me-2 msm-text-gray fz-14"><?php the_time('F j, Y'); ?></span>
                        </div> -->

                        <div class="post-content mt-4 px-5 py-2">
                            <?php the_content(); ?>
                        </div>
                    </article>
                </div>
            </div>

            <!-- Related Events Section -->
            <div class="col-12 mt-5 border-top pt-5">
                <?php
                // Configure args for "Ver otros eventos"
                $args = [
                    'post__not_in' => [get_the_ID()], // Exclude current event
                    'posts_per_page' => 4
                ];
                $section_title = 'Agenda';

                // Reuse the Events Section component
                include(get_template_directory() . '/templates/parts/section-eventos-municipales.php');
                ?>
            </div>

        </div>
    <?php endwhile;
else: ?>
    <div id="main-content" class="container mb-5">
        <div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
    </div>
<?php endif; ?>

<!-- single-evento_municipal -->
<?php get_template_part(THEME_FOOTER); ?>