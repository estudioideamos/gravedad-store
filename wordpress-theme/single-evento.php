<?php
defined('ABSPATH') || exit;
get_header();
while (have_posts()): the_post();
$post_id = get_the_ID();
$fecha = get_post_meta($post_id, '_evento_fecha', true);
$ts = $fecha ? strtotime($fecha) : false;
$hora = gravedad_evento_meta($post_id, 'hora', '14:00 hs');
$ubicacion = gravedad_evento_meta($post_id, 'ubicacion', gravedad_option('gravedad_event_location', 'José C. Paz, Buenos Aires'));
$enlace = gravedad_evento_meta($post_id, 'enlace', '');
if (!$enlace) { $enlace = 'https://wa.me/' . gravedad_option('gravedad_whatsapp', '541136403287'); }
$flyer = get_the_post_thumbnail_url($post_id, 'large');
$meses = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
$fecha_larga = $ts ? date('d', $ts) . ' de ' . $meses[(int) date('n', $ts) - 1] . ' de ' . date('Y', $ts) : '';
?>
<main class="singles-page">
  <header class="singles-hero<?php echo $flyer ? ' has-image' : ''; ?>"<?php echo $flyer ? ' style="--hero:url(\'' . esc_url($flyer) . '\')"' : ''; ?>><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / <a href="<?php echo esc_url(home_url('/eventos/')); ?>">Eventos</a> / <?php the_title(); ?></nav><p class="section-label"><i class="label-dash"></i><?php echo $fecha_larga ? esc_html(mb_strtoupper($fecha_larga)) : 'EVENTO'; ?></p><h1><?php the_title(); ?></h1></div></header>
  <div class="content-shell info-shell evento-single">
    <?php if ($flyer): ?><div class="evento-single-flyer"><img src="<?php echo esc_url($flyer); ?>" alt="<?php the_title_attribute(); ?>"></div><?php endif; ?>
    <div class="evento-single-info">
      <ul class="evento-single-meta">
        <?php if ($fecha_larga): ?><li><?php echo gravedad_icon('clock'); ?><span><strong>Fecha</strong><?php echo esc_html(ucfirst($fecha_larga)); ?></span></li><?php endif; ?>
        <li><?php echo gravedad_icon('hourglass'); ?><span><strong>Hora</strong><?php echo esc_html($hora); ?></span></li>
        <li><?php echo gravedad_icon('pin'); ?><span><strong>Lugar</strong><?php echo esc_html($ubicacion); ?></span></li>
      </ul>
      <?php if (get_the_content()): ?><div class="evento-single-desc"><?php the_content(); ?></div><?php endif; ?>
      <a class="button primary" href="<?php echo esc_url($enlace); ?>" target="_blank" rel="noopener">Reservar mi lugar →</a>
    </div>
  </div>
</main>
<?php endwhile; get_footer(); ?>
