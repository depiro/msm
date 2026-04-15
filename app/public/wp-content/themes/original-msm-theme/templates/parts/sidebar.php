<aside class="sidebar">
    <h2><?php _e('Barra Lateral', 'mi-tema'); ?></h2>
    <ul>
        <li><a href="<?php echo home_url(); ?>"><?php _e('Inicio', 'mi-tema'); ?></a></li>
        <li><a href="<?php echo get_permalink(get_option('page_for_posts')); ?>"><?php _e('Blog', 'mi-tema'); ?></a></li>
        <li><a href="<?php echo home_url('/contacto'); ?>"><?php _e('Contacto', 'mi-tema'); ?></a></li>
    </ul>
    <div class="widget">
        <h3><?php _e('Buscar', 'mi-tema'); ?></h3>
        <?php get_search_form(); ?>
    </div>
</aside>
