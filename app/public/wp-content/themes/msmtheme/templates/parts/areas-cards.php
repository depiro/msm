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
    ?>
    <div class="col-12 col-md-4 mb-1 py-3">
      <a href="<?php echo esc_url(get_term_link($term)); ?>" class="text-decoration-none areas-gobierno-item py-3">
        <div class="card areas-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch mb-3">
          <div class="areas-barra d-flex align-items-center justify-content-center"></div>
          <div class="areas-content p-4">
            <p class="mb-0 text-uppercase fz-16 fw-semibold"><?php echo esc_html($term->name); ?></p>

            <?php if ($mostrar_descripcion): ?>
              <p class="areas-description text-secondary mb-0 fz-16">
                <?php echo esc_html($term->description); ?>
              </p>
            <?php endif; ?>

          </div>
        </div>
      </a>
    </div>
  <?php endforeach; ?>

<?php else: ?>
  <span class="fz-24 empty-info mt-3">
    Actualmente no hay áreas de gobierno disponibles en esta sección.
  </span>
<?php endif; ?>
