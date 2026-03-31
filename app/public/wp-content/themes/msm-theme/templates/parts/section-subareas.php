<?php
/**
 * Componente: Barra de Sub-areas / Direcciones
 * Muestra las páginas hijas (sub-areas) de un Área de Gobierno.
 *
 * Lógica:
 * 1. Determina el término "padre" (el Área de Gobierno principal).
 * 2. Busca las páginas asociadas a los términos hijos de ese padre.
 * 3. Muestra las tarjetas.
 */

// Intentar obtener el término actual (si estamos en taxonomía)
$current_term = get_queried_object();
$term_id = 0;

if ($current_term instanceof WP_Term && $current_term->taxonomy === 'area_gobierno') {
    // Caso 1: Estamos en el archivo de la taxonomía
    $term_id = $current_term->term_id;
} elseif (is_singular('page')) {
    // Caso 2: Estamos en una página individual
    // Obtener los términos asignados a la página
    $terms = get_the_terms(get_the_ID(), 'area_gobierno');

    if ($terms && !is_wp_error($terms)) {
        // Tomamos el primer término asignado (asumimos que una página pertenece principalmente a un área)
        $assigned_term = $terms[0];

        // Si el término asignado tiene padre, el padre es el Área Principal
        // Si no tiene padre, el término asignado ES el Área Principal
        if ($assigned_term->parent > 0) {
            $term_id = $assigned_term->parent;
        } else {
            $term_id = $assigned_term->term_id;
        }

        // Cargar el objeto termino completo para obtener el slug y nombre si es necesario
        $current_term = get_term($term_id, 'area_gobierno');
    }
}

// Si no tenemos un term_id válido, no mostramos nada
if (!$term_id) {
    return;
}

// Lógica de Query (extraída de taxonomy-area_gobierno.php)
$child_terms = get_term_children($term_id, 'area_gobierno');
$exclude_ids = array(); // Array para excluir posts (si se usa posteriormente en el loop principal)

// Solo proceder si hay términos hijos
if (!empty($child_terms) && !is_wp_error($child_terms)) {
    $sub_pages_query = new WP_Query(array(
        'post_type' => 'page',
        'posts_per_page' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'area_gobierno',
                'field' => 'term_id',
                'terms' => $child_terms,
                'operator' => 'IN',
            ),
        ),
        // Ordenamos en PHP para controlar mejor los ceros
    ));

    // Ordenar los posts con PHP para que los que tienen "menu_order" 0 vayan al final
    usort($sub_pages_query->posts, function($a, $b) {
        $order_a = (int) $a->menu_order;
        $order_b = (int) $b->menu_order;

        if ($order_a == 0 && $order_b > 0) return 1;
        if ($order_b == 0 && $order_a > 0) return -1;
        if ($order_a != $order_b) return $order_a - $order_b;
        
        // Empate (ambos 0 o el mismo numero), ordenamos alfabeticamente
        return strcmp($a->post_title, $b->post_title);
    });
} else {
    $sub_pages_query = new WP_Query();
}

// Inyección manual para "Subsecretaría de Eventos Municipales"
// Se muestra si el área principal es 'secretaria-de-comunicacion-y-deportes'
$show_eventos_sub = ($current_term && !is_wp_error($current_term) && $current_term->slug === 'secretaria-de-comunicacion-y-deportes');

// Inyección manual para "Hospitales"
$show_hospitales_sub = ($current_term && !is_wp_error($current_term) && $current_term->slug === 'secretaria-de-salud');


if ($sub_pages_query->have_posts() || $show_eventos_sub || $show_hospitales_sub): ?>
    <div class="w-100 py-4" style="background-color: #f9f9f9; border-bottom: 1px solid #eee;">
        <div class="container">
            <div class="row gy-3">
                <?php while ($sub_pages_query->have_posts()):
                    $sub_pages_query->the_post();
                    $exclude_ids[] = get_the_ID(); // Prevent this post from appearing in the main loop below
                    $title = get_the_title();
                    $link = get_permalink();
                    include get_template_directory() . '/templates/parts/card-subarea.php';
                endwhile;
                wp_reset_postdata();

                // Manual injection for Subsecretaría de Eventos Municipales
                if ($show_eventos_sub):
                    $eventos_term = get_term_by('slug', 'subsecretaria-de-eventos-municipales', 'area_gobierno');
                    if ($eventos_term) {
                        $title = 'Eventos';
                        $link = get_post_type_archive_link('evento_municipal');
                        include get_template_directory() . '/templates/parts/card-subarea.php';
                    }
                endif;

                // Inyección manual para Hospitales
                if ($show_hospitales_sub):
                    $title = 'Hospitales';
                    $link = get_post_type_archive_link('hospitales');
                    include get_template_directory() . '/templates/parts/card-subarea.php';
                endif;
                ?>
            </div>
        </div>
    </div>
<?php endif; ?>