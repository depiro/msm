<?php get_template_part(THEME_HEADER); ?>
<?php
// Obtener el término actual
$current_term = get_queried_object();
?>

<div id="main-content" class="container mb-5">
	<div class="msm-breadcrumb d-block d-sm-row pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/guia-tramites"> Guía de Trámites /</a><span class="msm-breadcrumb msm-breadcrumb-item-last"><?php echo esc_html($current_term->name); ?></span>
	</div>
	
	<div class="row justify-content-center">
		<div class="col-12 py-5">
			<div class="page-header mb-5 mt-4">
				<?php if ($current_term) : ?>
					<h4>Trámites</h4>
					<h2 class="page-title msm-font-xl mb-1"><?php echo esc_html($current_term->name); ?></h2>
					<div class="taxonomy-description">
						<p class="fz-18"><?php echo wp_kses_post($current_term->description); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>

		<div class="col-12">
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
  <div class="row">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
      <?php
        $title = get_the_title();
        $desc = wp_trim_words(get_the_excerpt(), 20, '...');
        $link = get_permalink();
        $variant = 1;
        $height = '110px';

        include get_template_directory() . '/templates/parts/card-base.php';
      ?>
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
