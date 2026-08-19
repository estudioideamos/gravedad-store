<?php
defined('ABSPATH') || exit;
get_header();
$term = get_queried_object();
$section = $term ? gravedad_section_for_term($term) : '';
$all_filters = gravedad_section_filters();
$filters = $section && isset($all_filters[$section]) ? $all_filters[$section] : array();
$copy = gravedad_section_copy();
if ($section && isset($copy[$section]) && $term->slug === $section) {
    list($eyebrow, $title, $desc, $search_label, $search_ph) = $copy[$section];
} else {
    $parent_name = $term->parent ? get_term($term->parent, 'product_cat') : null;
    $eyebrow = ($parent_name && !is_wp_error($parent_name)) ? mb_strtoupper($parent_name->name) : 'CATÁLOGO';
    $title = $term->name . '.';
    $desc = $term->description ? $term->description : 'Explorá los productos disponibles en esta categoría.';
    $search_label = 'Buscar en ' . $term->name;
    $search_ph = 'Ej: nombre del producto';
}
$clear_url = get_term_link($term);
$hero_image = $section ? gravedad_section_hero_image($section) : '';
?>
<main class="singles-page">
  <header class="singles-hero<?php echo $hero_image ? ' has-image' : ''; ?>"<?php echo $hero_image ? ' style="--hero:url(\'' . esc_url($hero_image) . '\')"' : ''; ?>><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / <?php echo esc_html($term->name); ?></nav><p class="section-label"><i class="label-dash"></i><?php echo esc_html($eyebrow); ?></p><h1><?php echo esc_html($title); ?></h1><p><?php echo esc_html($desc); ?></p></div></header>
  <?php gravedad_marquee(); ?>
  <div class="singles-toolbar"><button class="singles-filter-toggle" type="button" aria-expanded="false">FILTROS <span>＋</span></button><div class="singles-count"><?php woocommerce_result_count(); ?></div><div class="singles-order"><?php woocommerce_catalog_ordering(); ?></div></div>
  <div class="singles-layout">
    <aside class="singles-filters">
      <div class="filter-heading"><span>AFINAR BÚSQUEDA</span><a href="<?php echo esc_url($clear_url); ?>">Limpiar todo</a></div>
      <form method="get" action="<?php echo esc_url($clear_url); ?>">
        <label class="filter-search"><span><?php echo esc_html($search_label); ?></span><input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="<?php echo esc_attr($search_ph); ?>"><input type="hidden" name="post_type" value="product"></label>
        <?php foreach ($filters as $name => $data): $terms = gravedad_filter_terms($data[1]); if (!$terms) continue; ?>
        <label><span><?php echo esc_html($data[0]); ?></span><select name="<?php echo esc_attr($name); ?>"><option value="">Todos</option><?php foreach ($terms as $t): ?><option value="<?php echo esc_attr($t->slug); ?>" <?php selected(isset($_GET[$name]) ? sanitize_title(wp_unslash($_GET[$name])) : '', $t->slug); ?>><?php echo esc_html($t->name); ?> <small>(<?php echo esc_html($t->count); ?>)</small></option><?php endforeach; ?></select></label>
        <?php endforeach; ?>
        <fieldset><legend>Precio</legend><div class="price-inputs"><input type="number" name="precio_min" min="0" step="1" value="<?php echo isset($_GET['precio_min']) ? esc_attr(wp_unslash($_GET['precio_min'])) : ''; ?>" placeholder="Mínimo"><input type="number" name="precio_max" min="0" step="1" value="<?php echo isset($_GET['precio_max']) ? esc_attr(wp_unslash($_GET['precio_max'])) : ''; ?>" placeholder="Máximo"></div></fieldset>
        <label><span>Disponibilidad</span><select name="f_stock"><option value="">Todas</option><option value="instock" <?php selected($_GET['f_stock'] ?? '', 'instock'); ?>>En stock</option><option value="outofstock" <?php selected($_GET['f_stock'] ?? '', 'outofstock'); ?>>Sin stock</option></select></label>
        <?php if (!empty($_GET['orderby'])): ?><input type="hidden" name="orderby" value="<?php echo esc_attr(sanitize_key($_GET['orderby'])); ?>"><?php endif; ?>
        <button class="apply-filters" type="submit">APLICAR FILTROS →</button>
      </form>
    </aside>
    <section class="singles-results">
    <?php if (woocommerce_product_loop()): woocommerce_product_loop_start(); if (wc_get_loop_prop('total')): while (have_posts()): the_post(); do_action('woocommerce_shop_loop'); wc_get_template_part('content', 'product'); endwhile; endif; woocommerce_product_loop_end(); do_action('woocommerce_after_shop_loop'); else: do_action('woocommerce_no_products_found'); endif; ?>
    </section>
  </div>
</main>
<?php get_footer(); ?>
