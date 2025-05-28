var theme_name = 'msmtheme';
var urlApi = '';
var enviando = false;
var site_url = jQuery("#site_url").val();
// Solucion a bug de jquery ui
jQuery.fn.extend({ propAttr: $.fn.prop || $.fn.attr });

function obtenerReclamoPorNumeroDocumento() {
	jQuery("#errorConsulta").hide();
	jQuery.ajax({
		url: urlApi + '/wp-content/themes/' + theme_name + '/api/EstadoReclamoPorNumeroDocumento.php',
		data: { numeroDocumento: jQuery("#numeroDocumentoConsulta").val() },
		type: 'POST',
		success: function (response) {
			response = jQuery.parseJSON(response);
			var resultado = '';
			resultado += '<table class="table">';
			resultado += '<thead>';
			resultado += '<tr>';
			resultado += '<th>N°Reclamo Interno</th>';
			resultado += '<th>N°Reclamo Delegacion</th>';
			resultado += '<th>Direccion</th>';
			resultado += '<th>Motivo</th>';
			resultado += '<th>Vencimiento</th>';
			resultado += '<th>Fecha Registracion</th>';
			resultado += '<th>Derivado A</th>';
			resultado += '<th>Estado</th>';
			resultado += '<th>Comentarios</th>';
			resultado += '</tr>';
			response.forEach(function (ticket) {
				if (typeof ticket.NumeroReclamoInterno == 'undefined')
					ticket.NumeroReclamoInterno = '-';
				if (typeof ticket.NumeroReclamoDelegacion == 'undefined')
					ticket.NumeroReclamoDelegacion = '-';
				if (typeof ticket.Direccion == 'undefined')
					ticket.Direccion = '-';
				if (typeof ticket.Motivo == 'undefined')
					ticket.Motivo = '-';
				if (typeof ticket.Vencimiento == 'undefined')
					ticket.Vencimiento = '-';
				if (typeof ticket.FechaRegistracion == 'undefined')
					ticket.FechaRegistracion = '-';
				if (typeof ticket.DerivadoA == 'undefined')
					ticket.DerivadoA = '-';
				if (typeof ticket.Estado == 'undefined')
					ticket.Estado = '-';
				if (typeof ticket.Comentarios == 'undefined')
					ticket.Comentarios = '-';
				resultado += '<tr>';
				resultado += '<th>' + ticket.NumeroReclamoInterno + '</th>';
				resultado += '<th>' + ticket.NumeroReclamoDelegacion + '</th>';
				resultado += '<th>' + ticket.Direccion + '</th>';
				resultado += '<th>' + ticket.Motivo + '</th>';
				resultado += '<th>' + ticket.Vencimiento + '</th>';
				resultado += '<th>' + ticket.FechaRegistracion + '</th>';
				resultado += '<th>' + ticket.DerivadoA + '</th>';
				resultado += '<th>' + ticket.Estado + '</th>';
				resultado += '<th>' + ticket.Comentarios + '</th>';
				resultado += '</tr>';
			});
			resultado += '</tbody>';
			resultado += '</table>';
			jQuery("#resultadosConsulta").html(resultado);
			jQuery("#formulario_consulta").hide();
			jQuery("#resultadosConsulta").fadeIn();
		},
		error: function (jqXHR, textStatus, errorThrown) {

		}
	});
	jQuery("#numeroDocumentoConsulta").val('');
}

