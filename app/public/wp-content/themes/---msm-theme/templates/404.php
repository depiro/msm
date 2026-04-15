<?php get_header(); ?>

<div id="main-content">
    <h1><?php _e('Página no encontrada', 'mi-tema'); ?></h1>
    <p><?php _e('Lo sentimos, pero la página que estás buscando no existe. Intenta buscar otra cosa.', 'mi-tema'); ?></p>
    <?php get_search_form(); ?>
    <h2><?php _e('O explora algunos de nuestros últimos artículos:', 'mi-tema'); ?></h2>
    <ul>
        <?php
        $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
        foreach ($recent_posts as $post) : ?>
            <li><a href="<?php echo get_permalink($post['ID']); ?>"><?php echo $post['post_title']; ?></a></li>
        <?php endforeach; ?>
    </ul>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
