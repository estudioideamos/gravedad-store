<?php if (!defined('ABSPATH')) { exit; } ?>
<section class="newsletter"><div class="hero-grid"></div>
  <div class="newsletter-copy">
    <p class="section-label"><i class="label-dash"></i>NO TE QUEDES AFUERA</p>
    <h2>Todo lo nuevo,<br><em>antes que se agote.</em></h2>
    <p class="newsletter-desc">Lanzamientos, preventas y ofertas elegidas por el equipo. Solo lo que vale la pena abrir.</p>
    <div class="newsletter-stats">
      <div><b>01</b><span>Lanzamientos exclusivos</span></div>
      <div><b>02</b><span>Preventas anticipadas</span></div>
      <div><b>03</b><span>Descuentos para la lista</span></div>
    </div>
  </div>
  <div class="newsletter-card">
    <div class="newsletter-card-meta"><span>GRAVEDAD STORE</span><span>ACCESO Nº 001</span></div>
    <p class="kicker">UNA VENTAJA EN TU INBOX</p>
    <h3>Sumate ahora.</h3>
    <form><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="4" width="20" height="16" rx="2"></rect><path d="m22 7-10 6L2 7"></path></svg><input type="email" name="email" placeholder="tu@email.com" aria-label="Tu correo" required><button type="submit">QUIERO ENTERARME <span>→</span></button></form>
    <div class="newsletter-card-trust"><span>1 correo por semana</span><span>0 spam</span></div>
    <small>✓ Podés darte de baja cuando quieras.</small>
  </div>
</section>
<footer class="site-footer">
  <div class="footer-glow"></div>
  <section class="footer-cta">
    <div>
      <p class="section-label"><i class="label-dash"></i>EXPLORÁ EL CATÁLOGO</p>
      <h2>El próximo golpe<br><em>está en el mazo.</em></h2>
    </div>
    <a class="footer-cta-link" href="<?php echo esc_url(gravedad_shop_url()); ?>" aria-label="Ver tienda completa">
      <svg class="footer-cta-orbit" viewBox="0 0 160 160" aria-hidden="true">
        <defs><path id="footer-orbit-path" d="M80,80 m-58,0 a58,58 0 1,1 116,0 a58,58 0 1,1 -116,0"></path></defs>
        <text><textPath href="#footer-orbit-path" startOffset="0" textLength="350" lengthAdjust="spacing">VER TIENDA · GRAVEDAD STORE ·</textPath></text>
      </svg>
      <span class="footer-cta-jewel"><?php echo gravedad_icon('hexagon'); ?></span>
    </a>
  </section>
  <div class="footer-top">
    <div class="footer-brand"><a class="footer-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Gravedad Store"><img class="brand-logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store" width="1200" height="400" loading="lazy"></a><p>Tu punto de encuentro para jugar,<br>coleccionar y descubrir.</p>
      <div class="footer-social">
        <a href="<?php echo esc_url(gravedad_option('gravedad_instagram','https://www.instagram.com/gravedadstore')); ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"></rect><circle cx="12" cy="12" r="4.2"></circle><circle cx="17.4" cy="6.6" r="1"></circle></svg></a>
        <a href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?php echo gravedad_icon('whatsapp'); ?></a>
      </div>
    </div>
    <div class="footer-nav"><b>TIENDA</b><a href="<?php echo esc_url(gravedad_shop_url('tcg')); ?>">TCG</a><a href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">Cartas sueltas</a><a href="<?php echo esc_url(gravedad_shop_url('juegos-de-mesa')); ?>">Juegos de mesa</a><a href="<?php echo esc_url(gravedad_shop_url('accesorios')); ?>">Accesorios</a></div>
    <div class="footer-nav"><b>AYUDA</b><a href="<?php echo esc_url(home_url('/como-comprar/')); ?>">Cómo comprar</a><a href="<?php echo esc_url(home_url('/envios/')); ?>">Envíos</a><a href="<?php echo esc_url(home_url('/cambios-y-devoluciones/')); ?>">Cambios y devoluciones</a><a href="<?php echo esc_url(home_url('/preguntas-frecuentes/')); ?>">Preguntas frecuentes</a></div>
    <div class="footer-contact-card">
      <p class="footer-contact-label">ATENCIÓN DIRECTA</p>
      <h3>¿Tenés dudas?</h3>
      <a class="footer-whatsapp-link" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>" target="_blank" rel="noopener"><span>Hablar por WhatsApp</span><i aria-hidden="true">↗</i></a>
      <p><a href="mailto:silvafacu18@gmail.com.ar">silvafacu18@gmail.com.ar</a></p>
      <p>José C. Paz, Buenos Aires</p>
    </div>
  </div>
  <div class="footer-payments">
    <span>MEDIOS DE PAGO</span>
    <div class="payment-badges">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/payments/mercadopago.svg'); ?>" alt="Mercado Pago" loading="lazy">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/payments/visa.svg'); ?>" alt="Visa" loading="lazy">
      <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/payments/mastercard.svg'); ?>" alt="Mastercard" loading="lazy">
      <b>Transferencia</b><b>Efectivo</b>
    </div>
  </div>
  <div class="footer-bottom">
    <span class="footer-copyright">© <?php echo esc_html(date('Y')); ?> GRAVEDAD STORE</span>
    <div class="footer-seal" aria-label="Gravedad Store"><?php echo gravedad_icon('dice'); ?><small>GRAVEDAD STORE · TCG &amp; JUEGOS DE MESA</small></div>
    <span class="footer-credit">Diseño &amp; desarrollo con <i aria-hidden="true">♥</i> por <a href="https://ideamos.com.ar" target="_blank" rel="noopener">Estudio Ideamos</a></span>
  </div>
</footer>
<div class="floating-actions" aria-label="Accesos rápidos">
  <button class="go-top" type="button" aria-label="Volver arriba">↑</button>
  <a class="floating-cart" href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/carrito/')); ?>" aria-label="Ver carrito" aria-controls="cart-drawer" aria-expanded="false"><span class="floating-cart-icon"><?php echo gravedad_icon('cart'); ?></span><span class="cart-count"><?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?></span></a>
  <a class="floating-wa" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>" target="_blank" rel="noopener" aria-label="Contactar por WhatsApp"><?php echo gravedad_icon('whatsapp'); ?></a>
</div>
<?php if (class_exists('WooCommerce')): ?>
<div class="cart-drawer-shell" data-cart-drawer hidden>
  <div class="cart-drawer-backdrop" data-cart-close></div>
  <aside class="cart-drawer" role="dialog" aria-modal="true" aria-labelledby="cart-drawer-title" id="cart-drawer">
    <header class="cart-drawer__header"><div><small>Tu selección</small><h2 id="cart-drawer-title">Carrito</h2></div><button class="cart-drawer__close" type="button" data-cart-close aria-label="Cerrar carrito">×</button></header>
    <div class="widget_shopping_cart_content"><?php woocommerce_mini_cart(); ?></div>
    <footer class="cart-drawer__trust"><span><?php echo gravedad_icon('shield'); ?> Pago seguro</span><span><?php echo gravedad_icon('truck'); ?> Envíos nacionales</span></footer>
  </aside>
</div>
<?php endif; ?>
<?php wp_footer(); ?></body></html>
