<?php

function crear_taxonomia_area_gobierno()
{
	register_taxonomy(
		'area_gobierno',
		'page',
		array(
			'labels' => array(
				'name' => __('Áreas de Gobierno'),
				'singular_name' => __('Área de Gobierno'),
			),
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'areas-gobierno', 'with_front' => false), // Asegúrate de que 'with_front' esté en false
			'show_in_rest'          => true, // Asegúrate de que la taxonomía esté disponible en la REST API.
			'rest_base'             => 'areas', // Esto definirá el nombre del endpoint en la REST API.
			'public' => true,
		)
	);
}
add_action('init', 'crear_taxonomia_area_gobierno');

// API Endpoint para el cms GET 'custom/v1/areas'
function register_area_routes()
{
	register_rest_route('custom/v1', '/areas', [
		'methods' => 'GET',
		'callback' => 'get_areas',
		'permission_callback' => '__return_true'
	]);
}
add_action('rest_api_init', 'register_area_routes');

function get_areas()
{
	$terms = get_terms([
		'taxonomy' => 'area_gobierno',
		'hide_empty' => false
	]);

	if (is_wp_error($terms)) {
		return new WP_Error('no_areas', 'No se encontraron areas', ['status' => 404]);
	}
	return $terms;
}

// API Endpoint para el cms POST 'custom/v1/areas'
function register_area_creation_route()
{
	register_rest_route('custom/v1', '/areas', [
		'methods' => 'POST',
		'callback' => 'create_area',
		'permission_callback' => '__return_true',
	]);
}
add_action('rest_api_init', 'register_area_creation_route');


// AGREGADO DE METABOX para pages
function add_page_template_meta_box()
{
	add_meta_box(
		'page_template_meta_box',
		__('Seleccionar Plantilla', 'msmtheme'),
		'render_page_template_meta_box',
		'page',
		'side',
		'default'
	);
}
add_action('add_meta_boxes', 'add_page_template_meta_box');

function render_page_template_meta_box($post)
{
	wp_nonce_field('save_page_template_meta_box', 'page_template_meta_box_nonce');
	$selected_template = get_post_meta($post->ID, 'page_template', true);
	$template_dir = get_template_directory() . '/templates/page-templates/';
	$files = glob($template_dir . '*.php');
	$templates = [];

	foreach ($files as $file) {
		$filename = basename($file);
		$templates[$filename] = $filename;
	}
?>
	<p>
		<label for="page_template"><?php _e('Selecciona una plantilla', 'msmtheme'); ?></label>
		<select name="page_template" id="page_template">
			<option value=""><?php _e('Selecciona una plantilla', 'msmtheme'); ?></option>
			<?php foreach ($templates as $template_name => $template_file): ?>
				<option value="<?php echo esc_attr($template_file); ?>" <?php selected($selected_template, $template_file); ?>>
					<?php echo esc_html($template_name); ?>
				</option>
			<?php endforeach; ?>
		</select>
	</p>
<?php
}

function save_page_template_meta_box($post_id)
{
	if (!isset($_POST['page_template_meta_box_nonce']) || !wp_verify_nonce($_POST['page_template_meta_box_nonce'], 'save_page_template_meta_box')) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	if (isset($_POST['page_template'])) {
		update_post_meta($post_id, 'page_template', sanitize_text_field($_POST['page_template']));
	}
}
add_action('save_post', 'save_page_template_meta_box');



function apply_page_template($template)
{
	if (is_page()) {
		$template_file = get_post_meta(get_the_ID(), 'page_template', true);
		if ($template_file && file_exists(get_template_directory() . '/templates/page-templates/' . $template_file)) {
			return get_template_directory() . '/templates/page-templates/' . $template_file;
		}
	}
	return $template;
}
add_filter('template_include', 'apply_page_template');



function add_order_field_area_gobierno($term_id)
{
	$order = get_term_meta($term_id, 'order', true);
?>
	<div class="form-field">
		<label for="order"><?php _e('Orden', 'msmtheme'); ?></label>
		<input type="number" name="order" id="order" value="<?php echo esc_attr($order); ?>" />
	</div>
<?php
}
add_action('area_gobierno_add_form_fields', 'add_order_field_area_gobierno');




function edit_order_field_area_gobierno($term)
{
	$order = get_term_meta($term->term_id, 'order', true);
?>
	<tr class="form-field">
		<th scope="row" valign="top"><label for="order"><?php _e('Orden', 'msmtheme'); ?></label></th>
		<td>
			<input type="number" name="order" id="order" value="<?php echo esc_attr($order); ?>" />
		</td>
	</tr>
<?php
}
add_action('area_gobierno_edit_form_fields', 'edit_order_field_area_gobierno');



function save_field_order_area_gobierno($term_id)
{
	if (isset($_POST['order']) && $_POST['order'] !== '') {
		update_term_meta($term_id, 'order', intval($_POST['order']));
	}
}
add_action('created_area_gobierno', 'save_field_order_area_gobierno');
add_action('edited_area_gobierno', 'save_field_order_area_gobierno');


