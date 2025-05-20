<?php get_template_part(THEME_HEADER); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="main-content" class="container mb-5">
			<div class="row my-3 my-md-5 px-3 justify-content-center px-0">
				<div class="msm-breadcrumb d-block d-sm-row px-0">
					<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home</a>/
					<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/guia-tramites">Guía de Trámites</a>/
					<?php
					// Obtener el área del trámite
					$terms = get_the_terms(get_the_ID(), 'area_tramite');
					if ($terms && !is_wp_error($terms)) :
						$term = array_shift($terms); // Tomar el primer término si hay varios
					?>
						<a class="msm-breadcrumb-item" href="<?php echo get_term_link($term); ?>">
							<?php echo esc_html($term->name); ?>
						</a>/
					<?php endif; ?>
					<span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
				</div>

				
				<div class="col-12 col-md-8 mb-4">
					<div class="row page-title mb-3 px-0">
						<span class="fw-600 msm-text-600 fz-24 px-0"><?php the_title(); ?></span>
					</div>
					<div class="page-content fz-16 fw-400 msm-text-gray row px-0 pe-md-4">
						<?php if (get_post_meta(get_the_ID(), '_presentacion_del_tramite', true)) { ?>
							<div class="d-flex flex-column mt-3 px-0">
								<span class="fz-16 fw-600 msm-text-600 mt-3">Presentación del trámite</span>
								<span class="fz-14 msm-text-gray"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_presentacion_del_tramite', true))); ?></span>
							</div>
						<?php } ?>
						<div class="d-flex flex-column border rounded rounded-3 p-3 mt-3" style="background-color:#1ab3ea;">
							<span class="fz-16 fw-600 text-white">¿Cuáles son los requisitos?</span>
							<span class="fz-14 msm-text-50">
								<?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_requisitos', true))); ?>
							</span>
						</div>
						<?php if (get_post_meta(get_the_ID(), '_duracion_del_tramite', true)) { ?>
							<div class="d-flex flex-column mt-3 px-0">
								<span class="fz-16 fw-600 msm-text-600 mt-3">¿Cuánto tiempo tarda en completarse?</span>
								<span class="fz-14 msm-text-gray"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_duracion_del_tramite', true))); ?></span>
							</div>
						<?php } ?>
						<div class="d-flex flex-column mt-3 px-0">
							<?php if (get_post_meta(get_the_ID(), '_vigencia_del_documento_obtenido', true)) { ?>
								<span class="fz-16 fw-600 msm-text-600 mt-3">¿Por cuánto tiempo es válido el documento que obtengo?</span>
								<span class="fz-14 msm-text-gray"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_vigencia_del_documento_obtenido', true))); ?></span>
							<?php } ?>
							<?php if (get_post_meta(get_the_ID(), '_respaldo_legal', true)) { ?>
								<span class="fz-16 fw-600 msm-text-600 mt-3">¿Cuál es el respaldo legal?</span>
								<span class="fz-14 msm-text-gray"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_respaldo_legal', true))); ?></span>
							<?php } ?>
							<?php if (get_post_meta(get_the_ID(), '_observaciones', true)) { ?>
								<span class="fz-16 fw-600 msm-text-600 mt-3">¿Hay alguna observación importante que deba tener en cuenta?</span>
								<span class="fz-14 msm-text-gray tramites-observaciones"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_observaciones', true))); ?></span>
							<?php } ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="d-flex flex-column">
						<div class="d-flex flex-column mb-4">
							<span class="fw-600 msm-text-600 fz-16 mb-1">¿Dónde puedo realizarlo?</span>
							<span class="fz-14 w-100 msm-text-gray"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_lugar_de_atencion', true))); ?></span>
						</div>

						<div class="d-flex flex-column">
							<span class="fw-600 msm-text-600 fz-16 mb-1">¿Cuáles son los horarios de atención?</span>
							<span class="fz-14 w-100 msm-text-gray"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_horarios_de_atencion', true))); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile;
else : ?>
	<div id="main-content" class="container mb-5">
		<div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
	</div>
<?php endif; ?>

<?php get_template_part(THEME_FOOTER); ?>
<!-- single tramite -->