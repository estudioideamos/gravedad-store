<?php
defined('ABSPATH') || exit;
get_header();
$env_def = gravedad_content_panel_definitions()['envios'];
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-envios.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Envíos</nav><p class="section-label"><i class="label-dash"></i>A TODO EL PAÍS</p><h1>Envíos.</h1><p>Enviamos por Correo Argentino con el embalaje cuidado que tus cartas se merecen.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-steps">
      <?php
        $zonas_count = gravedad_content_panel_count('envios', 'zonas', count($env_def['zonas']));
        $zona_iconos_ciclo = array('truck', 'box', 'store', 'truck', 'box', 'store');
        for ($n = 1; $n <= $zonas_count; $n++):
        $default_zona = isset($env_def['zonas'][$n - 1]) ? $env_def['zonas'][$n - 1] : array('nombre' => '', 'tiempo' => '', 'costo' => '');
        $nombre = gravedad_content_panel_opt('envios', 'zona' . $n . '_nombre', $default_zona['nombre']);
        $tiempo = gravedad_content_panel_opt('envios', 'zona' . $n . '_tiempo', $default_zona['tiempo']);
        $costo = gravedad_content_panel_opt('envios', 'zona' . $n . '_costo', $default_zona['costo']);
        if (!$nombre) { continue; }
      ?>
      <div class="info-step"><span class="step-icon"><?php echo gravedad_icon($zona_iconos_ciclo[($n - 1) % count($zona_iconos_ciclo)]); ?></span><h3><?php echo esc_html($nombre); ?></h3><p><?php echo esc_html($tiempo); ?><br><b class="step-highlight"><?php echo esc_html($costo); ?></b></p></div>
      <?php endfor; ?>
    </div>
    <p class="info-note">El costo final y el tiempo estimado se confirman al finalizar la compra, según tu código postal.</p>
    <?php
      $bloques_count = gravedad_content_panel_count('envios', 'bloques', count($env_def['bloques']));
      $bloque_iconos_ciclo = array('clock', 'shield', 'clock', 'shield');
      for ($n = 1; $n <= $bloques_count; $n++):
      $default_bloque = isset($env_def['bloques'][$n - 1]) ? $env_def['bloques'][$n - 1] : array('titulo' => '', 'texto' => '');
      $titulo = gravedad_content_panel_opt('envios', 'bloque' . $n . '_titulo', $default_bloque['titulo']);
      $texto = gravedad_content_panel_opt('envios', 'bloque' . $n . '_texto', $default_bloque['texto']);
      if (!$titulo) { continue; }
      $lineas = array_filter(array_map('trim', explode("\n", $texto)));
    ?>
    <div class="info-block">
      <h2><?php echo gravedad_icon($bloque_iconos_ciclo[($n - 1) % count($bloque_iconos_ciclo)]); ?><?php echo esc_html($titulo); ?></h2>
      <?php if (count($lineas) > 1): ?>
      <ul><?php foreach ($lineas as $linea): $partes = explode(':', $linea, 2); ?>
        <li><?php if (count($partes) === 2): ?><b><?php echo esc_html(trim($partes[0])); ?>:</b><?php echo esc_html($partes[1]); ?><?php else: ?><?php echo esc_html($linea); ?><?php endif; ?></li>
      <?php endforeach; ?></ul>
      <?php else: ?>
      <p><?php echo esc_html($texto); ?></p>
      <?php endif; ?>
    </div>
    <?php endfor; ?>
    <div class="faq-cta">
      <p>¿Necesitás ayuda con tu envío?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
