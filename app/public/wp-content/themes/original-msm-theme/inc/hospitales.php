<?php

// Registrar el custom post type "Hospitales"
function crear_hospitales()
{
	$labels = array(
		'name'               => 'Hospitales',
		'singular_name'      => 'Hospital',
		'menu_name'          => 'Hospitales',
		'name_admin_bar'     => 'Hospital',
		'add_new'            => 'Añadir Nuevo',
		'add_new_item'       => 'Añadir Nuevo Hospital',
		'new_item'           => 'Nuevo Hospital',
		'edit_item'          => 'Editar Hospital',
		'view_item'          => 'Ver Hospital',
		'all_items'          => 'Todos los Hospitales',
		'search_items'       => 'Buscar Hospitales',
		'not_found'          => 'No se encontraron hospitales.',
		'not_found_in_trash' => 'No se encontraron hospitales en la papelera.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'hospitales'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'thumbnail'),
		'menu_icon'          => 'dashicons-building',
	);

	register_post_type('hospitales', $args);
}
add_action('init', 'crear_hospitales');

// Agregar campos personalizados
function agregar_campos_hospitales()
{
	add_meta_box('detalles_hospitales', 'Detalles del Hospital', 'campos_detalles_hospitales', 'hospitales', 'normal', 'high');
}
add_action('add_meta_boxes', 'agregar_campos_hospitales');

function campos_detalles_hospitales($post)
{
	// Valores actuales
	$ubicacion = get_post_meta($post->ID, 'ubicacion', true) ?? '';
	$direccion = get_post_meta($post->ID, 'direccion', true) ?? '';
	$localidad = get_post_meta($post->ID, 'localidad', true) ?? '';
	$telefono = get_post_meta($post->ID, 'telefono', true) ?? '';
	$horario_apertura = get_post_meta($post->ID, 'horario_apertura', true) ?? '';
	$horario_cierre = get_post_meta($post->ID, 'horario_cierre', true) ?? '';
	$especialidades = get_post_meta($post->ID, 'especialidades', true) ?? [];
	$atiende_24hs = get_post_meta($post->ID, 'atiende_24hs', true) ?? '';

	// Campo de especialidades (options) - Lista específica para Hospitales
	$especialidades_options = [
		'Cardiología',
		'Cirugía General',
		'Clínica Médica',
		'Dermatología',
		'Diagnóstico por Imágenes',
		'Endocrinología',
		'Gasteroenterología',
		'Ginecología',
		'Guardia 24hs',
		'Hemoterapia',
		'Infectología',
		'Kinesiología',
		'Laboratorio',
		'Maternidad',
		'Neonatología',
		'Neumonología',
		'Neurología',
		'Nutrición',
		'Obstetricia',
		'Odontología',
		'Oncología',
		'Oftalmología',
		'Otorrinolaringología',
		'Pediatría',
		'Psicología',
		'Psiquiatría',
		'Rayos X',
		'Salud Mental',
		'Tomografía',
		'Traumatología',
		'Terapia Intensiva (UTI)'
	];

?>
	<label for="ubicacion">Ubicación (Enlace al mapa o iframe):</label><br />
	<input type="text" name="ubicacion" value="<?php echo esc_attr($ubicacion); ?>" style="width:100%;" /><br /><br />

	<label for="direccion">Dirección:</label><br />
	<input type="text" name="direccion" value="<?php echo esc_attr($direccion); ?>" style="width:100%;" /><br /><br />

	<label for="localidad">Localidad:</label><br />
	<input type="text" name="localidad" value="<?php echo esc_attr($localidad); ?>" style="width:100%;" /><br /><br />

	<label for="telefono">Teléfono:</label><br />
	<input type="text" name="telefono" value="<?php echo esc_attr($telefono); ?>" style="width:100%;" /><br /><br />

	<label for="horario_apertura">Horario de Apertura:</label><br />
	<input type="text" name="horario_apertura" value="<?php echo esc_attr($horario_apertura); ?>" style="width:100%;" /><br /><br />

	<label for="horario_cierre">Horario de Cierre:</label><br />
	<input type="text" name="horario_cierre" value="<?php echo esc_attr($horario_cierre); ?>" style="width:100%;" /><br /><br />

	<label for="especialidades">Especialidades:</label><br />
	<select name="especialidades[]" multiple="multiple" size="10" style="width:100%;">
		<?php foreach ($especialidades_options as $opcion): ?>
			<option value="<?php echo esc_attr($opcion); ?>" <?php selected(in_array($opcion, (array)$especialidades)); ?>>
				<?php echo esc_html($opcion); ?>
			</option>
		<?php endforeach; ?>
	</select><br />
	<small>Mantén presionado `Ctrl` (Windows) o `Cmd` (Mac) para seleccionar varias opciones.</small><br /><br />

	<label for="atiende_24hs">Atiende Guardia 24hs:</label><br />
	<input type="checkbox" name="atiende_24hs" value="yes" <?php checked($atiende_24hs, 'yes'); ?> /><br /><br />
<?php
}

function guardar_campos_hospitales($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (!current_user_can('edit_post', $post_id)) return;

	// Evitar guardar en otros post types
	if (get_post_type($post_id) !== 'hospitales') return;

	update_post_meta($post_id, 'ubicacion', sanitize_text_field($_POST['ubicacion'] ?? ''));
	update_post_meta($post_id, 'direccion', sanitize_text_field($_POST['direccion'] ?? ''));
	update_post_meta($post_id, 'localidad', sanitize_text_field($_POST['localidad'] ?? ''));
	update_post_meta($post_id, 'telefono', sanitize_text_field($_POST['telefono'] ?? ''));
	update_post_meta($post_id, 'horario_apertura', sanitize_text_field($_POST['horario_apertura'] ?? ''));
	update_post_meta($post_id, 'horario_cierre', sanitize_text_field($_POST['horario_cierre'] ?? ''));

	if (isset($_POST['especialidades'])) {
		$especialidades = array_map('sanitize_text_field', $_POST['especialidades']);
		update_post_meta($post_id, 'especialidades', $especialidades);
	} else {
		delete_post_meta($post_id, 'especialidades');
	}

	update_post_meta($post_id, 'atiende_24hs', isset($_POST['atiende_24hs']) ? 'yes' : 'no');
}

add_action('save_post', 'guardar_campos_hospitales');
