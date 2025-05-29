<?php

/*
Template Name: Licencias de Conducir
*/
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
	<div class="msm-breadcrumb d-block d-sm-row pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de
			Gobierno</a>/
		<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno/secretaria-de-gobierno">Secretaría de Gobierno</a>/
		<span class="msm-breadcrumb-item-last">Licencias de Conducir</span>
	</div>

	<div class="row my-md-5">
	<div class="col-12 py-5">
		<h2 class="msm-font-xl mb-1">Licencias de Conducir</h2>
		<p class="fz-18">En esta sección encontrarás toda la información necesaria para <span
			style="font-weight: bold; color: #0095da;">obtener, renovar o modificar tu
			licencia de conducir</span>. Accedé a los requisitos, costos, documentos y pasos a seguir según
		el tipo de trámite que necesites realizar.<br>
		<span style="font-weight: bold; color: #0095da;">¡Conducir de forma segura y legal está a tu alcance!</span></p>
	</div>
</div>

<div class="row">
	<div class="col-12 col-md-8">
		<div class="row">
			<div class="p-2">
				<div class="landing-alert">
					<span class="mt-5" style="color: #46595f;">
						Ahora podés <span style="font-weight: bold;">retirar tu licencia el mismo día</span>.
						Sólo tenés que esperar entre 20 y 30 minutos después de aprobar los exámenes teóricos
						y prácticos.
					</span>
				</div>
			</div>
			<span class="post-content mb-2" style="font-size:20px; color: #0095da; font-weight:bolder;">¿Cómo tramitar la Licencia de Conducir?</span>
			<div class="btn-title">Si tenés que sacar tu Licencia de Conducir por primera vez, renovarla, ampliar la
				categoría o hacer un duplicado, seguí los siguientes pasos </div>

			<!-- Tarjetas paso a paso -->
			<div class="col-md-3 p-2"> ... </div>
			<div class="col-md-3 p-2"> ... </div>
			<div class="col-md-3 p-2"> ... </div>
			<div class="col-md-3 p-2"> ... </div>
		</div>

		<!-- Texto informativo -->
		<div class="row mt-5">
			<div class="col-12 col-md-9 h-100">
				<div class="licencias-decreto h-100">
					<img src="<?php echo THEME_URI; ?>/assets/images/decreto-icon.svg"
						style="height: 80px;margin-right:20px" alt="...">
					<p style="text-align: justify;">
						En adecuación a la Ley 13927 Decreto 532/09 toda modificación realizada en el Documento
						Nacional de Identidad (como el cambio de domicilio, por ejemplo) deberá ser informada y
						registrada en la Licencia de Conducir dentro de los 90 días de su realización...
					</p>
				</div>
			</div>
			<div class="col-12 mt-5">
				<div class="licencias-atencion d-flex flex-column">
					<span style="color:#DB9E3D;font-size:20px;margin-bottom:10px">IMPORTANTE</span>
					<ul style="text-align: justify;">
						<li>Si tu licencia fue retenida en un control de tránsito...</li>
						<!-- demás ítems -->
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- SIDEBAR -->
	<div class="col-12 col-md-4">
		<!-- <aside class="sidebar-card p-3 rounded shadow-sm">
			<p class="text-white mb-4 fs-6">Tramitación y aprobación de permisos relacionados con construcciones...</p>
			<h5 class="text-acento fw-bold mb-2">Horario de atención</h5>
			<ul class="list-unstyled text-white text-sm mb-4 ps-2">
				<li>Lunes a Sábados de 8:00 a 14:00 hs.</li>
			</ul>
			<h5 class="text-acento fw-bold mb-2">Contacto</h5>
			<ul class="list-unstyled text-white text-sm ps-2">
				<li><strong>Teléfono:</strong> (11) 60917130 <strong>interno</strong> 6330</li>
				<li><strong>Email:</strong> info.empleo@msm.gov.ar</li>
				<li><strong>Instagram:</strong> <a href="https://www.instagram.com/obras_particulares/" target="_blank">bras_particulares</a></li>
			</ul>
		</aside> -->
	</div>
</div>


</div>

<?php get_template_part(THEME_FOOTER); ?>