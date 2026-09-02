<?php
defined('ABSPATH') || exit;

/**
 * Atributos automáticos: al guardar un producto que esté en una categoría
 * elegida (por defecto "Cartas sueltas"), se agregan solos los atributos
 * globales marcados acá abajo (vacíos, listos para elegir el valor), para
 * no tener que agregarlos a mano en cada producto. Todo editable desde
 * "Editar Sitio" → "Atributos automáticos", sin tocar código.
 */

function gravedad_autoattrs_category() {
    return get_option('gravedad_autoattrs_category', 'cartas-sueltas');
}

function gravedad_autoattrs_list() {
    $default = array('pa_coleccion', 'pa_idioma', 'pa_rareza', 'pa_condicion', 'pa_juego');
    $saved = get_option('gravedad_autoattrs_list', null);
    return is_array($saved) ? $saved : $default;
}

function gravedad_autoattrs_enabled() {
    return get_option('gravedad_autoattrs_enabled', '1') === '1';
}

function gravedad_autoattrs_menu() {
    add_submenu_page('gravedad-panel', 'Atributos automáticos', 'Atributos automáticos', 'manage_options', 'gravedad-autoattrs', 'gravedad_autoattrs_render');
}
add_action('admin_menu', 'gravedad_autoattrs_menu', 20);

function gravedad_autoattrs_assets($hook) {
    $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
    if ($page !== 'gravedad-autoattrs') { return; }
    wp_enqueue_style('gravedad-admin-panel', get_template_directory_uri() . '/assets/css/admin-panel.css', array(), GRAVEDAD_VERSION);
}
add_action('admin_enqueue_scripts', 'gravedad_autoattrs_assets');

function gravedad_autoattrs_save() {
    if (!isset($_POST['gravedad_autoattrs_nonce']) || !wp_verify_nonce($_POST['gravedad_autoattrs_nonce'], 'gravedad_autoattrs_save')) { return; }
    if (!current_user_can('manage_options')) { return; }
    update_option('gravedad_autoattrs_enabled', isset($_POST['gravedad_autoattrs_enabled']) ? '1' : '0');
    if (isset($_POST['gravedad_autoattrs_category'])) {
        $cat = sanitize_key(wp_unslash($_POST['gravedad_autoattrs_category']));
        if (get_term_by('slug', $cat, 'product_cat')) { update_option('gravedad_autoattrs_category', $cat); }
    }
    $list = array();
    if (!empty($_POST['gravedad_autoattrs_list']) && is_array($_POST['gravedad_autoattrs_list'])) {
        foreach (wp_unslash($_POST['gravedad_autoattrs_list']) as $tax) {
            $tax = sanitize_key($tax);
            if (taxonomy_exists($tax)) { $list[] = $tax; }
        }
    }
    update_option('gravedad_autoattrs_list', $list);
    wp_safe_redirect(add_query_arg(array('page' => 'gravedad-autoattrs', 'guardado' => '1'), admin_url('admin.php')));
    exit;
}
add_action('admin_post_gravedad_autoattrs_save', 'gravedad_autoattrs_save');

function gravedad_autoattrs_render() {
    if (!current_user_can('manage_options')) { return; }
    $categories = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false));
    $attr_taxonomies = function_exists('wc_get_attribute_taxonomies') ? wc_get_attribute_taxonomies() : array();
    $current_cat = gravedad_autoattrs_category();
    $current_list = gravedad_autoattrs_list();
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1>Atributos automáticos</h1><p>Elegí qué atributos globales se agregan solos (vacíos, listos para completar el valor) al guardar un producto de una categoría en particular.</p></div>
        </div>
      </header>

      <?php if (isset($_GET['guardado'])): ?>
      <div class="gravedad-panel-notice">✓ Los cambios se guardaron correctamente.</div>
      <?php endif; ?>

      <p><a href="<?php echo esc_url(admin_url('admin.php?page=gravedad-panel')); ?>">← Volver a Editar Sitio</a></p>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="gravedad-panel-form">
        <input type="hidden" name="action" value="gravedad_autoattrs_save">
        <?php wp_nonce_field('gravedad_autoattrs_save', 'gravedad_autoattrs_nonce'); ?>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head">
            <span class="gravedad-panel-card__icon">⚙️</span>
            <div><h2>Activar / desactivar</h2><p>Si lo apagás, dejan de agregarse atributos automáticamente y esta pantalla solo guarda tu configuración para cuando lo vuelvas a prender.</p></div>
          </div>
          <label class="gravedad-panel-check"><input type="checkbox" name="gravedad_autoattrs_enabled" value="1" <?php checked(gravedad_autoattrs_enabled()); ?>> Activado</label>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head">
            <span class="gravedad-panel-card__icon">🗂️</span>
            <div><h2>Categoría</h2><p>Los productos que estén en esta categoría son los que reciben los atributos automáticos.</p></div>
          </div>
          <label class="gravedad-panel-field">
            <span class="gravedad-panel-field__label">Categoría de producto</span>
            <select name="gravedad_autoattrs_category">
              <?php foreach ($categories as $cat): ?>
              <option value="<?php echo esc_attr($cat->slug); ?>" <?php selected($current_cat, $cat->slug); ?>><?php echo esc_html($cat->name); ?></option>
              <?php endforeach; ?>
            </select>
          </label>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head">
            <span class="gravedad-panel-card__icon">🏷️</span>
            <div><h2>Atributos a precargar</h2><p>Tildá los atributos globales que querés que aparezcan ya agregados (vacíos) en cada producto de esa categoría.</p></div>
          </div>
          <div class="gravedad-panel-checklist">
            <?php foreach ($attr_taxonomies as $attr): $tax = 'pa_' . $attr->attribute_name; ?>
            <label class="gravedad-panel-check"><input type="checkbox" name="gravedad_autoattrs_list[]" value="<?php echo esc_attr($tax); ?>" <?php checked(in_array($tax, $current_list, true)); ?>> <?php echo esc_html($attr->attribute_label); ?></label>
            <?php endforeach; ?>
          </div>
          <?php if (!$attr_taxonomies): ?>
          <p><small>Todavía no hay atributos globales creados en la tienda (Productos → Atributos).</small></p>
          <?php endif; ?>
        </section>

        <div class="gravedad-panel-save"><button type="submit" class="button button-primary">Guardar cambios</button></div>
      </form>
    </div>
    <?php
}
