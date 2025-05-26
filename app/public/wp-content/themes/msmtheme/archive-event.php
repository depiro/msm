<?php get_template_part(THEME_HEADER); ?>

<img class="d-block w-100" src="<?php bloginfo('template_directory'); ?>/assets/images/banner-eventos.jpg" alt="Banner eventos" style="max-width: 100%;" />
<?php
$args = array(
	'post_type'      => 'event',
	'posts_per_page' => 10,
);
$event_query = new WP_Query($args);

$events = array();

if ($event_query->have_posts()) {
	while ($event_query->have_posts()) {
		$event_query->the_post();

		$event_date = get_post_meta(get_the_ID(), '_event_date', true);
		$event_location = get_post_meta(get_the_ID(), '_event_location', true);
		$event_time = get_post_meta(get_the_ID(), '_event_time', true);

		$events[] = array(
			'title' => get_the_title(),
			'start' => $event_date . 'T' . $event_time,
			'location' => $event_location,
			'url' => get_permalink(),
		);
	}
	wp_reset_postdata();
} else {
	$events = array();
}
?>


<div id="main-content" class="container mb-5">
	<div class="msm-breadcrumb d-block d-sm-row pt-1 small">
		<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last">Eventos</span>
	</div>
	<div class="row my-3 my-md-5 gap-4 px-0">
		

		<div id='calendar'></div>


		<?php if ($event_query->have_posts()) : ?>
			<?php while ($event_query->have_posts()) : $event_query->the_post(); ?>
				<a class="card border-0 text-decoration-none event-card p-0 col-12" style="background-color:#f8f9fb;" href="<?php the_permalink(); ?>">
					<?php
					$event_date = get_post_meta(get_the_ID(), '_event_date', true);
					$event_location = get_post_meta(get_the_ID(), '_event_location', true);
					$event_time = get_post_meta(get_the_ID(), '_event_time', true);
					?>
					<div class="row g-0 d-flex justify-content-between">
						<div class="col-md-3 d-flex justify-content-center">
							<?php if (has_post_thumbnail()): ?>
							<?php
								$thumbnail_id = get_post_thumbnail_id(get_the_ID());
								$thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'full');
								$thumbnail_url = $thumbnail_src[0];
							?>
							<img src="<?php echo $thumbnail_url ?> " class="w-100 d-none d-md-block" alt="...">
							<?php else: ?>
								<div class="p-3">
									<img class="w-100" src=" <?php echo THEME_URI; ?>/assets/images/eventos.svg" alt="">
								</div>
							<?php endif ?>
						</div>
						<div class="col-md-9 px-3 py-2 row align-items-center">
							<div class="col-12 px-2 mt-2">
								<div class="d-flex justify-content-between">
									<h4 class="post-title msm-text-800"><?php the_title(); ?></h4>
									<div class="post-categories">
										<?php
											$categories = get_the_category();
											if ($categories) {
												foreach ($categories as $category) {
													echo '<span class="badge bg-secondary fz-14 fw-400">' . esc_html($category->name) . '</span> ';
												}
											}
										?>
									</div>
								</div>
								<div class="d-flex flex-column align-items-start">
									<span class="msm-text-600 text-end post-date fw-600"><?php echo dayPretty(esc_html($event_date)); ?> <?php echo datePretty(esc_html($event_date)); ?> <?php echo esc_html($event_time); ?></span>
									<span class="msm-text-600 text-end post-time"><?php echo esc_html($event_location); ?></span>
								</div>
							</div>

							<div class="col-12 col-8 d-flex justify-content-start flex-column px-2 py-0">
								<div class="list-post-content msm-text-gray py-0">
									<p><?php the_excerpt(); ?></p>
								</div>
							</div>
						</div>
					</div>
				</a>
			<?php endwhile; ?>

			<?php
			// Paginación
			the_posts_pagination(array(
				'mid_size'  => 2,
				'prev_text' => __('« Anterior', 'textdomain'),
				'next_text' => __('Siguiente »', 'textdomain'),
			));
			?>

		<?php else : ?>
			<div class="empty-info"><?php _e('No hay eventos disponibles.', 'mi-tema'); ?></div>
		<?php endif; ?>

		<?php wp_reset_postdata();
		?>
	</div>
</div>

<?php get_template_part(THEME_FOOTER); ?>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		var calendarEl = document.getElementById('calendar');

		var events = <?php echo json_encode($events); ?>; // Pasar eventos a JS

		var calendar = new FullCalendar.Calendar(calendarEl, {
			theme: 'sandstone',
			aspectRatio: 1.5,
			locale: 'es',
			dayMaxEventRows: 3,
			buttonText: {
				today: 'Hoy',
				month: 'Mes',
				week: 'Semana',
				day: 'Día'
			},
			initialView: 'dayGridMonth',
			events: events
		});

		calendar.render();
		calendar.setOption('aspectRatio', window.innerWidth < 768 ? 1.2 : 1.5);
	});
</script>

<!-- archive event -->