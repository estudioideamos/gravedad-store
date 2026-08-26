<?php
defined('ABSPATH') || exit;
get_header();
$cam_def = gravedad_content_panel_definitions()['cambios'];
$cond_iconos_ciclo = array('hourglass', 'tag', 'refresh', 'hourglass', 'tag', 'refresh');
$bloque_iconos_ciclo = array('shield', 'headset', 'shield', 'headset');
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-cambios-y-devoluciones.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Cambios y devoluciones</nav><p class="section-label"><i class="label-dash"></i>COMPRÁ SIN VUELTAS</p><h1>Cambios y<br>devoluciones.</h1><p>Si algo no salió como esperabas, te ayudamos a resolverlo.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-steps">
      <?php
        $cond_count = gravedad_content_panel_count('cambios', 'condiciones', count($cam_def['condiciones']));
        for ($n = 1; $n <= $cond_count; $n++):
        $default_cond = isset($cam_def['condiciones'][$n - 1]) ? $cam_def['condiciones'][$n - 1] : array('titulo' => '', 'texto' => '');
        $titulo = gravedad_content_panel_opt('cambios', 'cond' . $n . '_titulo', $default_cond['titulo']);
        $texto = gravedad_content_panel_opt('cambios', 'cond' . $n . '_texto', $default_cond['texto']);
        if (!$titulo) { continue; }
      ?>
      <div class="info-step"><span class="step-icon"><?php echo gravedad_icon($cond_iconos_ciclo[($n - 1) % count($cond_iconos_ciclo)]); ?></span><h3><?php echo esc_html($titulo); ?></h3><p><?php echo esc_html($texto); ?></p></div>
      <?php endfor; ?>
    </div>
    <?php
      $bloques_count = gravedad_content_panel_count('cambios', 'bloques', count($cam_def['bloques']));
      for ($n = 1; $n <= $bloques_count; $n++):
      $default_bloque = isset($cam_def['bloques'][$n - 1]) ? $cam_def['bloques'][$n - 1] : array('titulo' => '', 'texto' => '');
      $titulo = gravedad_content_panel_opt('cambios', 'bloque' . $n . '_titulo', $default_bloque['titulo']);
      $texto = gravedad_content_panel_opt('cambios', 'bloque' . $n . '_texto', $default_bloque['texto']);
      if (!$titulo) { continue; }
      $lineas = array_filter(array_map('trim', explode("\n", $texto)));
    ?>
    <div class="info-block">
      <h2><?php echo gravedad_icon($bloque_iconos_ciclo[($n - 1) % count($bloque_iconos_ciclo)]); ?><?php echo esc_html($titulo); ?></h2>
      <?php if (count($lineas) > 1): ?>
      <ul><?php foreach ($lineas as $linea): ?><li><?php echo esc_html($linea); ?></li><?php endforeach; ?></ul>
      <?php else: ?>
      <p><?php echo esc_html($texto); ?></p>
      <?php endif; ?>
    </div>
    <?php endfor; ?>
    <div class="faq-cta">
      <p>¿Necesitás gestionar un cambio?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
