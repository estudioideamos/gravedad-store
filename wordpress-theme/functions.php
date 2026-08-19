<?php
if (!defined('ABSPATH')) { exit; }

define('GRAVEDAD_VERSION', '2.4.0');

function gravedad_icon($name) {
    $icons = array(
        'search' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'user' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
        'cart' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
        'truck' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="1" y="6" width="14" height="12"></rect><path d="M15 10h4l3 3v5h-7z"></path><circle cx="6" cy="20" r="2"></circle><circle cx="17.5" cy="20" r="2"></circle></svg>',
        'shield' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 4 5v6c0 5 3.4 8.7 8 10 4.6-1.3 8-5 8-10V5z"></path><path d="m9 12 2 2 4-4"></path></svg>',
        'refresh' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 0 1 15.4-6.4L21 8"></path><path d="M21 3v5h-5"></path><path d="M21 12a9 9 0 0 1-15.4 6.4L3 16"></path><path d="M3 21v-5h5"></path></svg>',
        'whatsapp' => '<svg viewBox="-23 -21 682 682.66669" fill="currentColor" fill-rule="evenodd"><path d="m544.386719 93.007812c-59.875-59.945312-139.503907-92.9726558-224.335938-93.007812-174.804687 0-317.070312 142.261719-317.140625 317.113281-.023437 55.894531 14.578125 110.457031 42.332032 158.550781l-44.992188 164.335938 168.121094-44.101562c46.324218 25.269531 98.476562 38.585937 151.550781 38.601562h.132813c174.785156 0 317.066406-142.273438 317.132812-317.132812.035156-84.742188-32.921875-164.417969-92.800781-224.359376zm-224.335938 487.933594h-.109375c-47.296875-.019531-93.683594-12.730468-134.160156-36.742187l-9.621094-5.714844-99.765625 26.171875 26.628907-97.269531-6.269532-9.972657c-26.386718-41.96875-40.320312-90.476562-40.296875-140.28125.054688-145.332031 118.304688-263.570312 263.699219-263.570312 70.40625.023438 136.589844 27.476562 186.355469 77.300781s77.15625 116.050781 77.132812 186.484375c-.0625 145.34375-118.304687 263.59375-263.59375 263.59375zm144.585938-197.417968c-7.921875-3.96875-46.882813-23.132813-54.148438-25.78125-7.257812-2.644532-12.546875-3.960938-17.824219 3.96875-5.285156 7.929687-20.46875 25.78125-25.09375 31.066406-4.625 5.289062-9.242187 5.953125-17.167968 1.984375-7.925782-3.964844-33.457032-12.335938-63.726563-39.332031-23.554687-21.011719-39.457031-46.960938-44.082031-54.890626-4.617188-7.9375-.039062-11.8125 3.476562-16.171874 8.578126-10.652344 17.167969-21.820313 19.808594-27.105469 2.644532-5.289063 1.320313-9.917969-.664062-13.882813-1.976563-3.964844-17.824219-42.96875-24.425782-58.839844-6.4375-15.445312-12.964843-13.359374-17.832031-13.601562-4.617187-.230469-9.902343-.277344-15.1875-.277344-5.28125 0-13.867187 1.980469-21.132812 9.917969-7.261719 7.933594-27.730469 27.101563-27.730469 66.105469s28.394531 76.683594 32.355469 81.972656c3.960937 5.289062 55.878906 85.328125 135.367187 119.648438 18.90625 8.171874 33.664063 13.042968 45.175782 16.695312 18.984374 6.03125 36.253906 5.179688 49.910156 3.140625 15.226562-2.277344 46.878906-19.171875 53.488281-37.679687 6.601563-18.511719 6.601563-34.375 4.617187-37.683594-1.976562-3.304688-7.261718-5.285156-15.183593-9.253906zm0 0"/></svg>',
    );
    return isset($icons[$name]) ? $icons[$name] : '';
}

