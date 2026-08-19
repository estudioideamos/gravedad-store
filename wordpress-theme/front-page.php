<?php get_header();
$uri = get_template_directory_uri();
$games = array(
 array('magic','Magic','logo-magic.svg'), array('pokemon','Pokémon','logo-pokemon.svg'), array('one-piece','One Piece','logo-onepiece.jpg'),
 array('digimon','Digimon','logo-digimon.png'), array('dragon-ball','Dragon Ball','logo-dragonball.png'), array('juegos-de-mesa','Juegos de mesa','')
); ?>
<main>
<section class="hero" style="--hero:url('<?php echo esc_url($uri.'/assets/img/hero-gravedad.png'); ?>')"><div class="hero-grid"></div><div class="hero-copy"><span class="eyebrow"><i></i> TODO TU UNIVERSO TCG</span><h1>Entrá en<br><em>otra dimensión.</em></h1><p>Cartas, juegos y accesorios para quienes no vienen solamente a jugar.</p><div><a class="button primary" href="<?php echo esc_url(gravedad_shop_url('novedades')); ?>">Explorar novedades →</a><a class="button ghost" href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">Ver cartas sueltas</a></div></div><span class="hero-scroll">DESLIZÁ PARA EXPLORAR</span></section>

<section class="game-picker"><p class="section-label"><b>01</b> ELEGÍ TU JUEGO</p><div class="games-grid">
<?php foreach ($games as $i=>$game): ?><a class="game-tile game-<?php echo esc_attr($i); ?>" href="<?php echo esc_url(gravedad_shop_url($game[0])); ?>">
  <?php if ($game[2]): ?><img class="game-logo <?php echo esc_attr($game[0]); ?>" src="<?php echo esc_url($uri.'/assets/img/'.$game[2]); ?>" alt="<?php echo esc_attr($game[1]); ?>"><?php else: ?><span class="dice-logo">⚄ ⚂</span><?php endif; ?><strong><?php echo esc_html($game[1]); ?></strong><b>→</b></a><?php endforeach; ?>
</div></section>

<section class="featured-products"><div class="section-head"><div><p class="section-label">RECIÉN LLEGADOS</p><h2>Novedades que<br><em>atraen miradas.</em></h2></div><a href="<?php echo esc_url(gravedad_shop_url()); ?>">VER TODOS LOS PRODUCTOS →</a></div>
<div class="product-cards">
<?php if (class_exists('WooCommerce')):
 $query = new WP_Query(array('post_type'=>'product','post_status'=>'publish','posts_per_page'=>4,'orderby'=>'date','order'=>'DESC'));
 if ($query->have_posts()): while ($query->have_posts()): $query->the_post(); $product=wc_get_product(get_the_ID()); ?>
 <article class="gravity-product"><a class="product-image" href="<?php the_permalink(); ?>"><?php echo $product->is_on_sale()?'<span>OFERTA</span>':'<span>NUEVO</span>'; echo $product->get_image('woocommerce_thumbnail'); ?></a><div><small><?php echo wp_kses_post(wc_get_product_category_list($product->get_id(), ', ')); ?></small><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><div class="product-price"><?php echo wp_kses_post($product->get_price_html()); ?><a class="plus" href="<?php echo esc_url($product->add_to_cart_url()); ?>" data-product_id="<?php echo esc_attr($product->get_id()); ?>">+</a></div></div></article>
 <?php endwhile; wp_reset_postdata(); else: gravedad_placeholder_products(); endif; else: gravedad_placeholder_products(); endif; ?>
</div></section>

<section class="feature-categories">
 <a href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>"><b>✦</b><div><small>MILES DE OPCIONES</small><h3>Cartas sueltas</h3><p>Buscá por juego, colección, rareza, idioma, condición y más.</p><strong>EXPLORAR →</strong></div></a>
 <a href="<?php echo esc_url(gravedad_shop_url('productos-sellados')); ?>"><b>◈</b><div><small>ABRÍ. JUGÁ. COLECCIONÁ.</small><h3>Productos sellados</h3><p>Sobres, booster boxes, bundles, mazos y ediciones especiales.</p><strong>EXPLORAR →</strong></div></a>
 <a href="<?php echo esc_url(gravedad_shop_url('juegos-de-mesa')); ?>"><b>⬡</b><div><small>PARA COMPARTIR LA MESA</small><h3>Juegos de mesa</h3><p>Estrategia, party games, cooperativos, familiares y mucho más.</p><strong>EXPLORAR →</strong></div></a>
</section>

<section class="event-section" id="eventos"><div class="event-visual"><div class="hero-grid"></div><time><?php $date=explode(' ',gravedad_option('gravedad_event_date','24 AGO')); ?><b><?php echo esc_html($date[0]); ?></b><span><?php echo esc_html($date[1]??'AGO'); ?></span></time><div class="event-card"><i></i><b>GRAVEDAD</b><small>STORE CHAMPIONSHIP</small></div></div><div class="event-copy"><p class="section-label">PRÓXIMO EVENTO</p><h2>La comunidad<br>también <em>juega.</em></h2><p>Vení a competir, intercambiar y compartir con otros jugadores. Torneos, lanzamientos y encuentros en nuestro local.</p><div class="event-meta">⌖ <?php echo esc_html(gravedad_option('gravedad_event_location','José C. Paz, Buenos Aires')); ?> · ◷ 14:00 hs</div><a class="button primary" href="https://wa.me/<?php echo esc_attr(gravedad_option('gravedad_whatsapp','541136403287')); ?>">Reservar mi lugar →</a></div></section>

<section class="benefits"><div><b>▱</b><span><strong>Envíos a todo el país</strong><small>Correo Argentino</small></span></div><div><b>◇</b><span><strong>Compra protegida</strong><small>Pagos seguros</small></span></div><div><b>◎</b><span><strong>Retiro en tienda</strong><small>Sin costo adicional</small></span></div><div><b>◫</b><span><strong>Atención personalizada</strong><small>Somos jugadores como vos</small></span></div></section>
</main>
<?php get_footer();
function gravedad_placeholder_products(){ $items=array('Magic · Booster Box','Pokémon · Elite Trainer Box','One Piece · Booster Box','Dragon Shield · Dual Matte'); foreach($items as $i=>$name){ echo '<article class="gravity-product placeholder"><a class="product-image"><span>'.($i===0?'PREVENTA':'NUEVO').'</span><i>GRAVEDAD<br><small>TRADING CARD GAME</small></i></a><div><small>PRODUCTO DESTACADO</small><h3>'.$name.'</h3><div class="product-price"><b>Próximamente</b></div></div></article>'; } }

