<!-- Encuesta de utilidad -->
<?php get_template_part('templates/parts/encuesta_utilidad'); ?>


<footer class="p-0 d-flex justify-content-center flex-column h-auto" style="background-color:#E5E5E5">
    <div class="py-3 d-flex align-items-center justify-content-center contacto">
        <div class="container text-white text-center row justify-content-center align-items-center py-3">
            <div class="col-12 col-md-4 d-flex align-items-center">
                <div class="d-flex flex-column align-items-start p-3 text-white">
                    <span class="fz-20 fw-600 text-start">2025 Municipalidad de San Miguel</span>
                    <span class="fz-16 text-left fst-italic" style="text-align:left;">Domingo Faustino Sarmiento 1551, San Miguel<br> Provincia de Buenos Aires, Argentina</span>
                </div>
            </div>

            <a class="col-12 col-md-4 logo-footer d-none d-md-block " href="<?php echo HOME_URI; ?>" title="<?php bloginfo('name') ?> | Provincia de Buenos Aires. Argentina "">
				<img src=" <?php echo THEME_URI; ?>/assets/images/_msmlogo-circulo.svg" alt="logo MSM" width="160">
            </a>

            <div class="col-12 col-md-4 d-flex gap-4 flex-column">
                <div class="d-flex flex-column justify-content-start">
                    <span class="fz-16"><a class="text-white text-decoration-none" href="<?php echo HOME_URI; ?>/terminos-y-condiciones/">Términos y condiciones</a></span>
                    <span class="fz-16 d-flex align-items-center justify-content-center"><a href="<?php bloginfo('url'); ?>/feed" target="_blank" class="rss">Suscripción vía RSS </a></span>
                </div>
                <div class="d-flex justify-content-center gap-3">
                    <a href="https://www.instagram.com/munisanmiguel/?hl=es-la" target="_blank">
                        <img class="icon-footer-redes" src="<?php echo THEME_URI; ?>/assets/images/icon-instagram.svg" height="55">
                    </a>
                    <a href="https://www.facebook.com/MuniSanMiguelBA/" target="_blank">
                        <img class="icon-footer-redes" src="<?php echo THEME_URI; ?>/assets/images/icon-facebook.svg" height="55">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="phone-container row w-100 justify-content-around">
            <div class="col-4 col-md-auto col-md-auto p-3 justify-content-center d-flex flex-column">
                <span class="phone-item-name text-left fz-16 msm-text-black">Atención al vecino</span>
                <a class="phone-item-number text-left fz-42 fw-600 msm-text-black" href="tel:147">147</a>
            </div>
            <div class="col-4 col-md-auto col-md-auto p-3 justify-content-center d-flex flex-column">
                <span class="phone-item-name text-left fz-16 msm-text-black">SAME</span>
                <a class="phone-item-number text-left fz-42 fw-600 msm-text-black" href="tel:107">107</a>
            </div>
            <div class="col-4 col-md-auto col-md-auto p-3 justify-content-center d-flex flex-column">
                <span class="phone-item-name text-left fz-16 msm-text-black">COM</span>
                <a class="phone-item-number text-left fz-42 fw-600 msm-text-black" href="tel:109">109</a>
            </div>
            <div class="col-12 col-md-auto col-md-auto p-3 justify-content-center d-flex flex-column">
                <span class="phone-item-name text-left fz-16 msm-text-black">Bomberos</span>
                <a class="phone-item-number text-left fz-42 fw-600 msm-text-black" href="tel:(011) 4664-2222">(011) 4664-2222</a>
            </div>
        </div>
    </div>
</footer>
<script src="https://web.chat-tonic.com/api/v1/load/san-miguel"></script>
<script src="<?php echo THEME_URI; ?>/assets/js/jquery.min.js"></script>
<script src="<?php echo THEME_URI; ?>/assets/js/fullcalendar.global.min.js"></script>

<script src="<?php echo THEME_URI; ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>