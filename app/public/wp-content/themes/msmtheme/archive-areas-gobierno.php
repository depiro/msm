<?php

/*
Template Name: Areas-gobierno
template_name: areas-gobierno
*/
get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
	<div class="row justify-content-center pt-2">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Áreas de Gobierno</span>
		</div>

		<div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1">Áreas de gobierno</h2>
			<p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel</p>
		</div>

		<div class="page-content row">
			<?php get_template_part('templates/parts/areas-cards'); ?>
		</div>
	</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>
<!-- archive areas-gobierno -->