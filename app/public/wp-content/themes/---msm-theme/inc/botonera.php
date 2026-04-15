<?php

// Botonera

function enqueue_media_uploader()
{
	wp_enqueue_media();
	wp_enqueue_script('custom-media-uploader', get_template_directory_uri() . '/js/custom.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'enqueue_media_uploader');

function allow_svg_uploads($mime_types)
{
	$mime_types['svg'] = 'image/svg+xml';
	return $mime_types;
}
add_filter('mime_types', 'allow_svg_uploads');

function add_svg_to_image_sizes($sizes)
{
	$sizes['svg'] = 'SVG';
	return $sizes;
}
add_filter('image_size_names_choose', 'add_svg_to_image_sizes');

function sanitize_svg($file)
{
	if ($file['type'] !== 'image/svg+xml') {
		return $file;
	}
	return $file;
}
add_filter('wp_handle_upload_prefilter', 'sanitize_svg');

function enqueue_color_picker_and_scripts()
{
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('custom-script', get_template_directory_uri() . '/js/custom.js', array('wp-color-picker'), false, true);
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
		'supports'      => array('title'),
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

	$buttons = get_post_meta($post->ID, '_buttons', true);
	if (!$buttons || !is_array($buttons)) {
		$buttons = array_fill(0, 6, array('color' => '', 'text' => '', 'icon' => '', 'url' => '', 'priority' => 0));
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
					<label for="button_priority_<?php echo $index; ?>"><?php _e('Prioridad'); ?></label><br>
					<input type="number" id="button_priority_<?php echo $index; ?>" name="buttons[<?php echo $index; ?>][priority]" value="<?php echo esc_attr($button['priority'] ?? 0); ?>" min="0" step="1" />
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
			gap: 10px;
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
	</style>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('.color-picker').wpColorPicker();
			$('input[id^="upload_icon_button_"]').click(function(e) {
				e.preventDefault();
				var buttonId = $(this).attr('id').match(/\d+$/)[0];
				var imageFrame = wp.media({
					title: 'Seleccionar Ícono',
					button: { text: 'Usar Ícono' },
					multiple: false,
					library: { type: 'image' }
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
	if (!isset($_POST['button_meta_nonce']) || !wp_verify_nonce($_POST['button_meta_nonce'], 'save_button_meta')) return;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
	if (!current_user_can('edit_post', $post_id)) return;

	if (isset($_POST['buttons']) && is_array($_POST['buttons'])) {
		$buttons = array_map(function ($button) {
			return array(
				'color'    => sanitize_hex_color($button['color']),
				'text'     => sanitize_text_field($button['text']),
				'url'      => sanitize_text_field($button['url']),
				'icon'     => sanitize_text_field($button['icon']),
				'priority' => isset($button['priority']) ? intval($button['priority']) : 0,
			);
		}, $_POST['buttons']);
		update_post_meta($post_id, '_buttons', $buttons);
	}
}
add_action('save_post', 'save_button_meta');



