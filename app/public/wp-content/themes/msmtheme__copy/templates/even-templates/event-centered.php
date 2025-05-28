<div class="col-12 col-md-11 col-lg-10">
    <div class="msm-breadcrumb d-block d-sm-row">
        <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/eventos">Eventos /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
    </div>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="post-title" style="color:#1085B9;"><?php the_title(); ?></h1>
        <div class="w-100 row my-2">

            <?php
            $event_date = get_post_meta(get_the_ID(), '_event_date', true);
            $event_location = get_post_meta(get_the_ID(), '_event_location', true);
            $event_time = get_post_meta(get_the_ID(), '_event_time', true);
            ?>
            <div class="col-12 d-flex justify-content-end gap-2 event-alert">
                <h1 class="msm-text-600 text-start"><?php echo dayPretty(esc_html($event_date)); ?></h1>
                <h1 class="msm-text-600 text-start"><?php echo datePretty(esc_html($event_date)); ?></h1>
                <h1 class="msm-text-600 text-start"><?php echo esc_html($event_time); ?></h1>
            </div>

            <div class="col-12  d-flex flex-column gap-2">
                <h3 class="msm-text-gray text-end"><?php echo esc_html($event_location); ?></h3>
            </div>
        </div>
        <h5 class="post-resume"><?php //the_excerpt();
                                ?></h5>
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

<!-- template event centered -->