<?php
/*
 * Template Name: Trámite Estilo Página (Con bloques)
 * Template Post Type: tramite
 */

get_template_part(THEME_HEADER); ?>

<?php if (have_posts()):
	while (have_posts()):
		the_post(); ?>

		<div id="main-content" class="container mb-5">
			<div class="msm-breadcrumb d-block d-sm-row px-0 pt-1 small">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home</a>/
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/guia-tramites">Guía de Trámites</a>/
				<?php
				// Obtener el área del trámite
				$terms = get_the_terms(get_the_ID(), 'area_tramite');
				if ($terms && !is_wp_error($terms)):
					$term = array_shift($terms);
					?>
					<a class="msm-breadcrumb-item" href="<?php echo get_term_link($term); ?>">
						<?php echo esc_html($term->name); ?>
					</a>/
				<?php endif; ?>
				<span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
			</div>

			<div class="row my-3 my-md-5 justify-content-center">
				<div class="col-12 py-5 mb-4">
					<h2 class="msm-font-xl mb-1"><?php the_title(); ?></h2>
					<?php if (has_excerpt()): ?>
						<p class="fz-18"><?php echo get_the_excerpt(); ?></p>
					<?php endif; ?>
				</div>

				<div class="col-12 mb-4">
                    <div class="page-content">
                        <?php the_content(); ?>
                    </div>
				</div>
			</div>
		</div>

	<?php endwhile;
else: ?>
	<div id="main-content" class="container mb-5">
		<div class="empty-info"><?php _e('No se encontró la publicación.', 'mi-tema'); ?></div>
	</div>
<?php endif; ?>

<?php get_template_part('templates/parts/encuesta_utilidad'); ?>
<?php get_template_part(THEME_FOOTER); ?>
