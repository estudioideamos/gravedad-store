<?php
defined('ABSPATH') || exit;
get_header();
$cc_def = gravedad_content_panel_definitions()['como-comprar'];
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-como-comprar.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Cómo comprar</nav><p class="section-label"><i class="label-dash"></i>ES MÁS FÁCIL DE LO QUE PENSÁS</p><h1>Cómo comprar.</h1><p>Cuatro pasos entre vos y tu próxima carta, sobre o juego de mesa.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-steps">
      <?php
        $steps_count = gravedad_content_panel_count('como-comprar', 'steps', count($cc_def['steps']));
        for ($n = 1; $n <= $steps_count; $n++):
        $default_step = isset($cc_def['steps'][$n - 1]) ? $cc_def['steps'][$n - 1] : array('titulo' => '', 'texto' => '');
        $titulo = gravedad_content_panel_opt('como-comprar', 'paso' . $n . '_titulo', $default_step['titulo']);
        $texto = gravedad_content_panel_opt('como-comprar', 'paso' . $n . '_texto', $default_step['texto']);
        if (!$titulo) { continue; }
      ?>
      <div class="info-step"><b><?php echo esc_html(sprintf('%02d', $n)); ?></b><h3><?php echo esc_html($titulo); ?></h3><p><?php echo esc_html($texto); ?></p></div>
      <?php endfor; ?>
    </div>
    <div class="faq-cta">
      <p>¿Tenés dudas antes de comprar?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
