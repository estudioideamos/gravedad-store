<?php
if (!defined('ABSPATH')) { exit; }

define('GRAVEDAD_VERSION', '1.3.0');

function gravedad_icon($name) {
    $icons = array(
        'search' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        'user' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>',
        'cart' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>',
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
    wp_enqueue_style('gravedad-fonts', 'https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,500;0,600;0,700;1,700&family=Manrope:wght@400;500;600;700;800&display=swap', array(), null);
    wp_enqueue_style('gravedad-theme', get_template_directory_uri() . '/assets/css/theme.css', array(), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-commerce', get_template_directory_uri() . '/assets/css/commerce.css', array('gravedad-theme'), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-singles', get_template_directory_uri() . '/assets/css/singles.css', array('gravedad-commerce'), GRAVEDAD_VERSION);
    wp_enqueue_script('gravedad-theme', get_template_directory_uri() . '/assets/js/theme.js', array(), GRAVEDAD_VERSION, true);
}
add_action('wp_enqueue_scripts', 'gravedad_assets');

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
    $items = array(
        'TCG' => gravedad_shop_url('tcg'),
        'Cartas sueltas' => gravedad_shop_url('cartas-sueltas'),
        'Juegos de mesa' => gravedad_shop_url('juegos-de-mesa'),
        'Accesorios' => gravedad_shop_url('accesorios'),
        'Preventas' => gravedad_shop_url('preventas'),
        'Novedades' => gravedad_shop_url('novedades'),
        'Ofertas' => gravedad_shop_url('ofertas'),
        'Eventos' => home_url('/#eventos'),
    );
    echo '<ul>';
    foreach ($items as $label => $url) { echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>'; }
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

function gravedad_ensure_single_card_structure() {
    if (!class_exists('WooCommerce')) { return; }
    if (!term_exists('cartas-sueltas', 'product_cat')) {
        wp_insert_term('Cartas sueltas', 'product_cat', array(
            'slug' => 'cartas-sueltas',
            'description' => 'Cartas individuales de TCG, filtrables por juego, colección, rareza, idioma, condición y acabado.',
        ));
    }
    if (function_exists('wc_create_attribute') && function_exists('wc_attribute_taxonomy_id_by_name')) {
        $attributes = array(
            'juego' => 'Juego', 'coleccion' => 'Colección / Set', 'rareza' => 'Rareza',
            'color' => 'Color', 'tipo-carta' => 'Tipo', 'idioma' => 'Idioma',
            'condicion' => 'Condición', 'acabado' => 'Foil / Acabado',
        );
        foreach ($attributes as $slug => $label) {
            if (!wc_attribute_taxonomy_id_by_name($slug)) {
                wc_create_attribute(array('name'=>$label,'slug'=>$slug,'type'=>'select','order_by'=>'name','has_archives'=>true));
            }
        }
    }
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'gravedad_ensure_single_card_structure');

function gravedad_run_theme_upgrades() {
    $installed = get_option('gravedad_theme_version', '0');
    if (version_compare($installed, GRAVEDAD_VERSION, '>=')) { return; }
    gravedad_ensure_woocommerce_pages();
    gravedad_ensure_single_card_structure();
    update_option('gravedad_theme_version', GRAVEDAD_VERSION);
}
add_action('admin_init', 'gravedad_run_theme_upgrades');

function gravedad_seed_card_filter_terms() {
    $groups = array(
        'pa_juego' => array('Magic: The Gathering','Pokémon','One Piece','Digimon','Dragon Ball','Otros'),
        'pa_rareza' => array('Común','Infrecuente','Rara','Mítica','Promo','Especial'),
        'pa_idioma' => array('Español','Inglés','Japonés','Portugués'),
        'pa_condicion' => array('Nueva','Near Mint','Excellent','Good','Played'),
        'pa_acabado' => array('Foil','No Foil','Reverse Holo','Holo'),
    );
    foreach ($groups as $taxonomy => $terms) {
        if (!taxonomy_exists($taxonomy)) { continue; }
        foreach ($terms as $term) { if (!term_exists($term, $taxonomy)) { wp_insert_term($term, $taxonomy); } }
    }
}
add_action('init', 'gravedad_seed_card_filter_terms', 30);

function gravedad_apply_single_card_filters($query) {
    if (is_admin() || !function_exists('is_product_category') || !$query->is_main_query() || !is_product_category('cartas-sueltas')) { return; }
    $map = array(
        'card_juego'=>'pa_juego','card_coleccion'=>'pa_coleccion','card_rareza'=>'pa_rareza',
        'card_color'=>'pa_color','card_tipo'=>'pa_tipo-carta','card_idioma'=>'pa_idioma',
        'card_condicion'=>'pa_condicion','card_acabado'=>'pa_acabado',
    );
    $tax_query = (array) $query->get('tax_query');
    foreach ($map as $param => $taxonomy) {
        if (!empty($_GET[$param]) && taxonomy_exists($taxonomy)) {
            $tax_query[] = array('taxonomy'=>$taxonomy,'field'=>'slug','terms'=>sanitize_title(wp_unslash($_GET[$param])));
        }
    }
    if (count($tax_query) > 1) { $tax_query['relation'] = 'AND'; }
    $query->set('tax_query', $tax_query);
    $meta_query = (array) $query->get('meta_query');
    $min = isset($_GET['precio_min']) ? floatval(wp_unslash($_GET['precio_min'])) : 0;
    $max = isset($_GET['precio_max']) ? floatval(wp_unslash($_GET['precio_max'])) : 0;
    if ($min && $max) { $meta_query[] = array('key'=>'_price','value'=>array($min,$max),'compare'=>'BETWEEN','type'=>'NUMERIC'); }
    elseif ($min) { $meta_query[] = array('key'=>'_price','value'=>$min,'compare'=>'>=','type'=>'NUMERIC'); }
    elseif ($max) { $meta_query[] = array('key'=>'_price','value'=>$max,'compare'=>'<=','type'=>'NUMERIC'); }
    if (!empty($_GET['card_stock']) && in_array($_GET['card_stock'], array('instock','outofstock'), true)) {
        $meta_query[] = array('key'=>'_stock_status','value'=>sanitize_key($_GET['card_stock']));
    }
    $query->set('meta_query', $meta_query);
}
add_action('pre_get_posts', 'gravedad_apply_single_card_filters');

function gravedad_card_filter_terms($taxonomy) {
    if (!taxonomy_exists($taxonomy)) { return array(); }
    $terms = get_terms(array('taxonomy'=>$taxonomy,'hide_empty'=>true,'orderby'=>'name'));
    return is_wp_error($terms) ? array() : $terms;
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', function(){ echo '<main class="store-main"><div class="store-shell">'; }, 10);
add_action('woocommerce_after_main_content', function(){ echo '</div></main>'; }, 10);
