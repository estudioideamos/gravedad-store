<?php
/* Template Name: Novedades */
defined('ABSPATH') || exit;
get_header();
$filters = array(
    'f_juego' => array('Juego', 'pa_juego'),
    'f_editorial' => array('Editorial', 'pa_editorial'),
    'f_tipo_producto' => array('Tipo de producto', 'pa_tipo-producto'),
);
$paged = max(1, get_query_var('paged') ? (int) get_query_var('paged') : (isset($_GET['paged']) ? absint($_GET['paged']) : 1));
$args = array(
    'post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => 24, 'paged' => $paged,
    'orderby' => 'date', 'order' => 'DESC',
);
$tax_query = gravedad_catalog_tax_query_from_get();
if ($tax_query) { $args['tax_query'] = $tax_query; }
$meta_query = gravedad_catalog_meta_query_from_get();
if ($meta_query) { $args['meta_query'] = $meta_query; }
if (!empty($_GET['s'])) { $args['s'] = sanitize_text_field(wp_unslash($_GET['s'])); }
$query = new WP_Query($args);
$clear_url = get_permalink();
?>
<main class="singles-page">
  <header class="singles-hero"><div class="singles-orbit"></div><div><p class="section-label">RECIÉN LLEGADOS</p><h1>Novedades.</h1><p>Los últimos ingresos a la tienda, primero.</p></div></header>
  <div class="singles-toolbar"><button class="singles-filter-toggle" type="button" aria-expanded="false">FILTROS <span>＋</span></button><div class="singles-count"><?php echo esc_html($query->found_posts); ?> resultados</div></div>
  <div class="singles-layout">
    <aside class="singles-filters">
      <div class="filter-heading"><span>AFINAR BÚSQUEDA</span><a href="<?php echo esc_url($clear_url); ?>">Limpiar todo</a></div>
      <form method="get" action="<?php echo esc_url($clear_url); ?>">
        <label class="filter-search"><span>Buscar producto</span><input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Ej: nombre del producto"></label>
        <?php foreach ($filters as $name => $data): $terms = gravedad_filter_terms($data[1]); if (!$terms) continue; ?>
        <label><span><?php echo esc_html($data[0]); ?></span><select name="<?php echo esc_attr($name); ?>"><option value="">Todos</option><?php foreach ($terms as $t): ?><option value="<?php echo esc_attr($t->slug); ?>" <?php selected(isset($_GET[$name]) ? sanitize_title(wp_unslash($_GET[$name])) : '', $t->slug); ?>><?php echo esc_html($t->name); ?></option><?php endforeach; ?></select></label>
        <?php endforeach; ?>
        <button class="apply-filters" type="submit">APLICAR FILTROS →</button>
      </form>
    </aside>
    <section class="singles-results">
      <?php gravedad_render_product_grid($query); ?>
      <?php if ($query->max_num_pages > 1): ?><div class="woocommerce-pagination"><?php echo paginate_links(array('base' => esc_url_raw(add_query_arg('paged', '%#%')), 'format' => '', 'current' => $paged, 'total' => $query->max_num_pages, 'prev_text' => '←', 'next_text' => '→', 'type' => 'list')); ?></div><?php endif; ?>
    </section>
  </div>
</main>
<?php get_footer(); ?>
