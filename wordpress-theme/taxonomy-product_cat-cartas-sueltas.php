<?php
defined('ABSPATH') || exit;
get_header();
$filters = array(
    'card_juego' => array('Juego','pa_juego'), 'card_coleccion' => array('Colección / Set','pa_coleccion'),
    'card_rareza' => array('Rareza','pa_rareza'), 'card_color' => array('Color','pa_color'),
    'card_tipo' => array('Tipo de carta','pa_tipo-carta'), 'card_idioma' => array('Idioma','pa_idioma'),
    'card_condicion' => array('Condición','pa_condicion'), 'card_acabado' => array('Foil / Acabado','pa_acabado'),
);
?>
<main class="singles-page">
  <header class="singles-hero"><div class="singles-orbit"></div><div><p class="section-label">ENCONTRÁ ESA CARTA</p><h1>Cartas<br><em>sueltas.</em></h1><p>Buscá entre todas las cartas disponibles y afiná los resultados hasta encontrar exactamente la que necesitás.</p></div></header>
  <div class="singles-toolbar"><button class="singles-filter-toggle" type="button" aria-expanded="false">FILTROS <span>＋</span></button><div class="singles-count"><?php woocommerce_result_count(); ?></div><div class="singles-order"><?php woocommerce_catalog_ordering(); ?></div></div>
  <div class="singles-layout">
    <aside class="singles-filters">
      <div class="filter-heading"><span>AFINAR BÚSQUEDA</span><a href="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">Limpiar todo</a></div>
      <form method="get" action="<?php echo esc_url(gravedad_shop_url('cartas-sueltas')); ?>">
        <label class="filter-search"><span>Nombre de la carta</span><input type="search" name="s" value="<?php echo esc_attr(get_search_query()); ?>" placeholder="Ej: Black Lotus"><input type="hidden" name="post_type" value="product"></label>
        <?php foreach ($filters as $name => $data): $terms=gravedad_card_filter_terms($data[1]); if (!$terms) continue; ?>
        <label><span><?php echo esc_html($data[0]); ?></span><select name="<?php echo esc_attr($name); ?>"><option value="">Todos</option><?php foreach($terms as $term): ?><option value="<?php echo esc_attr($term->slug); ?>" <?php selected(isset($_GET[$name])?sanitize_title(wp_unslash($_GET[$name])):'',$term->slug); ?>><?php echo esc_html($term->name); ?> <small>(<?php echo esc_html($term->count); ?>)</small></option><?php endforeach; ?></select></label>
        <?php endforeach; ?>
        <fieldset><legend>Precio</legend><div class="price-inputs"><input type="number" name="precio_min" min="0" step="1" value="<?php echo isset($_GET['precio_min'])?esc_attr(wp_unslash($_GET['precio_min'])):''; ?>" placeholder="Mínimo"><input type="number" name="precio_max" min="0" step="1" value="<?php echo isset($_GET['precio_max'])?esc_attr(wp_unslash($_GET['precio_max'])):''; ?>" placeholder="Máximo"></div></fieldset>
        <label><span>Disponibilidad</span><select name="card_stock"><option value="">Todas</option><option value="instock" <?php selected($_GET['card_stock']??'','instock'); ?>>En stock</option><option value="outofstock" <?php selected($_GET['card_stock']??'','outofstock'); ?>>Sin stock</option></select></label>
        <?php if (!empty($_GET['orderby'])): ?><input type="hidden" name="orderby" value="<?php echo esc_attr(sanitize_key($_GET['orderby'])); ?>"><?php endif; ?>
        <button class="apply-filters" type="submit">APLICAR FILTROS →</button>
      </form>
    </aside>
    <section class="singles-results">
    <?php if (woocommerce_product_loop()): woocommerce_product_loop_start(); if (wc_get_loop_prop('total')): while(have_posts()): the_post(); do_action('woocommerce_shop_loop'); wc_get_template_part('content','product'); endwhile; endif; woocommerce_product_loop_end(); do_action('woocommerce_after_shop_loop'); else: do_action('woocommerce_no_products_found'); endif; ?>
    </section>
  </div>
</main>
<?php get_footer(); ?>
