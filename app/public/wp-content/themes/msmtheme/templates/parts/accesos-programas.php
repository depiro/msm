<?php
/**
 * Componente: Accesos a Programas y Servicios
 * Ubicación: /template-parts/components/accesos-programas.php
 */

// Obtener todas las páginas marcadas como "destacadas" para accesos
$args = array(
    'post_type' => 'page',
    'posts_per_page' => -1,
    'meta_key' => 'mostrar_en_accesos', // Campo ACF booleano
    'meta_value' => '1',
    'orderby' => 'menu_order',
    'order' => 'ASC'
);

$accesos = new WP_Query($args);

if ($accesos->have_posts()) : ?>

<section class="accesos-programas container py-5">
  <h2 class="text-center mb-4">&iexcl;Conoc&eacute; todos los programas y servicios que tenemos para vos!</h2>
  <div class="row g-3">
    <?php while ($accesos->have_posts()) : $accesos->the_post();
      $titulo = get_the_title();
      $link = get_permalink();
      $icono = get_field('icono_svg'); // SVG inline desde ACF (campo tipo "imagen" o texto)
      $color = get_field('color_acceso'); // color de fondo del ícono
    ?>

    <div class="col-6 col-md-4 col-lg-3">
      <a href="<?php echo esc_url($link); ?>" class="acceso-box d-flex align-items-center shadow-sm">
        <div class="acceso-icon" style="background-color: <?php echo esc_attr($color); ?>">
          <?php if ($icono) echo $icono; ?>
        </div>
        <div class="acceso-titulo">
          <?php echo esc_html($titulo); ?>
        </div>
      </a>
    </div>

    <?php endwhile; ?>
  </div>
</section>

<?php wp_reset_postdata(); endif; ?>
