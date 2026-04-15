var theme_name = 'msmtheme';
var urlApi = '';
var enviando = false;
var site_url = $("#site_url").val();
// Solucion a bug de jquery ui
jQuery.fn.extend({ propAttr: $.fn.prop || $.fn.attr });


$(document).ready(function () {
	$("#enviar_reclamo").click(function () {

		var reclamo = {
			"Apellido": $("#Apellido").val(),
			"Nombre": $("#Nombre").val(),
			"Email": $("#Email").val(),
			"TelefonoDeContacto": $("#TelefonoDeContacto").val(),
			"TipoDocumento": $("#TipoDocumento").val(),
			"NumeroDocumento": $("#NumeroDocumento").val(),
			"IdMotivo": $("#IdMotivo").val(),
			"TextMotivo": $("#IdMotivo option:selected").text()
		};

		if (reclamoValido(reclamo)) nuevoReclamo(reclamo);
	});

	$("#enviar_consulta_nro").click(function () {
		obtenerReclamoPorNumero();
	});

	$('#copy-btn').click(function () {
		copiarReclamo();
	});

});


function obtenerReclamoPorNumero() {
	$("#errorConsulta").hide();
	let nroReclamo = $("#numeroReclamo").val();
	$("#resultadosConsulta").html('<p style="display:flex;justify-content:center">Cargando...</p>');
	$('#enviar_consulta_nro').prop("disabled", true);

	jQuery.ajax({
		url: urlApi + '/wp-content/themes/' + theme_name + '/api/EstadoReclamoPorNumero.php',
		data: nroReclamo,
		type: 'POST',
		success: function (response) {
			response = jQuery.parseJSON(response);
			var estado = response.status == 'closed' ? 'Cerrado' : 'En proceso';
			var resultado = '';
			resultado += '<table class="table">';
			resultado += '<thead>';
			resultado += '<tr>';
			resultado += '<th>N°Reclamo Interno</th>';
			resultado += '<th>Estado</th>';
			resultado += '<th>Motivo</th>';
			resultado += '<th>Fecha Registración</th>';
			resultado += '</tr>';
			resultado += '<tr>';
			resultado += '<th>' + response.id + '</th>';
			resultado += '<th>' + estado + '</th>';
			resultado += '<th>' + response.subject + '</th>';
			resultado += '<th>' + response.created_at + '</th>';
			resultado += '</tr>';
			resultado += '</tbody>';
			resultado += '</table>';
			$("#resultadosConsulta").html(resultado);
			$('#enviar_consulta_nro').prop("disabled", false);
			$("#formulario_consulta").hide();
			$("#resultadosConsulta").fadeIn();

		},
		error: function (response) { }
	});
	$("#numeroReclamo").val('');
}


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
	// if (reclamo.IdPrestadoraServicios == '') {
	// 	var error = {
	// 		"IncompliantInstance": "IdPrestadoraServicios",
	// 		"Message": "Debe ingresar una Empresa Prestadora de Servicios.",
	// 	};
	// 	errores.push(error);
	// }
	if (reclamo.IdMotivo == '') {
		var error = {
			"IncompliantInstance": "IdMotivo",
			"Message": "Debe ingresar un motivo valido"
		};
		errores.push(error);
	}
	if (reclamo.TextMotivo == '') {
		var error = {
			"IncompliantInstance": "TextMotivo",
			"Message": "Debe ingresar un motivo valido"
		};
		errores.push(error);
	}
	// if (reclamo.DetalleReclamo == '') {
	// 	var error = {
	// 		"IncompliantInstance": "DetalleReclamo",
	// 		"Message": "Debe ingresar el detalle del reclamo"
	// 	};
	// 	errores.push(error);
	// }

	if (errores.length) {
		procesarErrores(errores);
		return false;
	}
	else
		return true;
}

function nuevoReclamo(reclamo) {
	console.log(reclamo)
	jQuery.ajax({
		data: JSON.stringify(reclamo),
		url: urlApi + '/wp-content/themes/' + theme_name + '/api/nuevoReclamo.php',
		type: 'POST',
		contentType: 'application/json',
		success: function (response) {
			respuesta = JSON.parse(response);
			console.log(respuesta)
			// let respuesta = response; // Asumiendo que response es el objeto
			// if (typeof respuesta === 'string') {
			// 	respuesta = JSON.parse(respuesta); // Solo parsear si es una cadena
			// }
			// if (respuesta.success) {
			// 	$('#success-msg span').text(respuesta.data);
			// 	$('#success-msg').css('display', 'flex').fadeIn();
			// 	limpiarFormulario();
			// }
		},
		error: function (xhr, status, error) {
			console.error('Error en la solicitud AJAX:', xhr.responseText);
			alert('Ocurrió un error al procesar el reclamo.');
		}
	});
}

/* 	---------------------------------------------------------------------------
	Funcion que procesa los errores del formulario retornados por el webservice
	---------------------------------------------------------------------------
*/
function procesarErrores(errores) {
	// indica si ya hice o no focus en el primer error
	var focus = false;
	$(".error").hide();
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
	$(errorSelector).text(msg);
	if (!focus) {
		$(inputSelector).focus();
		focus = true;
	}
	$(errorSelector).show();
	return focus;

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
/*
	Limpiar los campos del formulario
*/
function limpiarFormulario() {
	$("#Apellido").val('');
	$("#Nombre").val('');
	$("#Email").val('');
	$("#TelefonoDeContacto").val('');
	$("#TipoDocumento").val('');
	$("#NumeroDocumento").val('');
	$("#IdMotivo").val('');
}

function copiarReclamo() {
	var textToCopy = $('#success-msg span').text();

	var tempInput = $('<input>');
	$('body').append(tempInput);

	tempInput.val(textToCopy).select();
	document.execCommand('copy');
	tempInput.remove();
	alert('Contenido copiado al portapapeles');
}