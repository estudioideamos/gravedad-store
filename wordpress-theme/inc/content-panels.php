<?php
defined('ABSPATH') || exit;

/**
 * Submenús de "Editar Sitio" para el contenido de Preguntas frecuentes, Cómo
 * comprar, Envíos y Cambios y devoluciones: campos de texto simples (sin editor,
 * sin HTML) que arman automáticamente el diseño con tarjetas/acordeón ya
 * existente. El admin solo completa cajas de texto con una etiqueta clara.
 */

function gravedad_content_panel_definitions() {
    return array(
        'faq' => array(
            'slug' => 'gravedad-content-faq',
            'menu_title' => 'Preguntas frecuentes',
            'page_title' => 'Preguntas frecuentes',
            'ayuda' => 'Estas preguntas se muestran agrupadas y se abren al tocarlas en la página de Preguntas frecuentes.',
            'groups' => array(
                'g1' => array('label' => 'Pedidos y pagos', 'items' => array(
                    array('q' => '¿Qué medios de pago aceptan?', 'a' => 'Aceptamos Mercado Pago, Visa, Mastercard, transferencia bancaria y efectivo en el local. En productos seleccionados ofrecemos 3 cuotas sin interés.'),
                    array('q' => '¿Puedo pagar en cuotas?', 'a' => 'Sí, con tarjetas de crédito a través de Mercado Pago. Los productos con 3 cuotas sin interés están marcados en la tienda.'),
                    array('q' => '¿Cómo sé si mi pago fue confirmado?', 'a' => 'Vas a recibir un correo de confirmación apenas se acredite el pago. Si pagás por transferencia, el pedido queda "a la espera" hasta que verifiquemos el comprobante.'),
                )),
                'g2' => array('label' => 'Envíos y retiro', 'items' => array(
                    array('q' => '¿Hacen envíos a todo el país?', 'a' => 'Sí, enviamos a todo el país por Correo Argentino. El costo y el tiempo estimado se calculan al finalizar la compra según tu código postal.'),
                    array('q' => '¿Puedo retirar en el local?', 'a' => 'Sí, podés elegir "Retiro en tienda" sin cargo al finalizar la compra. Te avisamos por WhatsApp o email cuando esté listo para retirar.'),
                    array('q' => '¿Cuánto tarda en llegar mi pedido?', 'a' => 'Dentro del AMBA suele demorar entre 2 y 4 días hábiles, y en el resto del país entre 4 y 8 días hábiles según la zona.'),
                )),
                'g3' => array('label' => 'Cambios y devoluciones', 'items' => array(
                    array('q' => '¿Puedo cambiar un producto?', 'a' => 'Sí, tenés 10 días corridos desde que lo recibís para solicitar un cambio, siempre que el producto esté sellado o en las mismas condiciones en que lo enviamos.'),
                    array('q' => '¿Qué hago si mi carta llegó dañada?', 'a' => 'Escribinos por WhatsApp con fotos del producto y del embalaje apenas lo recibas. Gestionamos el cambio o la devolución sin cargo.'),
                    array('q' => '¿Los sobres o boosters se pueden devolver una vez abiertos?', 'a' => 'No, por la naturaleza del producto los sobres sellados no admiten devolución una vez abiertos, salvo defecto de fábrica.'),
                )),
                'g4' => array('label' => 'Productos y stock', 'items' => array(
                    array('q' => '¿Las cartas sueltas son originales?', 'a' => 'Sí, trabajamos únicamente con productos originales de los editores oficiales (Wizards of the Coast, Pokémon, Bandai, entre otros).'),
                    array('q' => '¿Cómo puedo reservar una preventa?', 'a' => 'Los productos en preventa se pueden comprar directamente en la sección Preventas. Se factura el total y te avisamos apenas llega el lanzamiento.'),
                    array('q' => '¿Con qué frecuencia suman productos nuevos?', 'a' => 'Todas las semanas sumamos novedades, tanto sellado como cartas sueltas. Podés verlas en la sección Novedades de la home.'),
                )),
            ),
        ),
        'como-comprar' => array(
            'slug' => 'gravedad-content-como-comprar',
            'menu_title' => 'Cómo comprar',
            'page_title' => 'Cómo comprar',
            'ayuda' => 'Los 4 pasos que se muestran en la página "Cómo comprar".',
            'steps' => array(
                array('titulo' => 'Elegí tus productos', 'texto' => 'Explorá el catálogo por juego, categoría o con el buscador y sumá lo que quieras al carrito.'),
                array('titulo' => 'Iniciá la compra', 'texto' => 'Revisá tu selección en el carrito y avanzá a "Finalizar compra" cuando estés list@.'),
                array('titulo' => 'Elegí pago y envío', 'texto' => 'Pagá con Mercado Pago, tarjeta, transferencia o efectivo, y elegí envío a domicilio o retiro en tienda.'),
                array('titulo' => 'Confirmá tu pedido', 'texto' => 'Recibís un email de confirmación y te avisamos por WhatsApp apenas esté en camino o listo para retirar.'),
            ),
        ),
        'envios' => array(
            'slug' => 'gravedad-content-envios',
            'menu_title' => 'Envíos',
            'page_title' => 'Envíos',
            'ayuda' => 'Zonas de envío y los dos bloques informativos de la página "Envíos".',
            'zonas' => array(
                array('nombre' => 'AMBA', 'tiempo' => '2 a 4 días hábiles', 'costo' => 'Se calcula en el checkout'),
                array('nombre' => 'Interior del país', 'tiempo' => '4 a 8 días hábiles', 'costo' => 'Se calcula en el checkout'),
                array('nombre' => 'Retiro en tienda', 'tiempo' => 'Mismo día, con turno', 'costo' => 'Sin cargo'),
            ),
            'bloques' => array(
                array('titulo' => 'Seguimiento del pedido', 'texto' => 'Apenas despachamos tu compra te enviamos el número de seguimiento por email y WhatsApp para que puedas rastrearlo en todo momento.'),
                array('titulo' => 'Embalaje protegido', 'texto' => "Cartas sueltas: se envían en top loader y sobre rígido, dentro de un sobre acolchado.\nSellado: booster boxes y displays viajan en caja reforzada con relleno protector.\nJuegos de mesa: embalaje original más protección extra en las esquinas."),
            ),
        ),
        'cambios' => array(
            'slug' => 'gravedad-content-cambios',
            'menu_title' => 'Cambios y devoluciones',
            'page_title' => 'Cambios y devoluciones',
            'ayuda' => 'Condiciones y los dos bloques informativos de la página "Cambios y devoluciones".',
            'condiciones' => array(
                array('titulo' => '10 días corridos', 'texto' => 'Desde que recibís tu pedido para solicitar un cambio.'),
                array('titulo' => 'Mismo estado', 'texto' => 'El producto debe estar sellado o en las mismas condiciones en que lo enviamos.'),
                array('titulo' => 'Sobres abiertos', 'texto' => 'No admiten devolución una vez abiertos, salvo defecto de fábrica.'),
            ),
            'bloques' => array(
                array('titulo' => '¿Llegó dañado o incorrecto?', 'texto' => 'Escribinos por WhatsApp con fotos del producto y del embalaje apenas lo recibas. Gestionamos el cambio o la devolución sin cargo para vos.'),
                array('titulo' => 'Cómo iniciar un cambio', 'texto' => "Escribinos por WhatsApp indicando tu número de pedido.\nTe confirmamos si corresponde cambio, devolución o reembolso.\nCoordinamos el envío o el retiro en tienda del producto."),
            ),
        ),
    );
}

