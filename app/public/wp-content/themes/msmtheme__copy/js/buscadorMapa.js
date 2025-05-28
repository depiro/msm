function mostrarPuntoListado(id) {
	console.log(id);
	jQuery("article[listpunto='" + id + "']").show();
}

function ocultarPuntoListado(id) {
	console.log(id);
	jQuery("article[listpunto='" + id + "']").hide();
}
// funcion que muestra los marcadores correspondientes en base a la capa seleccionada
function mostrarPuntosPorCapa(tipos, mapa, capa) {
	// si no se selecciono ninguna capa le asigno un mapa nulo al marcador
	if (tipos.length == 0)
		mapa = null;
	// sino, por cada marcador que este en esa capa lo muestro
	for (var i = 0; i < markers.length; i++) {
		var pos = tipos.indexOf(markers[i].capa);
		if (tipos.length == 0 || pos != -1) {
			markers[i].setMap(mapa);
			mostrarPuntoListado(markers[i].ID);
		}
	}
	var transporte = tipos.indexOf('transporte');
	if (transporte != -1) {
		for (var i = 0; i < recorridos.length; i++) {
			if ((recorridos[i].tipo == "micro-municipal" && capa == "transporte") || (recorridos[i].tipo == "tren" && capa == "transporte") || (recorridos[i].tipo == "charter" && capa == "transporte") || (recorridos[i].tipo != "charter" && recorridos[i].tipo != "tren" && recorridos[i].tipo != "micro-municipal")) {
				recorridos[i].setMap(mapa);
				mostrarPuntoListado(recorridos[i].ID);
			}
		}
		for (var i = 0; i < paradas.length; i++) {
			paradas[i].setMap(mapa);
		}
	}
}

function ocultarCapa(tipos) {
	for (var i = 0; i < markers.length; i++) {
		var pos = tipos.indexOf(markers[i].capa);
		if (tipos.length == 0 || pos != -1) {
			markers[i].setMap(null);
			ocultarPuntoListado(markers[i].ID);

		}
	}
	var transporte = tipos.indexOf('transporte');
	if (transporte != -1) {
		for (var i = 0; i < recorridos.length; i++) {
			recorridos[i].setMap(null);
			ocultarPuntoListado(recorridos[i].ID);
		}
		for (var i = 0; i < paradas.length; i++) {
			paradas[i].setMap(null);
		}
	}
}

function mostrarPuntosPorTipo(tipos, mapa) {
	for (var i = 0; i < markers.length; i++) {
		var pos = tipos.indexOf(markers[i].tipo);
		if (tipos.length == 0 || pos != -1) {
			markers[i].setMap(mapa);
			mostrarPuntoListado(markers[i].ID);
		}
	}
	for (var i = 0; i < recorridos.length; i++) {

		var pos = tipos.indexOf(recorridos[i].tipo);
		if (tipos.length == 0 || pos != -1) {
			recorridos[i].setMap(mapa);
			mostrarPuntoListado(recorridos[i].ID);

		}
	}
	for (var i = 0; i < paradas.length; i++) {
		var pos = tipos.indexOf(paradas[i].tipo);
		if (tipos.length == 0 || pos != -1)
			paradas[i].setMap(mapa);
	}
}


function mostrarPuntosEspecificos(ids, mapa) {
	for (var i = 0; i < markers.length; i++) {
		var pos = ids.indexOf(markers[i].ID);
		if (ids.length == 0 || pos != -1) {
			markers[i].setMap(mapa);
			mostrarPuntoListado(markers[i].ID);
		}
	}
	for (var i = 0; i < recorridos.length; i++) {

		var pos = ids.indexOf(recorridos[i].ID);
		if (ids.length == 0 || pos != -1) {
			recorridos[i].setMap(mapa);
			mostrarPuntoListado(recorridos[i].ID);
		}
	}
	for (var i = 0; i < paradas.length; i++) {

		var pos = ids.indexOf(paradas[i].ID);
		if (ids.length == 0 || pos != -1)
			paradas[i].setMap(mapa);
	}
}

