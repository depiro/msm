<?php // Addons Custom Post Type Event
function create_event_post_type()
{
	$labels = array(
		'name'               => __('Eventos', 'msmtheme'),
		'singular_name'      => __('Evento', 'msmtheme'),
		'menu_name'          => __('Eventos', 'msmtheme'),
		'name_admin_bar'     => __('Evento', 'msmtheme'),
		'add_new'            => __('Agregar Nuevo', 'msmtheme'),
		'add_new_item'       => __('Agregar Nuevo Evento', 'msmtheme'),
		'new_item'           => __('Nuevo Evento', 'msmtheme'),
		'edit_item'          => __('Editar Evento', 'msmtheme'),
		'view_item'          => __('Ver Evento', 'msmtheme'),
		'all_items'          => __('Todos los Eventos', 'msmtheme'),
		'search_items'       => __('Buscar Eventos', 'msmtheme'),
		'not_found'          => __('No se encontraron eventos.', 'msmtheme'),
		'not_found_in_trash' => __('No se encontraron eventos en la papelera.', 'msmtheme'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'eventos'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'taxonomies' => array('category'),
		'menu_icon'          => 'dashicons-calendar',
		'supports'           => array('title', 'editor', 'thumbnail'),
		'show_in_rest' 		 => true,
		'template'            => array(), // Puedes definir plantillas predeterminadas aquí si es necesario
		'template_lock'       => 'all',  // Opcional: puedes bloquear la plantilla si es necesario
	);
	register_post_type('event', $args);
}
add_action('init', 'create_event_post_type');


function add_event_meta_boxes()
{
	add_meta_box('event_details', __('Detalles del Evento', 'msmtheme'), 'render_event_meta_box', 'event', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_event_meta_boxes');

function render_event_meta_box($post)
{
	wp_nonce_field('event_nonce', 'event_nonce_field');
	$event_date = get_post_meta($post->ID, '_event_date', true);
	$event_time = get_post_meta($post->ID, '_event_time', true);
	$event_location = get_post_meta($post->ID, '_event_location', true);
?>
	<div style="display:flex;flex-flow:column;width:50%;margin-top:20px;">
		<label for="event_date" style="font-size:16px;font-weight:bold;"><?php echo __('Fecha', 'msmtheme') ?> </label>
		<input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date) ?>" />
	</div>
	<div style="display:flex;flex-flow:column;width:50%;margin-top:20px;">
		<label for="event_time" style="font-size:16px;font-weight:bold;"><?php echo __('Hora', 'msmtheme') ?></label>
		<input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event_time) ?>" />
	</div>
	<div style="display:flex;flex-flow:column;width:50%;margin-top:20px;">
		<label for="event_location" style="font-size:16px;font-weight:bold;"><?php echo __('Lugar (Dirección Completa)', 'msmtheme') ?></label>
		<input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location) ?>" style="width: 100%;" />
	</div>
<?php
}


function save_event_meta_box($post_id)
{
	if (!isset($_POST['event_nonce_field']) || !wp_verify_nonce($_POST['event_nonce_field'], 'event_nonce')) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	if (isset($_POST['event_date'])) {
		update_post_meta($post_id, '_event_date', sanitize_text_field($_POST['event_date']));
	}
	if (isset($_POST['event_time'])) {
		update_post_meta($post_id, '_event_time', sanitize_text_field($_POST['event_time']));
	}
	if (isset($_POST['event_location'])) {
		update_post_meta($post_id, '_event_location', sanitize_text_field($_POST['event_location']));
	}

	// Guardar categorías seleccionadas
	if (isset($_POST['tax_input']['category'])) {
		wp_set_object_terms($post_id, (array) $_POST['tax_input']['category'], 'category');
	}
}
add_action('save_post', 'save_event_meta_box');




function create_event_taxonomy()
{
	$labels = array(
		'name'              => _x('Categorías de Eventos', 'taxonomy general name', 'msmtheme'),
		'singular_name'     => _x('Categoría de Evento', 'taxonomy singular name', 'msmtheme'),
		'search_items'      => __('Buscar Categorías', 'msmtheme'),
		'all_items'         => __('Todas las Categorías', 'msmtheme'),
		'parent_item'       => __('Categoría Padre', 'msmtheme'),
		'parent_item_colon' => __('Categoría Padre:', 'msmtheme'),
		'edit_item'         => __('Editar Categoría', 'msmtheme'),
		'update_item'       => __('Actualizar Categoría', 'msmtheme'),
		'add_new_item'      => __('Agregar Nueva Categoría', 'msmtheme'),
		'new_item_name'     => __('Nombre de Nueva Categoría', 'msmtheme'),
		'menu_name'         => __('Categorías de Eventos', 'msmtheme'),
	);
	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'event-category'),
	);
	register_taxonomy('event_category', array('event'), $args);
}
add_action('init', 'create_event_taxonomy');

// REST API