function gravedad_setup() {
    load_theme_textdomain('gravedad-store', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array('height' => 120, 'width' => 420, 'flex-height' => true, 'flex-width' => true));
    add_theme_support('html5', array('search-form', 'gallery', 'caption', 'style', 'script'));
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    register_nav_menus(array('primary' => __('Menú principal', 'gravedad-store'), 'footer' => __('Menú del pie', 'gravedad-store')));
}
add_action('after_setup_theme', 'gravedad_setup');

function gravedad_assets() {
    wp_enqueue_style('gravedad-fonts', 'https://fonts.googleapis.com/css2?family=Passion+One:wght@400;700;900&family=Manrope:wght@400;500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('gravedad-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-commerce', get_template_directory_uri() . '/assets/css/commerce.css', array('gravedad-theme'), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-singles', get_template_directory_uri() . '/assets/css/singles.css', array('gravedad-commerce'), GRAVEDAD_VERSION);
    wp_enqueue_script('gravedad-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), GRAVEDAD_VERSION, true);
}
add_action('wp_enqueue_scripts', 'gravedad_assets');

function gravedad_uncropped_thumbnails($size) {
    $size['width'] = max((int) $size['width'], 640);
    $size['height'] = max((int) $size['height'], 640);
    $size['crop'] = 0;
    return $size;
}
add_filter('woocommerce_get_image_size_thumbnail', 'gravedad_uncropped_thumbnails');
add_filter('woocommerce_get_image_size_gallery_thumbnail', 'gravedad_uncropped_thumbnails');

function gravedad_favicon() {
    if (has_site_icon()) { return; }
    $uri = get_template_directory_uri();
    echo '<link rel="icon" href="' . esc_url($uri . '/assets/img/favicon.ico') . '" sizes="any">';
    echo '<link rel="icon" type="image/png" href="' . esc_url($uri . '/assets/img/favicon-32.png') . '" sizes="32x32">';
    echo '<link rel="icon" type="image/png" href="' . esc_url($uri . '/assets/img/favicon-192.png') . '" sizes="192x192">';
    echo '<link rel="apple-touch-icon" href="' . esc_url($uri . '/assets/img/apple-touch-icon.png') . '">';
}
add_action('wp_head', 'gravedad_favicon', 1);

function gravedad_customize($wp_customize) {
    $wp_customize->add_section('gravedad_store', array('title' => __('Gravedad Store', 'gravedad-store'), 'priority' => 30));
    $fields = array(
        'gravedad_announcement' => array('Aviso superior', 'ENVÍOS A TODO EL PAÍS'),
        'gravedad_promo' => array('Promoción superior', '3 CUOTAS SIN INTERÉS EN PRODUCTOS SELECCIONADOS'),
        'gravedad_whatsapp' => array('WhatsApp', '541136403287'),
        'gravedad_instagram' => array('Instagram', 'https://www.instagram.com/gravedadstore'),
        'gravedad_event_date' => array('Fecha del próximo evento', '24 AGO'),
        'gravedad_event_location' => array('Lugar del próximo evento', 'José C. Paz, Buenos Aires'),
    );
    foreach ($fields as $id => $field) {
        $wp_customize->add_setting($id, array('default' => $field[1], 'sanitize_callback' => 'sanitize_text_field'));
        $wp_customize->add_control($id, array('label' => __($field[0], 'gravedad-store'), 'section' => 'gravedad_store', 'type' => 'text'));
    }
}
add_action('customize_register', 'gravedad_customize');

function gravedad_option($key, $default = '') { return get_theme_mod($key, $default); }

function gravedad_shop_url($slug = '') {
    if (in_array($slug, array('novedades', 'ofertas'), true)) {
        $page = get_page_by_path($slug);
        if ($page) { return get_permalink($page); }
    }
    if (function_exists('wc_get_page_id')) {
        if ($slug) {
            $term = get_term_by('slug', $slug, 'product_cat');
            if ($term && !is_wp_error($term)) { return get_term_link($term); }
        }
        $shop = wc_get_page_permalink('shop');
        if ($shop) { return $shop; }
    }
    return home_url('/tienda/');
}

function gravedad_default_menu() {
    $tcg_games = array(
        'Magic: The Gathering' => 'magic', 'Pokémon' => 'pokemon', 'One Piece' => 'one-piece',
        'Digimon' => 'digimon', 'Dragon Ball' => 'dragon-ball', 'Otros TCG' => 'otros-tcg',
    );
    $editoriales = array('Devir' => 'devir', 'Buró' => 'buro', 'Popullar' => 'popullar', 'Otras editoriales' => 'otras-editoriales');
    $accesorio_tipos = array(
        'Folios / Sleeves' => 'folios-sleeves', 'Deck Boxes' => 'deck-boxes', 'Carpetas' => 'carpetas',
        'Playmats' => 'playmats', 'Dados y Contadores' => 'dados-y-contadores', 'Almacenamiento' => 'almacenamiento',
    );
    echo '<ul>';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Inicio</a></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('tcg')) . '">TCG</a><ul class="sub-menu">';
    foreach ($tcg_games as $label => $slug) { echo '<li><a href="' . esc_url(gravedad_shop_url($slug)) . '">' . esc_html($label) . '</a></li>'; }
    echo '</ul></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('cartas-sueltas')) . '">Cartas sueltas</a></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('juegos-de-mesa')) . '">Juegos de mesa</a><ul class="sub-menu">';
    foreach ($editoriales as $label => $slug) { echo '<li><a href="' . esc_url(gravedad_shop_url($slug)) . '">' . esc_html($label) . '</a></li>'; }
    echo '</ul></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('accesorios')) . '">Accesorios</a><ul class="sub-menu">';
    foreach ($accesorio_tipos as $label => $slug) { echo '<li><a href="' . esc_url(gravedad_shop_url($slug)) . '">' . esc_html($label) . '</a></li>'; }
    echo '</ul></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('preventas')) . '">Preventas</a></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('novedades')) . '">Novedades</a></li>';
    echo '<li><a href="' . esc_url(gravedad_shop_url('ofertas')) . '">Ofertas</a></li>';
    echo '<li><a href="' . esc_url(home_url('/#eventos')) . '">Eventos</a></li>';
    echo '</ul>';
}

