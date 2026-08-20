<?php
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-carrito.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Carrito</nav><p class="section-label"><i class="label-dash"></i>TU SELECCIÓN</p><h1>Carrito.</h1><p>Revisá tus productos antes de finalizar la compra.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell account-shell">
    <?php while (have_posts()): the_post(); the_content(); endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
