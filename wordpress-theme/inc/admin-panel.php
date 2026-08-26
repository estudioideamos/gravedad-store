<?php
defined('ABSPATH') || exit;

/**
 * Panel de administración "Editar Sitio": una sola pantalla, en español simple,
 * para que un usuario sin conocimientos técnicos pueda cambiar los contenidos
 * más comunes del sitio (contacto, avisos, evento destacado, cotización, datos
 * de la tienda) sin tener que entender el Personalizador ni los ajustes de WooCommerce.
 */

function gravedad_admin_panel_menu() {
    $icon = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="black" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2 3 7.5v9L12 22l9-5.5v-9z"/><path d="M12 8v8"/><path d="m8.5 10 7 4"/><path d="m15.5 10-7 4"/></svg>');
    add_menu_page('Editar Sitio', 'Editar Sitio', 'manage_options', 'gravedad-panel', 'gravedad_admin_panel_render', $icon, 3);
}
add_action('admin_menu', 'gravedad_admin_panel_menu');

function gravedad_admin_panel_assets($hook) {
    if ($hook !== 'toplevel_page_gravedad-panel') { return; }
    wp_enqueue_style('gravedad-admin-panel', get_template_directory_uri() . '/assets/css/admin-panel.css', array(), GRAVEDAD_VERSION);
}
add_action('admin_enqueue_scripts', 'gravedad_admin_panel_assets');

function gravedad_admin_panel_sections() {
    return array(
        'contacto' => array(
            'titulo' => 'Contacto y ubicación',
            'icono' => '📞',
            'ayuda' => 'Estos datos aparecen en el pie de página, en los botones de WhatsApp y en la ficha de eventos.',
            'campos' => array(
                'gravedad_whatsapp' => array('label' => 'WhatsApp', 'ayuda' => 'Solo números, con código de país y área. Ej: 542320673750 (sin espacios ni signos +).', 'type' => 'text', 'default' => '542320673750'),
                'gravedad_email' => array('label' => 'Email de contacto', 'type' => 'email', 'default' => 'info@gravedad.com.ar'),
                'gravedad_instagram' => array('label' => 'Instagram', 'ayuda' => 'Pegá el link completo de tu perfil.', 'type' => 'url', 'default' => 'https://www.instagram.com/gravedadstore'),
                'gravedad_event_location' => array('label' => 'Dirección de la tienda', 'type' => 'text', 'default' => 'Roque Sáenz Peña 5086, José C. Paz, Buenos Aires'),
            ),
        ),
        'avisos' => array(
            'titulo' => 'Avisos de la barra superior',
            'icono' => '📢',
            'ayuda' => 'El texto que se desliza en la franja de arriba de todas las páginas.',
            'campos' => array(
                'gravedad_announcement' => array('label' => 'Aviso 1', 'type' => 'text', 'default' => 'ENVÍOS A TODO EL PAÍS'),
                'gravedad_promo' => array('label' => 'Aviso 2 (promoción)', 'type' => 'text', 'default' => '3 CUOTAS SIN INTERÉS EN PRODUCTOS SELECCIONADOS'),
            ),
        ),
        'evento' => array(
            'titulo' => 'Próximo evento destacado',
            'icono' => '📅',
            'ayuda' => 'Se muestra en la sección de eventos de la portada. Para cargar el resto de los eventos, andá al menú "Eventos".',
            'campos' => array(
                'gravedad_event_date' => array('label' => 'Fecha (texto corto)', 'ayuda' => 'Ej: 24 AGO', 'type' => 'text', 'default' => '24 AGO'),
            ),
        ),
        'dolar' => array(
            'titulo' => 'Cotización del dólar',
            'icono' => '💵',
            'ayuda' => 'Los productos cargados en dólares se convierten a pesos con esta cotización. Si lo dejás vacío, se actualiza sola todos los días con el dólar oficial.',
            'campos' => array(
                'gravedad_usd_rate_manual' => array('label' => 'Cotización manual (opcional)', 'type' => 'number'),
            ),
        ),
        'tienda' => array(
            'titulo' => 'Datos de facturación / Punto de venta',
            'icono' => '🏪',
            'ayuda' => 'Se usan en los comprobantes y en el punto de venta de WooCommerce.',
            'campos' => array(
                'wc_pos_store_name' => array('label' => 'Nombre de la tienda', 'type' => 'text', 'wc' => 'woocommerce_pos_store_name', 'default' => 'Gravedad Store'),
                'wc_pos_store_address' => array('label' => 'Dirección', 'type' => 'text', 'wc' => 'woocommerce_pos_store_address', 'default' => 'Roque Saenz Pena 5086, Jose C. Paz, Buenos Aires'),
                'wc_pos_store_phone' => array('label' => 'Teléfono', 'type' => 'text', 'wc' => 'woocommerce_pos_store_phone', 'default' => '2320 673750'),
                'wc_pos_store_email' => array('label' => 'Email', 'type' => 'email', 'wc' => 'woocommerce_pos_store_email', 'default' => 'info@gravedad.com.ar'),
            ),
        ),
    );
}

