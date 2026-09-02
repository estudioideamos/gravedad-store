<?php
defined('ABSPATH') || exit;

/**
 * Atributos automáticos: reglas del tipo "si el producto está en esta
 * categoría, agregale estos atributos globales (vacíos, listos para elegir
 * el valor)". Se pueden crear tantas reglas como haga falta (una por
 * categoría), todo editable desde "Editar Sitio" → "Atributos automáticos",
 * sin tocar código. Un producto puede recibir atributos de más de una regla
 * si está en varias categorías a la vez.
 */

function gravedad_autoattrs_enabled() {
    return get_option('gravedad_autoattrs_enabled', '1') === '1';
}

function gravedad_autoattrs_rules_count() {
    $v = get_option('gravedad_autoattrs_rules_count', '');
    return ($v !== '' && is_numeric($v)) ? max(1, (int) $v) : 1;
}

function gravedad_autoattrs_rule($n) {
    // La regla 1 hereda, como valor por defecto, la configuración original
    // (Cartas sueltas + Colección/Idioma/Rareza/Condición/Juego).
    $default_cat = $n === 1 ? get_option('gravedad_autoattrs_category', 'cartas-sueltas') : '';
    $default_list = $n === 1 ? get_option('gravedad_autoattrs_list', array('pa_coleccion', 'pa_idioma', 'pa_rareza', 'pa_condicion', 'pa_juego')) : array();
    $atributos = get_option('gravedad_autoattrs_regla' . $n . '_atributos', $default_list);
    return array(
        'n' => $n,
        'activa' => get_option('gravedad_autoattrs_regla' . $n . '_activa', '1') === '1',
        'categoria' => get_option('gravedad_autoattrs_regla' . $n . '_categoria', $default_cat),
        'atributos' => is_array($atributos) ? $atributos : array(),
    );
}

function gravedad_autoattrs_rules() {
    $rules = array();
    for ($n = 1; $n <= gravedad_autoattrs_rules_count(); $n++) { $rules[] = gravedad_autoattrs_rule($n); }
    return $rules;
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

    $total = isset($_POST['autoattrs_rules_total']) ? max(1, (int) $_POST['autoattrs_rules_total']) : 1;
    for ($n = 1; $n <= $total; $n++) {
        update_option('gravedad_autoattrs_regla' . $n . '_activa', isset($_POST['autoattrs_regla' . $n . '_activa']) ? '1' : '0');
        if (isset($_POST['autoattrs_regla' . $n . '_categoria'])) {
            $cat = sanitize_key(wp_unslash($_POST['autoattrs_regla' . $n . '_categoria']));
            if ($cat === '' || get_term_by('slug', $cat, 'product_cat')) {
                update_option('gravedad_autoattrs_regla' . $n . '_categoria', $cat);
            }
        }
        $list = array();
        $posted_key = 'autoattrs_regla' . $n . '_atributos';
        if (!empty($_POST[$posted_key]) && is_array($_POST[$posted_key])) {
            foreach (wp_unslash($_POST[$posted_key]) as $tax) {
                $tax = sanitize_key($tax);
                if (taxonomy_exists($tax)) { $list[] = $tax; }
            }
        }
        update_option('gravedad_autoattrs_regla' . $n . '_atributos', $list);
    }
    update_option('gravedad_autoattrs_rules_count', $total);

    if (!empty($_POST['autoattrs_add_regla'])) {
        update_option('gravedad_autoattrs_rules_count', $total + 1);
    } elseif (!empty($_POST['autoattrs_remove_regla'])) {
        $remove_n = (int) $_POST['autoattrs_remove_regla'];
        if ($remove_n >= 1 && $total > 1) {
            for ($i = $remove_n; $i < $total; $i++) {
                update_option('gravedad_autoattrs_regla' . $i . '_activa', get_option('gravedad_autoattrs_regla' . ($i + 1) . '_activa', '1'));
                update_option('gravedad_autoattrs_regla' . $i . '_categoria', get_option('gravedad_autoattrs_regla' . ($i + 1) . '_categoria', ''));
                update_option('gravedad_autoattrs_regla' . $i . '_atributos', get_option('gravedad_autoattrs_regla' . ($i + 1) . '_atributos', array()));
            }
            delete_option('gravedad_autoattrs_regla' . $total . '_activa');
            delete_option('gravedad_autoattrs_regla' . $total . '_categoria');
            delete_option('gravedad_autoattrs_regla' . $total . '_atributos');
            update_option('gravedad_autoattrs_rules_count', $total - 1);
        }
    }

    wp_safe_redirect(add_query_arg(array('page' => 'gravedad-autoattrs', 'guardado' => '1'), admin_url('admin.php')));
    exit;
}
add_action('admin_post_gravedad_autoattrs_save', 'gravedad_autoattrs_save');

