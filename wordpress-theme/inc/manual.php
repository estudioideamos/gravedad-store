<?php
defined('ABSPATH') || exit;

/**
 * Manual de uso: una guía en español simple de todo lo que se puede
 * autogestionar desde "Editar Sitio", pensada para quien administra el
 * día a día del negocio sin conocimientos técnicos.
 */

function gravedad_manual_menu() {
    add_submenu_page('gravedad-panel', 'Manual de uso', 'Manual de uso', 'manage_options', 'gravedad-manual', 'gravedad_manual_render');
}
add_action('admin_menu', 'gravedad_manual_menu', 30);

function gravedad_manual_assets($hook) {
    $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
    if ($page !== 'gravedad-manual') { return; }
    wp_enqueue_style('gravedad-admin-panel', get_template_directory_uri() . '/assets/css/admin-panel.css', array(), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-manual', get_template_directory_uri() . '/assets/css/manual.css', array('gravedad-admin-panel'), GRAVEDAD_VERSION);
}
add_action('admin_enqueue_scripts', 'gravedad_manual_assets');

function gravedad_manual_sections() {
    return array(
        array(
            'icon' => '🧭',
            'title' => 'Editar Sitio: pantalla principal',
            'where' => 'Menú lateral → Editar Sitio',
            'items' => array(
                array('¿Qué es?', 'La pantalla donde cambiás los datos generales del sitio: WhatsApp, email de contacto, Instagram, avisos del cartel superior, datos del evento destacado, cotización del dólar y datos de la tienda.'),
                array('¿Cómo se usa?', 'Completá los campos que quieras cambiar y tocá "Guardar cambios" al final de la página. Los cambios se ven en el sitio al instante.'),
                array('Cotización del dólar', 'Se actualiza sola cada 1 hora tomando el dólar oficial de dolarapi.com. Si cargás un número en "Cotización manual", ese pisa al automático hasta que lo borres.'),
            ),
        ),
        array(
            'icon' => '❓',
            'title' => 'Preguntas frecuentes',
            'where' => 'Menú lateral → Editar Sitio → Preguntas frecuentes',
            'items' => array(
                array('¿Qué es?', 'Las preguntas y respuestas que se ven agrupadas en la página "Preguntas frecuentes" del sitio.'),
                array('Agregar una pregunta', 'Dentro de cada grupo (Pedidos y pagos, Envíos y retiro, etc.) tocá "+ Agregar pregunta" al final. Se guarda lo que ya escribiste y aparece un espacio nuevo para completar.'),
                array('Quitar una pregunta', 'Tocá la ✕ al lado de la pregunta que querés borrar. Te pide confirmación antes de borrarla.'),
                array('Reordenar', 'No se pueden arrastrar estas preguntas para reordenar; si querés otro orden, cambiá el texto entre los campos existentes.'),
            ),
        ),
        array(
            'icon' => '🛒',
            'title' => 'Cómo comprar / Envíos / Cambios y devoluciones',
            'where' => 'Menú lateral → Editar Sitio → (cada una de esas páginas)',
            'items' => array(
                array('¿Qué es?', 'El contenido de esas 3 páginas de ayuda del sitio: los pasos de compra, las zonas y tiempos de envío, y las condiciones de cambio.'),
                array('¿Cómo se usa?', 'Igual que Preguntas frecuentes: completás los campos de texto (sin necesidad de saber HTML ni diseño) y podés agregar o quitar ítems con los botones "+ Agregar" y "✕".'),
                array('Texto con varias líneas', 'En los campos que dicen "una línea por punto", cada línea que escribas se muestra como un punto de una lista aparte en la página.'),
            ),
        ),
        array(
            'icon' => '🧭',
            'title' => 'Menú de navegación (la barra de arriba)',
            'where' => 'Menú lateral → Editar Sitio → Menú',
            'items' => array(
                array('Ítems principales', 'Podés cambiar el TEXTO de Inicio, TCG, Cartas sueltas, Juegos de mesa y Accesorios. El link al que apuntan (sus categorías reales de la tienda) no se toca desde acá, para que nunca se rompa.'),
                array('Otros ítems (Preventas, Novedades, Ofertas, Eventos...)', 'Acá sí podés editar tanto el texto como el link, agregar ítems nuevos con "+ Agregar ítem al menú", o sacarlos con la ✕.'),
            ),
        ),
        array(
            'icon' => '🎮',
            'title' => 'Menús desplegables (TCG, Cartas sueltas, Juegos de mesa, Accesorios)',
            'where' => 'Menú lateral → Editar Sitio → Menús desplegables',
            'items' => array(
                array('¿Qué es?', 'El editor visual de lo que aparece al pasar el mouse sobre TCG, Cartas sueltas, Juegos de mesa o Accesorios en el menú de arriba.'),
                array('Arrastrar para reordenar', 'Tocá y arrastrá desde el ícono ⠿⠿ para cambiar el orden de los juegos o de las opciones de cada columna.'),
                array('Agregar / quitar', 'Usá "+ Agregar" para sumar una fila nueva (elegís de una lista desplegable qué categoría real mostrar) y la ✕ para sacar una que no quieras más.'),
                array('TCG: juegos y "Cartas sueltas"', 'Cada juego (Magic, Pokémon, etc.) tiene su propio bloque con un checkbox para mostrar u ocultar el link "Cartas sueltas" de ese juego en particular.'),
                array('Importante', 'Todo lo que elegís acá son categorías/atributos que YA EXISTEN en la tienda (no podés escribir texto libre), así que nunca se puede armar un link roto.'),
            ),
        ),
        array(
            'icon' => '📦',
            'title' => 'Productos',
            'where' => 'Menú lateral → Productos',
            'items' => array(
                array('Cargar un producto', 'Productos → Añadir producto. Completá nombre, descripción, precio y subí una foto. En "Categorías" elegí dónde va a aparecer (TCG, Cartas sueltas, Juegos de mesa, Accesorios).'),
                array('Atributos (Juego, Rareza, Idioma, etc.)', 'En la ficha del producto, sección "Atributos": ahí se elige el juego, la rareza, el idioma, el tipo de producto, etc. Esto es lo que hace que el producto aparezca al usar los filtros y los menús desplegables.'),
                array('Cartel de "FOIL" brillante', 'Si un producto tiene el atributo "Foil / Acabado" en algo distinto de "No Foil" (Foil, Holo, Reverse Holo), le aparece automáticamente un cartel plateado brillante en la tienda, igual que el de "OFERTA". No hay que hacer nada más que cargar ese atributo.'),
                array('Cartel de "OFERTA"', 'Aparece solo cuando cargás un "Precio rebajado" en la ficha del producto (además del precio normal).'),
            ),
        ),
        array(
            'icon' => '💵',
            'title' => 'Precios en pesos y en dólares',
            'where' => 'Productos → (elegir un producto) → sección "Precio del producto"',
            'items' => array(
                array('Dos formas de poner precio', 'Podés cargar el precio en pesos como siempre (campo "Precio regular"), o cargar el precio en dólares (campo "Precio en USD", más abajo en esa misma sección) y dejar que el sitio calcule solo el precio en pesos.'),
                array('¿Cómo funciona el precio en USD?', 'Si completás "Precio en USD (opcional)", al guardar el producto el sitio multiplica ese número por la cotización del dólar del momento y pisa automáticamente el precio en pesos. Lo mismo con "Precio de oferta en USD" para el precio rebajado.'),
                array('¿De dónde sale la cotización?', 'Del dólar oficial de dolarapi.com. Se actualiza sola cada 1 hora. Podés ver la cotización que se está usando en este momento en Editar Sitio → pantalla principal → sección "Cotización del dólar".'),
                array('¿Se actualizan los precios solos cuando cambia el dólar?', 'Sí: todos los productos que tengan cargado un "Precio en USD" se recalculan automáticamente cada vez que se actualiza la cotización (cada 1 hora), sin que tengas que tocar nada. Los productos con precio fijo en pesos no se ven afectados nunca por esto.'),
                array('¿Puedo fijar yo la cotización?', 'Sí. En Editar Sitio → "Cotización manual" cargá el número que quieras y ese va a pisar al automático (útil si querés redondear o dejar un valor fijo por un tiempo). Borrá ese campo para volver a la cotización automática.'),
                array('¿Qué ve el cliente?', 'En la ficha del producto, debajo del precio en pesos, aparece una referencia chiquita tipo "≈ USD 45,00 · cotización $1.530" solo en los productos que tienen precio en USD cargado.'),
            ),
        ),
        array(
            'icon' => '🎟️',
            'title' => 'Eventos',
            'where' => 'Menú lateral → Eventos',
            'items' => array(
                array('¿Qué es?', 'Los torneos/eventos que se muestran en la página "Eventos" y el próximo evento destacado de la home.'),
                array('Cargar uno nuevo', 'Eventos → Añadir evento. Completá fecha, título, descripción y subí una imagen tipo flyer.'),
            ),
        ),
        array(
            'icon' => '💬',
            'title' => 'Datos de contacto que se usan en todo el sitio',
            'where' => 'Menú lateral → Editar Sitio (pantalla principal)',
            'items' => array(
                array('WhatsApp', 'Un solo número controla TODOS los botones de WhatsApp del sitio (header, footer, ficha de producto, checkout). Se carga sin espacios ni el signo +, ej: 542320673750.'),
                array('Email de contacto', 'Se usa en el pie de página y en el botón de mail. Es independiente del email de WordPress o del email de las notificaciones de pedidos de WooCommerce — esos se cambian por separado en Ajustes Generales y en WooCommerce → Ajustes → Correos.'),
            ),
        ),
    );
}

function gravedad_manual_render() {
    if (!current_user_can('manage_options')) { return; }
    $sections = gravedad_manual_sections();
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1>Manual de uso</h1><p>Guía rápida de todo lo que podés cambiar vos mismo en el sitio, sin depender de un desarrollador.</p></div>
        </div>
      </header>
      <p><a href="<?php echo esc_url(admin_url('admin.php?page=gravedad-panel')); ?>">← Volver a Editar Sitio</a></p>

      <p class="gravedad-manual-toc-label">Saltar directo a un tema</p>
      <div class="gravedad-manual-toc">
        <?php foreach ($sections as $i => $s): ?>
        <a href="#manual-<?php echo esc_attr($i); ?>">
          <span class="gravedad-manual-toc-icon"><?php echo esc_html($s['icon']); ?></span>
          <span class="gravedad-manual-toc-title"><?php echo esc_html($s['title']); ?></span>
          <span class="gravedad-manual-toc-arrow">→</span>
        </a>
        <?php endforeach; ?>
      </div>

      <?php foreach ($sections as $i => $s): ?>
      <section class="gravedad-panel-card gravedad-manual-card" id="manual-<?php echo esc_attr($i); ?>">
        <span class="gravedad-manual-num"><?php echo esc_html($i + 1); ?></span>
        <div class="gravedad-panel-card__head">
          <span class="gravedad-panel-card__icon"><?php echo esc_html($s['icon']); ?></span>
          <div>
            <h2><?php echo esc_html($s['title']); ?></h2>
            <p class="gravedad-manual-where">📍 <?php echo esc_html($s['where']); ?></p>
          </div>
        </div>
        <dl class="gravedad-manual-list">
          <?php foreach ($s['items'] as $item): ?>
          <div class="gravedad-manual-item">
            <dt><?php echo esc_html($item[0]); ?></dt>
            <dd><?php echo esc_html($item[1]); ?></dd>
          </div>
          <?php endforeach; ?>
        </dl>
      </section>
      <?php endforeach; ?>

      <section class="gravedad-panel-card">
        <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🆘</span><div><h2>¿Algo no anda o no sabés cómo hacer algo?</h2></div></div>
        <p class="gravedad-manual-help">Escribile a Estudio Ideamos y lo vemos juntos: <a href="https://ideamos.com.ar" target="_blank" rel="noopener">ideamos.com.ar</a></p>
      </section>
    </div>
    <?php
}
