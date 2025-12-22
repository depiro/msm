<?php
// Addons Custom Post Type Event
function create_event_post_type()
{
	$labels = array(
		'name' => __('Eventos', 'msmtheme'),
		'singular_name' => __('Evento', 'msmtheme'),
		'menu_name' => __('Eventos', 'msmtheme'),
		'name_admin_bar' => __('Evento', 'msmtheme'),
		'add_new' => __('Agregar Nuevo', 'msmtheme'),
		'add_new_item' => __('Agregar Nuevo Evento', 'msmtheme'),
		'new_item' => __('Nuevo Evento', 'msmtheme'),
		'edit_item' => __('Editar Evento', 'msmtheme'),
		'view_item' => __('Ver Evento', 'msmtheme'),
		'all_items' => __('Todos los Eventos', 'msmtheme'),
		'search_items' => __('Buscar Eventos', 'msmtheme'),
		'not_found' => __('No se encontraron eventos.', 'msmtheme'),
		'not_found_in_trash' => __('No se encontraron eventos en la papelera.', 'msmtheme'),
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'eventos'),
		'capability_type' => 'post',
		'has_archive' => true,
		'hierarchical' => false,
		'menu_position' => 5,
		'taxonomies' => array('category'),
		'menu_icon' => 'dashicons-calendar',
		'supports' => array('title', 'editor', 'thumbnail'),
		'show_in_rest' => true,
		'template' => array(),
		'template_lock' => 'all',
	);

	register_post_type('event', $args);
}
add_action('init', 'create_event_post_type');


// META BOX DETALLES (event)
function add_event_meta_boxes()
{
	add_meta_box(
		'event_details',
		__('Detalles del Evento', 'msmtheme'),
		'render_event_meta_box',
		'event',
		'normal',
		'high'
	);
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
		<label for="event_date" style="font-size:16px;font-weight:bold;"><?php echo __('Fecha', 'msmtheme'); ?></label>
		<input type="date" id="event_date" name="event_date" value="<?php echo esc_attr($event_date); ?>" />
	</div>
	<div style="display:flex;flex-flow:column;width:50%;margin-top:20px;">
		<label for="event_time" style="font-size:16px;font-weight:bold;"><?php echo __('Hora', 'msmtheme'); ?></label>
		<input type="time" id="event_time" name="event_time" value="<?php echo esc_attr($event_time); ?>" />
	</div>
	<div style="display:flex;flex-flow:column;width:50%;margin-top:20px;">
		<label for="event_location"
			style="font-size:16px;font-weight:bold;"><?php echo __('Lugar (Dirección Completa)', 'msmtheme'); ?></label>
		<input type="text" id="event_location" name="event_location" value="<?php echo esc_attr($event_location); ?>"
			style="width: 100%;" />
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


// TAXONOMÍA event_category
function create_event_taxonomy()
{
	$labels = array(
		'name' => _x('Categorías de Eventos', 'taxonomy general name', 'msmtheme'),
		'singular_name' => _x('Categoría de Evento', 'taxonomy singular name', 'msmtheme'),
		'search_items' => __('Buscar Categorías', 'msmtheme'),
		'all_items' => __('Todas las Categorías', 'msmtheme'),
		'parent_item' => __('Categoría Padre', 'msmtheme'),
		'parent_item_colon' => __('Categoría Padre:', 'msmtheme'),
		'edit_item' => __('Editar Categoría', 'msmtheme'),
		'update_item' => __('Actualizar Categoría', 'msmtheme'),
		'add_new_item' => __('Agregar Nueva Categoría', 'msmtheme'),
		'new_item_name' => __('Nombre de Nueva Categoría', 'msmtheme'),
		'menu_name' => __('Categorías de Eventos', 'msmtheme'),
	);

	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'show_admin_column' => true,
		'query_var' => true,
		'rewrite' => array('slug' => 'event-category'),
	);

	register_taxonomy('event_category', array('event'), $args);
}
add_action('init', 'create_event_taxonomy');


// REST: CREAR / LISTAR CATEGORÍAS
function create_event_category($request)
{
	$name = sanitize_text_field($request['name']);
	$slug = isset($request['slug']) ? sanitize_title($request['slug']) : '';
	$parent = isset($request['parent']) ? intval($request['parent']) : 0;

	if (empty($name)) {
		return new WP_Error('no_name', 'No se proporcionó un nombre para la categoría', array('status' => 400));
	}

	if ($parent > 0) {
		$parent_term = get_term($parent, 'event_category');
		if (is_wp_error($parent_term) || !$parent_term) {
			return new WP_Error('invalid_parent', 'El ID de la categoría padre no es válido', array('status' => 400));
		}
	}

	$term = wp_insert_term($name, 'event_category', array(
		'slug' => $slug,
		'parent' => $parent,
	));

	if (is_wp_error($term)) {
		return new WP_Error('error_creating_term', $term->get_error_message(), array('status' => 500));
	}

	return rest_ensure_response($term);
}

function get_event_categories($request)
{
	$search = isset($request['search']) ? sanitize_text_field($request['search']) : '';

	$args = array(
		'taxonomy' => 'event_category',
		'hide_empty' => false,
		'search' => $search,
	);

	$terms = get_terms($args);
	if (is_wp_error($terms)) {
		return rest_ensure_response(array());
	}

	$formatted_terms = array();
	foreach ($terms as $term) {
		$formatted_terms[] = array(
			'id' => $term->term_id,
			'name' => $term->name,
			'slug' => $term->slug,
			'count' => $term->count,
		);
	}

	return rest_ensure_response($formatted_terms);
}

