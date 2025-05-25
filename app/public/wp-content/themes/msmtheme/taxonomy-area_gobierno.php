<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
$term_id = get_queried_object()->term_id;
$image_url = get_term_meta($term_id, 'banner_image', true);
?>


<div id="main-content" class="container mb-5">
	<div class="d-flex flex-column flex-md-row msm-breadcrumb pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item"
			href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno /</a><span
			class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html($current_term->name); ?></span>
	</div>

	<div class="row my-3 my-md-5 px-3">
		<div class="col-12 py-5">
			<?php if ($current_term): ?>
			<h2 class="msm-font-xl mb-1"><?php echo esc_html($current_term->name); ?></h2>
			<p class="fz-18"><?php echo wp_kses_post($current_term->description); ?></p>
			<?php endif; ?>
		</div>

		<div class="row  border">
		<div class="col-12">

			<?php if (have_posts()): ?>

				<div class="row">
				<?php while (have_posts()): the_post(); ?>
					<div class="col-12 col-md-4">
						
							<a href="<?php the_permalink() ?>" class="text-decoration-none areas-gobierno-item py-5">
								<div class="card areas-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch mb-3">
								<div class="areas-barra d-flex align-items-center justify-content-center"></div>
								
								<div class="areas-content ps-3 pe-2 py-5">
									<h5 class="mb-2"><?php the_title(); ?></h5>
									
									<p class="areas-description smb-0 fz-14"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
								</div>
							</div>
						</a>
						
					</div>
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

				<div class="empty-info"><?php _e('No hay publicaciones disponibles.', 'textdomain'); ?></div>

			<?php endif; ?>
		</div>
		</div>


	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
<!-- taxonomy area gobierno -->