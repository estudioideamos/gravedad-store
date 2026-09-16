<?php
defined('ABSPATH') || exit;

/**
 * Medidas antispam silenciosas para WordPress y WooCommerce.
 *
 * Evitan CAPTCHA y servicios externos: honeypots, tiempo mínimo de envío,
 * límites por IP y cierre de superficies que esta tienda no utiliza.
 */

function gravedad_antispam_client_key($bucket) {
    $ip = isset($_SERVER['REMOTE_ADDR']) ? (string) $_SERVER['REMOTE_ADDR'] : 'unknown';
    return 'grv_as_' . substr(hash_hmac('sha256', $bucket . '|' . $ip, wp_salt('nonce')), 0, 32);
}

/**
 * Devuelve true cuando la IP superó el máximo del período.
 * La dirección nunca se guarda en claro.
 */
function gravedad_antispam_rate_limited($bucket, $limit, $window) {
    $key = gravedad_antispam_client_key($bucket);
    $now = time();
    $state = get_transient($key);

    if (!is_array($state) || empty($state['expires']) || (int) $state['expires'] <= $now) {
        $state = array('count' => 0, 'expires' => $now + (int) $window);
    }

    $state['count'] = (int) $state['count'] + 1;
    set_transient($key, $state, max(1, (int) $state['expires'] - $now));

    return $state['count'] > (int) $limit;
}

function gravedad_antispam_form_token($context, $started) {
    return hash_hmac('sha256', $context . '|' . (string) $started, wp_salt('nonce'));
}

function gravedad_antispam_form_fields($context) {
    $started = time();
    $prefix = 'gravedad_as_' . sanitize_key($context);
    ?>
    <div class="gravedad-antispam-field" aria-hidden="true">
      <label for="<?php echo esc_attr($prefix); ?>_website">Dejá este campo vacío</label>
      <input type="text" id="<?php echo esc_attr($prefix); ?>_website" name="<?php echo esc_attr($prefix); ?>_website" value="" tabindex="-1" autocomplete="off">
    </div>
    <input type="hidden" name="<?php echo esc_attr($prefix); ?>_started" value="<?php echo esc_attr($started); ?>">
    <input type="hidden" name="<?php echo esc_attr($prefix); ?>_token" value="<?php echo esc_attr(gravedad_antispam_form_token($context, $started)); ?>">
    <?php
}

function gravedad_antispam_form_is_valid($context, $minimum_seconds = 2, $maximum_seconds = 14400) {
    $prefix = 'gravedad_as_' . sanitize_key($context);
    $honeypot = isset($_POST[$prefix . '_website']) ? trim((string) wp_unslash($_POST[$prefix . '_website'])) : '';
    $started = isset($_POST[$prefix . '_started']) ? absint($_POST[$prefix . '_started']) : 0;
    $token = isset($_POST[$prefix . '_token']) ? sanitize_text_field(wp_unslash($_POST[$prefix . '_token'])) : '';

    if ($honeypot !== '' || !$started || !$token) { return false; }
    if (!hash_equals(gravedad_antispam_form_token($context, $started), $token)) { return false; }

    $elapsed = time() - $started;
    return $elapsed >= (int) $minimum_seconds && $elapsed <= (int) $maximum_seconds;
}

/* -------------------------------------------------------------------------
 * Comentarios y reseñas
 * ---------------------------------------------------------------------- */

add_filter('pings_open', '__return_false', 100);
add_filter('pre_option_default_ping_status', function () { return 'closed'; });
add_filter('pre_option_default_comment_status', function () { return 'closed'; });
add_filter('feed_links_show_comments_feed', '__return_false');

// Páginas y entradas no reciben comentarios. Las reseñas de productos quedan
// disponibles únicamente para clientes identificados que compraron el producto.
add_filter('comments_open', function ($open, $post_id) {
    if (get_post_type($post_id) !== 'product' || !is_user_logged_in() || !function_exists('wc_customer_bought_product')) {
        return false;
    }

    $user = wp_get_current_user();
    return wc_customer_bought_product($user->user_email, $user->ID, $post_id);
}, 100, 2);

add_filter('option_woocommerce_review_rating_verification_required', function () { return 'yes'; });

// No exponer ni aceptar comentarios mediante la API REST pública.
add_filter('rest_endpoints', function ($endpoints) {
    unset($endpoints['/wp/v2/comments']);
    unset($endpoints['/wp/v2/comments/(?P<id>[\\d]+)']);
    return $endpoints;
}, 100);

