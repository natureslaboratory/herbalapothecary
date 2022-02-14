<?php

/**
 * Template Name: Own Brand
 *
 * The template file for the contract manufacture calculator.
 *
 * @package Martfury
 */

get_header(); ?>

<?php
$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 2000,
	'product_tag' => 'tincture',
	'orderby' => 'title',
	'order' => 'asc'
);

$tinctures = new WP_Query($args);

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 2000,
	'product_tag' => 'fluid extract',
	'orderby' => 'title',
	'order' => 'asc'
);

$extracts = new WP_Query($args);

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => 2000,
	'product_tag' => 'capsule',
	'orderby' => 'title',
	'order' => 'asc'
);

$capsules = new WP_Query($args);

// $newHerbs = wc_get_products([
	
// ]);

// function print_array($array) {
// 	echo "<pre>" . htmlentities(print_r($array, true)) . "</pre>";
// }

// print_array($newHerbs);

// for ($i=0; $i < count($newHerbs); $i++) { 
// 	$herb = $newHerbs[$i]->get_data();
// 	echo $herb["name"];
// 	// echo $herb["data"];
// }

wp_reset_query();

$_pf = new WC_Product_Factory();
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<main class="site-main site-main--shop">
	<div class="c-calculator__heading">
		<h2>Own Brand Herbal Product Calculator</h2>
		<p>
			Use our handy product calculator to get an instant quote for your own branded tinctures and capsules.
		</p>
	</div>
	<form id="calculator" style="padding: 0;">
		<h2>Select a Product Type</h2>
		<ul class="grid type">
			<li><label><img src="/assets/bottle.jpg" alt="Liquid" /><input type="radio" name="type" value="liquid" checked> Liquid <small>Min. Total Quantity 15L</small></label></li>
			<li><label><img src="/assets/capsule.jpg" alt="Capsule" /><input type="radio" name="type" value="capsule"> Capsule <small>Min. Total Quantity 5,000 Capsules</small></label></li>
		</ul>

		<h2>Choose Your Product</h2>
		<p>Use the table below to build your formulation. Add as many ingredients as you like. Use the % column to determine the proportion of each ingredient within the formulation. The <strong>Total</strong> must equal 100 in order to proceed with your quote.
		<div class="ingredients liquid show">
			<div class="i-row heading">
				<div>Liquid</div>
			</div>
			<div class="i-row" id="template-liquid">
				<div>
					<label>Liquid</label>
					<select name="liquid">
						<?php
						while ($tinctures->have_posts()) : $tinctures->the_post();
							global $product;
							if ($product->is_type('variable')) {
								$variable = 'Variable';
								$variations = $product->get_available_variations();
								$v = false;
								foreach ($variations as $variation) {
									if (($variation['attributes']['attribute_pa_size'] == '1000-ml' or $variation['attributes']['attribute_pa_size'] == '1000ml') and $v == false) {
										echo '<option data-price="' . $variation['display_price'] . '">' . get_the_title() . '</option>';
										$v = true;
									}
								}
							}
						endwhile;
						while ($extracts->have_posts()) : $extracts->the_post();
							global $product;
							if ($product->is_type('variable')) {
								$variable = 'Variable';
								$variations = $product->get_available_variations();
								$v = false;
								foreach ($variations as $variation) {
									if (($variation['attributes']['attribute_pa_size'] == '1000-ml' or $variation['attributes']['attribute_pa_size'] == '1000ml') and $v == false) {
										echo '<option data-price="' . $variation['display_price'] . '">' . get_the_title() . '</option>';
										$v = true;
									}
								}
							}
						endwhile;
						?>
					</select>
				</div>
			</div>
			<div id="body-liquid">
			</div>
			<div class="i-row footer" id="footer-liquid">
				<div></div>
			</div>
		</div>


		<div class="ingredients powder">
			<div class="i-row heading">
				<div>Capsule</div>
			</div>
			<div class="i-row" id="template-capsule">
				<div>
					<select name="capsule">
						<?php
						while ($capsules->have_posts()) : $capsules->the_post();
							global $product;
							if ($product->is_type('variable')) {
								$variable = 'Variable';
								$variations = $product->get_available_variations();
								$v = false;
								foreach ($variations as $variation) {
									print_r($variation);
									if ($variation['attributes']['attribute_pa_size'] == '1000 capsules' and $v == false) {
										echo '<option data-price="' . $variation['display_price'] . '">' . get_the_title() . '</option>';
										$v = true;
									}
								}
							}
						endwhile;
						?>
					</select>
				</div>
			</div>
			<div id="body-capsule">
			</div>
			<div class="i-row footer" id="footer-capsule">
				<div></div>
			</div>
		</div>

		<div class="proceed">
			<h2>Choose from our Packaging Options</h2>
			<div class="packaging liquid show">
				<ul class="grid type">
					<li><label><img src="/assets/pipette.jpg" alt="Packaging" /><input type="radio" name="packaging-liquid" value="100ml Dropper Bottle with Pipette" data-minimum="150" data-unit-size="0.1" data-blend-charge="10" data-picking-charge="0.25" data-unit-cost="0.43"> 100ml Dropper Bottle <small>with Pipette</small></label></li>
			</div>
			<div class="packaging capsule">
				<ul class="grid type">
					<li><label><img src="/assets/pot.jpg" alt="Packaging" /><input type="radio" name="packaging-capsule" value="60 Capsule Pots" data-minimum="50" data-unit-size="0.045" data-blend-charge="10" data-picking-charge="0.25" data-unit-cost="0.814"> 60 Capsule Pots <small>with Tamper Evident Lid</small></label></li>
				</ul>
			</div>

			<h2>Select a Labelling Option</h2>
			<label><input type="radio" name="label" value="Own Brand Lanes" data-label-fee="0" checked> Own Brand Labels</label>
			<br />

			<h2>Enter Your Order Quantity</h2>
			<p>Enter your required number of units below - minimum order quantities apply.</p>
			<select id="units">
				<option value="10">10</option>
				<option value="20">20</option>
				<option value="30">30</option>
				<option value="40">40</option>
				<option value="50">50</option>
			</select>
			<p>Units: <em><span id="unitsText" /></em></p>

			<h2>Here's Your Price</h2>
			<p>Based on your formulation and the minimum order quantity the total cost for your order would be:</p>
			<h3>&pound;<span id="price">0.00</span> <small>(&pound;<span id="unitPrice"></span>/unit)</small></h3>

			<h2>Now Request a Call Back</h2>
			<p>Let's talk! Enter your name, email address and phone number below and we'll give you a call back to discuss your quote in more detail.</p>

			<div class="callback">
				<div>
					<label>Name</label>
					<input type="text" name="Name" id="name" /><br />
				</div>
				<div>
					<label>Email Address</label>
					<input type="text" name="Email" id="email" /><br />
				</div>
				<div>
					<label>Phone</label>
					<input type="text" name="Phone" id="phone" /><br />
				</div>
				<div>
					<label>Ready?</label>
					<button class="btn btn-primary" id="request">Submit Details</button>
				</div>
			</div>

			<h2>Want to Chat?</h2>
			<div class="call-tom">
				<img src="/assets/tom.jpg" alt="Tom Cull">
				<div>
					<h3>Call Tom on 01947 602346</h3>
					<p>Tom handles manufacturing enquires at Herbal Apothecary. He'd be glad to discuss your requirements and help you create the best possible product for your business.</p>
				</div>
			</div>

			<h3>The Small Print</h3>
			<p><small>The products offered by the calculator are not exhaustive. If you can't find what you need, please give us a call. Although we have worked hard to provide accurate pricing based on the product and
					packaging options available, the prices quotes are not binding and may be subject to change once you've submitted your details to us for confirmation. The prices shown are based on a single order - if you're
					able to commit to larger quantities over time we may well be able to offer you a discount on the advertised rate - please call for details.</small></p>
		</div>
		<div class="sticky">
			<h3>Total: &pound;<span id="sticky-price">0.00</span> <small>(&pound;<span id="sticky-unitPrice"></span>/unit)</small></h3>
		</div>
	</form>
