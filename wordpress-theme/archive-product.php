<?php
defined('ABSPATH') || exit;
get_header();

if (is_search()) :
    // La vista de resultados de búsqueda vive en search.php (con su barra
    // de filtros): antes había una copia igual acá, que era la que se usaba
    // realmente y quedaba desincronizada de la otra.
    include get_template_directory() . '/search-results-content.php';
else :
    ?>
    <main class="singles-page">
      <header class="singles-hero"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Tienda</nav><p class="section-label"><i class="label-dash"></i>CATÁLOGO COMPLETO</p><h1>Tienda.</h1><p>Todo lo que tenemos disponible, en un solo lugar.</p></div></header>
      <?php gravedad_marquee(); ?>
      <div class="singles-toolbar"><div class="singles-count"><?php woocommerce_result_count(); ?></div><div class="singles-order"><?php woocommerce_catalog_ordering(); ?></div></div>
      <section class="singles-results">
        <?php if (woocommerce_product_loop()): woocommerce_product_loop_start(); if (wc_get_loop_prop('total')): while (have_posts()): the_post(); do_action('woocommerce_shop_loop'); wc_get_template_part('content', 'product'); endwhile; endif; woocommerce_product_loop_end(); do_action('woocommerce_after_shop_loop'); else: do_action('woocommerce_no_products_found'); endif; ?>
      </section>
    </main>
    <?php
endif;
get_footer();
