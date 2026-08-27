<?php
defined('ABSPATH') || exit;

/**
 * Editor visual de los menús desplegables (TCG, Cartas sueltas, Juegos de
 * mesa, Accesorios): el admin arrastra y asigna categorías/atributos
 * REALES de la tienda en vez de que un desarrollador toque código. Los
 * valores guardados son siempre slugs de términos de WooCommerce; si un
 * término ya no existe, se muestra el último texto conocido en vez de una
 * etiqueta vacía o un link roto silencioso.
 */

function gravedad_mm_legacy_labels() {
    return array(
        'magic-the-gathering' => 'Magic: The Gathering', 'pokemon' => 'Pokémon', 'one-piece' => 'One Piece',
        'digimon' => 'Digimon', 'dragon-ball' => 'Dragon Ball', 'yu-gi-oh' => 'Yu-Gi-Oh!', 'otros' => 'Otros',
        'sobres' => 'Sobres', 'booster-box' => 'Booster Box', 'collector-booster' => 'Collector Booster',
        'productos-especiales' => 'Productos especiales', 'booster-pack' => 'Booster Pack', 'structure-deck' => 'Structure Deck',
        'legendary-decks' => 'Legendary Decks', 'tins' => 'Tins', 'starter-decks' => 'Starter Decks',
        'comun' => 'Común', 'infrecuente' => 'Infrecuente', 'rara' => 'Rara', 'mitica' => 'Mítica', 'promo' => 'Promo', 'especial' => 'Especial',
        'espanol' => 'Español', 'ingles' => 'Inglés', 'japones' => 'Japonés', 'portugues' => 'Portugués',
        'devir' => 'Devir', 'buro' => 'Buró', 'popullar' => 'Popullar', 'otras-editoriales' => 'Otras editoriales',
        'familiares' => 'Familiares', 'party-games' => 'Party Games', 'estrategia' => 'Estrategia', 'cooperativos' => 'Cooperativos',
        'para-2-jugadores' => 'Para 2 jugadores', 'infantiles' => 'Infantiles', 'juegos-de-cartas' => 'Juegos de cartas', 'rol-aventura' => 'Rol / Aventura',
        'folios-sleeves' => 'Folios / Sleeves', 'deck-boxes' => 'Deck Boxes', 'carpetas' => 'Carpetas', 'playmats' => 'Playmats',
        'dados-y-contadores' => 'Dados y Contadores', 'almacenamiento' => 'Almacenamiento',
        'dragon-shield' => 'Dragon Shield', 'ultra-pro' => 'Ultra Pro', 'ultimate-guard' => 'Ultimate Guard', 'kmc' => 'KMC',
    );
}

function gravedad_mm_defaults() {
    return array(
        'tcg' => array(
            array('juego' => 'magic-the-gathering', 'sueltas' => 1, 'tipos' => array('sobres', 'booster-box', 'collector-booster', 'productos-especiales')),
            array('juego' => 'pokemon', 'sueltas' => 1, 'tipos' => array('sobres', 'booster-box', 'productos-especiales')),
            array('juego' => 'one-piece', 'sueltas' => 1, 'tipos' => array('sobres', 'booster-box', 'productos-especiales')),
            array('juego' => 'digimon', 'sueltas' => 1, 'tipos' => array('sobres', 'booster-box', 'productos-especiales')),
            array('juego' => 'dragon-ball', 'sueltas' => 1, 'tipos' => array('sobres', 'booster-box', 'productos-especiales')),
            array('juego' => 'yu-gi-oh', 'sueltas' => 0, 'tipos' => array('booster-pack', 'structure-deck', 'legendary-decks', 'tins', 'starter-decks', 'otros')),
        ),
        'cartas-sueltas' => array(
            'juego' => array('magic-the-gathering', 'pokemon', 'one-piece', 'digimon', 'dragon-ball', 'otros'),
            'rareza' => array('comun', 'infrecuente', 'rara', 'mitica', 'promo', 'especial'),
            'idioma' => array('espanol', 'ingles', 'japones', 'portugues'),
        ),
        'juegos-de-mesa' => array(
            'editorial' => array('devir', 'buro', 'popullar', 'otras-editoriales'),
            'tipo-juego' => array('familiares', 'party-games', 'estrategia', 'cooperativos', 'para-2-jugadores', 'infantiles', 'juegos-de-cartas', 'rol-aventura'),
        ),
        'accesorios' => array(
            'tipo-accesorio' => array('folios-sleeves', 'deck-boxes', 'carpetas', 'playmats', 'dados-y-contadores', 'almacenamiento'),
            'marca' => array('dragon-shield', 'ultra-pro', 'ultimate-guard', 'kmc'),
        ),
    );
}

