<?php
defined('ABSPATH') || exit;
get_header();
$steps = array(
    array('01', 'Elegí tus productos', 'Explorá el catálogo por juego, categoría o con el buscador y sumá lo que quieras al carrito.'),
    array('02', 'Iniciá la compra', 'Revisá tu selección en el carrito y avanzá a "Finalizar compra" cuando estés list@.'),
    array('03', 'Elegí pago y envío', 'Pagá con Mercado Pago, tarjeta, transferencia o efectivo, y elegí envío a domicilio o retiro en tienda.'),
    array('04', 'Confirmá tu pedido', 'Recibís un email de confirmación y te avisamos por WhatsApp apenas esté en camino o listo para retirar.'),
);
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-como-comprar.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Cómo comprar</nav><p class="section-label"><i class="label-dash"></i>ES MÁS FÁCIL DE LO QUE PENSÁS</p><h1>Cómo comprar.</h1><p>Cuatro pasos entre vos y tu próxima carta, sobre o juego de mesa.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-steps">
      <?php foreach ($steps as $s): ?>
      <div class="info-step"><b><?php echo esc_html($s[0]); ?></b><h3><?php echo esc_html($s[1]); ?></h3><p><?php echo esc_html($s[2]); ?></p></div>
      <?php endforeach; ?>
    </div>
    <div class="faq-cta">
      <p>¿Tenés dudas antes de comprar?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
