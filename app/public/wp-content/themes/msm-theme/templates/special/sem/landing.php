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
	<div class="msm-breadcrumb d-block d-sm-row pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de
			Gobierno</a>/
		<a class="msm-breadcrumb-item"
			href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-gobierno">Secretaría de Gobierno</a>/
		<span class="msm-breadcrumb-item-last">Estacionamiento Medido</span>
	</div>	

	<div class="row my-3 my-md-5 px-3 justify-content-center mb-5">		
		<div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1 post-title">Estacionamiento Medido</h2>
			<p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel</p>
		</div>

		<div class="col-12 col-md-8">
			<div class="alert alert-info p-4 my-4">
			<h4 class="mb-3 fz-22 fw-600">Registrate, comprá crédito y estacioná presionando en:</h4>
			<a class="btn btn-primary btn-lg text-white text-decoration-none" href="https://sem.msm.gov.ar/#/login" target="_blank">
				Estacionamiento Medido
			</a>
			</div>


			<div class="row rounded mb-5 mt-4">
				<div class="col-12 d-flex align-items-center py-2 gap-2 bg-primary-subtle">
					<h3 class="mb-0">ZONA Estacionamiento Medido</h3>
				</div>

				<div class="col-12 col-md-9 pb-2 d-flex justify-content-center">
					<div id="map-container" class="mb-4">
						<img id="map" class="rounded" src="<?php echo THEME_URI; ?>/assets/images/mapa_veredas_sem2.jpeg" alt="Mapa">
					</div>
				</div>

				<div class="col-12 col-md-3 d-flex justify-content-start flex-column">
					<h3>Horario</h3>
					<h4 class="mb-2">Estacionamiento Medido</h4>
					<p class="mb-2">Lunes a Viernes <br>8:00 a 20:00</p>
					<p class="mb-0">Sábados <br>8:00 a 13:00</p>
				</div>
			</div>


			<div class="row rounded bg-primary-subtle mb-5">
				<div class="col-12 d-flex align-items-center items-center py-2 gap-2">
					<h3>Puntos de venta</h3>
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

			
				<h3 class="mb-3">Preguntas Frecuentes</h3>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿Cuál es el valor de la hora?</summary>
  <p class="mt-3 mb-0">El valor es de $450.</p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿Cuál es la carga mínima que puedo hacer y la máxima?</summary>
  <p class="mt-3 mb-0">Carga mínima $450 y máximo $10.000 (recarga virtual). En el punto de venta lo mínimo es una hora (estacionamiento puntual).</p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿Cuál es el horario de estacionamiento pago?</summary>
  <p class="mt-3 mb-0">De lunes a viernes de 8 a 20 hs y sábados de 8 a 13 hs.</p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿Qué pasa si no tengo datos o wifi?</summary>
  <p class="mt-3 mb-0">Podrás cargar en los comercios adheridos a la carga puntual.<br><a href="https://www.msm.gov.ar/estacionamiento-medido-puntos-de-venta" target="_blank">www.msm.gov.ar/estacionamiento-medido-puntos-de-venta</a></p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿Qué pasa si inicié el estacionamiento y se hacen las 20 hs y no finalicé el estacionamiento medido?</summary>
  <p class="mt-3 mb-0">Lo corta el sistema.</p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿A qué hora finaliza el estacionamiento medido?</summary>
  <p class="mt-3 mb-0">A las 20:00 y los sábados a las 13:00.</p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿Qué pasa si iniciado el estacionamiento me quedo sin crédito?</summary>
  <p class="mt-3 mb-0">Si te quedás sin crédito, tendrás un saldo negativo que se cubre con la próxima recarga.</p>
</details>

<details class="my-4">
  <summary class="fz-22 fw-600 cursor-pointer">¿No coloqué el comprobante en el auto, me van a multar?</summary>
  <p class="mt-3 mb-0">No hace falta colocar el comprobante, ya que los fiscalizadores acceden online al sistema desde sus teléfonos.</p>
</details>

				
		</div>
		
		<div class="col-12 col-md-4">
		
		</div>

	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>

<script src="<?php echo THEME_URI; ?>/assets/js/jquery.min.js"></script>