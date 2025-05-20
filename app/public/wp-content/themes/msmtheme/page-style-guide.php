<?php
/**
 * Template Name: Style Guide
 */

 get_template_part(THEME_HEADER);  ?>



<div class="container py-5 style-guide">
    <h1>Guía de Estilos</h1>

    <!-- Tipografía -->
    <section>
        <h2 class="section-title">Tipografía Encabezados</h2>
        
        <div class="mb-4">
            <h1>Encabezado H1</h1>
            <h2>Encabezado H2</h2>
            <h3>Encabezado H3</h3>
            <h4>Encabezado H4</h4>
            <h5>Encabezado H5</h5>
            <h6>Encabezado H6</h6>
        </div>

        <div class="msm-breadcrumb d-block d-sm-row">
            <a class="msm-breadcrumb-item-first" href="http://msm-dev.local">Home /</a><a class="msm-breadcrumb-item" href="http://msm-dev.local/prensa"> Prensa /</a><span class="msm-breadcrumb msm-breadcrumb-item-last">Ojos en Alerta llegó a un nuevo municipio de Córdoba</span>
        </div>
        
        <h1 class="post-title">Ojos en Alerta llegó a un nuevo municipio de Córdoba</h1>

        <h5 class="post-resume">
            <p>Ya hay 44 distritos en 9 provincias del país adheridos a esta herramienta de seguridad originada en San Miguel. El intendente de San Miguel, Jaime Méndez, firmó ayer un convenio con el jefe comunal de Sampacho (Córdoba), Franco Suárez, para implementar Ojos en Alerta en su distrito. Se trata de un programa originado en San […]</p>
        </h5>
        <div class="post-content">
            <p>Este es un párrafo de texto normal. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            <p>Este es otro párrafo de texto. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
        </div>
    </section>

    <!-- Botones -->
    <section>
        <h2 class="section-title">Botones</h2>
        
        <div class="button-group">
            <h3>Botones 'msm-button'</h3>
            <button class="msm-button">Botón Primario</button>
            <button class="msm-button" disabled>Botón Deshabilitado</button>
        </div>
        
        <div class="button-group">
            <h3>Botones de Acción msm</h3>
            <button class="btn-licencias">Botón de Acción</button>
            <button class="btn-capacitate-download">Botón de Descarga</button>
        </div>
        <div class="button-group">
            <h3>Bootstrap buttons</h3>
            <button type="button" class="btn btn-primary">Primary</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button class="btn btn-outline-primary">Outlined</button>
            <button class="btn btn-outlimed-primary" disabled>Outlined Deshabilitado</button>
        </div>

        <div class="button-group">
            <h4>Bootstrap buttons 'sm'</h4>
            <button type="button" class="btn btn-primary btn-sm">Primary</button>
            <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
            <button class="btn btn-outline-primary btn-sm">Outlined</button>
            <button class="btn btn-outlimed-primary btn-sm" disabled>Deshabilitado</button>
        </div>


    </section>

    <!-- Colores -->
    <section>
        <h2 class="section-title">Colores Bootstrap</h2>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-primary);">
                    <h5 class="color-text">Primary</h5>
                    <p class="color-hex">#3dbfee</p>
                    <p class="color-var">--bs-primary</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-secondary);">
                    <h5 class="color-text">Secondary</h5>
                    <p class="color-hex">#1a85ac</p>
                    <p class="color-var">--bs-secondary</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-success);">
                    <h5 class="color-text">Success</h5>
                    <p class="color-hex">#198754</p>
                    <p class="color-var">--bs-success</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-info);">
                    <h5 class="color-text">Info</h5>
                    <p class="color-hex">#0dcaf0</p>
                    <p class="color-var">--bs-info</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-warning);">
                    <h5 class="color-text light-text">Warning</h5>
                    <p class="color-hex light-text">#ffc107</p>
                    <p class="color-var light-text">--bs-warning</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-danger);">
                    <h5 class="color-text">Danger</h5>
                    <p class="color-hex">#dc3545</p>
                    <p class="color-var">--bs-danger</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--bs-light);">
                    <h5 class="color-text">Light</h5>
                    <p class="color-hex">#f8f9fa</p>
                    <p class="color-var">--bs-light</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--bs-dark);">
                    <h5 class="color-text">Dark</h5>
                    <p class="color-hex">#212529</p>
                    <p class="color-var">--bs-dark</p>
                </div>
            </div>
        </div>

        <h2 class="section-title">MSM Colores</h2>
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue);">
                    <h5 class="color-text">MSM Blue</h5>
                    <p class="color-hex">#3dbfee</p>
                    <p class="color-var">--msm-blue</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-v2);">
                    <h5 class="color-text">MSM Blue v2</h5>
                    <p class="color-hex">#1a85ac</p>
                    <p class="color-var">--msm-blue-v2</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-v3);">
                    <h5 class="color-text">MSM Blue v3</h5>
                    <p class="color-hex">#5d6988</p>
                    <p class="color-var">--msm-blue-v3</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-v4);">
                    <h5 class="color-text">MSM Blue v4</h5>
                    <p class="color-hex">#364262</p>
                    <p class="color-var">--msm-blue-v4</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-blue-light);">
                    <h5 class="color-text">MSM Blue Light</h5>
                    <p class="color-hex">#6fcbed</p>
                    <p class="color-var">--msm-blue-light</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-gray);">
                    <h5 class="color-text">MSM Gray</h5>
                    <p class="color-hex">#717075</p>
                    <p class="color-var">--msm-gray</p>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="color-card" style="background-color: var(--msm-black);">
                    <h5 class="color-text">MSM Black</h5>
                    <p class="color-hex">#575756</p>
                    <p class="color-var">--msm-black</p>
                </div>
            </div>
        </div>

        <h2 class="section-title">MSM Blue Scale</h2>
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--blue-msm-50);">
                    <h5 class="color-text">Blue MSM 50</h5>
                    <p class="color-hex">#e2f3fc</p>
                    <p class="color-var">--blue-msm-50</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--blue-msm-100);">
                    <h5 class="color-text">Blue MSM 100</h5>
                    <p class="color-hex">#bfe6f8</p>
                    <p class="color-var">--blue-msm-100</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card light-text" style="background-color: var(--blue-msm-200);">
                    <h5 class="color-text">Blue MSM 200</h5>
                    <p class="color-hex">#86d4f3</p>
                    <p class="color-var">--blue-msm-200</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-300);">
                    <h5 class="color-text">Blue MSM 300</h5>
                    <p class="color-hex">#35b7e8</p>
                    <p class="color-var">--blue-msm-300</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-400);">
                    <h5 class="color-text">Blue MSM 400</h5>
                    <p class="color-hex">#1ea5d9</p>
                    <p class="color-var">--blue-msm-400</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-500);">
                    <h5 class="color-text">Blue MSM 500</h5>
                    <p class="color-hex">#1085b9</p>
                    <p class="color-var">--blue-msm-500</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-600);">
                    <h5 class="color-text">Blue MSM 600</h5>
                    <p class="color-hex">#0f6a95</p>
                    <p class="color-var">--blue-msm-600</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-700);">
                    <h5 class="color-text">Blue MSM 700</h5>
                    <p class="color-hex">#105a7c</p>
                    <p class="color-var">--blue-msm-700</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-800);">
                    <h5 class="color-text">Blue MSM 800</h5>
                    <p class="color-hex">#134b67</p>
                    <p class="color-var">--blue-msm-800</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-900);">
                    <h5 class="color-text">Blue MSM 900</h5>
                    <p class="color-hex">#0d3044</p>
                    <p class="color-var">--blue-msm-900</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="color-card" style="background-color: var(--blue-msm-950);">
                    <h5 class="color-text">Blue MSM 950</h5>
                    <p class="color-hex">#0a1d2c</p>
                    <p class="color-var">--blue-msm-950</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Enlaces -->
    <section>
        <h2 class="section-title">Links</h2>
        <div class="link-group">
            <a href="#">Link Normal</a>
            <a href="#" style="color: var(--blue-msm-400);">Link Azul</a>
            <a href="#" style="color: var(--msm-gray);">Link Gris</a>
        </div>
    </section>
</div>

<?php get_footer(); ?> 