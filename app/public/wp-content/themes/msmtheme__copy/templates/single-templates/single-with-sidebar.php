<?php
/*
Template Name: Entrada con Sidebar
Template Post Type: post
Description: Esta plantilla muestra una entrada individual con una barra lateral.
*/
?>
<div class="msm-breadcrumb d-block d-sm-row">
    <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/prensa"> Prensa /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html(the_title()); ?></span>
</div>

<div class="col-12 col-md-9 ">
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h1 class="post-title"><?php the_title(); ?></h1>
        <h5 class="post-resume"><?php the_excerpt(); ?></h5>
        <div class="post-meta d-flex justify-content-end my-3">
            <span class="post-date me-2 msm-text-gray"><?php the_time('F j, Y'); ?></span>
            <span class="post-author msm-text-gray"> por <?php the_author(); ?></span>
        </div>
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
<div class="col-12 col-md-3">

</div>
<!--  template Single with sidebar -->