function create_event_category($request)
{
	$name = sanitize_text_field($request['name']); // Nombre de la categoría
	$slug = isset($request['slug']) ? sanitize_title($request['slug']) : ''; // Slug de la categoría (opcional)
	$parent = isset($request['parent']) ? intval($request['parent']) : 0; // ID de la categoría padre (opcional)

	// Validar que el nombre de la categoría esté presente
	if (empty($name)) {
		return new WP_Error('no_name', 'No se proporcionó un nombre para la categoría', array('status' => 400));
	}

	// Si se proporcionó un ID de categoría padre, verificar que la categoría exista
	if ($parent > 0) {
		$parent_term = get_term($parent, 'event_category');
		if (is_wp_error($parent_term) || !$parent_term) {
			return new WP_Error('invalid_parent', 'El ID de la categoría padre no es válido', array('status' => 400));
		}
	}

	// Crear la categoría en la taxonomía 'event_category'
	$term = wp_insert_term($name, 'event_category', array(
		'slug'   => $slug,
		'parent' => $parent, // Asignar la categoría padre
	));

	// Verificar si hubo un error al crear la categoría
	if (is_wp_error($term)) {
		return new WP_Error('error_creating_term', $term->get_error_message(), array('status' => 500));
	}

	// Devolver la respuesta de la nueva categoría creada
	return rest_ensure_response($term);
}

// GET_EVENT_CATEGORIES Y REGISTER_EVENT_CATEGORIES_ROUTE

/*Obtiene y devuelve las categorías de eventos desde la taxonomía event_category,
formateadas con ID, nombre, slug y conteo de publicaciones asociadas.*/

function get_event_categories($request)
{
	$search = isset($request['search']) ? sanitize_text_field($request['search']) : '';

	$args = array(
		'taxonomy'   => 'event_category',
		'hide_empty' => false,
		'search'     => $search,
	);

	$terms = get_terms($args);
	if (is_wp_error($terms)) {
		return rest_ensure_response([]);
	}
	$formatted_terms = [];
	foreach ($terms as $term) {
		$formatted_terms[] = [
			'id'    => $term->term_id,
			'name'  => $term->name,
			'slug'  => $term->slug,
			'count' => $term->count,
		];
	}
	return rest_ensure_response($formatted_terms);
}

/*
Cuando se realiza una solicitud GET a esta ruta,
se invoca la función get_event_categories,
que devolverá la lista de categorías de eventos disponibles.
*/
function register_event_categories_route()
{
	register_rest_route('custom/v1', '/event-categories', array(
		array(
			'methods'             => 'GET',
			'callback'            => 'get_event_categories',
			'permission_callback' => '__return_true',
		),
		array(
			'methods'             => 'POST',
			'callback'            => 'create_event_category',
			'permission_callback' => '__return_true',
		),
	));
}
add_action('rest_api_init', 'register_event_categories_route');



/* Devuelve una lista de plantillas personalizadas para eventos desde un directorio específico,
con cada plantilla representada por un nombre de archivo y un ID sanitizado. */
function enable_custom_event_templates()
{
	$formatted_templates = [];
	$template_dir = get_template_directory() . '/templates/event-templates/';
	$files = glob($template_dir . '*.php');

	foreach ($files as $file) {
		$filename = basename($file);
		$formatted_templates[] = [
			'name' => $filename,
			'id' => sanitize_title($filename),
		];
	}
	return rest_ensure_response($formatted_templates);
}


/* Registra un nuevo endpoint en la API REST de WordPress que,
al ser accedido mediante una solicitud GET,
devuelve la lista de plantillas personalizadas disponibles. */
function register_custom_event_templates_route()
{
	register_rest_route('custom/v1', '/event-templates', array(
		'methods' => 'GET',
		'callback' => 'enable_custom_event_templates',
		'permission_callback' => '__return_true',
	));
}
add_action('rest_api_init', 'register_custom_event_templates_route');

/*
Ejemplo de respuesta de enable_custom_event_templates y register_custom_event_templates_route
[
    {
        "name": "event-with-sidebar.php",
        "id": "event-with-sidebar"
    },
    {
        "name": "event-full-width.php",
        "id": "event-full-width"
    }
]

*/



/*Esta función se encarga de añadir un "meta box" (cuadro de metadatos) al
editor de entradas para el tipo de post personalizado event. */
function add_event_template_meta_box()
{
	add_meta_box(
		'event_template_meta_box',      // ID del meta box
		__('Seleccionar Plantilla', 'msmtheme'), // Título del meta box
		'render_event_template_meta_box', // Función para mostrar el contenido del meta box
		'event',                         // Tipo de post (tu CPT)
		'side',                          // Contexto (dónde aparece en el editor)
		'default'                        // Prioridad
	);
}
add_action('add_meta_boxes', 'add_event_template_meta_box');

