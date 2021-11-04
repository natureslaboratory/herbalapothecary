<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

get_header();


$variable_products = wc_get_products([
    "type" => "variable",
    "limit" => -1
]);

foreach ($variable_products as $product) {
    verify_variable_stock($product);
}


// get_sidebar();
get_footer();