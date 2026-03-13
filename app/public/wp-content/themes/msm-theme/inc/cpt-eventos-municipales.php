<?php
if (!defined('ABSPATH'))
    exit;

function msm_register_cpt_eventos_municipales()
{

    $labels = array(
        'name' => 'Agenda',
        'singular_name' => 'Evento',
        'menu_name' => 'Agenda',
        'name_admin_bar' => 'Evento',
        'add_new' => 'Agregar nuevo',
        'add_new_item' => 'Agregar nuevo Evento',
        'new_item' => 'Nuevo Evento',
        'edit_item' => 'Editar Evento',
        'view_item' => 'Ver Evento',
        'all_items' => 'Todos los Eventos',
        'search_items' => 'Buscar Eventos',
        'not_found' => 'No se encontraron eventos.',
        'not_found_in_trash' => 'No se encontraron eventos en la papelera.',
        'archives' => 'Archivo de Agenda',
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
        'has_archive' => 'agenda',
        'rewrite' => array(
            'slug' => 'agenda',
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
