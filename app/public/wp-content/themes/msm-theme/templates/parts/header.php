<!doctype html>
<html lang="es" date="<?php echo date('Y-m-d H:i:s') ?>">

<head>
    <!-- Google Tag Manager -->
    <script>
        (function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NK659CK');
    </script>
    <!-- End Google Tag Manager -->
    <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name') ?> RSS Feed"
        href="<?php bloginfo('rss2_url'); ?>" />
    <meta http-equiv="Content-Language" content="es">
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo THEME_URI ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo THEME_URI ?>/assets/css/main.css" rel="stylesheet" />
    <!-- <link href="<?php echo THEME_URI ?>/assets/css/fonts.css" rel="stylesheet" / -->
    <link href="<?php echo THEME_URI ?>/assets/css/responsive.css" rel="stylesheet" />
    <?php wp_head(); ?>
</head>

<body class="wrapper">

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NK659CK" height="0" width="0"
            style="display:none;visibility:hidden">
        </iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->
    <!-- Sección Header -->
    <header class="navbar navbar-expand-lg navbar-light msm-header-v1 d-flex flex-column">
        <div class="container px-0">
            <div class="w-100 d-flex justify-content-between px-2">
                <a class="navbar-brand" href="<?php echo HOME_URI; ?>" title="<?php echo get_bloginfo('name'); ?> | Provincia de Buenos Aires. Argentina "">
                    <img class="msm-header-logo" src=" <?php echo THEME_URI; ?>/assets/images/msmlogo-circulo.svg" alt="">
                    <img class="px-2 msm-header-logotipo" src="<?php echo THEME_URI; ?>/assets/images/msm-logotipo.svg"></img>
                </a>

                <button class="navbar-toggler menu-container-toggle d-block d-md-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Links header -->
                <div class="d-none d-md-flex justify-content-end align-items-center menu-container gap-3 ">

                    <a id="collapse-tramites" class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" data-bs-toggle="collapse" href="#menu-tramites"
                        role="button" aria-expanded="false" aria-controls="menu-tramites">Trámites
                        <?php inline_svg('note_stack'); ?>
                    </a>
                        
                    <a id="collapse-areas-gob" class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" data-bs-toggle="collapse" href="#menu-areas-gob"
                        role="button" aria-expanded="false" aria-controls="menu-areas-gob">Áreas de Gobierno
                        <?php inline_svg('flowchart'); ?>
                    </a>

                    <a id="collapse-municipio" class="msm-menu-link btn btn-outline-light btn-sm text-white text-decoration-none" data-bs-toggle="collapse" href="#menu-municipio" role="button" aria-expanded="false" aria-controls="menu-municipio">
                        Gobierno Abierto
                        <?php inline_svg('account_balance'); ?>
                    </a>
                    
                    <a class="msm-menu-link btn btn-outline-light text-white text-decoration-none btn-sm" href="https://online.fliphtml5.com/hxrqr/mdra/" role="button" aria-expanded="false" aria-controls="menu-areas-gob" target="_blank">
                        San Miguel en Imágenes
                        <?php inline_svg('images'); ?>
                    </a>
                </div>
            </div>
        </div>


        <div class="row bg-white p-0 m-auto msm-menu-content d-none d-sm-block" id="main-menu-gob"
            style="max-width: 300px;min-width: 300px;right:200px">
            <div class="collapse multi-collapse bg-white" id="menu-areas-gob">

                <?php
                $terms_gob = get_terms(array(
                    'taxonomy' => 'area_gobierno',
                    'hide_empty' => false,
                    'orderby' => 'meta_value_num'
                ));
                ?>

                <div class="row px-0">
                    <div class="px-3 py-2 mt-3">
                        <a class="btn btn-primary w-100 text-white"
                            style="font-size: 14px;color: white !important;background: #1ab3ea;border: 0;text-align:left;padding-top:10px; padding-bottom:10px;"
                            href="/areas-gobierno/">
                            Ver Áreas de Gobierno
                        </a>
                    </div>
                    <div class="col-12 px-0">
                        <?php
                        if (!empty($terms_gob) && !is_wp_error($terms_gob)):
                            foreach ($terms_gob as $term):

                                if ($term->name == 'Gobierno Abierto')
                                    continue;

                                $query_args = array(
                                    'post_type' => 'page',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'area_gobierno',
                                            'field' => 'term_id',
                                            'terms' => $term->term_id,
                                        ),
                                    ),
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                );
                                $query = new WP_Query($query_args);
                                ?>

                                <div class="dropdown px-0">
                                    <button
                                        class="fz-14 msm-content-item msm-text-black fw-600 bg-white border-top-0 border-left-0 border-right-0 d-flex justify-content-between align-items-center border-0 rounded-0 dropdown-toggle w-100 px-3 py-2"
                                        type="button" id="collapse1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo esc_attr($term->name); ?>
                                    </button>
                                    <?php if ($query->have_posts()): ?>
                                        <div class="msm-dropdown-cat dropdown-menu w-100 p-0 border-0" aria-labelledby="collapse1">
                                            <div class="px-3 py-2">
                                                <a class="btn btn-primary w-100 text-white"
                                                    style="font-size: 14px;color: #1ab3ea !important;background: #f1f6f9;border: 0;"
                                                    href="<?php echo esc_url(get_term_link($term)); ?>">
                                                    Ver área <?php echo esc_html($term->name); ?>
                                                </a>
                                            </div>
                                            <?php while ($query->have_posts()):
                                                $query->the_post(); ?>
                                                <?php if (get_the_title() == 'Reclamos')
                                                    continue; ?>
                                                <div class="msm-dropdown-menu-subcat ps-1">
                                                    <a class="fz-14 px-3" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </div>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="row bg-white p-0 m-auto msm-menu-content" id="main-menu-tramites"
            style="max-width: 300px;min-width: 300px;">
            <div class="collapse multi-collapse bg-white" id="menu-tramites">

                <?php
                // Obtener términos de la taxonomía `area_tramite`
                $terms = get_terms(array(
                    'taxonomy' => 'area_tramite',
                    'hide_empty' => false,
                ));
                ?>

                <div class="row px-0">
                    <div class="col-12 px-0">
                        <?php
                        if (!empty($terms) && !is_wp_error($terms)):
                            foreach ($terms as $term):
                                // Consulta para obtener posts del tipo `tramite` relacionados con el término actual
                                $query_args = array(
                                    'post_type' => 'tramite',
                                    'tax_query' => array(
                                        array(
                                            'taxonomy' => 'area_tramite',
                                            'field' => 'term_id',
                                            'terms' => $term->term_id,
                                        ),
                                    ),
                                    'posts_per_page' => -1,
                                    'orderby' => 'title',
                                    'order' => 'ASC',
                                );
                                $query = new WP_Query($query_args);
                                ?>

                                <div class="dropdown px-0">
                                    <button
                                        class="fz-14 msm-content-item msm-text-black fw-600 bg-white border border-top-0 border-left-0 border-right-0 d-flex justify-content-between align-items-center border-0 rounded-0 dropdown-toggle w-100 px-3 py-2"
                                        type="button" id="collapse1" data-bs-toggle="dropdown" aria-expanded="false">
                                        <?php echo esc_attr($term->name); ?>
                                    </button>
                                    <?php if ($query->have_posts()): ?>
                                        <div class="msm-dropdown-cat dropdown-menu w-100 p-0 border-0" aria-labelledby="collapse1">
                                            <?php while ($query->have_posts()):
                                                $query->the_post(); ?>
                                                <div class="msm-dropdown-menu-subcat ps-1">
                                                    <a class="fz-14 px-3" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </div>
                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach;
                        endif;
                        ?>
                    </div>
                </div>

            </div>
        </div>
        <div class="row bg-white p-0 m-auto msm-menu-content d-none d-sm-block" id="main-menu-municipio"
            style="max-width: 300px;min-width: 300px;right: 10%;">
            <div class="collapse multi-collapse bg-white" id="menu-municipio">
                <?php
                $term_mi_municipio = get_term_by('name', 'Gobierno Abierto', 'area_gobierno');

                if ($term_mi_municipio):

                    $query_args = array(
                        'post_type' => 'page',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'area_gobierno',
                                'field' => 'term_id',
                                'terms' => $term_mi_municipio->term_id,
                            ),
                        ),
                        'posts_per_page' => -1,
                        'orderby' => 'title',
                        'order' => 'ASC',
                    );

                    $query = new WP_Query($query_args);
                    ?>

                    <div class="row px-0">
                        <div class="col-12 px-0">
                            <?php if ($query->have_posts()): ?>
                                <?php while ($query->have_posts()):
                                    $query->the_post(); ?>
                                    <div class="dropdown px-0">
                                        <div class="msm-dropdown-menu-subcat ps-1">
                                            <a class="fz-14 px-3" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                                <?php wp_reset_postdata(); ?>
                            <?php else: ?>
                                <p>No hay páginas relacionadas con "Gobierno Abierto".</p>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>


    <div class="collapse d-md-none w-100 bg-white" id="navbarNavAltMarkup">
        <div class="d-flex p-2 align-items-center">
            <form action="<?php echo get_bloginfo('url') ?>" id="form-busqueda"
                class="menu-search-container px-2 w-100">
                <input value="<?php echo get_search_query(); ?>" name="s" id="s" class="w-100 menu-search-input"
                    placeholder="Buscar..." />
            </form>
            <img class="menu-search-icon px-2" id="icon-search" style="height:20px !important;"
                src="<?php echo THEME_URI; ?>/assets/images/search-icon.svg"></img>
        </div>

        <div class="accordion w-100" id="accordionExample">
            <!-- Menu mobile -->
            <div class="row">
                <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                    <a id="collapse-mobile-tramites" class="msm-menu-link py-2" data-bs-toggle="collapse"
                        href="#menu-mobile-tramites" role="button" aria-expanded="false"
                        aria-controls="menu-tramites">Trámites</a>
                    <div class="collapse multi-collapse bg-white w-100 px-3" id="menu-mobile-tramites">

                        <?php
                        // Obtener términos de la taxonomía `area_tramite`
                        $terms = get_terms(array(
                            'taxonomy' => 'area_tramite',
                            'hide_empty' => false,
                        ));
                        ?>

                        <div class="row px-0">
                            <div class="col-12 px-0">
                                <?php
                                if (!empty($terms) && !is_wp_error($terms)):
                                    foreach ($terms as $term):
                                        // Consulta para obtener posts del tipo `tramite` relacionados con el término actual
                                        $query_args = array(
                                            'post_type' => 'tramite',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'area_tramite',
                                                    'field' => 'term_id',
                                                    'terms' => $term->term_id,
                                                ),
                                            ),
                                            'posts_per_page' => -1,
                                            'orderby' => 'title',
                                            'order' => 'ASC',
                                        );
                                        $query = new WP_Query($query_args);
                                        ?>
                                        <div class="dropdown px-0">
                                            <button style="color:#44424d"
                                                class="fz-14 fw-600 msm-content-item bg-white border border-top-0 border-left-0 border-right-0 d-flex justify-content-between align-items-center border-0 rounded-0 dropdown-toggle w-100 px-3 py-2"
                                                type="button" id="collapse1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo esc_attr($term->name); ?>
                                            </button>
                                            <?php if ($query->have_posts()): ?>
                                                <div class="msm-dropdown-cat dropdown-menu w-100 p-0 border-0"
                                                    aria-labelledby="collapse1">
                                                    <?php while ($query->have_posts()):
                                                        $query->the_post(); ?>
                                                        <div class="msm-dropdown-menu-subcat ps-1">
                                                            <a class="fz-14 px-3"
                                                                href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                        </div>
                                                    <?php endwhile; ?>
                                                    <?php wp_reset_postdata(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                    <a id="collapse-mobile-areas-gob" class="msm-menu-link py-2" data-bs-toggle="collapse"
                        href="#menu-mobile-areas-gob" role="button" aria-expanded="false"
                        aria-controls="menu-areas-gob">Áreas de Gobierno</a>
                    <div class="collapse multi-collapse bg-white w-100 px-3" id="menu-mobile-areas-gob">

                        <?php
                        $terms_gob = get_terms(array(
                            'taxonomy' => 'area_gobierno',
                            'hide_empty' => false,
                            'orderby' => 'meta_value_num',
                        ));
                        ?>

                        <div class="row msm-text-black px-0">
                            <div class="col-12 px-0">
                                <div class="px-3 py-2">
                                    <a class="btn btn-primary w-100 text-white"
                                        style="font-size: 14px;color: white !important;background: #1ab3ea;border: 0;text-align:left;"
                                        href="/areas-gobierno/">
                                        Ver Áreas de Gobierno
                                    </a>
                                </div>
                                <?php
                                if (!empty($terms_gob) && !is_wp_error($terms_gob)):
                                    foreach ($terms_gob as $term):
                                        $query_args = array(
                                            'post_type' => 'page',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'area_gobierno',
                                                    'field' => 'term_id',
                                                    'terms' => $term->term_id,
                                                ),
                                            ),
                                            'posts_per_page' => -1,
                                            'orderby' => 'title',
                                            'order' => 'ASC',
                                        );
                                        $query = new WP_Query($query_args);
                                        if ($term->name == 'Gobierno Abierto')
                                            continue;
                                        ?>

                                        <div class="dropdown px-0">
                                            <button
                                                class="fz-14 msm-text-black fw-600 msm-content-item bg-white border border-top-0 border-left-0 border-right-0 d-flex justify-content-between align-items-center border-0 rounded-0 dropdown-toggle w-100 px-3 py-2"
                                                type="button" id="collapse1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <?php echo esc_attr($term->name); ?>
                                            </button>
                                            <?php if ($query->have_posts()): ?>

                                                <div class="msm-dropdown-cat dropdown-menu w-100 p-0 border-0"
                                                    aria-labelledby="collapse1">
                                                    <div class="px-3 py-2">
                                                        <a class="btn btn-primary w-100 text-white"
                                                            style="font-size: 14px;color: #1ab3ea !important;background: #f1f6f9;border: 0;text-align:left;"
                                                            href="<?php echo esc_url(get_term_link($term)); ?>">
                                                            Ver área <?php echo esc_html($term->name); ?>
                                                        </a>
                                                    </div>
                                                    <?php while ($query->have_posts()):
                                                        $query->the_post(); ?>
                                                        <?php if (get_the_title() == 'Reclamos')
                                                            continue; ?>
                                                        <div class="msm-dropdown-menu-subcat ps-1">
                                                            <a class="fz-14 px-3"
                                                                href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a>
                                                        </div>
                                                    <?php endwhile; ?>
                                                    <?php wp_reset_postdata(); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <a class="msm-menu-link py-2" href="https://online.fliphtml5.com/hxrqr/mdra/"
                        target="_blank">San Miguel en Imágenes</a>
                </div>
                <div class="col-12 d-flex flex-column align-items-center justify-content-center">
                    <a id="collapse-mi-municipio" class="msm-menu-link py-2" data-bs-toggle="collapse"
                        href="#menu-mobile-mi-municipio" role="button" aria-expanded="false"
                        aria-controls="menu-mi-municipio">Gobierno Abierto</a>
                    <div class="collapse multi-collapse bg-white w-100 px-3" id="menu-mobile-mi-municipio">
                        <?php
                        $term_mi_municipio = get_term_by('name', 'Gobierno Abierto', 'area_gobierno');

                        if ($term_mi_municipio):

                            $query_args = array(
                                'post_type' => 'page',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'area_gobierno',
                                        'field' => 'term_id',
                                        'terms' => $term_mi_municipio->term_id,
                                    ),
                                ),
                                'posts_per_page' => -1,
                                'orderby' => 'title',
                                'order' => 'ASC',
                            );

                            $query = new WP_Query($query_args);
                            ?>

                            <div class="row msm-text-black px-0">
                                <div class="col-12 px-0">
                                    <?php while ($query->have_posts()):
                                        $query->the_post(); ?>
                                        <div class="msm-dropdown-menu-subcat ps-1">
                                            <a class="fz-14 px-3"
                                                href="<?php the_permalink() ?>"><?php echo get_the_title(); ?></a>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let body = document.querySelector('body');
            let collapseAreasGob = document.querySelector('#collapse-areas-gob');
            let collapseTramites = document.querySelector('#collapse-tramites');
            let collapseMunicipio = document.querySelector('#collapse-municipio');
            let menuAreasGob = document.querySelector('#menu-areas-gob');
            let menuTramites = document.querySelector('#menu-tramites');
            let menuMunicipio = document.querySelector('#menu-municipio');
            let mainmenuTramites = document.querySelector('#main-menu-tramites');

            collapseTramites.addEventListener('click', function () {
                const rect = collapseTramites.getBoundingClientRect();
                mainmenuTramites.style.top = `${rect.bottom + window.scrollY + 29}px`;
                mainmenuTramites.style.left = `${rect.left + window.scrollX}px`;

                if (menuAreasGob.classList.contains('show')) menuAreasGob.classList.toggle('show');
                if (menuMunicipio.classList.contains('show')) menuMunicipio.classList.toggle('show');
            });

            collapseAreasGob.addEventListener('click', function () {
                if (menuTramites.classList.contains('show')) menuTramites.classList.toggle('show');
                if (menuMunicipio.classList.contains('show')) menuMunicipio.classList.toggle('show');
            });

            body.addEventListener('click', function (event) {
                if (!menuTramites.contains(event.target) && !menuAreasGob.contains(event.target)) {
                    if (menuTramites.classList.contains('show')) menuTramites.classList.toggle('show');
                    if (menuAreasGob.classList.contains('show')) menuAreasGob.classList.toggle('show');
                    if (menuMunicipio.classList.contains('show')) menuMunicipio.classList.toggle('show');
                }
            });

            let iconSearch = document.querySelectorAll('#icon-search');

            iconSearch.forEach(icon => {
                icon.addEventListener('click', toggleSearch)
            });

            function toggleSearch(event) {

                event.preventDefault();

                let formBusqueda = this.previousElementSibling;
                let inputBusqueda = formBusqueda.firstElementChild;

                if ((formBusqueda.style.display === 'none' || formBusqueda.style.display === '') && window.innerWidth >= 768) {
                    formBusqueda.style.display = 'block';
                    inputBusqueda.focus();
                } else {
                    let query = inputBusqueda.value.trim();

                    if (query !== '') {
                        formBusqueda.submit();
                    } else {
                        formBusqueda.style.display = 'none';
                    }
                }
            }
        });

    </script>