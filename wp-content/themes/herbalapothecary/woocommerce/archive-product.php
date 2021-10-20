<?php

/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined('ABSPATH') || exit;

get_header('shop');

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action("woo_custom_breadcrumb");
do_action('woocommerce_before_main_content');

?>
<header class="woocommerce-products-header">

	<?php
	/**
	 * Hook: woocommerce_archive_description.
	 *
	 * @hooked woocommerce_taxonomy_archive_description - 10
	 * @hooked woocommerce_product_archive_description - 10
	 */
	?>
</header>

<div class="l-restrict">
	<?php
	if (woocommerce_product_loop()) {
		
		if (!strpos($_SERVER["REQUEST_URI"], "product-category")) {
			get_template_part("template-parts/product-categories", "categories");
		}

		echo "<div class='c-shop__grid c-shop__grid--category'>";

		get_sidebar();
		echo "<div class='c-shop__main'>";


		if (apply_filters('woocommerce_show_page_title', true)) {
			?> <h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1> <?php
		};

		do_action('woocommerce_archive_description');
		do_action('woocommerce_before_shop_loop');

		woocommerce_product_loop_start();

		if (wc_get_loop_prop('total')) {
			while (have_posts()) {
				the_post();

				/**
				 * Hook: woocommerce_shop_loop.
				 */
				do_action('woocommerce_shop_loop');

				wc_get_template_part('content', 'product');
			}
		}

		
		if ($isProductCat || $isShop) {
			echo "</div></div>";
		}
	} else {
		
		do_action('woocommerce_no_products_found');
	}
	
	woocommerce_product_loop_end();
	do_action('woocommerce_after_shop_loop');
	?>
</div>

<?php

/**
 * Hook: woocommerce_after_main_content.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action('woocommerce_after_main_content');

/**
 * Hook: woocommerce_sidebar.
 *
 * @hooked woocommerce_get_sidebar - 10
 */
do_action('woocommerce_sidebar');

get_footer('shop');
