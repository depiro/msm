<?php
/**
 * Metabox + Guardado de meta: Eventos Municipales
 */

if (!defined('ABSPATH'))
    exit;

function msm_eventos_municipales_meta_keys()
{
    return array(
        'msm_evento_fecha_inicio',
        'msm_evento_fecha_fin',
        'msm_evento_hora_inicio',
        'msm_evento_hora_fin',
        'msm_evento_lugar',
        'msm_evento_prioridad',
    );
}

function msm_add_metabox_eventos_municipales()
{
    add_meta_box(
        'msm_evento_municipal_metabox',
        'Detalles del Evento',
        'msm_render_metabox_eventos_municipales',
        'evento_municipal',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'msm_add_metabox_eventos_municipales');

function msm_render_metabox_eventos_municipales($post)
{
    wp_nonce_field('msm_evento_municipal_save', 'msm_evento_municipal_nonce');

    $fecha_inicio = get_post_meta($post->ID, 'msm_evento_fecha_inicio', true);
    $fecha_fin = get_post_meta($post->ID, 'msm_evento_fecha_fin', true);
    $hora_inicio = get_post_meta($post->ID, 'msm_evento_hora_inicio', true);
    $hora_fin = get_post_meta($post->ID, 'msm_evento_hora_fin', true);
    $lugar = get_post_meta($post->ID, 'msm_evento_lugar', true);
    $prioridad = get_post_meta($post->ID, 'msm_evento_prioridad', true);

    if (empty($prioridad))
        $prioridad = 'medium';

    $priorities = array(
        'low' => 'Baja',
        'medium' => 'Media',
        'high' => 'Alta',
    );

    ?>
    <style>
        .msm-field-row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin: 12px 0;
        }

        .msm-field {
            min-width: 220px;
            flex: 1;
        }

        .msm-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 6px;
        }

        .msm-field input,
        .msm-field select {
            width: 100%;
        }

        .msm-hint {
            color: #666;
            font-size: 12px;
            margin-top: 6px;
        }
    </style>

    <div class="msm-field-row">
        <div class="msm-field">
            <label for="msm_evento_fecha_inicio">Fecha de inicio</label>
            <input type="date" id="msm_evento_fecha_inicio" name="msm_evento_fecha_inicio"
                value="<?php echo esc_attr($fecha_inicio); ?>">
        </div>

        <div class="msm-field">
            <label for="msm_evento_fecha_fin">Fecha de finalización</label>
            <input type="date" id="msm_evento_fecha_fin" name="msm_evento_fecha_fin"
                value="<?php echo esc_attr($fecha_fin); ?>">
            <div class="msm-hint">Si la fecha de fin es anterior a la de inicio, se vacía automáticamente.</div>
        </div>
    </div>

    <div class="msm-field-row">
        <div class="msm-field">
            <label for="msm_evento_hora_inicio">Hora de inicio</label>
            <input type="time" id="msm_evento_hora_inicio" name="msm_evento_hora_inicio"
                value="<?php echo esc_attr($hora_inicio); ?>">
        </div>

        <div class="msm-field">
            <label for="msm_evento_hora_fin">Hora de finalización</label>
            <input type="time" id="msm_evento_hora_fin" name="msm_evento_hora_fin"
                value="<?php echo esc_attr($hora_fin); ?>">
        </div>
    </div>

    <div class="msm-field-row">
        <div class="msm-field">
            <label for="msm_evento_lugar">Lugar</label>
            <input type="text" id="msm_evento_lugar" name="msm_evento_lugar" value="<?php echo esc_attr($lugar); ?>"
                placeholder="Ej: Plaza principal, Centro Cultural...">
        </div>

        <div class="msm-field">
            <label for="msm_evento_prioridad">Prioridad</label>
            <select id="msm_evento_prioridad" name="msm_evento_prioridad">
                <?php foreach ($priorities as $value => $label): ?>
                    <option value="<?php echo esc_attr($value); ?>" <?php selected($prioridad, $value); ?>>
                        <?php echo esc_html($label); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <div class="msm-hint">Se guarda como <code>low</code>, <code>medium</code> (default) o <code>high</code>.</div>
        </div>
    </div>
    <?php
}

function msm_sanitize_date_ymd($value)
{
    $value = is_string($value) ? trim($value) : '';
    if ($value === '')
        return '';
    // Esperamos YYYY-MM-DD
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $value))
        return '';
    return $value;
}

function msm_sanitize_time_hm($value)
{
    $value = is_string($value) ? trim($value) : '';
    if ($value === '')
        return '';
    // Esperamos HH:MM (24h)
    if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $value))
        return '';
    return $value;
}

function msm_evento_prioridad_allowed($value)
{
    $allowed = array('low', 'medium', 'high');
    return in_array($value, $allowed, true) ? $value : 'medium';
}

