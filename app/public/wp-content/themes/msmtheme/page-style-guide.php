<?php
/**
 * Template Name: Style Guide
 */

 get_template_part(THEME_HEADER);  ?>

<div class="container style-guide">
    <div class="row my-2  justify-content-center">
		<div class="msm-breadcrumb d-block d-sm-row">
			<a class="msm-breadcrumb-item-first" href="<?php echo HOME_URI; ?>">Home /</a><span class="msm-breadcrumb-item-last"> Guía de Estilos</span>
		</div>
    </div>
    <!-- <h1>Guía de Estilos</h1> -->
    <div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1">Guía de Estilos</h2>
			<p class="fz-18">Guía UI y de componentes para tema de Wordpress 'Msmtheme' </p>
		</div>    

    <!-- Tipografía -->
    <section>
        <h2 class="section-title">Tipografía</h2>
        <p>Escala tipográfica 'Minor third'.</p>
        
        <div class="mb-4">
            <h1>Encabezado H1</h1>
            <h2>Encabezado H2</h2>
            <h3>Encabezado H3</h3>
            <h4>Encabezado H4</h4>
            <h5>Encabezado H5</h5>
            <h6>Encabezado H6</h6>
            <p>Párrafo p</p>
            <p class=text-muted>Párrafo p - muted</p>
            <caption>Texto de caption</caption>
        </div>
    </section>

    <section>
        <h2 class="section-title">Breadcrumb</h2>
        <div class="msm-breadcrumb d-block d-sm-row">
            <a class="msm-breadcrumb-item-first" href="http://msm-dev.local">Home /</a><a class="msm-breadcrumb-item" href="http://msm-dev.local/prensa"> Prensa /</a><span class="msm-breadcrumb msm-breadcrumb-item-last">Ojos en Alerta llegó a un nuevo municipio de Córdoba</span>
        </div>
    </section>

    <section>
    <h2 class="section-title">Encabezados de contenidos 'Noticias'</h2>
        <h1 class="post-title">Ojos en Alerta llegó a un nuevo municipio de Córdoba</h1>

        <h5 class="post-resume">
            <p>Ya hay 44 distritos en 9 provincias del país adheridos a esta herramienta de seguridad originada en San Miguel. El intendente de San Miguel, Jaime Méndez, firmó ayer un convenio con el jefe comunal de Sampacho (Córdoba), Franco Suárez, para implementar Ojos en Alerta en su distrito. Se trata de un programa originado en San […]</p>
        </h5>
        <div class="post-content">
            <p>Una mujer de 52 años con un tumor benigno en el estómago se realizó una importante cirugía con intervenciones mínimas en el Hospital Larcade de San Miguel. A través de esta operación, realizada por un abordaje mixto laparoscópico-endoscópico, se resecó por completo el tumor, evitando una gastrectomía total (resección completa del estómago). Gracias a este procedimiento, se logró evitar complicaciones luego de la cirugía, disminuir el dolor post-operatorio y tener una recuperación mucho más rápida. La paciente tuvo una internación de 24 horas.</p>
            <p>Es la primera intervención de este tipo realizada en el Hospital Larcade. La misma estuvo a cargo del cirujano especialista en cirugía esofogástrica Ignacio Fuente, asistido por los médicos Florencia Ramos, Pilar García Carrillo y Camilo Gómez.</p>
        </div>
    </section> 

    <h2 class="section-title">Encabezados de Páginas</h2>
        <div class="col-12 py-5">
			<h2 class="msm-font-xl mb-1">Áreas de gobierno</h2>
			<p class="fz-18">Conocé cada una de las áreas que conforman la Municipalidad de San Miguel</p>
		</div>

    <!-- Banners -->
    <section>
        <h2 class="section-title">Banners</h2>

        <?php
        set_query_var('banner_consultas', [
        'title' => 'Iniciá tus pedidos o consultas',
        'button_text' => 'Iniciar consultas',
        'button_url' => '/consultas',
        'image' => get_template_directory_uri() . '/assets/images/consultas-ilustracion.svg'
        ]);
        get_template_part('templates/parts/banner-grande');
        ?>


