<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
$term_id = get_queried_object()->term_id;

// Redirect logic for 'subsecretaria-de-eventos-municipales'
if ($current_term && $current_term->slug === 'subsecretaria-de-eventos-municipales') {
	wp_redirect(get_post_type_archive_link('evento_municipal'));
	exit;
}


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
	// We use include here instead of get_template_part so $exclude_ids can populate into this scope
	include(locate_template('templates/parts/section-subareas.php'));
	?>


	<!-- Main Content (Posts) -->
	<div class="container mt-5">
		<div class="row">
			<div class="col-12">
				<!-- (Banner Removed) -->




				<?php
				$exclude_ids = isset($exclude_ids) ? $exclude_ids : array();

				if (have_posts()): ?>

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