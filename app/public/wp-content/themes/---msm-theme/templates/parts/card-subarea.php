<?php
/**
 * Componente: Card Sub-Area (Subsecretarías / Direcciones)
 * Ubicación: templates/parts/card-subarea.php
 * 
 * Variables esperadas:
 * $title : Título del área
 * $link  : Enlace al área
 */

$title = $title ?? get_the_title();
$link = $link ?? get_permalink();
?>

<div class="col-auto">
    <a href="<?php echo esc_url($link); ?>" class="text-decoration-none text-dark">
        <div class="card h-100 border-0 shadow-sm rounded overflow-hidden d-flex flex-row align-items-stretch"
            style="min-height: 60px;">

            <!-- Barras Decorativas -->
            <div style="width: 15px; background-color: #29abe2;"></div>
            <div style="width: 15px; background-color: #d9eff9;"></div>

            <!-- Contenido -->
            <div class="card-body d-flex align-items-center p-3">
                <h6 class="mb-0"><?php echo esc_html($title); ?></h6>
            </div>

        </div>
    </a>
</div>