function msm_save_metabox_eventos_municipales($post_id)
{

    // 1) Nonce
    if (
        !isset($_POST['msm_evento_municipal_nonce']) ||
        !wp_verify_nonce($_POST['msm_evento_municipal_nonce'], 'msm_evento_municipal_save')
    ) {
        return;
    }

    // 2) Autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    // 3) Permisos
    if (!current_user_can('edit_post', $post_id))
        return;

    // 4) Post type check
    if (get_post_type($post_id) !== 'evento_municipal')
        return;

    $fecha_inicio = isset($_POST['msm_evento_fecha_inicio']) ? msm_sanitize_date_ymd(wp_unslash($_POST['msm_evento_fecha_inicio'])) : '';
    $fecha_fin = isset($_POST['msm_evento_fecha_fin']) ? msm_sanitize_date_ymd(wp_unslash($_POST['msm_evento_fecha_fin'])) : '';
    $hora_inicio = isset($_POST['msm_evento_hora_inicio']) ? msm_sanitize_time_hm(wp_unslash($_POST['msm_evento_hora_inicio'])) : '';
    $hora_fin = isset($_POST['msm_evento_hora_fin']) ? msm_sanitize_time_hm(wp_unslash($_POST['msm_evento_hora_fin'])) : '';
    $lugar = isset($_POST['msm_evento_lugar']) ? sanitize_text_field(wp_unslash($_POST['msm_evento_lugar'])) : '';
    $prioridad = isset($_POST['msm_evento_prioridad']) ? msm_evento_prioridad_allowed(sanitize_key(wp_unslash($_POST['msm_evento_prioridad']))) : 'medium';

    // Validación: si fecha fin < fecha inicio => vaciar fecha fin
    if ($fecha_inicio !== '' && $fecha_fin !== '' && $fecha_fin < $fecha_inicio) {
        $fecha_fin = '';
    }

    update_post_meta($post_id, 'msm_evento_fecha_inicio', $fecha_inicio);
    update_post_meta($post_id, 'msm_evento_fecha_fin', $fecha_fin);
    update_post_meta($post_id, 'msm_evento_hora_inicio', $hora_inicio);
    update_post_meta($post_id, 'msm_evento_hora_fin', $hora_fin);
    update_post_meta($post_id, 'msm_evento_lugar', $lugar);
    update_post_meta($post_id, 'msm_evento_prioridad', $prioridad);
}
add_action('save_post', 'msm_save_metabox_eventos_municipales');


// -----------------------------------------------------
// LÓGICA DE TEMPLATES (Ported from inc/events.php)
// -----------------------------------------------------

/**
 * Agrega el metabox "Seleccionar Plantilla" para Eventos Municipales
 */
function msm_add_evento_municipal_template_metabox()
{
    add_meta_box(
        'msm_evento_municipal_template_metabox',
        __('Seleccionar Plantilla', 'msmtheme'),
        'msm_render_evento_municipal_template_metabox',
        'evento_municipal',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'msm_add_evento_municipal_template_metabox');

/**
 * Renderiza el select de plantillas disponibles en templates/single-templates/
 */
function msm_render_evento_municipal_template_metabox($post)
{
    wp_nonce_field('msm_save_evento_municipal_template_metabox', 'msm_evento_municipal_template_nonce');

    $selected_template = get_post_meta($post->ID, '_wp_page_template', true);

    $templates = array();
    $template_dir = get_template_directory() . '/templates/single-templates/';
    $files = glob($template_dir . '*.php');

    if ($files) {
        foreach ($files as $file) {
            $filename = basename($file);
            // $rel_path = 'templates/single-templates/' . $filename; // OLD: caused double path issue
            $templates[$filename] = $filename; // NEW: Save only filename
        }
    }
    ?>
    <p>
        <select name="msm_evento_municipal_template" id="msm_evento_municipal_template" style="width:100%;">
            <option value=""><?php _e('Selecciona una plantilla', 'msmtheme'); ?></option>
            <?php foreach ($templates as $template_filename => $template_label): ?>
                <option value="<?php echo esc_attr($template_filename); ?>" <?php selected($selected_template, $template_filename); ?>>
                    <?php echo esc_html($template_label); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <?php
}

/**
 * Guarda la elección de plantilla en _wp_page_template
 */
function msm_save_evento_municipal_template_metabox($post_id)
{
    if (
        !isset($_POST['msm_evento_municipal_template_nonce']) ||
        !wp_verify_nonce($_POST['msm_evento_municipal_template_nonce'], 'msm_save_evento_municipal_template_metabox')
    ) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Solo guardar si es nuestro CPT (aunque el nonce ya protege)
    if (get_post_type($post_id) !== 'evento_municipal') {
        return;
    }

    if (isset($_POST['msm_evento_municipal_template'])) {
        update_post_meta($post_id, '_wp_page_template', sanitize_text_field($_POST['msm_evento_municipal_template']));
    }
}
add_action('save_post', 'msm_save_evento_municipal_template_metabox');