function gravedad_cart_count_fragment($fragments) {
    ob_start(); ?>
    <span class="cart-count"><?php echo function_exists('WC') && WC()->cart ? esc_html(WC()->cart->get_cart_contents_count()) : '0'; ?></span>
    <?php $fragments['.cart-count'] = ob_get_clean(); return $fragments;
}
add_filter('woocommerce_add_to_cart_fragments', 'gravedad_cart_count_fragment');

function gravedad_widgets() {
    register_sidebar(array('name' => __('Filtros de tienda', 'gravedad-store'), 'id' => 'shop-filters', 'before_widget' => '<section class="shop-widget">', 'after_widget' => '</section>', 'before_title' => '<h3>', 'after_title' => '</h3>'));
}
add_action('widgets_init', 'gravedad_widgets');

function gravedad_ensure_woocommerce_pages() {
    if (!class_exists('WooCommerce')) { return; }
    $pages = array(
        'woocommerce_cart_page_id' => array('Carrito', 'carrito', '[woocommerce_cart]'),
        'woocommerce_checkout_page_id' => array('Finalizar compra', 'finalizar-compra', '[woocommerce_checkout]'),
        'woocommerce_myaccount_page_id' => array('Mi cuenta', 'mi-cuenta', '[woocommerce_my_account]'),
    );
    foreach ($pages as $option => $data) {
        $current = absint(get_option($option));
        if ($current && get_post_status($current)) { continue; }
        $existing = get_page_by_path($data[1]);
        $page_id = $existing ? $existing->ID : wp_insert_post(array(
            'post_title' => $data[0],
            'post_name' => $data[1],
            'post_content' => $data[2],
            'post_status' => 'publish',
            'post_type' => 'page',
        ));
        if ($page_id && !is_wp_error($page_id)) { update_option($option, $page_id); }
    }
}
add_action('after_switch_theme', 'gravedad_ensure_woocommerce_pages');