function gravedad_content_panel_menu() {
    foreach (gravedad_content_panel_definitions() as $key => $def) {
        add_submenu_page('gravedad-panel', $def['page_title'], $def['menu_title'], 'manage_options', $def['slug'], function () use ($key, $def) {
            gravedad_content_panel_render($key, $def);
        });
    }
}
add_action('admin_menu', 'gravedad_content_panel_menu', 20);

function gravedad_content_panel_opt($key, $field, $default) {
    return get_option('gravedad_content_' . $key . '_' . $field, $default);
}

/**
 * Cuántos ítems tiene hoy una colección (preguntas de un grupo, pasos, zonas,
 * bloques, condiciones). Empieza en la cantidad original y crece cuando el
 * admin usa "+ Agregar"; nunca baja de 1.
 */
function gravedad_content_panel_count($page, $collection, $default) {
    $v = get_option('gravedad_content_' . $page . '_' . $collection . '_count', '');
    return ($v !== '' && is_numeric($v)) ? max(1, (int) $v) : max(1, (int) $default);
}

function gravedad_content_faq_group_default_items($group) {
    $def = gravedad_content_panel_definitions()['faq'];
    return isset($def['groups'][$group]) ? count($def['groups'][$group]['items']) : 1;
}

function gravedad_content_panel_shift_down($page, $key_template, $from_index, $count) {
    for ($i = $from_index; $i < $count; $i++) {
        $from_opt = 'gravedad_content_' . $page . '_' . sprintf($key_template, $i + 1);
        $to_opt = 'gravedad_content_' . $page . '_' . sprintf($key_template, $i);
        update_option($to_opt, get_option($from_opt, ''));
    }
    delete_option('gravedad_content_' . $page . '_' . sprintf($key_template, $count));
}

