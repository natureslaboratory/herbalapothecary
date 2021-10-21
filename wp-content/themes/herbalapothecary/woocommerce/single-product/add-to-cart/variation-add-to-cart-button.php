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

if (!$has_access) {
	echo '<p><b>This product is restricted and can only be purchased by qualified/registered practitioners. Please log in to make a purchase.</b></p>';
	return;
}

?>
<div class="woocommerce-variation-add-to-cart variations_button">
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
	?>

	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />

</div>
<h4 style="display:none;" class="no-stock">Sorry, Currently Out Of Stock</h4>
<?php
	
	if(is_user_logged_in()){

?>
<span id="spec" style="width:100%;float:left;background:#f1f1f1;margin-top:30px;"></span>
<?php
	$productCode = $product->get_sku();
	$productCode = substr($productCode,0,-1);	
?>
<script>
	jQuery(document).ready(function(){
		jQuery.post("https://natureslaboratory.co.uk/herbal-apothecary/spec-exists/?productCode=<?php echo $productCode; ?>", function( data ) {
			console.log(data);
		  if(data==1){
			  jQuery('#spec').html("<p style='margin-bottom:0px;'><strong><a style='padding:10px;float:left;display:block;' href='https://natureslaboratory.co.uk/herbal-apothecary/get-spec/?productCode=<?php echo $productCode; ?>'>Click Here to download the Nature's Laboratory Specification file (PDF)</a></strong></p>");
		  }
		});
	});
</script>
<?php
	}
?>
<?php
	$variations = $product->get_available_variations();
	print_r($variations);
	try {
		//code...
		$variations_stock = wpse_306996_get_variations_stock_quantity($product->get_id());
	} catch (\Throwable $th) {
		//throw $th;
		echo $th->getMessage();
	}
	//print_r($variations_stock);
	$i = 0;
	$qArray = array();
	foreach($variations_stock as $qty){
		if($variations[$i]['attributes']['attribute_pa_size']<>''){
			$string = $variations[$i]['attributes']['attribute_pa_size'];
		}else{
			$string = $variations[$i]['attributes']['attribute_size'];
		}
		$type = substr($string, -2);
		preg_match_all('!\d+!', $string, $matches);
		$size = $matches[0][0];
		$qArray[$size] = $qty;
		$i++;
	}
	if($type<>'ml'){
		krsort($qArray);
		$i = 0;
		foreach($qArray as $size => $qty){
			if($qty>0){
				$desc = $qty;
			}
			if($qty==0 AND $desc>0){
				$qArray[$size] = $desc;
			}
			$i++;
		}
	}else{
		ksort($qArray);
	}
	print_r($qArray);
?>

<script type="text/javascript">
	function checkStock(){
		
		if(jQuery('#pa_size').length>0){
			var field = '#pa_size';
		}else{
			var field = '#size';
		}
		
		var option = jQuery(field).val();
		var options = jQuery(field+' option').length;
		var stock_quantities = [<?php foreach($qArray as $qty){echo $qty.',';} ?>];
		console.log(stock_quantities);
		i = 1;
		var stock_variants = [];
		while (i < options) {
			stock_variants.push(jQuery(field+' option:eq('+i+')').val());
		  	i++;
		}
		var i;
		for (i = 0; i < stock_variants.length; i++) {
			if(option == stock_variants[i]){
				break;
			}
		}
		var stock_level = stock_quantities[i];
		console.log(stock_variants);
		if(stock_level==0){
			jQuery('.woocommerce-variation-add-to-cart').hide();
			jQuery('.no-stock').show();
		}else{
			jQuery('.woocommerce-variation-add-to-cart').show();
			jQuery('.no-stock').hide();
		}
		
		for (i = 0; i < stock_variants.length; i++) {
			var y = i++;
			if(stock_quantities[i]==0){
				jQuery('#pa_size option:nth-child('+y+')').hide();
				console.log('#pa_size option:nth-child('+y+')');
			}
		}
		
	}
	jQuery('#pa_size,#size').change(function(){
		checkStock();
	});
	jQuery(document).ready(function() {
		checkStock();
		setTimeout(function() {
			jQuery(document.body).trigger('wc_fragment_refresh');
		}, 1000);
	});
</script>
<?php //print_r($product); ?>