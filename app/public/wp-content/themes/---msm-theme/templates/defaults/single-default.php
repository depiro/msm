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
<!-- Single Default -->