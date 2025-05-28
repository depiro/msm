<?php

get_template_part(THEME_HEADER); ?>


<div id="main-content" class="container mb-5">
    <div class="row my-3 my-md-5 px-3 justify-content-center">
        <div class="col-12 col-md-11 col-lg-10 px-0">
            <div class="msm-breadcrumb d-block d-sm-row">
                <a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a>
                <a class="msm-breadcrumb-item" href="<?php echo HOME_URI; ?>/licencias-2">Licencias</a>/
                <span class="msm-breadcrumb-item-last">Capacitate</span>
            </div>

            <div class="row p-0 justify-content-center">
                <div class="col-12">
                    <h4 class="msm-text-600">MATERIAL DE ESTUDIO</h4>
                    <p class="rounded msm-text-600">
                        Facilitamos a continuación material de lectura que será de gran utilidad, tanto para el manejo como para la obtención de las licencias de conducir. Deseamos que la información que estamos aportando resulte valiosa.
                    </p>
                </div>
                <div class="col-12 row gap-2">
                    <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Manual-del-Conductor-Particular.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Manual del conductor particular</a>
                    <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MATERIAL-DE-ESTUDIO-D1-D4.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Taxi remis - Vehiculos de emergencia</a>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12 msm-text-600 px-0 mb-1">
                        <span class="fz-14 fw-500 msm-text-gray">Categoria Profesional</span>
                    </div>
                    <div class="col-12 row gap-2">
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MATERIAL-DE-ESTUDIO-D2-D3.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Transporte de personas</a>
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/MATERIAL-DE-ESTUDIO-C3-E1-E2.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Transporte de cargas</a>
                    </div>
                </div>
                <div class="col-12 row mt-3">
                    <div class="col-12 msm-text-600 px-0 mb-1">
                        <span class="fz-14 fw-500 msm-text-gray">Cuatriciclos</span>
                    </div>
                    <div class="col-12 row gap-2">
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Cuatriciclos-Módulo-1.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Módulo 1</a>
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Cuatriciclos-Módulo-2.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Módulo 2</a>
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Cuatriciclos-Módulo-3.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Módulo 3</a>
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Cuatriciclos-Módulo-4.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Módulo 4</a>
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Cuatriciclos-Módulo-5.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Módulo 5</a>
                        <a target="_blank" href="<?php echo home_url('/wp-content/themes/msmtheme/assets/files/Cuatriciclos-Módulo-6.pdf') ?>" class="w-auto p-2 rounded msm-button text-white text-decoration-none">Módulo 6</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php get_template_part(THEME_FOOTER); ?>