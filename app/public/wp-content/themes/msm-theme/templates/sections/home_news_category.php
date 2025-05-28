<?php
$args = array(
	'post_type'      => 'post',
	'showposts'      => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
	'category_name'  => 'gobierno',
);

$query = new WP_Query($args);
?>

<div class="row">
	<?php if ($query->have_posts()) :
		while ($query->have_posts()) : $query->the_post();

			// 🔍 Lógica combinada para obtener imagen
			if (has_post_thumbnail()) {
				$image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
			} else {
				$content = get_the_content();
				preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $content, $image);
				$image_url = $image['src'] ?? THEME_URI . '/assets/images/placeholder.jpg';
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
