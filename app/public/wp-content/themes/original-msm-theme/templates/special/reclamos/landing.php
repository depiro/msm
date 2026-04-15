<?php

/*
Template Name: Reclamos
*/
get_template_part(THEME_HEADER); ?>

<?php 
	include(get_template_directory() . '/api/ApiWise.php');
	$api = new ApiWise();
	$motivos = $api->obtenerMotivos();
?>

<div id="main-content" class="container mb-5">
	<div class="row my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-10 px-0">
			<div class="msm-breadcrumb d-block d-sm-row">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last">Reclamos</span>
			</div>

			<div class="border-b"></div>

			<div id="nuevo-reclamo-container" class="d-block">
				<div class="d-flex justify-content-between mb-3">
					<span class="msm-text-400" style="font-size:24px;font-weight:bold;">HACÉ TU RECLAMO</span>
					<button id="estado-reclamo" class="btn w-auto bg-secondary py-2 text-white text-sm">
						Consultá el estado de tu reclamo
						<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg" style="height: 30px;" alt="...">
					</button>
				</div>
				<div class="mt-5">
					<p class="fz-14 msm-text-gray">
						Una vez cargado su reclamo, la dirección de atencion al vecino verificará los datos ingresados y le enviará un email confimando los mismos.
					</p>
				</div>
				<form action="" id="form_reclamo" name="form_reclamo">
					<input type="hidden" name="site_url" id="site_url" value="<?php echo get_bloginfo('url'); ?>/">
					<div class="row">
						<span class="fz-16 mb-2 fw-600 msm-text-black">Datos del vecino reclamante</span>

						<div class="mb-3 col-12 col-md-6 mt-1">
							<label for="TipoDocumento" class="form-label fw-600 msm-text-black">Tipo de Documento</label>
							<select class="form-select fz-14" name="TipoDocumento" id="TipoDocumento">
								<option value="DNI">DNI</option>
								<option value="LC">LC</option>
								<option value="LE">LE</option>
							</select>
						</div>

						<div class="mb-3 col-12 col-md-6">
							<label for="TipoDocumento" class="form-label fw-600 msm-text-black">Número de Documento</label>
							<input class="form-control" type="text" name="NumeroDocumento" id="NumeroDocumento">
							<p class="error" id="errorNumeroDocumento" style="display:none"></p>
						</div>

						<div class="mb-3 col-12 col-md-6">
							<label for="Apellido" class="form-label fw-600 msm-text-black">Apellido</label>
							<input class="form-control" type="text" name="Apellido" id="Apellido">
							<p class="error" id="errorApellido" style="display:none"></p>
						</div>

						<div class="mb-3 col-12 col-md-6">
							<label for="Nombre" class="form-label fw-600 msm-text-black">Nombre</label>
							<input class="form-control" type="text" name="Nombre" id="Nombre">
							<p class="error" id="errorNombre" style="display:none"></p>
						</div>

						<div class="mb-3 col-12 col-md-6">
							<label for="TelefonoDeContacto" class="form-label fw-600 msm-text-black">Teléfono De Contacto</label>
							<input class="form-control" type="text" name="TelefonoDeContacto" id="TelefonoDeContacto">
							<p class="error" id="errorContacto" style="display:none"></p>
						</div>


						<div class="mb-3 col-12 col-md-6">
							<label for="Email" class="form-label fw-600 msm-text-black">Email</label>
							<input class="form-control" type="text" name="Email" id="Email">
							<p class="error" id="errorEmail" style="display:none"></p>
						</div>
						<!-- 
						<div class="mb-3 col-12 col-md-6">
							<label for="calles_nombre" class="form-label fw-600 msm-text-black">Calle</label>
							<p class="error" id="errorIdCalle" style="display:none"></p>
							<select name="calles_nombre" id="calles_nombre" class="form-select fz-14">
								<option value="">Seleccione una Calle</option>
								<?php //$api->imprimirOpcionesCalle();?>
							</select>
							<input type="hidden" name="IdCalleVecino" id="IdCalleVecino">
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label for="AlturaCalleVecino" class="form-label fw-600 msm-text-black">Altura</label>
							<input class="form-control" type="text" name="AlturaCalleVecino" id="AlturaCalleVecino">
						</div> -->
					</div>
					<br />
					<div class="row">
						<span class="msm-text-gray fz-16 mb-2 fw-600 msm-text-black">Datos del Reclamo</span>
						<div class="mb-3 col-12 mt-1">
							<label for="IdMotivo" class="form-label fw-600 msm-text-black">Motivo</label>
							<select name="IdMotivo" id="IdMotivo" class="form-select fz-14">
								<option value="">Seleccione el motivo de su reclamo</option>
								<?php 
									foreach ($motivos as $motivo) {
										$name = ltrim($motivo['name'], '0123456789- ');
										if ($motivo['parent_id'] == 0) {
											echo "<option disabled style='font-size:20px' value='{$motivo['id']}'>{$name}</option>";
										} else {
											echo "<option value='{$motivo['id']}'>{$name}</option>";
										}
									}
								?>
							</select>
							<p class="error" id="errorIdMotivo" style="display:none"></p>
						</div>

						<!-- <div class="mb-3 col-12 col-md-6">
							<label for="usarMapa" class="form-label fw-600 msm-text-black">Seleccionar ubicación del reclamo en mapa?</label>
							<p class="error" id="errorIdMotivo" style="display:none"></p>
							<select name="usarMapa" id="usarMapa" class="form-select fz-14">
								<option value="si" selected="selected">Si</option>
								<option value="no">No</option>
							</select>
						</div>

						<div class="mb-3 col-12">
							<input type="text" name="ubicacion" id="ubicacion" value="" class="form-control">
							<div id="mapaReclamo" style="height:400px;width:100%"></div>
							<input type="hidden" name="lat" id="lat" value="">
							<input type="hidden" name="lng" id="lng" value="">
						</div>

						<div class="mb-3 col-12 col-md-6">
							<div id="contenedorCalleReclamo" class="hide">
								<label class="form-label fw-600 msm-text-black" for="calles_nombre_reclamo">Calle</label>
								<p class="error" id="errorIdCalleReclamo" style="display:none"></p>
								<select class="form-select fz-14" name="calles_nombre_reclamo" id="calles_nombre_reclamo">
									<option value="">Seleccione una Calle</option>
									<?php //$api->imprimirOpcionesCalle();?>
								</select>
								<input type="hidden" name="IdCalleReclamo" id="IdCalleReclamo">
							</div>
						</div>
						<div class="mb-3 col-12 col-md-6">
							<label class="form-label fw-600 msm-text-black" for="AlturaCalleReclamo">Altura</label>
							<input class="form-control" type="text" name="AlturaCalleReclamo" id="AlturaCalleReclamo">
						</div>

						<div class="mb-3 col-12">
							<label for="DetalleReclamo" class="form-label fw-600 msm-text-black">Detalle del reclamo</label>
							<p class="error" id="errorDetalleReclamo" style="display:none;"></p>
							<textarea class="form-control" name="DetalleReclamo" id="DetalleReclamo" cols="30" rows="10"></textarea>
						</div> -->

						<!-- <div class="mb-3 col-12">
							<label for="images">Fotos</label><br>
							<small>Puede subir multiples fotos para añadir al reclamo</small><br><br>
							<p class="error" id="errorImagenes" style="display:none; font-family: 'Roboto Condensed', sans-serif;color: #ff0000 !important;font-size: 15px !important;"></p>
							<input class="form-control fz-14" type="file" id="images" name="images[]" multiple="multiple" accept="image/*" />
						</div> -->
					</div>
					<div class="d-flex justify-content-end">
						<input class="form-control msm-bg-500 text-white mt-2 w-auto" type="button" name="enviar_reclamo" id="enviar_reclamo" value="Enviar Reclamo">
					</div>
				</form>
				<div id="success-msg" style="display:none;background-color:rgb(98, 174, 98);margin-top:20px;padding: 15px;border-radius: 8px;justify-content:space-between;">
					<div style="color:white;font-size: 16px;">
						Reclamo generado con éxito. Número de Reclamo : 
						<span style="color:white;font-size: 16px;"></span>
					</div>
					<button id="copy-btn" style="margin-left: 10px;background-color:rgb(141, 219, 141);color:rgb(66, 96, 66);border:none;border-radius: 4px;padding:4px;">Copiar</button>
				</div>
			</div>

			<div id="estado-reclamo-container" class="d-none">

				<div class="d-flex flex-col flex-md-row justify-content-between mb-3">
					<span class="text-secondary" style="font-size:24px;font-weight:bold;">CONSULTÁ EL ESTADO DE TU RECLAMO</span>
					<button id="nuevo-reclamo" class="btn w-auto msm-bg-400 py-2 text-white text-sm d-flex align-items-center">
						Hacé tu reclamo
						<img src="<?php echo THEME_URI; ?>/assets/images/rightarrow.svg" style="height: 30px;margin-left:10px;" alt="...">
					</button>
				</div>

				<form action="" id="form_consulta" name="form_consulta">
					<div class="row">

						<!-- <div class="mb-3 col-12 col-md-6">
							<label class="form-label fw-600 msm-text-black" for="numeroDocumentoConsulta">Número de Documento</label>
							<p class="error" id="errorConsulta" style="display:none"></p>
							<input class="form-control fz-14" type="text" id="numeroDocumentoConsulta" name="numeroDocumentoConsulta" placeholder="Ingrese el nro de documento">
							<input class="form-control msm-bg-500 text-white" type="button" name="enviar_consulta_doc" id="enviar_consulta_doc" value="Consultar">
						</div> -->

						<div class="mb-3 col-12">
							<label class="form-label fw-600 msm-text-black" for="numeroReclamo">Número de Reclamo</label>
							<input class="form-control fz-14" type="text" id="numeroReclamo" name="numeroReclamo"  placeholder="Ingrese el nro de reclamo">
						</div>
						<div class="d-flex justify-content-end">
							<button class="form-control msm-btn-submit text-white mt-2 w-auto" type="button" name="enviar_consulta_nro" id="enviar_consulta_nro">Consultar</button>
						</div>
					</div>
				</form>
				
                <div id="mensaje_exitoso_container" style="display:none">
                    <p class="exito"></p>
                </div>
                <div id="resultadosConsulta" class="resultados" style="display:none">
                </div>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo THEME_URI; ?>/assets/js/jquery.min.js"></script>
