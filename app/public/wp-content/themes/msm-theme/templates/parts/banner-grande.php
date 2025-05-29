<?php
/**
 * Componente: Banner Consultas
 * Ruta sugerida: template/parts/banner-grande.php
 * 
 * Cómo usar:
 * set_query_var('banner_consultas', [
 *   'title' => 'Iniciá tus pedidos o consultas',
 *   'button_text' => 'Iniciar consultas',
 *   'button_url' => '/consultas',
 *   'image' => get_template_directory_uri() . '/assets/images/consultas-ilustracion.svg'
 * ]);
 * get_template_part('template-parts/components/banner-consultas');
 */

$props = get_query_var('banner_consultas', []);
$title = $props['title'] ?? '';
$button_text = $props['button_text'] ?? '';
$button_url = $props['button_url'] ?? '#';
$image_url = $props['image'] ?? '';
?>

<div class="banner-consultas d-flex align-items-center justify-content-between ps-5 rounded-3 overflow-hidden">
  <div class="text-content">
    <h4 class="fw-bold mb-2"><?php echo esc_html($title); ?></h4>
    <a href="<?php echo esc_url($button_url); ?>" class="btn btn-sm btn-primary text-decoration-none text-white">
      <?php echo esc_html($button_text); ?>
    </a>
  </div>

  <?php if ($image_url): ?>
    <div class="image-content">
      <img src="<?php echo esc_url($image_url); ?>" alt="Ilustración" style="max-height: 200px; height: auto;" />
    </div>
  <?php endif; ?>
</div>
