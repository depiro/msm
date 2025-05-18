<?php

$args = array(
	'post_type' => 'post',
	'showposts' => 4,
	'orderby'   => 'date',
	'order'     => 'DESC',
);

$query = new WP_Query($args);
$fecha = null;
if ($query->have_posts()) $fecha = date_formated($post);
?>


<div id="carousel-home" class="carousel slide d-block d-md-none" data-bs-ride="carousel">
	<div class="carousel-inner">
		<?php
		// Verifica si hay posts que coincidan con la consulta
		if ($query->have_posts()) :
			$index = 0;
			// Inicia el Loop
			while ($query->have_posts()) : $query->the_post(); ?>
				<?php
				if (has_post_thumbnail()) {
					$thumbnail_id = get_post_thumbnail_id();
					$thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
				}
				?>
				<div class="p-3 carousel-item <?php $index == 0 ? print('active') : print("") ?>">
					<div class="card msm-report-card">
						<div class="image-container">
							<img src="<?php echo $thumbnail_url ?>" class="card-img-top" alt="...">
						</div>
						<div class="card-body">
							<div class="d-flex justify-content-between">
								<!-- <span style="background-color:#9D9D9C" class="text-white px-2 py-1 rounded">OBRAS</span> -->
								<span class="msm-text-gray fz-16"><?php echo $fecha ?></span>
							</div>
							<div class="text-container">
								<p class="card-text msm-text-dark fw-500" style="height:180px"> <?php short_description();  ?></p>
							</div>
							<div class="d-flex justify-content-end p-3 w-100">
								<a href="<?php the_permalink(); ?>" class="w-100 d-flex justify-content-end">
									<img src="<?php echo THEME_URI; ?>/assets/images/right-arrow.svg" alt="...">
								</a>
							</div>
						</div>
					</div>
				</div>
		<?php $index++;
			endwhile;

			// Resetea los datos del post
			wp_reset_postdata();

		endif;
		?>
	</div>
	<button class="carousel-control-prev" type="button" data-bs-target="#carousel-home" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#carousel-home" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>

<div class="row d-none d-md-flex">
	<?php
	// Verifica si hay posts que coincidan con la consulta
	if ($query->have_posts()) :

		// Inicia el Loop
		while ($query->have_posts()) : $query->the_post(); ?>
			<?php
			if (has_post_thumbnail()) {
				$thumbnail_id = get_post_thumbnail_id();
				$thumbnail_url = wp_get_attachment_image_url($thumbnail_id, 'full');
			}
			?>
			<div class="p-3 col-12 col-md-6 col-lg-4 col-xl-3">
				<div class="card msm-report-card">
					<div class="image-container">
						<img src="<?php echo $thumbnail_url ?>" class="card-img-top" alt="...">
					</div>
					<div class="card-body">
						<div class="d-flex justify-content-between">
							<!-- <span style="background-color:#9D9D9C" class="text-white px-2 py-1 rounded">OBRAS</span> -->
							<span class="msm-text-gray fz-16"><?php echo $fecha ?></span>
						</div>
						<div class="text-container">
							<p class="card-text msm-text-dark fw-500" style="height:180px"> <?php short_description();  ?></p>
						</div>
						<div class="d-flex justify-content-end p-3 w-100">
							<a href="<?php the_permalink(); ?>" class="w-100 d-flex justify-content-end">
								<img src="<?php echo THEME_URI; ?>/assets/images/right-arrow.svg" alt="...">
							</a>
						</div>
					</div>
				</div>
			</div>
	<?php endwhile;

		// Resetea los datos del post
		wp_reset_postdata();

	endif;
	?>
</div>