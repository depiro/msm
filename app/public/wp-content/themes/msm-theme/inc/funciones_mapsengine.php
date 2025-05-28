<?php 
$apiKeys = array('server' => 'AIzaSyD88zWJ8qaBSsGdpSZP0pULcWB4j_X2eaM','browser'=>'AIzaSyA9ryJNuV80zvTPiEbXFkWtLzK7nya3ccc','simple'=>'AIzaSyDJaazN6vi2Yg6r0woMUYk7NxEHkNApay8');
function getMapsEngineApiKey($apiType){
	global $apiKeys;
	return $apiKeys[$apiType];
}

function imprimirPuntoVerdeAsMarker($post_id){
	$ubicacion = get_field('ubicacion',$post_id);
	$tipo = get_field('tipo',$post_id);
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	switch ($tipo ) {
		case 'Contenedor':
			  $icon .= 'contenedores.png';
			break;
		
		default:
			$icon .= 'recycle.png';
			break;
	}
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			title: '".get_the_title( $post_id )."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			direc: '".$ubicacion['address']."'
			 },";
}  

function imprimirMarker($post_id){
	$ubicacion = get_field('ubicacion',$post_id);
	if($post_id == $_POST['marker']) 
		$animation = 'animation: google.maps.Animation.BOUNCE,';
	else
		$animation ='';
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			title: '".get_the_title( $post_id )."',
			direc: '".$ubicacion['address']."'
			 },";	
}

function generarMarcadores(){
	global $wpdb;
	if(isset($_POST['capa']))
		return $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE post_type='".$_POST['capa']."' AND ID IN (SELECT post_id FROM $wpdb->postmeta WHERE meta_key='ubicacion' AND meta_value !='' ) AND post_status='publish' ");
	else
		return $wpdb->get_results("SELECT ID FROM $wpdb->posts WHERE ID IN (SELECT post_id FROM $wpdb->postmeta WHERE meta_key='ubicacion' AND meta_value !='') AND post_status='publish'");

}

