<?php
/* Template Name: Ofertas */
defined('ABSPATH') || exit;
get_header();
$tab = isset($_GET['f_seccion']) ? sanitize_key(wp_unslash($_GET['f_seccion'])) : 'todo';
$tabs = array(
    'todo' => 'Todo', 'tcg' => 'TCG', 'juegos-de-mesa' => 'Juegos de mesa',
    'accesorios' => 'Accesorios', 'ultimas' => 'Últimas unidades',
);
$paged = max(1, get_query_var('paged') ? (int) get_query_var('paged') : (isset($_GET['paged']) ? absint($_GET['paged']) : 1));
$args = array('post_type' => 'product', 'post_status' => 'publish', 'posts_per_page' => 24, 'paged' => $paged);
if ($tab === 'ultimas') {
    $args['meta_key'] = '_stock';
    $args['orderby'] = 'meta_value_num';
    $args['order'] = 'ASC';
    $args['meta_query'] = array(
        array('key' => '_stock', 'value' => 0, 'compare' => '>'),
        array('key' => '_stock', 'value' => 5, 'compare' => '<='),
        array('key' => '_stock_status', 'value' => 'instock'),
    );
} else {
    $sale_ids = function_exists('wc_get_product_ids_on_sale') ? wc_get_product_ids_on_sale() : array();
    $args['post__in'] = $sale_ids ? $sale_ids : array(0);
    if (in_array($tab, array('tcg', 'juegos-de-mesa', 'accesorios'), true)) {
        $args['tax_query'] = array(array('taxonomy' => 'product_cat', 'field' => 'slug', 'terms' => $tab));
    }
}
$query = new WP_Query($args);
?>
<main class="singles-page">
  <header class="singles-hero"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Ofertas</nav><p class="section-label"><i class="label-dash"></i>NO TE LO PIERDAS</p><h1>Ofertas.</h1><p>Promociones, precios especiales y últimas unidades disponibles.</p></div></header>
  <?php gravedad_marquee(array('3 CUOTAS SIN INTERÉS','ÚLTIMAS UNIDADES','PRECIOS ESPECIALES','ENVÍOS A TODO EL PAÍS')); ?>
  <div class="singles-toolbar offers-tabs">
    <div class="offer-tabs">
    <?php foreach ($tabs as $slug => $label): $url = $slug === 'todo' ? remove_query_arg('f_seccion') : add_query_arg('f_seccion', $slug); ?>
      <a href="<?php echo esc_url($url); ?>" class="<?php echo $tab === $slug ? 'is-active' : ''; ?>"><?php echo esc_html($label); ?></a>
    <?php endforeach; ?>
    </div>
    <div class="singles-count"><?php echo esc_html($query->found_posts); ?> resultados</div>
  </div>
  <section class="singles-results">
    <?php gravedad_render_product_grid($query); ?>
    <?php if ($query->max_num_pages > 1): ?><div class="woocommerce-pagination"><?php echo paginate_links(array('base' => esc_url_raw(add_query_arg('paged', '%#%')), 'format' => '', 'current' => $paged, 'total' => $query->max_num_pages, 'prev_text' => '←', 'next_text' => '→', 'type' => 'list')); ?></div><?php endif; ?>
  </section>
</main>
<?php get_footer(); ?>