function incluir_especiales()
{
	if (is_page('capacitate')) {
		include(get_template_directory() . '/templates/special/licencias/capacitate.php');
		exit;
	}

	if (is_page('turnos')) {
		include(get_template_directory() . '/templates/special/licencias/turnos.php');
		exit;
	}

	if (is_page('primer-licencia')) {
		include(get_template_directory() . '/templates/special/licencias/primer-licencia.php');
		exit;
	}

	if (is_page('curso-online')) {
		include(get_template_directory() . '/templates/special/licencias/curso-online.php');
		exit;
	}
}
add_action('template_redirect', 'incluir_especiales');



// BANNER PARA ARAS GOBIERNO

function add_image_field_area_gobierno($term)
{
    // Obtener la URL de la imagen si existe
    $image_url = get_term_meta($term->term_id, 'banner_image', true);
?>
    <div class="form-field">
        <label for="banner_image"><?php _e('Imagen del Banner', 'msmtheme'); ?></label>
        <input type="text" name="banner_image" id="banner_image" value="<?php echo esc_attr($image_url); ?>" style="width: 70%;" />
        <input type="button" class="button" value="Seleccionar Imagen" id="upload_banner_image" />
        <br><br>
        <div id="image_preview">
            <?php
            // Si existe una imagen, mostrar vista previa y opción de eliminar
            if ($image_url) {
                echo '<img src="' . esc_url($image_url) . '" style="max-width: 200px; margin-top: 10px;">';
                echo '<br><input type="button" class="button" value="Eliminar Imagen" id="delete_banner_image" />';
            }
            ?>
        </div>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var media_frame;
        $('#upload_banner_image').click(function(e) {
            e.preventDefault();
            if (media_frame) {
                media_frame.open();
                return;
            }
            media_frame = wp.media({
                title: 'Seleccionar o Subir Imagen',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });

            media_frame.on('select', function() {
                var attachment = media_frame.state().get('selection').first().toJSON();
                var imageUrl = attachment.url;
                $('#banner_image').val(imageUrl);
                $('#image_preview').html('<img src="' + imageUrl + '" style="max-width: 200px; margin-top: 10px;">');
                $('#image_preview').append('<br><input type="button" class="button" value="Eliminar Imagen" id="delete_banner_image" />');
            });

            media_frame.open();
        });

        // Eliminar la imagen seleccionada
        $('#delete_banner_image').click(function() {
            $('#banner_image').val('');
            $('#image_preview').html('');
        });
    });
    </script>
<?php
}
// add_action('area_gobierno_add_form_fields', 'add_image_field_area_gobierno');


function edit_image_field_area_gobierno($term)
{
    // Obtener la URL de la imagen si existe
    $image_url = get_term_meta($term->term_id, 'banner_image', true);
?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="banner_image"><?php _e('Imagen del Banner', 'msmtheme'); ?></label></th>
        <td>
            <input type="text" name="banner_image" id="banner_image" value="<?php echo esc_attr($image_url); ?>" style="width: 70%;" />
            <input type="button" class="button" value="Seleccionar Imagen" id="upload_banner_image" />
            <br><br>
            <div id="image_preview">
                <?php
                // Si existe una imagen, mostrar vista previa y opción de eliminar
                if ($image_url) {
                    echo '<img src="' . esc_url($image_url) . '" style="max-width: 200px; margin-top: 10px;">';
                    echo '<br><input type="button" class="button" value="Eliminar Imagen" id="delete_banner_image" />';
                }
                ?>
            </div>
        </td>
    </tr>
    <script>
    jQuery(document).ready(function($) {
        var media_frame;
        $('#upload_banner_image').click(function(e) {
            e.preventDefault();
            if (media_frame) {
                media_frame.open();
                return;
            }
            media_frame = wp.media({
                title: 'Seleccionar o Subir Imagen',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });

            media_frame.on('select', function() {
                var attachment = media_frame.state().get('selection').first().toJSON();
                var imageUrl = attachment.url;
                $('#banner_image').val(imageUrl);
                $('#image_preview').html('<img src="' + imageUrl + '" style="max-width: 200px; margin-top: 10px;">');
                $('#image_preview').append('<br><input type="button" class="button" value="Eliminar Imagen" id="delete_banner_image" />');
            });

            media_frame.open();
        });

        // Eliminar la imagen seleccionada
        $('#delete_banner_image').click(function() {
            $('#banner_image').val('');
            $('#image_preview').html('');
        });
    });
    </script>
<?php
}
add_action('area_gobierno_edit_form_fields', 'edit_image_field_area_gobierno');


function save_image_field_area_gobierno($term_id)
{
    // Verificar si se ha enviado la URL de la imagen
    if (isset($_POST['banner_image']) && !empty($_POST['banner_image'])) {
        // Guardar la URL de la imagen en los metadatos del término
        update_term_meta($term_id, 'banner_image', esc_url_raw($_POST['banner_image']));
    } else {
        // Si no se ha enviado la URL, eliminar el valor anterior
        delete_term_meta($term_id, 'banner_image');
    }
}
add_action('created_area_gobierno', 'save_image_field_area_gobierno');
add_action('edited_area_gobierno', 'save_image_field_area_gobierno');







