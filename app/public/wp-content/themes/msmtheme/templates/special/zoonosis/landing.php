<?php

get_template_part(THEME_HEADER); ?>

<?php

$args = array(
	'post_type'      => 'post',
	'posts_per_page' => 10,
);
$event_query = new WP_Query($args);
?>

<div id="main-content" class="container mb-5">
	<div class="row my-3 my-md-5 px-3 justify-content-center">
		<div class="col-12 col-md-11 col-lg-10 px-0">
			<div class="msm-breadcrumb d-block d-sm-row px-0">
				<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last">Zoonosis</span>
			</div>

		</div>

	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>