/* -------------------------------------------------------------------------
 * Registro de cuentas
 * ---------------------------------------------------------------------- */

add_action('woocommerce_register_form', function () {
    gravedad_antispam_form_fields('register');
});

add_filter('woocommerce_registration_errors', function ($errors) {
    // WooCommerce usa el mismo filtro cuando el cliente crea su cuenta
    // durante el checkout, que ya tiene su propia validación antispam.
    if (isset($_POST['woocommerce-process-checkout-nonce']) || (function_exists('is_checkout') && is_checkout())) {
        return $errors;
    }
    if (!gravedad_antispam_form_is_valid('register', 2, 7200)) {
        $errors->add('gravedad_registration_spam', 'No pudimos procesar el registro. Recargá la página e intentá nuevamente.');
        return $errors;
    }
    if (gravedad_antispam_rate_limited('register', 5, HOUR_IN_SECONDS)) {
        $errors->add('gravedad_registration_limit', 'Se realizaron demasiados intentos. Esperá unos minutos antes de volver a probar.');
    }
    return $errors;
}, 20);

// Evita que bots salteen Mi cuenta usando el formulario genérico de
// wp-login.php. Los clientes reales registran su cuenta desde WooCommerce.
add_action('login_init', function () {
    $action = isset($_REQUEST['action']) ? sanitize_key(wp_unslash($_REQUEST['action'])) : '';
    if ($action !== 'register') { return; }
    $target = function_exists('wc_get_page_permalink') ? wc_get_page_permalink('myaccount') : home_url('/');
    wp_safe_redirect($target ?: home_url('/'));
    exit;
});

/* -------------------------------------------------------------------------
 * Checkout clásico de WooCommerce
 * ---------------------------------------------------------------------- */

add_action('woocommerce_after_order_notes', function () {
    if (!is_user_logged_in()) { gravedad_antispam_form_fields('checkout'); }
});

add_action('woocommerce_after_checkout_validation', function ($data, $errors) {
    if (is_user_logged_in()) { return; }

    if (!gravedad_antispam_form_is_valid('checkout', 3, 14400)) {
        $errors->add('gravedad_checkout_spam', 'No pudimos validar el formulario. Recargá la página e intentá nuevamente.');
        return;
    }

    // Amplio para no molestar a hogares, oficinas o redes móviles compartidas.
    if (gravedad_antispam_rate_limited('checkout', 20, HOUR_IN_SECONDS)) {
        $errors->add('gravedad_checkout_limit', 'Se realizaron demasiados intentos de compra. Esperá unos minutos antes de volver a probar.');
    }
}, 20, 2);

/* -------------------------------------------------------------------------
 * Recuperación de contraseña y consultas AJAX
 * ---------------------------------------------------------------------- */

add_action('lostpassword_post', function ($errors) {
    if ($errors instanceof WP_Error && gravedad_antispam_rate_limited('lostpassword', 5, HOUR_IN_SECONDS)) {
        $errors->add('gravedad_lostpassword_limit', 'Se realizaron demasiadas solicitudes. Esperá unos minutos antes de volver a probar.');
    }
}, 20, 1);

function gravedad_antispam_guard_public_ajax($bucket, $limit) {
    if (!gravedad_antispam_rate_limited($bucket, $limit, MINUTE_IN_SECONDS)) { return; }
    status_header(429);
    header('Retry-After: 60');
    wp_send_json_error(array('message' => 'Demasiadas solicitudes. Intentá nuevamente en un minuto.'), 429);
}

add_action('wp_ajax_gravedad_search_products', function () {
    gravedad_antispam_guard_public_ajax('product_search', 60);
}, 1);
add_action('wp_ajax_nopriv_gravedad_search_products', function () {
    gravedad_antispam_guard_public_ajax('product_search', 60);
}, 1);
add_action('wp_ajax_gravedad_get_favorites', function () {
    gravedad_antispam_guard_public_ajax('favorites', 30);
}, 1);
add_action('wp_ajax_nopriv_gravedad_get_favorites', function () {
    gravedad_antispam_guard_public_ajax('favorites', 30);
}, 1);

/* -------------------------------------------------------------------------
 * Enumeración de usuarios
 * ---------------------------------------------------------------------- */

add_action('template_redirect', function () {
    if (is_author()) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
});

add_filter('redirect_canonical', function ($redirect_url, $requested_url) {
    if (isset($_GET['author']) && !is_admin()) { return home_url('/'); }
    return $redirect_url;
}, 20, 2);
