<?php

/*
Template Name: Licencias de Conducir
*/
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
	<div class="row my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-9 order-1 order-md-2">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de
					Gobierno</a>/
				<a class="msm-breadcrumb-item"
					href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-gobierno">Secretaría de Gobierno</a>/
				<span class="msm-breadcrumb-item-last">Licencias de Conducir</span>
			</div>

			<div class="row">
				<span class="post-title" style="color: #0095da;">Licencias de Conducir</span>
				<span class="post-content mb-2" style="font-size:20px; color: #0095da; font-weight:bolder;">Gestioná tu
					licencia de manera rápida y sencilla</span>
				<p class="landing-subtitle">
					En esta sección encontrarás toda la información necesaria para <span
						style="font-weight: bold; color: #0095da;">obtener, renovar o modificar tu
						licencia de conducir</span>. Accedé a los requisitos, costos, documentos y pasos a seguir según
					el tipo de trámite que necesites realizar.<br>
					<span style="font-weight: bold; color: #0095da;">¡Conducir de forma segura y legal está a tu
						alcance!
					</span>
				</p>
				<div class="p-2">
					<div class="landing-alert">
						<span class="mt-5" style="color: #46595f;">
							Ahora podés <span style="font-weight: bold;">retirar tu licencia el mismo día</span>.
							Sólo tenés que esperar entre 20 y 30 minutos después de aprobar los exámenes teóricos
							y prácticos.
						</span>
					</div>
				</div>
				<span class="post-content mb-2" style="font-size:20px; color: #0095da; font-weight:bolder;">¿Cómo
					tramitar la Licencia de Conducir?</span>
				<div class="btn-title">Si tenés que sacar tu Licencia de Conducir por primera vez, renovarla, ampliar la
					categoría o hacer un duplicado, segui los siguientes pasos </div>
				<div class="col-md-3 p-2">
					<a href="/guia-tramites/licencias-conducir/"
						class="card text-decoration-none btn-licencias border-0" style="background: #6D9EA3;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column align-items-center">
									<div class="d-flex justify-content-center">
										<div class="circle">
											<span class="btn-licencias-title">1</span>
										</div>
									</div>
									<h5 class="card-title" style="color: #46595f;font-weight:600">INFORMATE</h5>
									<span class="card-text" style="color: #f9fafc;">
										Conocé los requisitos, costos y duración en nuestra <b
											style="color: #46595f">Guía de Trámites</b>.
									</span>
									<div class="w-100 d-flex justify-content-end mt-4">
										<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg"
											style="height: 40px;" alt="...">
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 p-2">
					<a href="<?php echo HOME_URI; ?>/licencias/capacitate"
						class="card text-decoration-none btn-licencias border-0"
						style="background: rgb(155, 184, 184);">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column align-items-center">
									<div class="d-flex justify-content-center">
										<div class="circle">
											<span class="btn-licencias-title">2</span>
										</div>
									</div>
									<h5 class="card-title" style="color: #46595f;font-weight:600">CAPACITATE</h5>
									<span class="card-text">
										Descargá el <b style="color: #46595f">material de estudio necesario</b> para
										preparar
										<b style="color: #46595f">tu exámen</b>.
									</span>
									<div class="w-100 d-flex justify-content-end mt-4">
										<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg"
											style="height: 40px;" alt="...">
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 p-2">
					<a target="_blank"
						href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/ORIGINAL-AUTOEVALUATE-LICENCIAS.pdf'); ?>"
						class="card text-decoration-none btn-licencias border-0" style="background: #A2C1C3;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column align-items-center">
									<div class="d-flex justify-content-center">
										<div class="circle">
											<span class="btn-licencias-title">3</span>
										</div>
									</div>
									<h5 class="card-title" style="color: #46595f;font-weight:600">EVALUATE</h5>
									<span class="card-text">
										Realizá un <b style="color : #46595f">simulacro de exámen </b> para reforzar tus
										conocimientos.
									</span>
									<div class="w-100 d-flex justify-content-end mt-4">
										<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg"
											style="height: 40px;" alt="...">
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>

				<div class="col-md-3 p-2">
					<a href="<?php echo HOME_URI; ?>/licencias/turnos"
						class="card text-decoration-none btn-licencias border-0" style="background: #C4D3D3;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column align-items-center">
									<div class="d-flex justify-content-center">
										<div class="circle">
											<span class="btn-licencias-title">4</span>
										</div>
									</div>
									<h5 class="card-title" style="color: #46595f;font-weight:600">SOLICITÁ TU TURNO</h5>
									<span class="card-text">
										Reservá tu turno para tramitar tu <b style="color: #46595f"> licencia </b>.
									</span>
									<div class="w-100 d-flex justify-content-end mt-4">
										<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg"
											style="height: 40px;" alt="...">
									</div>
								</div>
							</div>
						</div>
					</a>
				</div>
			</div>

			<div class="row mt-5">
				<div class="col-12 col-md-9 h-100">
					<div class="licencias-decreto h-100">
						<img src="<?php echo THEME_URI; ?>/assets/images/decreto-icon.svg"
							style="height: 80px;margin-right:20px" alt="...">
						<p style="text-align: justify;">
							En adecuación a la Ley 13927 Decreto 532/09 toda modificación realizada en el Documento
							Nacional de Identidad (como el cambio de domicilio, por ejemplo) deberá ser informada y
							registrada en la Licencia de Conducir dentro de los 90 días de su realización. Es importante
							destacar que el incumplimiento de esta medida implicará la pérdida de validez de su
							Licencia, y deberán rendir nuevamente los exámenes teóricos y prácticos que correspondan.
						</p>
					</div>
				</div>
				<div class="col-12 col-md-3 h-100">
					<div style="background-color:#575756;border-radius:14px;" class="p-3 px-10 d-flex flex-column">
						<span class="text-white" style="font-size:20px;">¿Tenés multas?</span><br>
						<span class="text-white" style="font-size:16px">Consulta el estado de tus infracciones de
							Transito Municipales.</span>
						<a class="licencias-btn-consultar" href="https://autogestion.msm.gov.ar/login">
							CONSULTAR
						</a>
					</div>
				</div>
				<div class="col-12 mt-5">
					<div class="licencias-atencion d-flex flex-column">
						<span style="color:#DB9E3D;font-size:20px;margin-bottom:10px">IMPORTANTE</span>
						<ul style="text-align: justify;">
							<li>Si tu licencia fue retenida en un control de tránsito deberás resolver
								previamente tu situación en el juzgado interviniente.
							</li>
							<li>En caso de lluvia los exámenes prácticos serán reprogramados.
							</li>
							<li>
								Excluyente que tu DNI tenga domicilio en San Miguel y sea el último
								ejemplar (se acepta DNI DIGITAL).
							</li>
							<li>
								Si tu licencia está vencida por más de 90 días, deberás realizar exámen
								teórico/práctico.
							</li>
							<li>
								Jubilados +70 años: rinden exámen teórico/práctico anualmente. Quedan eximidos
								del pago del impuesto municipal.
							</li>
							<li>
								Si tu licencia está vencida, deberás asistir acompañado por una persona con licencia
								vigente para realizar el exámen práctico.
							</li>
							<li>
								Más información en la guía de trámites.
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>

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

	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>