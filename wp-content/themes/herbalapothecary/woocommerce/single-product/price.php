<?php
/**
 * Single Product Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Check that the logged in user has access to the product
$page_level = get_field('user_level', $product->get_id());
$account_level = get_field('user_account_level', 'user_' . get_current_user_id());
$account_level = empty($account_level) ? 'NOT LOGGED IN' : $account_level;

// If the user has a high account level we should include lower levels for them
switch($account_level) {
	case 'Level-3':
		$account_level = [ 'Level-3', 'Level-2', 'Level-1', 'NOT LOGGED IN' ];
		break;
	case 'Level-2':
		$account_level = [ 'Level-2', 'Level-1', 'NOT LOGGED IN' ];
		break;
	case 'Level-1':
		$account_level = [ 'Level-1', 'NOT LOGGED IN' ];
		break;
	case 'NOT LOGGED IN':
		$account_level = [ 'NOT LOGGED IN' ];
		break;
}

// Go through each level for this user and check if it's in the product
$has_access = false;
foreach($account_level as $a) {
	if(in_array($a, $page_level))
		$has_access = true;
}

if(!$has_access){
	if(!is_user_logged_in()){
		echo "<p><a href='/login/'>Log In to View Pricing &amp; Buy</a></p>";
	}else{
		echo '<p class="'.esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ).'">'.$product->get_price_html().'</p>';
	}
}else{
?>
	<p class="<?php echo esc_attr( apply_filters( 'woocommerce_product_price_class', 'price' ) ); ?>"><?php echo $product->get_price_html(); ?></p>
<?php
}
?>