function obtenerPuntosCapa_mascotas(){
	global $wpdb;
	$mascotas = $wpdb->get_results("SELECT p.post_title as nombre_punto,p.ID as id_punto,t.slug as tipo,p.post_type FROM $wpdb->posts as p
									INNER JOIN $wpdb->term_relationships as r
									ON p.ID = r.object_id
									INNER JOIN $wpdb->term_taxonomy as tx
									ON r.term_taxonomy_id = tx.term_taxonomy_id 
									INNER JOIN $wpdb->terms as t 
									ON t.term_id = tx.term_id 
									WHERE 	( p.post_type='sm-mascotas' OR p.post_type='animales-perdidos' ) AND 
											p.post_status='publish' AND t.slug IN ( 'perdidas','encontradas')");
	return $mascotas;

}

function obtenerPuntosCapa_puntosverdes(){
	global $wpdb;
	$puntos = $wpdb->get_results("SELECT p.post_title as nombre_punto,p.ID as id_punto,m.meta_value as tipo,p.post_type FROM $wpdb->posts as p
									INNER JOIN $wpdb->postmeta as m
									ON p.ID = m.post_id
									WHERE 	p.post_type='puntos-verdes' AND 
											p.post_status='publish' AND m.meta_key='tipo'");
	return $puntos;

}
function obtenerPuntosCapa_cultura(){
	global $wpdb;
	$filtro_cultura = "";
	if(isset($_POST['puntosculturales']))
		$filtro_cultura = " ID IN (".$_POST['puntosculturales'].") AND ";	
	$puntos = $wpdb->get_results("SELECT 
										p.post_title as nombre_punto, 
										p.post_type,
										p.ID as id_punto, t.slug as tipo
								  FROM $wpdb->posts as p 
								  INNER JOIN $wpdb->term_relationships as r ON p.ID = r.object_id 
								  INNER JOIN $wpdb->term_taxonomy as tx ON r.term_taxonomy_id = tx.term_taxonomy_id 
								  INNER JOIN $wpdb->terms as t ON tx.term_id = t.term_id 
								  WHERE p.post_type='tribe_venue' AND $filtro_cultura p.post_status='publish'");
	return $puntos;

}


function obtenerPuntosCapa_transporte(){
	global $wpdb;
	$puntos = $wpdb->get_results("SELECT 
										p.post_title as nombre_punto, 
										p.post_type,
										p.ID as id_punto, p.post_type as tipo
								  FROM $wpdb->posts as p 
								  WHERE p.post_type  IN ('micro-municipal','remis','taxi','estacion-de-servicio','charter','tren','transporte-escolar') AND p.post_status='publish'");
	return $puntos;

}

function get_tipo($post_id,$post_type){
	switch ($post_type) {
		case 'sm-mascotas':
			     if(has_term( 'perdidas', 'mascotas', $post_id )) 
			     	return 'perdidas';
			     else
			     	return 'encontradas';
			break;
		case 'animales-perdidos':
			     if(has_term( 'perdidas', 'mascotas', $post_id )) 
			     	return 'perdidas';
			     else
			     	return 'encontradas';
			break;			
		case 'puntos-verdes':
			return  get_field('tipo',$post_id);
			break;
		case 'tribe_venue':
		    $terms = wp_get_post_terms( $post_id,'tipo-de-lugar' );
			return  $terms[0]->slug;
			break;	
		case 'punto-wifi':
			$terms = wp_get_post_terms( $post_id,'categoria-de-punto-wifi' );
			return  $terms[0]->slug;
			break;
		case 'alerta':
			$terms = wp_get_post_terms( $post_id,'categoria-de-alerta' );
			return  $terms[0]->slug;
			break;			
		case 'entretenimiento':
			$terms = wp_get_post_terms( $post_id,'areas-de-entretenimiento' );
			return  $terms[0]->slug;
			break;	
		case 'centro-de-salud':
			$terms = wp_get_post_terms( $post_id,'tipos-de-centro-de-salud' );
			return  $terms[0]->slug;
			break;						
		case 'remis':
		case 'estacionamiento':
		case 'charter':
		case 'micro-municipal':
		case 'tren':
		case 'estacion-de-servicio':
		case 'taxi':
		case 'farmacia':
		case 'transporte-escolar':
		case 'gomeria':
			return $post_type;
			break;

		default:
			# code...
			break;
	}
}

function obtenerResultadosBusqueda(){
	global $wpdb;
	$resultados = array('listado' => array(),'mapa'	  => array());
	if(isset($_POST['capa']) and ( !isset($_POST['busqueda']) or ( isset($_POST['busqueda']) and trim($_POST['busqueda']) =='' ) ) ):
		if(is_array($_POST['capa'])): 
			foreach ($_POST['capa'] as $capa)
				$resultados['mapa'] = array_merge($resultados['mapa'],call_user_func('obtenerPuntosCapa_'.$capa));
		else:
			$resultados['mapa'] = call_user_func('obtenerPuntosCapa_'.$_POST['capa']);
		endif;
	endif; 
	if(isset($_POST['busqueda']) and trim($_POST['busqueda']) !=''){
		$post_type_listado ="'cultura','deporte','desarrollo-social','faqs','gestion-publica','guia-tramite','inspector','obras','prensa','salud','secretaria-gobierno','seguridad','sm-consciente'";
		$post_type_mapa="'puntos-verdes','sm-mascotas','animales-perdidos','tribe_venue','remis','charter','micro-municipal','tren','estacion-de-servicio','taxi','transporte-escolar'";
		$filtro_cultura = "";
		if(isset($_POST['puntosculturales']))
			$filtro_cultura = " ID IN (".$_POST['puntosculturales'].") AND ";
		$posts = $wpdb->get_results("SELECT p.post_title as nombre_punto,p.ID as id_punto,p.post_type FROM $wpdb->posts as p WHERE 
											post_type IN (".$post_type_listado.",".$post_type_mapa.") AND  $filtro_cultura
											post_status='publish' AND (
																		post_title LIKE '%".$_POST['busqueda']."%' OR
																		post_content LIKE '%".$_POST['busqueda']."%')  ORDER BY post_title ASC");


        $post_type_listado = str_replace("'", "", $post_type_listado);
        $post_type_listado = explode(',', $post_type_listado);
        $post_type_mapa= str_replace("'", "", $post_type_mapa);
        $post_type_mapa= explode(',', $post_type_mapa); 
        foreach ($posts as $post) {
               if( in_array($post->post_type, $post_type_listado) or ( ( $post->post_type == 'sm-mascotas' or  $post->post_type == 'animales-perdidos' ) and ! has_term( array('perdidas','encontradas'), 'mascotas',$post->id_punto ) ))
               	   $resultados['listado'][] = $post;
               else{
               	    if( $post->post_type == 'sm-mascotas' or  $post->post_type == 'animales-perdidos' ):
               	    	$capa = 'mascotas';
               	    elseif($post->post_type =='puntos-verdes'):
               	    	$capa = 'puntosverdes';
               	    elseif( $post->post_type =='tribe_venue'):
               	    	$capa = 'cultura';
               	    elseif(in_array($post->post_type, array('remis','charter','micro-municipal','tren','estacion-de-servicio','taxi','transporte-escolar') )):
               	    	$capa='transporte';
               	    endif;
               	    if(!isset($_POST['capas_activas']))
               	    	$_POST['capas_activas'] = array();
               	    if(!in_array($capa, $_POST['capas_activas']))
               	    	$_POST['capas_activas'][] = $capa;
               		$post->tipo= get_tipo($post->id_punto,$post->post_type);
               		$resultados['mapa'][] = $post;
               }
               	   

               }       
	}

	return $resultados;
}

function imprimirMarkerPuntoFarmacia($punto){
    if(isset($_POST['marker']) and $_POST['marker'] == $punto->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$punto->id_punto);
	$tipo = $punto->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
  $icon .= 'point-farmacias.png';
  $textoTipo = '<strong>Teléfono:</strong>&nbsp;'.get_field("telefono",$punto->id_punto); 
  $thumb = get_bloginfo( 'template_directory' ).'/images/farmacia.png';
	$es_visible = "false";
	if($punto->es_visible)
		$es_visible = "true";
    $letras = get_option('turnos_'.date('Y'));
    $letra = $letras[date('j')][date('n')];	
    if(get_field('letra',$punto->id_punto) == $letra)
    	$turno = 'true';
    else
    	$turno = 'false';
    if(get_field('atencion_24_hs',$punto->id_punto))
    	$veinticuatro = 'true';
    else
    	$veinticuatro = 'false';
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			permalink:'',
			marca:'',
			ID: '".$punto->id_punto."',
			activo: '".$activo."',
			capa:'farmacia',
			title: \"".$punto->nombre_punto."\",
			textoTipo:'".$textoTipo."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			thumb:'".$thumb."',
			veinticuatroh:".$veinticuatro.",
			turno:".$turno.",
			es_visible: ".$es_visible.",
			direc: '".get_field('direcion',$punto->id_punto)."'
			 },";	
}

function imprimirMarkerPuntoVerde($punto){
    if(isset($_POST['marker']) and $_POST['marker'] == $punto->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$punto->id_punto);
	$tipo = $punto->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	switch ($tipo ) {
		case 'Contenedor':
			  $icon .= 'contenedores.png';
			  $textoTipo = 'Contenedor';
			  $thumb = get_bloginfo( 'template_directory' ).'/images/map-contenedores.jpg';
			break;
		
		default:
			$icon .= 'point-recycle.png';
			$textoTipo = 'Centro de Reciclaje';
			$thumb = get_bloginfo( 'template_directory' ).'/images/map-reciclado.jpg';
			break;
	}
	$es_visible = "false";
	if($punto->es_visible)
		$es_visible = "true";
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			permalink:'',
			marca:'',
			ID: '".$punto->id_punto."',
			activo: '".$activo."',
			capa:'puntosverdes',
			title: \"".$punto->nombre_punto."\",
			textoTipo:'".$textoTipo."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			thumb:'".$thumb."',
			veinticuatroh:false,
			turno:false,			
			es_visible: ".$es_visible.",
			direc: '".get_field('direccion',$punto->id_punto)."'
			 },";
}


function imprimirMarkerCultura($punto){
    if(isset($_POST['marker']) and $_POST['marker'] == $punto->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = array();
	$lat = get_post_meta( $punto->id_punto, '_VenueLat', true );
	$lng = get_post_meta( $punto->id_punto, '_VenueLng', true );
	$address = get_post_meta( $punto->id_punto, '_VenueGeoAddress', true );
	$tipo = $punto->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	switch ($tipo ) {
		case 'biblioteca-municipal':
			  $icon .= 'point-bibliotecas.png';
			  $textoTipo = 'Biblioteca';
			break;
		case 'escuelas-de-arte':
			  $icon .= 'point-escuelas-de-arte.png';
			  $textoTipo = 'Escuela de arte';
			break;
		case 'exposiciones-y-eventos':
			  $icon .= 'point-salon-de-exposiciones.png';
			  $textoTipo = 'Exposiciones y Eventos';
			break;
		case 'teatros':
			  $icon .= 'point-teatros.png';
			  $textoTipo = 'Teatro';
			break;		
		case 'escuelas-deportivas':
			  $icon .= 'point-escuela-deportiva.png';
			  $textoTipo = 'Escuela Deportiva';
			break;
		case 'otros':
			  $icon .= 'point-otros.png';
			  $textoTipo = 'Otros';
			break;														
		case 'centros-culturales':
			$icon .= 'point-centros-culturales.png';
			$textoTipo = 'Centro cultural';
			break;
	} 
	$es_visible = "false";
	if($punto->es_visible)
		$es_visible = "true";
	$thumb = wp_get_attachment_image_src ( get_post_thumbnail_id( $punto->id_punto ), 'thumbnail' );
	$thumb = $thumb[0];
	echo "{ lat:'".$lat."',
	        lng: '".$lng."',
			map: map,
			marca:'',
			ID: '".$punto->id_punto."',
			permalink:'".get_permalink( $punto->id_punto )."',
			activo: '".$activo."',
			capa:'cultura',
			title: \"".$punto->nombre_punto."\",
			textoTipo:'".$textoTipo."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			veinticuatroh:false,
			turno:false,			
			es_visible: ".$es_visible.",
			thumb:'".$thumb."',
			direc: '".$address."'
			 },";
}

function imprimirMarkerMascota($mascota){
    if(isset($_POST['marker']) and $_POST['marker'] == $mascota->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$mascota->id_punto);
	$tipo = $mascota->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	switch ($tipo ) {
		case 'perdidas':
			  $icon .= 'point-perdi.png';
			  $textoTipo = 'Mascota Perdida';
			break;
		default:
			$icon .= 'point-encontre.png';
			$textoTipo = 'Mascota Encontrada';
			break;
	}
	$es_visible = "false";
	if($mascota->es_visible)
		$es_visible = "true";
	$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($mascota->id_punto), 'thumbnail' );
	$thumb = $thumb[0];
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			activo: '".$activo."',
			permalink:'".get_permalink( $mascota->id_punto )."',
			title: \"".$mascota->nombre_punto."\",
			tipo: '".$tipo."',
			ID: '".$mascota->id_punto."',
			textoTipo:'".$textoTipo."',
			thumb:'".$thumb."',
			icon: '".$icon."',
			capa:'mascotas',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: '".$ubicacion['address']."'
			 },";
}


function imprimirMarkerCentroDeSalud($marker){
    if(isset($_POST['marker']) and $_POST['marker'] == $marker->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$marker->id_punto);
	$tipo = $marker->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	$thumb = $icon;
	$term = get_term_by( 'slug', $tipo, 'tipos-de-centro-de-salud' );
	switch ($tipo) {
		case 'centros-de-atencion-especializada':
			$icon .= 'point-salud-centros.png';
			$thumb .= 'centros-de-atencion-salud.png';		
			break;
		case 'centros-de-atencion-primaria':
			$icon .= 'point-salud-centros-de-atencion-primaria.png';
			$thumb .= 'centros-de-atencion-primaria.png';		
			break;
		case 'escuela':
			$icon .= 'point-salud-escuelas-de-enfermeria.png';
			$thumb .= 'centros-escuela-de-enfermeria.png';		
			break;
		case 'hospitales':
			$icon .= 'point-salud-hospitales.png';
			$thumb .= 'centros-de-atencion-hospitales.png';
			break;
		case 'salud-mental-y-adicciones':
			$icon .= 'point-salud-centros-de-salud-mental.png';
			$thumb .= 'centros-de-salud-mental.png';
			break;		
		case 'cdif':
			$icon .= 'point-cdif.png';
			$thumb .= 'thumb-cdif.png';
			break;				
		default:
			$icon .= 'point-salud-centros.png';
			$thumb .= 'centros-de-atencion-salud.png';
			break;
	}

	$textoTipo = $term->name."<br>";

	if(get_field('telefono_centro',$marker->id_punto)):
		$textoTipo .= "<strong>Teléfono:</strong>&nbsp;";
        while(has_sub_field('telefono_centro',$marker->id_punto)): 
        	$textoTipo .=  get_sub_field('numero_de_telefono')." | ";
		endwhile;   
		$textoTipo = substr($textoTipo, 0,-3);
    endif;
	$es_visible = "false";
	if($marker->es_visible)
		$es_visible = "true";
	
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			activo: '".$activo."',
			permalink:'',
			title: \"".$marker->nombre_punto."\",
			tipo: '".$tipo."',
			ID: '".$marker->id_punto."',
			textoTipo:'".$textoTipo."',
			thumb:'".$thumb."',
			icon: '".$icon."',
			capa:'centro-de-salud',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: '".str_replace(array('"',"'"), array('\"',"\'"), get_field('direccion',$marker->id_punto))."'
			 },";
}

