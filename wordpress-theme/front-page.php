<?php get_header();
$uri = get_template_directory_uri();
$games = array(
 array('magic','Magic','logo-magic.png'), array('pokemon','Pokémon','logo-pokemon.svg'), array('one-piece','One Piece','logo-onepiece.jpg'),
 array('digimon','Digimon','logo-digimon.png'), array('dragon-ball','Dragon Ball','logo-dragonball.png'), array('yu-gi-oh','Yu-Gi-Oh!','logo-yugioh.png'),
 array('juegos-de-mesa','Juegos de mesa','')
); ?>
<main>
<section class="hero" style="--hero:url('<?php echo esc_url($uri.'/assets/img/hero-gravedad.jpg'); ?>')"><video class="hero-video" autoplay muted loop playsinline poster="<?php echo esc_url($uri.'/assets/img/hero-gravedad.jpg'); ?>"><source src="<?php echo esc_url($uri.'/assets/img/video/hero-loop.mp4'); ?>" type="video/mp4"></video><div class="hero-video-overlay"></div><div class="hero-grid"></div><div class="hero-copy"><span class="eyebrow"><i></i> TODO TU UNIVERSO TCG</span><h1>Entrá en<br><em>otra dimensión.</em></h1><p>Cartas, juegos y accesorios para quienes no vienen solamente a jugar.</p><div><a class="button primary" href="<?php echo esc_url(gravedad_shop_url('novedades')); ?>">Explorar novedades →</a><a class="button ghost" href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">Ver cartas sueltas</a></div></div><span class="hero-scroll">DESLIZÁ PARA EXPLORAR</span></section>
<div class="hero-tear"></div>

<section class="game-picker"><p class="section-label"><b>01</b> ELEGÍ TU JUEGO</p><div class="games-grid">
<?php foreach ($games as $i=>$game): ?><a class="game-tile game-<?php echo esc_attr($i); ?>" href="<?php echo esc_url(gravedad_shop_url($game[0])); ?>">
  <?php if ($game[2]): ?><img class="game-logo <?php echo esc_attr($game[0]); ?>" src="<?php echo esc_url($uri.'/assets/img/'.$game[2]); ?>" alt="<?php echo esc_attr($game[1]); ?>"><?php else: ?><span class="dice-logo"><?php echo gravedad_icon('dice'); ?></span><?php endif; ?><strong><?php echo esc_html($game[1]); ?></strong><b>→</b></a><?php endforeach; ?>
</div></section>

