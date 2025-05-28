<?php

require_once get_theme_file_path('/inc/helpers/inline-svg-helper.php');
require get_template_directory() . '/inc/tramites.php';
require get_template_directory() . '/inc/botonera.php';
require get_template_directory() . '/inc/slide.php';
require get_template_directory() . '/inc/events.php';
require get_template_directory() . '/inc/pages.php';
require get_template_directory() . '/inc/prensa.php';
require get_template_directory() . '/inc/centros-salud.php';
require get_template_directory() . '/inc/cronogramas.php';
require get_template_directory() . '/inc/programas-servicios.php';


require get_template_directory() . '/inc/funciones.php';
// require get_template_directory() . '/inc/funciones_mapsengine.php';
// ------------------- add constant 10/9 -------------------
define('HOME_URI', home_url());
define('THEME_URI', home_url() . '/wp-content/themes/msm-theme');
define('THEME_IMAGES', THEME_URI . '/images');
define('THEME_CSS', THEME_URI . '/assets/css');
define('THEME_JS', THEME_URI . '/assets/js');
define('THEME_HEADER', '/templates/parts/header');
define('THEME_SIDEBAR', '/templates/parts/sidebar');
define('THEME_FOOTER', '/templates/parts/footer');
define('THEME_BOTONERA', '/templates/sections/home_botonera');
define('THEME_NEWS', '/templates/sections/home_news');
define('THEME_SPECIAL', '/templates/special/');

add_filter('show_admin_bar', '__return_false');

// Basic Setup
function msm_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'msm_theme_setup');

// Habilitar estilos del editor y conectar theme.json
add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
    add_editor_style('style.css'); // Refleja tu :root en Gutenberg
});

// Encolar la hoja de estilo del theme en frontend
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'msm-theme-style',
        get_stylesheet_uri(),
        [],
        wp_get_theme()->get('Version')
    );

    // Cargar estilos de la guía de estilos solo en la página correspondiente
    if (is_page_template('page-style-guide.php')) {
        wp_enqueue_style(
            'msm-style-guide',
            get_template_directory_uri() . '/assets/css/style-guide.css',
            [],
            wp_get_theme()->get('Version')
        );
    }
});

function _get_sidebar()
{
    $file = get_template_directory() . '/templates/parts/sidebar.php';
    if (file_exists($file)) {
        include $file;
    } else {
        echo '<!--  -->';
    }
}

// Addons Custom Post Template Handling
function enable_custom_post_templates($post_templates)
{
    $template_dir = get_template_directory() . '/templates/single-templates/';
    $files = glob($template_dir . '*.php');
    foreach ($files as $file) {
        $filename = basename($file);
        $post_templates[$filename] = $filename;
    }
    return $post_templates;
}
add_filter('theme_post_templates', 'enable_custom_post_templates');

