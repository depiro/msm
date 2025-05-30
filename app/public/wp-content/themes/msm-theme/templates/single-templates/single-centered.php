<?php
/*
Template Name: Entrada Centrada
Template Post Type: post
Description: Esta plantilla muestra una entrada individual sin barra lateral y centrada.
*/
?>
<div class="row justify-content-center">
    <div class="msm-breadcrumb d-block d-sm-row pt-1 small">
        <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/prensa"> Prensa /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html(the_title()); ?></span>
    </div>
</div>

<div class="row my-3 my-md-5 px-3 justify-content-center">

    <div class="row">
        <!-- <div class="col-10">
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
            <h1 class="post-title"><?php the_title(); ?></h1>
            <h5 class="post-resume"><?php the_excerpt(); ?></h5>
        </div> -->
    </div>
    
    <div class="row justify-content-center">
       
            <div class="col-10">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h1 class="post-title"><?php the_title(); ?></h1>
                <!-- <h5 class="post-resume"><?php the_excerpt(); ?></h5> -->
            </div>


            <div class="col-10">
                <!-- <div class="post-meta d-flex justify-content-end my-3">
                    <span class="post-date me-2 msm-text-gray"><?php the_time('F j, Y'); ?></span>
                    <span class="post-author msm-text-gray"> por <?php the_author(); ?></span>
                </div> -->

                <div class="my-3">
                    <?php
                    if (has_post_thumbnail()) {
                        $thumbnail = get_the_post_thumbnail(get_the_ID(), 'full');
                        // echo $thumbnail;
                    }
                    ?>
                </div>
                <div class="post-content">
                    <?php the_content(); ?>
                </div>
                </article>
            </div>

</div>
</div>
<!--  template Single centered -->