<?php
/**
 * Componente: Accesos a Programas y Servicios
 * Este componente muestra tarjetas enlazadas con íconos SVG y colores personalizados.
 * Basado en taxonomías personalizadas (ej: 'programa_servicio').
 */

$terms = get_terms(array(
  'taxonomy' => 'programa_servicio',
  'hide_empty' => false,
));

if (!empty($terms) && !is_wp_error($terms)) :
  echo '<div class="row">';

  foreach ($terms as $term) :
    $icono = get_term_meta($term->term_id, 'icono_svg', true); // nombre del archivo SVG sin .svg
    $color = get_term_meta($term->term_id, 'color_hex', true); // color en formato #RRGGBB o variable CSS
    $link = get_term_link($term);
    ?>

    <div class="col-6 col-md-4 col-lg-3 p-2">
      <a href="<?php echo esc_url($link); ?>" class="text-decoration-none d-flex align-items-stretch h-100">
        <div class="card shadow-sm d-flex flex-row overflow-hidden w-100">

          <!-- Barra lateral con ícono -->
          <div class="d-flex align-items-center justify-content-center px-3" style="background-color: <?php echo esc_attr($color ?: '#0095da'); ?>;">
            <div class="icon-svg" style="width: 40px; height: 40px; color: #fff;">
              <?php if (!empty($icono)) inline_svg($icono); ?>
            </div>
          </div>

          <!-- Contenido textual -->
          <div class="p-3 d-flex align-items-center">
            <p class="mb-0 fw-semibold text-dark text-uppercase fz-16">
              <?php echo esc_html($term->name); ?>
            </p>
          </div>

        </div>
      </a>
    </div>

  <?php endforeach;
  echo '</div>';
endif; ?>
