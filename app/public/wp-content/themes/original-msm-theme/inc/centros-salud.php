<?php

// Registrar el custom post type "Centros de Salud"
function crear_centros_salud()
{
	$labels = array(
		'name'               => 'Centros de Salud',
		'singular_name'      => 'Centro de Salud',
		'menu_name'          => 'Centros de Salud',
		'name_admin_bar'     => 'Centro de Salud',
		'add_new'            => 'Añadir Nuevo',
		'add_new_item'       => 'Añadir Nuevo Centro de Salud',
		'new_item'           => 'Nuevo Centro de Salud',
		'edit_item'          => 'Editar Centro de Salud',
		'view_item'          => 'Ver Centro de Salud',
		'all_items'          => 'Todos los Centros de Salud',
		'search_items'       => 'Buscar Centros de Salud',
		'not_found'          => 'No se encontraron centros de salud.',
		'not_found_in_trash' => 'No se encontraron centros de salud en la papelera.'
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'centros-salud'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor', 'thumbnail'),
	);

	register_post_type('centros_salud', $args);
}
add_action('init', 'crear_centros_salud');

// Agregar campos personalizados
function agregar_campos_centros_salud()
{
	add_meta_box('detalles_centros_salud', 'Detalles del Centro de Salud', 'campos_detalles_centros_salud', 'centros_salud', 'normal', 'high');
}
add_action('add_meta_boxes', 'agregar_campos_centros_salud');

function campos_detalles_centros_salud($post)
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

	// Campo de especialidades (options)
	$especialidades_options = [
		'Asistencia social',
		'Cardiología',
		'Cardiología Infantil',
		'Clínica',
		'Cirugía plástica',
		'Cirugía Vascular',
		'Counselling',
		'Dermatología',
		'Ecografías',
		'Endocrinología',
		'Enfermería',
		'Fonoaudiología',
		'Gastroenterología',
		'Generalista',
		'Ginecología',
		'Infectología',
		'Infectología infantil',
		'Infectología neo',
		'Kinesiología',
		'Kinesiología Neurológica',
		'Mamografía',
		'Neumonología',
		'Neurología infantil',
		'Neurología Adultos',
		'Nutrición',
		'Obstetricia',
		'Odontología',
		'Otorrinolanringología',
		'Pediatría',
		'Psicóloga',
		'Psicopedagogía',
		'Rayos',
		'Rehabilitación Respiratoria',
		'Reumatología',
		'Traumatología',
		'Técnica Electrocardiograma',
		'Vacunación',
		'Laboratorio: Laboratorio',
		'Resonancia Magnética',
		'Traumatología 24hs',
		'Clínica Médica 24hs',
		'Pediatría 24hs',
		'Enfermería 24hs',
		'Placas Odontológicas',
	];

?>
	<label for="ubicacion">Ubicación:</label><br />
	<input type="text" name="ubicacion" value="<?php echo esc_attr($ubicacion); ?>" /><br /><br />

	<label for="direccion">Dirección:</label><br />
	<input type="text" name="direccion" value="<?php echo esc_attr($direccion); ?>" /><br /><br />

	<label for="localidad">Localidad:</label><br />
	<input type="text" name="localidad" value="<?php echo esc_attr($localidad); ?>" /><br /><br />

	<label for="telefono">Teléfono:</label><br />
	<input type="text" name="telefono" value="<?php echo esc_attr($telefono); ?>" /><br /><br />

	<label for="horario_apertura">Horario de Apertura:</label><br />
	<input type="text" name="horario_apertura" value="<?php echo esc_attr($horario_apertura); ?>" /><br /><br />

	<label for="horario_cierre">Horario de Cierre:</label><br />
	<input type="text" name="horario_cierre" value="<?php echo esc_attr($horario_cierre); ?>" /><br /><br />

	<label for="especialidades">Especialidades:</label><br />
	<select name="especialidades[]" multiple="multiple" size="5">
		<?php foreach ($especialidades_options as $opcion): ?>
			<option value="<?php echo esc_attr($opcion); ?>" <?php selected(in_array($opcion, (array)$especialidades)); ?>>
				<?php echo esc_html($opcion); ?>
			</option>
		<?php endforeach; ?>
	</select><br /><br />

	<label for="atiende_24hs">Atiende 24hs:</label><br />
	<input type="checkbox" name="atiende_24hs" value="yes" <?php checked($atiende_24hs, 'yes'); ?> /><br /><br />
<?php
}


function guardar_campos_centros_salud($post_id)
{
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (!current_user_can('edit_post', $post_id)) return;

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

add_action('save_post', 'guardar_campos_centros_salud');
