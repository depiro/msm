<?php

// Botonera

function enqueue_media_uploader()
{
	// Encolar el script de la biblioteca de medios
	wp_enqueue_media();
	wp_enqueue_script('custom-media-uploader', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');

// Permitir la subida de archivos SVG
function allow_svg_uploads($mime_types)
{
	$mime_types['svg'] = 'image/svg+xml'; // Permitir el tipo MIME SVG
	return $mime_types;
}
add_filter('mime_types', 'allow_svg_uploads');

// Agregar el SVG al tamaño de la vista previa en la biblioteca de medios
function add_svg_to_image_sizes($sizes)
{
	$sizes['svg'] = 'SVG';
	return $sizes;
}
add_filter('image_size_names_choose', 'add_svg_to_image_sizes');

// Sanitizar SVG para mayor seguridad
function sanitize_svg($file)
{
	if ($file['type'] !== 'image/svg+xml') {
		return $file;
	}

	// Usa una librería de sanitización para asegurar el archivo SVG
	// Requiere el plugin "Safe SVG" para manejar la sanitización automáticamente

	return $file;
}
add_filter('wp_handle_upload_prefilter', 'sanitize_svg');


function enqueue_color_picker_and_scripts()
{
	// Encolar el script del color picker
	wp_enqueue_script('wp-color-picker');

	// Encolar el script adicional para inicializar el color picker
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom.js', array('wp-color-picker'), false, true);

	// Encolar los estilos del color picker
	wp_enqueue_style('wp-color-picker');
}
add_action('admin_enqueue_scripts', 'enqueue_color_picker_and_scripts');

function create_button_post_type()
{
	$args = array(
		'labels' => array(
			'name'               => __('Botonera'),
			'singular_name'      => __('Botonera'),
			'add_new'            => __('Añadir Botonera'),
			'add_new_item'       => __('Añadir Nueva Botonera'),
			'edit_item'          => __('Editar Botonera'),
			'new_item'           => __('Nueva Botonera'),
			'view_item'          => __('Ver Botonera'),
			'search_items'       => __('Buscar Botoneras'),
			'not_found'          => __('No se encontraron botoneras'),
			'not_found_in_trash' => __('No se encontraron botoneras en la papelera'),
		),
		'public'        => true,
		'has_archive'   => true,
		'supports'      => array('title'), // Solo título, el resto se manejará en el metabox
		'menu_icon'     => 'dashicons-button',
		'rewrite'       => array('slug' => 'botonera'),
		'show_in_rest'  => true,
	);
	register_post_type('botonera', $args);
}
add_action('init', 'create_button_post_type');


function add_button_metaboxes()
{
	add_meta_box(
		'button_details',
		'Botonera',
		'render_button_metabox',
		'botonera',
		'normal',
		'high'
	);
}
add_action('add_meta_boxes', 'add_button_metaboxes');

function render_button_metabox($post)
{
	wp_nonce_field('save_button_meta', 'button_meta_nonce');

	// Obtener los valores actuales
	$buttons = get_post_meta($post->ID, '_buttons', true);
	if (!$buttons || !is_array($buttons)) {
		$buttons = array_fill(0, 6, array('color' => '', 'text' => '', 'icon' => '', 'url' => ''));
	}
?>
	<div id="buttons_container">
		<?php foreach ($buttons as $index => $button) : ?>
			<div class="button-row">
				<div class="button-col">
					<label for="button_text_<?php echo $index; ?>"><?php _e('Texto del Botón'); ?></label><br>
					<input type="text" id="button_text_<?php echo $index; ?>" name="buttons[<?php echo $index; ?>][text]" value="<?php echo esc_attr($button['text']); ?>" />
				</div>
				<div class="button-col">
					<label for="button_url_<?php echo $index; ?>"><?php _e('URL'); ?></label><br>
					<input type="text" id="button_url_<?php echo $index; ?>" name="buttons[<?php echo $index; ?>][url]" value="<?php echo esc_attr($button['url']); ?>" />
				</div>
				<div class="button-col">
					<label for="button_icon_<?php echo $index; ?>"><?php _e('Ícono'); ?></label><br>
					<input type="hidden" id="button_icon_<?php echo $index; ?>" name="buttons[<?php echo $index; ?>][icon]" value="<?php echo esc_attr($button['icon']); ?>" />
					<input type="button" id="upload_icon_button_<?php echo $index; ?>" class="button" value="<?php _e('Seleccionar Ícono'); ?>" />
				</div>
				<div class="button-col">
					<label for="button_color_<?php echo $index; ?>"><?php _e('Color de Fondo'); ?></label><br>
					<input type="text" id="button_color_<?php echo $index; ?>" name="buttons[<?php echo $index; ?>][color]" value="<?php echo esc_attr($button['color']); ?>" class="color-picker" />
				</div>
				<div class="button-col">
					<div id="icon_preview_<?php echo $index; ?>" style="margin-top: 10px;">
						<?php if ($button['icon']) : ?>
							<img src="<?php echo esc_url($button['icon']); ?>" style="max-width: 150px; height: auto;" />
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<style>
		.button-row {
			display: grid;
			grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
			/* Ajusta el tamaño de las columnas según sea necesario */
			gap: 10px;
			/* Espaciado entre botones */
			border: 1px solid #ddd;
			padding: 10px;
			margin-bottom: 10px;
		}

		.button-row label {
			display: block;
			margin-bottom: 5px;
		}

		.color-picker {
			width: 100%;
		}

		.button-col {
			display: flex;
			flex-flow: column;
		}

		.row-add-button {
			display: flex;
			justify-content: end;
			padding-bottom: 10px;
			padding-top: 10px;

		}

		.row-add-button button {
			padding: 5px;
		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.color-picker').wpColorPicker();

			// Configurar el botón para seleccionar iconos
			$('input[id^="upload_icon_button_"]').click(function(e) {
				e.preventDefault();

				var buttonId = $(this).attr('id').match(/\d+$/)[0];
				var imageFrame = wp.media({
					title: 'Seleccionar Ícono',
					button: {
						text: 'Usar Ícono'
					},
					multiple: false,
					library: {
						type: 'image'
					}
				});

				imageFrame.on('select', function() {
					var attachment = imageFrame.state().get('selection').first().toJSON();
					$('#button_icon_' + buttonId).val(attachment.url);
					$('#icon_preview_' + buttonId).html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto;" />');
				});

				imageFrame.open();
			});
		});
	</script>
<?php
}


function save_button_meta($post_id)
{
	// Verificar nonce
	if (!isset($_POST['button_meta_nonce']) || !wp_verify_nonce($_POST['button_meta_nonce'], 'save_button_meta')) {
		return;
	}

	// Verificar permisos
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Guardar los datos de los botones
	if (isset($_POST['buttons']) && is_array($_POST['buttons'])) {
		$buttons = array_map(function ($button) {
			return array(
				'color' => sanitize_hex_color($button['color']),
				'text'  => sanitize_text_field($button['text']),
				'url'  => sanitize_text_field($button['url']),
				'icon'  => sanitize_text_field($button['icon']),
			);
		}, $_POST['buttons']);
		update_post_meta($post_id, '_buttons', $buttons);
	}
}
add_action('save_post', 'save_button_meta');
