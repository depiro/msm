<?php
$args = array(
	'post_type' => 'post',
	'showposts' => 3,
	'orderby'   => 'date',
	'order'     => 'DESC',
);

$query = new WP_Query($args);
?>

<div class="row">
	<?php
	if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();

			// 1. Imagen destacada
			if (has_post_thumbnail()) {
				$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');

			// 2. Si no hay destacada, buscar en el contenido
			} else {
				$content = get_the_content();
				preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
				$image_url = $image['src'] ?? null;
			}

			// 3. Si ninguna de las anteriores funcionó, usar placeholder
			if (!$image_url) {
				$image_url = THEME_URI . '/assets/images/placeholder.jpg';
			}
	?>
			<div class="p-3 col-12 col-md-6 col-lg-4 col-xl-4">
				<div class="card msm-report-card rounded overflow-hidden">
					<div class="image-container mb-1">
						<img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
					</div>
					<div class="card-body p-4">
						<h5 class="card-title mb-2"><?php the_title(); ?></h5>
						<div class="text-container">
							<p><?php echo wp_trim_words(short_description(), 20, '...'); ?></p>
							<!-- <p><?php echo mb_strimwidth(short_description(), 0, 120, '...'); ?></p> -->
						</div>
						<div class="d-flex justify-content-end p-2 w-100">
							<a href="<?php the_permalink(); ?>" class="w-100 d-flex justify-content-end pt-2">
								<img src="<?php echo THEME_URI; ?>/assets/images/right-arrow.svg" alt="..." class="arrow-post">
							</a>
						</div>
					</div>
				</div>
			</div>
	<?php
		endwhile;
		wp_reset_postdata();
	endif;
	?>
</div>