// BANNER PARA PAGES




function agregar_banner_page_metabox() {
    add_meta_box(
        'banner_image', // ID del metabox
        'Banner Imagen', // Título del metabox
        'mostrar_banner_image_field', // Función que mostrará el campo
        'page', // Tipo de contenido (en este caso, páginas)
        'normal', // Donde se mostrará (normal, side)
        'high' // Prioridad
    );
}

function mostrar_banner_image_field($post) {
    wp_nonce_field(basename(__FILE__), 'banner_nonce'); // Seguridad

    // Obtener el ID del archivo adjunto
    $banner_image_id = get_post_meta($post->ID, '_banner_image_id', true);

    // Obtener los metadatos de la imagen
    $banner_image_metadata = get_post_meta($post->ID, '_wp_attachment_metadata', true);

    // Si hay metadatos, obtenemos la ruta del archivo
    $banner_image_url = '';
    if (!empty($banner_image_metadata) && isset($banner_image_metadata['file'])) {
        $file_path = $banner_image_metadata['file']; // Obtén la ruta relativa (por ejemplo, 2025/01/ciudad-msm.jpg)

        // Obtener la URL base de los uploads
        $upload_dir = wp_get_upload_dir();
        $banner_image_url = $upload_dir['baseurl'] . '/' . $file_path; // Combina la URL base con la ruta relativa
    }

    ?>
    <label for="banner_image">Selecciona o sube una imagen para el banner:</label>
    <input type="text" id="banner_image" name="banner_image" value="<?php echo esc_attr($banner_image_url); ?>" style="width: 70%;" readonly />
    <input type="button" class="button" value="Seleccionar imagen" id="upload_banner_image" />
    <br><br>
    <div id="image_preview">
        <?php
        // Si ya hay una imagen seleccionada, muéstrala en miniatura
        if ($banner_image_url) {
            echo '<img src="' . esc_url($banner_image_url) . '" style="max-width: 200px; margin-top: 10px;">';
        }
        ?>
    </div>
    <script>
    jQuery(document).ready(function($) {
        var media_frame;
        $('#upload_banner_image').click(function(e) {
            e.preventDefault();
            if (media_frame) {
                media_frame.open();
                return;
            }
            media_frame = wp.media({
                title: 'Seleccionar o Subir Imagen',
                button: { text: 'Usar esta imagen' },
                multiple: false
            });

            media_frame.on('select', function() {
                var attachment = media_frame.state().get('selection').first().toJSON();
                var imageUrl = attachment.url;
                var imageId = attachment.id; // Obtén el ID del adjunto

                // Guarda la URL de la imagen en el campo de texto y el ID en un campo oculto
                $('#banner_image').val(imageUrl);
                $('#image_preview').html('<img src="' + imageUrl + '" style="max-width: 200px; margin-top: 10px;">');

                // Guardar el ID del adjunto
                $('#banner_image_id').val(imageId);
            });

            media_frame.open();
        });
    });
    </script>
    <input type="hidden" id="banner_image_id" name="banner_image_id" value="<?php echo esc_attr($banner_image_id); ?>" />
    <?php
}

// add_action('add_meta_boxes', 'agregar_banner_page_metabox');

function guardar_banner_image($post_id) {
    // Verificar nonce para seguridad
    if (!isset($_POST['banner_nonce']) || !wp_verify_nonce($_POST['banner_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // Evitar guardados automáticos
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // Verificar permisos del usuario
    if ('page' != $_POST['post_type'] || !current_user_can('edit_page', $post_id)) {
        return $post_id;
    }

    // Guardar el ID de la imagen
    if (isset($_POST['banner_image_id'])) {
        $banner_image_id = intval($_POST['banner_image_id']);
        if ($banner_image_id > 0) {
            update_post_meta($post_id, '_banner_image_id', $banner_image_id);
        } else {
            delete_post_meta($post_id, '_banner_image_id');
        }
    }
}
// add_action('save_post', 'guardar_banner_image');

// Agregar la columna "Orden" antes de la columna "Count"
add_filter('manage_edit-area_gobierno_columns', function ($columns) {
    $new_columns = [];

    foreach ($columns as $key => $value) {
        if ($key === 'posts') {
            // Antes de "posts" (Count), insertamos "order"
            $new_columns['order'] = __('Orden');
        }
        $new_columns[$key] = $value;
    }

    return $new_columns;
});

// Mostrar el contenido de la columna "Orden"
add_filter('manage_area_gobierno_custom_column', function ($out, $column_name, $term_id) {
    if ($column_name === 'order') {
        $order = get_term_meta($term_id, 'order', true);
        return esc_html($order);
    }
    return $out;
}, 10, 3);
