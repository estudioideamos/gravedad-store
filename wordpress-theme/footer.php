<?php if (!defined('ABSPATH')) { exit; } ?>
<section class="newsletter"><div><p class="kicker">NO TE QUEDES AFUERA</p><h2>Todo lo nuevo,<br><em>directo a tu inbox.</em></h2></div><form><input type="email" placeholder="tu@email.com" aria-label="Tu correo"><button type="submit">QUIERO ENTERARME →</button><small>Solo lanzamientos, preventas y eventos.</small></form></section>
<footer class="site-footer">
  <div class="footer-brand"><a class="brand brand-image" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Gravedad Store"><img class="brand-logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store" width="1200" height="400" loading="lazy"></a><p>Tu punto de encuentro para jugar,<br>coleccionar y descubrir.</p><a href="<?php echo esc_url(gravedad_option('gravedad_instagram','https://www.instagram.com/gravedadstore')); ?>">Instagram ↗</a></div>
  <div><b>TIENDA</b><a href="<?php echo esc_url(gravedad_shop_url('tcg')); ?>">TCG</a><a href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">Cartas sueltas</a><a href="<?php echo esc_url(gravedad_shop_url('juegos-de-mesa')); ?>">Juegos de mesa</a><a href="<?php echo esc_url(gravedad_shop_url('accesorios')); ?>">Accesorios</a></div>
  <div><b>AYUDA</b><a href="<?php echo esc_url(home_url('/como-comprar/')); ?>">Cómo comprar</a><a href="<?php echo esc_url(home_url('/envios/')); ?>">Envíos</a><a href="<?php echo esc_url(home_url('/cambios-y-devoluciones/')); ?>">Cambios y devoluciones</a><a href="<?php echo esc_url(home_url('/preguntas-frecuentes/')); ?>">Preguntas frecuentes</a></div>
  <div><b>CONTACTO</b><a href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>">11 3640 3287</a><a href="mailto:silvafacu18@gmail.com.ar">silvafacu18@gmail.com.ar</a><span>José C. Paz, Buenos Aires</span></div>
  <aside><span>© <?php echo esc_html(date('Y')); ?> GRAVEDAD STORE</span><span>Diseño y desarrollo por <a href="https://ideamos.com.ar">IDEAMOS</a></span></aside>
</footer>
<div class="floating-actions" aria-label="Accesos rápidos">
  <button class="go-top" type="button" aria-label="Volver arriba">↑</button>
  <a class="floating-cart" href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/carrito/')); ?>" aria-label="Ver carrito"><span class="floating-cart-icon"><?php echo gravedad_icon('cart'); ?></span><span class="cart-count"><?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?></span></a>
  <a class="floating-wa" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>" target="_blank" rel="noopener" aria-label="Contactar por WhatsApp">WA</a>
</div>
<?php wp_footer(); ?></body></html>