function gravedad_mm_get($key) {
    $stored = get_option('gravedad_menu_mega_' . $key, null);
    $defaults = gravedad_mm_defaults();
    if (!is_array($stored) || !$stored) { return $defaults[$key]; }
    return $stored;
}

function gravedad_mm_taxonomy_terms($taxonomy) {
    if (!taxonomy_exists($taxonomy)) { return array(); }
    $terms = get_terms(array('taxonomy' => $taxonomy, 'hide_empty' => false, 'orderby' => 'name'));
    return is_wp_error($terms) ? array() : $terms;
}

function gravedad_mm_term_label($taxonomy, $slug) {
    if (!$slug) { return ''; }
    $term = get_term_by('slug', $slug, $taxonomy);
    if ($term && !is_wp_error($term)) { return $term->name; }
    $legacy = gravedad_mm_legacy_labels();
    if (isset($legacy[$slug])) { return $legacy[$slug]; }
    return ucwords(str_replace('-', ' ', $slug));
}

// Opciones para un <select>: términos reales de la taxonomía + cualquier
// slug que ya esté en uso (guardado o de ejemplo) que todavía no exista
// como término, para que nunca desaparezca una opción que hoy se ve.
function gravedad_mm_options_for($taxonomy, $extra_slugs = array()) {
    $options = array();
    foreach (gravedad_mm_taxonomy_terms($taxonomy) as $term) { $options[$term->slug] = $term->name; }
    $legacy = gravedad_mm_legacy_labels();
    foreach ($extra_slugs as $slug) {
        if ($slug !== '' && !isset($options[$slug])) {
            $options[$slug] = isset($legacy[$slug]) ? $legacy[$slug] : ucwords(str_replace('-', ' ', $slug));
        }
    }
    asort($options);
    return $options;
}

function gravedad_mm_select($name, $options, $selected = '') {
    $html = '<select name="' . esc_attr($name) . '" class="mm-select">';
    $html .= '<option value="">Elegir…</option>';
    foreach ($options as $slug => $label) {
        $html .= '<option value="' . esc_attr($slug) . '"' . selected($selected, $slug, false) . '>' . esc_html($label) . '</option>';
    }
    $html .= '</select>';
    return $html;
}

function gravedad_mm_menu() {
    add_submenu_page('gravedad-panel', 'Menús desplegables', 'Menús desplegables', 'manage_options', 'gravedad-mm', 'gravedad_mm_render');
}
add_action('admin_menu', 'gravedad_mm_menu', 20);

function gravedad_mm_assets($hook) {
    $page = isset($_GET['page']) ? sanitize_key(wp_unslash($_GET['page'])) : '';
    if ($page !== 'gravedad-mm') { return; }
    wp_enqueue_style('gravedad-admin-panel', get_template_directory_uri() . '/assets/css/admin-panel.css', array(), GRAVEDAD_VERSION);
    wp_enqueue_style('gravedad-menu-editor', get_template_directory_uri() . '/assets/css/menu-editor.css', array('gravedad-admin-panel'), GRAVEDAD_VERSION);
    wp_enqueue_script('gravedad-menu-editor', get_template_directory_uri() . '/assets/js/menu-editor.js', array(), GRAVEDAD_VERSION, true);
}
add_action('admin_enqueue_scripts', 'gravedad_mm_assets');

