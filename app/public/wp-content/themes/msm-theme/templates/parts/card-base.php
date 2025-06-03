<?php
/**
 * Componente: Card Genérica
 * Ubicación: templates/parts/components/card-generica.php
 * Variantes controladas por clases:
 * - .card-v1: Título solo y barra celeste fina
 * - .card-v2: Título + descripción + link + barra fina
 * - .card-v3: Título + descripción + barra ancha + icono
 * - .card-v4: Título + barra ancha de color + icono
 */

// Compatibilidad con términos de taxonomía
if (isset($term) && $term instanceof WP_Term) {
  $title = $title ?? $term->name;
  $desc  = $desc ?? (!empty($term->description) ? wp_trim_words($term->description, 20, '...') : '');
  $link  = $link ?? get_term_link($term);
  $color = $color ?? get_term_meta($term->term_id, 'color_hex', true);
  $icon_id = get_term_meta($term->term_id, 'imagen_id', true);
  $icon_url = wp_get_attachment_url($icon_id);

  
  $icon = ($icon_url) 
  ? '<img src="' . esc_url($icon_url) . '" alt="' . esc_attr($title) . '" width="57" height="57" style="object-fit: contain;" />'
  : '';

} else {
  // Para posts normales
  $title = $title ?? get_the_title();
  $desc  = $desc ?? wp_trim_words(get_the_excerpt(), 20, '...');
  $link  = $link ?? get_permalink();
}
?>

<div class="col-12 col-md-12 col-lg-6 col-xl-4">
  <a href="<?php echo esc_url($link); ?>" class="text-decoration-none  card-v<?= esc_attr($variant); ?>">

    <div class="card d-flex overflow-hidden flex-row align-items-stretch <?php echo in_array($variant, [3, 4]) ? 'flex-row' : ''; ?>"
     style="<?php echo isset($height) ? 'min-height:' . esc_attr($height) . ';' : ''; ?>">

      <?php if (in_array($variant, [3, 4])) : ?>
        <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: <?php echo esc_attr($color ?? '#3dbfee'); ?>;">
          <?php echo $icon; ?>
        </div>
      <?php elseif (in_array($variant, [1, 2])) : ?>
        <div class="card-barra"></div>
      <?php endif; ?>

      <div class="card-body p-4 pe-2 d-flex flex-column justify-content-center">
        <h6 class="card-title"><?= esc_html($title); ?></h6>

        <?php if (in_array($variant, [2, 3])) : ?>
          <p class="card-text fz-14 mb-0"><?= esc_html($desc); ?></p>
        <?php endif; ?>

        <?php if ($variant === 2) : ?>
          <span class="card-link text-primary mt-2 d-inline-block">Ver más</span>
        <?php endif; ?>
      </div>

    </div>
  </a>
</div>