function my_custom_post_templates()
{
    $formatted_templates = [];
    $template_dir = get_template_directory() . '/templates/single-templates/';
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
function register_my_custom_post_templates_route()
{
    register_rest_route('custom/v1', '/post-templates', array(
        'methods' => 'GET',
        'callback' => 'my_custom_post_templates',
        'permission_callback' => '__return_true',
    ));
}
add_action('rest_api_init', 'register_my_custom_post_templates_route');


function date_formated($post)
{
    $semi_destacadas[] = $post->ID;
    $date = new DateTime($post->post_date);

    $dia = $date->format('j');
    $mes = $date->format('F');

    $mes_espanol = '';
    switch ($mes) {
        case 'January':
            $mes_espanol = 'Enero';
            break;
        case 'February':
            $mes_espanol = 'Febrero';
            break;
        case 'March':
            $mes_espanol = 'Marzo';
            break;
        case 'April':
            $mes_espanol = 'Abril';
            break;
        case 'May':
            $mes_espanol = 'Mayo';
            break;
        case 'June':
            $mes_espanol = 'Junio';
            break;
        case 'July':
            $mes_espanol = 'Julio';
            break;
        case 'August':
            $mes_espanol = 'Agosto';
            break;
        case 'September':
            $mes_espanol = 'Septiembre';
            break;
        case 'October':
            $mes_espanol = 'Octubre';
            break;
        case 'November':
            $mes_espanol = 'Noviembre';
            break;
        case 'December':
            $mes_espanol = 'Diciembre';
            break;
    };

    // Formatear la fecha como "d de Mes"
    $fecha_formateada = $dia . ' de ' . $mes_espanol;
    return $fecha_formateada;
}

function datePretty($fecha)
{
    // Crear un objeto DateTime a partir de la fecha proporcionada
    $date = new DateTime($fecha);

    // Obtener el día y el mes en inglés
    $dia = $date->format('j');
    $mes = $date->format('F');

    // Mapear el mes en inglés al mes en español
    $mes_espanol = array(
        'January'   => '01',
        'February'  => '02',
        'March'     => '03',
        'April'     => '04',
        'May'       => '05',
        'June'      => '06',
        'July'      => '07',
        'August'    => '08',
        'September' => '09',
        'October'   => '10',
        'November'  => '11',
        'December'  => '12'
    );

    // Obtener el mes en español
    $mes_espanol = isset($mes_espanol[$mes]) ? $mes_espanol[$mes] : $mes;

    // Formatear la fecha como "d de Mes"
    $fecha_formateada = $dia . '/' . $mes_espanol;
    return $fecha_formateada;
}

function dayPretty($fecha)
{
    // Crear un objeto DateTime a partir de la fecha proporcionada
    $date = new DateTime($fecha);

    // Obtener el día de la semana en inglés
    $dia_semana_ingles = $date->format('l'); // 'l' devuelve el nombre completo del día en inglés (e.g., 'Monday')

    // Mapear el día de la semana en inglés al día de la semana en español
    $dias_semana_espanol = array(
        'Monday'    => 'Lunes',
        'Tuesday'   => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday'  => 'Jueves',
        'Friday'    => 'Viernes',
        'Saturday'  => 'Sábado',
        'Sunday'    => 'Domingo'
    );

    // Obtener el día de la semana en español
    $dia_semana_espanol = isset($dias_semana_espanol[$dia_semana_ingles]) ? $dias_semana_espanol[$dia_semana_ingles] : $dia_semana_ingles;

    return $dia_semana_espanol;
    
}

function string_limit_words($string, $word_limit)
{
    $words = explode(' ', $string, ($word_limit + 1));
    // if(count($words) > $word_limit)
    array_pop($words);
    return implode(' ', $words);
}

function short_description()
{
    $excerpt = get_the_excerpt();
    $excerpt = substr(strip_tags($excerpt), 0, 255);
    echo $excerpt;
}


function list_rest_endpoints()
{
    // Obtén todas las rutas registradas
    $endpoints = rest_get_server()->get_routes();

    // Prepara un array para almacenar los resultados
    $results = [];

    // Recorre cada ruta
    foreach ($endpoints as $route => $methods) {
        // Cada ruta puede tener múltiples métodos, así que recorremos los métodos
        foreach ($methods as $method_data) {
            // Verificamos si el método es un array y extraemos los métodos
            if (isset($method_data['methods']) && is_array($method_data['methods'])) {
                $methods_list = array_keys($method_data['methods']); // Extrae las claves del array de métodos
            } else {
                $methods_list = [];
            }
            // Almacena el nombre de la ruta y los métodos asociados
            $results[] = [
                'route' => $route,
                'methods' => $methods_list,
            ];
        }
    }

    // Devuelve los resultados como una respuesta de la REST API
    return rest_ensure_response($results);
}
add_action('rest_api_init', function () {
    register_rest_route('custom/v1', '/list-endpoints', array(
        'methods'  => 'GET',
        'callback' => 'list_rest_endpoints',
        'permission_callback' => '__return_true',
    ));
});



function custom_prensa_rewrite_rule()
{
    add_rewrite_rule('^prensa/?$', 'index.php?pagename=prensa', 'top');
}
add_action('init', 'custom_prensa_rewrite_rule');

// Custom Mapping for Specials Pages
function custom_page_template_mapping($template)
{
    global $post;

    $template_map = array(
        'accion_comunitaria' => THEME_SPECIAL . '/accion_comunitaria/landing.php',
        'boletin_oficial' => THEME_SPECIAL . '/boletin_oficial/landing.php',
        'bromatologia' => THEME_SPECIAL . '/bromatologia/landing.php',
        'documentacion' => THEME_SPECIAL . '/documentacion/landing.php',
        'economia_finanzas' => THEME_SPECIAL . '/economia_finanzas/landing.php',
        'habilitaciones' => THEME_SPECIAL . '/habilitaciones/landing.php',
        'licencias-2' => THEME_SPECIAL . '/licencias/landing.php',
        'sem-2' => THEME_SPECIAL . '/sem/landing.php',
        'tercera_edad' => THEME_SPECIAL . '/tercera_edad/landing.php',
        'zoonosis' => THEME_SPECIAL . '/zoonosis/landing.php',
        'reclamos-2' => THEME_SPECIAL . '/reclamos/landing.php',
    );

    $page_slug = $post->post_name;

    // Verificar si la página tiene una página padre y construir el slug final
    function get_final_slug($post)
    {
        $page_slug = $post->post_name;
        $category = get_the_category($post->ID); // Obtener la categoría de la página

        // Verificar si tiene padre
        if ($post->post_parent) {
            $parent_post = get_post($post->post_parent);
            $parent_slug = $parent_post->post_name;

            // Generar la URL jerárquica
            if (!empty($category)) {
                return strtolower("web.com/{$category[0]->slug}/{$parent_slug}/{$page_slug}.php");
            } else {
                return strtolower("web.com/{$parent_slug}/{$page_slug}.php");
            }
        } else {
            // Si no tiene padre, solo la categoría y la página
            if (!empty($category)) {
                return strtolower("web.com/{$category[0]->slug}/{$page_slug}.php");
            } else {
                return strtolower("web.com/{$page_slug}.php");
            }
        }
    }

    // Obtener el slug final
    $final_slug = get_final_slug($post);

    // Depuración
    error_log("Page slug: " . $page_slug);
    error_log("Final slug: " . $final_slug);

    // Verificar si el slug está en el mapa de plantillas
    if (array_key_exists($page_slug, $template_map)) {
        $mapped_template = locate_template($template_map[$page_slug]);
        error_log("Mapped template: " . $mapped_template);
        if ($mapped_template) {
            echo "<!-- Template found: " . $template_map[$page_slug] . " -->"; // Solo en desarrollo
            return $mapped_template;
        } else {
            error_log("Template not found: " . $template_map[$page_slug]);
        }
    } else {
        error_log("Page slug not in template map: " . $page_slug);
    }

    return $template;
}
add_filter('page_template', 'custom_page_template_mapping');



/* URL CUSTOM TYC */
function redirect_terms_and_conditions()
{
    if (is_page('terminos-y-condiciones')) {
        include(get_template_directory() . THEME_SPECIAL . '/page-terminos-y-condiciones.php');
        exit;
    }
}
add_action('template_redirect', 'redirect_terms_and_conditions');

function my_custom_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'my_custom_mime_types');

