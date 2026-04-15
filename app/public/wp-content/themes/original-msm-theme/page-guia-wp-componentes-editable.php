
<?php
/*
Template Name: Guía WP Editable para Editores
*/
get_template_part(THEME_HEADER);
?>

<style>
  .copy-btn {
    float: right;
    margin-top: -2.5rem;
    margin-right: 1rem;
    font-size: 0.85rem;
    background-color: #eee;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 0.2rem 0.6rem;
    cursor: pointer;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.copy-btn').forEach(button => {
      button.addEventListener('click', () => {
        const pre = button.nextElementSibling;
        const code = pre.querySelector('code').textContent;
        navigator.clipboard.writeText(code).then(() => {
          button.innerText = 'Copiado!';
          setTimeout(() => button.innerText = 'Copiar', 2000);
        });
      });
    });
  });
</script>

<div class="container my-5">
  <h1 class="mb-4">Guía Visual de Componentes para Editores de WordPress</h1>
  <p class="text-muted">Copiá fácilmente el código de cada componente para usarlo en el editor de bloques como “HTML personalizado”.</p>

  <div class="row">
    <!-- Índice -->
    <div class="bg-light rounded p-3 mb-5 col-4">
      <h4 class="mb-3">📚 Índice</h4>
      <ul class="list-unstyled">
        <li><a href="#btn">🔘 Botón primario</a></li>
        <li><a href="#alerta">⚠️ Caja informativa</a></li>
        <li><a href="#card">📂 Card con barra celeste</a></li>
        <li><a href="#faq">🔽 Acordeón (FAQ)</a></li>
        <li><a href="#cita">🗣 Cita destacada</a></li>
        <li><a href="#tabla">📋 Tabla simple</a></li>
        <li><a href="#iconos">🎚 Grilla de íconos</a></li>
        <li><a href="#callout">📣 Caja destacada</a></li>
        <li><a href="#imagen-texto">🖼 Imagen + texto</a></li>
      </ul>
    </div>

  <div class="col-8">
  <div class="componente-demo my-5">
  <span class="badge bg-primary text-white px-2 py-1 rounded-pill">Nuevo</span>
</div>
  
  <div class="componente-demo my-5">
  <a href="#" class="d-inline-block fw-bold text-decoration-underline text-primary fz-16 my-2">
  Ver requisitos completos →
</a>
</div>
<div class="componente-demo my-5">
<div class="alert alert-primary" role="alert">
  A simple primary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-secondary" role="alert">
  A simple secondary alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-success" role="alert">
  A simple success alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-danger" role="alert">
  A simple danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-warning" role="alert">
  A simple warning alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-info" role="alert">
  A simple info alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-light" role="alert">
  A simple light alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
<div class="alert alert-dark" role="alert">
  A simple dark alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
</div>
</div>


<div class="componente-demo my-5" >
<!-- wp:html -->
<h1 class="mb-2">Encabezado H1 – Título principal</h1>
<h2 class="mb-2">Encabezado H2 – Sección</h2>
<h3 class="mb-2">Encabezado H3 – Subsección</h3>
<h4 class="mb-2">Encabezado H4 – Detalle</h4>
<h5 class="mb-2">Encabezado H5 – Nota o subdetalle</h5>
<h6 class="mb-4">Encabezado H6 – Anotación mínima</h6>
<!-- /wp:html -->
</div>

