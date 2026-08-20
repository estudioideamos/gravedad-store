<?php if (!defined('ABSPATH')) { exit; } ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<div class="topbar">
  <div class="topbar-marquee"><div class="topbar-track">
  <?php for ($i = 0; $i < 2; $i++): ?>
    <span><?php echo esc_html(gravedad_option('gravedad_announcement','ENVÍOS A TODO EL PAÍS')); ?></span><i>★</i>
    <span><?php echo esc_html(gravedad_option('gravedad_promo','3 CUOTAS SIN INTERÉS EN PRODUCTOS SELECCIONADOS')); ?></span><i>★</i>
    <span>NUEVOS INGRESOS TODAS LAS SEMANAS</span><i>★</i>
    <span>RETIRÁ EN TIENDA SIN CARGO</span><i>★</i>
  <?php endfor; ?>
  </div></div>
  <a class="topbar-ig" href="<?php echo esc_url(gravedad_option('gravedad_instagram','https://www.instagram.com/gravedadstore')); ?>" target="_blank" rel="noopener">@GRAVEDADSTORE ↗</a>
</div>
<header class="site-header">
  <button class="menu-toggle" type="button" aria-label="Abrir menú" aria-expanded="false"><span></span><span></span></button>
  <?php if (has_custom_logo()): ?><div class="brand brand-custom"><?php the_custom_logo(); ?></div><?php else: ?>
  <a class="brand brand-image" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Gravedad Store"><img class="brand-logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store" width="1200" height="400"></a>
  <?php endif; ?>
  <form class="header-search" id="header-search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><span><?php echo gravedad_icon('search'); ?></span><input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Buscá cartas, juegos, colecciones..."><input type="hidden" name="post_type" value="product"></form>
  <div class="header-actions"><button class="mobile-search-toggle" type="button" aria-label="Buscar" aria-expanded="false" aria-controls="header-search-form"><?php echo gravedad_icon('search'); ?></button><a class="header-account" href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url()); ?>" aria-label="Mi cuenta"><?php echo gravedad_icon('user'); ?></a><a class="header-fav" href="<?php echo esc_url(home_url('/favoritos/')); ?>" aria-label="Favoritos"><?php echo gravedad_icon('heart'); ?><span class="fav-count" hidden>0</span></a><a class="header-cart" href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#'); ?>" aria-label="Carrito" aria-controls="cart-drawer" aria-expanded="false"><?php echo gravedad_icon('cart'); ?><span class="cart-count"><?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?></span></a></div>
</header>
<div class="nav-backdrop"></div>
<nav class="main-nav" aria-label="Navegación principal">
  <button class="nav-close" type="button" aria-label="Cerrar menú">×</button>
  <div class="nav-inner">
    <div class="nav-eyebrow"><span>Gravedad Store</span><span>TCG &amp; Juegos de mesa</span></div>
    <?php wp_nav_menu(array('theme_location'=>'primary','container'=>false,'fallback_cb'=>'gravedad_default_menu','depth'=>2)); ?>
    <div class="nav-footer">
      <div class="nav-quick">
        <a href="<?php echo esc_url(home_url('/favoritos/')); ?>" aria-label="Favoritos"><?php echo gravedad_icon('heart'); ?></a>
        <a href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/carrito/')); ?>" aria-label="Carrito"><?php echo gravedad_icon('cart'); ?></a>
        <a href="<?php echo esc_url(gravedad_option('gravedad_instagram','https://www.instagram.com/gravedadstore')); ?>" target="_blank" rel="noopener" aria-label="Instagram"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="2" y="2" width="20" height="20" rx="5"></rect><circle cx="12" cy="12" r="4.2"></circle><circle cx="17.4" cy="6.6" r="1"></circle></svg></a>
        <a href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>" target="_blank" rel="noopener" aria-label="WhatsApp"><?php echo gravedad_icon('whatsapp'); ?></a>
      </div>
      <p><?php echo esc_html(gravedad_option('gravedad_event_location','José C. Paz')); ?> <span>·</span> Desde 2024</p>
    </div>
  </div>
  <span class="nav-monogram" aria-hidden="true">G</span>
</nav>
