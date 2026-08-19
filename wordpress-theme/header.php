<?php if (!defined('ABSPATH')) { exit; } ?><!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<div class="topbar"><span><?php echo esc_html(gravedad_option('gravedad_announcement','ENVÍOS A TODO EL PAÍS')); ?></span><span><?php echo esc_html(gravedad_option('gravedad_promo','3 CUOTAS SIN INTERÉS EN PRODUCTOS SELECCIONADOS')); ?></span><a href="<?php echo esc_url(gravedad_option('gravedad_instagram','https://www.instagram.com/gravedadstore')); ?>" target="_blank" rel="noopener">@GRAVEDADSTORE ↗</a></div>
<header class="site-header">
  <button class="menu-toggle" type="button" aria-label="Abrir menú" aria-expanded="false"><i></i><i></i></button>
  <?php if (has_custom_logo()): ?><div class="brand brand-custom"><?php the_custom_logo(); ?></div><?php else: ?>
  <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Gravedad Store"><i class="brand-orbit"></i><strong>GRAVEDAD</strong><small>STORE</small></a>
  <?php endif; ?>
  <form class="header-search" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>"><span>⌕</span><input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Buscá cartas, juegos, colecciones..."><input type="hidden" name="post_type" value="product"></form>
  <div class="header-actions"><a href="<?php echo esc_url(function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : wp_login_url()); ?>" aria-label="Mi cuenta">♙</a><a class="header-cart" href="<?php echo esc_url(function_exists('wc_get_cart_url') ? wc_get_cart_url() : '#'); ?>" aria-label="Carrito">▱<span class="cart-count"><?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?></span></a></div>
</header>
<nav class="main-nav" aria-label="Navegación principal">
<?php wp_nav_menu(array('theme_location'=>'primary','container'=>false,'fallback_cb'=>'gravedad_default_menu','depth'=>2)); ?>
</nav>
