<?php
/**
 * Componente: Card Evento Municipal
 * Ubicación: templates/parts/card-event.php
 * Descripción: Card vertical con foto, título y tags (pills).
 */

$title = $title ?? get_the_title();
$link = $link ?? get_permalink();
$thumb_url = $thumb_url ?? get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
$tags = $tags ?? get_the_tags();
?>

<div class="col-12 col-md-6 col-lg-3 mb-4">
    <a href="<?php echo esc_url($link); ?>" class="text-decoration-none text-dark">
        <div class="card h-100 border-0 shadow-sm rounded overflow-hidden">

            <?php if ($thumb_url): ?>
                <div class="card-img-top position-relative"
                    style="height: 200px; overflow: hidden; background-color: #f0f0f0;">
                    <img src="<?php echo esc_url($thumb_url); ?>" alt="<?php echo esc_attr($title); ?>" class="w-100 h-100"
                        style="object-fit: cover;">
                </div>
            <?php else: ?>
                <!-- Placeholder si no hay imagen -->
                <div class="card-img-top d-flex align-items-center justify-content-center bg-light text-secondary"
                    style="height: 200px;">
                    <span class="dashicons dashicons-format-image"
                        style="font-size: 40px; width: 40px; height: 40px;"></span>
                </div>
            <?php endif; ?>

            <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bolder mb-3"><?php echo esc_html($title); ?></h5>

                <div class="mt-auto">
                    <?php if ($tags): ?>
                        <div class="d-flex flex-wrap gap-2">
                            <?php foreach ($tags as $tag): ?>
                                <span class="badge rounded-pill bg-light text-primary fw-normal border px-3 py-2">
                                    <?php echo esc_html(strtoupper($tag->name)); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </a>

</div>
<?php
// Clean up variables to prevent scope pollution
unset($title, $link, $thumb_url, $tags);
?>