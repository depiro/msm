<?php
/*
Template Name: Página de Ancho Completo
Template Post Type: event
Description: Esta plantilla muestra una página sin barra lateral y ocupa todo el ancho disponible.
*/
?>
<div class="col-12">
    <div class="msm-breadcrumb d-block d-sm-row">
        <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/eventos">Eventos /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <!-- <h1 class="post-title" style="color:#1085B9;"><?php the_title(); ?></h1> -->
        <div class="w-100 row p-3 my-5" style="border:6px solid #1AB3EA;border: 6px solid #1AB3EA;
            border-top: none;
            border-bottom: none;
            border-right: none;">
            <?php
            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_location = get_post_meta(get_the_ID(), '_event_location', true);
            $event_time = get_post_meta(get_the_ID(), '_event_time', true);
            ?>
            <div class="col-12 d-flex justify-content-end align-items-between msm-text-600 text-start gap-2 flex-column">
                <div class="d-flex row">
                    <div class="col-12 col-md-7" style="font-size:30px !important;font-weight:600">
                        <?php the_title(); ?>
                    </div>
                    <div class="col-12 col-md-5 d-flex justify-content-end flex-column">
                        <div class="d-flex w-100 justify-content-end gap-2">
                            <span style="font-size:50px !important;"><?php echo dayPretty(esc_html($event_date)); ?></span>
                            <span style="font-size:50px !important;"><?php echo datePretty(esc_html($event_date)); ?></span>
                        </div>
                        <div class="d-flex w-100 justify-content-end gap-2" style="color:#7b7b83;">
                            <span class="fz-24"><?php echo esc_html($event_time); ?></span>
                            <span class="fz-24"><?php echo esc_html($event_location); ?></span>
                        </div>
                    </div>
                </div>
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
<!--  template event full width -->