<?php
defined('ABSPATH') || exit;

/**
 * SEO, datos estructurados, lectura por IA/LLMs y endurecimiento de seguridad.
 * Todo lo de acá es agregado no invasivo sobre el <head> y algunos endpoints
 * públicos de WordPress; no cambia el contenido ni el diseño del sitio.
 */

/* ---------------------------------------------------------------------
 * Rendimiento: conexión anticipada a los hosts de Google Fonts para que
 * la tipografía no demore el primer render.
 * ------------------------------------------------------------------- */

add_filter('wp_resource_hints', function ($hints, $relation_type) {
    if ($relation_type === 'preconnect') {
        $hints[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous');
    }
    return $hints;
}, 10, 2);

/* ---------------------------------------------------------------------
 * SEO: meta description, canonical, Open Graph / Twitter Card
 * ------------------------------------------------------------------- */

function gravedad_seo_get_description() {
    if (is_singular('product')) {
        global $product;
        if (!$product instanceof WC_Product) { $product = wc_get_product(get_the_ID()); }
        if ($product) {
            $text = $product->get_short_description() ?: $product->get_description();
            $text = wp_strip_all_tags($text);
            if ($text) { return wp_trim_words($text, 30, '…'); }
        }
    } elseif (is_singular()) {
        $text = get_the_excerpt();
        if ($text) { return wp_trim_words(wp_strip_all_tags($text), 30, '…'); }
    }
    $tagline = get_bloginfo('description');
    return $tagline ? $tagline : 'Gravedad Store: TCG, cartas sueltas, sellado y juegos de mesa en José C. Paz, Buenos Aires. Envíos a todo el país.';
}

function gravedad_seo_get_image() {
    if (is_singular('product')) {
        $thumb_id = get_post_thumbnail_id();
        if ($thumb_id) { $src = wp_get_attachment_image_src($thumb_id, 'large'); if ($src) { return $src[0]; } }
    }
    return get_template_directory_uri() . '/assets/img/logo-gravedad-store.png';
}

function gravedad_seo_get_canonical() {
    if (is_singular()) { return get_permalink(); }
    if (is_front_page() || is_home()) { return home_url('/'); }
    if (function_exists('is_shop') && is_shop()) { return get_permalink(wc_get_page_id('shop')); }
    if (is_search()) { return home_url('/?s=' . urlencode(get_search_query())); }
    global $wp;
    return home_url(add_query_arg(array(), $wp->request) . '/');
}

function gravedad_seo_is_noindex_page() {
    if (function_exists('is_cart') && is_cart()) { return true; }
    if (function_exists('is_checkout') && is_checkout()) { return true; }
    if (function_exists('is_account_page') && is_account_page()) { return true; }
    if (is_search()) { return true; }
    return false;
}

function gravedad_seo_head() {
    if (gravedad_seo_is_noindex_page()) {
        echo "\n" . '<meta name="robots" content="noindex, follow">' . "\n";
        return;
    }
    $description = gravedad_seo_get_description();
    $canonical = gravedad_seo_get_canonical();
    $image = gravedad_seo_get_image();
    $title = wp_get_document_title();

    echo "\n" . '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">' . "\n";

    echo '<meta property="og:site_name" content="Gravedad Store">' . "\n";
    echo '<meta property="og:locale" content="es_AR">' . "\n";
    echo '<meta property="og:type" content="' . (is_singular('product') ? 'product' : 'website') . '">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($canonical) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($image) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($image) . '">' . "\n";
}
add_action('wp_head', 'gravedad_seo_head', 2);
remove_action('wp_head', 'rel_canonical'); // reemplazado por gravedad_seo_head, que cubre también archivos y búsqueda

/* ---------------------------------------------------------------------
 * Datos estructurados (JSON-LD): ayudan tanto al SEO como a que los
 * asistentes de IA lean correctamente qué es el sitio y qué vende.
 * ------------------------------------------------------------------- */

function gravedad_seo_jsonld() {
    $graph = array();

    $graph[] = array(
        '@type' => 'Organization',
        '@id' => home_url('/#organization'),
        'name' => 'Gravedad Store',
        'url' => home_url('/'),
        'logo' => get_template_directory_uri() . '/assets/img/logo-gravedad-store.png',
        'email' => gravedad_option('gravedad_email', 'info@gravedad.com.ar'),
        'sameAs' => array_filter(array(gravedad_option('gravedad_instagram', ''))),
    );

    $graph[] = array(
        '@type' => 'LocalBusiness',
        '@id' => home_url('/#store'),
        'name' => 'Gravedad Store',
        'image' => get_template_directory_uri() . '/assets/img/logo-gravedad-store.png',
        'url' => home_url('/'),
        'telephone' => '+' . preg_replace('/\D/', '', gravedad_option('gravedad_whatsapp', '542320673750')),
        'priceRange' => '$$',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => gravedad_option('gravedad_event_location', 'Roque Sáenz Peña 5086'),
            'addressLocality' => 'José C. Paz',
            'addressRegion' => 'Buenos Aires',
            'addressCountry' => 'AR',
        ),
    );

    if (is_front_page() || is_home()) {
        $graph[] = array(
            '@type' => 'WebSite',
            '@id' => home_url('/#website'),
            'url' => home_url('/'),
            'name' => 'Gravedad Store',
            'publisher' => array('@id' => home_url('/#organization')),
            'potentialAction' => array(
                '@type' => 'SearchAction',
                'target' => home_url('/?s={search_term}&post_type=product'),
                'query-input' => 'required name=search_term',
            ),
        );
    }

    // El Product/Offer de cada ficha lo emite WooCommerce nativamente
    // (WC_Structured_Data, en el <script> aparte que ya trae el tema base).
    // Agregarlo también acá duplicaría el mismo @id con dos bloques
    // distintos, así que este @graph se limita a lo que WooCommerce no cubre.

    if (!$graph) { return; }
    $jsonld = array('@context' => 'https://schema.org', '@graph' => $graph);
    echo '<script type="application/ld+json">' . wp_json_encode($jsonld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) . '</script>' . "\n";
}
add_action('wp_head', 'gravedad_seo_jsonld', 3);

