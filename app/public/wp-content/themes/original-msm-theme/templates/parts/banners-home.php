<?php
/**
 * Componente: Banners Home
 * Ruta sugerida: /template-parts/components/banners-home.php
 * 
 * Cómo usar:
 * set_query_var('banners_home', [
 *   [
 *     'url' => '/debito-automatico',
 *     'icon' => 'debito.svg',
 *     'title' => '¡Adherite al débito automático!',
 *     'text' => 'y ganá tranquilidad todos los meses',
 *     'style' => 'bg-white shadow-sm'
 *   ],
 *   [
 *     'url' => '/vacunacion',
 *     'icon' => 'vacunas.svg',
 *     'title' => 'Poné las <strong>VACUNAS AL DÍA</strong>',
 *     'text' => 'completá el calendario de vacunación',
 *     'style' => 'border border-primary',
 *     'icon_right' => true
 *   ],
 * ]);
 * get_template_part('template-parts/components/banners-home');
 */

$banners = get_query_var('banners_home', []);

if (!empty($banners)) : ?>
  <div class="row gy-3 p-0">
    <?php foreach ($banners as $banner) :
      $icon_slug = basename($banner['icon'] ?? '');
      $svg_path = get_theme_file_path('/assets/images/icons/' . $icon_slug);
      $icon_right = !empty($banner['icon_right']);
      ?>
      <div class="col-12 col-md-6 mb-4 mb-md-0">
        <a href="<?php echo esc_url($banner['url']); ?>"
           class="d-flex align-items-center justify-content-between rounded-3 text-decoration-none banner-card py-3 <?php echo esc_attr($banner['style'] ?? ''); ?>">
           <div class="row w-100 align-items-center ps-5 <?php echo $icon_right ? 'flex-row-reverse pe-2' : ''; ?>">
  <div class="col-auto">
    <div class="icon-svg d-flex justify-content-center align-items-center" style="width: 48px;">
      <?php
      if (!empty($icon_slug) && file_exists($svg_path)) {
        echo file_get_contents($svg_path);
      } else {
        echo '<!-- Icon not found: ' . esc_html($icon_slug) . ' -->';
      }
      ?>
    </div>
  </div>
  <div class="col">
      <h4 class="mb-0"><?php echo $banner['title']; ?></h4>
      <p class="text-secondary mb-0"><?php echo $banner['text']; ?></p>
  </div>
</div>

        </a>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
