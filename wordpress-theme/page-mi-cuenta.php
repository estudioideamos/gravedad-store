<?php
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Mi cuenta</nav><p class="section-label"><i class="label-dash"></i>TU ESPACIO PERSONAL</p><h1>Mi cuenta.</h1><p>Pedidos, direcciones y datos de tu cuenta, todo en un solo lugar.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell account-shell">
    <?php while (have_posts()): the_post(); the_content(); endwhile; ?>
  </div>
</main>
<?php get_footer(); ?>