function imprimirMarkerEntretenimiento($marker){
    if(isset($_POST['marker']) and $_POST['marker'] == $marker->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$marker->id_punto);
	$tipo = $marker->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	$thumb = $icon;
	$term = get_term_by( 'slug', $tipo, 'areas-de-entretenimiento' );
	switch ($term->slug) {
		case 'bares':
		case 'boliches':
		case 'restaurantes':
			$icon  .= 'point-'.$term->slug.'.png';
			$thumb .= 'popup-'.$term->slug.'.jpg';
			break;				
		default:
			$icon  .= 'point-bares.png';
			$thumb .= 'popup-bares.jpg';
			break;
	}

	$textoTipo = "<strong>Rubro: </strong>&nbsp;".$term->name."<br>".
				 "<strong>Horario: </strong>&nbsp;".get_field("horarios",$marker->id_punto)."<br>".
				 "<strong>Estacionamiento: </strong>&nbsp;".get_field("estacionamiento_entre",$marker->id_punto)."<br>".
				 "<strong>Delivery: </strong>&nbsp;".get_field("sistema_de_reparto_entre",$marker->id_punto);


	$es_visible = "false";
	if($marker->es_visible)
		$es_visible = "true";
	
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			activo: '".$activo."',
			permalink:'',
			title: \"".$marker->nombre_punto."\",
			tipo: '".$tipo."',
			ID: '".$marker->id_punto."',
			textoTipo:'".$textoTipo."',
			thumb:'".$thumb."',
			icon: '".$icon."',
			capa:'entretenimiento',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: '".get_field('domicilio_entre',$marker->id_punto)."'
			 },";
}

