<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
?>

<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/guia-tramites"> Guía de Trámites /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html($current_term->name); ?></span>
		</div>
		<div class="col-12 col-md-3 order-2 order-md-1">
			<h5 class="py-2 msm-text-b-dark">Áreas de trámites</h5>
			<?php

			$terms = get_terms(array(
				'taxonomy' => 'area_tramite',
				'hide_empty' => false,
			));
			?>
			<ul class="msm-submenu ps-0">
				<?php
				if (!empty($terms) && !is_wp_error($terms)) :
					foreach ($terms as $term) :
				?>
						<li class="cat-item"><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_attr($term->name); ?></a></li>
				<?php endforeach;
				endif;
				?>
			</ul>
		</div>
		<div class="order-1 order-md-2 col-12 col-md-9">
			<div class="page-header mb-5 mt-4">
				<?php if ($current_term) : ?>
					<h2 style="font-size: 24px;font-weight: 500;color: #939393;">Trámites</h2>
					<h1 class="page-title"><?php echo esc_html($current_term->name); ?></h1>
					<div class="taxonomy-description fz-16 msm-text-black mt-3" style="text-align:justify"><?php echo wp_kses_post($current_term->description); ?></div>
				<?php endif; ?>
			</div>

			<?php

			$args = array(
				'post_type' => 'tramite',
				'tax_query' => array(
					array(
						'taxonomy' => 'area_tramite',
						'field'    => 'id',
						'terms'    => $current_term->term_id,
					),
				),
				'posts_per_page' => -1, 
				'orderby'           => 'title',
				'order'             => 'ASC',
			);

			$query = new WP_Query($args);
			?>

			<?php if ($query->have_posts()) : ?>
				<div class="page-content fz-16 fw-400 msm-text-gray text-left row">
					<?php while ($query->have_posts()) : $query->the_post(); ?>
						<a href="<?php the_permalink() ?>" class="d-flex flex-column text-decoration-none mt-4">
							<span class="fz-16 fw-600 msm-text-600"><?php the_title(); ?></span>
						</a>
						<?php $excerpt = get_the_excerpt();
						if (trim($excerpt) != ''): ?>
							<span class="fz-14 msm-text-gray" style="text-align:justify"><?php echo $excerpt; ?></span>
						<?php else: ?>
							<span class="fz-14 msm-text-gray">No hay resumen disponible.</span>
						<?php endif; ?>
					<?php endwhile; ?>
				</div>
			<?php else : ?>
				<div class="empty-info"><?php _e('No hay publicaciones disponibles.', 'textdomain'); ?></div>
			<?php endif; ?>

			<?php wp_reset_postdata();?>
		</div>
	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
