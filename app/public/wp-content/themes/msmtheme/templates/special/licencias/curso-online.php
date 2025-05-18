<?php

get_template_part(THEME_HEADER); ?>


<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-3 order-2 order-md-1">
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
		<div class="col-12 col-md-9 order-1 order-md-2">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno</a>/
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-gobierno">Secretaría de Gobierno</a>/
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2">Licencias de Conducir</a>/
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2__trashed/turnos">Turnos</a>/
				<a class="msm-breadcrumb-item"
					href="<?php echo HOME_URI; ?>/licencias-2__trashed/primer-licencia">Primera Licencia</a>/
				<span class="msm-breadcrumb-item-last">Cursos Online</span>
			</div>

			<div class="row p-0 justify-content-center">
				<div class="col-12">
					<span class="landing-title">Curso teórico online</span>
					<p class="landing-subtitle">
						Accedé a una selección de videos de cursos teóricos online. Aprende a tu propio ritmo y repasa
						los temas las veces que necesités para estar listo para tu examen
					</p>
				</div>
			</div>

			<div class="row px-0">
				<div class="col-12 col-md-6 d-flex flex-column p-3">
					<div class="p-3" style="background-color:#E5EFF3;border-radius:11px">
						<div class="d-flex justify-content-between">
							<span class="msm-text-600 mb-2">
								<h4 style="font-weight: 700;">MÓDULO 1</h4>
							</span>
						</div>
						<div class="mb-2"
							style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
							<iframe src="https://www.youtube.com/embed/rzw1onXwA2E?feature=oembed" frameborder="0"
								allowfullscreen
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
						</div>
						<div class="d-flex justify-content-end align-items-center px-3 py-2">
							<a target="_blank"
								href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MÓDULO-1.pdf') ?>"
								class="text-decoration-none msm-text-600  rounded fz-14 align-center">Material
								Bibliográfico <img src="<?php echo THEME_URI; ?>/assets/images/download_icon.svg"
									style="height: 20px;" alt="..."></a>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 d-flex flex-column p-3">
					<div class="p-3" style="background-color:#E5EFF3;border-radius:11px">
						<div class="d-flex justify-content-between">
							<span class="msm-text-600 mb-2">
								<h4 style="font-weight: 700;">MÓDULO 2</h4>
							</span>
						</div>
						<div class="mb-2"
							style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
							<iframe src="https://www.youtube.com/embed/sXcBMZKtwMA?feature=oembed" frameborder="0"
								allowfullscreen
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
						</div>
						<div class="d-flex justify-content-end align-items-center px-3 py-2">
							<a target="_blank"
								href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MÓDULO-2.pdf') ?>"
								class="text-decoration-none msm-text-600  rounded fz-14 align-center">Material
								Bibliográfico <img src="<?php echo THEME_URI; ?>/assets/images/download_icon.svg"
									style="height: 20px;" alt="..."></a>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 d-flex flex-column p-3">
					<div class="p-3" style="background-color:#E5EFF3;border-radius:11px">
						<div class="d-flex justify-content-between">
							<span class="msm-text-600 mb-2">
								<h4 style="font-weight: 700;">MÓDULO 3</h4>
							</span>
						</div>
						<div class="mb-2"
							style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
							<iframe src="https://www.youtube.com/embed/7HCdk7JmgqY?feature=oembed" frameborder="0"
								allowfullscreen
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
						</div>
						<div class="d-flex justify-content-end align-items-center px-3 py-2">
							<a target="_blank"
								href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MÓDULO-3.pdf') ?>"
								class="text-decoration-none msm-text-600  rounded fz-14 align-center">Material
								Bibliográfico <img src="<?php echo THEME_URI; ?>/assets/images/download_icon.svg"
									style="height: 20px;" alt="..."></a>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 d-flex flex-column p-3">
					<div class="p-3" style="background-color:#E5EFF3;border-radius:11px">
						<div class="d-flex justify-content-between">
							<span class="msm-text-600 mb-2">
								<h4 style="font-weight: 700;">MÓDULO 4</h4>
							</span>
						</div>
						<div class="mb-2"
							style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
							<iframe src="https://www.youtube.com/embed/7hjGSrCYobU?feature=oembed" frameborder="0"
								allowfullscreen
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
						</div>
						<div class="d-flex justify-content-end align-items-center px-3 py-2">
							<a target="_blank"
								href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MÓDULO-4.pdf') ?>"
								class="text-decoration-none msm-text-600  rounded fz-14 align-center">Material
								Bibliográfico <img src="<?php echo THEME_URI; ?>/assets/images/download_icon.svg"
									style="height: 20px;" alt="..."></a>
						</div>
					</div>
				</div>

				<div class="col-12 col-md-6 d-flex flex-column p-3">
					<div class="p-3" style="background-color:#E5EFF3;border-radius:11px">
						<div class="d-flex justify-content-between">
							<span class="msm-text-600 mb-2">
								<h4 style="font-weight: 700;">MÓDULO 5</h4>
							</span>
						</div>
						<div class="mb-2"
							style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
							<iframe src="https://www.youtube.com/embed/MU20b2N2qxk?feature=oembed" frameborder="0"
								allowfullscreen
								style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"></iframe>
						</div>
						<div class="d-flex justify-content-end align-items-center px-3 py-2">
							<a target="_blank"
								href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MÓDULO-5.pdf') ?>"
								class="text-decoration-none msm-text-600  rounded fz-14 align-center">Material
								Bibliográfico <img src="<?php echo THEME_URI; ?>/assets/images/download_icon.svg"
									style="height: 20px;" alt="..."></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>