// function listar_rutas_registradas()
// {
//     global $wp_rewrite;
//     echo '<pre>';
//     print_r($wp_rewrite->wp_rewrite_rules());
//     echo '</pre>';
// }
// add_action('init', 'listar_rutas_registradas');


function ordenar_posts_alfabeticamente($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_archive()) {
        $query->set('orderby', 'title');
        $query->set('order', 'ASC');
    }
}
add_action('pre_get_posts', 'ordenar_posts_alfabeticamente');



/**
 * Crea un ajuste en el Personalizador → "Aviso emergente"
 */
function msm_register_alert_customizer( $wp_customizer ) {

	$wp_customizer->add_section(
		'msm_alert_section',
		array(
			'title'    => __( 'Aviso emergente', 'msm' ),
			'priority' => 30,
		)
	);

	$wp_customizer->add_setting(
		'msm_alert_text',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
		)
	);

	$wp_customizer->add_control(
		'msm_alert_text',
		array(
			'label'       => __( 'Mensaje a mostrar (dejar vacío para ocultar)', 'msm' ),
			'type'        => 'textarea',
			'section'     => 'msm_alert_section',
		)
	);
}
add_action( 'customize_register', 'msm_register_alert_customizer' );



/**
 * Renderiza el banner de alerta en la Home.
 */
