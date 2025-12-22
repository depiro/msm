<?php
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
    <div class="msm-breadcrumb d-block d-sm-row pt-1 small">
        <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span
            class="msm-breadcrumb-item-last"> Eventos Municipales</span>
    </div>
    <div class="row justify-content-center pt-2">

        <div class="col-12 py-5">
            <h2 class="msm-font-xl mb-1">Eventos Municipales</h2>
            <p class="fz-18">Enterate de todas las actividades y eventos programados.</p>
        </div>

        <div class="page-content row ">
            <?php if (have_posts()): ?>
                <?php
                // Clean up variables to prevent scope pollution
                unset($title, $link, $thumb_url, $tags);

                while (have_posts()):
                    the_post();
                    include get_template_directory() . '/templates/parts/card-event.php';
                endwhile; ?>

                <div class="col-12 mt-4">
                    <?php the_posts_pagination(); ?>
                </div>

            <?php else: ?>
                <span class="fz-24 empty-info mt-3">
                    No hay eventos programados en este momento.
                </span>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_template_part(THEME_FOOTER); ?>
<!-- archive evento_municipal -->