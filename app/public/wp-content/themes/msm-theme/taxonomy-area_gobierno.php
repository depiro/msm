<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
$term_id = get_queried_object()->term_id;
$image_url = get_term_meta($term_id, 'banner_image', true);
?>


<div id="main-content" class="container mb-5">
	<div class="d-flex flex-column flex-md-row msm-breadcrumb pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item"
			href="<?php echo HOME_URI; ?>/areas-gobierno">Áreas de Gobierno /</a><span
			class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html($current_term->name); ?></span>
	</div>

	<div class="row my-3 ">
		<div class="col-12 py-5">
			<?php if ($current_term): ?>
			<h2 class="msm-font-xl mb-1"><?php echo esc_html($current_term->name); ?></h2>
			<p class="fz-18"><?php echo wp_kses_post($current_term->description); ?></p>
			<?php endif; ?>
		</div>

		<div class="row">
			<div class="col-12">

			<?php if (have_posts()): ?>

				<div class="row">
					<?php while (have_posts()): the_post(); ?>
						<?php
							$height = '180px';
							$variant = 2;
							$title = get_the_title();
							$desc = wp_trim_words(get_the_excerpt(), 20, '...');
							$link = get_permalink();

							include get_template_directory() . '/templates/parts/card-base.php';
						?>
					<?php endwhile; ?>
				</div>

				<div style="display:flex;justify-content:end;">
					<?php
					the_posts_navigation(array(
						'next_text' => '« Anterior',
						'prev_text' => 'Siguiente »',
					));
					?>
				</div>

			<?php else: ?>

				<div class="empty-info"><?php _e('No hay publicaciones disponibles.', 'textdomain'); ?></div>

			<?php endif; ?>
		</div>
		</div>

		<div class="row d-flex justify-content-center py-3">
			<div class="col-12 py-5">
				<?php
					set_query_var('banner_consultas', [
					'title' => 'Iniciá tus pedidos o consultas',
					'button_text' => 'Iniciar consultas',
					'button_url' => '/consultas',
					'image' => get_template_directory_uri() . '/assets/images/banner_2_blanca.png'
					]);
					get_template_part('templates/parts/banner-grande');
				?>
			</div>
		</div>

            <!-- NOTICIAS INICIO -->
            <div class="row d-flex justify-content-center">
                <h3 class="text-center mt-3">Últimas novedades</h3>
                <div class="page-content row">
                    <?php get_template_part(THEME_NEWS); ?>
                </div>
            </div>
            <!-- NOTICIAS FIN -->
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>
<!-- taxonomy area gobierno -->