function gravedad_mm_save() {
    if (!isset($_POST['gravedad_mm_nonce']) || !wp_verify_nonce($_POST['gravedad_mm_nonce'], 'gravedad_mm_save')) { return; }
    if (!current_user_can('manage_options')) { return; }

    $clean_slug_list = function ($raw) {
        $out = array();
        foreach ((array) $raw as $v) {
            $v = sanitize_title(wp_unslash($v));
            if ($v !== '') { $out[] = $v; }
        }
        return $out;
    };

    $tcg = array();
    if (!empty($_POST['mm_tcg']) && is_array($_POST['mm_tcg'])) {
        foreach ($_POST['mm_tcg'] as $row) {
            $juego = isset($row['juego']) ? sanitize_title(wp_unslash($row['juego'])) : '';
            if ($juego === '') { continue; }
            $tcg[] = array(
                'juego' => $juego,
                'sueltas' => !empty($row['sueltas']) ? 1 : 0,
                'tipos' => isset($row['tipos']) ? $clean_slug_list($row['tipos']) : array(),
            );
        }
    }
    if ($tcg) { update_option('gravedad_menu_mega_tcg', $tcg); }

    $flat_pages = array(
        'cartas-sueltas' => array('mm_cs_juego' => 'juego', 'mm_cs_rareza' => 'rareza', 'mm_cs_idioma' => 'idioma'),
        'juegos-de-mesa' => array('mm_jm_editorial' => 'editorial', 'mm_jm_tipojuego' => 'tipo-juego'),
        'accesorios' => array('mm_ac_tipo' => 'tipo-accesorio', 'mm_ac_marca' => 'marca'),
    );
    foreach ($flat_pages as $page_key => $fields) {
        $data = array();
        foreach ($fields as $post_key => $col_key) {
            $data[$col_key] = isset($_POST[$post_key]) ? $clean_slug_list($_POST[$post_key]) : array();
        }
        update_option('gravedad_menu_mega_' . $page_key, $data);
    }

    wp_safe_redirect(add_query_arg(array('page' => 'gravedad-mm', 'guardado' => '1'), admin_url('admin.php')));
    exit;
}
add_action('admin_post_gravedad_mm_save', 'gravedad_mm_save');

function gravedad_mm_render_flat_list($post_name, $options, $selected, $label) {
    echo '<div class="mm-column">';
    echo '<h3 class="mm-column-title">' . esc_html($label) . '</h3>';
    echo '<div class="mm-list" data-mm-list>';
    foreach ($selected as $slug) {
        echo '<div class="mm-row" draggable="true" data-mm-row>';
        echo '<span class="mm-handle" title="Arrastrá para reordenar">⠿⠿</span>';
        echo gravedad_mm_select($post_name . '[]', $options, $slug);
        echo '<button type="button" class="mm-row-remove" data-mm-remove title="Quitar">✕</button>';
        echo '</div>';
    }
    echo '<button type="button" class="mm-add" data-mm-add>+ Agregar</button>';
    echo '<template data-mm-template><div class="mm-row" draggable="true" data-mm-row><span class="mm-handle" title="Arrastrá para reordenar">⠿⠿</span>' . gravedad_mm_select($post_name . '[]', $options) . '<button type="button" class="mm-row-remove" data-mm-remove title="Quitar">✕</button></div></template>';
    echo '</div>';
    echo '</div>';
}

function gravedad_mm_render_tcg_row($rowid, $game, $juego_options, $tipo_options) {
    $prefix = 'mm_tcg[' . $rowid . ']';
    echo '<div class="mm-game-row" draggable="true" data-mm-row>';
    echo '<div class="mm-game-row__head">';
    echo '<span class="mm-handle" title="Arrastrá para reordenar">⠿⠿</span>';
    echo gravedad_mm_select($prefix . '[juego]', $juego_options, $game['juego']);
    echo '<label class="mm-check"><input type="checkbox" name="' . esc_attr($prefix) . '[sueltas]" value="1"' . checked(!empty($game['sueltas']), true, false) . '> Mostrar "Cartas sueltas"</label>';
    echo '<button type="button" class="mm-row-remove" data-mm-remove title="Quitar juego">✕ Quitar juego</button>';
    echo '</div>';
    gravedad_mm_render_flat_list($prefix . '[tipos]', $tipo_options, $game['tipos'], 'Tipos de producto que se muestran');
    echo '</div>';
}

function gravedad_mm_render_tcg($games, $juego_options, $tipo_options) {
    echo '<div class="mm-games-wrap">';
    echo '<div class="mm-list mm-list-games" data-mm-list>';
    foreach ($games as $i => $game) {
        gravedad_mm_render_tcg_row($i, $game, $juego_options, $tipo_options);
    }
    echo '<button type="button" class="mm-add mm-add-game" data-mm-add-game>+ Agregar juego</button>';
    echo '</div>';
    echo '<template data-mm-template-game>';
    gravedad_mm_render_tcg_row('__ROWID__', array('juego' => '', 'sueltas' => 1, 'tipos' => array()), $juego_options, $tipo_options);
    echo '</template>';
    echo '</div>';
}