function ocultarPuntosPorTipo(tipos) {
	for (var i = 0; i < markers.length; i++) {
		var pos = tipos.indexOf(markers[i].tipo);
		if (tipos.length == 0 || pos != -1) {
			markers[i].setMap(null);
			ocultarPuntoListado(markers[i].ID);
		}
	}
	for (var i = 0; i < recorridos.length; i++) {
		var pos = tipos.indexOf(recorridos[i].tipo);
		if (tipos.length == 0 || pos != -1) {
			recorridos[i].setMap(null);
			ocultarPuntoListado(recorridos[i].ID);
		}
	}
	for (var i = 0; i < paradas.length; i++) {
		var pos = tipos.indexOf(paradas[i].tipo);
		if (tipos.length == 0 || pos != -1)
			paradas[i].setMap(null);
	}
}

function ocultarPuntosEspecificos(ids) {

	for (var i = 0; i < markers.length; i++) {
		var pos = ids.indexOf(markers[i].ID);
		if (ids.length == 0 || pos != -1) {
			markers[i].setMap(null);
			ocultarPuntoListado(markers[i].ID);
		}

	}
	for (var i = 0; i < recorridos.length; i++) {
		var pos = ids.indexOf(recorridos[i].ID);
		if (ids.length == 0 || pos != -1) {
			recorridos[i].setMap(null);
			ocultarPuntoListado(recorridos[i].ID);
		}

	}
	for (var i = 0; i < paradas.length; i++) {

		var pos = ids.indexOf(paradas[i].ID);
		if (ids.length == 0 || pos != -1)
			paradas[i].setMap(null);
	}
}

// Funcion que cierra todos los info window y frena la animacion de todos los marcadores
function resetearMarkers() {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setAnimation(null);
		markers[i].info.close();
	}
	for (var i = 0; i < paradas.length; i++) {
		paradas[i].setAnimation(null);
		paradas[i].info.close();
	}
	for (var i = 0; i < infoWindowsRecorridos.length; i++)
		infoWindowsRecorridos[i].close();
}


function addMarkerToMap(x) {
	var marker = new google.maps.Marker({
		position: new google.maps.LatLng(puntos[x].lat, puntos[x].lng),
		map: mmap,
		capa: puntos[x].capa,
		marca: puntos[x].marca,
		activo: puntos[x].activo,
		title: puntos[x].title,
		ID: puntos[x].ID,
		permalink: puntos[x].permalink,
		tipo: puntos[x].tipo,
		textoTipo: puntos[x].textoTipo,
		thumb: puntos[x].thumb,
		animation: puntos[x].animation,
		direc: puntos[x].direc,
		icon: puntos[x].icon,
		veinticuatroh: puntos[x].veinticuatroh,
		turno: puntos[x].turno


	});
	marker.setZIndex(1000);

	// Le asigno el info window al marcador
	var htmlInfoWindow;
	var titulo;
	var capasConPermalink;
	capasConPermalink = ['mascotas', 'cultura'];
	if (capasConPermalink.indexOf(marker.capa) >= 0)
		titulo = '<h2><a href="' + marker.permalink + '">' + marker.title + '</a></h2>';
	else
		titulo = '<h2>' + marker.title + '</h2>';
	var eventosLink = '';
	if (marker.capa == 'cultura')
		eventosLink = '<p><strong><a href="' + marker.permalink + '#calendarGrid" target="_blank">Ver Eventos</a></strong></p>'
	htmlInfoWindow = '<div class="popupContainer">' +
		'<figure><img src="' + marker.thumb + '"/></figure>' +
		'<div class="infoPop">' +
		titulo +
		'<p>' + marker.textoTipo + '</p>' +
		'<p><strong>Dirección:</strong>&nbsp;' + marker.direc + '</p>' +
		eventosLink +
		'</div>' +
		'</div>';
	marker.info = new google.maps.InfoWindow({ content: htmlInfoWindow, maxWidth: 480 });
	if (marker.activo == 1 || marker.ID == mk) {
		marker.setAnimation(google.maps.Animation.BOUNCE);
		mmap.setCenter(marker.getPosition());
		marker.info.open(map, marker);
	}
	google.maps.event.addListener(marker.info, 'closeclick', function () {
		marker.setAnimation(null);
	});
	// Agrego un listener para que al hacer click sobre un marcador, este tenga animacion y muestre su info window
	google.maps.event.addListener(marker, 'click', function () {
		// reseteo los demas marcadores para no superponer info windows ni que esten todos los marcadores saltando
		resetearMarkers();
		if (this.getAnimation() != null) {
			this.setAnimation(null);
		}
		else {
			this.setAnimation(google.maps.Animation.BOUNCE);
			this.info.open(map, this);
		}
	});
	markers.push(marker);
}

