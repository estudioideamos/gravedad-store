<?php
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-cambios-y-devoluciones.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Cambios y devoluciones</nav><p class="section-label"><i class="label-dash"></i>COMPRÁ SIN VUELTAS</p><h1>Cambios y<br>devoluciones.</h1><p>Si algo no salió como esperabas, te ayudamos a resolverlo.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-block">
      <h2>Plazo y condiciones</h2>
      <ul>
        <li>Tenés <b>10 días corridos</b> desde que recibís tu pedido para solicitar un cambio.</li>
        <li>El producto debe estar <b>sellado o en las mismas condiciones</b> en que lo enviamos.</li>
        <li>Los sobres, boosters y productos sellados <b>abiertos</b> no admiten devolución, salvo defecto de fábrica.</li>
      </ul>
    </div>
    <div class="info-block">
      <h2>¿Llegó dañado o incorrecto?</h2>
      <p>Escribinos por WhatsApp con fotos del producto y del embalaje apenas lo recibas. Gestionamos el cambio o la devolución sin cargo para vos.</p>
    </div>
    <div class="info-block">
      <h2>Cómo iniciar un cambio</h2>
      <ul>
        <li>Escribinos por WhatsApp indicando tu número de pedido.</li>
        <li>Te confirmamos si corresponde cambio, devolución o reembolso.</li>
        <li>Coordinamos el envío o el retiro en tienda del producto.</li>
      </ul>
    </div>
    <div class="faq-cta">
      <p>¿Necesitás gestionar un cambio?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
