<?php
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-preguntas-frecuentes.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Preguntas frecuentes</nav><p class="section-label"><i class="label-dash"></i>ESTAMOS PARA AYUDARTE</p><h1>Preguntas frecuentes.</h1><p>Todo lo que necesitás saber sobre pagos, envíos y cambios antes de tu próxima compra.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell faq-shell">
    <div class="editable-content">
      <?php while (have_posts()): the_post(); the_content(); endwhile; ?>
    </div>
    <div class="faq-cta">
      <p>¿No encontraste lo que buscabas?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
