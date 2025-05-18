<?php

function crear_cronograma_cpt()
{
	$args = array(
		'label' => 'Cronogramas',
		'public' => true,
		'supports' => array('title', 'editor'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'cronogramas'),
	);
	register_post_type('cronograma', $args);
}
add_action('init', 'crear_cronograma_cpt');

function agregar_campo_pagina_superior()
{
	add_meta_box(
		'pagina_superior_meta_box',
		'Página Superior',
		'mostrar_campo_pagina_superior',
		'cronograma',
		'side',
		'high'
	);
}
add_action('add_meta_boxes', 'agregar_campo_pagina_superior');

function mostrar_campo_pagina_superior($post)
{
	$pages = get_pages();
	$selected_page = get_post_meta($post->ID, '_pagina_superior', true);

	echo '<select name="pagina_superior" id="pagina_superior">';
	echo '<option value="">Seleccionar Página</option>';
	foreach ($pages as $page) {
		$selected = ($selected_page == $page->ID) ? 'selected' : '';
		echo '<option value="' . $page->ID . '" ' . $selected . '>' . $page->post_title . '</option>';
	}
	echo '</select>';
}

function guardar_campo_pagina_superior($post_id)
{
	if (array_key_exists('pagina_superior', $_POST)) {
		update_post_meta($post_id, '_pagina_superior', $_POST['pagina_superior']);
	}
}
add_action('save_post', 'guardar_campo_pagina_superior');


function agregar_campos_cronograma()
{
	add_meta_box(
		'detalles_cronograma', // ID
		'Detalles del Cronograma', // Título
		'mostrar_campos_cronograma', // Callback
		'cronograma' // Post Type
	);
}
add_action('add_meta_boxes', 'agregar_campos_cronograma');

function mostrar_campos_cronograma($post)
{
	$fecha_desde = get_post_meta($post->ID, 'fecha_desde', true);
	$fecha_hasta = get_post_meta($post->ID, 'fecha_hasta', true);
	$barrio = get_post_meta($post->ID, 'barrio', true);
	$lugar = get_post_meta($post->ID, 'lugar', true);
	$domicilio = get_post_meta($post->ID, 'domicilio', true);
	$observaciones = get_post_meta($post->ID, 'observaciones', true);

?>
<div style="border:1px solid red;padding:20px;margin-bottom:30px;color:red;">
	No te olvides de seleccionar en la parte superior la "PAGINA SUPERIOR" ( El area a la que pertenece este cronograma )
</div>

<div style="display:flex;flex-flow:column;margin-bottom:10px;">
	<label for="fecha_desde">Fecha desde:</label>
    <input type="date" name="fecha_desde" value="<?php echo esc_attr($fecha_desde); ?>" />
</div>

<div style="display:flex;flex-flow:column;margin-bottom:10px;">
	<label for="fecha_hasta">Fecha hasta:</label>
    <input type="date" name="fecha_hasta" value="<?php echo esc_attr($fecha_hasta); ?>" />
</div>

<div style="display:flex;flex-flow:column;margin-bottom:10px;">
	<label for="barrio">Barrio:</label>
	<input type="text" name="barrio" value="<?php echo esc_attr($barrio); ?>" />
</div>

<div style="display:flex;flex-flow:column;margin-bottom:10px;">
	<label for="lugar">Lugar:</label>
	<input type="text" name="lugar" value="<?php echo esc_attr($lugar); ?>" />
</div>

<div style="display:flex;flex-flow:column;margin-bottom:10px;">
	<label for="domicilio">Domicilio:</label>
	<input type="text" name="domicilio" value="<?php echo esc_attr($domicilio); ?>" />
</div>

<div style="display:flex;flex-flow:column;margin-bottom:10px;">
	<label for="observaciones">Observaciones:</label>
	<textarea name="observaciones"><?php echo esc_textarea($observaciones); ?></textarea>
</div>
<?php
}

function guardar_campos_cronograma($post_id)
{
	if (array_key_exists('fecha_desde', $_POST)) {
		update_post_meta($post_id, 'fecha_desde', sanitize_text_field($_POST['fecha_desde']));
	}
	if (array_key_exists('fecha_hasta', $_POST)) {
		update_post_meta($post_id, 'fecha_hasta', sanitize_text_field($_POST['fecha_hasta']));
	}
	if (array_key_exists('barrio', $_POST)) {
		update_post_meta($post_id, 'barrio', sanitize_text_field($_POST['barrio']));
	}
	if (array_key_exists('lugar', $_POST)) {
		update_post_meta($post_id, 'lugar', sanitize_text_field($_POST['lugar']));
	}
	if (array_key_exists('domicilio', $_POST)) {
		update_post_meta($post_id, 'domicilio', sanitize_text_field($_POST['domicilio']));
	}
	if (array_key_exists('observaciones', $_POST)) {
		update_post_meta($post_id, 'observaciones', sanitize_textarea_field($_POST['observaciones']));
	}
}
add_action('save_post', 'guardar_campos_cronograma');

function custom_cronograma_rewrite_rule()
{
	// Crear una regla de reescritura para las páginas que tienen cronograma
	add_rewrite_rule('^(.+)/cronograma/?$', 'index.php?pagename=$matches[1]&cronograma=true', 'top');
}
add_action('init', 'custom_cronograma_rewrite_rule');

function load_cronograma_template($template)
{
	if (get_query_var('cronograma')) {
		$new_template = locate_template(array('page-cronograma.php'));
		if (!empty($new_template)) {
			return $new_template;
		}
	}
	return $template;
}
add_filter('template_include', 'load_cronograma_template');