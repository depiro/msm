<?php
$args = array(
	'post_type' => 'botonera',
	'posts_per_page' => 1,
);
$query = new WP_Query($args);

if ($query->have_posts()) :
	while ($query->have_posts()) :
		$query->the_post();

		$buttons = get_post_meta(get_the_ID(), '_buttons', true);

		if ($buttons && is_array($buttons)) {
			// Ordenar por prioridad
			usort($buttons, function ($a, $b) {
				return ($a['priority'] ?? 0) <=> ($b['priority'] ?? 0);
			});
?>
			<div class="row d-flex flex-wrap gap-1 flex-column flex-sm-row justify-content-center gap-0 wrapper-accesos">
				<?php foreach ($buttons as $button) :
					$url = home_url($button['url']);
					if (str_contains($button['url'], 'https://') || str_contains($button['url'], 'http://')) {
						$url = $button['url'];
					}

					if (!empty($button['text'])) :
				?>
					<div class="col-12 col-md-4 col-lg-2 p-1 wrap-botonera flex-xl-fill d-flex d-flex justify-content-center">
						<a href="<?php echo esc_url($url); ?>" class="align-items-center text-decoration-none home-link p-2 rounded-2 justify-content-center w-100 d-flex flex-column ">
							<div class="icon-svg">
								<?php
								if (!empty($button['icon'])) {
									$icon_slug = basename($button['icon']);
									// Si es una URL de uploads, usar render_inline_svg_from_url
									if (str_contains($button['icon'], wp_upload_dir()['baseurl'])) {
										echo render_inline_svg_from_url($button['icon'], [
											'aria-hidden' => 'true',
											'focusable' => 'false'
										]);
									} else {
										// Si es un icono del tema, usar inline_svg
										echo inline_svg($icon_slug, [
											'aria-hidden' => 'true',
											'focusable' => 'false'
										]);
									}
								}
								?>
							</div>
							<h5 class="text-center"><?php echo esc_html($button['text']); ?></h5>
						</a>
					</div>
				<?php endif; ?>
				<?php endforeach; ?>
			</div>
<?php
		}
	endwhile;
	wp_reset_postdata();
endif;
?>