function imprimirMarkerWifi($marker){
    if(isset($_POST['marker']) and $_POST['marker'] == $marker->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$marker->id_punto);
	$tipo = $marker->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/';
	$thumb = $icon;
	$term = get_term_by( 'slug', $tipo, 'categoria-de-punto-wifi' );
	switch ($tipo) {
		case 'cultura-wifi':
			$icon .= 'point-wifi-cultura.png';
			$thumb .= 'wifi-cultura.jpg';
			break;
		case 'desarrollo-social-wifi':
			$icon .= 'point-wifi-desarrollo-social.png';
			$thumb .= 'wifi-desarrollo-social.jpg';
			break;
		case 'gestion-publica-wifi':
			$icon .= 'point-wifi-gestion-publica.png';
			$thumb .= 'wifi-gestion-publica.jpg';
			break;	
		case 'palacio-municipal-wifi':
			$icon .= 'point-wifi-palacio-municipal.png';
			$thumb .= 'wifi-palacio-municipal.jpg';
			break;	
		case 'salud-wifi':
			$icon .= 'point-wifi-salud.png';
			$thumb .= 'wifi-salud.jpg';
			break;			
		default:
			$icon .= 'point-wifi.png';
			break;
	}
	$textoTipo = $term->name;
	$es_visible = "false";
	if($marker->es_visible)
		$es_visible = "true";
	
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			activo: '".$activo."',
			permalink:'',
			title: \"".$marker->nombre_punto."\",
			tipo: '".$tipo."',
			ID: '".$marker->id_punto."',
			textoTipo:'".$textoTipo."',
			thumb:'".$thumb."',
			icon: '".$icon."',
			capa:'punto-wifi',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: '".str_replace(array('"',"'"), array('\"',"\'"), get_field('direccion',$marker->id_punto))."'
			 },";
}

function imprimirMarkerAlerta($marcador){
    if(isset($_POST['marker']) and $_POST['marker'] == $marcador->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$marcador->id_punto);
	$tipo = $marcador->tipo;
	$icon = get_bloginfo( 'template_directory' ).'/images/point-alerta-vial.png';
	$thumb = get_bloginfo( 'template_directory' ).'/images/mapa-alertas.jpg';
	if(strtolower(get_field('nivel_de_criticidad',$marcador->id_punto)) =='alto'){
		$icon = get_bloginfo( 'template_directory' ).'/images/point-alerta-via-critico.png';
		$thumb = get_bloginfo( 'template_directory' ).'/images/mapa-alertas-critica.jpg';
	}
	$textoTipo = get_the_content( strip_tags($marcador->id_punto ) );
		
	$es_visible = "true";
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			permalink:'',
			ID: '".$marcador->id_punto."',
			activo: '".$activo."',
			capa:'alerta',
			title: \"".$marcador->nombre_punto."\",
			textoTipo:'".$textoTipo."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			thumb:'".$thumb."',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: '".$ubicacion['address']."'
			 },";	
}

