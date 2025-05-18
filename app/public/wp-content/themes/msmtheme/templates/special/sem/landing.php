<?php


get_template_part(THEME_HEADER); ?>


<style>
	#map-container {
		width: 100%;
		height: 100%;
		overflow: hidden;
		position: relative;
	}
</style>
<?php

$args = array(
	'post_type' => 'post',
	'posts_per_page' => 10,
);
$event_query = new WP_Query($args);
?>

<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-3 order-2 order-md-1">
			<?php
			$terms = get_the_terms(get_the_ID(), 'area_gobierno');
			if ($terms && !is_wp_error($terms)) {
				$term = $terms[0];

				$args = array(
					'post_type' => 'page',
					'posts_per_page' => 10,
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
				<span class="msm-breadcrumb-item-last">Estacionamiento Medido</span>
			</div>
			<div class="row p-0">
				<div class="col-12">
					<span class="post-title" style="color: #0095da;">Estacionamiento Medido</span>
				</div>
				<span style="color:#1ab3ea;font-size:16px;margin-bottom:5px;margin-top:10px;">Registrate, comprá crédito
					y estacioná presionando en:</span>
				<div style="width:100%;display:flex;justify-content:start;margin-top:10px;">
					<a href="https://sem.msm.gov.ar/#/login"
						style="font-size:16px;text-decoration:none;background-color:#1ab3ea;color:white; padding-left:10px; padding-right:10px;padding-top:5px;padding-bottom:5px;border-radius:8px;">
						Estacionamiento Medido
					</a>
				</div>
			</div>

			<div class="row rounded mb-3 mt-4" style="background-color: #93D33E">
				<div class="col-12 text-white d-flex align-items-center items-center py-2 gap-2">
					<!-- <h2 class="align-items-center items-center">ZONA</h2>
					<h4>Estacionamiento</h4> -->
					<!-- <h4>Medido</h4> -->
				</div>
				<div class="col-12- col-md-9 pb-2 h-auto d-flex justify-content-center">
					<div class="row mb-4" id="map-container">
						<img id="map" class="rounded" src="<?php echo THEME_URI; ?>/assets/images/mapa_veredas_sem2.jpeg"
							alt="Mapa">
					</div>
				</div>
				<div
					class="col-12- col-md-3 d-flex justify-content-start flex-column align-content-start text-white text-center">
					<h2>HORARIO</h2>
					<h4>Estacionamiento <br>Medido</h4>
					<h4>Lunes a Viernes <br>8:00 a 20:00</h4>
					<h4>Sábados <br>8:00 a 13:00</h4>
				</div>
			</div>

			<div class="row rounded" style="background-color: #7dcaff">
				<div class="col-12 text-white d-flex align-items-center items-center py-2 gap-2">
					<h2 class="align-items-center items-center">Puntos de venta</h2>
				</div>
				<div class="col-12 pb-2 h-auto">
					<style>
						.embed-container {
							position: relative;
							padding-bottom: 75%;
							height: 0;
							max-width: 100%;
						}

						.embed-container iframe,
						.embed-container object,
						.embed-container iframe {
							position: absolute;
							top: 0;
							left: 0;
							width: 100%;
							height: 500px;
						}

						small {
							position: absolute;
							z-index: 40;
							bottom: 0;
						}
					</style>
					<iframe title="Web MSM - Mapa de Estacionamiento Medido"
						src="https://mapas.msm.gov.ar/portal/apps/Embed/index.html?webmap=dda2efa2307a4e3a9c9100806166f724&amp;extent=-58.7244,-34.5526,-58.6927,-34.5373&amp;home=true&amp;zoom=true&amp;scale=false&amp;search=true&amp;searchextent=false&amp;disable_scroll=false&amp;theme=dark"
						height="300" width="100%" frameborder="0" marginwidth="0" marginheight="0"
						scrolling="no"></iframe>
				</div>
			</div>

			<div class="row p-2 mt-3">
				<strong class="post-content" style="font-size:20px; color: #0095da; font-weight:bolder;">Preguntas Frecuentes</strong>
				<div class="accordion" id="accordionQuestions">
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem" type="button" data-bs-toggle="collapse"
								data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
								¿Cuál es el valor de la hora?
							</button>
						</h2>
						<div id="collapse1" class="accordion-collapse collapse show"
							data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								El valor es de $450.
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false"
								aria-controls="collapse2">
								¿Cuál es la carga mínima que puedo hacer y la máxima?
							</button>
						</h2>
						<div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								Carga mínima $450 y máximo $10.000 (recarga virtual). En el punto de venta lo mínimo es
								una hora (estacionamiento puntual).
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false"
								aria-controls="collapse4">
								¿Cuál es el horario de estacionamiento pago?
							</button>
						</h2>
						<div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								De lunes a viernes de 8 a 20hs y sábados de 8 a 13hs
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false"
								aria-controls="collapse6">
								¿Qué pasa si no tengo datos o wifi?
							</button>
						</h2>
						<div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								Podrás cargar en los comercios adheridos a la carga puntual.
								www.msm.gov.ar/estacionamiento-medido-puntos-de-venta
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false"
								aria-controls="collapse7">
								¿Qué pasa si inicié el estacionamiento y se hacen las 20 hs y no finalicé el
								estacionamiento medido?
							</button>
						</h2>
						<div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								Lo corta el sistema
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false"
								aria-controls="collapse8">
								¿A qué hora finaliza el estacionamiento medido?
							</button>
						</h2>
						<div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								A las 20:00 y los sábados a las 13:00
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false"
								aria-controls="collapse9">
								¿Qué pasa si iniciado el estacionamiento me quedo sin crédito?
							</button>
						</h2>
						<div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								Si ud. se queda sin crédito, tendrá un saldo negativo que se cubre con la próxima
								recarga
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button accordion-sem collapsed" type="button"
								data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false"
								aria-controls="collapse10">
								¿No coloque el comprobante en el auto, me van a multar?
							</button>
						</h2>
						<div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#accordionQuestions">
							<div class="accordion-body">
								NO hace falta colocar el comprobante, ya que los fiscalizadores obtienen a través de su
								teléfono celular la información necesaria para proceder, están online con el sistema de
								estacionamiento
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>

<script src="<?php echo THEME_URI; ?>/assets/js/jquery.min.js"></script>