function addRecorridoToMap(x) {
	// if(mk != puntos[x].ID && mk != "")
	//   mmap= null; 
	var coordinates = [];
	for (var j = 0; j < puntos[x].recorrido.length; j++)
		coordinates.push(new google.maps.LatLng(puntos[x].recorrido[j].lat, puntos[x].recorrido[j].lng));
	var recorrido = new google.maps.Polyline({
		path: coordinates,
		clickable: true,
		geodesic: true,
		recorrer: coordinates.length,
		strokeColor: puntos[x].color,
		marca: '',
		linea: puntos[x].linea,
		strokeOpacity: 0.7,
		strokeWeight: 8,
		map: mmap,
		capa: puntos[x].capa,
		ID: puntos[x].ID,
		activo: puntos[x].activo,
		title: puntos[x].title,
		permalink: puntos[x].permalink,
		tipo: puntos[x].tipo,
		textoTipo: puntos[x].textoTipo,
		thumb: puntos[x].thumb,
		direc: puntos[x].direc,

	});
	google.maps.event.addListener(recorrido, 'click', function (event) {
		resetearMarkers();

		for (var i = 0; i < recorridos.length; i++)
			recorridos[i].setOptions({ strokeWeight: 8 });
		this.setOptions({ strokeWeight: 10 });
		var element = new google.maps.LatLng(event.latLng.A, event.latLng.F);
		var recorridosCoincidentes = [];
		recorridos.forEach(function (polyline, index) {
			if (polyline.recorrer != 0) {
				if (google.maps.geometry.poly.isLocationOnEdge(element, polyline, 0.0001)) {
					recorridosCoincidentes.push({ "title": polyline.title, "textoTipo": polyline.textoTipo });
				}
			}
		});
		if (recorridosCoincidentes.length <= 1)
			htmlInfoWindow = '<div class="popupContainer"><figure><img src="' + this.thumb + '"/></figure><div class="infoPop"><h2>' + this.title + '</h2>' + '<p>' + this.textoTipo + '</p></div></div>';
		else {
			htmlInfoWindow = '<div class="popupContainer"><figure><img src="' + this.thumb + '"/></figure><div class="infoPop"><h2>Múltiples recorridos</h2><p>Por este punto pasan los siguientes recorridos:</p><ul>';
			recorridosCoincidentes.forEach(function (polyline, index) {
				htmlInfoWindow += '<li>' + polyline.title + '</li>';
			});
			htmlInfoWindow += '</ul></div></div>';
		}
		this.setOptions({ strokeWeight: 12 });
		infowindow = new google.maps.InfoWindow({
			content: htmlInfoWindow,
			position: event.latLng
		});
		infoWindowsRecorridos.push(infowindow);
		infowindow.open(map);
	});

	/*google.maps.event.addListener(recorrido, 'mouseout', function(event){
		this.setOptions({ strokeWeight : 10});
		setTimeout(function(){
			for (var i = 0; i < infoWindowsRecorridos.length; i++)
				infoWindowsRecorridos[i].close();  
		}, 2000);
	}); */

	recorridos.push(recorrido);
}

