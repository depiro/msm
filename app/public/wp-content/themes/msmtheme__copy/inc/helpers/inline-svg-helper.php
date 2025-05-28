<?php
/**
 * Utilidad global para insertar SVGs inline desde /assets/images/icons/
 * Uso: <?php inline_svg('nombre-del-icono'); ?>
 */

if (!function_exists('inline_svg')) {
  function inline_svg($slug) {
    $slug = sanitize_file_name($slug);
    $path = get_theme_file_path('/assets/images/icons/' . $slug . '.svg');

    if (file_exists($path)) {
      readfile($path);
    } else {
      echo '<!-- SVG not found: ' . esc_html($slug) . ' -->';
    }
  }
}
