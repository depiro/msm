<?php

/*
Template Name: Boletín-oficial
template_name: boletín-oficial
*/
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
	<div class="msm-breadcrumb d-block d-sm-row pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home</a>/
		<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de gobierno</a>/
		<?php

		$terms = get_the_terms(get_the_ID(), 'area_gobierno');
		if ($terms && !is_wp_error($terms)):
			$term = array_shift($terms); // Tomar el primer término si hay varios
			?>
			<a class="msm-breadcrumb-item" href="<?php echo get_term_link($term); ?>">
				<?php echo esc_html($term->name); ?>
			</a>/
		<?php endif; ?>
		<span class="msm-breadcrumb msm-breadcrumb-item-last">Boletín Oficial</span>
	</div>

	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1">Boletín Oficial</h2>
			<!-- <p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel</p> -->
		</div>
		<div class="col-12 col-md-8">

			<div class="page-content fz-16 fw-400 msm-text-gray text-left row">
				<!-- <div class="d-flex flex-column justify-content-center">
					<span class="post-title" style="color: #0095da;">Boletín Oficial</span>
				</div> -->

				<!-- <div style="border-bottom:2px solid #1ab3ea;margin-top:20px;margin-bottom:20px; margin-top: 10px;"></div> -->

				<h3 class="msm-text-700 fw-600">Decretos 2025</h3>
				<div class="decretos-list d-flex row gap-2">

					<?php

					$children = get_children(array(
						'post_parent' => get_the_ID(),
						'post_type' => 'page',
						'post_status' => 'publish',
						'orderby' => 'menu_order',
						'order' => 'ASC'
					));

					if ($children):
						foreach ($children as $child):
							if (strpos($child->post_title, '2025') !== false): ?>
								<a class="fz-14 decreto-item" href="<?php echo get_permalink($child->ID); ?>">
									<?php echo esc_html($child->post_title); ?>
								</a>
							<?php endif;
						endforeach;
					else: ?>
						<span>No hay páginas disponibles.</span>
					<?php endif; ?>

				</div>
				<div style="border-bottom:2px solid #1ab3ea;margin-top:20px;margin-bottom:20px"></div>
				<h3 class="msm-text-700 fw-600">Decretos 2024</h3>
				<div class="decretos-list d-flex row gap-2 mt-2">

					<?php

					$children = get_children(array(
						'post_parent' => get_the_ID(),
						'post_type' => 'page',
						'post_status' => 'publish',
						'orderby' => 'menu_order',
						'order' => 'ASC'
					));

					if ($children):
						foreach ($children as $child):
							if (strpos($child->post_title, '2024') !== false): ?>
								<a class="fz-14 decreto-item" href="<?php echo get_permalink($child->ID); ?>">
									<?php echo esc_html($child->post_title); ?>
								</a>
							<?php endif;
						endforeach;
					else: ?>
						<span>No hay páginas disponibles.</span>
					<?php endif; ?>

				</div>


				<div style="border-bottom:2px solid #1ab3ea;margin-top:20px;margin-bottom:20px;"></div>
				<h3 class="msm-text-700 fw-600 mt-2">Ordenanzas</h3>
				<div class="d-flex flex-column">
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/02/ordenanza-fiscal-y-tarifaria-2025.pdf') ?>">Ordenanza
						fiscal y tarifaria 2025</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/02/calendario-fiscal-TISH-2025.pdf') ?>">Calendario
						fiscal TISH 2025</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/02/calendario-fiscal-TSM-2025.pdf') ?>">Calendario
						fiscal TSM 2025</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/02/OM-15_2023-Carga-y-Descarga.pdf') ?>">Ordenanza
						15-2023 Carga y descarga - Cajón azul</a>

					<a target="_blank"
						href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/ORDENANZA-FISCAL-Y-TARIFARIA-2024.pdf') ?>">Ordenanza
						fiscal y tarifaria 2024</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/ORDENANZA-CONVENIOS-B.pdf') ?>">Ordenanza
						convenios "B"</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/ORDENANZA-5-2023.pdf') ?>">ORDENANZA
						N°5 Cambio de circulación de la calle Rivera</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/ORDENANZA-6-2023.pdf') ?>">ORDENANZA
						N°6 Cambio de circulación de las calles Pasaje Indio, Pasaje San Miguel, Rosetti, Dorrego y José
						M. Rosa</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/ORDENANZA-7-2023.pdf') ?>">ORDENANZA
						N°7 Incorporación obligatoria de estudios prenatales</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/02/ORDENANZA-39-2012-AVU-Biodiesel.pdf') ?>">ORDENANZA
						39-2012 Aceite vegetal</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/02/Ordenanza-n°-595-82.pdf') ?>">Ordenanza
						nº 595/82</a>
					<a target="_blank"
						href="<?php echo home_url('/wp-content/uploads/2025/05/FISCAL_Y_TARIFARIA_2024.pdf') ?>">Ordenanza
						Fiscal y Tarifaria 2024</a>
				</div>
			</div>
		</div>		
		
		<!-- Sidebar -->
		<div class="col-12 col-md-4">
		</div>

	</div>
</div>
<?php get_template_part('templates/parts/encuesta_utilidad'); ?>
<?php get_template_part(THEME_FOOTER); ?>
<!-- archive boletin oficial -->