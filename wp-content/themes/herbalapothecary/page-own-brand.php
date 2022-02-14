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
			<li><label><img src="/assets/bottle.jpg" alt="Liquid" /><input type="radio" name="type" value="liquid" checked> Liquid <small>In 100ml Dropper Bottles with Pipette</small></label></li>
			<li><label><img src="/assets/capsule.jpg" alt="Capsule" /><input type="radio" name="type" value="capsule"> Capsule <small>In 60 Capsule Pots with Tamper-Evident Lid</small></label></li>
		</ul>

		<h2>Choose Your Product</h2>
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


		<div class="ingredients capsule">
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
									if ($variation['attributes']['attribute_pa_size'] == '1000-capsules' and $v == false) {
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
			<h2>Here's Your Price</h2>
			<p>The cost for 10 of your own-brand product would be:</p>
			<h3>&pound;<span id="price">0.00</span></h3>

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
		grid-template-columns: 1fr 1fr;
		grid-column-gap: 2rem;
		text-align: center;
		list-style: none;
		max-width: auto;
		margin: 0 auto;
		padding-left: 0px;
		max-width:800px;
		margin:0 auto;
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
		width: 100%;
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
		max-width: 100%;
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
			jQuery('.ingredients.capsule').addClass('show');
			jQuery('.packaging.capsule').addClass('show');
		}
		calcLiquid();
		calcCapsule();
	});

	function calcLiquid() {
		calcPrice();
	}
	jQuery('body').on('change', '.ingredients.liquid select', function() {
		calcLiquid();
	});

	function calcCapsule() {
		calcPrice();
	}
	jQuery('body').on('change', '.ingredients.capsule select', function() {
		calcCapsule();
	});

	jQuery('input[type=radio][name=packaging-liquid],input[type=radio][name=packaging-capsule]').change(function() {
		calcPrice();
	});

	jQuery('#units').change(function() {
		calcPrice();
	});

	function calcPrice() {
		var type = jQuery('input[type=radio][name=type]:checked').val();
		if (type == 'liquid') {
			jQuery(".ingredients.liquid select").each(function(index) {
				var price = jQuery(this).find(':selected').data('price');
				var dropper = 0.51;
				var pipette = 0.6;
				
				var label = 0.08;
				var labour = 25;
		
				//CALC TOTAL MASTER UNITS
				
				console.log(price);
				console.log(dropper);
				console.log(pipette);
				console.log(label);
				console.log(labour);
				
				var grandTotal = parseInt(price)+((parseFloat(dropper)+parseInt(pipette)+parseFloat(label))*10)+parseInt(labour);
				
				jQuery('#price').text(grandTotal.toFixed(2));
			});
		} else if (type == 'capsule') {
			jQuery(".ingredients.capsule select").each(function(index) {
				var price = jQuery(this).find(':selected').data('price');
				var bottle = 0.27;
				var lid = 0.1;
				
				var label = 0.08;
				var labour = 25;
		
				//CALC TOTAL MASTER UNITS
				
				console.log(price);
				console.log(bottle);
				console.log(lid);
				console.log(label);
				console.log(labour);
				
				var grandTotal = ((parseInt(price)/1000)*600)+((parseFloat(bottle)+parseInt(lid)+parseFloat(label))*10)+parseInt(labour);
				
				jQuery('#price').text(grandTotal.toFixed(2));
			});
		}

		jQuery('#calculator select').select2();
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