<div class="componente-demo my-5" >
<!-- wp:html -->
<h2 class="fz-28 fw-bold mb-3">Cómo solicitar un Permiso de Obra</h2>
<p class="fz-18 text-secondary mb-4">Guía paso a paso para iniciar el trámite desde casa</p>
<!-- /wp:html -->
</div>


    <!-- 🔘 Botón primario -->
    <div class="componente-demo my-5" id="btn">
      <h3 class="mb-2">🔘 Botón primario</h3>
      <p class="text-muted">Usalo para acciones principales como iniciar un trámite.</p>
      <div class="preview mb-3">
        <a href="#" class="btn btn-primary">Iniciar trámite</a>
      </div>
      <button class="copy-btn">Copiar</button>
      <pre class="bg-light border rounded p-3 small"><code>&lt;a href="#" class="btn btn-primary"&gt;Iniciar trámite&lt;/a&gt;</code></pre>
    </div>

    <!-- ⚠️ Caja informativa -->
    <div class="componente-demo my-5" id="alerta">
      <h3 class="mb-2">⚠️ Caja informativa</h3>
      <p class="text-muted">Usala para resaltar alertas, consejos o información clave.</p>
      <div class="preview mb-3">
        <div class="alert alert-primary p-3">
          <strong>Recordá:</strong> Todos los documentos deben estar en formato PDF.
        </div>
      </div>
      <button class="copy-btn">Copiar</button>
      <pre class="bg-light border rounded p-3 small"><code>&lt;div class="alerta alerta-info p-3"&gt;
    &lt;strong&gt;Recordá:&lt;/strong&gt; Todos los documentos deben estar en formato PDF.
  &lt;/div&gt;</code></pre>
    </div>


    <!-- wp:html -->
    <div class="row">
      <div class="col-6">
        <a href="#">
          <div class="card-tramite d-flex border rounded overflow-hidden" style="min-width: 250px;">
            <div style="width: 8px; background-color: #1BA9E1;"></div>
            <div class="p-3">
              <h4 class="mb-1 fw-600 fz-18">Unifamiliar</h4>
              <p class="mb-0 text-secondary fz-16">Vivienda individual hasta 150m².</p>
            </div>
          </div>
          </a>
      </div>
      <div class="col-6">
        <a href="#">
          <div class="card-tramite d-flex border rounded overflow-hidden" style="min-width: 250px;">
            <div style="width: 8px; background-color: #1BA9E1;"></div>
            <div class="p-3">
              <h4 class="mb-1 fw-600 fz-18">Multifamiliar</h4>
              <p class="mb-0 text-secondary fz-16">Vivienda individual hasta 150m².</p>
            </div>
          </div>
        </a>
      </div>      
    </div>
  <!-- /wp:html -->



  <!-- 📂 Card con barra celeste -->
  <div class="componente-demo my-5" id="card">
    <h3 class="mb-2">📂 Card con barra celeste</h3>
    <p class="text-muted">Ideal para mostrar tipos de trámite o categorías.</p>
    <div class="preview mb-3">
      <div class="card-tramite d-flex border rounded overflow-hidden" style="min-width: 250px;">
        <div style="width: 8px; background-color: #1BA9E1;"></div>
        <div class="p-3">
          <h4 class="mb-1 fw-600 fz-18">Unifamiliar</h4>
          <p class="mb-0 text-secondary fz-16">Vivienda individual hasta 150m².</p>
        </div>
      </div>
    </div>
    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;div class="card-tramite d-flex border rounded overflow-hidden" style="min-width: 250px;"&gt;
  &lt;div style="width: 8px; background-color: #1BA9E1;"&gt;&lt;/div&gt;
  &lt;div class="p-3"&gt;
    &lt;h4 class="mb-1 fw-600 fz-18"&gt;Unifamiliar&lt;/h4&gt;
    &lt;p class="mb-0 text-secondary fz-16"&gt;Vivienda individual hasta 150m².&lt;/p&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
  </div>

<div class="row">
  <div class="col-12">

<!-- 🔽 Acordeón (FAQ) -->
<div class="componente-demo my-5" id="faq">
    <h3 class="mb-2">🔽 Acordeón</h3>
    <p class="text-muted">Uso: Para ocultar y revelar respuestas o detalles, por ejemplo en preguntas frecuentes.</p>
    
    <div class="preview mb-3 py-4">
      <details class="my-3">
        <summary class="fz-18 fw-600 cursor-pointer">¿Qué documentación necesito?</summary>
          <p class="mt-2">Debés presentar planos firmados, DNI y comprobante de pago.</p>
      </details>
      <details class="my-3">
        <summary class="fz-18 fw-600 cursor-pointer">¿Cuántos días demora el trámite?</summary>
          <p class="mt-2">Aproximadamente entre 24 y 48 horas.</p>
      </details>
    </div>

    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;details class="my-3"&gt;
  &lt;summary class="fz-18 fw-600 cursor-pointer"&gt;¿Qué documentación necesito?&lt;/summary&gt;
  &lt;p class="mt-2"&gt;Debés presentar planos firmados, DNI y comprobante de pago.&lt;/p&gt;
&lt;/details&gt;</code></pre>
  </div>  
  <div>
<div>



  <!-- 🗣 Cita destacada -->
  <div class="componente-demo my-5" id="cita">
    <h3 class="mb-2">🗣 Cita destacada</h3>
    <p class="text-muted">Ideal para frases institucionales, testimonios o énfasis editorial.</p>
    <div class="preview mb-3">
      <blockquote class="border-start border-4 ps-3 text-muted fst-italic">
  “La gestión municipal comienza con la escucha atenta.”