function gravedad_content_panel_add_item($page, $spec) {
    $parts = explode(':', $spec);
    $collection = sanitize_key($parts[0]);
    $group = isset($parts[1]) ? sanitize_key($parts[1]) : '';

    if ($collection === 'faq_items' && $group) {
        $count = gravedad_content_panel_count($page, $group . '_items', gravedad_content_faq_group_default_items($group));
        update_option('gravedad_content_' . $page . '_' . $group . '_items_count', $count + 1);
        return;
    }

    $definitions = gravedad_content_panel_definitions();
    $default = isset($definitions[$page][$collection]) ? count($definitions[$page][$collection]) : 1;
    $count = gravedad_content_panel_count($page, $collection, $default);
    update_option('gravedad_content_' . $page . '_' . $collection . '_count', $count + 1);
}

function gravedad_content_panel_remove_item($page, $spec) {
    $parts = explode(':', $spec);
    $collection = sanitize_key($parts[0]);

    if ($collection === 'faq_items') {
        $group = isset($parts[1]) ? sanitize_key($parts[1]) : '';
        $index = isset($parts[2]) ? (int) $parts[2] : 0;
        if (!$group || $index < 1) { return; }
        $count = gravedad_content_panel_count($page, $group . '_items', gravedad_content_faq_group_default_items($group));
        if ($count <= 1) { return; }
        gravedad_content_panel_shift_down($page, $group . '_q%d', $index, $count);
        gravedad_content_panel_shift_down($page, $group . '_a%d', $index, $count);
        update_option('gravedad_content_' . $page . '_' . $group . '_items_count', $count - 1);
        return;
    }

    $index = isset($parts[1]) ? (int) $parts[1] : 0;
    if ($index < 1) { return; }
    $templates = array(
        'steps' => array('paso%d_titulo', 'paso%d_texto'),
        'zonas' => array('zona%d_nombre', 'zona%d_tiempo', 'zona%d_costo'),
        'bloques' => array('bloque%d_titulo', 'bloque%d_texto'),
        'condiciones' => array('cond%d_titulo', 'cond%d_texto'),
    );
    if (!isset($templates[$collection])) { return; }
    $definitions = gravedad_content_panel_definitions();
    $default = isset($definitions[$page][$collection]) ? count($definitions[$page][$collection]) : 1;
    $count = gravedad_content_panel_count($page, $collection, $default);
    if ($count <= 1) { return; }
    foreach ($templates[$collection] as $tpl) {
        gravedad_content_panel_shift_down($page, $tpl, $index, $count);
    }
    update_option('gravedad_content_' . $page . '_' . $collection . '_count', $count - 1);
}

