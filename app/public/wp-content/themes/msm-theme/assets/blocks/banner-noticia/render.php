<?php
/**
 * Render Callback for Banner de Noticia Block
 */

if (!isset($attributes['postId']) || empty($attributes['postId'])) {
    return;
}

$post_id = intval($attributes['postId']);
$post_object = get_post($post_id);

if (!$post_object || $post_object->post_type !== 'noticias-banner' || $post_object->post_status !== 'publish') {
    if (is_user_logged_in()) {
        echo '<div class="alert alert-warning">Noticia no encontrada o no publicada (ID: ' . esc_html($post_id) . ')</div>';
    }
    return;
}

// Prepare data for template
$title = get_the_title($post_id);
$desc = get_the_excerpt($post_id);

// If no excerpt, trim content
if (empty($desc)) {
    $desc = wp_trim_words($post_object->post_content, 20);
}

$image_url = get_the_post_thumbnail_url($post_id, 'full');
$link = get_permalink($post_id);

// Tags
$tags_list = get_the_terms($post_id, 'post_tag');
$tags = [];
if ($tags_list && !is_wp_error($tags_list)) {
    foreach ($tags_list as $tag) {
        $tags[] = $tag->name;
    }
}

// Attributes
$width = isset($attributes['width']) ? $attributes['width'] : 'full';
$align = isset($attributes['align']) ? $attributes['align'] : 'left';

// Reuse existing template
// We need to set variables that the template expects.
// Ideally, we include the template, but variables scope needs to be managed.
// The template uses extract() or expects variables in current scope? 
// Checking card-overlay.php: It checks $title ?? get_the_title(), etc.
// So we can set variables before including.

include locate_template('templates/parts/card-overlay.php');