function msm_render_home_alert() {

	// Solo en la home
	if ( ! is_front_page() ) {
		return;
	}

	$alert_text = trim( get_theme_mod( 'msm_alert_text', '' ) );

	// Si no hay texto → no se muestra
	if ( empty( $alert_text ) ) {
		return;
	}

	?>
	<div class="msm-alert-bar justify-content-center">
		<span class="msm-alert-icon" aria-hidden="true">
            <?php inline_svg('megafono'); ?>
		</span>
		<span class="msm-alert-text"><?php echo wp_kses_post( $alert_text ); ?></span>
	</div>
	<?php
}

function msm_register_programa_servicio_taxonomy() {
    register_taxonomy(
      'programa_servicio',
      'page', // O 'post' u otro CPT si preferís`
      array(
        'labels' => array(
          'name' => 'Programas y Servicios',
          'singular_name' => 'Programa o Servicio',
          'menu_name' => 'Programas y Servicios',
          'all_items' => 'Todos los Programas',
          'edit_item' => 'Editar Programa',
          'view_item' => 'Ver Programa',
          'update_item' => 'Actualizar Programa',
          'add_new_item' => 'Agregar nuevo Programa',
          'new_item_name' => 'Nuevo nombre',
          'search_items' => 'Buscar Programas',
        ),
        'hierarchical' => true, // true = como categorías, false = como tags
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_rest' => true, // para soporte en editor Gutenberg
        'rewrite' => array('slug' => 'programas'),
      )
    );
  }
  add_action('init', 'msm_register_programa_servicio_taxonomy');
  

  /* Campo personalizado para sidebar de post */
  function msm_sidebar_metabox() {
    add_meta_box(
      'msm_sidebar_info',
      'Contenido del Sidebar',
      'msm_sidebar_info_callback',
      ['post', 'page'], // tipos de contenido
      'side'
    );
  }
  add_action('add_meta_boxes', 'msm_sidebar_metabox');
  
  function msm_sidebar_info_callback($post) {
    $value = get_post_meta($post->ID, '_msm_sidebar_info', true);
    wp_editor($value, '_msm_sidebar_info', array(
      'textarea_name' => '_msm_sidebar_info',
      'textarea_rows' => 10,
      'media_buttons' => false,
    ));
  }
  
  function msm_sidebar_info_save($post_id) {
    if (array_key_exists('_msm_sidebar_info', $_POST)) {
      update_post_meta($post_id, '_msm_sidebar_info', $_POST['_msm_sidebar_info']);
    }
  }
  add_action('save_post', 'msm_sidebar_info_save');
  


  // REGISTRAR el metabox de subtítulo
function msm_subtitulo_metabox() {
  add_meta_box(
    'msm_subtitulo',
    'Subtítulo del contenido',
    'msm_subtitulo_callback',
    ['post', 'page'], // Podés agregar otros tipos si querés
    'normal',
    'high'
  );
}
add_action('add_meta_boxes', 'msm_subtitulo_metabox');

// CALLBACK del editor WYSIWYG para el subtítulo
function msm_subtitulo_callback($post) {
  $value = get_post_meta($post->ID, '_msm_subtitulo', true);
  wp_editor($value, '_msm_subtitulo', array(
    'textarea_name' => '_msm_subtitulo',
    'textarea_rows' => 4,
    'media_buttons' => false,
  ));
}

// GUARDAR el valor del subtítulo
function msm_subtitulo_save($post_id) {
  if (array_key_exists('_msm_subtitulo', $_POST)) {
    update_post_meta($post_id, '_msm_subtitulo', $_POST['_msm_subtitulo']);
  }
}
add_action('save_post', 'msm_subtitulo_save');




