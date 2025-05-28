<?php

get_template_part(THEME_HEADER); ?>


<div id="main-content" class="container mb-5">
	<div class="row my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-10 col-lg-9 px-0">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2">Licencias</a>/
				<span class="msm-breadcrumb-item-last">Turnos</span>
			</div>

			<div class="row p-0">
				<div class="p-2 col-12 col-md-6">
					<a href="https://citasweb.msm.gov.ar/CitasWeb/" class="btn shadow text-decoration-none rounded msm-bg-400 text-white w-100 border-0 p-2 py-3">
						<h6>TURNO PARA <br> RENOVAR AMPLIAR O DUPLICAR</h6>
					</a>
				</div>
				<div class="p-2 col-12 col-md-6">
					<a href="<?php echo HOME_URI; ?>/licencias/primer-licencia" class="btn shadow text-decoration-none rounded bg-secondary text-white w-100 border-0 p-2 py-3">
						<h6>SACÁ TU <br>PRIMER LICENCIA</h6>
					</a>
				</div>
			</div>
			<div style="border-bottom:4px solid #1ab3ea;margin-top:20px;margin-bottom:20px"></div>

			<div class="row gap-0 px-2">
				<div class="col-12 col-md-6 d-flex flex-column px-0">
					<span class="msm-bg-400 text-white p-3 mb-2">FORMAS DE PAGO</span>
					<ul>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Efectivo</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 msm-text-500">Tarjeta de débito de banco físico</span>
						</li>
					</ul>
				</div>
				<div class="col-12 col-md-6 d-flex flex-column px-0">
					<span class="bg-danger text-white p-3 mb-2">NO SE PUEDE ABONAR CON </span>
					<ul>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 text-danger">Tarjetas de crédito</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 text-danger">Billeteras virtuales</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 text-danger">QR</span>
						</li>
						<li class="p-2 fz-16">
							<span class="text-decoration-none border-0 text-danger">Mercado Pago</span>
						</li>
					</ul>
				</div>
			</div>
			<div style="border-bottom:4px solid #1ab3ea;margin-top:20px;margin-bottom:20px"></div>
			<div class="row d-flex justify-content-center align-items-center msm-text-gray px-3">
				<h6 class="msm-text-600">ATENCIÓN</h6>
				<ul>
					<li>
						Presentarse 10 minutos antes del Turno y Registrarse en el Tótem de la entrada con su Número de DNI.
					</li>
					<li>
						En caso de no poder asistir al turno asignado, deberá cancelar el mismo.
					</li>
					<li>
						La Dirección Provincial de Política y Seguridad Vial dispone la prórroga, por el término de 24 meses corridos (2 años), para los vencimientos de las Licencias de Conducir cuya caducidad esté comprendida entre el 15 de febrero y el 31 de diciembre de 2020, inclusive, a partir de la fecha de vencimiento correspondiente.
						La Dirección Provincial de Política y Seguridad Vial dispone la prórroga, por el término de 18 meses (1 año y medio), para los vencimientos de las Licencias de Conducir cuya caducidad esté comprendida entre el 01 de enero y el 31 de diciembre de 2021 , inclusive, a partir de la fecha de vencimiento correspondiente.
					</li>
				</ul>
			</div>

		</div>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>