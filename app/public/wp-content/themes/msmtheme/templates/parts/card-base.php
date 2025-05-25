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
?>

<div class="col-12 col-md-4 mb-3">
  <a href="<?php echo esc_url($link ?? get_permalink()); ?>" class="text-decoration-none card-v<?= esc_attr($variant); ?>">
<!-- 
    <div class="card areas-card d-flex flex-row overflow-hidden align-items-stretch <?php echo ($variant === 3 || $variant === 4 ? 'flex-row ' : '') . ($extra_class ?? ''); ?>" style="<?php echo isset($height) ? 'height:' . esc_attr($height) . ';' : ''; ?>"> -->

    <div class="card d-flex overflow-hidden flex-row align-items-stretch <?php echo $variant === 3 || $variant === 4 ? 'flex-row' : ''; ?>"
     style="<?php echo isset($height) ? 'min-height:' . esc_attr($height) . ';' : ''; ?>">



      <?php if (in_array($variant, [3, 4])) : ?>
        <div class="card-icon d-flex align-items-center justify-content-center" style="background-color: <?php echo esc_attr($color ?? '#3dbfee'); ?>;">
          <?php if (!empty($icon)) echo $icon; ?>
        </div>
      <?php elseif ($variant === 1 || $variant === 2) : ?>
        <div class="card-barra"></div>
      <?php endif; ?>

      <div class="card-body p-3 d-flex flex-column justify-content-center">
        <h5 class="card-title"><?= esc_html($title ?? get_the_title()); ?></h5>

        <?php if (in_array($variant, [2, 3])) : ?>
          <p class="card-text fz-14 mb-0">
            <?= esc_html($desc ?? wp_trim_words(get_the_excerpt(), 20, '...')); ?>
          </p>
        <?php endif; ?>

        <?php if ($variant === 2) : ?>
          <span class="card-link text-primary mt-2 d-inline-block fw-semibold">Ver más</span>
        <?php endif; ?>
      </div>

    </div>
  </a>
</div>
