<?php
/**
 * Componente: Información Institucional
 * Ruta sugerida: /template-parts/components/info-institucional.php
 * 
 * Cómo usar:
 * set_query_var('info_institucional', [
 *   'titulo' => 'Información institucional',
 *   'nombre' => 'Joaquín Miguel Estrada',
 *   'cargo' => 'Secretario de Educación y Trabajo',
 *   'telefono' => '03525 - 443776 / 7',
 *   'email' => 'sme@sanmiguel.gob.ar',
 *   'foto' => get_template_directory_uri() . '/assets/images/estrada.jpg',
 *   'mapa_embed' => '<iframe src="https://www.google.com/maps/embed?..." width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
 * ]);
 * get_template_part('template-parts/components/info-institucional');
 */

$props = get_query_var('info_institucional', []);
$titulo = $props['titulo'] ?? '';
$nombre = $props['nombre'] ?? '';
$cargo = $props['cargo'] ?? '';
$telefono = $props['telefono'] ?? '';
$email = $props['email'] ?? '';
$foto = $props['foto'] ?? '';
$mapa = $props['mapa_embed'] ?? '';
?>

<div class="info-institucional row align-items-start py-5 border-top">
  <div class="col-md-6">
    <?php if ($titulo): ?><h4 class="fw-bold mb-4"><?php echo esc_html($titulo); ?></h4><?php endif; ?>
    <div class="d-flex align-items-start mb-3">
      <?php if ($foto): ?>
        <img src="<?php echo esc_url($foto); ?>" alt="Foto" class="me-3 rounded-circle" style="width:60px; height:60px; object-fit: cover;">
      <?php endif; ?>
      <div>
        <div class="fw-bold mb-1"><?php echo esc_html($nombre); ?></div>
        <div class="text-muted mb-2"><?php echo esc_html($cargo); ?></div>
        <div><strong>Teléfono:</strong> <?php echo esc_html($telefono); ?></div>
        <div><strong>Correo:</strong> <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></div>
      </div>
    </div>
  </div>
  <div class="col-md-6">
    <?php echo $mapa; ?>
  </div>
</div>
        