<!-- <script src="<?php echo THEME_URI; ?>/js/reclamosRestApi.js?v=<?php echo date('YmdHis') ?>"></script> -->
<script src="<?php echo THEME_URI; ?>/js/reclamosWiseApi.js?v=<?php echo date('YmdHis') ?>"></script>
<script>


	document.addEventListener('DOMContentLoaded', function() {
		let btnNuevoReclamo = document.querySelector('#nuevo-reclamo');
		let btnEstadoReclamo = document.querySelector('#estado-reclamo');
		let containerNuevoReclamo = document.querySelector('#nuevo-reclamo-container');
		let containerEstadoReclamo = document.querySelector('#estado-reclamo-container');

		if (btnNuevoReclamo && btnEstadoReclamo && containerNuevoReclamo && containerEstadoReclamo) {
			btnNuevoReclamo.addEventListener('click', function() {
				containerNuevoReclamo.classList.remove('d-none');
				containerEstadoReclamo.classList.add('d-none');
			});

			btnEstadoReclamo.addEventListener('click', function() {
				containerEstadoReclamo.classList.remove('d-none');
				containerNuevoReclamo.classList.add('d-none');
			});
		}

		const formulario = document.getElementById('form_reclamo');
		formulario.addEventListener('submit', function(event) {
			event.preventDefault();
			alert('Formulario enviado');
		});
	});



	// var map;
	// var marker;
	// var geocoder;

	// function geocodePosition(pos) {
	// 	geocoder.geocode({
	// 		latLng: pos
	// 		}, function(responses) {
	// 		if (responses && responses.length > 0) {
	// 			updateMarkerAddress(responses[0].formatted_address);
	// 		} else {
	// 			updateMarkerAddress('No se puede determinar la ubicación.');
	// 		}
	// 	});

	// }

	// function updateMarkerAddress(str) {
	// 	jQuery("#ubicacion").val(str);
	// }

	// function inicializarPunto(){
	// 	marker = new google.maps.Marker({
	// 		position: new google.maps.LatLng(-34.5418691,-58.7149334),
	// 		map:map,
	// 		title: 'Ubicación del reclamo',
	// 		animation:google.maps.Animation.BOUNCE
	// 	}) ;

	// 	updateMarkerPosition(marker.getPosition());
	// 	geocodePosition(marker.getPosition());
	// }

	// function addMarker(location) {
	// 	marker.setMap(null);
	// 	marker = new google.maps.Marker({
	// 	position: location,
	// 	map: map,
	// 	title: 'Ubicación del reclamo',
	// 	animation:google.maps.Animation.BOUNCE    
	// 	});

	// 	updateMarkerPosition(marker.getPosition());
	// 	geocodePosition(marker.getPosition());
	// }

	// function updateMarkerPosition(latLng) {
	// 	jQuery("#lat").val(latLng.lat());
	// 	jQuery("#lng").val(latLng.lng());
	// }

	// // Funcion que se ejecuta al cargar el scrips de mapsengine asincronicamente

	// function inicializarMapa() {
	// 	geocoder = new google.maps.Geocoder();

	// 	// seteo las opciones del mapa
	// 	var mapOptions = {
	// 		zoom: 14,
	// 		center: new google.maps.LatLng(-34.5418691,-58.7149334)
	// 	};

	// 	// Creo el mapa
	// 	map = new google.maps.Map(document.getElementById('mapaReclamo'), mapOptions);
	// 	google.maps.event.addListener(map, 'click', function(event) {
	// 		addMarker(event.latLng);
	// 	});

	// 	inicializarPunto();
	// }


	jQuery(document).ready(function(){
		jQuery("#usarMapa").change(function(){
			if( jQuery(this).val()=='no' ){
				jQuery("#mapaReclamo").hide();
				jQuery("#ubicacion").hide();
				jQuery("#contenedorCalleReclamo").show().removeClass("hide");
			}else{
				jQuery("#mapaReclamo").show();
				jQuery("#ubicacion").show(); 
				jQuery("#contenedorCalleReclamo").hide().addClass("hide");
				if (typeof google !== 'undefined') {    
					google.maps.event.trigger(map, 'resize');
					map.setCenter(new google.maps.LatLng(jQuery("#lat").val(),jQuery("#lng").val()));
				}                         
			}
		});
	});

</script>

<script src="https://maps.googleapis.com/maps/api/js?libraries=geometry&key=<?php echo getMapsEngineApiKey('browser') ?>&libraries=visualization&sensor=TRUE&callback=inicializarMapa"></script>
<?php get_template_part(THEME_FOOTER); ?>