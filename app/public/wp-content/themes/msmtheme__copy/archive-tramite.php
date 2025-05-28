<?php get_template_part(THEME_HEADER); ?>
<div id="main-content" class="container mb-5">
  <div class="msm-breadcrumb d-block d-sm-row pt-1 small">
    <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Guía de Trámites</span>
  </div>

  <div class="row my-2 justify-content-center">
    <div class="col-12 py-5">
      <h2 class="msm-font-xl mb-1">Trámites</h2>
      <p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel.</p>
    </div>

    <div class="row">
      <?php
      $terms = get_terms(array(
        'taxonomy' => 'area_tramite',
        'hide_empty' => false,
      ));

      if (!empty($terms) && !is_wp_error($terms)) :
        foreach ($terms as $term) :
          $imagen_id = get_term_meta($term->term_id, 'imagen_id', true);
          $imagen_url = wp_get_attachment_url($imagen_id);

          $title = esc_html($term->name);
          $desc = !empty($term->description) ? wp_trim_words($term->description, 20, '...') : '';

          $link = get_term_link($term);
          $icon = '';

          if ($imagen_url) {
            $icon = '<img src="' . esc_url($imagen_url) . '" alt="' . esc_attr($term->name) . '" width="60">';
          } else {
            $icon = '<img src="' . esc_url(get_template_directory_uri() . '/assets/images/icons/multas.svg') . '" alt="' . esc_attr($term->name) . '" width="60">';
          }

          $variant = 3;
          $height = '140px';

          include get_template_directory() . '/templates/parts/card-base.php';
        endforeach;
      else: ?>
        <span class="fz-24 empty-info mt-3">
          Actualmente no hay áreas de trámites disponibles en esta sección. Por favor, revisa más tarde o contacta con nuestra oficina para obtener información adicional sobre los trámites disponibles.
        </span>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
