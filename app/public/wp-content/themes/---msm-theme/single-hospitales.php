<?php get_template_part(THEME_HEADER); ?>
<?php if (have_posts()):
	while (have_posts()):
		the_post(); ?>

		<div id="main-content" class="container mb-5">
			<div class="msm-breadcrumb d-block d-sm-row px-0 pt-1 small">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home</a>/
				<a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/hospitales">Hospitales</a>/
				<span class="msm-breadcrumb msm-breadcrumb-item-last"><?php the_title(); ?></span>
			</div>
			<div class="row my-3 my-md-5 px-3 justify-content-center px-0">
				<div class="col-12 col-md-10 col-lg-8">
					<div class="col-12 mb-4">
						<div class="row page-title mb-3">
							<span class="fw-600 msm-text-600 fz-24"><?php the_title(); ?></span>
						</div>
						<div class="page-content fz-16 fw-400 msm-text-gray row px-0 pe-md-4">
							<div class="row hospital-details">
								<?php
								$ubicacion = get_post_meta(get_the_ID(), 'ubicacion', true);
								$direccion = get_post_meta(get_the_ID(), 'direccion', true);
								$localidad = get_post_meta(get_the_ID(), 'localidad', true);
								$telefono = get_post_meta(get_the_ID(), 'telefono', true);
								$horario_apertura = get_post_meta(get_the_ID(), 'horario_apertura', true);
								$horario_cierre = get_post_meta(get_the_ID(), 'horario_cierre', true);
								$especialidades = get_post_meta(get_the_ID(), 'especialidades', false);
								$atiende_24hs = get_post_meta(get_the_ID(), 'atiende_24hs', true);
								?>

								<div class="d-flex gap-3 mt-3 mb-4">
									<?php
									if (!empty($especialidades) && isset($especialidades[0]) && is_array($especialidades[0])) {
										foreach ($especialidades[0] as $especialidad) { ?>
											<span
												class="fz-14 msm-bg-300 text-white rounded px-2 py-1"><?php echo esc_html($especialidad) ?></span>
										<?php }
									}
									?>
								</div>

								<div class="content mt-2">
									<h3 class="fz-20 py-0 fw-600">Descripción</h3>
									<?php
									if (get_the_content()) {
										the_content();
									} else {
										echo '<p>-</p>';
									}
									?>
								</div>

								<div class="col-12 col-md-6 mt-4">
									<img src="<?php echo THEME_URI; ?>/assets/images/location.svg" height="35">
									<span class="fz-14 msm-text-black"><?php echo esc_html($direccion); ?></span>
								</div>
								<div class="col-12 col-md-6 mt-2">
									<img src="<?php echo THEME_URI; ?>/assets/images/phone.svg" height="35">
									<span class="fz-14 msm-text-black"><?php echo esc_html($telefono); ?></span>
								</div>
								<div class="col-12 col-md-6 mt-2 d-flex gap-2">
									<img src="<?php echo THEME_URI; ?>/assets/images/clock.svg" height="35">
									<div class="d-flex justify-content-center align-items-center gap-1">
										<span class="fz-14 msm-text-black"><?php echo esc_html($horario_apertura); ?></span> -
										<span class="fz-14 msm-text-black"><?php echo esc_html($horario_cierre); ?></span>
									</div>
								</div>
							</div>
						</div>

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
<!-- single tramite -->