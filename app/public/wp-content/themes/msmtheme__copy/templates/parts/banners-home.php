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
 *     'style' => 'border border-primary'
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
      ?>
      <div class="col-12 col-md-6 m-0">
        <a href="<?php echo esc_url($banner['url']); ?>"
           class="d-flex align-items-center justify-content-between p-4 rounded-3 text-decoration-none banner-card <?php echo esc_attr($banner['style'] ?? ''); ?>">
          <div class="d-flex align-items-center gap-3">
            <div class="icon-svg">
              <?php if (file_exists($svg_path)) { readfile($svg_path); } ?>
            </div>
            <div>
              <div class="fw-bold text-dark">
                <h4 class="mb-0"><?php echo $banner['title']; ?></h4>
              </div>
              <div class="text-secondary small">
                <p><?php echo $banner['text']; ?></p>
              </div>
            </div>
          </div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>
