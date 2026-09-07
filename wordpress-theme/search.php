<?php
defined('ABSPATH') || exit;
get_header();
$term = get_search_query();
$paged = max(1, get_query_var('paged') ? (int) get_query_var('paged') : (isset($_GET['paged']) ? absint($_GET['paged']) : 1));
$args = array('post_type' => 'product', 'post_status' => 'publish', 's' => $term, 'posts_per_page' => 24, 'paged' => $paged);
if (!empty($_GET['orderby'])) {
    $args['orderby'] = sanitize_key(wp_unslash($_GET['orderby']));
}
// La búsqueda también respeta los filtros de la barra lateral (juego,
// colección, rareza, precio, disponibilidad, etc.), igual que las
// páginas de categoría.
$search_tax_query = gravedad_catalog_tax_query_from_get();
if ($search_tax_query) { $args['tax_query'] = $search_tax_query; }
$search_meta_query = gravedad_catalog_meta_query_from_get();
if ($search_meta_query) { $args['meta_query'] = $search_meta_query; }
$query = new WP_Query($args);

// Unión de todos los filtros disponibles: los que no tengan resultados
// para esta búsqueda se ocultan solos más abajo.
$search_filters = array();
foreach (gravedad_section_filters() as $set) {
    foreach ($set as $param => $data) { $search_filters[$param] = $data; }
}
$search_clear_url = add_query_arg(array('s' => $term, 'post_type' => 'product'), home_url('/'));
?>
<main class="singles-page">
  <header class="singles-hero has-image" style="--hero:url('<?php echo esc_url(get_template_directory_uri() . '/assets/img/hero-busqueda.jpg'); ?>')"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Búsqueda</nav><p class="section-label"><i class="label-dash"></i>RESULTADOS DE BÚSQUEDA</p><h1>"<?php echo esc_html($term); ?>"</h1><p><?php echo $query->found_posts ? esc_html($query->found_posts . ' resultado' . ($query->found_posts === 1 ? '' : 's') . ' encontrados en la tienda.') : 'No encontramos productos que coincidan con tu búsqueda.'; ?></p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="singles-toolbar search-toolbar">
    <form class="search-refine" method="get" action="<?php echo esc_url(home_url('/')); ?>"><input type="search" name="s" value="<?php echo esc_attr($term); ?>" placeholder="Buscá otra cosa..."><input type="hidden" name="post_type" value="product"><button type="submit" aria-label="Buscar"><?php echo gravedad_icon('search'); ?></button></form>
    <div class="singles-count"><?php echo esc_html($query->found_posts); ?> resultados</div>
    <div class="singles-order"><?php
      $orderby = isset($_GET['orderby']) ? sanitize_key(wp_unslash($_GET['orderby'])) : '';
      $sorts = array('' => 'Relevancia', 'date' => 'Más nuevos', 'price' => 'Precio: menor a mayor', 'price-desc' => 'Precio: mayor a menor');
      $order_base = esc_url(add_query_arg(array_merge($_GET, array('s' => $term, 'post_type' => 'product')), home_url('/')));
      $order_base = remove_query_arg('orderby', $order_base);
      $order_glue = strpos($order_base, '?') === false ? '?' : '&';
    ?><select onchange="location.href='<?php echo esc_js($order_base . $order_glue); ?>orderby='+this.value">
      <?php foreach ($sorts as $val => $label): ?><option value="<?php echo esc_attr($val); ?>" <?php selected($orderby, $val); ?>><?php echo esc_html($label); ?></option><?php endforeach; ?>
    </select></div>
  </div>
  <?php gravedad_active_filter_chips($search_filters); ?>
  <div class="singles-layout">
    <aside class="singles-filters">
      <div class="filter-heading"><span>AFINAR BÚSQUEDA</span><a href="<?php echo esc_url($search_clear_url); ?>">Limpiar todo</a></div>
      <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
        <label class="filter-search"><span>Buscar</span><input type="search" name="s" value="<?php echo esc_attr($term); ?>" placeholder="Nombre del producto"><input type="hidden" name="post_type" value="product"></label>
        <?php foreach ($search_filters as $name => $data): $terms = gravedad_faceted_terms($data[1], $search_filters, $name); $has_active = !empty($_GET[$name]); if (!$terms && !$has_active) continue; ?>
        <label><span><?php echo esc_html($data[0]); ?></span><select name="<?php echo esc_attr($name); ?>"><option value="">Todos</option><?php foreach ($terms as $t): ?><option value="<?php echo esc_attr($t->slug); ?>" <?php selected(isset($_GET[$name]) ? sanitize_title(wp_unslash($_GET[$name])) : '', $t->slug); ?>><?php echo esc_html($t->name); ?> <small>(<?php echo esc_html($t->count); ?>)</small></option><?php endforeach; ?></select></label>
        <?php endforeach; ?>
        <fieldset><legend>Precio</legend><div class="price-inputs"><input type="number" name="precio_min" min="0" step="1" value="<?php echo isset($_GET['precio_min']) ? esc_attr(wp_unslash($_GET['precio_min'])) : ''; ?>" placeholder="Mínimo"><input type="number" name="precio_max" min="0" step="1" value="<?php echo isset($_GET['precio_max']) ? esc_attr(wp_unslash($_GET['precio_max'])) : ''; ?>" placeholder="Máximo"></div></fieldset>
        <label><span>Disponibilidad</span><select name="f_stock"><option value="">Todas</option><option value="instock" <?php selected($_GET['f_stock'] ?? '', 'instock'); ?>>En stock</option><option value="outofstock" <?php selected($_GET['f_stock'] ?? '', 'outofstock'); ?>>Sin stock</option></select></label>
        <?php if (!empty($_GET['orderby'])): ?><input type="hidden" name="orderby" value="<?php echo esc_attr(sanitize_key($_GET['orderby'])); ?>"><?php endif; ?>
        <button class="apply-filters" type="submit">APLICAR FILTROS →</button>
      </form>
    </aside>
  <section class="singles-results">
    <?php if ($query->found_posts): ?>
      <?php gravedad_render_product_grid($query); ?>
      <?php if ($query->max_num_pages > 1): ?><div class="woocommerce-pagination"><?php echo paginate_links(array('base' => esc_url_raw(add_query_arg('paged', '%#%')), 'format' => '', 'current' => $paged, 'total' => $query->max_num_pages, 'prev_text' => '←', 'next_text' => '→', 'type' => 'list')); ?></div><?php endif; ?>
    <?php else: ?>
      <div class="search-empty">
        <p>No encontramos nada para <strong>"<?php echo esc_html($term); ?>"</strong>. Probá con otro nombre, o explorá estas categorías:</p>
        <div class="search-empty-links">
          <a href="<?php echo esc_url(gravedad_shop_url('tcg')); ?>">TCG</a>
          <a href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">Cartas sueltas</a>
          <a href="<?php echo esc_url(gravedad_shop_url('juegos-de-mesa')); ?>">Juegos de mesa</a>
          <a href="<?php echo esc_url(gravedad_shop_url('accesorios')); ?>">Accesorios</a>
        </div>
      </div>
    <?php endif; ?>
  </section>
  </div>
</main>
<?php get_footer(); ?>
