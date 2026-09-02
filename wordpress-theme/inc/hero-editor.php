<?php
defined('ABSPATH') || exit;

/**
 * Editor del hero (la portada grande) de la página de inicio: textos,
 * botones, imagen y video de fondo, todo editable desde "Editar Sitio"
 * sin tocar código. Los límites de caracteres son una guía (no bloquean
 * el guardado) para que el texto no se corte ni se vea apretado en el
 * diseño actual.
 */

function gravedad_hero_defaults() {
    return array(
        'eyebrow' => 'TODO TU UNIVERSO TCG',
        'titulo_1' => 'Entrá en',
        'titulo_2' => 'otra dimensión.',
        'texto' => 'Cartas, juegos y accesorios para quienes no vienen solamente a jugar.',
        'boton1_texto' => 'Explorar novedades',
        'boton1_url' => function_exists('gravedad_shop_url') ? gravedad_shop_url('novedades') : home_url('/'),
        'boton2_texto' => 'Ver cartas sueltas',
        'boton2_url' => function_exists('gravedad_shop_url') ? gravedad_shop_url('cartas-sueltas') : home_url('/'),
        'imagen' => get_template_directory_uri() . '/assets/img/hero-gravedad.jpg',
        'video' => get_template_directory_uri() . '/assets/img/video/hero-loop.mp4',
    );
}

function gravedad_hero_opt($field) {
    $defaults = gravedad_hero_defaults();
    $default = isset($defaults[$field]) ? $defaults[$field] : '';
    return get_option('gravedad_hero_' . $field, $default);
}

function gravedad_hero_menu() {
    add_submenu_page('gravedad-panel', 'Hero de la home', 'Hero de la home', 'manage_options', 'gravedad-hero', 'gravedad_hero_render');
}
add_action('admin_menu', 'gravedad_hero_menu', 20);