function gravedad_autoattrs_render() {
    if (!current_user_can('manage_options')) { return; }
    $categories = get_terms(array('taxonomy' => 'product_cat', 'hide_empty' => false));
    $attr_taxonomies = function_exists('wc_get_attribute_taxonomies') ? wc_get_attribute_taxonomies() : array();
    $rules = gravedad_autoattrs_rules();
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1>Atributos automáticos</h1><p>Creá una o varias reglas: "si el producto está en esta categoría, agregale estos atributos". Se agregan solos —vacíos, listos para elegir el valor— al guardar el producto, sin tener que sumarlos a mano cada vez.</p></div>
        </div>
      </header>

      <?php if (isset($_GET['guardado'])): ?>
      <div class="gravedad-panel-notice">✓ Los cambios se guardaron correctamente.</div>
      <?php endif; ?>

      <p><a href="<?php echo esc_url(admin_url('admin.php?page=gravedad-panel')); ?>">← Volver a Editar Sitio</a></p>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="gravedad-panel-form">
        <input type="hidden" name="action" value="gravedad_autoattrs_save">
        <input type="hidden" name="autoattrs_rules_total" value="<?php echo esc_attr(count($rules)); ?>">
        <?php wp_nonce_field('gravedad_autoattrs_save', 'gravedad_autoattrs_nonce'); ?>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head">
            <span class="gravedad-panel-card__icon">⚙️</span>
            <div><h2>Función activada</h2><p>Apagá esto para desactivar todas las reglas de una sola vez, sin perder cómo las configuraste.</p></div>
          </div>
          <label class="gravedad-panel-check"><input type="checkbox" name="gravedad_autoattrs_enabled" value="1" <?php checked(gravedad_autoattrs_enabled()); ?>> Activado</label>
        </section>

        <?php foreach ($rules as $rule): $n = $rule['n']; ?>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-item" style="background:none;border:0;padding:0;margin:0">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body" style="display:flex;flex-direction:column;gap:18px">
              <div class="gravedad-panel-card__head" style="margin:0;padding:0;border:0">
                <div>
                  <h2>Regla <?php echo esc_html($n); ?></h2>
                  <p>Elegí la categoría y tildá los atributos que se agregan a cualquier producto que esté en ella.</p>
                </div>
              </div>

              <label class="gravedad-panel-check"><input type="checkbox" name="autoattrs_regla<?php echo esc_attr($n); ?>_activa" value="1" <?php checked($rule['activa']); ?>> Regla activa</label>

              <label class="gravedad-panel-field">
                <span class="gravedad-panel-field__label">Categoría de producto</span>
                <select name="autoattrs_regla<?php echo esc_attr($n); ?>_categoria">
                  <option value="">— Elegí una categoría —</option>
                  <?php foreach ($categories as $cat): ?>
                  <option value="<?php echo esc_attr($cat->slug); ?>" <?php selected($rule['categoria'], $cat->slug); ?>><?php echo esc_html($cat->name); ?></option>
                  <?php endforeach; ?>
                </select>
              </label>

              <div>
                <span class="gravedad-panel-field__label">Atributos a precargar</span>
                <div class="gravedad-panel-checklist">
                  <?php foreach ($attr_taxonomies as $attr): $tax = 'pa_' . $attr->attribute_name; ?>
                  <label class="gravedad-panel-check"><input type="checkbox" name="autoattrs_regla<?php echo esc_attr($n); ?>_atributos[]" value="<?php echo esc_attr($tax); ?>" <?php checked(in_array($tax, $rule['atributos'], true)); ?>> <?php echo esc_html($attr->attribute_label); ?></label>
                  <?php endforeach; ?>
                </div>
                <?php if (!$attr_taxonomies): ?>
                <p><small>Todavía no hay atributos globales creados en la tienda (Productos → Atributos).</small></p>
                <?php endif; ?>
              </div>
            </div>
            <?php if (count($rules) > 1): ?>
            <button type="submit" name="autoattrs_remove_regla" value="<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar la Regla <?php echo esc_attr($n); ?>?');" title="Quitar esta regla">✕</button>
            <?php endif; ?>
          </div>
        </section>
        <?php endforeach; ?>

        <button type="submit" name="autoattrs_add_regla" value="1" class="gravedad-panel-add" formnovalidate>+ Agregar otra regla (otra categoría)</button>

        <div class="gravedad-panel-save"><button type="submit" class="button button-primary">Guardar cambios</button></div>
      </form>
    </div>
    <?php
}
