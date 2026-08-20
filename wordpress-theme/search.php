<?php
defined('ABSPATH') || exit;
get_header();
$term = get_search_query();
$paged = max(1, get_query_var('paged') ? (int) get_query_var('paged') : (isset($_GET['paged']) ? absint($_GET['paged']) : 1));
$args = array('post_type' => 'product', 'post_status' => 'publish', 's' => $term, 'posts_per_page' => 24, 'paged' => $paged);
if (!empty($_GET['orderby'])) {
    $args['orderby'] = sanitize_key(wp_unslash($_GET['orderby']));
}
$query = new WP_Query($args);
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
    ?><select onchange="location.href='?s=<?php echo esc_attr(urlencode($term)); ?>&post_type=product&orderby='+this.value">
      <?php foreach ($sorts as $val => $label): ?><option value="<?php echo esc_attr($val); ?>" <?php selected($orderby, $val); ?>><?php echo esc_html($label); ?></option><?php endforeach; ?>
    </select></div>
  </div>
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
</main>
<?php get_footer(); ?>
