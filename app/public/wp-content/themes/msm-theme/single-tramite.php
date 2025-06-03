<?php get_template_part(THEME_HEADER); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="main-content" class="container mb-5">
			<div class="msm-breadcrumb d-block d-sm-row px-0 pt-1 small">
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

			<div class="row my-3 my-md-5 px-3 justify-content-center px-0">

			<div class="col-12 mb-4">
				<div class="col-12 py-5">
					<h2 class="msm-font-xl mb-1"><?php the_title(); ?></h2>
					<?php if (has_excerpt()) : ?>
						<p class="fz-18"><?php echo get_the_excerpt(); ?></p>
					<?php endif; ?>
				</div>
			
			</div>
				<div class="col-12 col-md-8 mb-4">
					<div class="row">
						<?php if (get_post_meta(get_the_ID(), '_presentacion_del_tramite', true)) { ?>
							<div class="d-flex flex-column px-0">
								<h3>Presentación del trámite</h3>
								<p><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_presentacion_del_tramite', true))); ?></p>
							</div>
						<?php } ?>


						<?php if (get_post_meta(get_the_ID(), '_presentacion_del_tramite', true)) { ?>
							<div class="d-flex flex-column px-0">
								<h3>Presentación del trámite</h3>
								<p class="fz-14"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_presentacion_del_tramite', true))); ?></p>
							</div>
						<?php } ?>

						<div class="alert alert-info mb-5 px-5 py-4" role="alert">
							<h4>¿Cuáles son los requisitos?</h4>
							<p class="mb-0"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_requisitos', true))); ?></p>
						</div>


						<h3>Preguntas frecuentes</h3>

						<details class="my-3">
							<?php if (get_post_meta(get_the_ID(), '_duracion_del_tramite', true)) { ?>		
								<summary class="fz-20 fw-600 cursor-pointer">¿Cuánto tiempo tarda en completarse?</summary>
								<p class="mt-2"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_duracion_del_tramite', true))); ?></p>
							<?php } ?>
						</details>


						<details class="my-3">
							<?php if (get_post_meta(get_the_ID(), '_vigencia_del_documento_obtenido', true)) { ?>
								<summary class="fz-20 fw-600 cursor-pointer">¿Por cuánto tiempo es válido el documento que obtengo?</summary>
								<p class="mt-2"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_vigencia_del_documento_obtenido', true))); ?></p>
							<?php } ?>
						</details>

						<details class="my-3">
							<?php if (get_post_meta(get_the_ID(), '_respaldo_legal', true)) { ?>
								<summary class="fz-20 fw-600 cursor-pointer">¿Cuál es el respaldo legal?</summary>
								<p class="mt-2"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_respaldo_legal', true))); ?></p>
							<?php } ?>
						</details>

						<details class="my-3">
							<?php if (get_post_meta(get_the_ID(), '_observaciones', true)) { ?>
								<summary class="fz-20 fw-600 cursor-pointer">¿Hay alguna observación importante que deba tener en cuenta?</summary>
								<p class="mt-2"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_observaciones', true))); ?></p>
							<?php } ?>
						</details>

						<details class="my-3">	
							<summary class="fz-20 fw-600 cursor-pointer">¿Dónde puedo realizarlo?</summary>
							<p class="mt-2"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_lugar_de_atencion', true))); ?></p>
						</details>

						<details class="my-3">
							<summary class="fz-20 fw-600 cursor-pointer">¿Cuáles son los horarios de atención?</summary>
							<p class="mt-2"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_horarios_de_atencion', true))); ?></p>
						</details>
						
					</div>
				</div>
				<div class="col-12 col-md-4 pt-2">
					<div class="d-flex flex-column">
						<div class="d-flex flex-column mb-2">
							<h5 class="mb-0">¿Dónde puedo realizarlo?</h5>
							<p class="m-1"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_lugar_de_atencion', true))); ?></p>
						</div>

						<div class="d-flex flex-column">
							<h5 class="mb-0">¿Cuáles son los horarios de atención?</h5>
							<p class="m-1"><?php echo wpautop(wp_kses_post(get_post_meta(get_the_ID(), '_horarios_de_atencion', true))); ?></p>
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

<?php get_template_part('templates/parts/encuesta_utilidad');  ?>
<?php get_template_part(THEME_FOOTER); ?>
<!-- single tramite -->