<?php
/**
 * Componente: Buscador
 * Ubicación: templates/parts/components/buscador.php
 */

// Valor por defecto si no se define la variable
$titulo_buscador = isset($titulo_buscador) ? $titulo_buscador : __('Bienvenido, buscá por trámite, servicio o palabra clave', 'tu-textdomain');
?>

<section class="buscador">
  <div class="buscador__container">
    <h2 class="buscador__titulo">
      <?php echo esc_html($titulo_buscador); ?>
    </h2>
    <form class="buscador__form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
      <input 
        type="search" 
        class="buscador__input" 
        name="s"
        placeholder="<?php esc_attr_e('Buscar...', 'tu-textdomain'); ?>"
        aria-label="<?php esc_attr_e('Buscar', 'tu-textdomain'); ?>"
        value="<?php echo get_search_query(); ?>"
      />
      <button type="submit" class="buscador__button" aria-label="<?php esc_attr_e('Buscar', 'tu-textdomain'); ?>">
        <?php inline_svg('search'); ?>
      </button>
    </form>
  </div>
</section>
