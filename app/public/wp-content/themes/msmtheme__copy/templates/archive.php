<?php get_header(); ?>

<div id="main-content">
    <h1>
        <?php
        if (is_category()) {
            single_cat_title(__('Archivos de la categoría: ', 'mi-tema'));
        } elseif (is_tag()) {
            single_tag_title(__('Archivos de la etiqueta: ', 'mi-tema'));
        } elseif (is_author()) {
            the_post();
            echo __('Artículos de: ', 'mi-tema') . get_the_author();
            rewind_posts();
        } elseif (is_day()) {
            echo __('Archivos del día: ', 'mi-tema') . get_the_date();
        } elseif (is_month()) {
            echo __('Archivos del mes: ', 'mi-tema') . get_the_date('F Y');
        } elseif (is_year()) {
            echo __('Archivos del año: ', 'mi-tema') . get_the_date('Y');
        } else {
            echo __('Archivos', 'mi-tema');
        }
        ?>
    </h1>

    <?php if (have_posts()) : ?>
        <div class="post-list">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <h2 class="post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <div class="post-meta">
                        <span class="post-date"><?php the_time('F j, Y'); ?></span>
                        <span class="post-author"> por <?php the_author(); ?></span>
                    </div>
                    <div class="post-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('« Anterior', 'mi-tema'),
                'next_text' => __('Siguiente »', 'mi-tema'),
            ));
            ?>
        </div>

    <?php else : ?>
        <p><?php _e('No hay publicaciones disponibles en este archivo.', 'mi-tema'); ?></p>
    <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
