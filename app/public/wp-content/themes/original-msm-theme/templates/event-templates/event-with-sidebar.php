<?php
/*
Template Name: Página con Sidebar
Template Post Type: event
Description: Esta plantilla muestra una página con una barra lateral.
*/
?>
<div class="col-12 col-md-8 col-lg-8 order-1 order-md-2">
    <div class="msm-breadcrumb d-block d-sm-row">
        <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/eventos">Eventos /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="post-title" style="color:#1085B9;"><?php the_title(); ?></h1>
        <div class="w-100 row p-5 py-5 my-5" style="background-color: #EDEBEB !important;border:6px solid #1AB3EA;border: 6px solid #1AB3EA;
            border-top: none;
            border-bottom: none;
            border-right: none;
            border-radius: 22px;">
            <?php
            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_location = get_post_meta(get_the_ID(), '_event_location', true);
            $event_time = get_post_meta(get_the_ID(), '_event_time', true);
            ?>
            <div class="col-12 col-md-6 d-flex justify-content-start flex-column">
                <span class="msm-text-600 text-start" style="font-size:50px !important;"><?php echo dayPretty(esc_html($event_date)); ?></span>
                <span class="msm-text-600 text-start" style="font-size:50px !important;"><?php echo datePretty(esc_html($event_date)); ?></span>
            </div>

            <div class="col-12 col-md-6 d-flex flex-column gap-1">
                <span class="text-end msm-text-600" style="font-size:30px !important;"><?php echo esc_html($event_time); ?></span>
                <span class="text-end msm-text-600" style="font-size:30px !important;"><?php echo esc_html($event_location); ?></span>
            </div>
        </div>
        <h5 class="post-resume"><?php the_excerpt(); ?></h5>
        <div class="my-3">
            <?php
            if (has_post_thumbnail()) {
                $thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
                echo $thumbnail;
            }
            ?>
        </div>
        <div class="post-content">
            <?php the_content(); ?>
        </div>
    </article>
</div>
<div class="col-12 col-md-4 col-lg-4 order-2 order-md-1">
    <?php // get_sidebar();
    ?>
    <div class="menuCul">
        <h4 class="py-2 msm-text-b-dark">SUBMENU</h4>
        <ul>
            <li>
                <a href="#">
                    Centros de salud
                </a>
            </li>
            <li>
                <a href="#">
                    Calendario de vacunación
                </a>
            </li>
            <li>
                <a href="#">
                    Campañas y prevención
                </a>
            </li>
            <li>
                <a href="#">
                    Dirección de discapacidad
                </a>
            </li>
            <li>
                <a href="#">
                    Escuela de enfermería
                </a>
            </li>
            <li>
                <a href="#">
                    Programas de salud
                </a>
            </li>
            <li>
                <a href="#">
                    Teléfonos y direcciones
                </a>
            </li>
            <li>
                <a href="#">
                    Turnos de salud
                </a>
            </li>
            <li>
                <a href="#">
                    Vacunatorios
                </a>
            </li>
        </ul>
    </div>

</div>
<!-- template  event sidebar -->