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
				<a href="<?php the_permalink(); ?>" class="w-100 d-flex justify-content-end pt-2">
					<div class="card msm-report-card rounded overflow-hidden">
						<div class="image-container mb-1">
							<img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>">
						</div>
						<div class="card-body p-4">
							<?php 
								if ( has_tag() ) {
									$tags = get_the_tags();
									if ( $tags ) {
										echo '<div class="entry-tags post-tags">';
										echo '<ul class="tag-list">';
										foreach ( $tags as $tag ) {
											echo '<li>' . esc_html( $tag->name ) . '</li>';
										}
										echo '</ul>';
										echo '</div>';
									}
								}else{
										echo '<div class="entry-tags post-tags">';
										echo '<ul class="tag-list">';
										echo '<li>Prensa</li>';
										echo '</ul>';
										echo '</div>';
								}
							?>						
							<!-- <h6 class="card-title mb-3"><?php the_title(); ?></h6> -->
							<h6 class="card-title mb-3"><?php echo wp_trim_words(get_the_title(), 10, '...'); ?></h6>

							<div class="text-container">
								<p><?php echo wp_trim_words(short_description(), 20, '...'); ?></p>
								<!-- <p><?php echo mb_strimwidth(short_description(), 0, 10, '...'); ?></p> -->
							</div>
							<div class="d-flex justify-content-end p-2 w-100">
								<img src="<?php echo THEME_URI; ?>/assets/images/right-arrow.svg" alt="..." class="arrow-post">
							</div>
						</div>
					</div>
				</a>
			</div>
	<?php
		endwhile;
		wp_reset_postdata();
	endif;
	?>
	    <!-- CALL TO ACTION DE 'NOTICIAS' -->
		<section class="d-flex justify-content-center mb-5">
        <a href="<?php echo HOME_URI; ?>/prensa" class="btn btn-news text-decoration-none text-white mt-3 mb-4">VER TODAS LAS NOVEDADES</a>
    </section>
    <!-- CALL TO ACTION DE 'NOTICIAS' FIN -->
</div>