function gravedad_mm_render() {
    if (!current_user_can('manage_options')) { return; }
    $tcg_games = gravedad_mm_get('tcg');
    $cs = gravedad_mm_get('cartas-sueltas');
    $jm = gravedad_mm_get('juegos-de-mesa');
    $ac = gravedad_mm_get('accesorios');

    $tcg_defaults = gravedad_mm_defaults()['tcg'];
    $default_juego_slugs = wp_list_pluck($tcg_defaults, 'juego');
    $juego_options = gravedad_mm_options_for('pa_juego', array_merge($default_juego_slugs, $cs['juego']));

    $tipo_slugs = array();
    foreach (array_merge($tcg_defaults, $tcg_games) as $g) { $tipo_slugs = array_merge($tipo_slugs, $g['tipos']); }
    $tipo_options = gravedad_mm_options_for('pa_tipo-producto', $tipo_slugs);

    $rareza_options = gravedad_mm_options_for('pa_rareza', $cs['rareza']);
    $idioma_options = gravedad_mm_options_for('pa_idioma', $cs['idioma']);
    $editorial_options = gravedad_mm_options_for('pa_editorial', $jm['editorial']);
    $tipojuego_options = gravedad_mm_options_for('pa_tipo-juego', $jm['tipo-juego']);
    $tipoacc_options = gravedad_mm_options_for('pa_tipo-accesorio', $ac['tipo-accesorio']);
    $marca_options = gravedad_mm_options_for('pa_marca', $ac['marca']);
    ?>
    <div class="gravedad-panel-wrap">
      <header class="gravedad-panel-header">
        <div class="gravedad-panel-brand">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-gravedad-store.png'); ?>" alt="Gravedad Store">
          <div><h1>Menús desplegables</h1><p>Elegí qué categorías de la tienda aparecen en cada menú y en qué orden. Arrastrá desde el ⠿⠿ para reordenar.</p></div>
        </div>
      </header>
      <p><a href="<?php echo esc_url(admin_url('admin.php?page=gravedad-panel')); ?>">← Volver a Editar Sitio</a></p>

      <?php if (isset($_GET['guardado'])): ?>
      <div class="gravedad-panel-notice">✓ Los cambios se guardaron correctamente.</div>
      <?php endif; ?>

      <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="gravedad-panel-form mm-form">
        <input type="hidden" name="action" value="gravedad_mm_save">
        <?php wp_nonce_field('gravedad_mm_save', 'gravedad_mm_nonce'); ?>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🎮</span><div><h2>TCG</h2><p>Un bloque por juego, con sus tipos de producto y, si querés, un link a "Cartas sueltas".</p></div></div>
          <?php gravedad_mm_render_tcg($tcg_games, $juego_options, $tipo_options); ?>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🃏</span><div><h2>Cartas sueltas</h2><p>Las 3 columnas del menú desplegable.</p></div></div>
          <div class="mm-columns">
            <?php
              gravedad_mm_render_flat_list('mm_cs_juego', $juego_options, $cs['juego'], 'Elegir juego');
              gravedad_mm_render_flat_list('mm_cs_rareza', $rareza_options, $cs['rareza'], 'Por rareza');
              gravedad_mm_render_flat_list('mm_cs_idioma', $idioma_options, $cs['idioma'], 'Por idioma');
            ?>
          </div>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🎲</span><div><h2>Juegos de mesa</h2><p>Las 2 columnas del menú desplegable.</p></div></div>
          <div class="mm-columns">
            <?php
              gravedad_mm_render_flat_list('mm_jm_editorial', $editorial_options, $jm['editorial'], 'Por editorial');
              gravedad_mm_render_flat_list('mm_jm_tipojuego', $tipojuego_options, $jm['tipo-juego'], 'Por tipo de juego');
            ?>
          </div>
        </section>

        <section class="gravedad-panel-card">
          <div class="gravedad-panel-card__head"><span class="gravedad-panel-card__icon">🛡️</span><div><h2>Accesorios</h2><p>Las 2 columnas del menú desplegable.</p></div></div>
          <div class="mm-columns">
            <?php
              gravedad_mm_render_flat_list('mm_ac_tipo', $tipoacc_options, $ac['tipo-accesorio'], 'Por tipo');
              gravedad_mm_render_flat_list('mm_ac_marca', $marca_options, $ac['marca'], 'Por marca');
            ?>
          </div>
        </section>

        <div class="gravedad-panel-save"><button type="submit" class="button button-primary">Guardar cambios</button></div>
      </form>
    </div>
    <?php
}
