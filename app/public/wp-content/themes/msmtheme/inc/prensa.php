<?php
function add_prensa_prefix($post_link, $id = 0)
{
    $post = get_post($id);
    if ($post->post_type === 'post') {
        return str_replace('/' . $post->post_name, '/prensa/' . $post->post_name, $post_link);
    }
    return $post_link;
}
add_filter('post_link', 'add_prensa_prefix', 10, 2);

function add_prensa_rewrite_rule()
{
    // Regla para los posts individuales bajo /prensa/
    add_rewrite_rule('^prensa/([^/]+)/?$', 'index.php?name=$matches[1]', 'top');
    
    // Regla para la paginación con ?pagina=2, ?pagina=3, etc.
    add_rewrite_rule('^prensa/?pagina=([0-9]+)/?$', 'index.php?post_type=post&paged=$matches[1]', 'top');
}
add_action('init', 'add_prensa_rewrite_rule');