</main>

<style>
	form#calculator {
		text-align: center;
		padding: 0 1rem;
	}

	form h2 {
		margin-top: 100px;
	}

	#template-liquid button,
	#template-powder button,
	#template-cut button {
		display: none;
	}

	label {
		display: block;
	}

	.proceed {
		display: none;
	}

	.proceed.show {
		display: block;
	}

	#total-liquid-td,
	#total-powder-td,
	#total-cut-td {
		background: #e9ffb5;
	}

	#total-liquid-td.error,
	#total-powder-td.error,
	#total-cut-td.error {
		background: #ffb4ac;
	}

	.packaging {
		display: none;
	}

	.packaging.show {
		display: block;
	}

	ul.grid {
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr;
		grid-column-gap: 2rem;
		text-align: center;
		margin: 0;
		list-style: none;
		max-width: auto;
		margin: 0 auto;
		padding-left: 0px;
	}

	ul.grid li {}

	ul.grid li img {
		display: block;
		width: 200px;
		height: 200px;
		margin: 0 auto;
		margin-bottom: 1rem;
		object-fit: contain;
	}

	ul.grid li input {
		display: block;
		margin: 0 auto;
	}

	ul.grid li small {
		display: block;
	}

	.sticky {
		position: fixed;
		bottom: 0px;
		left: 0px;
		width: 100%;
		padding: 0.5rem;
		background: gold;
		z-index: 1000;
		margin-bottom: 0px;
	}

	#calculator select {
		width: 400px;
	}

	.select2 {
		width: 100% !important;
	}

	.ingredients {
		width: 100%;
		max-width: 720px;
		margin: 0 auto;
		display: none;
	}

	.ingredients select {
		max-width: 400px;
	}

	.ingredients input[type=number] {
		max-width: 60px;
	}

	.ingredients.show {
		display: block;
	}

	.ingredients .i-row {
		width: 100%;
		text-align: left;
		display: grid;
		grid-template-columns: 400px 160px 160px;
	}

	.ingredients .i-row div {
		padding: 0.3rem;
	}

	.ingredients .i-row.heading {
		font-weight: 700;
	}

	.ingredients input {
		max-width: 120px;
	}

	.ingredients label {
		display: none;
		font-weight: 700;
	}

	.select2-container {
		width: 100% !important;
	}

	.select2-search--dropdown .select2-search__field {
		width: 98%;
	}

	.callback {
		width: 100%;
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr;
		grid-column-gap: 1rem;
	}

	.callback label {
		font-weight: 700;
	}

	.callback input[type=text] {
		padding: 15px 10px;
	}

	.call-tom {
		width: 768px;
		max-width: 100%;
		background: #f1f2f2;
		display: grid;
		margin: 0 auto;
		margin-bottom: 200px;
		grid-template-columns: 240px auto;
	}

	.call-tom img {
		width: 240px;
		height: 240px;
		object-fit: cover;
	}

	.call-tom div {
		padding: 1rem 2rem;
		text-align: left;
	}

	@media screen and (max-width:1000px) {
		.callback {
			grid-template-columns: 1fr;
			grid-row-gap: 1rem;
		}
	}

	@media screen and (max-width:680px) {
		ul.grid {
			grid-template-columns: 1fr 1fr 1fr;
		}

		ul.grid li img {
			height: 120px;
		}

		#calculator select {
			width: 200px;
		}

		.ingredients .i-row {
			grid-template-columns: 1fr;
			border-bottom: 1px solid #ccc;
			padding-bottom: 0.3rem;
			margin-bottom: 0.3rem;
		}

		.ingredients .i-row.heading {
			display: none;
		}

		.ingredients label {
			display: block;
		}

		.select2-container {
			max-width: 240px;
		}

		.i-row.footer {
			border-bottom: none;
		}

		.i-row.footer .i-add {
			grid-row: 1;
		}

		.sticky h3 {
			font-size: 16px;
			padding: 0.8rem;
			margin: 0.5rem;
		}

		.call-tom {
			grid-template-columns: 140px auto;
			background: transparent;
			border-top: 1px solid #ccc;
			border-bottom: 1px solid #ccc;
		}

		.call-tom img {
			width: 140px;
			height: 140px;
			margin-top: 40px;
		}
	}

	@media screen and (max-width:480px) {
		ul.grid {
			grid-template-columns: 1fr 1fr;
		}

		ul.grid li img {
			height: 80px;
		}

		#calculator select {
			width: 120px;
		}

		.call-tom {
			grid-template-columns: 100px auto;
		}

		.call-tom img {
			width: 100px;
			height: 100px;
		}
	}
