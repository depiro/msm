<?php
/**
 * Componente: Panel de Información del Evento
 * Ubicación: templates/parts/event-info-panel.php
 */

$fecha_inicio = get_post_meta(get_the_ID(), 'msm_evento_fecha_inicio', true);
$fecha_fin = get_post_meta(get_the_ID(), 'msm_evento_fecha_fin', true);
$hora_inicio = get_post_meta(get_the_ID(), 'msm_evento_hora_inicio', true);
$hora_fin = get_post_meta(get_the_ID(), 'msm_evento_hora_fin', true);
$lugar = get_post_meta(get_the_ID(), 'msm_evento_lugar', true);

// Si no hay datos relevantes, no mostrar nada
if (empty($fecha_inicio) && empty($lugar)) {
    return;
}

// Helpers par formateo
function msm_format_date_es($date_str)
{
    if (!$date_str)
        return '';
    $timestamp = strtotime($date_str);
    return date_i18n('j \d\e F, Y', $timestamp);
}


$thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'large');

?>
<div class="event-info-panel bg-light border rounded overflow-hidden mb-4">
    <div class="row g-0">

        <?php if ($thumb_url): ?>
            <div class="col-md-5 bg-white d-flex align-items-center justify-content-center" style="min-height: 250px;">
                <img src="<?php echo esc_url($thumb_url); ?>" alt="Evento" class="w-100 h-100" style="object-fit: cover;">
            </div>
        <?php endif; ?>

        <div class="<?php echo $thumb_url ? 'col-md-7' : 'col-12'; ?> p-4 d-flex flex-column justify-content-center">
            <h4 class="mb-3">Información del Evento</h4>

            <ul class="list-unstyled mb-0">

                <?php if ($fecha_inicio): ?>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="dashicons dashicons-calendar-alt me-2 mt-1 text-primary"></span>
                        <div>
                            <strong>Fecha:</strong><br>
                            <?php echo msm_format_date_es($fecha_inicio); ?>
                            <?php if ($fecha_fin): ?>
                                al <?php echo msm_format_date_es($fecha_fin); ?>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if ($hora_inicio): ?>
                    <li class="mb-3 d-flex align-items-start">
                        <span class="dashicons dashicons-clock me-2 mt-1 text-primary"></span>
                        <div>
                            <strong>Hora:</strong><br>
                            <?php echo esc_html($hora_inicio); ?> hs
                            <?php if ($hora_fin): ?>
                                a <?php echo esc_html($hora_fin); ?> hs
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>

                <?php if ($lugar): ?>
                    <li class="d-flex align-items-start">
                        <span class="dashicons dashicons-location me-2 mt-1 text-primary"></span>
                        <div>
                            <strong>Lugar:</strong><br>
                            <?php echo esc_html($lugar); ?>
                        </div>
                    </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</div>