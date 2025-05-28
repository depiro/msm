<?php 
  
/***********	Incluyo otros archivos necesarios ***********/

//require_once("MapaPuntosVerdes.class.php");

// require get_template_directory() . '/inc/funciones_mapsengine.php';
/**
 *  Obtiene los tipos de calendarios de tasas municipales
 */
	function getTiposTasasMunicipales(){
        global $wpdb;
        $id_field_group = $wpdb->get_var("SELECT ID FROM $wpdb->posts 
        								  WHERE post_name='acf_campos-de-tasas-municipales' AND 
        								  		post_status='publish'");
        $tipos = $wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta 
        						 WHERE 	post_id=$id_field_group AND 
        						 		meta_value LIKE '%s:4:\"Tipo\"%'") ; 
        $tipos = unserialize($tipos);
        unset($tipos['choices']['-']);
        return $tipos['choices'];
	}
/**
 *  Guarda los datos enviados por post como un nuevo inscripto al registro no me llames
 */
function guardarRegistroNoMeLlames(){
	global $wpdb;
	$existe = $wpdb->get_var("SELECT count(*) FROM $wpdb->posts as P
		                      INNER JOIN $wpdb->postmeta as M 
		                      ON P.ID = M.post_id 
		                      WHERE P.post_type='inscripto' AND 
		                            M.meta_key='telefono' AND 
		                            M.meta_value='".$_POST['tel_nml']."'");
	if($existe == 0):
			$post_id = wp_insert_post(
		    array(
		      'comment_status'  => 'closed',
		      'ping_status'   => 'closed',
		      'post_name'   => sanitize_title( $_POST['name_nml'] ),
		      'post_title'    => $_POST['name_nml'],
		      'post_status'   => 'publish',
		      'post_type'   => 'inscripto'
		    )
		  );
			add_post_meta( $post_id, 'email', $_POST['email_nml']);
			add_post_meta( $post_id, 'telefono', '(011)'.$_POST['tel_nml1'].'-'.$_POST['tel_nml2']);
			add_post_meta( $post_id, 'celular', '(011) 15 '.$_POST['cel_nml1'].'-'.$_POST['cel_nml2']);			
			add_post_meta( $post_id, 'localidad', $_POST['localidad_nml']);
	endif;

}

function obtenerIDCalendario($tipo){
 global $wpdb;
 return $wpdb->get_var("SELECT ID FROM $wpdb->posts as P
 							INNER JOIN $wpdb->postmeta as M 
 							ON P.ID = M.post_id
 							WHERE P.post_type='tasa-municipal' AND
 							      M.meta_key='tipo' AND 
 							      M.meta_value='".$tipo."' AND 
 							      P.post_date LIKE '%".date('Y')."%'
 							ORDER BY post_date DESC LIMIT 1");
}
function separarInpectoresEnColumnas($posts){

	$cols = array(array(),array());
	$i = 1;
	foreach ($posts as $post):
		if ($i % 2 == 0)
			$cols[1][] = $post;
		else
			$cols[0][] = $post;
		$i++;
	endforeach;
	return $cols;
}

function getTipoPuntosVerdes(){
	global $wpdb;
	$customField = unserialize($wpdb->get_var("SELECT meta_value FROM $wpdb->postmeta WHERE meta_key='field_540786ff0da2d'"));
	return $customField['choices'];
}

function obtenerLineasMicros(){
	global $wpdb;
	return $wpdb->get_results("SELECT post_title,ID FROM $wpdb->posts WHERE post_type='micro-municipal' and post_status='publish'");
}

function obtenerLineasTrenes(){
	global $wpdb;
	return $wpdb->get_results("SELECT post_title,ID FROM $wpdb->posts WHERE post_type='tren' and post_status='publish'");
}

	// $tipos_transporte = array(
	// 						"taxi" => "Taxis",
	// 						"remis" => "Remises",
	// 						"charter" =>"Charters",
	// 						"micro-municipal" => "Colectivos",
	// 						"tren" => "trenes",
	// 						"estacion-de-servicio" => "Estaciones de Servicio",
	// 						"transporte-escolar" => "Transportes Escolares");

	// foreach ($tipos_transporte as $type => $label) {
	// 	add_submenu_page( 'san-miguel-transporte', 'Introducción '.$label, 'Introducción '.$label, 'edit_posts', 'edit.php?post_type='.$type.'&page=introduction_'.$type, 'edit.php?post_type='.$type.'&page=introduction_'.$type ); 
	// }
	// //add_submenu_page( 'edit.php?post_type=farmacia', 'Introducción Farmacias', 'Introducción Farmacias', 'manage_options', 'edit.php?post_type=farmacia&page=introduction_farmacia', 'edit.php?post_type=farmacia&page=introduction_farmacia' ); 

 ?>