</style>
<script type="text/javascript">
	jQuery('input[type=radio][name=type]').change(function() {
		jQuery('.ingredients').removeClass('show');
		jQuery('.packaging').removeClass('show');
		if (this.value == 'liquid') {
			jQuery('.ingredients.liquid').addClass('show');
			jQuery('.packaging.liquid').addClass('show');
		} else if (this.value == 'capsule') {
			jQuery('.ingredients.powder').addClass('show');
			jQuery('.packaging.capsule').addClass('show');
		} else if (this.value == 'powder') {
			jQuery('.ingredients.powder').addClass('show');
			jQuery('.packaging.powder').addClass('show');
		} else if (this.value == 'cut') {
			jQuery('.ingredients.cut').addClass('show');
			jQuery('.packaging.cut').addClass('show');
		}
		calcCut();
		calcLiquid();
		calcPowder();
	});
	jQuery('#add-liquid').click(function() {
		jQuery("select.select2-hidden-accessible").select2('destroy');
		var html = jQuery('#template-liquid').html();
		jQuery('#body-liquid').append('<div class="i-row">' + html + '</div>');
		calcLiquid();
		jQuery('#calculator select').select2();
	})
	jQuery('body').on('click', 'button.remove-liquid', function() {
		var rowCount = jQuery('.ingredients.liquid .i-row').length;
		if (rowCount > 3) {
			jQuery(this).parents(".i-row").remove();
		}
		calcLiquid();
	})
	jQuery('#add-powder').click(function() {
		jQuery("select.select2-hidden-accessible").select2('destroy');
		var html = jQuery('#template-powder').html();
		jQuery('#body-powder').append('<div class="i-row">' + html + '</div>');
		calcPowder();
		jQuery('#calculator select').select2();
	})
	jQuery('body').on('click', 'button.remove-powder', function() {
		var rowCount = jQuery('.ingredients.powder .i-row').length;
		if (rowCount > 3) {
			jQuery(this).parents(".i-row").remove();
		}
		calcPowder();
	})
	jQuery('#add-cut').click(function() {
		jQuery("select.select2-hidden-accessible").select2('destroy');
		var html = jQuery('#template-cut').html();
		jQuery('#body-cut').append('<div class="i-row">' + html + '</div>');
		calcCut();
		jQuery('#calculator select').select2();
	})
	jQuery('body').on('click', 'button.remove-cut', function() {
		var rowCount = jQuery('.ingredients.cut .i-row').length;
		if (rowCount > 3) {
			jQuery(this).parents(".i-row").remove();
		}
		calcCut();
	})

	function calcLiquid() {
		var totalLiquid = parseInt(0);
		jQuery(".ingredients.liquid input[type=number]").each(function(index) {
			totalLiquid = totalLiquid + parseInt(jQuery(this).val());
		});
		jQuery('#total-liquid').text(totalLiquid);
		if (totalLiquid == 100) {
			jQuery('.proceed').addClass('show');
			jQuery('#total-liquid-td').removeClass('error');
		} else {
			jQuery('.proceed').removeClass('show');
			jQuery('#total-liquid-td').addClass('error');
		}
		calcPrice();
	}
	jQuery('body').on('change', '.ingredients.liquid input[type=number]', function() {
		calcLiquid();
	});
	jQuery('body').on('change', '.ingredients.liquid select', function() {
		calcLiquid();
	});

	function calcPowder() {
		var totalPowder = parseInt(0);
		jQuery(".ingredients.powder input[type=number]").each(function(index) {
			totalPowder = totalPowder + parseInt(jQuery(this).val());
		});
		jQuery('#total-powder').text(totalPowder);
		if (totalPowder == 100) {
			jQuery('.proceed').addClass('show');
			jQuery('#total-powder-td').removeClass('error');
		} else {
			jQuery('.proceed').removeClass('show');
			jQuery('#total-powder-td').addClass('error');
		}
		calcPrice();
	}
	jQuery('body').on('change', '.ingredients.powder input[type=number]', function() {
		calcPowder();
	});
	jQuery('body').on('change', '.ingredients.powder select', function() {
		calcPowder();
	});

	function calcCut() {
		var totalCut = parseInt(0);
		jQuery(".ingredients.cut input[type=number]").each(function(index) {
			totalCut = totalCut + parseInt(jQuery(this).val());
		});
		jQuery('#total-cut').text(totalCut);
		if (totalCut == 100) {
			jQuery('.proceed').addClass('show');
			jQuery('#total-cut-td').removeClass('error');
		} else {
			jQuery('.proceed').removeClass('show');
			jQuery('#total-cut-td').addClass('error');
		}
		calcPrice();
	}
	jQuery('body').on('change', '.ingredients.cut input[type=number]', function() {
		calcCut();
	});
	jQuery('body').on('change', '.ingredients.cut select', function() {
		calcCut();
	});

	jQuery('input[type=radio][name=packaging-liquid],input[type=radio][name=packaging-capsule],input[type=radio][name=packaging-powder],input[type=radio][name=packaging-cut],input[type=radio][name=label]').change(function() {
		calcPrice();
	});

	jQuery('#units').change(function() {
		calcPrice();
	});

	function calcPrice() {
		var type = jQuery('input[type=radio][name=type]:checked').val();
		if (type == 'liquid') {
			var total = parseInt(0);
			const prices = [];
			const quantities = [];
			jQuery(".ingredients.liquid select").each(function(index) {
				var price = jQuery(this).find(':selected').data('price');
				prices.push(price * 100);
			});
			jQuery(".ingredients.liquid input[type=number]").each(function(index) {
				var quantity = jQuery(this).val();
				quantities.push(quantity);
			});
			var quantity = prices.length;
			var i = 0;
			while (i < quantity) {
				var pPrice = prices[i];
				var pQuantity = quantities[i];
				var pPrice = parseFloat(pPrice * (pQuantity / 100) / 100);
				total = total + pPrice;
				i++;
			}
			var minimum = jQuery('input[type=radio][name=packaging-liquid]:checked').data('minimum');
			var unitCost = jQuery('input[type=radio][name=packaging-liquid]:checked').data('unitCost');
			var unitSize = jQuery('input[type=radio][name=packaging-liquid]:checked').data('unit-size');
			var pickingCharge = jQuery('input[type=radio][name=packaging-liquid]:checked').data('picking-charge');
			var blendCharge = jQuery('input[type=radio][name=packaging-liquid]:checked').data('blend-charge');
		} else if (type == 'capsule') {
			var total = parseInt(0);
			const prices = [];
			const quantities = [];
			jQuery(".ingredients.powder select").each(function(index) {
				var price = jQuery(this).find(':selected').data('price');
				prices.push(price * 100);
			});
			jQuery(".ingredients.powder input[type=number]").each(function(index) {
				var quantity = jQuery(this).val();
				quantities.push(quantity);
			});
			var quantity = prices.length;
			var i = 0;
			while (i < quantity) {
				var pPrice = prices[i];
				var pQuantity = quantities[i];
				var pPrice = parseFloat(pPrice * (pQuantity / 100) / 100);
				total = total + pPrice;
				i++;
			}
			var minimum = jQuery('input[type=radio][name=packaging-capsule]:checked').data('minimum');
			var unitCost = jQuery('input[type=radio][name=packaging-capsule]:checked').data('unitCost');
			var unitSize = jQuery('input[type=radio][name=packaging-capsule]:checked').data('unit-size');
			var pickingCharge = jQuery('input[type=radio][name=packaging-capsule]:checked').data('picking-charge');
			var blendCharge = jQuery('input[type=radio][name=packaging-capsule]:checked').data('blend-charge');
		} else if (type == 'powder') {
			var total = parseInt(0);
			const prices = [];
			const quantities = [];
			jQuery(".ingredients.powder select").each(function(index) {
				var price = jQuery(this).find(':selected').data('price');
				prices.push(price * 100);
			});
			jQuery(".ingredients.powder input[type=number]").each(function(index) {
				var quantity = jQuery(this).val();
				quantities.push(quantity);
			});
			console.log(prices);
			var quantity = prices.length;
			var i = 0;
			while (i < quantity) {
				var pPrice = prices[i];
				var pQuantity = quantities[i];
				var pPrice = parseFloat(pPrice * (pQuantity / 100) / 100);
				total = total + pPrice;
				i++;
			}
			var minimum = jQuery('input[type=radio][name=packaging-powder]:checked').data('minimum');
			var unitCost = jQuery('input[type=radio][name=packaging-powder]:checked').data('unitCost');
			var unitSize = jQuery('input[type=radio][name=packaging-powder]:checked').data('unit-size');
			var pickingCharge = jQuery('input[type=radio][name=packaging-powder]:checked').data('picking-charge');
			var blendCharge = jQuery('input[type=radio][name=packaging-powder]:checked').data('blend-charge');
		} else if (type == 'cut') {
			var total = parseInt(0);
			const prices = [];
			const quantities = [];
			jQuery(".ingredients.cut select").each(function(index) {
				var price = jQuery(this).find(':selected').data('price');
				prices.push(price * 100);
			});
			jQuery(".ingredients.cut input[type=number]").each(function(index) {
				var quantity = jQuery(this).val();
				quantities.push(quantity);
			});
			var quantity = prices.length;
			var i = 0;
			while (i < quantity) {
				var pPrice = prices[i];
				var pQuantity = quantities[i];
				var pPrice = parseFloat(pPrice * (pQuantity / 100) / 100);
				total = total + pPrice;
				i++;
			}
			var minimum = jQuery('input[type=radio][name=packaging-cut]:checked').data('minimum');
			var unitCost = jQuery('input[type=radio][name=packaging-cut]:checked').data('unitCost');
			var unitSize = jQuery('input[type=radio][name=packaging-cut]:checked').data('unit-size');
			var pickingCharge = jQuery('input[type=radio][name=packaging-cut]:checked').data('picking-charge');
			var blendCharge = jQuery('input[type=radio][name=packaging-cut]:checked').data('blend-charge');
		}
		var labelFee = jQuery('input[type=radio][name=label]:checked').data('label-fee');
		var units = jQuery('#units').val();
		if (units < minimum) {
			jQuery('#units').val(minimum);
		}
		jQuery('#units').attr('min', minimum);
		var units = jQuery('#units').val();

		//CALC TOTAL MASTER UNITS
		var totalQuantity = parseInt(units) * parseFloat(unitSize);
		var productCost = parseFloat(totalQuantity) * parseFloat(total);
		var packagingCost = (parseFloat(unitCost) + parseFloat(labelFee)) * parseInt(units);
		var ingredients = quantity;
		var pickingFee = (parseFloat(pickingCharge) * ingredients) * totalQuantity;
		/*
			console.log("Per KG/L Cost: " + total);
			console.log("Total Product Cost: " + productCost);
			console.log("Total Picking Cost: " + pickingFee);
			console.log("Total Blending Cost: " + blendCharge);
			console.log("Total Packaging Cost: " + packagingCost);
		*/
		var grandTotal = (parseFloat(productCost) + parseFloat(packagingCost) + parseFloat(blendCharge) + parseFloat(pickingFee)) * 2.5;
		var unitCost = parseFloat(grandTotal / units);
		jQuery('#price,#sticky-price').text(grandTotal.toFixed(2));
		jQuery('#unitPrice,#sticky-unitPrice').text(unitCost.toFixed(2));

		jQuery('#calculator select').select2();

		var pType = jQuery('input[type=radio][name=type]:checked').val();
		if (pType == 'liquid') {
			var pPackaging = jQuery('input[type=radio][name=packaging-liquid]:checked').val();
		}
		if (pType == 'capsule') {
			var pPackaging = jQuery('input[type=radio][name=packaging-capsule]:checked').val();
		}
		if (pType == 'powder') {
			var pPackaging = jQuery('input[type=radio][name=packaging-powder]:checked').val();
		}
		if (pType == 'cut') {
			var pPackaging = jQuery('input[type=radio][name=packaging-cut]:checked').val();
		}
		jQuery('#unitsText').text(pPackaging);
	}

	calcLiquid();
	calcPrice();

	jQuery(document).ready(function() {
		jQuery('#calculator select').select2({
			width: 'resolve'
		});
	});

	jQuery('body').on('click', '#request', function(e) {
		e.preventDefault();
		var pName = jQuery('#name').val();
		var pEmail = jQuery('#email').val();
		var pPhone = jQuery('#phone').val();
		var pCost = jQuery('#price').text();
		var pUnitCost = jQuery('#unitPrice').text();
		const ingredients = [];
		const quantities = [];
		if (pName == '' || pEmail == '' || pPhone == '') {
			alert('Please enter your name, email and phone number');
		} else {
			var pType = jQuery('input[type=radio][name=type]:checked').val();
			var pUnits = jQuery('#units').val();
			var pLabel = jQuery('input[type=radio][name=label]:checked').val();
			if (pType == 'liquid') {
				var pPackaging = jQuery('input[type=radio][name=packaging-liquid]:checked').val();
				jQuery(".ingredients.liquid select").each(function(index) {
					var ingredient = jQuery(this).find(':selected').text();
					ingredients.push(ingredient);
				});
				jQuery(".ingredients.liquid input[type=number]").each(function(index) {
					var quantity = jQuery(this).val();
					quantities.push(quantity);
				});
			}
			if (pType == 'capsule') {
				var pPackaging = jQuery('input[type=radio][name=packaging-capsule]:checked').val();
				jQuery(".ingredients.powder select").each(function(index) {
					var ingredient = jQuery(this).find(':selected').text();
					ingredients.push(ingredient);
				});
				jQuery(".ingredients.powder input[type=number]").each(function(index) {
					var quantity = jQuery(this).val();
					quantities.push(quantity);
				});
			}
			if (pType == 'powder') {
				var pPackaging = jQuery('input[type=radio][name=packaging-powder]:checked').val();
				jQuery(".ingredients.powder select").each(function(index) {
					var ingredient = jQuery(this).find(':selected').text();
					ingredients.push(ingredient);
				});
				jQuery(".ingredients.powder input[type=number]").each(function(index) {
					var quantity = jQuery(this).val();
					quantities.push(quantity);
				});
			}
			if (pType == 'cut') {
				var pPackaging = jQuery('input[type=radio][name=packaging-cut]:checked').val();
				jQuery(".ingredients.cut select").each(function(index) {
					var ingredient = jQuery(this).find(':selected').text();
					ingredients.push(ingredient);
				});
				jQuery(".ingredients.cut input[type=number]").each(function(index) {
					var quantity = jQuery(this).val();
					quantities.push(quantity);
				});
			}
		}

		pIngredients = JSON.stringify(ingredients);
		pQuantities = JSON.stringify(quantities);

		jQuery.post("/submitCalculator.php", {
				name: pName,
				email: pEmail,
				phone: pPhone,
				price: pCost,
				unitPrice: pUnitCost,
				type: pType,
				units: pUnits,
				label: pLabel,
				packaging: pPackaging,
				formulation: pIngredients,
				values: pQuantities
			})
			.done(function(data) {
				jQuery('#calculator').html('<h2>Thank You</h2><p>Thanks for submitting your request - we have received the information you entered into the calculator and will give you a call back soon to discuss your order. <a href="/calculator/">Click here</a> to get another price.</p>');
				jQuery("html, body").animate({
					scrollTop: 0
				}, "slow");
			});
	});
</script>

<?php get_footer(); ?>