function imprimirMarkerRemis($marcador){
	$p = get_post($marcador->id_punto);
	$content = "<p>".preg_replace( "/\r|\n/", "", $p->post_content )."</p>";
    if(isset($_POST['marker']) and $_POST['marker'] == $marcador->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$marcador->id_punto);
	$tipo = $marcador->tipo;
	if($marcador->tipo == 'charter'){
		$icon = get_bloginfo( 'template_directory' ).'/images/point-charters.png';
		$thumb = get_bloginfo( 'template_directory' ).'/images/map-charters.jpg';
		$textoTipo = get_field('telefono',$marcador->id_punto)." ".get_field('barrio',$marcador->id_punto);
	}
	elseif($marcador->tipo == 'taxi'){
		$icon = get_bloginfo( 'template_directory' ).'/images/point-taxis.png';
		$thumb = get_bloginfo( 'template_directory' ).'/images/map-taxis.jpg';	
		$textoTipo = get_field('telefono',$marcador->id_punto)." ".get_field('barrio',$marcador->id_punto);
	}
	elseif($marcador->tipo == 'remis'){
		$icon = get_bloginfo( 'template_directory' ).'/images/point-remises.png';	
		$thumb = get_bloginfo( 'template_directory' ).'/images/map-remises.jpg';
		$textoTipo = get_field('telefono',$marcador->id_punto)." ".get_field('barrio',$marcador->id_punto);
		//$content = "<h1>REEEEMI</h1>";
		
	}
	elseif($marcador->tipo == 'gomeria'){
		$icon = get_bloginfo( 'template_directory' ).'/images/point-gomerias.png';	
		$thumb = get_bloginfo( 'template_directory' ).'/images/transporte-gomerias.png';
		$textoTipo = get_field('telefono',$marcador->id_punto)." ".get_field('barrio',$marcador->id_punto);
		
	}	
	elseif($marcador->tipo == 'transporte-escolar'){
		$icon = get_bloginfo( 'template_directory' ).'/images/point-bus.png';
		$thumb = get_bloginfo( 'template_directory' ).'/images/map-bus.jpg';
		$textoTipo = get_field('telefono',$marcador->id_punto)." ".get_field('barrio',$marcador->id_punto);
	}
	elseif($marcador->tipo == 'estacionamiento'){
		$cubierto = "No";
		if(get_field('cubierto',$marcador->id_punto))
			$cubierto = "Si";
		$icon = get_bloginfo( 'template_directory' ).'/images/point-estacionamiento.png';
		$thumb = get_bloginfo( 'template_directory' ).'/images/transporte-estacionamiento.png'; 
		$textoTipo  = "<strong>Horario:</strong>&nbsp;".get_field('horarios',$marcador->id_punto)."<br>".
					 "<strong>Plazas:</strong>&nbsp;".get_field('plazas',$marcador->id_punto)."<br>".
					 "<strong>Cubierto:</strong>&nbsp;".$cubierto;
	}			
	$es_visible = "false";
	if($marcador->es_visible)
		$es_visible = "true";
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			marca:'',
			permalink:'',
			ID: '".$marcador->id_punto."',
			activo: '".$activo."',
			capa:'transporte',
			title: \"".$marcador->nombre_punto."\",
			textoTipo:'".$content.$textoTipo."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			thumb:'".$thumb."',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: '".str_replace(array('"',"'"), array('\"',"\'"), get_field('direccion',$marcador->id_punto))."'
			 },";
}

function imprimirMarkerCharter($marker){
	$p = get_post($marker->id_punto);
	$content = "<p>".preg_replace( "/\r|\n/", "", $p->post_content )."</p>";
	global $wpdb;
    if(isset($_POST['marker']) and $_POST['marker'] == $marker->id_punto )
    	$activo = 1;
    else
    	$activo = 0;	
	$ubicacion = get_field('parada_central',$marker->id_punto);    
    $paradas = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE post_id='".$marker->id_punto."' and meta_key LIKE 'paradas_%_coordenadas'");
    $recorrido = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE post_id='".$marker->id_punto."' and meta_key LIKE 'recorrido_%_puntos_recorrido'");
    
		$thumb = get_bloginfo( 'template_directory' ).'/images/map-charters.jpg';
		$icon = get_bloginfo( 'template_directory' ).'/images/point-charters.png';
		$linea =$marker->nombre_punto;
	$es_visible = "false";
	if($marker->es_visible)
		$es_visible = "true";
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
	        recorrido: [";
	        
 	if($recorrido){
	 	foreach ($recorrido as $coordenadas) {
	 		$coordenadas = unserialize($coordenadas->meta_value);
	 		if(!is_array($coordenadas)) $coordenadas = unserialize($coordenadas);
	 		echo '{"lat":"'.$coordenadas['lat'].'","lng":"'.$coordenadas['lng'].'","icon":"'.get_bloginfo('template_directory').'/images/busstop.png"},';
	 	}
	 }
 	echo "],	        
	        paradas: [";

 	if($paradas){
	 	foreach ($paradas as $coordenadas) {
	 		$coordenadas = unserialize($coordenadas->meta_value);
	 		if(!is_array($coordenadas)) $coordenadas = unserialize($coordenadas);
	 		echo '{"nombreParada":"'.$coordenadas['address'].'", "lat":"'.$coordenadas['lat'].'","lng":"'.$coordenadas['lng'].'","icon":"'.get_bloginfo('template_directory').'/images/busstop.png"},';
	 	}
	 }
 	echo "], 	
			map: map,
			ID: '".$marker->id_punto."',
			activo: '".$activo."',
			permalink:'',
			linea: '".$linea."',
			marca:'',
			color:'".get_field('color',$marker->id_punto)."',
			title: \"".$marker->nombre_punto."\",
			tipo: '".$marker->post_type."',
			textoTipo:'".$content."',
			thumb:'".$thumb."',
			icon: '".$icon."',
			capa:'transporte',
			es_visible:".$es_visible.",
			veinticuatroh:false,
			turno:false,			
			direc: '".str_replace(array('"',"'"), array('\"',"\'"), get_field('direccion',$marker->id_punto))."'
			 },";   
}

function imprimirMarkerRecorrido($marker){
	global $wpdb;
    if(isset($_POST['marker']) and $_POST['marker'] == $marker->id_punto )
    	$activo = 1;
    else
    	$activo = 0;	
    $recorrido = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE post_id='".$marker->id_punto."' and meta_key LIKE 'recorrido_%_puntos_recorrido'");
    $paradas = $wpdb->get_results("SELECT meta_value FROM $wpdb->postmeta WHERE post_id='".$marker->id_punto."' and meta_key LIKE 'paradas_%_coordenadas'");
	if($marker->tipo == 'micro-municipal'){
		$icon = get_bloginfo( 'template_directory' ).'/images/map-micros.jpg';
		$linea = get_field("letra_numero",$marker->id_punto);
	}
	elseif($marker->tipo == 'tren'){
		$icon = get_bloginfo( 'template_directory' ).'/images/map-trenes.jpg';
		$linea =$marker->nombre_punto;
		
	}
	$es_visible = "false";
	if($marker->es_visible)
		$es_visible = "true";
 	echo "{ recorrido: [";
 	if($recorrido){
	 	foreach ($recorrido as $coordenadas) {
	 		$coordenadas = unserialize($coordenadas->meta_value);
	 		if(!is_array($coordenadas)) $coordenadas = unserialize($coordenadas);
	 		echo '{"lat":"'.$coordenadas['lat'].'","lng":"'.$coordenadas['lng'].'"},';
	 	}
	 }
 	echo "],";
 	echo "paradas: [";
 	if($paradas){
	 	foreach ($paradas as $coordenadas) {
	 		$coordenadas = unserialize($coordenadas->meta_value);
	 		if(!is_array($coordenadas)) $coordenadas = unserialize($coordenadas);
	 		echo '{"nombreParada":"'.$coordenadas['address'].'","lat":"'.$coordenadas['lat'].'","lng":"'.$coordenadas['lng'].'","icon":"'.get_bloginfo('template_directory').'/images/busstop.png"},';
	 	}
	 }
 	echo "], 	
			map: map,
			ID: '".$marker->id_punto."',
			activo: '".$activo."',
			permalink:'',
			linea: '".$linea."',
			marca:'',
			color:'".get_field('color',$marker->id_punto)."',
			title: \"".$marker->nombre_punto."\",
			tipo: '".$marker->post_type."',
			textoTipo:'',
			thumb:'".$icon."',
			icon: '',
			capa:'transporte',
			veinticuatroh:false,
			turno:false,			
			es_visible:".$es_visible.",
			direc: ''
			 },";   
}