</blockquote>
    </div>
    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;blockquote class="border-start border-4 ps-3 text-muted fst-italic"&gt;
  “La gestión municipal comienza con la escucha atenta.”
&lt;/blockquote&gt;</code></pre>
  </div>

  <!-- 📋 Tabla simple -->
  <div class="componente-demo my-5" id="tabla">
    <h3 class="mb-2">📋 Tabla simple</h3>
    <p class="text-muted">Para comparar requisitos o datos tabulados.</p>
    <div class="preview mb-3">
      <table class="table table-bordered">
  <thead><tr><th>Documento</th><th>Obligatorio</th></tr></thead>
  <tbody>
    <tr><td>DNI</td><td>Sí</td></tr>
    <tr><td>Plano</td><td>Sí</td></tr>
  </tbody>
</table>
    </div>
    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;table class="table table-bordered"&gt;
  &lt;thead&gt;&lt;tr&gt;&lt;th&gt;Documento&lt;/th&gt;&lt;th&gt;Obligatorio&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;
  &lt;tbody&gt;
    &lt;tr&gt;&lt;td&gt;DNI&lt;/td&gt;&lt;td&gt;Sí&lt;/td&gt;&lt;/tr&gt;
    &lt;tr&gt;&lt;td&gt;Plano&lt;/td&gt;&lt;td&gt;Sí&lt;/td&gt;&lt;/tr&gt;
  &lt;/tbody&gt;
&lt;/table&gt;</code></pre>
  </div>

  <!-- 🎚 Grilla de íconos + texto -->
  <div class="componente-demo my-5" id="iconos">
    <h3 class="mb-2">🎚 Grilla de íconos + texto</h3>
    <p class="text-muted">Ideal para mostrar servicios, áreas temáticas o accesos rápidos.</p>
    <div class="preview mb-3">
      <div class="text-center" style="width: 120px;">
  <img src="/wp-content/themes/msm-theme/assets/images/icons/salud.svg" width="40" alt="">
  <p class="mt-2 fz-14">Salud</p>
</div>
    </div>
    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;div class="text-center" style="width: 120px;"&gt;
  &lt;img src="/wp-content/themes/msm-theme/assets/images/icons/salud.svg" width="40" alt=""&gt;
  &lt;p class="mt-2 fz-14"&gt;Salud&lt;/p&gt;
&lt;/div&gt;</code></pre>
  </div>

  <!-- 📣 Caja destacada (Callout) -->
  <div class="componente-demo my-5" id="callout">
    <h3 class="mb-2">📣 Caja destacada (Callout)</h3>
    <p class="text-muted">Para mensajes importantes que deben destacar visualmente.</p>
    <div class="preview mb-3">
      <div class="border rounded p-4 shadow-sm bg-white">
  <h5 class="fw-bold mb-2">Antes de comenzar</h5>
  <p class="mb-0">Verificá que tu documentación esté completa y vigente.</p>
</div>
    </div>
    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;div class="border rounded p-4 shadow-sm bg-white"&gt;
  &lt;h5 class="fw-bold mb-2"&gt;Antes de comenzar&lt;/h5&gt;
  &lt;p class="mb-0"&gt;Verificá que tu documentación esté completa y vigente.&lt;/p&gt;
&lt;/div&gt;</code></pre>
  </div>

  <!-- 🖼 Imagen + texto -->
  <div class="componente-demo my-5" id="imagen-texto">
    <h3 class="mb-2">🖼 Imagen + texto</h3>
    <p class="text-muted">Destacar una sección visual con mensaje acompañante.</p>
    <div class="preview mb-3">
      <div class="d-flex align-items-center gap-3">
  <img src="/wp-content/themes/msm-theme/assets/images/icons/salud.svg" width="60" alt="">
  <div>
    <h5 class="fw-600 mb-1">Área de Salud</h5>
    <p class="mb-0 fz-14 text-secondary">Consultas, turnos y atención primaria.</p>
  </div>
</div>
    </div>
    <button class="copy-btn">Copiar</button>
    <pre class="bg-light border rounded p-3 small"><code>&lt;div class="d-flex align-items-center gap-3"&gt;
  &lt;img src="/wp-content/themes/msm-theme/assets/images/icons/salud.svg" width="60" alt=""&gt;
  &lt;div&gt;
    &lt;h5 class="fw-600 mb-1"&gt;Área de Salud&lt;/h5&gt;
    &lt;p class="mb-0 fz-14 text-secondary"&gt;Consultas, turnos y atención primaria.&lt;/p&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
  </div>

</div>
</div>
</div>
<?php get_template_part(THEME_FOOTER); ?>

