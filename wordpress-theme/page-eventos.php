<?php
defined('ABSPATH') || exit;
get_header();

function gravedad_evento_card($post_id) {
    $fecha = get_post_meta($post_id, '_evento_fecha', true);
    $ts = $fecha ? strtotime($fecha) : false;
    $hora = gravedad_evento_meta($post_id, 'hora', '14:00 hs');
    $ubicacion = gravedad_evento_meta($post_id, 'ubicacion', gravedad_option('gravedad_event_location', 'Roque Sáenz Peña 5086, José C. Paz, Buenos Aires'));
    $enlace = gravedad_evento_meta($post_id, 'enlace', '');
    if (!$enlace) { $enlace = get_permalink($post_id); }
    $flyer = get_the_post_thumbnail_url($post_id, 'medium_large');
    $meses = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');
    echo '<a class="evento-card" href="' . esc_url(get_permalink($post_id)) . '">';
    echo '<div class="evento-flyer">';
    if ($flyer) { echo '<img src="' . esc_url($flyer) . '" alt="" loading="lazy">'; } else { echo '<span class="evento-flyer-placeholder">' . gravedad_icon('dice') . '</span>'; }
    if ($ts) { echo '<span class="evento-date-badge"><b>' . esc_html(date('d', $ts)) . '</b><small>' . esc_html($meses[(int) date('n', $ts) - 1]) . '</small></span>'; }
    echo '</div>';
    echo '<div class="evento-body"><h3>' . esc_html(get_the_title($post_id)) . '</h3><p class="evento-meta"><span>' . gravedad_icon('pin') . ' ' . esc_html($ubicacion) . '</span><span>' . gravedad_icon('clock') . ' ' . esc_html($hora) . '</span></p>';
    $excerpt = get_the_excerpt($post_id);
    if ($excerpt) { echo '<p class="evento-excerpt">' . esc_html(wp_trim_words($excerpt, 16)) . '</p>'; }
    echo '<span class="evento-cta">Ver evento →</span></div></a>';
}

$today = date('Y-m-d');
$proximos = new WP_Query(array('post_type' => 'evento', 'post_status' => 'publish', 'posts_per_page' => -1, 'meta_key' => '_evento_fecha', 'orderby' => 'meta_value', 'order' => 'ASC', 'meta_query' => array(array('key' => '_evento_fecha', 'value' => $today, 'compare' => '>=', 'type' => 'DATE'))));
$pasados = new WP_Query(array('post_type' => 'evento', 'post_status' => 'publish', 'posts_per_page' => 12, 'meta_key' => '_evento_fecha', 'orderby' => 'meta_value', 'order' => 'DESC', 'meta_query' => array(array('key' => '_evento_fecha', 'value' => $today, 'compare' => '<', 'type' => 'DATE'))));
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-eventos.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Eventos</nav><p class="section-label"><i class="label-dash"></i>LA COMUNIDAD TAMBIÉN JUEGA</p><h1>Eventos.</h1><p>Torneos, lanzamientos y encuentros en nuestro local. Sumate.</p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="content-shell info-shell">
    <div class="info-block">
      <h2><?php echo gravedad_icon('clock'); ?>Próximos eventos</h2>
      <?php if ($proximos->have_posts()): ?>
      <div class="eventos-grid">
        <?php while ($proximos->have_posts()): $proximos->the_post(); gravedad_evento_card(get_the_ID()); endwhile; wp_reset_postdata(); ?>
      </div>
      <?php else: ?>
      <p class="evento-empty">Todavía no hay eventos programados. Seguinos en <a href="<?php echo esc_url(gravedad_option('gravedad_instagram', 'https://www.instagram.com/gravedadstore')); ?>" target="_blank" rel="noopener">Instagram</a> para enterarte apenas anunciemos el próximo.</p>
      <?php endif; ?>
    </div>
    <?php if ($pasados->have_posts()): ?>
    <div class="info-block">
      <h2><?php echo gravedad_icon('hourglass'); ?>Eventos anteriores</h2>
      <div class="eventos-grid eventos-grid--past">
        <?php while ($pasados->have_posts()): $pasados->the_post(); gravedad_evento_card(get_the_ID()); endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
    <?php endif; ?>
    <div class="faq-cta">
      <p>¿Querés organizar un torneo o evento con nosotros?</p>
      <a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp', '541136403287')); ?>">Escribinos por WhatsApp →</a>
    </div>
  </div>
</main>
<?php get_footer(); ?>
