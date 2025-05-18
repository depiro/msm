<?php

/*
Template Name: Areas-gobierno
template_name: areas-gobierno
*/
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center px-0">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Áreas de Gobierno</span>
		</div>
		<div class="page-content fz-16 fw-400 msm-text-gray text-left row px-0">
			<?php
			$terms = get_terms(array(
				'taxonomy' => 'area_gobierno',
				'hide_empty' => false,
			));
			if (!empty($terms) && !is_wp_error($terms)) :
				foreach ($terms as $term) :
					$imagen_id = get_term_meta($term->term_id, 'imagen_id', true);
					$imagen_url = wp_get_attachment_url($imagen_id);
					
					if ($term->name == 'Gobierno Abierto') continue;
				?>
			
					<div class="col-12 col-md-4 py-3 px-0">
						<a href="<?php echo esc_url(get_term_link($term)); ?>" class="d-flex flex-column text-decoration-none areas-gobierno-item py-3 pe-2">
							<span class="fz-16 fw-600 areas-gobierno-title"><?php echo esc_html($term->name); ?></span>
							<span class="fz-14 areas-gobierno-desc"><?php echo esc_html($term->description); ?> </span>
							<span class="d-flex justify-content-end areas-gobierno-more fz-14">
								Ver más
							</span>
						</a>
					</div>


				<?php endforeach;
			else: ?>
				<span class="fz-24 empty-info mt-3">
					Actualmente no hay áreas de gobierno disponibles en esta sección. Por favor, revisa más tarde o contacta con nuestra oficina para obtener información adicional sobre las areas disponibles.
				</span>
			<?php
			endif;
			?>
		</div>
	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
<!-- archive areas-gobierno -->