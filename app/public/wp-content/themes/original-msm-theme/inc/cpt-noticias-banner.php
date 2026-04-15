<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register Custom Post Type: Noticias Banner
 */
function msm_register_cpt_noticias_banner()
{

    $labels = array(
        'name' => 'Noticias Banner',
        'singular_name' => 'Noticia Banner',
        'menu_name' => 'Noticias Banner',
        'name_admin_bar' => 'Noticia Banner',
        'add_new' => 'Agregar Nueva',
        'add_new_item' => 'Agregar Nueva Noticia',
        'new_item' => 'Nueva Noticia',
        'edit_item' => 'Editar Noticia',
        'view_item' => 'Ver Noticia',
        'all_items' => 'Todas las Noticias',
        'search_items' => 'Buscar Noticias',
        'parent_item_colon' => 'Noticia Padre:',
        'not_found' => 'No se encontraron noticias.',
        'not_found_in_trash' => 'No se encontraron noticias en la papelera.',
        'featured_image' => 'Imagen Destacada',
        'set_featured_image' => 'Establecer imagen destacada',
        'remove_featured_image' => 'Eliminar imagen destacada',
        'use_featured_image' => 'Usar como imagen destacada',
        'archives' => 'Archivo de Noticias',
        'insert_into_item' => 'Insertar en la noticia',
        'uploaded_to_this_item' => 'Subido a esta noticia',
        'filter_items_list' => 'Filtrar lista de noticias',
        'items_list_navigation' => 'Navegación de lista de noticias',
        'items_list' => 'Lista de noticias',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'noticias-banner'),
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-megaphone',
        'show_in_rest' => true, // Gutenberg support
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'custom-fields'),
        'taxonomies' => array('post_tag'),
    );

    register_post_type('noticias-banner', $args);
}
add_action('init', 'msm_register_cpt_noticias_banner');

/**
 * Register Taxonomies for Noticias Banner
 * (Ensuring post_tag is associated)
 */
function msm_register_taxonomies_noticias_banner()
{
    register_taxonomy_for_object_type('post_tag', 'noticias-banner');
}
add_action('init', 'msm_register_taxonomies_noticias_banner');