function addParadaToMap(arrayParadas, x) {
	var lineSymbol = {
		path: google.maps.SymbolPath.CIRCLE,
		scale: 3,
		strokeColor: puntos[x].color
	};
	for (var j = 0; j < arrayParadas.length; j++) {
		var parada = new google.maps.Marker({
			position: new google.maps.LatLng(arrayParadas[j].lat, arrayParadas[j].lng),
			map: mmap,
			capa: puntos[x].capa,
			marca: '',
			linea: puntos[x].linea,
			ID: puntos[x].ID,
			activo: puntos[x].activo,
			title: "Parada " + arrayParadas[j].nombreParada.replace("Parada", ""),
			permalink: puntos[x].permalink,
			tipo: puntos[x].tipo,
			textoTipo: puntos[x].textoTipo,
			thumb: puntos[x].thumb,
			animation: puntos[x].animation,
			direc: puntos[x].direc,
			icon: lineSymbol
		});
		parada.setZIndex(100);
		// Le asigno el info window al marcador
		var htmlInfoWindow;
		var titulo;
		titulo = '<h2>' + parada.title + '</h2>';
		htmlInfoWindow = '<div class="popupContainer"><figure><img src="' + puntos[x].thumb + '"/></figure><div class="infoPop">' + titulo + '</div></div>';
		parada.info = new google.maps.InfoWindow({ content: htmlInfoWindow, maxWidth: 480 });
		// Agrego un listener para que al hacer click sobre un marcador, este tenga animacion y muestre su info window
		google.maps.event.addListener(parada, 'click', function () {
			// reseteo los demas marcadores para no superponer info windows ni que esten todos los marcadores saltando
			resetearMarkers();
			if (this.getAnimation() != null)
				this.setAnimation(null);
			else
				this.info.open(mmap, this);
		});
		paradas.push(parada);
	}
}

// Funcion que se ejecuta al cargar la pagina, la cual inicializa los marcadores en base al arrar que se creo con los puntos verdes
function inicializarPuntos() {
	// Por cada punto inserto un marcador en el mapa, y lo guardo en el array de marcadores
	for (var x = 0; x < puntos.length; x++) {
		if ((jQuery.inArray(puntos[x].capa, capas_activas) >= 0 || jQuery.inArray(puntos[x].tipo, tipo) >= 0) && puntos[x].es_visible)
			mmap = map;
		else
			mmap = null;


		if (puntos[x].tipo == "micro-municipal" || puntos[x].tipo == "tren") {
			addRecorridoToMap(x);
			addParadaToMap(puntos[x].paradas, x);
		}
		else if (puntos[x].tipo == "charter") {

			addRecorridoToMap(x);
			addParadaToMap(puntos[x].paradas, x);
			// inserto marker en parada central     
			addMarkerToMap(x);
		}
		else {
			addMarkerToMap(x);
		}
	}
	mk = "";
}
// Funcion que se ejecuta al cargar el scrips de mapsengine asincronicamente
function inicializarMapa() {
	// seteo las opciones del mapa
	var mapOptions = {
		zoom: 14,
		center: new google.maps.LatLng(-34.564030, -58.719053)
	};
	// Creo el mapa
	map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	// inicializo el mapa en base a los puntos verdes
	inicializarPuntos();
	google.maps.event.addListener(map, 'click', function (event) {
		for (var i = 0; i < infoWindowsRecorridos.length; i++) {
			infoWindowsRecorridos[i].close();
		};
	});


}

function Capa_cambiameElEstadoaMisSubCapas(capa, estado) {
	jQuery(".capaChk2[capa='" + capa + "']").prop("checked", estado);
	jQuery(".capaChk3[capa='" + capa + "']").prop("checked", estado);
	jQuery(".capaChk4[capa='" + capa + "']").prop("checked", estado);

}


function subCapa_cambiameElEstadoaMisSubCapas(tipo, estado) {
	jQuery(".capaChk3[tipo='" + tipo + "']").prop("checked", estado);
}
function subCapa_cambiameElEstadoaMisRecorridos(linea, estado) {
	jQuery(".capaChk4[linea='" + linea + "']").prop("checked", estado);
}

