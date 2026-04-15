<?php
if (!defined('ABSPATH'))
    exit;

function msm_register_cpt_eventos_municipales()
{

    $labels = array(
        'name' => 'Eventos municipales',
        'singular_name' => 'Evento municipal',
        'menu_name' => 'Eventos municipales',
        'name_admin_bar' => 'Evento municipal',
        'add_new' => 'Agregar nuevo',
        'add_new_item' => 'Agregar nuevo Evento municipal',
        'new_item' => 'Nuevo Evento municipal',
        'edit_item' => 'Editar Evento municipal',
        'view_item' => 'Ver Evento municipal',
        'all_items' => 'Todos los Eventos municipales',
        'search_items' => 'Buscar Eventos municipales',
        'not_found' => 'No se encontraron eventos municipales.',
        'not_found_in_trash' => 'No se encontraron eventos municipales en la papelera.',
        'archives' => 'Archivo de Eventos municipales',
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
        'has_archive' => 'eventos',
        'rewrite' => array(
            'slug' => 'eventos',
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
