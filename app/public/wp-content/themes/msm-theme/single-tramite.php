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

			<div class="row my-3 my-md-5 justify-content-center">			
				<div class="col-12 py-5 mb-4">
					<h2 class="msm-font-xl mb-1"><?php the_title(); ?></h2>
					<?php if (has_excerpt()) : ?>
						<p class="fz-18"><?php echo get_the_excerpt(); ?></p>
					<?php endif; ?>
				</div>
			
			
				<div class="col-12 col-md-8 mb-4">
					<div class="row">
						<?php 
						$presentacion = get_post_meta(get_the_ID(), '_presentacion_del_tramite', true);
						if ($presentacion) : ?>
							<div class="d-flex flex-column">
								<h3>Presentación del trámite</h3>
								<p><?php echo wpautop(wp_kses_post($presentacion)); ?></p>
							</div>
						<?php endif; ?>

						<?php 
						$requisitos = get_post_meta(get_the_ID(), '_requisitos', true);
						if ($requisitos) : ?>
							<div class="alert alert-info mb-5 px-5 py-4">
								<h4>¿Cuáles son los requisitos?</h4>
								<p class="mb-0"><?php echo wpautop(wp_kses_post($requisitos)); ?></p>
							</div>
						<?php endif; ?>

						<h3>Preguntas frecuentes</h3>

						<?php
						$faq_items = [
							[
								'meta_key' => '_duracion_del_tramite',
								'question' => '¿Cuánto tiempo tarda en completarse?'
							],
							[
								'meta_key' => '_vigencia_del_documento_obtenido',
								'question' => '¿Por cuánto tiempo es válido el documento que obtengo?'
							],
							[
								'meta_key' => '_respaldo_legal',
								'question' => '¿Cuál es el respaldo legal?'
							],
							[
								'meta_key' => '_observaciones',
								'question' => '¿Hay alguna observación importante que deba tener en cuenta?'
							]
						];

						foreach ($faq_items as $item) :
							$content = get_post_meta(get_the_ID(), $item['meta_key'], true);
							if ($content) :
						?>
							<details class="my-3">
								<summary class="fz-20 fw-600 cursor-pointer"><?php echo esc_html($item['question']); ?></summary>
								<p class="mt-2"><?php echo wpautop(wp_kses_post($content)); ?></p>
							</details>
						<?php 
							endif;
						endforeach; 
						?>

						<?php
						$lugar_atencion = get_post_meta(get_the_ID(), '_lugar_de_atencion', true);
						$horarios = get_post_meta(get_the_ID(), '_horarios_de_atencion', true);
						?>

						<details class="my-3">    
							<summary class="fz-20 fw-600 cursor-pointer">¿Dónde puedo realizarlo?</summary>
							<p class="mt-2"><?php echo wpautop(wp_kses_post($lugar_atencion)); ?></p>
						</details>

						<details class="my-3">
							<summary class="fz-20 fw-600 cursor-pointer">¿Cuáles son los horarios de atención?</summary>
							<p class="mt-2"><?php echo wpautop(wp_kses_post($horarios)); ?></p>
						</details>
						
					</div>
				</div>
				<div class="col-12 col-md-4 pt-2">
					<div class="d-flex flex-column">
						<?php if ($lugar_atencion) : ?>
							<div class="d-flex flex-column mb-4">
								<h5 class="mb-2">¿Dónde puedo realizarlo?</h5>
								<p class="m-0"><?php echo wpautop(wp_kses_post($lugar_atencion)); ?></p>
							</div>
						<?php endif; ?>

						<?php if ($horarios) : ?>
							<div class="d-flex flex-column">
								<h5 class="mb-2">¿Cuáles son los horarios de atención?</h5>
								<p class="m-0"><?php echo wpautop(wp_kses_post($horarios)); ?></p>
							</div>
						<?php endif; ?>
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