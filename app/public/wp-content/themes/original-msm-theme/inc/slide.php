<?php


// SLIDE

function create_slide_post_type()
{
	$args = array(
		'labels' => array(
			'name'          => __('Slides'), // Nombre plural
			'singular_name' => __('Slide') // Nombre singular
		),
		'public'        => true,
		'has_archive'   => true,
		'supports'      => array('title', 'thumbnail'), // Solo imagen destacada
		'menu_icon'     => 'dashicons-slides',
		'rewrite'       => array('slug' => 'slide-home'), // Slug en la URL
		'show_in_rest'  => true, // Para soporte de Gutenberg
	);
	register_post_type('slide', $args);
}
add_action('init', 'create_slide_post_type');
function add_slide_metaboxes()
{
	add_meta_box(
		'slide_details',        // ID del metabox
		__('Slide Detalles'),   // Título del metabox
		'render_slide_metabox', // Callback para mostrar el contenido del metabox
		'slide',                // Tipo de post
		'normal',               // Contexto (normal, side, advanced)
		'high'                  // Prioridad (default, low, high, core)
	);
}
add_action('add_meta_boxes', 'add_slide_metaboxes');

function render_slide_metabox($post)
{
	wp_nonce_field('save_slide_meta', 'slide_meta_nonce');

	$texto_breve = get_post_meta($post->ID, '_texto_breve', true);
	$imagen_id = get_post_meta($post->ID, '_imagen_id', true);
	$enlace = get_post_meta($post->ID, '_enlace', true);

	$imagen_url = $imagen_id ? wp_get_attachment_url($imagen_id) : '';
?>
	<p>
		<label for="imagen_upload"><?php _e('Imagen'); ?></label><br>
		<input type="hidden" id="imagen_id" name="imagen_id" value="<?php echo esc_attr($imagen_id); ?>" />
		<small><strong>Cargar en este campo una imagen de 1700 x 438 pixeles.</strong></small><br>
		<input type="button" id="upload_image_button" class="button" value="<?php _e('Seleccionar Imagen'); ?>" /><br>
	<div id="preview_image" style="margin-top: 10px;max-width:300px;">
		<?php if ($imagen_url) : ?>
			<img src="<?php echo esc_url($imagen_url); ?>" style="max-width: 300px; height: auto;" />
		<?php endif; ?>
	</div>
	</p>
	<p>
		<label for="texto_breve"><?php _e('Texto Breve'); ?></label><br>
		<input type="text" id="texto_breve" name="texto_breve" value="<?php echo esc_attr($texto_breve); ?>" size="30" />
	</p>
	<p>
		<label for="enlace"><?php _e('Enlace'); ?></label><br>
		<input type="text" id="enlace" name="enlace" value="<?php echo esc_url($enlace); ?>" size="30" />
	</p>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#upload_image_button').click(function(e) {
				e.preventDefault();

				var frame = wp.media({
					title: 'Seleccionar Imagen',
					button: {
						text: 'Usar Imagen'
					},
					multiple: false
				});

				frame.on('select', function() {
					var attachment = frame.state().get('selection').first().toJSON();
					$('#imagen_id').val(attachment.id);
					$('#preview_image').html('<img src="' + attachment.url + '" style="max-width: 300px; height: auto;" />');
				});

				frame.open();
			});
		});
	</script>
<?php
}

function save_slide_meta($post_id)
{
	// Verificar nonce
	if (!isset($_POST['slide_meta_nonce']) || !wp_verify_nonce($_POST['slide_meta_nonce'], 'save_slide_meta')) {
		return;
	}

	// Verificar permisos
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Guardar texto breve y enlace
	if (isset($_POST['texto_breve'])) {
		update_post_meta($post_id, '_texto_breve', sanitize_text_field($_POST['texto_breve']));
	}
	if (isset($_POST['enlace'])) {
		update_post_meta($post_id, '_enlace', esc_url_raw($_POST['enlace']));
	}

	// Guardar el ID del attachment
	if (isset($_POST['imagen_id'])) {
		$imagen_id = intval($_POST['imagen_id']);
		if ($imagen_id > 0) {
			update_post_meta($post_id, '_imagen_id', $imagen_id);
		}
	}
}
add_action('save_post', 'save_slide_meta');
