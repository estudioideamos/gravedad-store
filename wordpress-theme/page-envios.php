<?php
defined('ABSPATH') || exit;
get_header();
$zones = array(
    array('truck', 'AMBA', '2 a 4 días hábiles', 'Se calcula en el checkout'),
    array('box', 'Interior del país', '4 a 8 días hábiles', 'Se calcula en el checkout'),
    array('store', 'Retiro en tienda', 'Mismo día, con turno', 'Sin cargo'),
);
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-envios.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Envíos</nav><p class="section-label"><i class="label-dash"></i>A TODO EL PAÍS</p><h1>Envíos.</h1><p>Enviamos por Correo Argentino con el embalaje cuidado que tus cartas se merecen.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-steps">
      <?php foreach ($zones as $z): ?>
      <div class="info-step"><span class="step-icon"><?php echo gravedad_icon($z[0]); ?></span><h3><?php echo esc_html($z[1]); ?></h3><p><?php echo esc_html($z[2]); ?><br><b class="step-highlight"><?php echo esc_html($z[3]); ?></b></p></div>
      <?php endforeach; ?>
    </div>
    <p class="info-note">El costo final y el tiempo estimado se confirman al finalizar la compra, según tu código postal.</p>
    <div class="info-block">
      <h2><?php echo gravedad_icon('clock'); ?>Seguimiento del pedido</h2>
      <p>Apenas despachamos tu compra te enviamos el número de seguimiento por email y WhatsApp para que puedas rastrearlo en todo momento.</p>
    </div>
    <div class="info-block">
      <h2><?php echo gravedad_icon('shield'); ?>Embalaje protegido</h2>
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
