<?php

/**
 * Registro del Custom Post Type: Programa
 */
function register_programa_post_type() {
    register_post_type('programa', array(
        'labels' => array(
            'name' => __('Programas'),
            'singular_name' => __('Programa'),
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'programas/%area_programa%'),
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'taxonomies' => array('area_programa'),
        'show_in_rest' => true,
    ));
}
add_action('init', 'register_programa_post_type');

/**
 * Taxonomía personalizada: Área Programa
 */
function crear_taxonomia_area_programa() {
    register_taxonomy(
        'area_programa',
        'programa',
        array(
            'labels' => array(
                'name' => __('Áreas de Programa'),
                'singular_name' => __('Área de Programa'),
            ),
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'programas'),
            'show_in_rest' => true,
        )
    );
}
add_action('init', 'crear_taxonomia_area_programa');

/**
 * Campos personalizados: ícono SVG + color de fondo + imagen + URL personalizada
 */
function agregar_campos_area_programa($taxonomy) {
    $icono_svg = is_object($taxonomy) ? get_term_meta($taxonomy->term_id, 'icono_svg', true) : '';
    $color_hex = is_object($taxonomy) ? get_term_meta($taxonomy->term_id, 'color_hex', true) : '';
    $imagen_id = is_object($taxonomy) ? get_term_meta($taxonomy->term_id, 'imagen_id', true) : '';
    $url_personalizada = is_object($taxonomy) ? get_term_meta($taxonomy->term_id, 'url_personalizada', true) : '';
    $imagen_url = wp_get_attachment_url($imagen_id);
    ?>
    <tr class="form-field term-icono-wrap">
        <th><label for="icono_svg">Ícono SVG</label></th>
        <td>
            <input type="text" name="icono_svg" id="icono_svg" value="<?php echo esc_attr($icono_svg); ?>" placeholder="ej: salud" />
            <p class="description">Nombre del archivo SVG sin la extensión ".svg".</p>
        </td>
    </tr>
    <tr class="form-field term-color-wrap">
        <th><label for="color_hex">Color de fondo</label></th>
        <td>
            <input type="text" name="color_hex" id="color_hex" value="<?php echo esc_attr($color_hex); ?>" placeholder="#0095da o var(--msm-blue)" />
            <p class="description">Color para el fondo del ícono.</p>
        </td>
    </tr>
    <tr class="form-field term-imagen-wrap">
        <th><label for="imagen_upload">Imagen</label></th>
        <td>
            <input type="hidden" id="imagen_id" name="imagen_id" value="<?php echo esc_attr($imagen_id); ?>" />
            <input type="button" id="upload_image_button" class="button" value="Seleccionar Imagen" />
            <div id="preview_image" style="margin-top: 10px;">
                <?php if ($imagen_url) : ?>
                    <img src="<?php echo esc_url($imagen_url); ?>" style="max-width: 50px; height: auto;" />
                <?php endif; ?>
            </div>
            <p class="description">Sube una imagen para este término.</p>
        </td>
    </tr>
    <tr class="form-field term-url-wrap">
        <th><label for="url_personalizada">URL personalizada</label></th>
        <td>
            <input type="url" name="url_personalizada" id="url_personalizada" value="<?php echo esc_attr($url_personalizada); ?>" placeholder="https://ejemplo.com/o-alguna-ruta" style="width: 100%;" />
            <p class="description">Esta URL reemplazará el enlace predeterminado del área de programa en la home u otros lugares.</p>
        </td>
    </tr>
    <?php
}
add_action('area_programa_edit_form_fields', 'agregar_campos_area_programa');
add_action('area_programa_add_form_fields', 'agregar_campos_area_programa');

function guardar_campos_area_programa($term_id) {
    if (isset($_POST['icono_svg'])) {
        update_term_meta($term_id, 'icono_svg', sanitize_text_field($_POST['icono_svg']));
    }
    if (isset($_POST['color_hex'])) {
        update_term_meta($term_id, 'color_hex', sanitize_text_field($_POST['color_hex']));
    }
    if (isset($_POST['imagen_id'])) {
        update_term_meta($term_id, 'imagen_id', intval($_POST['imagen_id']));
    }
    if (isset($_POST['url_personalizada'])) {
        update_term_meta($term_id, 'url_personalizada', esc_url_raw($_POST['url_personalizada']));
    }
}
add_action('created_area_programa', 'guardar_campos_area_programa');
add_action('edited_area_programa', 'guardar_campos_area_programa');

/**
 * Script para botón de subida de imagen
 */
function area_programa_admin_footer_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            let mediaUploader;
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
                    const attachment = mediaUploader.state().get('selection').first().toJSON();
                    $('#imagen_id').val(attachment.id);
                    $('#preview_image').html('<img src="' + attachment.url + '" style="max-width: 150px; height: auto;" />');
                });
                mediaUploader.open();
            });
        });
    </script>
    <?php
}
add_action('admin_footer', 'area_programa_admin_footer_script');

/**
 * Mostrar ícono en la tabla del dashboard
 */
function columnas_area_programa($columns) {
    $columns['icono'] = __('Ícono');
    return $columns;
}
add_filter('manage_edit-area_programa_columns', 'columnas_area_programa');

function contenido_columna_area_programa($content, $column_name, $term_id) {
    if ($column_name === 'icono') {
        $icono = get_term_meta($term_id, 'icono_svg', true);
        if ($icono) {
            return '<code>' . esc_html($icono) . '</code>';
        }
    }
    return $content;
}
add_filter('manage_area_programa_custom_column', 'contenido_columna_area_programa', 10, 3);

/**
 * Reescritura de URLs para programas
 */
function rewrite_programas_urls() {
    add_rewrite_rule(
        '^programas/([^/]+)/([^/]+)/?$',
        'index.php?post_type=programa&area_programa=$matches[1]&name=$matches[2]',
        'top'
    );
    add_rewrite_rule(
        '^programas/?$',
        'index.php?post_type=programa',
        'top'
    );
}
add_action('init', 'rewrite_programas_urls');

/**
 * Enlazar taxonomía en la URL del CPT
 */
function programa_link_personalizado($post_link, $post) {
    if ($post->post_type === 'programa') {
        $terms = wp_get_post_terms($post->ID, 'area_programa');
        if (!empty($terms) && !is_wp_error($terms)) {
            return str_replace('%area_programa%', $terms[0]->slug, $post_link);
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'programa_link_personalizado', 10, 2);

/**
 * Reemplazar el enlace de la taxonomía por la URL personalizada
 */
function reemplazar_link_area_programa($url, $term, $taxonomy) {
    if ($taxonomy === 'area_programa') {
        $custom_url = get_term_meta($term->term_id, 'url_personalizada', true);
        if ($custom_url) {
            return esc_url($custom_url);
        }
    }
    return $url;
}
add_filter('term_link', 'reemplazar_link_area_programa', 10, 3);
