<?php
$mostrar_descripcion = get_query_var('mostrar_descripcion', true); // true por defecto

$terms = get_terms(array(
  'taxonomy' => 'area_gobierno',
  'hide_empty' => false,
));

if (!empty($terms) && !is_wp_error($terms)) :
  foreach ($terms as $term) :
    $imagen_id = get_term_meta($term->term_id, 'imagen_id', true);
    $imagen_url = wp_get_attachment_url($imagen_id);
  
    if ($term->name === 'Gobierno Abierto') continue;
  
    // Definir los valores para la card
    $height = '200px';
    $variant = 2;
    $title = $term->name;
    $desc = $mostrar_descripcion ? wp_trim_words($term->description, 20, '...') : '';
    $link = get_term_link($term);
  
    // Incluir el componente genérico
    include get_template_directory() . '/templates/parts/card-base.php';
  endforeach;
  ?>

<?php else: ?>
  <span class="fz-24 empty-info mt-3">
    Actualmente no hay áreas de gobierno disponibles en esta sección.
  </span>
<?php endif; ?>
