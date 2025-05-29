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
			
			foreach ($buttons as $button) :
				$url = home_url($button['url']);
				if (str_contains($button['url'], 'https://') || str_contains($button['url'], 'http://')) {
					$url = $button['url'];
				}

				if (!empty($button['text'])) :
				?>
					<div class="col-6 col-md-4 col-lg-2 p-3 wrap-botonera flex-fill">
						<a href="<?php echo esc_html($url); ?>" class="align-items-center text-decoration-none home-link p-2 rounded-2 justify-content-center d-flex flex-column">

							<div class="icon-svg">
								<?php
								if (!empty($button['icon'])) {
									$icon_slug = basename($button['icon']);
									$svg_path = get_theme_file_path('/assets/images/icons/' . $icon_slug);
									if (file_exists($svg_path)) {
										readfile($svg_path);
									}
								}
								?>
							</div>
							<h4 class="text-center"><?php echo esc_html($button['text']); ?></h4>
						</a>
					</div>
				<?php
				endif; // cierre de if $button['text']
			endforeach;
		}
	endwhile;
	wp_reset_postdata();
endif;
?>