function punto_cambiarEstado(id, state) {
	if (!state)
		mapa = null;
	else
		mapa = map;
	for (var i = 0; i < markers.length; i++) {
		var pos = id.indexOf(markers[i].ID);
		if (pos != -1) {
			markers[i].setMap(mapa);
			markers[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				ocultarPuntoListado(markers[i].ID);
			}
		}
	}
	for (var i = 0; i < recorridos.length; i++) {

		var pos = id.indexOf(recorridos[i].ID);
		if (pos != -1) {
			recorridos[i].setMap(mapa);
			recorridos[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(recorridos[i].ID);
			}
			else {
				ocultarPuntoListado(recorridos[i].ID);
			}

		}

	}
	for (var i = 0; i < paradas.length; i++) {
		var pos = id.indexOf(paradas[i].ID);
		if (pos != -1)
			paradas[i].setMap(mapa);
	}
}

function eess_cambiarEstado(marca, state) {
	var marcas = [];
	jQuery("input[value='tiene_gnc']").prop('checked', false);
	jQuery(".capaChk3[tipo='estacion-de-servicio']:checked").each(function (i) {
		marcas.push(jQuery(this).val());
	});
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'estacion-de-servicio' && markers[i].marca == marca) markers[i].info.close();
	}
	if (!state)
		mapa = null;
	else
		mapa = map;
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'estacion-de-servicio') {
			var pos = marca.indexOf(markers[i].marca);
			if (pos != -1) {
				markers[i].setMap(mapa);
				markers[i].es_visible = state;
				if (state) {
					mostrarPuntoListado(markers[i].ID);
				}
				else {
					ocultarPuntoListado(markers[i].ID);
				}
			}
			else if ($.inArray(markers[i].marca, marcas) != -1) {
				markers[i].setMap(map);
				markers[i].es_visible = true;
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				markers[i].setMap(null);
				markers[i].es_visible = !state;
				ocultarPuntoListado(markers[i].ID);
			}
		}

	}

}

function eess_cambiarEstadoCombustible(state) {
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'estacion-de-servicio') markers[i].info.close();
	}
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'estacion-de-servicio') {
			var marca_marker = markers[i].textoTipo.toLowerCase();
			var pos = marca_marker.indexOf('gnc');
			if (pos != -1 && state) {
				markers[i].setMap(map);
				markers[i].es_visible = state;
				if (state) {
					mostrarPuntoListado(markers[i].ID);
				}
				else {
					ocultarPuntoListado(markers[i].ID);
				}
			}
			else if (pos == -1 && state) {
				markers[i].setMap(null);
				markers[i].es_visible = !state;
				if (state) {
					mostrarPuntoListado(markers[i].ID);
				}
				else {
					ocultarPuntoListado(markers[i].ID);
				}
			}
			else {
				markers[i].setMap(map);
				markers[i].es_visible = state;
				if (state) {
					mostrarPuntoListado(markers[i].ID);
				}
				else {
					ocultarPuntoListado(markers[i].ID);
				}
			}
		}

	}

	jQuery("input[tipo='estacion-de-servicio']").each(function () {
		if (jQuery(this).val() != 'tiene_gnc')
			jQuery(this).prop("checked", !state);
	});


}


function micros_cambiarEstado(linea, state) {
	if (!state)
		mapa = null;
	else
		mapa = map;
	for (var i = 0; i < recorridos.length; i++) {
		if (recorridos[i].tipo == 'micro-municipal') {
			var pos = linea.indexOf(recorridos[i].linea);
			if (pos != -1) {
				recorridos[i].setMap(mapa);
				recorridos[i].es_visible = state;
				if (state) {
					mostrarPuntoListado(recorridos[i].ID);
				}
				else {
					ocultarPuntoListado(recorridos[i].ID);
				}

			}
		}
	}
	for (var i = 0; i < paradas.length; i++) {
		if (paradas[i].tipo == 'micro-municipal') {
			var pos = linea.indexOf(paradas[i].linea);
			if (pos != -1)
				paradas[i].setMap(mapa);
		}
	}
}