function imprimirMarkerEstacion($marcador){
	$p = get_post($marcador->id_punto);
	$content = "<p>".preg_replace( "/\r|\n/", "", $p->post_content )."</p>";

    if(isset($_POST['marker']) and $_POST['marker'] == $marcador->id_punto )
    	$activo = 1;
    else
    	$activo = 0;
	$ubicacion = get_field('ubicacion',$marcador->id_punto);
	$texto_combustible ="Líquidos";
	if(get_field("gnc",$marcador->id_punto))
		$texto_combustible .= " / Gnc";
	$tipo = $marcador->tipo;

	$icon = get_bloginfo( 'template_directory' ).'/images/point-'.sanitize_title( get_field('marca',$marcador->id_punto) ).'.png';
	$icon= str_replace(array('sol-aspro','otros'),array('aspro','estaciones'),$icon);
	$thumb = get_bloginfo( 'template_directory' ).'/images/gasolina-'.sanitize_title( get_field('marca',$marcador->id_punto) ).'.jpg';
	$thumb= str_replace(array('sol-aspro','gasolina-otros'),array('aspro','map-estaciones'),$thumb);

	$es_visible = "false";
	if($marcador->es_visible)
		$es_visible = "true";
	echo "{ lat:'".$ubicacion['lat']."',
	        lng: '".$ubicacion['lng']."',
			map: map,
			permalink:'',
			marca:'".get_field('marca',$marcador->id_punto)."',
			ID: '".$marcador->id_punto."',
			activo: '".$activo."',
			capa:'transporte',
			title: \"".$marcador->nombre_punto."\",
			textoTipo:'".$content.get_field('marca',$marcador->id_punto)." ".$texto_combustible."',
			tipo: '".$tipo."',
			icon: '".$icon."',
			es_visible:".$es_visible.",
			thumb:'".$thumb."',
			veinticuatroh:false,
			turno:false,			
			direc: '".str_replace(array('"',"'"), array('\"',"\'"), get_field('direccion',$marcador->id_punto))."'
			 },";
}

function imprimirArrayPuntos($marcadores){

        echo "var puntos = [ ";
		if(sizeof($marcadores) > 0 ): 
	       foreach ($marcadores as $marcador): 
	       	$marcador->nombre_punto = str_replace(array('"',"'"), array('\"',"\'"), $marcador->nombre_punto);
	       	$marcador->address = str_replace(array('"',"'"), array('\"',"\'"), $marcador->address);

	       	    switch ($marcador->post_type) {
	       	    	case 'sm-mascotas':
	       	    		        imprimirMarkerMascota($marcador);
	       	    		break;
	       	    	case 'animales-perdidos':
	       	    		        imprimirMarkerMascota($marcador);
	       	    		break;	       	    		
	       	    	case 'puntos-verdes':
	       	    		        imprimirMarkerPuntoVerde($marcador);
	       	    		break;  
	       	    	case 'farmacia':
	       	    		        imprimirMarkerPuntoFarmacia($marcador);
	       	    		break; 	       	    		  
	       	    	case 'tribe_venue':
	       	    		        imprimirMarkerCultura($marcador);
	       	    		break;	 
	       	    	case 'tren':
	       	    	case 'micro-municipal':
	       	    				imprimirMarkerRecorrido($marcador);
	       	    		break;
	       	    	case 'taxi':
	       	    	case 'remis':
	       	    	case 'estacionamiento':
	       	    	case 'gomeria':
	       	    	case 'transporte-escolar':
	       	    				imprimirMarkerRemis($marcador);
	       	    		break;
	       	    		break;
	       	    	case 'charter':
	       	    		imprimirMarkerCharter($marcador);
	       	    	break;
	       	    	case 'alerta':	       	    	
		       	    		imprimirMarkerAlerta($marcador);
	       	    	break;	       	    	
	       	    	case 'estacion-de-servicio':
	       	    				imprimirMarkerEstacion($marcador);
	       	    		break;	
	       	    	case 'punto-wifi':
	       	    		imprimirMarkerWifi($marcador);
	       	    		break; 
	       	    	case 'entretenimiento':
	       	    		imprimirMarkerEntretenimiento($marcador);
	       	    		break;  
	       	    	case 'centro-de-salud':
	       	    		imprimirMarkerCentroDeSalud($marcador);
	       	    		break; 	       	    		 	       	    		   		   	    	
	       	    	default:
	       	    		//		imprimirMarker($marcador);
	       	    		break;
	       	    }

	        endforeach;
	    endif;
        echo "]; ";	
}

