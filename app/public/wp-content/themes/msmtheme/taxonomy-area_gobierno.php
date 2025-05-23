<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
$term_id = get_queried_object()->term_id;
$image_url = get_term_meta($term_id, 'banner_image', true);
?>


<div id="main-content" class="container mb-5">
	<div class="d-flex flex-column flex-md-row msm-breadcrumb pt-2">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item"
			href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno /</a><span
			class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html($current_term->name); ?></span>
	</div>

	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 py-5">
			<?php if ($current_term): ?>
			<h2 class="msm-font-xl mb-1"><?php echo esc_html($current_term->name); ?></h2>
			<p class="fz-18"><?php echo wp_kses_post($current_term->description); ?></p>
			<?php endif; ?>
		</div>

		<div class=" col-12 col-md-9">
			<!-- <div class="page-header mb-5">
				<?php if ($current_term): ?>
					<h2 class="page-title"><?php echo esc_html($current_term->name); ?></h2>
					<div class="taxonomy-description fz-16 msm-text-black">
						<?php echo wp_kses_post($current_term->description); ?>
					</div>
					<?php
				endif;
				?>
			</div> -->

			<?php if (have_posts()): ?>

				<div class="page-content fz-16 fw-400 msm-text-gray text-left row">
					<?php while (have_posts()):
						the_post(); ?>
						<a href="<?php the_permalink() ?>" class="d-flex flex-column text-decoration-none mt-4">
							<span class="fz-16 fw-600 msm-text-600"><?php the_title(); ?></span>
						</a>
						<span class="fz-14 msm-text-gray page-content-excerpt"><?php the_excerpt(); ?></span>

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
		<div class="col-12 col-md-3">
			<h5 class="py-2 msm-text-b-dark">Áreas de Gobierno</h5>
			<?php
			// Obtener términos de la taxonomía `area_tramite`
			$terms = get_terms(array(
				'taxonomy' => 'area_gobierno',
				'hide_empty' => false,
			));
			?>
			<ul class="msm-submenu ps-0">
				<?php
				if (!empty($terms) && !is_wp_error($terms)):
					foreach ($terms as $term):
						if ($term->name == 'Gobierno Abierto')
							continue;
						?>
						<li class="cat-item">
							<a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_attr($term->name); ?></a>
						</li>
					<?php endforeach;
				endif;
				?>
			</ul>
		</div>

	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
<!-- taxonomy area gobierno -->