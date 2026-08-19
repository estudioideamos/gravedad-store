<?php
/* Template Name: Favoritos */
defined('ABSPATH') || exit;
get_header();
?>
<main class="singles-page">
  <header class="singles-hero"><div class="singles-orbit"></div><div><nav class="hero-breadcrumb" aria-label="Breadcrumb"><a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a> / Favoritos</nav><p class="section-label"><i class="label-dash"></i>TU SELECCIÓN</p><h1>Favoritos.</h1><p>Los productos que guardaste para más tarde, todos en un solo lugar.</p></div></header>
  <section class="singles-results favorites-results">
    <div data-favorites-grid class="favorites-loading">Cargando tus favoritos…</div>
  </section>
</main>
<?php get_footer(); ?>
