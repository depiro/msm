<?php

/*
Template Name: Botetín-oficial
template_name: Botetín_oficial
*/
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
	<div class="row my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-11 col-lg-10 px-0">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last">Licencias</span>
			</div>

			<div class="row">
				<div class="col-md-3 p-2">
					<a class="card text-decoration-none btn-licencias border-0" style="background: #0e769c;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column">
									<h5 class="card-title">Informate</h5>
									<span class="card-text">
										Conocé los requisitos, costos y duración en nuestra Guia de Tramites.
									</span>
								</div>
								<img src="<?php echo HOME_URI; ?>/wp-content/themes/msmtheme/assets/images/ico-link-lic01.png" alt="Turnos" height="60">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 p-2">
					<a href="<?php echo HOME_URI; ?>/licencias/capacitate" class="card text-decoration-none btn-licencias border-0" style="background: #0293c8;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column">
									<h5 class="card-title">Capacitate</h5>
									<span class="card-text">
										Encontrá todo el material necesario para preparar tu examen.
									</span>
								</div>
								<img src="<?php echo HOME_URI; ?>/wp-content/themes/msmtheme/assets/images/ico-link-lic02.png" alt="Turnos" height="60">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 p-2">
					<a href="https://www.gob.gba.gov.ar/portal/portalgba/dppsv/cuestionario.pdf" class="card text-decoration-none btn-licencias border-0" style="background: #06a5df;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column">
									<h5 class="card-title">Evaluate</h5>
									<span class="card-text">
										Realizá un simulacro de de examen y reforzá tus conocimientos.
									</span>
								</div>
								<img src="<?php echo HOME_URI; ?>/wp-content/themes/msmtheme/assets/images/ico-link-lic03.png" alt="Turnos" height="60">
							</div>
						</div>
					</a>
				</div>
				<div class="col-md-3 p-2">
					<a href="<?php echo HOME_URI; ?>/licencias/turnos" class="card text-decoration-none btn-licencias border-0" style="background: #1dc0fb;">
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<div class="d-flex flex-column">
									<h5 class="card-title">Solicitá un turno</h5>
									<span class="card-text">
										Reservá tu turno para tramitar tu Licencia
									</span>
								</div>
								<img src="<?php echo HOME_URI; ?>/wp-content/themes/msmtheme/assets/images/ico-link-lic04.png" alt="Turnos" height="60">
							</div>
						</div>
					</a>
				</div>
			</div>

		</div>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>