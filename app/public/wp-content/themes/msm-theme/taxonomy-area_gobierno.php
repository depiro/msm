<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
$term_id = get_queried_object()->term_id;
$image_url = get_term_meta($term_id, 'banner_image', true);
?>



<div id="main-content" class="mb-5">

	<!-- Breadcrumbs -->
	<div class="container">
		<div class="d-flex flex-column flex-md-row msm-breadcrumb pt-1 small">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item"
				href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno /</a><span
				class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html($current_term->name); ?></span>
		</div>
	</div>

	<!-- Header Section (Gray) -->
	<div class="w-100 py-5" style="background-color: #f0f0f0;">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<?php if ($current_term): ?>
						<h2 class="msm-font-xl mb-3 fw-bold"><?php echo esc_html($current_term->name); ?></h2>
						<p class="fz-18 text-secondary" style="max-width: 800px;">
							<?php echo wp_kses_post($current_term->description); ?>
						</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<!-- Sub-areas Section (Pages in Area) -->
	<?php
	/*
	 * Logic Update:
	 * Only show pages that belong to CHILD terms (sub-areas) of the current area.
	 * Exclude pages that are directly assigned to the parent area but not to a sub-area.
	 */
	$child_terms = get_term_children($term_id, 'area_gobierno');
	$exclude_ids = array(); // Initialize array to track displayed posts
	
	// Only proceed if there are child terms
	if (!empty($child_terms) && !is_wp_error($child_terms)) {
		$sub_pages_query = new WP_Query(array(
			'post_type' => 'page',
			'posts_per_page' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'area_gobierno',
					'field' => 'term_id',
					'terms' => $child_terms, // Filter by child IDs
					'operator' => 'IN',
				),
			),
			'orderby' => 'name',
			'order' => 'ASC',
		));
	} else {
		// If no children, create an empty query to skip the loop
		$sub_pages_query = new WP_Query();
	}

	if ($sub_pages_query->have_posts()): ?>
		<div class="w-100 py-4" style="background-color: #f9f9f9; border-bottom: 1px solid #eee;">
			<div class="container">
				<div class="row gy-3">
					<?php while ($sub_pages_query->have_posts()):
						$sub_pages_query->the_post();
						$exclude_ids[] = get_the_ID(); // Add to exclusion list
						$title = get_the_title();
						$link = get_permalink();
						include get_template_directory() . '/templates/parts/card-subarea.php';
					endwhile;
					wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	<?php endif; ?>

	<!-- Main Content (Posts) -->
	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
				<!-- Banner Comunicación y Deportes (Dynamic) -->
				<?php
				// Retrieve Selected Banner News ID
				$banner_news_id = get_term_meta($term_id, 'banner_news_id', true);

				if ($banner_news_id):
					$banner_post = get_post($banner_news_id);
					if ($banner_post && $banner_post->post_status === 'publish'):
						?>
						<div class="row mt-0">
							<?php
							$title = get_the_title($banner_post);
							$desc = get_the_excerpt($banner_post);
							if (empty($desc)) {
								$desc = wp_trim_words($banner_post->post_content, 20);
							}
							$image_url = get_the_post_thumbnail_url($banner_post, 'full');
							$link = get_permalink($banner_post);

							// Optional: Pass attributes if needed, though card-overlay defaults are good
							$width = 'full';
							$align = 'right'; // Default preference or could be another field
					
							include get_template_directory() . '/templates/parts/card-overlay.php';
							?>
						</div>
						<?php
					endif;
				endif;
				?>


				<?php if (have_posts()): ?>

					<div class="row">
						<?php while (have_posts()):
							the_post();

							// Skip if post was already shown in sub-areas
							if (in_array(get_the_ID(), $exclude_ids)) {
								continue;
							}
							?>
							<?php
							$height = '180px';
							$variant = 2;
							$title = get_the_title();
							$desc = strtok(strip_tags(get_the_content()), '.') . '.';
							$link = get_permalink();

							include get_template_directory() . '/templates/parts/card-base.php';
							?>
						<?php endwhile; ?>
					</div>

					<div style="display:flex;justify-content:end;">
						<?php
						the_posts_navigation(array(
							'next_text' => '« Anterior',
							'prev_text' => 'Siguiente »',
						));
						?>
					</div>

				<?php else: ?>
					<!-- Opcional: mostrar mensaje si no hay posts (aparte de las subareas) -->
					<!-- <div class="empty-info"><?php _e('No hay publicaciones disponibles.', 'textdomain'); ?></div> -->
				<?php endif; ?>
			</div>
		</div>

		<!-- Sección Eventos Municipales (Conditional) -->
		<?php if ($current_term->slug === 'secretaria-de-comunicacion-y-deportes'): ?>
			<?php get_template_part('templates/parts/section-eventos-municipales'); ?>
		<?php endif; ?>



	</div>

</div>



</div>

<?php get_template_part('templates/parts/encuesta_utilidad'); ?>
<?php get_template_part(THEME_FOOTER); ?>
<!-- taxonomy area gobierno -->