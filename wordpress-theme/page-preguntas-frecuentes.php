<?php
defined('ABSPATH') || exit;
get_header();
$faq_def = gravedad_content_panel_definitions()['faq'];
$faq_group_icons = array('g1' => 'tag', 'g2' => 'truck', 'g3' => 'refresh', 'g4' => 'box');
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-preguntas-frecuentes.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Preguntas frecuentes</nav><p class="section-label"><i class="label-dash"></i>ESTAMOS PARA AYUDARTE</p><h1>Preguntas frecuentes.</h1><p>Todo lo que necesitás saber sobre pagos, envíos y cambios antes de tu próxima compra.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell faq-shell">
    <div class="faq-columns">
      <?php foreach ($faq_def['groups'] as $gkey => $group):
        $label = gravedad_content_panel_opt('faq', $gkey . '_label', $group['label']);
      ?>
      <section class="faq-group">
        <h2><?php echo gravedad_icon($faq_group_icons[$gkey]); ?><?php echo esc_html($label); ?></h2>
        <div class="faq-list">
          <?php foreach ($group['items'] as $i => $item): $n = $i + 1;
            $q = gravedad_content_panel_opt('faq', $gkey . '_q' . $n, $item['q']);
            $a = gravedad_content_panel_opt('faq', $gkey . '_a' . $n, $item['a']);
            if (!$q) { continue; }
          ?>
          <details class="faq-item">
            <summary><?php echo esc_html($q); ?><span class="faq-toggle">+</span></summary>
            <p><?php echo esc_html($a); ?></p>
          </details>
          <?php endforeach; ?>
        </div>
      </section>
      <?php endforeach; ?>
    </div>
    <div class="faq-cta">
      <p>¿No encontraste lo que buscabas?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','542320673750')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