function gravedad_ensure_catalog_structure() {
    if (!class_exists('WooCommerce')) { return; }
    $categories = array(
        'cartas-sueltas' => array('Cartas sueltas', 0, 'Cartas individuales de TCG, filtrables por juego, colección, rareza, idioma, condición y acabado.'),
        'tcg' => array('TCG', 0, 'Sobres, booster boxes, bundles, mazos y ediciones especiales de tus juegos favoritos.'),
        'magic' => array('Magic: The Gathering', 'tcg', ''),
        'pokemon' => array('Pokémon', 'tcg', ''),
        'one-piece' => array('One Piece', 'tcg', ''),
        'digimon' => array('Digimon', 'tcg', ''),
        'dragon-ball' => array('Dragon Ball', 'tcg', ''),
        'otros-tcg' => array('Otros TCG', 'tcg', 'Espacio para nuevos juegos y líneas de TCG.'),
        'juegos-de-mesa' => array('Juegos de mesa', 0, 'Estrategia, party games, cooperativos, familiares y mucho más.'),
        'devir' => array('Devir', 'juegos-de-mesa', ''),
        'buro' => array('Buró', 'juegos-de-mesa', ''),
        'popullar' => array('Popullar', 'juegos-de-mesa', ''),
        'otras-editoriales' => array('Otras editoriales', 'juegos-de-mesa', ''),
        'accesorios' => array('Accesorios', 0, 'Sleeves, deck boxes, carpetas, playmats y todo lo necesario para jugar y proteger tus cartas.'),
        'folios-sleeves' => array('Folios / Sleeves', 'accesorios', ''),
        'deck-boxes' => array('Deck Boxes', 'accesorios', ''),
        'carpetas' => array('Carpetas', 'accesorios', ''),
        'playmats' => array('Playmats', 'accesorios', ''),
        'dados-y-contadores' => array('Dados y Contadores', 'accesorios', ''),
        'almacenamiento' => array('Almacenamiento', 'accesorios', ''),
        'otros-accesorios' => array('Otros accesorios', 'accesorios', ''),
        'preventas' => array('Preventas', 0, 'Próximos lanzamientos disponibles para reservar antes que se agoten.'),
    );
    foreach ($categories as $slug => $data) {
        if (term_exists($slug, 'product_cat')) { continue; }
        list($name, $parent_slug, $description) = $data;
        $parent_id = 0;
        if ($parent_slug) {
            $parent = get_term_by('slug', $parent_slug, 'product_cat');
            $parent_id = $parent && !is_wp_error($parent) ? $parent->term_id : 0;
        }
        wp_insert_term($name, 'product_cat', array('slug' => $slug, 'description' => $description, 'parent' => $parent_id));
    }
    foreach ($categories as $slug => $data) {
        $parent_slug = $data[1];
        if (!$parent_slug) { continue; }
        $term = get_term_by('slug', $slug, 'product_cat');
        $parent = get_term_by('slug', $parent_slug, 'product_cat');
        if ($term && $parent && !is_wp_error($term) && !is_wp_error($parent) && (int) $term->parent !== (int) $parent->term_id) {
            wp_update_term($term->term_id, 'product_cat', array('parent' => $parent->term_id));
        }
    }
    if (function_exists('wc_create_attribute') && function_exists('wc_attribute_taxonomy_id_by_name')) {
        $attributes = array(
            'juego' => 'Juego', 'coleccion' => 'Colección / Set', 'rareza' => 'Rareza',
            'color' => 'Color', 'tipo-carta' => 'Tipo', 'idioma' => 'Idioma',
            'condicion' => 'Condición', 'acabado' => 'Foil / Acabado',
            'tipo-producto' => 'Tipo de producto', 'editorial' => 'Editorial',
            'tipo-juego' => 'Tipo de juego', 'jugadores' => 'Cantidad de jugadores',
            'edad' => 'Edad recomendada', 'duracion' => 'Duración de partida',
            'dificultad' => 'Dificultad', 'tipo-accesorio' => 'Tipo de accesorio', 'marca' => 'Marca',
        );
        foreach ($attributes as $slug => $label) {
            if (!wc_attribute_taxonomy_id_by_name($slug)) {
                wc_create_attribute(array('name'=>$label,'slug'=>$slug,'type'=>'select','order_by'=>'name','has_archives'=>true));
            }
        }
    }
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'gravedad_ensure_catalog_structure');

