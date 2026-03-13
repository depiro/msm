<?php

function register_custom_post_types()
{
	register_post_type('tramite', array(
		'labels' => array(
			'name' => __('Trámites'),
			'singular_name' => __('Trámite'),
		),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'guia-tramites/%area_tramite%'),
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
		'taxonomies' => array('area_tramite'),
	));
}
add_action('init', 'register_custom_post_types');


function add_custom_meta_boxes()
{
	add_meta_box(
		'tramite_details',           // ID del Metabox
		'Detalles del Trámite',      // Título del Metabox
		'render_tramite_meta_box',   // Función de Callback
		'tramite',                   // Tipo de Post
		'normal',                    // Contexto
		'high'                       // Prioridad
	);
}
add_action('add_meta_boxes', 'add_custom_meta_boxes');

function render_tramite_meta_box($post)
{
	// Agrega un nonce field para verificar el origen de los datos
	wp_nonce_field('save_tramite_details', 'tramite_nonce');

	// Obtén los valores actuales
	$presentacion = get_post_meta($post->ID, '_presentacion_del_tramite', true);
	$requisitos = get_post_meta($post->ID, '_requisitos', true);
	$duracion = get_post_meta($post->ID, '_duracion_del_tramite', true);
	$vigencia = get_post_meta($post->ID, '_vigencia_del_documento_obtenido', true);
	$respaldo = get_post_meta($post->ID, '_respaldo_legal', true);
	$observaciones = get_post_meta($post->ID, '_observaciones', true);
	$lugar = get_post_meta($post->ID, '_lugar_de_atencion', true);
	$horarios = get_post_meta($post->ID, '_horarios_de_atencion', true);
	$documento_obtenido = get_post_meta($post->ID, '_documento_obtenido', true);
	$quien_puede_realizar = get_post_meta($post->ID, '_quien_puede_realizar_el_tramite', true);
	$como_recibe = get_post_meta($post->ID, '_como_recibe_el_vecino_el_tramite', true);
	$costo = get_post_meta($post->ID, '_costo_del_tramite', true);
	?>

	<p class="col-tramites">
		<label for="presentacion"><?php _e('Presentacion:', 'textdomain'); ?></label>
		<?php
		$presentacion = get_post_meta($post->ID, '_presentacion_del_tramite', true);
		wp_editor($presentacion, 'presentacion_editor', array(
			'textarea_name' => 'presentacion',
			'editor_class' => 'presentacion-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<p class="col-tramites">
		<label for="requisitos"><?php _e('Requisitos:', 'textdomain'); ?></label>
		<?php
		$requisitos = get_post_meta($post->ID, '_requisitos', true);
		wp_editor($requisitos, 'requisitos_editor', array(
			'textarea_name' => 'requisitos',
			'editor_class' => 'requisitos-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>
	<p class="col-tramites">
		<label for="duracion"><?php _e('Duración del trámite:', 'textdomain'); ?></label>
		<?php
		$duracion = get_post_meta($post->ID, '_duracion_del_tramite', true); // Coincide con la función de guardado
		wp_editor($duracion, 'duracion_editor', array(
			'textarea_name' => 'duracion',
			'editor_class' => 'duracion-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>
	<p class="col-tramites">
		<label for="vigencia"><?php _e('Vigencia del documento obtenido:', 'textdomain'); ?></label>
		<?php
		$vigencia = get_post_meta($post->ID, '_vigencia_del_documento_obtenido', true); // Coincide con la función de guardado
		wp_editor($vigencia, 'vigencia_editor', array(
			'textarea_name' => 'vigencia',
			'editor_class' => 'vigencia-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>
	<p class="col-tramites">
		<label for="respaldo"><?php _e('Respaldo:', 'textdomain'); ?></label>
		<?php
		$respaldo = get_post_meta($post->ID, '_respaldo_legal', true);
		wp_editor($respaldo, 'respaldo_editor', array(
			'textarea_name' => 'respaldo',
			'editor_class' => 'respaldo-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>



	<p class="col-tramites">
		<label for="observaciones"><?php _e('Observaciones:', 'textdomain'); ?></label>
		<?php
		$observaciones = get_post_meta($post->ID, '_observaciones', true);
		wp_editor($observaciones, 'observaciones_editor', array(
			'textarea_name' => 'observaciones',
			'editor_class' => 'observaciones-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>
	<p class="col-tramites">
		<label for="lugar"><?php _e('Lugar de atención:', 'textdomain'); ?></label>
		<?php
		$lugar = get_post_meta($post->ID, '_lugar_de_atencion', true);
		wp_editor($lugar, 'lugar_editor', array(
			'textarea_name' => 'lugar',
			'editor_class' => 'lugar-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<p class="col-tramites">
		<label for="horarios"><?php _e('Horarios de atención:', 'textdomain'); ?></label>
		<?php
		$horarios = get_post_meta($post->ID, '_horarios_de_atencion', true);
		wp_editor($horarios, 'horarios_editor', array(
			'textarea_name' => 'horarios',
			'editor_class' => 'horarios-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<p class="col-tramites">
		<label for="documento_obtenido"><?php _e('Documento que se obtiene:', 'textdomain'); ?></label>
		<?php
		$documento_obtenido = get_post_meta($post->ID, '_documento_obtenido', true);
		wp_editor($documento_obtenido, 'documento_obtenido_editor', array(
			'textarea_name' => 'documento_obtenido',
			'editor_class' => 'documento_obtenido-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<p class="col-tramites">
		<label for="quien_puede_realizar"><?php _e('Quién puede realizar el trámite:', 'textdomain'); ?></label>
		<?php
		$quien_puede_realizar = get_post_meta($post->ID, '_quien_puede_realizar_el_tramite', true);
		wp_editor($quien_puede_realizar, 'quien_puede_realizar_editor', array(
			'textarea_name' => 'quien_puede_realizar',
			'editor_class' => 'quien_puede_realizar-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<p class="col-tramites">
		<label for="como_recibe"><?php _e('Cómo recibe el vecino el trámite:', 'textdomain'); ?></label>
		<?php
		$como_recibe = get_post_meta($post->ID, '_como_recibe_el_vecino_el_tramite', true);
		wp_editor($como_recibe, 'como_recibe_editor', array(
			'textarea_name' => 'como_recibe',
			'editor_class' => 'como_recibe-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<p class="col-tramites">
		<label for="costo"><?php _e('Costo del trámite:', 'textdomain'); ?></label>
		<?php
		$costo = get_post_meta($post->ID, '_costo_del_tramite', true);
		wp_editor($costo, 'costo_editor', array(
			'textarea_name' => 'costo',
			'editor_class' => 'costo-editor',
			'media_buttons' => true,
			'teeny' => false,
		));
		?>
	</p>

	<style>
		.col-tramites {
			display: flex;
			flex-flow: column;
		}
	</style>
	<?php
}

function save_tramite_meta_box_data($post_id)
{
	// Verifica el nonce
	if (!isset($_POST['tramite_nonce']) || !wp_verify_nonce($_POST['tramite_nonce'], 'save_tramite_details')) {
		return;
	}

	// Verifica si el usuario tiene permisos para editar el post
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}

	if (!current_user_can('edit_post', $post_id)) {
		return;
	}

	// Guarda o actualiza los campos personalizados
	if (isset($_POST['presentacion'])) {
		update_post_meta($post_id, '_presentacion_del_tramite', wp_kses_post($_POST['presentacion']));
	}
	if (isset($_POST['requisitos'])) {
		update_post_meta($post_id, '_requisitos', wp_kses_post($_POST['requisitos'])); // Usa wp_kses_post para sanitizar
	}
	if (isset($_POST['duracion'])) {
		update_post_meta($post_id, '_duracion_del_tramite', wp_kses_post($_POST['duracion']));
	}
	if (isset($_POST['vigencia'])) {
		update_post_meta($post_id, '_vigencia_del_documento_obtenido', wp_kses_post($_POST['vigencia']));
	}
	if (isset($_POST['respaldo'])) {
		update_post_meta($post_id, '_respaldo_legal', wp_kses_post($_POST['respaldo']));
	}
	if (isset($_POST['observaciones'])) {
		update_post_meta($post_id, '_observaciones', wp_kses_post($_POST['observaciones']));
	}
	if (isset($_POST['lugar'])) {
		update_post_meta($post_id, '_lugar_de_atencion', wp_kses_post($_POST['lugar']));
	}
	if (isset($_POST['horarios'])) {
		update_post_meta($post_id, '_horarios_de_atencion', wp_kses_post($_POST['horarios']));
	}
	if (isset($_POST['documento_obtenido'])) {
		update_post_meta($post_id, '_documento_obtenido', wp_kses_post($_POST['documento_obtenido']));
	}
	if (isset($_POST['quien_puede_realizar'])) {
		update_post_meta($post_id, '_quien_puede_realizar_el_tramite', wp_kses_post($_POST['quien_puede_realizar']));
	}
	if (isset($_POST['como_recibe'])) {
		update_post_meta($post_id, '_como_recibe_el_vecino_el_tramite', wp_kses_post($_POST['como_recibe']));
	}
	if (isset($_POST['costo'])) {
		update_post_meta($post_id, '_costo_del_tramite', wp_kses_post($_POST['costo']));
	}
}
add_action('save_post', 'save_tramite_meta_box_data');



function crear_taxonomia_area_tramite()
{
	register_taxonomy(
		'area_tramite',
		'tramite',
		array(
			'labels' => array(
				'name' => __('Áreas de Trámite'),
				'singular_name' => __('Área de Trámite'),
			),
			'hierarchical' => true,
			'public' => true,
			'show_ui' => true,
			'show_admin_column' => true,
			'query_var' => true,
			'rewrite' => array('slug' => 'guia-tramites'), // Define el slug base de la URL
		)
	);
}
add_action('init', 'crear_taxonomia_area_tramite');


function custom_tramites_rewrite_rules()
{
	// Regla para los posts del tipo `tramite` con taxonomía `area_tramite`
	add_rewrite_rule(
		'^guia-tramites/([^/]+)/([^/]+)/?$',
		'index.php?post_type=tramite&area_tramite=$matches[1]&name=$matches[2]',
		'top'
	);

	// Regla para la taxonomía `area_tramite`
	add_rewrite_rule(
		'^guia-tramites/?$',
		'index.php?post_type=tramite',
		'top'
	);
}
add_action('init', 'custom_tramites_rewrite_rules');


// Enlazar términos de taxonomía a URLs de Custom Post Types
function custom_post_type_link($post_link, $post)
{
	if ($post->post_type === 'tramite') {
		$terms = wp_get_post_terms($post->ID, 'area_tramite');
		if (!empty($terms) && !is_wp_error($terms)) {
			return str_replace('%area_tramite%', $terms[0]->slug, $post_link);
		}
	}
	return $post_link;
}
add_filter('post_type_link', 'custom_post_type_link', 10, 2);


function agregar_campo_imagen($taxonomy)
{
	// Solo para el hook 'edit_form_fields', asegúrate de que $taxonomy es un objeto WP_Term
	if (is_object($taxonomy) && isset($taxonomy->term_id)) {
		$imagen_id = get_term_meta($taxonomy->term_id, 'imagen_id', true);
		$imagen_url = wp_get_attachment_url($imagen_id);
	} else {
		// Para el hook 'add_form_fields', $taxonomy será una cadena de taxonomía
		$imagen_id = '';
		$imagen_url = '';
	}
	?>
	<tr class="form-field term-imagen-wrap">
		<th scope="row">
			<label for="imagen_upload"><?php _e('Imagen'); ?></label>
		</th>
		<td>
			<input type="hidden" id="imagen_id" name="imagen_id" value="<?php echo esc_attr($imagen_id); ?>" />
			<input type="button" id="upload_image_button" class="button" value="<?php _e('Seleccionar Imagen'); ?>" />
			<div id="preview_image" style="margin-top: 10px;">
				<?php if ($imagen_url): ?>
					<img src="<?php echo esc_url($imagen_url); ?>" style="max-width: 150px; height: auto;" />
				<?php endif; ?>
			</div>
			<p class="description"><?php _e('Sube una imagen para este término.'); ?></p>
		</td>
	</tr>
	<?php
}
add_action('area_tramite_edit_form_fields', 'agregar_campo_imagen', 10, 1);
add_action('area_tramite_add_form_fields', 'agregar_campo_imagen', 10, 1);




function guardar_campo_imagen($term_id)
{
	if (isset($_POST['imagen_id'])) {
		update_term_meta($term_id, 'imagen_id', intval($_POST['imagen_id']));
	}
}
add_action('created_area_tramite', 'guardar_campo_imagen', 10, 1);
add_action('edited_area_tramite', 'guardar_campo_imagen', 10, 1);



function agregar_script_imagen()
{
	?>
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			var mediaUploader;

			$('#upload_image_button').click(function (e) {
				e.preventDefault();

				if (mediaUploader) {
					mediaUploader.open();
					return;
				}

				mediaUploader = wp.media({
					title: 'Seleccionar Imagen',
					button: {
						text: 'Seleccionar Imagen'
					},
					multiple: false
				});

				mediaUploader.on('select', function () {
					var attachment = mediaUploader.state().get('selection').first().toJSON();
					$('#imagen_id').val(attachment.id);
					$('#preview_image').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto;" />');
				});

				mediaUploader.open();
			});
		});
	</script>
	<?php
}
add_action('admin_footer', 'agregar_script_imagen');

function agregar_columna_imagen($columns)
{
	$columns['imagen'] = __('Imagen');
	return $columns;
}
add_filter('manage_edit-area_tramite_columns', 'agregar_columna_imagen');

function mostrar_columna_imagen($content, $column_name, $term_id)
{
	if ($column_name === 'imagen') {
		$imagen_id = get_term_meta($term_id, 'imagen_id', true);
		$imagen_url = wp_get_attachment_url($imagen_id);
		if ($imagen_url) {
			return '<img src="' . esc_url($imagen_url) . '" style="max-width: 100px; height: auto;" />';
		}
	}
	return $content;
}
add_filter('manage_area_tramite_custom_column', 'mostrar_columna_imagen', 10, 3);