<?php
gravedad_home_carousel('RECIÉN LLEGADOS', 'Novedades que<br><em>atraen miradas.</em>', 'Los últimos ingresos a la tienda, antes que nadie.', array('posts_per_page' => 12), gravedad_shop_url('novedades'), 'novedades');
gravedad_home_carousel('MILES DE OPCIONES', 'Cartas sueltas<br><em>para tu mazo.</em>', 'Cartas individuales disponibles, filtrables por juego, rareza e idioma.', array('tax_query' => array(array('taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => 'cartas-sueltas'))), gravedad_shop_url('cartas-sueltas'), '', array('f_juego' => array('Juego', 'pa_juego'), 'f_rareza' => array('Rareza', 'pa_rareza'), 'f_idioma' => array('Idioma', 'pa_idioma')));
gravedad_home_carousel('ABRÍ. JUGÁ. COLECCIONÁ.', 'Sellado para<br><em>abrir ahora.</em>', 'Booster Box, sobres, mazos, kits y bundles de tus juegos favoritos.', array('tax_query' => array(array('taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => 'tcg'))), gravedad_shop_url('tcg'), '', array('f_juego' => array('Juego', 'pa_juego'), 'f_tipo_producto' => array('Tipo de producto', 'pa_tipo-producto')));
gravedad_home_carousel('PARA COMPARTIR LA MESA', 'Juegos para<br><em>compartir.</em>', 'Selección de Devir, Buró, Popullar y otras editoriales.', array('tax_query' => array(array('taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => 'juegos-de-mesa'))), gravedad_shop_url('juegos-de-mesa'), '', array('f_editorial' => array('Editorial', 'pa_editorial'), 'f_tipo_juego' => array('Tipo de juego', 'pa_tipo-juego')));
?>

<?php
$next_event = new WP_Query(array('post_type' => 'evento', 'post_status' => 'publish', 'posts_per_page' => 1, 'meta_key' => '_evento_fecha', 'orderby' => 'meta_value', 'order' => 'ASC', 'meta_query' => array(array('key' => '_evento_fecha', 'value' => date('Y-m-d'), 'compare' => '>=', 'type' => 'DATE'))));
$meses_evt = array('ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC');
if ($next_event->have_posts()):
  $next_event->the_post();
  $evt_id = get_the_ID();
  $evt_ts = strtotime(get_post_meta($evt_id, '_evento_fecha', true));
  $evt_flyer = get_the_post_thumbnail_url($evt_id, 'large');
  $evt_hora = gravedad_evento_meta($evt_id, 'hora', '14:00 hs');
  $evt_ubicacion = gravedad_evento_meta($evt_id, 'ubicacion', gravedad_option('gravedad_event_location', 'Roque Sáenz Peña 5086, José C. Paz, Buenos Aires'));
  $evt_link = get_permalink($evt_id);
?>
<section class="event-section" id="eventos"><div class="event-visual"><div class="hero-grid"></div><time><b><?php echo esc_html(date('d', $evt_ts)); ?></b><span><?php echo esc_html($meses_evt[(int) date('n', $evt_ts) - 1]); ?></span></time><?php if ($evt_flyer): ?><a class="event-card event-card-flyer" href="<?php echo esc_url($evt_link); ?>"><img src="<?php echo esc_url($evt_flyer); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" decoding="async"></a><?php else: ?><a class="event-card" href="<?php echo esc_url($evt_link); ?>"><i></i><b>GRAVEDAD</b><small><?php the_title(); ?></small></a><?php endif; ?></div><div class="event-copy"><p class="section-label">PRÓXIMO EVENTO</p><h2><a href="<?php echo esc_url($evt_link); ?>"><?php the_title(); ?></a></h2><?php if (get_the_excerpt()): ?><p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 24)); ?></p><?php endif; ?><div class="event-meta"><?php echo gravedad_icon('pin'); ?> <?php echo esc_html($evt_ubicacion); ?> · <?php echo gravedad_icon('clock'); ?> <?php echo esc_html($evt_hora); ?></div><div class="event-actions"><a class="button primary" href="<?php echo esc_url($evt_link); ?>">Ver evento →</a><a class="event-all-link" href="<?php echo esc_url(home_url('/eventos/')); ?>">Ver todos los eventos</a></div></div></section>
<?php
  wp_reset_postdata();
else:
?>
<section class="event-section" id="eventos"><div class="event-visual"><div class="hero-grid"></div><div class="event-card"><i></i><b>GRAVEDAD</b><small>STORE CHAMPIONSHIP</small></div></div><div class="event-copy"><p class="section-label">EVENTOS</p><h2>La comunidad<br>también <em>juega.</em></h2><p>Vení a competir, intercambiar y compartir con otros jugadores. Torneos, lanzamientos y encuentros en nuestro local.</p><div class="event-actions"><a class="button primary" href="<?php echo esc_url(home_url('/eventos/')); ?>">Ver eventos →</a></div></div></section>
<?php endif; ?>

<?php
gravedad_home_carousel('RESERVÁ EL TUYO', 'Reservá antes<br><em>que se agote.</em>', 'Próximos lanzamientos disponibles para reservar.', array('tax_query' => array(array('taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => 'preventas'))), gravedad_shop_url('preventas'), '', array('f_juego' => array('Juego', 'pa_juego')));
$sale_ids = function_exists('wc_get_product_ids_on_sale') ? wc_get_product_ids_on_sale() : array();
if ($sale_ids) { gravedad_home_carousel('NO TE LO PIERDAS', 'Precios que<br><em>no vuelven.</em>', 'Productos con promociones y precios especiales.', array('post__in' => $sale_ids), gravedad_shop_url('ofertas')); }
?>

<section class="benefits"><div><b><?php echo gravedad_icon('truck'); ?></b><span><strong>Envíos a todo el país</strong><small>Correo Argentino</small></span></div><div><b><?php echo gravedad_icon('shield'); ?></b><span><strong>Compra protegida</strong><small>Pagos seguros</small></span></div><div><b><?php echo gravedad_icon('store'); ?></b><span><strong>Retiro en tienda</strong><small>Sin costo adicional</small></span></div><div><b><?php echo gravedad_icon('headset'); ?></b><span><strong>Atención personalizada</strong><small>Somos jugadores como vos</small></span></div></section>
</main>
<?php get_footer();
function gravedad_placeholder_products(){ $items=array('Magic · Booster Box','Pokémon · Elite Trainer Box','One Piece · Booster Box','Dragon Shield · Dual Matte'); foreach($items as $i=>$name){ echo '<article class="gravity-product placeholder"><a class="product-image"><span'.($i===0?'':' class="is-new"').'>'.($i===0?'PREVENTA':'NUEVO').'</span><i>GRAVEDAD<br><small>TRADING CARD GAME</small></i></a><div><small>PRODUCTO DESTACADO</small><h3>'.$name.'</h3><div class="product-price"><b>Próximamente</b></div></div></article>'; } }
