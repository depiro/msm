<?php
/**
 * Taxonomía: Área de Gobierno (jerárquica)
 */

if (!defined('ABSPATH'))
    exit;

function msm_register_tax_area_gobierno_eventos()
{

    $labels = array(
        'name' => 'Áreas de Gobierno',
        'singular_name' => 'Área de Gobierno',
        'search_items' => 'Buscar Áreas',
        'all_items' => 'Todas las Áreas',
        'parent_item' => 'Área padre',
        'parent_item_colon' => 'Área padre:',
        'edit_item' => 'Editar Área',
        'update_item' => 'Actualizar Área',
        'add_new_item' => 'Agregar nueva Área',
        'new_item_name' => 'Nombre de nueva Área',
        'menu_name' => 'Área de Gobierno',
    );

    $args = array(
        'hierarchical' => true,           // padre/hijo = Área/Subárea
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,           // columna en admin
        'show_in_rest' => true,           // Gutenberg / REST
        'query_var' => true,
        'public' => true,
        'rewrite' => array(
            'slug' => 'area-gobierno',
            'with_front' => false,
        ),
    );

    // La taxonomía se asocia al CPT evento_municipal
    register_taxonomy('area_gobierno', array('evento_municipal'), $args);
}
add_action('init', 'msm_register_tax_area_gobierno_eventos', 0);

/**
 * Regla extra para los archivos de la taxonomía
 * /area-gobierno/slug-del-area/
 */
function msm_area_gobierno_rewrite_rule()
{
    add_rewrite_rule(
        '^area-gobierno/([^/]+)/?$',
        'index.php?taxonomy=area_gobierno&term=$matches[1]',
        'top'
    );
}
add_action('init', 'msm_area_gobierno_rewrite_rule');
