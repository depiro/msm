<?php get_template_part(THEME_HEADER); ?>
<div id="main-content" class="container mb-5">
	<div class="row my-2  justify-content-center">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Guía de Trámites</span>
		</div>

		<h1 class="post-title">Trámites</h1>
		<h3 class="post-resume">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel.</h3>
		
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
					<a class="tramites-item d-flex justify-content-center text-decoration-none msm-text-black fw-600 border" href="<?php echo esc_url(get_term_link($term)); ?>">
						
						<div class="card d-flex flex-row align-items-center shadow-sm rounded overflow-hidden">
							<!-- Ícono -->
							<div class="bg-info d-flex align-items-center justify-content-center" style="width: 80px; 	height: 100%; flex-shrink: 0;">
								<?php if ($imagen_url) : ?>
									<img src="<?php echo esc_url($imagen_url); ?>" alt="<?php echo esc_attr($term->name); ?>" width="70">
									<?php else : ?>
										<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/multas.svg'); ?>" alt="<?php echo esc_attr($term->name); ?>" width="60">
								<?php endif; ?>
							</div>

							<!-- Contenido -->
							<div class="p-3">
								<h5 class="fw-bold text-dark"><?php echo esc_html($term->name); ?></h5>
								<p class="mb-0 text-secondary">Descubrí talleres, eventos y actividades.</p>
							</div>
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