function Capa_cambiarEstadoAMisPuntos(capa, state) {
	// si no se selecciono ninguna capa le asigno un mapa nulo al marcador
	if (!state)
		mapa = null;
	else
		mapa = map;
	for (var i = 0; i < markers.length; i++) {
		console.log(capa + " - " + markers[i].capa);
		var pos = capa.indexOf(markers[i].capa);
		if (pos != -1) {
			markers[i].setMap(mapa);
			markers[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				ocultarPuntoListado(markers[i].ID);
			}
		}
	}
	var transporte = capa.indexOf('transporte');
	if (transporte != -1) {
		for (var i = 0; i < recorridos.length; i++) {
			if ((recorridos[i].tipo == "micro-municipal" && capa == "transporte") || (recorridos[i].tipo == "tren" && capa == "transporte") || (recorridos[i].tipo != "tren" && recorridos[i].tipo != "micro-municipal")) {
				recorridos[i].setMap(mapa);
				recorridos[i].es_visible = state;
				if (state) {
					mostrarPuntoListado(recorridos[i].ID);
				}
				else {
					ocultarPuntoListado(recorridos[i].ID);
				}
			}
		}
		for (var i = 0; i < paradas.length; i++) {
			paradas[i].setMap(mapa);
		}
	}

}

function toggleFarmacias24h(state) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].info.close();
	}
	for (var i = 0; i < infoWindowsRecorridos.length; i++)
		infoWindowsRecorridos[i].close();
	ocultarFarmacias();
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'farmacia' && markers[i].veinticuatroh) {
			if (!state)
				mapa = null;
			else
				mapa = map;
			markers[i].setMap(mapa);
			markers[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				ocultarPuntoListado(markers[i].ID);
			}
		}

	}
	if (jQuery(".capaChk2[value='turno']").is(":checked")) {
		for (var i = 0; i < markers.length; i++) {
			if (markers[i].tipo == 'farmacia' && markers[i].turno) {
				mapa = map;
				markers[i].setMap(mapa);
				markers[i].es_visible = true;
				mostrarPuntoListado(markers[i].ID);
			}
		}
	}
}

function ocultarFarmacias() {
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'farmacia') {
			mapa = null;
			markers[i].setMap(mapa);
			markers[i].es_visible = false;
			ocultarPuntoListado(markers[i].ID);
		}
	}
}
function toggleFarmaciasTurno(state) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].info.close();
	}
	for (var i = 0; i < infoWindowsRecorridos.length; i++)
		infoWindowsRecorridos[i].close();
	if (!state)
		mapa = null;
	else
		mapa = map;
	ocultarFarmacias();
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'farmacia' && markers[i].turno) {
			if (!state)
				mapa = null;
			else
				mapa = map;
			markers[i].setMap(mapa);
			markers[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				ocultarPuntoListado(markers[i].ID);
			}
		}

	}
	if (jQuery(".capaChk2[value='24hs']").is(":checked")) {
		for (var i = 0; i < markers.length; i++) {
			if (markers[i].tipo == 'farmacia' && markers[i].veinticuatroh) {
				mapa = map;
				markers[i].setMap(mapa);
				markers[i].es_visible = true;
				mostrarPuntoListado(markers[i].ID);

			}
		}
	}

}

function toggleFarmacias(state) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].info.close();
	}
	for (var i = 0; i < infoWindowsRecorridos.length; i++)
		infoWindowsRecorridos[i].close();
	if (!state)
		mapa = null;
	else
		mapa = map;
	ocultarFarmacias();
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].tipo == 'farmacia') {
			if (!state)
				mapa = null;
			else
				mapa = map;
			markers[i].setMap(mapa);
			markers[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				ocultarPuntoListado(markers[i].ID);
			}
		}

	}
	if (jQuery(".capaChk2[value='24hs']").is(":checked")) {
		for (var i = 0; i < markers.length; i++) {
			if (markers[i].tipo == 'farmacia' && markers[i].veinticuatroh) {
				mapa = map;
				markers[i].setMap(mapa);
				markers[i].es_visible = true;
				mostrarPuntoListado(markers[i].ID);
			}
		}
	}
	if (jQuery(".capaChk2[value='turno']").is(":checked")) {
		for (var i = 0; i < markers.length; i++) {
			if (markers[i].tipo == 'farmacia' && markers[i].turno) {
				mapa = map;
				markers[i].setMap(mapa);
				markers[i].es_visible = true;
				mostrarPuntoListado(markers[i].ID);
			}
		}
	}
}




