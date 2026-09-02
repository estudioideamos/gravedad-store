<?php
/**
 * Plugin Name: Gravedad - Ocultar menú admin
 * Description: Declutter del menú lateral de WordPress: elegís qué accesos ocultar (Plugins, Herramientas, Ajustes, etc.) para que no estén tan a mano en el uso diario. Se activa/desactiva y se elige cada ítem desde "Vista de menú", al final del menú lateral.
 * Version: 1.0.0
 * Author: Estudio Ideamos
 * Author URI: https://ideamos.com.ar
 * Text Domain: gravedad-menu-lock
 */

defined('ABSPATH') || exit;

define('GML_OPT_ENABLED', 'gml_enabled');
define('GML_OPT_ITEMS', 'gml_hidden_slugs');
define('GML_SETTINGS_SLUG', 'gml-settings');

/**
 * IMPORTANTE — esto es orden visual, no un permiso de WordPress real.
 * Oculta accesos del menú para que no llamen la atención en el uso diario,
 * pero cualquiera que sepa/adivine la URL directa de una pantalla oculta
 * (por ejemplo /wp-admin/plugins.php) igual puede entrar si tiene una
 * sesión de administrador iniciada. Como en este sitio el mismo usuario
 * administrador se comparte entre la agencia y el cliente, una restricción
 * real (que bloquee el acceso aunque se conozca la URL) requeriría un
 * usuario aparte con un rol con menos permisos. Este plugin no reemplaza
 * eso: solo ordena la vista.
 */

function gml_is_enabled() {
    return get_option(GML_OPT_ENABLED, '0') === '1';
}

function gml_hidden_slugs() {
    $saved = get_option(GML_OPT_ITEMS, array());
    return is_array($saved) ? $saved : array();
}

// Guarda una foto de los ítems de menú realmente registrados (por WordPress
// y por cualquier plugin activo), para poder listarlos en la pantalla de
// configuración sin tener que adivinar sus nombres de antemano.
add_action('admin_menu', function () {
    global $menu;
    $snapshot = array();
    if (is_array($menu)) {
        foreach ($menu as $item) {
            if (empty($item[2]) || empty($item[0])) { continue; }
            $slug = $item[2];
            if ($slug === GML_SETTINGS_SLUG) { continue; }
            $label = trim(wp_strip_all_tags($item[0]));
            if ($label === '') { continue; }
            $snapshot[$slug] = $label;
        }
    }
    $GLOBALS['gml_menu_snapshot'] = $snapshot;
}, 990);

// Aplica el ocultamiento (si está activado) después de armada la foto.
add_action('admin_menu', function () {
    if (!gml_is_enabled()) { return; }
    foreach (gml_hidden_slugs() as $slug) {
        remove_menu_page($slug);
    }
}, 999);

// Pantalla propia de control, siempre visible y siempre excluida de la
// lista de "ítems a ocultar" (si no, no habría forma de volver a entrar).
add_action('admin_menu', function () {
    add_menu_page('Vista de menú', 'Vista de menú', 'manage_options', GML_SETTINGS_SLUG, 'gml_render_settings', 'dashicons-hidden', 99);
}, 1);

add_action('admin_post_gml_save', function () {
    if (!isset($_POST['gml_nonce']) || !wp_verify_nonce($_POST['gml_nonce'], 'gml_save')) { return; }
    if (!current_user_can('manage_options')) { return; }
    update_option(GML_OPT_ENABLED, !empty($_POST['gml_enabled']) ? '1' : '0');
    $selected = isset($_POST['gml_items']) ? array_map('sanitize_text_field', wp_unslash((array) $_POST['gml_items'])) : array();
    update_option(GML_OPT_ITEMS, $selected);
    wp_safe_redirect(add_query_arg(array('page' => GML_SETTINGS_SLUG, 'guardado' => '1'), admin_url('admin.php')));
    exit;
});

function gml_render_settings() {
    if (!current_user_can('manage_options')) { return; }
    $enabled = gml_is_enabled();
    $hidden = gml_hidden_slugs();
    $available = isset($GLOBALS['gml_menu_snapshot']) ? $GLOBALS['gml_menu_snapshot'] : array();
    asort($available);
    ?>
    <div class="wrap">
      <h1>Vista de menú del admin</h1>
      <p>Elegí qué accesos del menú lateral se ocultan para que no estén tan a mano en el uso diario (Plugins, Herramientas, Ajustes técnicos, etc.). Es solo orden visual — no es un permiso de WordPress, así que no reemplaza tener un usuario aparte si en algún momento hace falta un límite real.</p>
      <?php if (isset($_GET['guardado'])): ?><div class="notice notice-success is-dismissible"><p>Guardado.</p></div><?php endif; ?>
      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
        <input type="hidden" name="action" value="gml_save">
        <?php wp_nonce_field('gml_save', 'gml_nonce'); ?>
        <p style="margin:18px 0"><label style="font-size:14px"><input type="checkbox" name="gml_enabled" value="1" <?php checked($enabled); ?>> <strong>Ocultar los ítems tildados abajo</strong> (destildá esto para mostrar todo de nuevo sin perder la selección)</label></p>
        <table class="widefat striped" style="max-width:560px">
          <thead><tr><th style="width:36px"></th><th>Ítem del menú</th></tr></thead>
          <tbody>
          <?php if (!$available): ?>
          <tr><td colspan="2">No se detectaron ítems de menú todavía. Recargá esta página.</td></tr>
          <?php endif; ?>
          <?php foreach ($available as $slug => $label): ?>
            <tr>
              <td><input type="checkbox" name="gml_items[]" value="<?php echo esc_attr($slug); ?>" <?php checked(in_array($slug, $hidden, true)); ?>></td>
              <td><?php echo esc_html($label); ?></td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
        <p class="submit"><button type="submit" class="button button-primary">Guardar</button></p>
      </form>
    </div>
    <?php
}
