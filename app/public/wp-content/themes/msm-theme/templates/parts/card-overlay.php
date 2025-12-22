<?php
/**
 * Componente: Card Overlay (Imagen de fondo + Caja flotante)
 * Ubicación: templates/parts/card-overlay.php
 * 
 * Variables esperadas:
 * $title     : Título
 * $desc      : Descripción
 * $image_url : URL de la imagen de fondo
 * $link      : Enlace
 * $tags      : Array de tags o string HTML
 * $width     : 'full' | 'half' (Defecto: 'full')
 * $align     : 'left' | 'right' (Defecto: 'left')
 */

$title = $title ?? get_the_title();
$desc = $desc ?? get_the_excerpt();
$image_url = $image_url ?? get_the_post_thumbnail_url(get_the_ID(), 'full');
$link = $link ?? get_permalink();
$width = $width ?? 'full'; // full (col-12) or half (col-md-6)
$align = $align ?? 'left'; // left or right (flex row reverse?)

// Column class based on width
$col_class = ($width === 'half') ? 'col-12 col-md-6' : 'col-12';

// Alignment classes
$justify_class = ($align === 'right') ? 'justify-content-end' : 'justify-content-start';

?>

<div class="<?php echo esc_attr($col_class); ?> mb-4">
    <!-- Wrapper -->
    <div class="card-overlay-wrapper position-relative" style="min-height: 400px; display: flex; align-items: center;">

        <!-- Background Layer (Inset by 32px on the alignment side) -->
        <?php
        // Calculate inset styles based on alignment
        $bg_style = "background-image: url('" . esc_url($image_url) . "'); background-size: cover; background-position: center;";
        $bg_class = "position-absolute top-0 bottom-0 rounded shadow-sm overflow-hidden";

        if ($align === 'right') {
            // Text is Right, Image should be inset from Right (so Text sticks out Right)
            // Image goes from Left:0 to Right:32px
            $pos_style = "left: 0; right: 32px;";
        } else {
            // Text is Left, Image should be inset from Left (so Text sticks out Left)
            // Image goes from Left:32px to Right:0
            $pos_style = "left: 32px; right: 0;";
        }
        ?>
        <div class="<?php echo esc_attr($bg_class); ?>" style="<?php echo $bg_style . $pos_style; ?> z-index: 0;"></div>

        <!-- Content Layer (Full width, handles alignment of the card) -->
        <div class="container-fluid position-relative d-flex <?php echo esc_attr($justify_class); ?> px-0"
            style="z-index: 1;">

            <!-- Overlay Box -->
            <div class="overlay-box bg-white p-4 rounded shadow-sm" style="max-width: 450px; width: 100%;">
                <h3 class="fw-bold mb-3"><?php echo esc_html($title); ?></h3>
                <p class="mb-3 text-secondary"><?php echo wp_trim_words($desc, 20); ?></p>

                <?php if (!empty($tags)): ?>
                    <div class="tags-container mb-0">
                        <?php
                        if (is_array($tags)) {
                            foreach ($tags as $tag) {
                                echo '<span class="badge bg-light text-primary me-2 mb-2 fw-normal text-uppercase" style="font-size: 0.7rem;">' . esc_html($tag) . '</span>';
                            }
                        } else {
                            echo $tags; // Assume HTML passed
                        }
                        ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

    </div>
</div>