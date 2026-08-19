<?php
defined('ABSPATH') || exit;
if (is_tax('product_cat')) {
    include get_template_directory() . '/taxonomy-product_cat.php';
} else {
    get_header();
    echo '<main class="store-main"><div class="store-shell">';
    woocommerce_content();
    echo '</div></main>';
    get_footer();
}