/* Esta función muestra el contenido del meta box que se añadió con add_event_template_meta_box(). */
function render_event_template_meta_box($post)
{
	// Verifica el nonce
	wp_nonce_field('save_event_template_meta_box', 'event_template_meta_box_nonce');

	// Obtiene la plantilla seleccionada
	$selected_template = get_post_meta(get_the_ID(), '_wp_page_template', true);

	$template_dir = get_template_directory() . '/templates/event-templates/';
	$files = glob($template_dir . '*.php');
	foreach ($files as $file) {
		$filename = basename($file);
		$templates[$filename] = $filename;
	}


?>
	<p>
		<!-- <label for="event_template"><?php _e('Selecciona una plantilla', 'msmtheme'); ?></label> -->
		<select name="event_template" id="event_template">
			<option value=""><?php _e('Selecciona una plantilla', 'msmtheme'); ?></option>
			<span><?php echo $selected_template ?></span>
			<?php foreach ($templates as $template_name => $template_file): ?>
				<option value="<?php echo esc_attr($template_file); ?>" <?php selected($selected_template, $template_file); ?>>
					<?php echo esc_html($template_name); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>
<?php
}

/*Esta función guarda el valor seleccionado en el meta box cuando se guarda o actualiza una entrada.*/
function save_event_template_meta_box($post_id)
{
	// Verifica el nonce
	if (!isset($_POST['event_template_meta_box_nonce']) || !wp_verify_nonce($_POST['event_template_meta_box_nonce'], 'save_event_template_meta_box')) {
		return;
	}

	// Verifica los permisos del usuario
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Guarda el valor del template seleccionado
	if (isset($_POST['event_template'])) {
		update_post_meta($post_id, '_wp_page_template', sanitize_text_field($_POST['event_template']));
	}
}
add_action('save_post', 'save_event_template_meta_box');


function apply_event_template($template)
{
	if (is_singular('event')) {
		$template_file = get_post_meta(get_the_ID(), '_wp_page_template', true);
		if ($template_file && file_exists(get_template_directory() . '/' . $template_file)) {
			return get_template_directory() . '/' . $template_file;
		}
	}
	return $template;
}
add_filter('template_include', 'apply_event_template');


function add_custom_event_fields()
{
	$meta_args = array(
		'type'         => 'string',
		'description'  => 'A meta key associated with a string meta value.',
		'single'       => true,
		'show_in_rest' => true,
	);
	register_post_meta('event', 'template', $meta_args);
}
add_action('init', 'add_custom_event_fields');



function add_custom_template_field_to_rest_api()
{
	register_rest_field('event', 'template', array(
		'get_callback' => function ($post) {
			return get_post_meta($post['id'], '_wp_page_template', true);
		},
		'update_callback' => function ($value, $post) {
			return update_post_meta($post->ID, '_wp_page_template', sanitize_text_field($value));
		},
		'schema' => array(
			'description' => 'Plantilla del post',
			'type'        => 'string',
			'context'     => array('view', 'edit'),
		),
	));
}
add_action('rest_api_init', 'add_custom_template_field_to_rest_api');


function register_event_meta_fields()
{
	register_rest_field(
		'event',
		'event_date',
		array(
			'get_callback'    => 'get_event_date_meta',
			'update_callback' => 'update_event_date_meta',
			'schema'          => array(
				'description' => 'Event date.',
				'type'        => 'string',
				'context'     => array('view', 'edit'),
			),
		)
	);

	register_rest_field(
		'event',
		'event_time',
		array(
			'get_callback'    => 'get_event_time_meta',
			'update_callback' => 'update_event_time_meta',
			'schema'          => array(
				'description' => 'Event time.',
				'type'        => 'string',
				'context'     => array('view', 'edit'),
			),
		)
	);

	register_rest_field(
		'event',
		'event_location',
		array(
			'get_callback'    => 'get_event_location_meta',
			'update_callback' => 'update_event_location_meta',
			'schema'          => array(
				'description' => 'Event location.',
				'type'        => 'string',
				'context'     => array('view', 'edit'),
			),
		)
	);
}

function get_event_date_meta($object, $field_name, $request)
{
	return get_post_meta($object['id'], '_event_date', true);
}

function update_event_date_meta($value, $object, $field_name)
{
	update_post_meta($object->ID, '_event_date', sanitize_text_field($value));
	return $value;
}

function get_event_time_meta($object, $field_name, $request)
{
	return get_post_meta($object['id'], '_event_time', true);
}

function update_event_time_meta($value, $object, $field_name)
{
	update_post_meta($object->ID, '_event_time', sanitize_text_field($value));
	return $value;
}

function get_event_location_meta($object, $field_name, $request)
{
	return get_post_meta($object['id'], '_event_location', true);
}

function update_event_location_meta($value, $object, $field_name)
{
	update_post_meta($object->ID, '_event_location', sanitize_text_field($value));
	return $value;
}

add_action('rest_api_init', 'register_event_meta_fields');


function custom_event_rewrite_rules()
{
	add_rewrite_rule(
		'^eventos/?$',
		'index.php?post_type=event',
		'top'
	);
}
add_action('init', 'custom_event_rewrite_rules');
