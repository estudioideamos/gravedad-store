<?php
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-como-comprar.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Cómo comprar</nav><p class="section-label"><i class="label-dash"></i>ES MÁS FÁCIL DE LO QUE PENSÁS</p><h1>Cómo comprar.</h1><p>Cuatro pasos entre vos y tu próxima carta, sobre o juego de mesa.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="editable-content">
      <?php while (have_posts()): the_post(); the_content(); endwhile; ?>
    </div>
    <div class="faq-cta">
      <p>¿Tenés dudas antes de comprar?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