function gravedad_admin_panel_get_value($key, $field) {
    $default = isset($field['default']) ? $field['default'] : '';
    if (!empty($field['wc'])) {
        $value = get_option($field['wc'], '');
        return $value !== '' ? $value : $default;
    }
    return get_theme_mod($key, $default);
}

function gravedad_admin_panel_save() {
    if (!isset($_POST['gravedad_panel_nonce']) || !wp_verify_nonce($_POST['gravedad_panel_nonce'], 'gravedad_panel_save')) { return; }
    if (!current_user_can('manage_options')) { return; }
    foreach (gravedad_admin_panel_sections() as $section) {
        foreach ($section['campos'] as $key => $field) {
            if (!isset($_POST[$key])) { continue; }
            $raw = wp_unslash($_POST[$key]);
            $value = $field['type'] === 'email' ? sanitize_email($raw) : ($field['type'] === 'url' ? esc_url_raw($raw) : sanitize_text_field($raw));
            if (!empty($field['wc'])) {
                update_option($field['wc'], $value);
                if ($field['wc'] === 'woocommerce_pos_store_address') { update_option('woocommerce_store_address', $value); }
            } else {
                set_theme_mod($key, $value);
            }
        }
    }
    wp_safe_redirect(add_query_arg(array('page' => 'gravedad-panel', 'guardado' => '1'), admin_url('admin.php')));
    exit;
}
add_action('admin_post_gravedad_panel_save', 'gravedad_admin_panel_save');

function gravedad_admin_panel_render() {
    if (!current_user_can('manage_options')) { return; }
    $sections = gravedad_admin_panel_sections();
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1>Editar Sitio</h1><p>Cambiá los contenidos del sitio sin tocar código. Guardá y los cambios ya quedan online.</p></div>
        </div>
      </header>

      <?php if (isset($_GET['guardado'])): ?>
      <div class="gravedad-panel-notice">✓ Los cambios se guardaron correctamente.</div>
      <?php endif; ?>

      <div class="gravedad-panel-quicklinks">
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=product')); ?>"><span>🛒</span>Productos</a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=evento')); ?>"><span>🎟️</span>Eventos</a>
        <a href="<?php echo esc_url(admin_url('edit.php?post_type=page')); ?>"><span>📄</span>Páginas</a>
        <a href="<?php echo esc_url(admin_url('nav-menus.php')); ?>"><span>🧭</span>Menú de navegación</a>
      </div>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="gravedad-panel-form">
        <input type="hidden" name="action" value="gravedad_panel_save">
        <?php wp_nonce_field('gravedad_panel_save', 'gravedad_panel_nonce'); ?>

        <?php foreach ($sections as $section): ?>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head">
            <span class="gravedad-panel-card__icon"><?php echo esc_html($section['icono']); ?></span>
            <div><h2><?php echo esc_html($section['titulo']); ?></h2><?php if (!empty($section['ayuda'])): ?><p><?php echo esc_html($section['ayuda']); ?></p><?php endif; ?></div>
          </div>
          <div class="gravedad-panel-card__grid">
            <?php foreach ($section['campos'] as $key => $field): ?>
            <label class="gravedad-panel-field">
              <span class="gravedad-panel-field__label"><?php echo esc_html($field['label']); ?></span>
              <input type="<?php echo esc_attr($field['type']); ?>" name="<?php echo esc_attr($key); ?>" value="<?php echo esc_attr(gravedad_admin_panel_get_value($key, $field)); ?>">
              <?php if (!empty($field['ayuda'])): ?><small><?php echo esc_html($field['ayuda']); ?></small><?php endif; ?>
            </label>
            <?php endforeach; ?>
          </div>
        </section>
        <?php endforeach; ?>

        <div class="gravedad-panel-save"><button type="submit" class="button button-primary">Guardar cambios</button></div>
      </form>
    </div>
    <?php
}
