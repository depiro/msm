<?php get_template_part(THEME_HEADER); ?>
<section class="msm-banner" style="background: url(<?php bloginfo('template_directory'); ?>/assets/images/banner-tramites.jpg) center 53% no-repeat #0089bc">
	<div class="container">
		<div class="msm-banner-title">
			<h1>GUÍA DE TRÁMITES</h1>
		</div>
	</div>
</section>
<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Guía de Trámites</span>
		</div>

		<div class="col-12 mb-3">
			<div class="d-flex justify-content-end mt-3 mb-3">
				<a class="btn-tramites" href="https://ventanillaunica.msm.gov.ar/PortalTramites/Account/Login">Portal de trámites</a>	
			</div>
		</div>
		<?php
		$terms = get_terms(array(
			'taxonomy' => 'area_tramite',
			'hide_empty' => false, // Muestra términos incluso si no tienen posts
		));
		if (!empty($terms) && !is_wp_error($terms)) :
			foreach ($terms as $term) :
				$imagen_id = get_term_meta($term->term_id, 'imagen_id', true);
				$imagen_url = wp_get_attachment_url($imagen_id);
		?>
				<div class="col-6 col-xs-6 col-md-3 col-lg-3 p-2 mb-2">
					<a class="tramites-item d-flex justify-content-center text-decoration-none msm-text-black fw-600" href="<?php echo esc_url(get_term_link($term)); ?>">
						<div class="d-flex flex-column justify-content-center align-items-center gap-2 tramites-content">
							<?php if ($imagen_url) : ?>
								<img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($term->name); ?>" width="100">
							<?php else : ?>
								<img src="<?php echo esc_url(get_template_directory_uri() . '/images/default-image.jpg'); ?>" alt="<?php echo esc_attr($term->name); ?>" width="100">
							<?php endif; ?>
							<span class="text-center fz-16"><?php echo esc_html($term->name); ?></span>
						</div>
					</a>
				</div>
			<?php endforeach;
		else: ?>
			<span class="fz-24 empty-info mt-3">
				Actualmente no hay áreas de trámites disponibles en esta sección. Por favor, revisa más tarde o contacta con nuestra oficina para obtener información adicional sobre los trámites disponibles.
			</span>
		<?php
		endif;
		?>
	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
<!-- archive tramite -->