<?php

/*
Template Name: Prensa
*/
get_template_part(THEME_HEADER); ?>

<?php
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1; 
	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => 10,
		'paged'          => $pagina
	);
	$event_query = new WP_Query($args);
?>

<div id="main-content" class="container mb-5">
	<div class="msm-breadcrumb d-block d-sm-row pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last">Prensa</span>
	</div>

	<div class="row my-3 my-md-5 gap-4 px-0">
		<?php if ($event_query->have_posts()) : ?>
			<?php while ($event_query->have_posts()) : $event_query->the_post(); ?>
			<a class="card border-0 text-decoration-none event-card p-0 col-12" style="background-color:#f8f9fb;" href="<?php the_permalink(); ?>">
				<?php
					$event_date = get_post_meta(get_the_ID(), '_event_date', true);
					$event_location = get_post_meta(get_the_ID(), '_event_location', true);
					$event_time = get_post_meta(get_the_ID(), '_event_time', true);
				?>
				<div class="row g-0 d-flex justify-content-center justify-content-md-between">
					<div class="col-md-3 d-flex justify-content-center">
						<?php
							// Imagen destacada o fallback
							$thumbnail_url = THEME_URI . '/assets/images/placeholder.jpg';

							if (has_post_thumbnail()) {
								$thumbnail_id = get_post_thumbnail_id(get_the_ID());
								$thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'medium_large');

								if ($thumbnail_src && is_array($thumbnail_src)) {
									$thumbnail_url = $thumbnail_src[0];
								} else {
									$fallback_full = wp_get_attachment_image_src($thumbnail_id, 'full');
									if ($fallback_full && is_array($fallback_full)) {
										$thumbnail_url = $fallback_full[0];
									}
								}
							}

							// Buscar imagen en el contenido si todo lo anterior falla
							if (!$thumbnail_url || str_contains($thumbnail_url, 'placeholder.jpg')) {
								$content = get_the_content();
								preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image_match);
								if (!empty($image_match['src'])) {
									$thumbnail_url = $image_match['src'];
								}
							}
						?>
						<div class="image-container">
							<img src="<?php echo esc_url($thumbnail_url); ?>" class="w-100 d-none d-md-block" alt="<?php the_title_attribute(); ?>">
						</div>
					</div>
					<div class="col-md-9 px-3 py-2 row">
						<div class="col-12 px-2 mt-2">
							<div class="d-flex flex-column align-items-end">
								<span class="msm-text-gray text-end post-date fw-500">
									<?php 
										if ($event_date) {
											echo dayPretty(esc_html($event_date));
											echo datePretty(esc_html($event_date));
											echo esc_html($event_time);
										} else {
											echo dayPretty(get_the_date('d-m-Y')); 
											echo datePretty(get_the_date('d-m-Y'));
										}
									?>
								</span>
							</div>
							<h4 class="msm-text-black fw-600 mt-2"><?php the_title(); ?></h4>
						</div>
						<div class="col-12 col-8 d-flex justify-content-start flex-column px-2 py-0">
							<div class="list-post-content msm-text-gray py-0">
								<p><?php the_excerpt(); ?></p>
							</div>
						</div>
					</div>
				</div>
			</a>
			<?php endwhile; ?>

			<div class="d-flex justify-content-center msm-paginator">
				<?php
					$pagination_args = array(
						'base' => esc_url(add_query_arg('pagina', '%#%')),
						'format' => '',
						'current' => max(1, $pagina),
						'total' => $event_query->max_num_pages,
						'prev_text' => __('« Anterior', 'textdomain'),
						'next_text' => __('Siguiente »', 'textdomain'),
					);
					echo paginate_links($pagination_args);
				?>
			</div>

		<?php else : ?>
			<div class="empty-info"><?php _e('No hay eventos disponibles.', 'mi-tema'); ?></div>
		<?php endif; ?>
		
		<?php wp_reset_postdata(); ?>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>
<!-- archive prensa -->
