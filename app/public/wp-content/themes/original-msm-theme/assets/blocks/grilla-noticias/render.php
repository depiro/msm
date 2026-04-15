<?php
/**
 * Render Callback for 'Grilla de Noticias' Block
 *
 * @param array $attributes Block attributes.
 */

$block_title = isset($attributes['blockTitle']) ? $attributes['blockTitle'] : '';
$selected_posts = isset($attributes['selectedPosts']) ? $attributes['selectedPosts'] : [];

// If no posts selected, don't render anything (per requirements, though title check exists)
// Requirement: "Si no hay posts seleccionados: No se renderiza la grilla. Solo se muestra el título si existe"
if (empty($selected_posts) && empty($block_title)) {
    return;
}

$wrapper_attributes = get_block_wrapper_attributes(array(
    'class' => 'msm-grilla-noticias py-4',
));

?>
<div <?php echo $wrapper_attributes; ?>>
    <div class="container">
        <?php if (!empty($block_title)): ?>
            <div class="row mb-4">
                <div class="col-12">
                    <h3 class="fw-bold text-gradient-msm"><?php echo esc_html($block_title); ?></h3>
                </div>
            </div>
        <?php endif; ?>

        <?php if (!empty($selected_posts)): ?>
            <div class="row g-4 g-lg-5"> <!-- Generous spacing (gutter) -->
                <?php foreach ($selected_posts as $post_obj):
                    // $post_obj is the array {id, title} from JSON attributes.
                    $post_id = $post_obj['id'];
                    $post = get_post($post_id);

                    if (!$post)
                        continue; // Skip if post deleted
            
                    // Setup standard WordPress post data for template tags
                    setup_postdata($post);

                    $title = get_the_title($post);
                    $link = get_permalink($post);
                    // Custom excerpt logic: Excerpt -> Content Trim
                    $excerpt = get_the_excerpt($post);
                    if (empty($excerpt)) {
                        $excerpt = wp_trim_words(get_the_content(null, false, $post), 30, '...');
                    }
                    ?>

                    <div class="col-12 col-md-6">
                        <a href="<?php echo esc_url($link); ?>"
                            class="text-decoration-none text-dark d-block h-100 msm-grilla-item">
                            <article>
                                <h3 class="fw-bold mb-2 h5"><?php echo esc_html($title); ?></h3>
                                <div class="text-secondary opacity-75 fw-light" style="font-size: 0.95rem; line-height: 1.6;">
                                    <?php echo wp_kses_post($excerpt); ?>
                                </div>
                            </article>
                        </a>
                    </div>

                <?php endforeach;
                wp_reset_postdata(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>