function subCapa_cambiarEstadoAMisPuntos(capa, tipo, state) {
	if (!state)
		mapa = null;
	else
		mapa = map;

	for (var i = 0; i < markers.length; i++) {


		var pos = tipo.indexOf(markers[i].tipo);
		if (pos != -1) {
			console.log(markers[i]);
			markers[i].setMap(mapa);
			markers[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(markers[i].ID);
			}
			else {
				ocultarPuntoListado(markers[i].ID);
			}
		}
	}
	for (var i = 0; i < recorridos.length; i++) {

		var pos = tipo.indexOf(recorridos[i].tipo);
		if (pos != -1) {
			recorridos[i].setMap(mapa);
			recorridos[i].es_visible = state;
			if (state) {
				mostrarPuntoListado(recorridos[i].ID);
			}
			else {
				ocultarPuntoListado(recorridos[i].ID);
			}
		}
	}
	for (var i = 0; i < paradas.length; i++) {
		var pos = tipo.indexOf(paradas[i].tipo);
		if (pos != -1)
			paradas[i].setMap(mapa);
	}
}
function actualizarNumeros() {
	var cant = 0;
	for (var i = 0; i < markers.length; i++) {
		if (markers[i].getMap() !== null) {
			cant++;
		}
	}
	for (var i = 0; i < recorridos.length; i++) {
		if (recorridos[i].getMap() !== null) {
			if (recorridos[i].tipo != 'charter')
				cant++;

		}
	}
	jQuery("#canti_puntos").html(cant);
	jQuery("#canti_listado").html(cant + cant_listados);
}