function gravedad_ensure_catalog_pages() {
    $defs = array(
        'novedades' => array('Novedades', 'page-novedades.php'),
        'ofertas' => array('Ofertas', 'page-ofertas.php'),
    );
    foreach ($defs as $slug => $data) {
        list($title, $template) = $data;
        $existing = get_page_by_path($slug);
        $page_id = $existing ? $existing->ID : wp_insert_post(array(
            'post_title' => $title, 'post_name' => $slug, 'post_status' => 'publish', 'post_type' => 'page',
        ));
        if ($page_id && !is_wp_error($page_id)) { update_post_meta($page_id, '_wp_page_template', $template); }
    }
}
add_action('after_switch_theme', 'gravedad_ensure_catalog_pages');

function gravedad_run_theme_upgrades() {
    $installed = get_option('gravedad_theme_version', '0');
    if (version_compare($installed, GRAVEDAD_VERSION, '>=')) { return; }
    gravedad_ensure_woocommerce_pages();
    gravedad_ensure_catalog_structure();
    gravedad_ensure_catalog_pages();
    update_option('gravedad_theme_version', GRAVEDAD_VERSION);
}
add_action('admin_init', 'gravedad_run_theme_upgrades');

function gravedad_seed_filter_terms() {
    $groups = array(
        'pa_juego' => array('Magic: The Gathering','Pokémon','One Piece','Digimon','Dragon Ball','Otros'),
        'pa_rareza' => array('Común','Infrecuente','Rara','Mítica','Promo','Especial'),
        'pa_idioma' => array('Español','Inglés','Japonés','Portugués'),
        'pa_condicion' => array('Nueva','Near Mint','Excellent','Good','Played'),
        'pa_acabado' => array('Foil','No Foil','Reverse Holo','Holo'),
        'pa_tipo-producto' => array('Sobres','Booster Box','Bundles','Collector Booster','Mazos / Commander','Kits y colecciones','Starter Decks','Double Packs','Productos especiales'),
        'pa_editorial' => array('Devir','Buró','Popullar','Otras editoriales'),
        'pa_tipo-juego' => array('Familiares','Party Games','Estrategia','Cooperativos','Para 2 jugadores','Infantiles','Juegos de cartas','Rol / Aventura'),
        'pa_jugadores' => array('1 jugador','2 jugadores','3-4 jugadores','5 o más'),
        'pa_edad' => array('+3','+6','+8','+12','+14','+18'),
        'pa_duracion' => array('-30 min','30-60 min','60-90 min','+90 min'),
        'pa_dificultad' => array('Fácil','Media','Difícil'),
        'pa_tipo-accesorio' => array('Folios / Sleeves','Deck Boxes','Carpetas','Playmats','Dados y Contadores','Almacenamiento','Otros'),
        'pa_marca' => array('Dragon Shield','Ultra Pro','Ultimate Guard','KMC','Otras marcas'),
    );
    foreach ($groups as $taxonomy => $terms) {
        if (!taxonomy_exists($taxonomy)) { continue; }
        foreach ($terms as $term) { if (!term_exists($term, $taxonomy)) { wp_insert_term($term, $taxonomy); } }
    }
}
add_action('init', 'gravedad_seed_filter_terms', 30);

