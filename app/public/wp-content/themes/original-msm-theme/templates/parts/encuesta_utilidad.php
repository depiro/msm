<?php
/**
 * Componente: Encuesta de utilidad
 * Ubicación: Sobre el footer
 */
?>

<section class="encuesta-utilidad" aria-label="Encuesta de utilidad del contenido">
  <div class="container">

    <!-- {{-- Paso 1: pregunta inicial --}} -->
    <div class="encuesta-paso1 d-flex align-items-center justify-content-start gap-2 text-start">
      <p class="encuesta-texto text-uppercase mb-0">¿Te fue útil esta información?</p>
      <div class="encuesta-botones">
        <button class="encuesta-btn encuesta-si btn btn-primary" aria-label="Sí, me fue útil esta página">
          Sí, me fue útil
        </button>
        <button class="encuesta-btn encuesta-no btn btn-outline-dark" aria-label="No, esta página no me sirvió">
          No me sirvió
        </button>
      </div>
    </div>

    <!--     {{-- Paso 2: motivo (solo si voto negativo) --}} -->
    <div class="encuesta-paso2" hidden>
      <fieldset class="border-0 p-0 m-0">
        <legend class="encuesta-texto text-uppercase mb-2">¿Por qué no te resultó útil?</legend>
        <div class="encuesta-motivos d-flex flex-wrap gap-2 mb-2">
          <label><input type="radio" name="motivo" value="muy-complejo"> Muy complejo</label>
          <label><input type="radio" name="motivo" value="muy-basico"> Muy básico</label>
          <label><input type="radio" name="motivo" value="no-responde"> No responde mi duda</label>
          <label><input type="radio" name="motivo" value="desactualizado"> Información desactualizada</label>
        </div>
        <label for="encuesta-comentario" class="sr-only">Contanos un poco más (opcional)</label>
        <textarea id="encuesta-comentario" name="comentario" class="form-control mb-2"
          placeholder="Contanos un poco más (opcional)" rows="2"></textarea>
        <button type="button" class="btn btn-primary encuesta-enviar">Enviar opinión</button>
      </fieldset>
    </div>

    <!--     {{-- Mensaje de confirmación --}} -->
    <div class="encuesta-confirmacion" role="alert" aria-live="polite" aria-atomic="true">
    </div>

  </div>
</section>