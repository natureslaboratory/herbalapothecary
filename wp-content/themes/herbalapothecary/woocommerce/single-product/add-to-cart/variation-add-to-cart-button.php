<?php
/**
 * Single variation cart button
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

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

echo '<p id="bulk-message">For bulk quantities call our team on 01947 602346 for a quote.</p>
<script>
	jQuery(document).ready(function(){
		jQuery("#pa_size").change(function(){
			var size = jQuery("#pa_size").val();
			if(size == "25-litre-keg" || size == "25kg"){
				jQuery("#bulk-message").show();
			}else{
				jQuery("#bulk-message").hide();
			}
		})
	});
</script>';

if (!$has_access) {
	echo '<a class="alert warning" href="/register/"><h2>Please Register or Log In to Buy</h2><p>We\'re a wholesale supplier to practitioners and manufacturers. Some of our products are resitircted and so we ask all customers to register an account before purchasing from us. Click here to register.</p></a><br />';
	return;
}

?>
<div class="woocommerce-variation-add-to-cart variations_button">

	<?php if($has_access){ ?>
	
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );

	woocommerce_quantity_input(
		array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		)
	);

	do_action( 'woocommerce_after_add_to_cart_quantity' );
	if(is_user_logged_in()){
	?>

	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
	
	<?php
		}
		}
	?>

</div>
<h4 style="display:none;" class="no-stock">Sorry, Currently Out Of Stock</h4>
<span id="spec"></span>
<?php
	$productCode = $product->get_sku();
	$productCode = substr($productCode,0,-1);	
?>
<script>
	jQuery(document).ready(function(){
		jQuery.post("https://natureslaboratory.co.uk/herbal-apothecary/spec-exists/?productCode=<?php echo $productCode; ?>", function( data ) {
			console.log(data);
		  if(data==1){
			  jQuery('#spec').html("<a class='spec-download' href='https://natureslaboratory.co.uk/herbal-apothecary/get-spec/?productCode=<?php echo $productCode; ?>'><h2>Download Product Specification</h2><p>Click Here to download the Nature's Laboratory Specification file (PDF)</p></a>");
		  }
		});
	});
</script>