function gravedad_section_filters() {
    return array(
        'cartas-sueltas' => array(
            'f_juego' => array('Juego','pa_juego'), 'f_coleccion' => array('Colección / Set','pa_coleccion'),
            'f_rareza' => array('Rareza','pa_rareza'), 'f_color' => array('Color','pa_color'),
            'f_tipo_carta' => array('Tipo de carta','pa_tipo-carta'), 'f_idioma' => array('Idioma','pa_idioma'),
            'f_condicion' => array('Condición','pa_condicion'), 'f_acabado' => array('Foil / Acabado','pa_acabado'),
        ),
        'tcg' => array(
            'f_juego' => array('Juego','pa_juego'), 'f_tipo_producto' => array('Tipo de producto','pa_tipo-producto'),
            'f_coleccion' => array('Colección / Set','pa_coleccion'), 'f_idioma' => array('Idioma','pa_idioma'),
        ),
        'juegos-de-mesa' => array(
            'f_editorial' => array('Editorial','pa_editorial'), 'f_tipo_juego' => array('Tipo de juego','pa_tipo-juego'),
            'f_jugadores' => array('Cantidad de jugadores','pa_jugadores'), 'f_edad' => array('Edad recomendada','pa_edad'),
            'f_duracion' => array('Duración de partida','pa_duracion'), 'f_dificultad' => array('Dificultad','pa_dificultad'),
        ),
        'accesorios' => array(
            'f_tipo_accesorio' => array('Tipo de accesorio','pa_tipo-accesorio'), 'f_marca' => array('Marca','pa_marca'),
        ),
        'preventas' => array(
            'f_juego' => array('Juego','pa_juego'), 'f_editorial' => array('Editorial','pa_editorial'),
            'f_tipo_producto' => array('Tipo de producto','pa_tipo-producto'),
        ),
    );
}

function gravedad_section_for_term($term) {
    if (!$term) { return ''; }
    $known = array('cartas-sueltas', 'tcg', 'juegos-de-mesa', 'accesorios', 'preventas');
    if (in_array($term->slug, $known, true)) { return $term->slug; }
    foreach (get_ancestors($term->term_id, 'product_cat') as $ancestor_id) {
        $ancestor = get_term($ancestor_id, 'product_cat');
        if ($ancestor && !is_wp_error($ancestor) && in_array($ancestor->slug, $known, true)) { return $ancestor->slug; }
    }
    return '';
}

function gravedad_section_copy() {
    return array(
        'cartas-sueltas' => array('ENCONTRÁ ESA CARTA', 'Cartas sueltas.', 'Buscá entre todas las cartas disponibles y afiná los resultados hasta encontrar exactamente la que necesitás.', 'Nombre de la carta', 'Ej: Black Lotus'),
        'tcg' => array('TRADING CARD GAMES', 'Sellado y singles.', 'Sobres, booster boxes, bundles, mazos y ediciones especiales de tus juegos favoritos.', 'Buscar producto', 'Ej: Booster Box'),
        'juegos-de-mesa' => array('PARA COMPARTIR LA MESA', 'Juegos de mesa.', 'Estrategia, party games, cooperativos y familiares de las mejores editoriales.', 'Buscar juego', 'Ej: Catan'),
        'accesorios' => array('CUIDÁ TU COLECCIÓN', 'Accesorios.', 'Sleeves, deck boxes, carpetas, playmats y todo lo necesario para jugar y proteger tus cartas.', 'Buscar accesorio', 'Ej: Dragon Shield'),
        'preventas' => array('RESERVÁ EL TUYO', 'Preventas.', 'Próximos lanzamientos disponibles para reservar antes que se agoten.', 'Buscar preventa', 'Ej: nombre del producto'),
    );
}

function gravedad_filter_taxonomy_map() {
    $map = array();
    foreach (gravedad_section_filters() as $filters) {
        foreach ($filters as $param => $data) { $map[$param] = $data[1]; }
    }
    return $map;
}

