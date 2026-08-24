<?php
defined('ABSPATH') || exit;
get_header();
$faq_icons = array(
    'Pedidos y pagos' => 'tag',
    'Envíos y retiro' => 'truck',
    'Cambios y devoluciones' => 'refresh',
    'Productos y stock' => 'box',
);
$faq_groups = array(
    'Pedidos y pagos' => array(
        array('¿Qué medios de pago aceptan?', 'Aceptamos Mercado Pago, Visa, Mastercard, transferencia bancaria y efectivo en el local. En productos seleccionados ofrecemos 3 cuotas sin interés.'),
        array('¿Puedo pagar en cuotas?', 'Sí, con tarjetas de crédito a través de Mercado Pago. Los productos con 3 cuotas sin interés están marcados en la tienda.'),
        array('¿Cómo sé si mi pago fue confirmado?', 'Vas a recibir un correo de confirmación apenas se acredite el pago. Si pagás por transferencia, el pedido queda "a la espera" hasta que verifiquemos el comprobante.'),
    ),
    'Envíos y retiro' => array(
        array('¿Hacen envíos a todo el país?', 'Sí, enviamos a todo el país por Correo Argentino. El costo y el tiempo estimado se calculan al finalizar la compra según tu código postal.'),
        array('¿Puedo retirar en el local?', 'Sí, podés elegir "Retiro en tienda" sin cargo al finalizar la compra. Te avisamos por WhatsApp o email cuando esté listo para retirar en Roque Sáenz Peña 5086, José C. Paz, Buenos Aires.'),
        array('¿Cuánto tarda en llegar mi pedido?', 'Dentro del AMBA suele demorar entre 2 y 4 días hábiles, y en el resto del país entre 4 y 8 días hábiles según la zona.'),
    ),
    'Cambios y devoluciones' => array(
        array('¿Puedo cambiar un producto?', 'Sí, tenés 10 días corridos desde que lo recibís para solicitar un cambio, siempre que el producto esté sellado o en las mismas condiciones en que lo enviamos.'),
        array('¿Qué hago si mi carta llegó dañada?', 'Escribinos por WhatsApp con fotos del producto y del embalaje apenas lo recibas. Gestionamos el cambio o la devolución sin cargo.'),
        array('¿Los sobres o boosters se pueden devolver una vez abiertos?', 'No, por la naturaleza del producto los sobres sellados no admiten devolución una vez abiertos, salvo defecto de fábrica.'),
    ),
    'Productos y stock' => array(
        array('¿Las cartas sueltas son originales?', 'Sí, trabajamos únicamente con productos originales de los editores oficiales (Wizards of the Coast, Pokémon, Bandai, entre otros).'),
        array('¿Cómo puedo reservar una preventa?', 'Los productos en preventa se pueden comprar directamente en la sección Preventas. Se factura el total y te avisamos apenas llega el lanzamiento.'),
        array('¿Con qué frecuencia suman productos nuevos?', 'Todas las semanas sumamos novedades, tanto sellado como cartas sueltas. Podés verlas en la sección Novedades de la home.'),
    ),
);
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-preguntas-frecuentes.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Preguntas frecuentes</nav><p class="section-label"><i class="label-dash"></i>ESTAMOS PARA AYUDARTE</p><h1>Preguntas frecuentes.</h1><p>Todo lo que necesitás saber sobre pagos, envíos y cambios antes de tu próxima compra.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell faq-shell">
    <div class="faq-columns">
      <?php foreach ($faq_groups as $group => $items): ?>
      <section class="faq-group">
        <h2><?php echo gravedad_icon($faq_icons[$group]); ?><?php echo esc_html($group); ?></h2>
        <div class="faq-list">
          <?php foreach ($items as $item): ?>
          <details class="faq-item">
            <summary><?php echo esc_html($item[0]); ?><span class="faq-toggle">+</span></summary>
            <p><?php echo esc_html($item[1]); ?></p>
          </details>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endforeach; ?>
    </div>
    <div class="faq-cta">
      <p>¿No encontraste lo que buscabas?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
