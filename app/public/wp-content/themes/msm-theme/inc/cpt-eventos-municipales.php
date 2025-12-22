<?php
if (!defined('ABSPATH'))
    exit;

function msm_register_cpt_eventos_municipales()
{

    $labels = array(
        'name' => 'Eventos Municipales',
        'singular_name' => 'Evento Municipal',
        'menu_name' => 'Eventos Municipales',
        'name_admin_bar' => 'Evento Municipal',
        'add_new' => 'Agregar nuevo',
        'add_new_item' => 'Agregar nuevo Evento Municipal',
        'new_item' => 'Nuevo Evento Municipal',
        'edit_item' => 'Editar Evento Municipal',
        'view_item' => 'Ver Evento Municipal',
        'all_items' => 'Todos los Eventos Municipales',
        'search_items' => 'Buscar Eventos Municipales',
        'not_found' => 'No se encontraron eventos.',
        'not_found_in_trash' => 'No se encontraron eventos en la papelera.',
        'archives' => 'Archivo de Eventos Municipales',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies' => array('post_tag'),
        'has_archive' => 'eventos-municipales',
        'rewrite' => array(
            'slug' => 'eventos-municipales',
            'with_front' => false,
        ),
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        // 👇 NO ponemos 'template' ni 'template_lock' acá
    );

    register_post_type('evento_municipal', $args);
}
add_action('init', 'msm_register_cpt_eventos_municipales', 0);