function gravedad_catalog_tax_query_from_get() {
    $tax_query = array();
    foreach (gravedad_filter_taxonomy_map() as $param => $taxonomy) {
        if (!empty($_GET[$param]) && taxonomy_exists($taxonomy)) {
            $tax_query[] = array('taxonomy' => $taxonomy, 'field' => 'slug', 'terms' => sanitize_title(wp_unslash($_GET[$param])));
        }
    }
    if (count($tax_query) > 1) { $tax_query['relation'] = 'AND'; }
    return $tax_query;
}

function gravedad_catalog_meta_query_from_get() {
    $meta_query = array();
    $min = isset($_GET['precio_min']) ? floatval(wp_unslash($_GET['precio_min'])) : 0;
    $max = isset($_GET['precio_max']) ? floatval(wp_unslash($_GET['precio_max'])) : 0;
    if ($min && $max) { $meta_query[] = array('key' => '_price', 'value' => array($min, $max), 'compare' => 'BETWEEN', 'type' => 'NUMERIC'); }
    elseif ($min) { $meta_query[] = array('key' => '_price', 'value' => $min, 'compare' => '>=', 'type' => 'NUMERIC'); }
    elseif ($max) { $meta_query[] = array('key' => '_price', 'value' => $max, 'compare' => '<=', 'type' => 'NUMERIC'); }
    if (!empty($_GET['f_stock']) && in_array($_GET['f_stock'], array('instock', 'outofstock'), true)) {
        $meta_query[] = array('key' => '_stock_status', 'value' => sanitize_key($_GET['f_stock']));
    }
    return $meta_query;
}

function gravedad_apply_catalog_filters($query) {
    if (is_admin() || !$query->is_main_query() || !function_exists('is_product_taxonomy') || !is_product_taxonomy()) { return; }
    $tax_query = array_merge((array) $query->get('tax_query'), gravedad_catalog_tax_query_from_get());
    if (count($tax_query) > 1 && !isset($tax_query['relation'])) { $tax_query['relation'] = 'AND'; }
    if ($tax_query) { $query->set('tax_query', $tax_query); }
    $meta_query = array_merge((array) $query->get('meta_query'), gravedad_catalog_meta_query_from_get());
    if ($meta_query) { $query->set('meta_query', $meta_query); }
}
add_action('pre_get_posts', 'gravedad_apply_catalog_filters');

function gravedad_filter_terms($taxonomy) {
    if (!taxonomy_exists($taxonomy)) { return array(); }
    $terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => true, 'orderby' => 'name'));
    return is_wp_error($terms) ? array() : $terms;
}

function gravedad_render_product_grid($query) {
    echo '<div class="woocommerce">';
    if ($query->have_posts()) {
        echo '<ul class="products columns-4">';
        while ($query->have_posts()) { $query->the_post(); wc_get_template_part('content', 'product'); }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        do_action('woocommerce_no_products_found');
    }
    echo '</div>';
}

function gravedad_single_product_badge() {
    global $product;
    if (!$product) { return; }
    if ($product->is_on_sale()) { echo '<span class="single-badge single-badge-sale">OFERTA</span>'; }
    elseif ((time() - strtotime(get_the_date('c'))) < 30 * DAY_IN_SECONDS) { echo '<span class="single-badge">NUEVO</span>'; }
}
add_action('woocommerce_before_single_product_summary', 'gravedad_single_product_badge', 5);

function gravedad_single_product_trust_badges() {
    echo '<ul class="trust-badges">';
    echo '<li>' . gravedad_icon('truck') . '<span><strong>Envío a todo el país</strong><small>Correo Argentino</small></span></li>';
    echo '<li>' . gravedad_icon('shield') . '<span><strong>Pago protegido</strong><small>Mercado Pago y tarjetas</small></span></li>';
    echo '<li>' . gravedad_icon('refresh') . '<span><strong>Cambios sin drama</strong><small>Hasta 10 días</small></span></li>';
    echo '</ul>';
}
add_action('woocommerce_single_product_summary', 'gravedad_single_product_trust_badges', 31);

add_filter('woocommerce_output_related_products_args', function ($args) {
    $args['posts_per_page'] = 10;
    return $args;
});

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