function gravedad_hero_assets($hook) {
    $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
    if ($page !== 'gravedad-hero') { return; }
    wp_enqueue_media();
    wp_enqueue_style('gravedad-admin-panel', get_template_directory_uri() . '/assets/css/admin-panel.css', array(), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-hero-editor', get_template_directory_uri() . '/assets/css/hero-editor.css', array('gravedad-admin-panel'), GRAVEDAD_VERSION);
    wp_enqueue_script('gravedad-hero-editor', get_template_directory_uri() . '/assets/js/hero-editor.js', array('jquery'), GRAVEDAD_VERSION, true);
}
add_action('admin_enqueue_scripts', 'gravedad_hero_assets');

function gravedad_hero_save() {
    if (!isset($_POST['gravedad_hero_nonce']) || !wp_verify_nonce($_POST['gravedad_hero_nonce'], 'gravedad_hero_save')) { return; }
    if (!current_user_can('manage_options')) { return; }

    $text_fields = array('eyebrow', 'titulo_1', 'titulo_2', 'texto', 'boton1_texto', 'boton2_texto');
    foreach ($text_fields as $f) {
        if (isset($_POST['gh_' . $f])) {
            update_option('gravedad_hero_' . $f, sanitize_text_field(wp_unslash($_POST['gh_' . $f])));
        }
    }

    $url_fields = array('boton1_url', 'boton2_url', 'imagen', 'video');
    foreach ($url_fields as $f) {
        if (isset($_POST['gh_' . $f])) {
            update_option('gravedad_hero_' . $f, esc_url_raw(wp_unslash($_POST['gh_' . $f])));
        }
    }

    wp_safe_redirect(add_query_arg(array('page' => 'gravedad-hero', 'guardado' => '1'), admin_url('admin.php')));
    exit;
}
add_action('admin_post_gravedad_hero_save', 'gravedad_hero_save');

function gravedad_hero_field($label, $name, $value, $max = 0, $help = '') {
    echo '<label class="gravedad-panel-field gravedad-panel-field--full"' . ($max ? ' data-hero-counter="' . esc_attr($max) . '"' : '') . '>';
    echo '<span class="gravedad-panel-field__label">' . esc_html($label) . '</span>';
    echo '<input type="text" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '"' . ($max ? ' class="hero-count-input"' : '') . '>';
    if ($max) { echo '<span class="hero-char-count"><span class="hero-char-count-num">0</span> / ' . esc_html($max) . ' caracteres recomendados</span>'; }
    if ($help) { echo '<small>' . esc_html($help) . '</small>'; }
    echo '</label>';
}

function gravedad_hero_media_field($label, $name, $value, $type, $help) {
    $input_id = 'hero-input-' . $name;
    $preview_id = 'hero-preview-' . $name;
    echo '<div class="gravedad-panel-field gravedad-panel-field--full hero-media-field">';
    echo '<span class="gravedad-panel-field__label">' . esc_html($label) . '</span>';
    echo '<div class="hero-media-row">';
    echo '<div class="hero-media-preview" id="' . esc_attr($preview_id) . '">';
    if ($value) {
        if ($type === 'video') {
            echo '<video src="' . esc_url($value) . '" muted loop autoplay playsinline></video>';
        } else {
            echo '<img src="' . esc_url($value) . '" alt="">';
        }
    } else {
        echo '<span class="hero-media-empty">Sin ' . ($type === 'video' ? 'video' : 'imagen') . '</span>';
    }
    echo '</div>';
    echo '<div class="hero-media-actions">';
    echo '<input type="hidden" id="' . esc_attr($input_id) . '" name="' . esc_attr($name) . '" value="' . esc_attr($value) . '">';
    echo '<button type="button" class="button hero-media-pick" data-hero-media="' . esc_attr($type) . '" data-target="' . esc_attr($input_id) . '" data-preview="' . esc_attr($preview_id) . '">' . ($value ? 'Cambiar' : 'Elegir') . ' ' . ($type === 'video' ? 'video' : 'imagen') . '</button>';
    if ($type === 'video') { echo '<button type="button" class="button-link hero-media-clear" data-hero-clear data-target="' . esc_attr($input_id) . '" data-preview="' . esc_attr($preview_id) . '">Quitar video</button>'; }
    echo '<small>' . esc_html($help) . '</small>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

function gravedad_hero_render() {
    if (!current_user_can('manage_options')) { return; }
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1>Hero de la home</h1><p>La portada grande de la página de inicio: título, texto, botones e imagen/video de fondo.</p></div>
        </div>
      </header>
      <p><a href="<?php echo esc_url(admin_url('admin.php?page=gravedad-panel')); ?>">← Volver a Editar Sitio</a></p>

      <?php if (isset($_GET['guardado'])): ?>
      <div class="gravedad-panel-notice">✓ Los cambios se guardaron correctamente.</div>
      <?php endif; ?>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="gravedad-panel-form">
        <input type="hidden" name="action" value="gravedad_hero_save">
        <?php wp_nonce_field('gravedad_hero_save', 'gravedad_hero_nonce'); ?>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">✏️</span><div><h2>Textos</h2><p>El título se arma en dos líneas: la segunda queda resaltada en dorado.</p></div></div>
          <?php
            gravedad_hero_field('Etiqueta chica de arriba', 'gh_eyebrow', gravedad_hero_opt('eyebrow'), 40, 'El textito pequeño con el puntito dorado, arriba del título. Todo en mayúsculas.');
            gravedad_hero_field('Título — línea 1', 'gh_titulo_1', gravedad_hero_opt('titulo_1'), 20, 'La primera línea del título grande, en blanco.');
            gravedad_hero_field('Título — línea 2 (resaltada)', 'gh_titulo_2', gravedad_hero_opt('titulo_2'), 20, 'La segunda línea, se muestra en dorado. El título es MUY grande, por eso conviene que cada línea sea corta.');
            gravedad_hero_field('Texto debajo del título', 'gh_texto', gravedad_hero_opt('texto'), 110, 'Una o dos frases cortas. Si es muy largo se corta feo en pantallas chicas.');
          ?>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🔘</span><div><h2>Botones</h2><p>Los dos botones de acción del hero.</p></div></div>
          <div class="gravedad-panel-card__grid gravedad-panel-card__grid--pair">
            <?php
              gravedad_hero_field('Botón 1 (relleno) — texto', 'gh_boton1_texto', gravedad_hero_opt('boton1_texto'), 24, 'La flecha → se agrega sola, no hace falta escribirla.');
              gravedad_hero_field('Botón 1 — a dónde lleva', 'gh_boton1_url', gravedad_hero_opt('boton1_url'), 0, 'Pegá acá el link completo de la página a la que tiene que ir.');
            ?>
          </div>
          <div class="gravedad-panel-card__grid gravedad-panel-card__grid--pair">
            <?php
              gravedad_hero_field('Botón 2 (contorno) — texto', 'gh_boton2_texto', gravedad_hero_opt('boton2_texto'), 24, '');
              gravedad_hero_field('Botón 2 — a dónde lleva', 'gh_boton2_url', gravedad_hero_opt('boton2_url'), 0, 'Pegá acá el link completo de la página a la que tiene que ir.');
            ?>
          </div>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🖼️</span><div><h2>Imagen de fondo</h2><p>Se ve siempre (el video, si hay, se reproduce encima).</p></div></div>
          <?php gravedad_hero_media_field('Imagen', 'gh_imagen', gravedad_hero_opt('imagen'), 'image', 'Horizontal (apaisada), mínimo 1920×1080 px. Formato .jpg. Comprimila antes de subir (tinypng.com o squoosh.app) apuntando a menos de 500 KB: es la primera imagen que carga el sitio, así que su peso afecta la velocidad de toda la home.'); ?>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🎬</span><div><h2>Video de fondo (opcional)</h2><p>Si no cargás uno, se muestra solo la imagen de arriba — se ve igual de bien.</p></div></div>
          <?php gravedad_hero_media_field('Video', 'gh_video', gravedad_hero_opt('video'), 'video', 'Formato .mp4, horizontal. Sin audio (no se escucha, es solo decorativo). Idealmente entre 5 y 15 segundos en loop. Comprimilo y apuntá a menos de 5–8 MB: un video pesado hace que la home tarde más en cargar.'); ?>
        </section>

        <div class="gravedad-panel-save"><button type="submit" class="button button-primary">Guardar cambios</button></div>
      </form>
    </div>
    <?php
}
