<?php
defined('ABSPATH') || exit;
if (is_tax('product_cat')) {
    include get_template_directory() . '/taxonomy-product_cat.php';
} else {
    get_header();
    woocommerce_content();
    get_footer();
}
