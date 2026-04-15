<?php

get_template_part(THEME_HEADER); ?>


<div id="main-content" class="container mb-5">
	<div class="msm-breadcrumb d-block d-sm-row">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno</a>/
		<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-gobierno">Secretaría de Gobierno</a>/
		<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2">Licencias de Conducir</a>/
		<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2__trashed/turnos">Turnos</a>/
		<span class="msm-breadcrumb-item-last">Primera Licencia</span>
	</div>

	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-9">
			<div class="row p-0 justify-content-center">
				<div class="col-12">
					<span class="landing-title">Primera licencia</span>
					<p class="landing-subtitle">
						Obtené tu primera licencia con la opción de curso online o presencial, adaptado a tu
						disponibilidad y preferencias.
					</p>
				</div>
				<div class="col-12 rounded rounded-3 d-flex flex-column px-0 align-items-start py-4 primera-lic"
					style="background-color:#1BB4EB">
					<div class="d-flex">
						<div class="d-flex justify-content-center align-items-start px-4">
							<img src="<?php echo THEME_URI; ?>/assets/images/pc_icon.svg" style="height: 50px;"
								alt="...">
						</div>
						<div>
							<span class="text-white py-5 fw-500 fz-20">CURSO ONLINE</span>
							<ul class="mt-3">
								<li class="fz-16">
									<span class="text-decoration-none border-0 text-white">Menor tiempo de trámite en
										comparación con el trámite presencial (Hasta 1hs más rápido)</span>
								</li>
								<li class="fz-16">
									<span class="text-decoration-none border-0 text-white">Mayor disponibilidad de
										turnos.</span>
								</li>
								<li class="fz-16">
									<span class="text-decoration-none border-0 text-white">Lo realizas desde la
										comodidad de tu casa.</span>
								</li>
								<li class="fz-16">
									<span class="text-decoration-none border-0 text-white">Se ajusta a tu disponibilidad
										horaria.</span>
								</li>
								<li class="fz-16">
									<span class="text-decoration-none border-0 text-white">Lo podes ver las veces que
										consideres necesario.</span>
								</li>
							</ul>
						</div>
					</div>
					<div class="d-flex justify-content-end px-5 w-100">
						<a class="text-decoration-none w-auto" href="<?php echo HOME_URI; ?>/licencias/curso-online">
							<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg" style="height: 50px;"
								alt="...">
						</a>
					</div>
				</div>
				<div class="col-12 rounded rounded-3 d-flex px-0 justify-content-between align-items-center pe-3 py-2 mt-3"
					style="background-color:#575756">
					<div class="d-flex align-items-center justify-content-center">
						<div class="d-flex justify-content-center align-items-center p-4">
							<img src="<?php echo THEME_URI; ?>/assets/images/person_icon.svg" style="height: 50px;"
								alt="...">
						</div>
						<div>
							<span class="text-white py-5 fw-500 fz-20">CURSO PRESENCIAL</span>
						</div>
					</div>
					<a class="text-decoration-none link-curso-online w-auto px-4"
						href="https://citasweb.msm.gov.ar/CitasWeb/">
						<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg" style="height: 50px;"
							alt="...">
					</a>
				</div>
			</div>
		</div>
		
		<div class="col-12 col-md-3">
			<?php
			// Obtener el término de taxonomía asociado con el post actual
			$terms = get_the_terms(get_the_ID(), 'area_gobierno');
			if ($terms && !is_wp_error($terms)) {
				$term = $terms[0]; // Suponiendo que hay al menos un término
				// $term_slug = $term->slug;
			
				// Consulta para obtener otras páginas en la misma área
				$args = array(
					'post_type' => 'page',
					'posts_per_page' => 10, // Número de posts a mostrar
					'tax_query' => array(
						array(
							'taxonomy' => 'area_gobierno',
							'field' => 'slug',
							'terms' => 'secretaria-de-gobierno',
						),
					),
					'orderby' => 'title',
					'order' => 'ASC',
				);

				$related_query = new WP_Query($args);

				if ($related_query->have_posts()): ?>
					<div class="menuCul">
						<h5 class="py-2"><?php echo esc_html('Secretaria de Gobierno'); ?></h5>
						<ul class="msm-submenu">
							<?php while ($related_query->have_posts()):
								$related_query->the_post(); ?>
								<li class="cat-item">
									<a href="<?php the_permalink() ?>" style="font-size: 16px;">
										<?php the_title(); ?>
									</a>
								</li>
							<?php endwhile; ?>
						</ul>
					</div>
				<?php endif;

				// Restablecer post data
				wp_reset_postdata();
			}
			?>
		</div>
	</div>
</div>

<?php get_template_part('templates/parts/encuesta_utilidad'); ?>
<?php get_template_part(THEME_FOOTER); ?>