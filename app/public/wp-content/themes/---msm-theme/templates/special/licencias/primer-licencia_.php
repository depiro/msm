<?php

get_template_part(THEME_HEADER); ?>


<div id="main-content" class="container mb-5">
	<div class="row my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-10 col-lg-9 px-0">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2">Licencias</a>/
				<span class="msm-breadcrumb-item-last">Primer Licencia</span>
			</div>

			<div class="row p-0">
				<div class="p-2 col-12 col-md-6">
					<a href="https://citasweb.msm.gov.ar/CitasWeb/" class="btn shadow text-decoration-none rounded msm-bg-400 text-white w-100 border-0 p-2 py-3">
						CURSO PRESENCIAL
					</a>
				</div>
				<div class="p-2 col-12 col-md-6">
					<a href="<?php echo HOME_URI; ?>/licencias/curso-online" class="btn shadow text-decoration-none rounded bg-secondary text-white w-100 border-0 p-2 py-3">
						CURSO ONLINE
					</a>
				</div>
			</div>
			<div style="border-bottom:4px solid #1ab3ea;margin-top:20px;margin-bottom:20px"></div>

			<div class="row gap-0 px-2">
				<div class="col-12 col-md-6 d-flex flex-column px-0">
					<span class="msm-text-600 p-3 mb-2 fz-20">Beneficios de realizar el curso virtual:</span>
					<ul>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Menor tiempo de trámite en comparación con el trámite presencial (Hasta 1hs más rápido)</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Mayor disponibilidad de turnos.</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Lo realizas desde la comodidad de tu casa.</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Se ajusta a tu disponibilidad horaria.</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Lo podes ver las veces que consideres necesario.</span>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>