function obtenerReclamoPorNumero() {
	jQuery("#errorConsulta").hide();
	jQuery.ajax({
		url: urlApi + '/wp-content/themes/' + theme_name + '/api/EstadoReclamoPorNumero.php',
		data: { numeroReclamo: jQuery("#numeroReclamo").val() },
		type: 'POST',
		success: function (response) {
			response = jQuery.parseJSON(response);
			console.log(response);
			// if (typeof response.Message == 'undefined') {
			// 	if (typeof response.NumeroReclamoInterno == 'undefined')
			// 		response.NumeroReclamoInterno = '-';
			// 	if (typeof response.NumeroReclamoDelegacion == 'undefined')
			// 		response.NumeroReclamoDelegacion = '-';
			// 	if (typeof response.Direccion == 'undefined')
			// 		response.Direccion = '-';
			// 	if (typeof response.Motivo == 'undefined')
			// 		response.Motivo = '-';
			// 	if (typeof response.Vencimiento == 'undefined')
			// 		response.Vencimiento = '-';
			// 	if (typeof response.FechaRegistracion == 'undefined')
			// 		response.FechaRegistracion = '-';
			// 	if (typeof response.DerivadoA == 'undefined')
			// 		response.DerivadoA = '-';
			// 	if (typeof response.Estado == 'undefined')
			// 		response.Estado = '-';
			// 	if (typeof response.Comentarios == 'undefined')
			// 		response.Comentarios = '-';
			// 	var resultado = '';
			// 	resultado += '<table class="table">';
			// 	resultado += '<thead>';
			// 	resultado += '<tr>';
			// 	resultado += '<th>N°Reclamo Interno</th>';
			// 	resultado += '<th>N°Reclamo Delegacion</th>';
			// 	resultado += '<th>Direccion</th>';
			// 	resultado += '<th>Motivo</th>';
			// 	resultado += '<th>Vencimiento</th>';
			// 	resultado += '<th>Fecha Registracion</th>';
			// 	resultado += '<th>Derivado A</th>';
			// 	resultado += '<th>Estado</th>';
			// 	resultado += '<th>Comentarios</th>';
			// 	resultado += '</tr>';
			// 	resultado += '</thead>';
			// 	resultado += '<tbody>';
			// 	resultado += '<tr>';
			// 	resultado += '<th>' + response.NumeroReclamoInterno + '</th>';
			// 	resultado += '<th>' + response.NumeroReclamoDelegacion + '</th>';
			// 	resultado += '<th>' + response.Direccion + '</th>';
			// 	resultado += '<th>' + response.Motivo + '</th>';
			// 	resultado += '<th>' + response.Vencimiento + '</th>';
			// 	resultado += '<th>' + response.FechaRegistracion + '</th>';
			// 	resultado += '<th>' + response.DerivadoA + '</th>';
			// 	resultado += '<th>' + response.Estado + '</th>';
			// 	resultado += '<th>' + response.Comentarios + '</th>';
			// 	resultado += '</tr>';
			// 	resultado += '</tbody>';
			// 	resultado += '</table>';
			// 	jQuery("#resultadosConsulta").html(resultado);
			// 	jQuery("#formulario_consulta").hide();
			// 	jQuery("#resultadosConsulta").fadeIn();
			// }
			// else {
			// 	var errors = response;
			// 	jQuery("#errorConsulta").text(errors.ExceptionMessage);
			// 	jQuery("#errorConsulta").fadeIn();
			// }
		},
		error: function (response) { }
	});
	jQuery("#numeroReclamo").val('');
}

