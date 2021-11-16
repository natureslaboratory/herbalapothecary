<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div <?php wc_product_cat_class( 'c-category', $category ); ?>>
	<a class="c-category__image-wrapper" href="<?= esc_url( get_term_link( $category, 'product_cat' ) ) ?>">
		<?php do_action( 'woocommerce_before_subcategory_title', $category ); ?>
	</a>
	<a class="c-category__title" href="<?= esc_url( get_term_link( $category, 'product_cat' ) ) ?>">
		<?php do_action( 'woocommerce_shop_loop_subcategory_title', $category ); ?>
	</a>
	<?php
	// /**
	//  * The woocommerce_before_subcategory hook.
	//  *
	//  * @hooked woocommerce_template_loop_category_link_open - 10
	//  */
	// do_action( 'woocommerce_before_subcategory', $category );

	// /**
	//  * The woocommerce_before_subcategory_title hook.
	//  *
	//  * @hooked woocommerce_subcategory_thumbnail - 10
	//  */
	// do_action( 'woocommerce_before_subcategory_title', $category );

	// /**
	//  * The woocommerce_shop_loop_subcategory_title hook.
	//  *
	//  * @hooked woocommerce_template_loop_category_title - 10
	//  */
	// do_action( 'woocommerce_shop_loop_subcategory_title', $category );

	// /**
	//  * The woocommerce_after_subcategory_title hook.
	//  */
	// do_action( 'woocommerce_after_subcategory_title', $category );

	// /**
	//  * The woocommerce_after_subcategory hook.
	//  *
	//  * @hooked woocommerce_template_loop_category_link_close - 10
	//  */
	// do_action( 'woocommerce_after_subcategory', $category );
	?>
</div>