function gravedad_content_panel_save() {
    if (!isset($_POST['gravedad_content_nonce']) || !wp_verify_nonce($_POST['gravedad_content_nonce'], 'gravedad_content_save')) { return; }
    if (!current_user_can('manage_options')) { return; }
    $page_key = isset($_POST['gravedad_content_page']) ? sanitize_key($_POST['gravedad_content_page']) : '';
    $definitions = gravedad_content_panel_definitions();
    if (!isset($definitions[$page_key])) { return; }
    foreach ($_POST as $post_key => $raw_value) {
        if (strpos($post_key, 'gc_') !== 0) { continue; }
        $option_key = 'gravedad_content_' . $page_key . '_' . substr($post_key, 3);
        $value = sanitize_textarea_field(wp_unslash($raw_value));
        update_option($option_key, $value);
    }
    if (!empty($_POST['content_add_item'])) {
        gravedad_content_panel_add_item($page_key, sanitize_text_field(wp_unslash($_POST['content_add_item'])));
    } elseif (!empty($_POST['content_remove_item'])) {
        gravedad_content_panel_remove_item($page_key, sanitize_text_field(wp_unslash($_POST['content_remove_item'])));
    }
    wp_safe_redirect(add_query_arg(array('page' => $definitions[$page_key]['slug'], 'guardado' => '1'), admin_url('admin.php')));
    exit;
}
add_action('admin_post_gravedad_content_save', 'gravedad_content_panel_save');

function gravedad_content_field($label, $name, $value, $textarea = false, $rows = 3) {
    echo '<label class="gravedad-panel-field gravedad-panel-field--full">';
    echo '<span class="gravedad-panel-field__label">' . esc_html($label) . '</span>';
    if ($textarea) {
        echo '<textarea name="' . esc_attr($name) . '" rows="' . esc_attr($rows) . '">' . esc_textarea($value) . '</textarea>';
    } else {
        echo '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '">';
    }
    echo '</label>';
}