/* --------------------------------------------------------------------------------
	Funcion que envia un nuevo reclamo
   --------------------------------------------------------------------------------
*/
function reclamoValido(reclamo) {
	var errores = [];


	if (reclamo.NumeroDocumento == '' || (reclamo.NumeroDocumento.length != 8 && reclamo.NumeroDocumento.length != 7)) {
		var error = {
			"IncompliantInstance": "NumeroDocumento",
			"Message": "Debe ingresar un número de documento válido."
		};
		errores.push(error);
	}
	if (reclamo.Apellido == '') {
		var error = {
			"IncompliantInstance": "Apellido",
			"Message": "Debe ingresar su apellido."
		};
		errores.push(error);
	}
	if (reclamo.Nombre == '') {
		var error = {
			"IncompliantInstance": "Nombre",
			"Message": "Debe ingresar su nombre."
		};
		errores.push(error);
	}
	if (reclamo.Email == '') {
		var error = {
			"IncompliantInstance": "Email",
			"Message": "Debe ingresar su Email."
		};
		errores.push(error);
	}
	else if (!validateEmail(reclamo.Email)) {
		var error = {
			"IncompliantInstance": "Email",
			"Message": "Debe ingresar un Email válido."
		};
		errores.push(error);
	}
	if (reclamo.TelefonoDeContacto == '') {
		var error = {
			"IncompliantInstance": "TelefonoDeContacto",
			"Message": "Debe ingresar su Teléfono."
		};
		errores.push(error);
	}
	if (reclamo.IdPrestadoraServicios == '') {
		var error = {
			"IncompliantInstance": "IdPrestadoraServicios",
			"Message": "Debe ingresar una Empresa Prestadora de Servicios.",
		};
		errores.push(error);
	}
	if (reclamo.IdMotivo == '') {
		var error = {
			"IncompliantInstance": "IdMotivo",
			"Message": "Debe ingresar un motivo valido"
		};
		errores.push(error);
	}
	if (reclamo.DetalleReclamo == '') {
		var error = {
			"IncompliantInstance": "DetalleReclamo",
			"Message": "Debe ingresar el detalle del reclamo"
		};
		errores.push(error);
	}

	//Imagenes
	var errorImg = 0
	if ($("#images").val() != "") {
		var control = document.getElementById("images");
		var filelength = control.files.length;

		for (var i = 0; i < control.files.length; i++) {
			var file = control.files[i];
			var FileName = file.name;
			console.log(file.type);
			var FileExt = FileName.substr(FileName.lastIndexOf('.') + 1);
			if ($.inArray(FileExt.toLowerCase(), ['gif', 'bmp', 'png', 'jpg', 'jpeg']) == -1) {
				errorImg = 1;
			}
		}
		if (errorImg == 1) {
			var error = {
				"IncompliantInstance": "Imagenes",
				"Message": "Alguno de los archivos seleccionados NO es del formato PNG, JPG, JPEG, BMP o GIF"
			};
			errores.push(error);
		}
	}

	if (errores.length) {
		procesarErrores(errores);
		return false;
	}
	else
		return true;
}


function IsJsonString(str) {
	try {
		jQuery.parseJSON(str);
	} catch (e) {
		return false;
	}
	return true;
}


function nuevoReclamo(reclamo) {
	if (!enviando) {
		enviando = true;
		/* Oculto todos los mensajes de error del formulario:
			 - Esto lo hago porque si se intento enviar el form y genero errores, 
			   luego de volver a enviar, solo deberia mostrar (en caso de existir) los nuevos errores
		*/
		jQuery(".error").hide();
		// Genero un objeto reclamo en base a los datos relevantes del formulario

		// Disparo el envio via post al webservice
		jQuery.ajax({
			data: { reclamo: JSON.stringify(reclamo) },
			url: urlApi + '/wp-content/themes/' + theme_name + '/api/nuevoReclamo.php',
			type: 'POST',
			success: function (response) {
				respuesta = jQuery.parseJSON(response);
				if (typeof (respuesta) !== "string") {
					if (respuesta.hasOwnProperty('Mensaje')) {
						jQuery('#form_reclamo').trigger("reset");

						var mensaje;
						mensaje = respuesta.Mensaje + '. Su Nº de reclamo es el: ' + respuesta.Numero;
						jQuery(".exito").text(mensaje);
						jQuery("#formulario_reclamo").hide();
						jQuery("html, body").animate({ scrollTop: 0 }, "slow");
						jQuery("#mensaje_exitoso_container").fadeIn();
						enviando = false;
					}
					else {
						var errores = respuesta;
						procesarErrores(errores);
						enviando = false;
					}
				}
				else {
					jQuery('#form_reclamo').trigger("reset");
					var mensaje;
					mensaje = "Hubo un problema al registrar el reclamo, intentelo nuevamente";
					jQuery(".exito").text(mensaje);

					jQuery("#formulario_reclamo").hide();

					jQuery("html, body").animate({ scrollTop: 0 }, "slow");
					jQuery("#mensaje_exitoso_container").fadeIn();
					enviando = false;

				}
			},
			error: function (response) {
				console.log('Error:', response);
			}
		});
	}
}



/* 	--------------------------------------------------------------------------------
	Funcion que convierte el input de Calles (del vecino y del reclamo) en un input
		  con autocomplete.
	--------------------------------------------------------------------------------
*/
function validateEmail(email) {
	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(email);
}



