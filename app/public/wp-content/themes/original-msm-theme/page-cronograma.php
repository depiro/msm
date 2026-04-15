<?php
/* Template Name: Cronograma */

get_template_part(THEME_HEADER); ?>

<div id="main-content" class="container mb-5">
    <div class="row my-3 my-md-5 gap-4 px-0">

        <div class="msm-breadcrumb d-block d-sm-row">
            <?php
                $current_page_id = get_queried_object_id();
                $current_page_url = get_permalink($current_page_id);
            ?>
            <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
            <a class="msm-breadcrumb-item px-0" href="<?php echo esc_url($current_page_url); ?>">
                <?php echo esc_html(get_the_title($current_page_id)); ?> /
            </a>
            <span class="msm-breadcrumb msm-breadcrumb-item-last">Cronograma</span>
        </div>

        <?php
            $args = array(
                'post_type' => 'cronograma',
                'meta_query' => array(
                    array(
                        'key' => '_pagina_superior',
                        'value' => $current_page_id,
                        'compare' => '='
                    )
                ),
                'meta_key' => 'fecha_desde',
                'orderby' => 'meta_value',
                'order' => 'ASC'
            );
            
            $cronogramas = new WP_Query($args);

            $grouped_cronogramas = [];

            if ($cronogramas->have_posts()) {
                while ($cronogramas->have_posts()) {
                    $cronogramas->the_post();
                    $title = get_the_title();
                    $fecha_desde = get_post_meta(get_the_ID(), 'fecha_desde', true);
                    $fecha_hasta = get_post_meta(get_the_ID(), 'fecha_hasta', true);

                    if (!isset($grouped_cronogramas[$title])) {
                        $grouped_cronogramas[$title] = [];
                    }

                    $grouped_cronogramas[$title][] = [
                        'fecha_desde' => $fecha_desde,
                        'fecha_hasta' => $fecha_hasta,
                        'barrio' => get_post_meta(get_the_ID(), 'barrio', true),
                        'lugar' => get_post_meta(get_the_ID(), 'lugar', true),
                        'domicilio' => get_post_meta(get_the_ID(), 'domicilio', true),
                        'observaciones' => get_post_meta(get_the_ID(), 'observaciones', true),
                    ];
                }
				

                foreach ($grouped_cronogramas as $title => $items) { ?>
                    <div class="row border-bottom pb-3">
						<div class="col-12 col-md-3  flex-md-column flex-row row gap-2">
							<?php foreach ($items as $item) { ?>
								<span class="col-auto px-2 py-1 msm-bg-50 msm-text-600 fw-600 rounded fz-14" style="width:fit-content;"><?php echo esc_html($item['fecha_desde']) . ' - ' . esc_html($item['fecha_hasta']) ?></span>
							<?php } ?>
						</div>
						<div class="col-12 col-md-9 d-flex gap-4">
							<div class="d-flex flex-column">
								<span class="msm-text-gray fw-400 fz-12">Barrio</span>
								<span class="msm-text-600 fw-600 fz-14"> <?php echo $items[0]['barrio'] ?></span>
							</div>
							<div class="d-flex flex-column">
								<span class="msm-text-gray fw-400 fz-12">Dirección</span>
								<div class="d-flex">
									<span class="msm-text-600 fw-600 fz-14"> <?php echo $items[0]['lugar'] ?></span>
									<span class="msm-text-600 fw-600 fz-14"> <?php echo $items[0]['domicilio'] ?></span>
								</div>
							</div>
						</div>
					</div>
               <?php }
            } else {
                echo '<p>No hay cronogramas disponibles.</p>';
            }

            wp_reset_postdata();
        ?>
    </div>
</div>

<?php
get_template_part(THEME_FOOTER);