function gravedad_content_panel_render($key, $def) {
    if (!current_user_can('manage_options')) { return; }
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1><?php echo esc_html($def['page_title']); ?></h1><p><?php echo esc_html($def['ayuda']); ?></p></div>
        </div>
      </header>
      <p><a href="<?php echo esc_url(admin_url('admin.php?page=gravedad-panel')); ?>">← Volver a Editar Sitio</a></p>

      <?php if (isset($_GET['guardado'])): ?>
      <div class="gravedad-panel-notice">✓ Los cambios se guardaron correctamente.</div>
      <?php endif; ?>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="gravedad-panel-form">
        <input type="hidden" name="action" value="gravedad_content_save">
        <input type="hidden" name="gravedad_content_page" value="<?php echo esc_attr($key); ?>">
        <?php wp_nonce_field('gravedad_content_save', 'gravedad_content_nonce'); ?>

        <?php if ($key === 'faq'): foreach ($def['groups'] as $gkey => $group):
          $items_count = gravedad_content_panel_count($key, $gkey . '_items', count($group['items']));
        ?>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">💬</span>
            <div>
              <h2>Grupo de preguntas</h2>
              <p>El nombre del grupo aparece como categoría en la página de Preguntas frecuentes.</p>
            </div>
          </div>
          <?php gravedad_content_field('Nombre del grupo', 'gc_' . $gkey . '_label', gravedad_content_panel_opt($key, $gkey . '_label', $group['label'])); ?>
          <?php for ($n = 1; $n <= $items_count; $n++):
            $default_item = isset($group['items'][$n - 1]) ? $group['items'][$n - 1] : array('q' => '', 'a' => '');
          ?>
          <div class="gravedad-panel-item">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body">
              <?php gravedad_content_field('Pregunta ' . $n, 'gc_' . $gkey . '_q' . $n, gravedad_content_panel_opt($key, $gkey . '_q' . $n, $default_item['q'])); ?>
              <?php gravedad_content_field('Respuesta ' . $n, 'gc_' . $gkey . '_a' . $n, gravedad_content_panel_opt($key, $gkey . '_a' . $n, $default_item['a']), true); ?>
            </div>
            <?php if ($items_count > 1): ?>
            <button type="submit" name="content_remove_item" value="faq_items:<?php echo esc_attr($gkey); ?>:<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar esta pregunta?');" title="Quitar pregunta">✕</button>
            <?php endif; ?>
          </div>
          <?php endfor; ?>
          <button type="submit" name="content_add_item" value="faq_items:<?php echo esc_attr($gkey); ?>" class="gravedad-panel-add" formnovalidate>+ Agregar pregunta</button>
        </section>
        <?php endforeach; endif; ?>

        <?php if ($key === 'como-comprar'):
          $steps_count = gravedad_content_panel_count($key, 'steps', count($def['steps']));
        ?>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🛒</span><div><h2>Pasos de compra</h2><p>Se muestran en orden en la página "Cómo comprar".</p></div></div>
          <?php for ($n = 1; $n <= $steps_count; $n++):
            $default_step = isset($def['steps'][$n - 1]) ? $def['steps'][$n - 1] : array('titulo' => '', 'texto' => '');
          ?>
          <div class="gravedad-panel-item">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body">
              <?php gravedad_content_field('Título del paso ' . $n, 'gc_paso' . $n . '_titulo', gravedad_content_panel_opt($key, 'paso' . $n . '_titulo', $default_step['titulo'])); ?>
              <?php gravedad_content_field('Texto del paso ' . $n, 'gc_paso' . $n . '_texto', gravedad_content_panel_opt($key, 'paso' . $n . '_texto', $default_step['texto']), true, 2); ?>
            </div>
            <?php if ($steps_count > 1): ?>
            <button type="submit" name="content_remove_item" value="steps:<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar este paso?');" title="Quitar paso">✕</button>
            <?php endif; ?>
          </div>
          <?php endfor; ?>
          <button type="submit" name="content_add_item" value="steps" class="gravedad-panel-add" formnovalidate>+ Agregar paso</button>
        </section>
        <?php endif; ?>

        <?php if ($key === 'envios'):
          $zonas_count = gravedad_content_panel_count($key, 'zonas', count($def['zonas']));
          $bloques_count = gravedad_content_panel_count($key, 'bloques', count($def['bloques']));
        ?>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🚚</span><div><h2>Zonas de envío</h2><p>Nombre, tiempo estimado y costo de cada zona.</p></div></div>
          <?php for ($n = 1; $n <= $zonas_count; $n++):
            $default_zona = isset($def['zonas'][$n - 1]) ? $def['zonas'][$n - 1] : array('nombre' => '', 'tiempo' => '', 'costo' => '');
          ?>
          <div class="gravedad-panel-item">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body gravedad-panel-item__body--trio">
              <?php gravedad_content_field('Zona ' . $n, 'gc_zona' . $n . '_nombre', gravedad_content_panel_opt($key, 'zona' . $n . '_nombre', $default_zona['nombre'])); ?>
              <?php gravedad_content_field('Tiempo', 'gc_zona' . $n . '_tiempo', gravedad_content_panel_opt($key, 'zona' . $n . '_tiempo', $default_zona['tiempo'])); ?>
              <?php gravedad_content_field('Costo', 'gc_zona' . $n . '_costo', gravedad_content_panel_opt($key, 'zona' . $n . '_costo', $default_zona['costo'])); ?>
            </div>
            <?php if ($zonas_count > 1): ?>
            <button type="submit" name="content_remove_item" value="zonas:<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar esta zona?');" title="Quitar zona">✕</button>
            <?php endif; ?>
          </div>
          <?php endfor; ?>
          <button type="submit" name="content_add_item" value="zonas" class="gravedad-panel-add" formnovalidate>+ Agregar zona</button>
        </section>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">📦</span><div><h2>Bloques informativos</h2><p>Textos adicionales debajo de las zonas de envío.</p></div></div>
          <?php for ($n = 1; $n <= $bloques_count; $n++):
            $default_bloque = isset($def['bloques'][$n - 1]) ? $def['bloques'][$n - 1] : array('titulo' => '', 'texto' => '');
          ?>
          <div class="gravedad-panel-item">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body">
              <?php gravedad_content_field('Título', 'gc_bloque' . $n . '_titulo', gravedad_content_panel_opt($key, 'bloque' . $n . '_titulo', $default_bloque['titulo'])); ?>
              <?php gravedad_content_field('Texto (una línea por punto)', 'gc_bloque' . $n . '_texto', gravedad_content_panel_opt($key, 'bloque' . $n . '_texto', $default_bloque['texto']), true, 3); ?>
            </div>
            <?php if ($bloques_count > 1): ?>
            <button type="submit" name="content_remove_item" value="bloques:<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar este bloque?');" title="Quitar bloque">✕</button>
            <?php endif; ?>
          </div>
          <?php endfor; ?>
          <button type="submit" name="content_add_item" value="bloques" class="gravedad-panel-add" formnovalidate>+ Agregar bloque</button>
        </section>
        <?php endif; ?>

        <?php if ($key === 'cambios'):
          $cond_count = gravedad_content_panel_count($key, 'condiciones', count($def['condiciones']));
          $bloques_count = gravedad_content_panel_count($key, 'bloques', count($def['bloques']));
        ?>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🔄</span><div><h2>Condiciones</h2><p>Se muestran como tarjetas breves en la página.</p></div></div>
          <?php for ($n = 1; $n <= $cond_count; $n++):
            $default_cond = isset($def['condiciones'][$n - 1]) ? $def['condiciones'][$n - 1] : array('titulo' => '', 'texto' => '');
          ?>
          <div class="gravedad-panel-item">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body">
              <?php gravedad_content_field('Título ' . $n, 'gc_cond' . $n . '_titulo', gravedad_content_panel_opt($key, 'cond' . $n . '_titulo', $default_cond['titulo'])); ?>
              <?php gravedad_content_field('Texto ' . $n, 'gc_cond' . $n . '_texto', gravedad_content_panel_opt($key, 'cond' . $n . '_texto', $default_cond['texto']), true, 2); ?>
            </div>
            <?php if ($cond_count > 1): ?>
            <button type="submit" name="content_remove_item" value="condiciones:<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar esta condición?');" title="Quitar condición">✕</button>
            <?php endif; ?>
          </div>
          <?php endfor; ?>
          <button type="submit" name="content_add_item" value="condiciones" class="gravedad-panel-add" formnovalidate>+ Agregar condición</button>
        </section>
        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">📦</span><div><h2>Bloques informativos</h2><p>Textos adicionales debajo de las condiciones.</p></div></div>
          <?php for ($n = 1; $n <= $bloques_count; $n++):
            $default_bloque = isset($def['bloques'][$n - 1]) ? $def['bloques'][$n - 1] : array('titulo' => '', 'texto' => '');
          ?>
          <div class="gravedad-panel-item">
            <span class="gravedad-panel-item__badge"><?php echo esc_html($n); ?></span>
            <div class="gravedad-panel-item__body">
              <?php gravedad_content_field('Título', 'gc_bloque' . $n . '_titulo', gravedad_content_panel_opt($key, 'bloque' . $n . '_titulo', $default_bloque['titulo'])); ?>
              <?php gravedad_content_field('Texto (una línea por punto)', 'gc_bloque' . $n . '_texto', gravedad_content_panel_opt($key, 'bloque' . $n . '_texto', $default_bloque['texto']), true, 3); ?>
            </div>
            <?php if ($bloques_count > 1): ?>
            <button type="submit" name="content_remove_item" value="bloques:<?php echo esc_attr($n); ?>" class="gravedad-panel-item__remove" formnovalidate onclick="return confirm('¿Quitar este bloque?');" title="Quitar bloque">✕</button>
            <?php endif; ?>
          </div>
          <?php endfor; ?>
          <button type="submit" name="content_add_item" value="bloques" class="gravedad-panel-add" formnovalidate>+ Agregar bloque</button>
        </section>
        <?php endif; ?>

        <div class="gravedad-panel-save"><button type="submit" class="button button-primary">Guardar cambios</button></div>
      </form>
    </div>
    <?php
}
