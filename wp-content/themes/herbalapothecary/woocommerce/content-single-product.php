<?php

/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined('ABSPATH') || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action('woocommerce_before_single_product');

if (post_password_required()) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('c-product-full', $product); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action('woocommerce_before_single_product_summary');
	?>

	<div class="summary entry-summary">
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */

		 

		do_action('woocommerce_single_product_summary');
		?>
		<div class="c-product-full__cta">
			<div class="bulk">
				<img src="/wp-content/themes/herbalapothecary/images/keg.png" alt="Keg" />
				<h2>Bulk Quantities</h2>
				<p>Herbal Apothecary can supply bulk quantities of cut, whole and powdered herbs as well as capsules and herbal tinctures. <a href="https://herbalapothecaryuk.com/bulk-herbal-products-for-industry/">Find out More</a>.</p>
			</div>
			<div class="ownbrand">
				<img src="/wp-content/themes/herbalapothecary/images/dropper.png" alt="Dropper" />
				<h2>Own Brand Products</h2>
				<p>Are you looking to create your own product range? Use our 'own-brand' service and put your name on our high quality products. <a href="https://herbalapothecaryuk.com/own-brand-herbal-products/">Find out More</a>.</p>
			</div>
		</div>
	</div>
	<div class="c-product-full__sidebar">
		<i class="fas fa-globe"></i>
		<p>
			We aim to dispatch products within 1 working day.
		</p>
		<i class="fas fa-mobile-alt"></i>
		<p>
			Call us now for more info about our products on +44 (0)1947 602346
		</p>
		<i class="fas fa-pallet"></i>
		<p>
			Return unopened items within 14 days for a refund.
		</p>
		<i class="far fa-star"></i>
		<p>
			Review this product and let others know what you think.
		</p>
		<!-- TrustBox widget - Micro Review Count -->
		<div class="trustpilot-widget" data-locale="en-GB" data-template-id="5419b6a8b0d04a076446a9ad" data-businessunit-id="616978080bd1fb001d4d29a5" data-style-height="24px" data-style-width="100%" data-theme="light">
		  <a href="https://uk.trustpilot.com/review/herbalapothecaryuk.com" target="_blank" rel="noopener">Trustpilot</a>
		</div>
		<div class="logos">
			<img src="/wp-content/themes/herbalapothecary/images/livingwage.svg" alt="Living Wage" class="livingwage" />
			<img src="/wp-content/themes/herbalapothecary/images/gbc.svg" alt="GBC" class="gbc" />
		</div>
		<!-- End TrustBox widget -->
		<div class="product_meta">

			<?php do_action( 'woocommerce_product_meta_start' ); ?>
		
			<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
		
				<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'woocommerce' ); ?> <span class="sku"><?php echo ( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'woocommerce' ); ?></span></span>
		
			<?php endif; ?>
		
			<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
		
			<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</span>' ); ?>
		
			<?php do_action( 'woocommerce_product_meta_end' ); ?>
		
		</div>
	</div>
	
	<div class="c-promises product">
	    <div class="c-promises__promise">
	        <i class="fas fa-briefcase-medical"></i>
	        <div>
	            <h2>Medical Herbalists</h2>
	            <p>Products You & Your Patients Can Trust</p>
	        </div>
	    </div>
	    <div class="c-promises__promise">
	        <i class="fas fa-industry"></i>
	        <div>
	            <h2>Trade &amp; Industry</h2>
	            <p>Bulk Quantities, Quickly Delivered</p>
	        </div>
	    </div>
	    <div class="c-promises__promise">
	        <i class="fas fa-capsules"></i>
	        <div>
	            <h2>High Quality Products</h2>
	            <p>We're Herb Mark &amp; ISO Certified</p>
	        </div>
	    </div>
	    <div class="c-promises__promise">
	        <i class="far fa-credit-card"></i>
	        <div>
	            <h2>Friendly Support</h2>
	            <p>Our Knowledgable Team are Here to Help</p>
	        </div>
	    </div>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action('woocommerce_after_single_product_summary');
	?>
</div>


<?php do_action('woocommerce_after_single_product'); ?>