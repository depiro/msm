<?php
$args = array(
	'post_type' => 'botonera',
	'posts_per_page' => 1,
);
$query = new WP_Query($args);

if ($query->have_posts()) :
	while ($query->have_posts()) :
		$query->the_post();

		$buttons = get_post_meta(get_the_ID(), '_buttons', true);

		if ($buttons && is_array($buttons)) : ?>

			<?php foreach ($buttons as $button) : ?>
				<?php
				$url = home_url($button['url']);
				if (str_contains($button['url'], 'https://') || str_contains($button['url'], 'http://')) {
					$url = $button['url'];
				}
				?>
				<?php if($button['text']): ?>
					<div class="col-6 col-md-4 col-lg-2 p-2">
						<a href="<?php echo esc_html($url); ?>" class="align-items-center text-decoration-none home-link p-3 rounded rounded-4 text-white justify-content-center d-flex flex-column" style="background-color: <?php echo esc_attr($button['color']); ?>">
							<img style="width: 70px !important;height: auto !important;" src="<?php echo esc_url($button['icon']); ?>" height="50">
							<span class="text-center fz-12"><?php echo esc_html($button['text']); ?></span>
						</a>
					</div>
				<?endif;?>
			<?php endforeach; ?>
	<?php
		endif;
	endwhile;

	wp_reset_postdata();
	?>
<?php
endif;
?>