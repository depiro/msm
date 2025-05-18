<?php

get_template_part(THEME_HEADER);

function procesar_meta_value($meta_value)
{
	if (is_array($meta_value) && isset($meta_value['address'])) {
		return esc_html($meta_value['address']); // Devolver solo la dirección
	}
	return esc_html($meta_value); // Si no es un array, devolver el valor normal
}

?>

<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-3 order-2 order-md-1">
			<div class="menuCul">
				<h5 class="py-2">Secretaría de Salud</h5>
				<ul class="msm-submenu">
					<li class="cat-item">
						<a href="https://www-dev.msm.gov.ar/calendario-de-vacunacion/" style="font-size: 16px;">
							Calendario de Vacunación</a>
					</li>
					<li class="cat-item">
						<a href="https://www-dev.msm.gov.ar/direccion-de-discapacidad/" style="font-size: 16px;">
							Dirección de Discapacidad </a>
					</li>
					<li class="cat-item">
						<a href="https://www-dev.msm.gov.ar/vacunatorios/" style="font-size: 16px;">
							Vacunatorios </a>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-12 col-md-9 order-1 order-md-2">
			<div class="msm-breadcrumb d-block d-sm-row px-0">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home</a>/
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de
					Gobierno</a>/
				<a class="msm-breadcrumb-item"
					href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-salud">Secretaría de Salud</a>/
				<span class="msm-breadcrumb msm-breadcrumb-item-last">Centros de Salud</span>
			</div>

			<div class="page-content fz-16 fw-400 msm-text-gray text-left row">
				<h2 class="msm-text-600">Centros de Salud</h2>
				<p>
					El Centro de Salud es el primer contacto que toman las personas con el sistema de salud público y
					donde se efectúan las primeras acciones de asistencia sanitaria. Sus servicios están adaptados a las
					necesidades de la comunidad de cada barrio en particular.
				</p>

				<iframe height="600px" title="Web MSM - Mapa de Centros de Salud"
					src="https://mapas.msm.gov.ar/portal/apps/Embed/index.html?webmap=602f0882447f4a43b0f6c58976d3ec87&amp;extent=-58.7244,-34.5526,-58.6927,-34.5373&amp;home=true&amp;zoom=true&amp;scale=false&amp;search=true&amp;searchextent=false&amp;disable_scroll=false&amp;theme=dark&amp;"
					height="300" width="100%" frameborder="0" marginwidth="0" marginheight="0" scrolling="no"></iframe>

				<?php
				// Obtener el valor de búsqueda si existe
				$search_query = isset($_GET['buscar']) ? sanitize_text_field($_GET['buscar']) : '';
				?>

				<!-- Formulario de búsqueda -->
				<form method="GET" action="" class="mb-4 w-100 d-flex flex-row mt-5 gap-2">
					<input type="text" name="buscar" value="<?php echo esc_attr($search_query); ?>"
						placeholder="Buscar centro de salud..." class="form-control w-100 d-inline">
					<button type="submit" class="btn" style="background-color: #1ab3ea; color:white;">Buscar</button>
					<?php if (!empty($search_query)): ?>
						<a href="<?php echo esc_url(remove_query_arg('buscar')); ?>" class="btn "
							style="background-color:#99C210; color:white;">Limpiar</a>
					<?php endif; ?>
				</form>

				<?php
				// Definir argumentos de la consulta
				$args = array(
					'post_type' => 'centros_salud',
					'post_status' => 'publish',
					'posts_per_page' => -1,
				);

				// Si se ingresó un término de búsqueda, agregar filtro por título
				if (!empty($search_query)) {
					$args['s'] = $search_query;
				}

				$centros_salud = new WP_Query($args);

				if ($centros_salud->have_posts()):
					echo '<div class="centros-salud-list">';

					while ($centros_salud->have_posts()):
						$centros_salud->the_post();
						// Obtener los campos personalizados
						$ubicacion = get_post_meta(get_the_ID(), 'ubicacion', true);
						$direccion = get_post_meta(get_the_ID(), 'direccion', true);

						$direccion_completa = '';

						if (is_array($ubicacion) && isset($ubicacion['address'])) {
							$direccion_completa = esc_html($ubicacion['address']);
						} else {
							$direccion_completa = esc_html($ubicacion) . ' | ' . esc_html($direccion);
						}

						$localidad = get_post_meta(get_the_ID(), 'localidad', true);
						$telefono = get_post_meta(get_the_ID(), 'telefono', true);
						$horario_apertura = get_post_meta(get_the_ID(), 'horario_apertura', true);
						$horario_cierre = get_post_meta(get_the_ID(), 'horario_cierre', true);
						$especialidades = get_post_meta(get_the_ID(), 'especialidades', false);
						$atiende_24hs = get_post_meta(get_the_ID(), 'atiende_24hs', true);
						?>
						<div class="centro-salud-item my-4 p-4 rounded" style="border:3px solid #dedede;">
							<span class="fz-20 mb-3"><strong><?php the_title(); ?></strong></span>
							<div class="row my-2 gap-3 px-3 mt-3 justify-content-end">
								<?php
								if (is_array($especialidades[0]) && !empty($especialidades)) {
									foreach ($especialidades[0] as $especialidad) { ?>
										<span
											class="fz-14 msm-bg-300 text-white rounded px-2 py-1 col-auto"><?php echo esc_html($especialidad) ?></span>
									<?php }
								}
								?>
							</div>
							<div class="d-flex justify-content-between mb-3">
								<div class="d-flex flex-column mb-2">
									<span class="fz-12 py-0" style="color:#bababa !important;">Dirección</span>
									<span class="fz-14 py-0"><?php echo $direccion_completa; ?></span>
								</div>
							</div>
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column mb-2">
									<span class="fz-12 py-0" style="color:#bababa !important;">Horario</span>
									<div>
										<span class="fz-14"><?php echo esc_html($horario_apertura); ?></span>
										<span class="fz-14"><?php echo esc_html($horario_cierre); ?></span>
									</div>
								</div>
								<div class="d-flex flex-column justify-content-end py-2">
									<a href="<?php the_permalink(); ?>"
										class="btn fz-12 msm-bg-500 text-white rounded px-2 py-1">Más Info</a>
								</div>
							</div>
						</div>
					<?php endwhile;

					echo '</div>';
					wp_reset_postdata();
				else:
					?>
					<span>No hay centros de salud disponibles.</span>
				<?php endif; ?>


			</div>
		</div>
	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
<!-- archive centros salud -->