<div class="row d-flex justify-content-center px-3  mb-4">
    <h3 class="text-center mb-0">¡Sumate!</h3>
    
    <div class="row gy-3">
        <!-- Banner 1: Débito automático -->
        <div class="col-12 col-md-6">
            <a href="#" class="d-flex align-items-center justify-content-between py-5 px-4 rounded-3 shadow text-decoration-none banner-card bg-white">
            <div class="d-flex align-items-center gap-5">
                <!-- Ícono SVG inline -->
                <div class="icon-svg">
                    <!-- SVG de ejemplo: documento con dólar -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M8 3h7a2 2 0 0 1 2 2v2h-2V5H8v14h7v-2h2v2a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2zm8.293 9.707L18 12l-1.293-1.293a1 1 0 0 0-1.414 1.414L16.586 12l-1.293 1.293a1 1 0 0 0 1.414 1.414z"/>
                    </svg>
                </div>
            <!-- Contenido -->
            <div>
            <div class="fw-bold text-dark">¡Adherite al débito automático!</div>
            <div class="text-secondary small">y ganá tranquilidad todos los meses</div>
            </div>
            </div>
            </a>
        </div>

        <!-- Banner 2: Vacunas -->
        <div class="col-12 col-md-6">
            <a href="#" class="d-flex align-items-center justify-content-between py-5 px-4 rounded-3 banner-card shadow text-decoration-none">
            <div class="d-flex align-items-center gap-3">
                <!-- Ícono SVG inline -->
                <div class="icon-svg">
                <!-- SVG de ejemplo: jeringa -->
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M19.778 4.222a1 1 0 0 0-1.414 0l-2.585 2.585-.586-.585-1.414 1.414.586.586-5.379 5.379a3 3 0 0 0-.683 3.168l-3.471 3.471a1 1 0 1 0 1.414 1.414l3.471-3.471a3 3 0 0 0 3.168-.683l5.379-5.379.586.586 1.414-1.414-.586-.586 2.585-2.585a1 1 0 0 0 0-1.414l-1-1z"/>
                </svg>
                </div>
                <!-- Contenido -->
                <div>
                <div class="fw-bold text-dark">Poné las <span class="fw-bolder">VACUNAS AL DÍA</span></div>
                <div class="text-secondary small">completá el calendario de vacunación</div>
                </div>
            </div>
            </a>
        </div>
    </div>
</div>
</section>

    <!-- Botones -->
    <section>
        <h2 class="section-title">Botones</h2>
        
        <div class="button-group">
            <h3>Bootstrap buttons</h3>
            <button type="button" class="btn btn-primary">Primary</button>
            <button class="btn btn-outline-primary">Outlined</button>
            <button type="button" class="btn btn-secondary">Secondary</button>
            <button class="btn btn-outlimed-primary" disabled>Outlined Deshabilitado</button>
        </div>

        <div class="button-group mt-4">
            <h4>Bootstrap buttons 'sm'</h4>
            <button type="button" class="btn btn-primary btn-sm">Primary</button>
            <button class="btn btn-outline-primary btn-sm">Outlined</button>
            <button type="button" class="btn btn-secondary btn-sm">Secondary</button>
            <button class="btn btn-outlimed-primary btn-sm" disabled>Deshabilitado</button>
        </div>
    </section>

    <section>
        <h2 class="section-title">Cards</h2>

        <a href="#" class="text-decoration-none areas-gobierno-item py-3">
            <div class="card acceso-card d-flex flex-row shadow-sm rounded overflow-hidden align-items-stretch">
                <!-- Franja celeste lateral -->
                <div class="acceso-barra d-flex align-items-center justify-content-center"></div>

                <!-- Contenido -->
                <div class="acceso-content p-4">
                    <h5 class="acceso-title  mb-1">Jefatura de Gabinete</h5>
                    <p class="acceso-description text-secondary mb-0"> La Jefatura de Gabinete se encarga de coordinar el gobierno municipal, promoviendo la comunicación entre áreas.</p>
                    <span class="text-primary text-decoration-underline">Ver más</span>
                </div>
            </div>
        </a>


        <a href="#" class="text-decoration-none areas-gobierno-item">
            <div class="card acceso-card d-flex flex-row shadow-sm overflow-hidden align-items-stretch">
                <!-- Franja celeste con ícono centrado -->
                <div class="card-icon d-flex align-items-center justify-content-center">
                    <svg class="acceso-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M12 2C9.243 2 7 4.243 7 7v2c0 4.971 4.029 9 9 9s9-4.029 9-9V7c0-2.757-2.243-5-5-5h-8zm6 9.5c0 .276-.224.5-.5.5h-2c-.276 0-.5-.224-.5-.5V9h3v2.5zm-5.5-.5c0 .276-.224.5-.5.5H10c-.276 0-.5-.224-.5-.5V9h3v2z"/>
                    </svg>
                </div>

                <!-- Contenido -->
                <div class="acceso-content p-4">
                    <h5 class="acceso-title mb-1">CULTURA</h5>
                    <p class="acceso-description text-secondary mb-0">Descubrí talleres, eventos y actividades.</p>
                </div>
            </div>
        </a>




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

    <section>
        <h2 class="section-title">Info institucional - pre footer</h2>
    <?php
set_query_var('info_institucional', [
  'titulo' => 'Información institucional',
  'nombre' => 'Joaquín Miguel Estrada',
  'cargo' => 'Secretario de Educación y Trabajo',
  'telefono' => '03525 - 443776 / 7',
  'email' => 'sme@sanmiguel.gob.ar',
  'foto' => get_template_directory_uri() . '/assets/images/estrada.jpg',
  'mapa_embed' => '<iframe src="https://www.google.com/maps/embed?..."
                   width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
]);
get_template_part('templates/parts/info-institucional');
?>
        </div>
        </section>


</div>

<?php get_template_part(THEME_FOOTER); ?>