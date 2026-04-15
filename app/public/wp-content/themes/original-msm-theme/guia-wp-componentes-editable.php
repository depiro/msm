
<?php
/*
Template Name: Guía WP Editable para Editores
*/
get_template_part(THEME_HEADER);
?>

<div class="container my-5">
  <h1 class="mb-4">Guía Visual de Componentes para Editores de WordPress</h1>
  <p class="text-muted mb-5">Esta guía muestra cómo usar cada bloque disponible en el contenido. Cada componente incluye su vista renderizada y el código HTML para copiar en un bloque "HTML personalizado" de Gutenberg.</p>

  <!-- Botón -->
  <div class="componente-demo my-5">
    <h3 class="mb-2">🔘 Botón primario</h3>
    <p class="text-muted">Usalo para acciones principales como iniciar un trámite.</p>
    <div class="preview mb-3">
      <a href="#" class="btn btn-primary">Iniciar trámite</a>
    </div>
    <pre class="bg-light border rounded p-3 small"><code>&lt;a href=&quot;#&quot; class=&quot;btn btn-primary&quot;&gt;Iniciar trámite&lt;/a&gt;</code></pre>
  </div>

  <!-- Caja informativa -->
  <div class="componente-demo my-5">
    <h3 class="mb-2">⚠️ Caja informativa</h3>
    <p class="text-muted">Usala para resaltar alertas, consejos o información clave.</p>
    <div class="preview mb-3">
      <div class="alerta alerta-info p-3">
        <strong>Recordá:</strong> Todos los documentos deben estar en formato PDF.
      </div>
    </div>
    <pre class="bg-light border rounded p-3 small"><code>&lt;div class=&quot;alerta alerta-info p-3&quot;&gt;
  &lt;strong&gt;Recordá:&lt;/strong&gt; Todos los documentos deben estar en formato PDF.
&lt;/div&gt;</code></pre>
  </div>

  <!-- Card con barra celeste -->
  <div class="componente-demo my-5">
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
    <pre class="bg-light border rounded p-3 small"><code>&lt;div class=&quot;card-tramite d-flex border rounded overflow-hidden&quot; style=&quot;min-width: 250px;&quot;&gt;
  &lt;div style=&quot;width: 8px; background-color: #1BA9E1;&quot;&gt;&lt;/div&gt;
  &lt;div class=&quot;p-3&quot;&gt;
    &lt;h4 class=&quot;mb-1 fw-600 fz-18&quot;&gt;Unifamiliar&lt;/h4&gt;
    &lt;p class=&quot;mb-0 text-secondary fz-16&quot;&gt;Vivienda individual hasta 150m².&lt;/p&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
  </div>

  <!-- Acordeón FAQ -->
  <div class="componente-demo my-5">
    <h3 class="mb-2">🔽 Acordeón (FAQ)</h3>
    <p class="text-muted">Para ocultar y revelar respuestas o detalles.</p>
    <div class="preview mb-3">
      <details class="my-3">
        <summary class="fz-18 fw-600 cursor-pointer">¿Qué documentación necesito?</summary>
        <p class="mt-2">Debés presentar planos firmados, DNI y comprobante de pago.</p>
      </details>
    </div>
    <pre class="bg-light border rounded p-3 small"><code>&lt;details class=&quot;my-3&quot;&gt;
  &lt;summary class=&quot;fz-18 fw-600 cursor-pointer&quot;&gt;¿Qué documentación necesito?&lt;/summary&gt;
  &lt;p class=&quot;mt-2&quot;&gt;Debés presentar planos firmados, DNI y comprobante de pago.&lt;/p&gt;
&lt;/details&gt;</code></pre>
  </div>
</div>

<?php get_template_part(THEME_FOOTER); ?>
