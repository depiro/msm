<?php get_template_part(THEME_HEADER); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div id="main-content" class="container mb-5">
			<div class="row my-3 my-md-5 px-3 justify-content-center">
				<div class="col-12 col-md-11 col-lg-10">
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="post-title"><?php the_title(); ?></h1>
						<div class="post-content">
							<?php the_content(); ?>
						</div>
					</article>
				</div>
			</div>
		</div>
	<?php endwhile;
else : ?>
	<div id="main-content" class="container mb-5">
		<div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
	</div>
<?php endif; ?>

<!-- template page centered -->
<?php get_template_part(THEME_FOOTER); ?>