function tildarCapas($puntos){
/*if(isset($_POST['capas_activas']) ): 
    if(is_array($_POST['capas_activas'])):
        foreach ($_POST['capas_activas'] as $capa):
            echo 'jQuery("input[capa=\''.$capa.'\']").prop("checked",true); ';
        endforeach;
    else:
            echo 'jQuery("input[capa=\''.$_POST['capas_activas'].'\']").prop("checked",true); ';
    endif;

endif;	
    */

foreach ($puntos as $punto) {
	if($punto->es_visible){
		$capa = $punto->_capa;
		$tipo = $punto->tipo;
		$id = $punto->id_punto;
		
		echo 'jQuery(".capaChk[capa=\''.$capa.'\']").prop("checked",true);'."\n";
		echo 'jQuery(".capaChk2[value=\''.$tipo.'\']").prop("checked",true);'."\n";
		if(   ($punto->tipo =='tren') and 
			  ( ( isset($_POST['marker']) and $_POST['marker']  == $id ) or !isset($_POST['marker']))  ){
			echo 'jQuery(".capaChk3[value=\''.$id.'\']").prop("checked",true);'."\n";
		}
		elseif(   ($punto->tipo =='micro-municipal') and 
			  ( ( isset($_POST['marker']) and $_POST['marker']  == $id ) or !isset($_POST['marker']))  ){
			$linea = get_field('letra_numero',$punto->id_punto);
			if(isset($_POST['marker']))
				$linea_marker = get_field('letra_numero',$_POST['marker']);
			else
				$linea_marker ='';
			if(   ($linea_marker !='' and $linea == $linea_marker) or $linea_marker =='' )
				echo 'jQuery(".capaChk3[value=\''.$linea.'\']").prop("checked",true);'."\n";			
			echo 'jQuery(".capaChk3[value=\''.$id.'\']").prop("checked",true);'."\n";
			echo 'jQuery(".capaChk4[value=\''.$id.'\']").prop("checked",true);'."\n";
		}		
		elseif($punto->tipo =='estacion-de-servicio') {
			$marca = get_field('marca',$punto->id_punto);
			if(isset($_POST['marker']))
				$capa_marker = get_field('marca',$_POST['marker']);
			else
				$capa_marker ='';
			if(   ($capa_marker !='' and $marca == $capa_marker) or $capa_marker =='' )
				echo 'jQuery(".capaChk3[value=\''.$marca.'\']").prop("checked",true);'."\n";

		}
		elseif($punto->tipo =='micro-municipal') {
			$linea = get_field('letra_numero',$punto->id_punto);
			if(isset($_POST['marker']))
				$linea_marker = get_field('letra_numero',$_POST['marker']);
			else
				$linea_marker ='';
			if(   ($linea_marker !='' and $linea == $linea_marker) or $linea_marker =='' )
				echo 'jQuery(".capaChk3[value=\''.$linea.'\']").prop("checked",true);'."\n";

		}		
	}
}
}


function imprimirCapasActivas(){
	echo " var capas_activas = [];";
	if(isset($_POST['busqueda']) and trim($_POST['busqueda'])=='')
		$_POST['capas_activas'] = $_POST['capa'];
	foreach ($_POST['capas_activas'] as $capa) {
		echo "capas_activas.push('".$capa."');\n";
	}
}

function cantPuntosActivos($resultados,$capas ){
	$i=0;
	$equiv = array(
					'animales-perdidos' => 'mascotas',
					'puntos-verdes' => 'puntosverdes',
					'tribe_venue' => 'cultura',
					'micro-municipal' => 'transporte',
					'remis' => 'transporte',
					'taxi' => 'transporte',
					'estacion-de-servicio' => 'transporte',
					'charter' => 'transporte',
					'tren' => 'transporte',
					'transporte-escolar' => 'transporte'
 
		);
	foreach ($resultados as $r) {
		if (in_array($equiv[$r->post_type], $capas) or $r->post_type==$_POST['tipo'])
			$i++;
	}
	return $i; 
}




