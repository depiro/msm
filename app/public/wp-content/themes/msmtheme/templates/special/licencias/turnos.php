<?php

get_template_part(THEME_HEADER); ?>


<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-3 order-2 order-md-1">
			<?php
			$terms = get_the_terms(get_the_ID(), 'area_gobierno');
			if ($terms && !is_wp_error($terms)) {
				$term = $terms[0]; // Suponiendo que hay al menos un término
			
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
		<div class="col-12 col-md-9 order-1 order-md-2">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de
					Gobierno</a>/
				<a class="msm-breadcrumb-item"
					href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-gobierno">Secretaría de Gobierno</a>/
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2">Licencias de Conducir</a>/
				<span class="msm-breadcrumb-item-last">Turnos</span>
			</div>

			<div class="row p-0">
				<div class="col-12">
					<span class="post-title" style="color: #0095da;">Turnos</span>
					<p class="landing-subtitle">
						Solicitá tu turno para <span style="font-weight: bold; color: #0095da;">obtener, renovar,
							ampliar o duplicar</span> tu licencia de conducir.
					</p>
				</div>
				<div class="col-12 d-flex justify-content-end gap-4 mt-4">
					<a href="https://citasweb.msm.gov.ar/CitasWeb/"
						class="btn shadow text-decoration-none rounded-xl bg-secondary text-white border-0 p-3 d-flex gap-2">
						Renovar ampliar o duplicar <img
							src="<?php echo THEME_URI; ?>/assets/images/right-arrow-white.svg" style="height: 20px;"
							alt="...">
					</a>
					<a href="<?php echo HOME_URI; ?>/licencias/primer-licencia"
						class="btn shadow text-decoration-none rounded-xl text-white border-0 p-3 d-flex gap-2"
						style="background-color:#0095da">
						Sacá tu primer licencia <img src="<?php echo THEME_URI; ?>/assets/images/right-arrow-white.svg"
							style="height: 20px;" alt="...">
					</a>
				</div>
			</div>

			<div class="row gap-0 px-2 mt-4">
				<div class="col-12 col-md-6 d-flex px-0 turnos-si-section align-items-start py-4"
					style="background-color:#80C367">
					<div class="d-flex justify-content-center align-items-center p-3">
						<img src="<?php echo THEME_URI; ?>/assets/images/check_circle_icon.svg" style="height: 70px;"
							alt="...">
					</div>
					<div>
						<span class="text-white py-5 fw-500 fz-20">FORMAS DE PAGO</span>
						<ul class="mt-3">
							<li class="fz-16">
								<span class="text-decoration-none border-0 text-white">Efectivo</span>
							</li>
							<li class="fz-16">
								<span class="text-decoration-none border-0 text-white">Tarjeta de débito de banco
									físico</span>
							</li>
							<li class="fz-16">
								<span class="text-decoration-none border-0 text-white">QR - Todas las billeteras
									virtuales (con dinero en cuenta)
								</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-12 col-md-6 d-flex px-0 turnos-no-section align-items-start py-4"
					style="background-color:#EE5363">
					<div class="d-flex justify-content-center align-items-center p-3">
						<img src="<?php echo THEME_URI; ?>/assets/images/close_circle_icon.svg" style="height: 70px;"
							alt="...">
					</div>
					<div>
						<span class="text-white py-5 fw-500 fz-20">NO SE PUEDE ABONAR CON </span>
						<ul class="mt-3">
							<li class="fz-16">
								<span class="text-decoration-none border-0 text-white">Tarjetas de crédito</span>
							</li>
							<li class="fz-16">
								<span class="text-decoration-none border-0 text-white">Transferencias bancarias</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-12 mt-5">
				<div class="licencias-atencion d-flex flex-column">
					<span style="color:#DB9E3D;font-size:20px;margin-bottom:10px">IMPORTANTE</span>
					<ul>
						<li>Presentarse 10 minutos antes del Turno y Registrarse en el Tótem de la entrada con su Número
							de DNI.</li>
						<li>
							En caso de no poder asistir al turno asignado, deberá cancelar el mismo.
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>