jQuery(document).ready(function () {

	jQuery(".capaChk").change(function () {

		for (var i = 0; i < infoWindowsRecorridos.length; i++)
			infoWindowsRecorridos[i].close();
		var capa = jQuery(this).attr('capa');
		for (var i = 0; i < markers.length; i++) {
			if (markers[i].capa == capa) markers[i].info.close();
		}
		var state = jQuery(this).prop("checked");
		Capa_cambiameElEstadoaMisSubCapas(capa, state);
		Capa_cambiarEstadoAMisPuntos(capa, state);
		actualizarNumeros();
	});
	// cuando se tilda o destilda una subcapa
	jQuery(".capaChk2").change(function () {
		// Vacio el mapa
		// Array donde guardo las subcapas seleccionadas
		var capa = jQuery(this).attr('capa');
		var tipo = jQuery(this).val();
		for (var i = 0; i < infoWindowsRecorridos.length; i++)
			infoWindowsRecorridos[i].close();
		for (var i = 0; i < markers.length; i++) {
			if (markers[i].tipo == tipo) markers[i].info.close();
		}
		var state = jQuery(this).prop("checked");
		if (tipo == "micro-municipal" || tipo == "tren" || tipo == 'estacion-de-servicio')
			subCapa_cambiameElEstadoaMisSubCapas(tipo, state);
		var cantSubCapas = 0;
		var cantSubCapasOcultas = 0;
		jQuery(".capaChk2[capa='" + capa + "']").each(function () {
			cantSubCapas++;
			if (!jQuery(this).prop("checked"))
				cantSubCapasOcultas++;
		});
		jQuery(".capaChk[capa='" + capa + "']").prop("checked", !(cantSubCapas == cantSubCapasOcultas));
		if (capa == 'farmacia' && tipo == 'turno')
			toggleFarmaciasTurno(state);
		else if (capa == 'farmacia' && tipo == '24hs')
			toggleFarmacias24h(state);
		else if (capa == 'farmacia' && tipo == 'todas')
			toggleFarmacias(state);
		subCapa_cambiarEstadoAMisPuntos(capa, tipo, state);
		actualizarNumeros();
	});

	jQuery(".capaChk3").change(function () {
		// Vacio el mapa
		var capa = jQuery(this).attr('capa');
		var tipo = jQuery(this).attr('tipo');
		var id_punto = jQuery(this).val();
		var state = jQuery(this).prop("checked");
		var cantPuntos = 0;
		var cantPuntosOcultos = 0;
		for (var i = 0; i < infoWindowsRecorridos.length; i++)
			infoWindowsRecorridos[i].close();
		jQuery(".capaChk3[tipo='" + tipo + "']").each(function () {
			cantPuntos++;
			if (!jQuery(this).prop("checked"))
				cantPuntosOcultos++;
		});
		jQuery(".capaChk2[value='" + tipo + "']").prop("checked", !(cantPuntos == cantPuntosOcultos));
		if (tipo != 'estacion-de-servicio' && tipo != 'micro-municipal') {
			punto_cambiarEstado(id_punto, state);
		}
		else if (tipo == 'micro-municipal') {
			var linea = id_punto;
			subCapa_cambiameElEstadoaMisRecorridos(linea, state);
			micros_cambiarEstado(linea, state);
		}
		else if (tipo == 'estacion-de-servicio' && id_punto == 'tiene_gnc') {
			eess_cambiarEstadoCombustible(state);
		}
		else {
			var marca = id_punto;
			eess_cambiarEstado(marca, state);
		}
		actualizarNumeros();
	});




	jQuery(".capaChk4").change(function () {
		var capa = jQuery(this).attr('capa');
		var tipo = jQuery(this).attr('tipo');
		var linea = jQuery(this).attr('linea');
		var id_recorrido = jQuery(this).val();
		var state = jQuery(this).prop("checked");
		var cantRecorridos = 0;
		var cantRecorridosOcultos = 0;
		for (var i = 0; i < infoWindowsRecorridos.length; i++)
			infoWindowsRecorridos[i].close();
		jQuery(".capaChk4[linea='" + linea + "']").each(function () {
			cantRecorridos++;
			if (!jQuery(this).prop("checked"))
				cantRecorridosOcultos++;
		});
		jQuery(".capaChk3[value='" + linea + "']").prop("checked", !(cantRecorridos == cantRecorridosOcultos));
		punto_cambiarEstado(id_recorrido, state);
		actualizarNumeros();
	});




	jQuery(".verList").click(function (e) {
		e.preventDefault();
		jQuery("#resultadosContainer,#map-canvas").hide();
		jQuery(".listadoSearch").show();
		jQuery(".verMap").removeClass("active");
		jQuery(this).addClass("active");
	});

	jQuery("#limpiarMapa").click(function (e) {
		jQuery(".listpunto").hide();
		for (var i = 0; i < markers.length; i++) {
			markers[i].info.close();
			markers[i].setMap(null);
		}
		for (var i = 0; i < recorridos.length; i++) {
			recorridos[i].setMap(null);
			recorridos[i].es_visible = false;

		}
		for (var i = 0; i < paradas.length; i++) {
			paradas[i].setMap(null);
		}
		$("input[type='checkbox']").each(function () {
			$(this).prop("checked", false);
		});
		for (var i = 0; i < infoWindowsRecorridos.length; i++)
			infoWindowsRecorridos[i].close();
		actualizarNumeros();
	});
	jQuery(".verMap").click(function (e) {
		e.preventDefault();
		jQuery(".listadoSearch").hide();
		jQuery("#resultadosContainer,#map-canvas").show();
		jQuery(".verList").removeClass("active");
		jQuery(this).addClass("active");
		google.maps.event.trigger(map, 'resize');
		map.setCenter(new google.maps.LatLng(-34.564030, -58.719053));
	});

});