var files;
function prepareUpload(event) {
	files = event.target.files;
	console.log(files);
}
function uploadFiles(reclamo) {

	// START A LOADING SPINNER HERE

	// Create a formdata object and add the files
	var data = new FormData();

	$.each(files, function (key, value) {
		data.append(key, value);
	});
	console.log(data);

	$.ajax({
		url: '/wp-content/themes/' + theme_name + '/api/submit.php?files',
		type: 'POST',
		data: data,
		cache: false,
		dataType: 'json',
		processData: false, // Don't process the files
		contentType: false, // Set content type to false as jQuery will tell the server its a query string request
		success: function (data, textStatus, jqXHR) {
			console.log(data);
			if (data.error == 1) {
				var errores = [];
				var error = {
					"IncompliantInstance": "Imagenes",
					"Message": "Alguno de los archivos seleccionados NO es del formato PNG, JPG, JPEG, BMP o GIF"
				};
				errores.push(error);
				procesarErrores(errores);

				jQuery("#enviar_reclamo").css("display", "block");
				return;
			}

			data.forEach(function (url) {
				url = site_url + "wp-content/themes/'+theme_name+'/images/reclamos/" + url;
				reclamo.UrlImagenes.push(url);
			});
			console.log(reclamo);
			nuevoReclamo(reclamo);
		},
		error: function (jqXHR, textStatus, errorThrown) {
			console.log(textStatus);
		}
	});
}


/* 	--------------------------------------------------------------------------------
	Funcion que procesa los errores del formulario retornados por el webservice
	--------------------------------------------------------------------------------
*/
function procesarErrores(errores) {
	// indica si ya hice o no focus en el primer error
	var focus = false;
	jQuery(".error").hide();
	errores.forEach(function (error) {
		var msg = error.Message;
		if (error.IncompliantInstance == 'NumeroDocumento')
			focus = mostrarErrorFormulario(focus, '#errorNumeroDocumento', '#NumeroDocumento', msg);
		else if (error.IncompliantInstance == 'Apellido')
			focus = mostrarErrorFormulario(focus, '#errorApellido', '#Apellido', msg);
		else if (error.IncompliantInstance == 'Nombre')
			focus = mostrarErrorFormulario(focus, '#errorNombre', '#Nombre', msg);
		else if (error.IncompliantInstance == 'TelefonoDeContacto')
			focus = mostrarErrorFormulario(focus, '#errorContacto', '#TelefonoDeContacto', msg);
		else if (error.IncompliantInstance == 'IdPrestadoraServicios')
			focus = mostrarErrorFormulario(focus, '#errorIdPrestadora', '#IdPrestadoraServicios', msg);
		else if (error.IncompliantInstance == 'Email')
			focus = mostrarErrorFormulario(focus, '#errorEmail', '#Email', msg);
		else if (error.IncompliantInstance == 'IdCalleReclamo')
			focus = mostrarErrorFormulario(focus, '#errorIdCalleReclamo', '#calles_nombre_reclamo', msg);
		else if (error.IncompliantInstance == 'IdCalleVecino')
			focus = mostrarErrorFormulario(focus, '#errorIdCalle', '#calles_nombre', msg);
		else if (error.IncompliantInstance == 'IdMotivo')
			focus = mostrarErrorFormulario(focus, '#errorIdMotivo', '#IdMotivo', msg);
		else if (error.IncompliantInstance == 'DetalleReclamo')
			focus = mostrarErrorFormulario(focus, '#errorDetalleReclamo', '#DetalleReclamo', msg);
		else if (error.IncompliantInstance == 'Imagenes')
			focus = mostrarErrorFormulario(focus, '#errorImagenes', 'images', msg);
	});
}
/**
 * Muestro mensaje de error en  un campo del formulario
 * -----------------------------------------------------
 */
