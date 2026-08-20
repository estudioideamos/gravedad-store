<?php
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-envios.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Envíos</nav><p class="section-label"><i class="label-dash"></i>A TODO EL PAÍS</p><h1>Envíos.</h1><p>Enviamos por Correo Argentino con el embalaje cuidado que tus cartas se merecen.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-block">
      <h2>Zonas y tiempos</h2>
      <table class="info-table">
        <thead><tr><th>Zona</th><th>Tiempo estimado</th><th>Costo</th></tr></thead>
        <tbody>
          <tr><td>AMBA</td><td>2 a 4 días hábiles</td><td>Se calcula en el checkout</td></tr>
          <tr><td>Interior del país</td><td>4 a 8 días hábiles</td><td>Se calcula en el checkout</td></tr>
          <tr><td>Retiro en tienda</td><td>Mismo día (con turno)</td><td>Sin cargo</td></tr>
        </tbody>
      </table>
      <p>El costo final y el tiempo estimado se muestran al finalizar la compra, según tu código postal.</p>
    </div>
    <div class="info-block">
      <h2>Seguimiento del pedido</h2>
      <p>Apenas despachamos tu compra te enviamos el número de seguimiento por email y WhatsApp para que puedas rastrearlo en todo momento.</p>
    </div>
    <div class="info-block">
      <h2>Embalaje protegido</h2>
      <ul>
        <li><b>Cartas sueltas</b>: se envían en top loader y sobre rígido, dentro de un sobre acolchado.</li>
        <li><b>Sellado</b>: booster boxes y displays viajan en caja reforzada con relleno protector.</li>
        <li><b>Juegos de mesa</b>: embalaje original más protección extra en las esquinas.</li>
      </ul>
    </div>
    <div class="faq-cta">
      <p>¿Necesitás ayuda con tu envío?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