function register_event_categories_route()
{
	register_rest_route('custom/v1', '/event-categories', array(
		array(
			'methods' => 'GET',
			'callback' => 'get_event_categories',
			'permission_callback' => '__return_true',
		),
		array(
			'methods' => 'POST',
			'callback' => 'create_event_category',
			'permission_callback' => '__return_true',
		),
	));
}
add_action('rest_api_init', 'register_event_categories_route');


// REST: LISTA DE TEMPLATES DISPONIBLES
function enable_custom_event_templates()
{
	$formatted_templates = array();
	$template_dir = get_template_directory() . '/templates/single-templates/';
	$files = glob($template_dir . '*.php');

	if ($files) {
		foreach ($files as $file) {
			$filename = basename($file);
			$formatted_templates[] = array(
				'name' => $filename,
				'id' => sanitize_title($filename),
			);
		}
	}

	return rest_ensure_response($formatted_templates);
}

function register_custom_event_templates_route()
{
	register_rest_route('custom/v1', '/event-templates', array(
		'methods' => 'GET',
		'callback' => 'enable_custom_event_templates',
		'permission_callback' => '__return_true',
	));
}
add_action('rest_api_init', 'register_custom_event_templates_route');


// META BOX DE PLANTILLAS (COMPARTIDO: event + evento_municipal)
function add_event_template_meta_box()
{
	foreach (array('event') as $post_type) {
		add_meta_box(
			'event_template_meta_box',
			__('Seleccionar Plantilla', 'msmtheme'),
			'render_event_template_meta_box',
			$post_type,
			'side',
			'default'
		);
	}
}
add_action('add_meta_boxes', 'add_event_template_meta_box');

function render_event_template_meta_box($post)
{
	wp_nonce_field('save_event_template_meta_box', 'event_template_meta_box_nonce');

	$selected_template = get_post_meta($post->ID, '_wp_page_template', true);

	$templates = array();
	$template_dir = get_template_directory() . '/templates/single-templates/';
	$files = glob($template_dir . '*.php');

	if ($files) {
		foreach ($files as $file) {
			$filename = basename($file);
			$rel_path = 'templates/single-templates/' . $filename; // ruta relativa
			$templates[$rel_path] = $filename;
		}
	}
	?>
	<p>
		<select name="event_template" id="event_template" style="width:100%;">
			<option value=""><?php _e('Selecciona una plantilla', 'msmtheme'); ?></option>
			<?php foreach ($templates as $template_path => $template_label): ?>
				<option value="<?php echo esc_attr($template_path); ?>" <?php selected($selected_template, $template_path); ?>>
					<?php echo esc_html($template_label); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>
	<?php
}

function save_event_template_meta_box($post_id)
{
	if (
		!isset($_POST['event_template_meta_box_nonce']) ||
		!wp_verify_nonce($_POST['event_template_meta_box_nonce'], 'save_event_template_meta_box')
	) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	if (isset($_POST['event_template'])) {
		update_post_meta($post_id, '_wp_page_template', sanitize_text_field($_POST['event_template']));
	}
}
add_action('save_post', 'save_event_template_meta_box');


// APLICAR TEMPLATE A event Y evento_municipal
function apply_event_template($template)
{
	if (is_singular(array('event'))) {

		$template_file = get_post_meta(get_the_ID(), '_wp_page_template', true);

		if ($template_file) {
			$theme_dir = get_template_directory();

			$candidates = array(
				$theme_dir . '/' . $template_file,                                   // ruta relativa guardada
				$theme_dir . '/templates/single-templates/' . basename($template_file) // por si quedó solo el nombre
			);

			foreach ($candidates as $path) {
				if (file_exists($path)) {
					return $path;
				}
			}
		}
	}

	return $template;
}
add_filter('template_include', 'apply_event_template');


// META EXTRA EN REST
function add_custom_event_fields()
{
	$meta_args = array(
		'type' => 'string',
		'description' => 'A meta key associated with a string meta value.',
		'single' => true,
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
			'type' => 'string',
			'context' => array('view', 'edit'),
		),
	));
}
add_action('rest_api_init', 'add_custom_template_field_to_rest_api');


// CAMPOS META EN REST (event)
function register_event_meta_fields()
{
	register_rest_field(
		'event',
		'event_date',
		array(
			'get_callback' => 'get_event_date_meta',
			'update_callback' => 'update_event_date_meta',
			'schema' => array(
				'description' => 'Event date.',
				'type' => 'string',
				'context' => array('view', 'edit'),
			),
		)
	);

	register_rest_field(
		'event',
		'event_time',
		array(
			'get_callback' => 'get_event_time_meta',
			'update_callback' => 'update_event_time_meta',
			'schema' => array(
				'description' => 'Event time.',
				'type' => 'string',
				'context' => array('view', 'edit'),
			),
		)
	);

	register_rest_field(
		'event',
		'event_location',
		array(
			'get_callback' => 'get_event_location_meta',
			'update_callback' => 'update_event_location_meta',
			'schema' => array(
				'description' => 'Event location.',
				'type' => 'string',
				'context' => array('view', 'edit'),
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


// REWRITE PARA ARCHIVE /eventos/
function custom_event_rewrite_rules()
{
	add_rewrite_rule(
		'^eventos/?$',
		'index.php?post_type=event',
		'top'
	);
}
add_action('init', 'custom_event_rewrite_rules');
