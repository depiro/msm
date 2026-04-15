<div class="d-flex flex-column flex-md-row msm-breadcrumb">
	<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home / </a>
	<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/areas-gobierno"> Áreas de gobierno /</a>
	<?php
	// Obtener el área del trámite
	$terms = get_the_terms(get_the_ID(), 'area_gobierno');
	if ($terms && !is_wp_error($terms)) :
		$term = array_shift($terms); // Tomar el primer término si hay varios
	?>
		<a class="msm-breadcrumb-item" href="<?php echo get_term_link($term); ?>">
			<?php echo esc_html($term->name); ?>
			/ </a>
	<?php endif; ?>
	<span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
</div>
<div class="col-12">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<h1 class="post-title"><?php the_title(); ?></h1>
		<h5 class="post-resume"><?php the_excerpt(); ?></h5>
		<div class="post-meta d-flex justify-content-end my-3">
			<span class="post-date me-2 msm-text-gray fz-14"><?php the_time('F j, Y'); ?></span>
			<span class="post-author msm-text-gray fz-14"> por <?php the_author(); ?></span>
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