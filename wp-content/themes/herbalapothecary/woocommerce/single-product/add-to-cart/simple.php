<?php

/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;

if (!$product->is_purchasable()) {
	return;
}

// Check that the logged in user has access to the product
$page_level = get_field('user_level', $product->get_id());
$account_level = get_field('user_account_level', 'user_' . get_current_user_id());
$account_level = empty($account_level) ? 'NOT LOGGED IN' : $account_level;

// If the user has a high account level we should include lower levels for them
switch ($account_level) {
	case 'Level-3':
		$account_level = ['Level-3', 'Level-2', 'Level-1', 'NOT LOGGED IN'];
		break;
	case 'Level-2':
		$account_level = ['Level-2', 'Level-1', 'NOT LOGGED IN'];
		break;
	case 'Level-1':
		$account_level = ['Level-1', 'NOT LOGGED IN'];
		break;
	case 'NOT LOGGED IN':
		$account_level = ['NOT LOGGED IN'];
		break;
}

// Go through each level for this user and check if it's in the product
$has_access = false;
foreach ($account_level as $a) {
	if (in_array($a, $page_level))
		$has_access = true;
}

if (!$has_access) {
	echo '<a class="alert warning"><h2>Please Log In to Buy</h2><p>This product can only be purchased by qualified/registered practitioners or manufacturers. Please <a href="/my-account/">log in or register</a> to make a purchase.</p></a>';
	return;
}

echo wc_get_stock_html($product); // WPCS: XSS ok.

if ($product->is_in_stock() && $has_access) : ?>

	<?php do_action('woocommerce_before_add_to_cart_form'); ?>

	<form class="cart" action="<?php echo esc_url(apply_filters('woocommerce_add_to_cart_form_action', $product->get_permalink())); ?>" method="post" enctype='multipart/form-data'>
		<?php do_action('woocommerce_before_add_to_cart_button'); ?>

		<?php
		do_action('woocommerce_before_add_to_cart_quantity');

		woocommerce_quantity_input(
			array(
				'min_value'   => apply_filters('woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product),
				'max_value'   => apply_filters('woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product),
				'input_value' => isset($_POST['quantity']) ? wc_stock_amount(wp_unslash($_POST['quantity'])) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
			)
		);

		do_action('woocommerce_after_add_to_cart_quantity');
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>

		<?php do_action('woocommerce_after_add_to_cart_button'); ?>
	</form>

	<?php do_action('woocommerce_after_add_to_cart_form'); ?>

<?php endif; ?>