/* ---------------------------------------------------------------------
 * robots.txt / llms.txt: en instalaciones dentro de una subcarpeta el
 * robots.txt virtual de WordPress no siempre llega a servirse, así que
 * lo resolvemos directo apenas arranca la request.
 * ------------------------------------------------------------------- */

function gravedad_serve_text_files() {
    if (empty($_SERVER['REQUEST_URI'])) { return; }
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($path === untrailingslashit(wp_parse_url(home_url('/robots.txt'), PHP_URL_PATH))) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "User-agent: *\n";
        echo "Disallow: /wp-admin/\n";
        echo "Allow: /wp-admin/admin-ajax.php\n";
        echo "Sitemap: " . home_url('/wp-sitemap.xml') . "\n";
        exit;
    }
    if ($path === untrailingslashit(wp_parse_url(home_url('/llms.txt'), PHP_URL_PATH))) {
        header('Content-Type: text/plain; charset=utf-8');
        echo "# Gravedad Store\n\n";
        echo "> Tienda online de TCG (Magic, Pokémon, One Piece, Digimon, Dragon Ball, Yu-Gi-Oh!), cartas sueltas, juegos de mesa y accesorios. Envíos a todo Argentina y retiro en José C. Paz, Buenos Aires.\n\n";
        echo "- [Tienda completa](" . home_url('/tienda/') . ")\n";
        echo "- [Cómo comprar](" . home_url('/como-comprar/') . ")\n";
        echo "- [Envíos](" . home_url('/envios/') . ")\n";
        echo "- [Cambios y devoluciones](" . home_url('/cambios-y-devoluciones/') . ")\n";
        echo "- [Preguntas frecuentes](" . home_url('/preguntas-frecuentes/') . ")\n";
        echo "- [Mapa del sitio (XML)](" . home_url('/wp-sitemap.xml') . ")\n";
        exit;
    }
}
add_action('init', 'gravedad_serve_text_files');

/* ---------------------------------------------------------------------
 * Endurecimiento de seguridad
 * ------------------------------------------------------------------- */

// No mostrar la versión exacta de WordPress/WooCommerce/plugins: reduce
// la información disponible para atacantes que buscan vulnerabilidades
// conocidas de una versión puntual.
remove_action('wp_head', 'wp_generator');
add_filter('the_generator', '__return_empty_string');

// XML-RPC no se usa en este sitio (sin apps móviles ni publicación remota)
// y es un vector clásico de fuerza bruta / amplificación DDoS (pingback).
// El filtro xmlrpc_enabled solo bloquea los métodos que requieren login,
// así que además cortamos cualquier request a xmlrpc.php directamente.
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function ($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});
add_action('init', function () {
    if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) {
        status_header(403);
        exit('XML-RPC deshabilitado.');
    }
}, 1);

// No exponer el listado de usuarios (nombres de usuario reales) por la
// REST API a visitantes sin sesión: es la primera pista que usa un
// atacante para intentar fuerza bruta contra el login.
add_filter('rest_endpoints', function ($endpoints) {
    if (!is_user_logged_in()) {
        unset($endpoints['/wp/v2/users']);
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

// No confirmar si un nombre de usuario existe a través del formulario
// de login (mensajes de error genéricos).
add_filter('login_errors', function () {
    return 'Usuario o contraseña incorrectos.';
});