function mostrarErrorFormulario(focus, errorSelector, inputSelector, msg) {
	jQuery(errorSelector).text(msg);
	if (!focus) {
		jQuery(inputSelector).focus();
		focus = true;
	}
	jQuery(errorSelector).show();
	return focus;

}
jQuery(document).ready(function () {
	/*
	 * Genero el campo calle como un autocomplete en base a las calles de la API
	 *
	 * Genero el campo motivo como un autocomplete en base a las motivos de la API
	 *
	 * Al Hacer click en "Hace tu reclamo" oculto formulario de consulta 
	 * y muestro el formulario de reclamo
	 */
	jQuery("#reclama").click(function () {
		jQuery("#mensaje_exitoso_container").hide();
		jQuery("#resultadosConsulta").hide();
		jQuery("#errorConsulta").hide();
		jQuery("#formulario_consulta").hide();
		jQuery("#formulario_reclamo").fadeIn();
		google.maps.event.trigger(map, 'resize');
		map.setCenter(new google.maps.LatLng(-34.5418691, -58.7149334));
	});

	/*
	 * Al Hacer click en "Consulta elo estado ..." oculto formulario de reclamo 
	 * y muestro el formulario de consulta
	 */

	jQuery("#consulta").click(function () {
		jQuery("#mensaje_exitoso_container").hide();
		jQuery("#resultadosConsulta").hide();
		jQuery("#errorConsulta").hide();
		jQuery("#formulario_reclamo").hide();
		jQuery("#formulario_consulta").fadeIn();
	});

	/**
	 * Al hacer click en enviar reclamo, valido el form y envio
	 */


	// Add events
	jQuery('input[type=file]').on('change', prepareUpload);


	jQuery("#enviar_reclamo").click(function () {
		// Armo el reclamo

		if (jQuery("#usarMapa").val() == 'si') {
			var reclamo = {
				"Apellido": jQuery("#Apellido").val(),
				"Nombre": jQuery("#Nombre").val(),
				"Email": jQuery("#Email").val(),
				"TelefonoDeContacto": jQuery("#TelefonoDeContacto").val(),
				"TipoDocumento": jQuery("#TipoDocumento").val(),
				"NumeroDocumento": jQuery("#NumeroDocumento").val(),
				"IdCalleVecino": jQuery("#calles_nombre").val(),
				"AlturaCalleVecino": jQuery("#AlturaCalleVecino").val(),
				"Latitud": parseFloat(jQuery("#lat").val()),
				"Longitud": parseFloat(jQuery("#lng").val()),
				"DetalleReclamo": jQuery("#DetalleReclamo").val(),
				"IdMotivo": jQuery("#IdMotivo").val(),
				"IdPrestadoraServicios": jQuery("#prestadora").val(),
				"UrlImagenes": [],
			};
		}
		else {
			var reclamo = {
				"Apellido": jQuery("#Apellido").val(),
				"Nombre": jQuery("#Nombre").val(),
				"Email": jQuery("#Email").val(),
				"TelefonoDeContacto": jQuery("#TelefonoDeContacto").val(),
				"TipoDocumento": jQuery("#TipoDocumento").val(),
				"NumeroDocumento": jQuery("#NumeroDocumento").val(),
				"IdCalleVecino": jQuery("#calles_nombre").val(),
				"AlturaCalleVecino": jQuery("#AlturaCalleVecino").val(),
				"IdCalleReclamo": jQuery("#calles_nombre_reclamo").val(),
				"AlturaCalleReclamo": jQuery("#AlturaCalleReclamo").val(),
				"DetalleReclamo": jQuery("#DetalleReclamo").val(),
				"IdMotivo": jQuery("#IdMotivo").val(),
				"IdPrestadoraServicios": jQuery("#prestadora").val(),
				"UrlImagenes": [],
			};
		}


		if (reclamoValido(reclamo)) {
			//jQuery("#enviar_reclamo").remove(); 
			jQuery("#enviar_reclamo").css("display", "none");
			if (jQuery("#images").val() != '') {
				uploadFiles(reclamo);
			}
			else {

				nuevoReclamo(reclamo);
			}
		}

	});

	jQuery("#enviar_consulta_nro").click(function () {
		obtenerReclamoPorNumero();
	});
	jQuery("#enviar_consulta_doc").click(function () {
		obtenerReclamoPorNumeroDocumento();
	});
});