function getMarcasESSS(){
	global $wpdb;
	return $wpdb->get_results("SELECT DISTINCT(m.meta_value) FROM $wpdb->posts as p 
							   INNER JOIN $wpdb->postmeta as m ON p.ID = m.post_id 
							   WHERE p.post_type='estacion-de-servicio' AND m.meta_key='marca' AND p.post_status='publish' ORDER BY meta_value ASC");
}



function obtenerLineas(){
	global $wpdb;
	return $wpdb->get_results("SELECT DISTINCT(m.meta_value) FROM wp_posts as p
							   INNER JOIN wp_postmeta as m
							   ON p.ID = m.post_id
							   WHERE p.post_type='micro-municipal' AND m.meta_key='letra_numero' AND p.post_status='publish'
							   ORDER BY meta_value DESC");
}

function obtenerRecorridosDeLinea($linea){
	global $wpdb;
	return $wpdb->get_results("SELECT p.* FROM wp_posts as p
							   INNER JOIN wp_postmeta as m
							   ON p.ID = m.post_id
							   WHERE p.post_type='micro-municipal' AND m.meta_key='letra_numero' AND m.meta_value='".$linea."' AND p.post_status='publish'
							   ORDER BY p.post_title DESC");	
}
/*
		FUNCIONES NUEVO BUSCADOR
	---------------------------------------
*/

function bsm_esPuntoVisible($title,$content,$post,$capa){

	$title = strtolower($title);
	$content = strtolower($content);
	if(	(isset($_POST['busqueda']) and trim($_POST['busqueda']) !='') 	){
		$busqueda = strtolower( trim($_POST['busqueda']) );
		return (strpos($title,$busqueda) !== false or strpos($content,$busqueda) !== false);
	}
	elseif( (isset($_POST['tipo']) and $_POST['tipo'] == 'micro-municipal'  ) and isset($_POST['marker']) and $_POST['marker'] !=$post->id_punto)
		return false;
	elseif( (isset($_POST['tipo']) and $_POST['tipo'] == 'micro-municipal'  ) and isset($_POST['marker']) and $_POST['marker'] ==$post->id_punto)
		return true;	
	elseif( ( isset($_POST['tipo']) and $_POST['tipo'] == get_tipo($post->id_punto,$post->post_type)) or  (isset($_POST['tipo']) and $_POST['tipo']== $post->post_type ) or (isset($_POST['tipo']) and $_POST['tipo']== 'puntosverdes' and $post->post_type=='puntos-verdes' ) or (isset($_POST['tipo']) and $_POST['tipo']== 'transporte' and $capa=='transporte' ))
		return true;
	elseif(isset($_POST['tipo']) and $_POST['tipo']!= $post->post_type)
		return false;
	else
		return true;
}


function bsm_obtener_puntos(){
	global $wpdb;
	$resultados = array();
	$post_type_mapa="'alerta', 'gomeria', 'centro-de-salud', 'farmacia', 'entretenimiento____no_va_mas', 'punto-wifi','puntos-verdes','sm-mascotas____no_va_mas','animales-perdidos____no_va_mas','tribe_venue','remis','charter','micro-municipal','tren','estacionamiento', 'estacion-de-servicio','taxi','transporte-escolar'";
	$posts = $wpdb->get_results("SELECT p.post_title as nombre_punto,p.ID as id_punto,p.post_type ,p.post_content FROM $wpdb->posts as p WHERE post_type IN ($post_type_mapa) AND post_status='publish' ORDER BY  post_type DESC");
	$post_type_mapa= explode(',', str_replace("'", "", $post_type_mapa)); 

	foreach ($posts as $post){
		$eliminar = false;
		if( $post->post_type == 'sm-mascotas' or  $post->post_type == 'animales-perdidos' ):
			$capa = 'mascotas';
		elseif( $post->post_type == 'centro-de-salud' ):
			$capa = 'centro-de-salud';
		elseif( $post->post_type == 'alerta' ):
			$capa = 'alerta';		
		elseif( $post->post_type == 'entretenimiento' ):
			$capa = 'entretenimiento';
		elseif( $post->post_type == 'farmacia' ):
			$capa = 'farmacia';					
		elseif($post->post_type =='puntos-verdes'):
			$capa = 'puntosverdes';
		elseif( $post->post_type =='tribe_venue'):
			$capa = 'cultura';
			$lat = get_post_meta( $post->id_punto, '_VenueLat', true );
			if(!$lat or $lat ==''):
				$eliminar = true;
			endif;
		elseif(in_array($post->post_type, array('gomeria', 'estacionamiento', 'remis','charter','micro-municipal','tren','estacion-de-servicio','taxi','transporte-escolar') )):
			$capa='transporte';
		elseif($post->post_type=='punto-wifi'):
			$capa = 'punto-wifi';
		endif;
		$post->es_visible = bsm_esPuntoVisible($post->nombre_punto,$post->post_content,$post,$capa);
		if(!isset($_POST['capas_activas']))
			$_POST['capas_activas'] = array();
		if(!in_array($capa, $_POST['capas_activas']) and $post->es_visible and isset($_POST['busqueda']) and trim($_POST['busqueda']) !='')
			$_POST['capas_activas'][] = $capa;
		$post->tipo= get_tipo($post->id_punto,$post->post_type);
		$post->_capa = $capa;
		if($post->tipo){		
		if ( ! (( $post->post_type == 'sm-mascotas' or  $post->post_type == 'animales-perdidos' ) and ! has_term( array('perdidas','encontradas'), 'mascotas',$post->id_punto ) ) ){
			if($post->post_type == 'alerta'){
				$terms = wp_get_post_terms( $post->id_punto,'categoria-de-alerta' );

   				if($terms[0]->term_id==169 && get_field('fecha_de_disparo',$post->id_punto) == date('Ymd')){
   					$resultados[] = $post;
   				}
			}
			else{
				if(!$eliminar )
					$resultados[] = $post;
			}

		}
		}
	}   
	return $resultados;
}

function bsm_limpiarBusquedaVaciaYSetearCapasActivas(){	
    if(isset($_POST['busqueda']) and $_POST['busqueda'] =='') unset($_POST['busqueda']);
    if(sizeof($_POST) == 0):
        $_POST['capas_activas'] = array('alerta','centro-de-salud', 'mascotas','puntosverdes','cultura','transporte','punto-wifi','entretenimiento','farmacia'); 
        $_POST['capa'] = $_POST['capas_activas']; 
    else:
        $_POST['capas_activas'] = array($_POST['capa']); 
        $_POST['capa'] = array('alerta','centro-de-salud', 'mascotas','puntosverdes','cultura','transporte','punto-wifi','entretenimiento','farmacia');        
    endif;
}


function bsm_obtener_listado(){
	global $wpdb;
	if(isset($_POST['busqueda']) and trim($_POST['busqueda']) !=''){
		$post_type_listado ="'cultura','deporte','desarrollo-social','faqs','gestion-publica','guia-tramite','inspector','obras','prensa','salud','secretaria-gobierno','seguridad','sm-consciente'";
		$posts = $wpdb->get_results("SELECT p.post_title as nombre_punto,p.ID as id_punto,p.post_type FROM $wpdb->posts as p WHERE 
											post_type IN (".$post_type_listado.") AND 
											post_status='publish' AND (
												post_title COLLATE UTF8_GENERAL_CI LIKE '%".$_POST['busqueda']."%' OR
												post_content COLLATE UTF8_GENERAL_CI LIKE '%".$_POST['busqueda']."%'
											)  
									 ORDER BY post_title ASC");


        $post_type_listado = str_replace("'", "", $post_type_listado);
        $post_type_listado = explode(',', $post_type_listado);
        foreach ($posts as $post) {
            if( in_array($post->post_type, $post_type_listado) or 
            	( ( $post->post_type == 'sm-mascotas' or  $post->post_type == 'animales-perdidos' ) and 
            	! has_term( array('perdidas','encontradas'), 'mascotas',$post->id_punto ) ) )
               	$resultados[] = $post;
        }       
	}
	return $resultados;	
}


function bsm_cantPuntosActivos( $puntos_mapa ){
	$cant =0;
	foreach ($puntos_mapa as $punto) {
		if( $punto->es_visible ) $cant++;
	}
	return $cant;
}

 ?>