<?php
defined('ABSPATH') || exit;
get_header();
while (have_posts()): the_post();
$post_id = get_the_ID();
$fecha = get_post_meta($post_id, '_evento_fecha', true);
$ts = $fecha ? strtotime($fecha) : false;
$hora = gravedad_evento_meta($post_id, 'hora', '14:00 hs');
$ubicacion = gravedad_evento_meta($post_id, 'ubicacion', gravedad_option('gravedad_event_location', 'Roque Sáenz Peña 5086, José C. Paz, Buenos Aires'));
$enlace = gravedad_evento_meta($post_id, 'enlace', '');
if (!$enlace) { $enlace = 'https://wa.me/' . gravedad_option('gravedad_whatsapp', '542320673750'); }
$flyer = get_the_post_thumbnail_url($post_id, 'large');
$meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
$meses_cortos = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');
$fecha_larga = $ts ? date('d', $ts) . ' de ' . $meses[(int) date('n', $ts) - 1] . ' de ' . date('Y', $ts) : '';
$dias_restantes = $ts ? ceil((strtotime(date('Y-m-d', $ts)) - strtotime(date('Y-m-d'))) / 86400) : null;
?>
<main class="singles-page">
  <header class="singles-hero<?php echo $flyer ? ' has-image' : ''; ?>"<?php echo $flyer ? ' style="--hero:url(\'' . esc_url($flyer) . '\')"' : ''; ?>><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / <a href="<?php echo esc_url(home_url('/eventos/')); ?>">Eventos</a> / <?php the_title(); ?></nav><p class="section-label"><i class="label-dash"></i><?php echo $fecha_larga ? esc_html(mb_strtoupper($fecha_larga)) : 'EVENTO'; ?></p><h1><?php the_title(); ?></h1></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell evento-single">
    <div class="evento-single-flyer-wrap">
      <?php if ($flyer): ?>
      <div class="evento-single-flyer">
        <img src="<?php echo esc_url($flyer); ?>" alt="<?php the_title_attribute(); ?>" fetchpriority="high" decoding="async">
        <?php if ($ts): ?><span class="evento-single-badge"><b><?php echo esc_html(date('d', $ts)); ?></b><small><?php echo esc_html($meses_cortos[(int) date('n', $ts) - 1]); ?></small></span><?php endif; ?>
      </div>
      <?php endif; ?>
      <?php if ($dias_restantes !== null && $dias_restantes >= 0): ?>
      <p class="evento-countdown"><?php echo gravedad_icon('hourglass'); ?> <?php echo $dias_restantes == 0 ? '¡Es hoy!' : ($dias_restantes == 1 ? 'Falta 1 día' : 'Faltan ' . esc_html($dias_restantes) . ' días'); ?></p>
      <?php endif; ?>
    </div>
    <div class="evento-single-info">
      <div class="evento-single-chips">
        <?php if ($fecha_larga): ?><div class="evento-chip"><span class="step-icon"><?php echo gravedad_icon('clock'); ?></span><div><strong>Fecha</strong><span><?php echo esc_html(ucfirst($fecha_larga)); ?></span></div></div><?php endif; ?>
        <div class="evento-chip"><span class="step-icon"><?php echo gravedad_icon('hourglass'); ?></span><div><strong>Hora</strong><span><?php echo esc_html($hora); ?></span></div></div>
        <div class="evento-chip"><span class="step-icon"><?php echo gravedad_icon('pin'); ?></span><div><strong>Lugar</strong><span><?php echo esc_html($ubicacion); ?></span></div></div>
      </div>
      <?php if (get_the_content()): ?><div class="evento-single-desc"><i class="label-dash"></i><?php the_content(); ?></div><?php endif; ?>
      <a class="button primary evento-single-cta" href="<?php echo esc_url($enlace); ?>" target="_blank" rel="noopener">Reservar mi lugar →</a>
      <p class="evento-single-share">¿Vas a venir? Etiquetanos en Instagram <a href="<?php echo esc_url(gravedad_option('gravedad_instagram', 'https://www.instagram.com/gravedadstore')); ?>" target="_blank" rel="noopener">@gravedadstore</a></p>
    </div>
  </div>
</main>
<?php endwhile; get_footer(); ?>
