<?php

/**
 * herbalapothecary functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package herbalapothecary
 */
 
require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-base.php';
require_once ABSPATH . 'wp-admin/includes/class-wp-filesystem-direct.php';

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

if (!function_exists('herbalapothecary_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function herbalapothecary_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on herbalapothecary, use a find and replace
		 * to change 'herbalapothecary' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('herbalapothecary', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__('Primary', 'herbalapothecary'),
				'account-dropdown' => esc_html__('Account Menu', 'herbalapothecary')
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'herbalapothecary_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		add_theme_support("woocommerce");
	}
endif;
add_action('after_setup_theme', 'herbalapothecary_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function herbalapothecary_content_width()
{
	$GLOBALS['content_width'] = apply_filters('herbalapothecary_content_width', 640);
}
add_action('after_setup_theme', 'herbalapothecary_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function herbalapothecary_widgets_init()
{
	register_sidebar(
		array(
			'name'          => esc_html__('Sidebar', 'herbalapothecary'),
			'id'            => 'sidebar-1',
			'description'   => esc_html__('Add widgets here.', 'herbalapothecary'),
			'before_widget' => '<section id="%1$s" class="widget c-shop__sidebar-element %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action('widgets_init', 'herbalapothecary_widgets_init');

add_filter('woocommerce_product_tag_cloud_widget_args', 'woo_tag_cloud_filter');
function woo_tag_cloud_filter($args)
{
	$args = array(
		'smallest' => 14,
		'largest' => 14,
		'format' => 'list',
		'taxonomy' => 'product_tag',
		'unit' => 'px',
	);
	return $args;
}

function woocommerce_remove_breadcrumb()
{
	remove_action(
		'woocommerce_before_main_content',
		'woocommerce_breadcrumb',
		20
	);
}
add_action(
	'woocommerce_before_main_content',
	'woocommerce_remove_breadcrumb'
);

function woocommerce_custom_breadcrumb()
{
	woocommerce_breadcrumb();
}

add_action('woo_custom_breadcrumb', 'woocommerce_custom_breadcrumb');

add_filter('woocommerce_product_description_heading', '__return_null');

remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);




function custom_woocommerce_breadcrumbs()
{
	return [
		"delimiter" => ' > ',
		"wrap_before" => "<div class='c-breadcrumbs l-block'><div class='l-restrict c-breadcrumbs__inner'>",
		"wrap_after" => "</div></div>",
		'before'      => '',
		'after'       => '',
		'home'        => _x('Home', 'breadcrumb', 'woocommerce'),
	];
}
add_filter("woocommerce_breadcrumb_defaults", "custom_woocommerce_breadcrumbs");



function herbalapothecary_add_custom_sorting_options($options)
{

	// Add some options
	// $options['common'] = 'Sort by Common Name';
	// $options['latin'] = 'Sort by Latin Name';

	// Remove some default options
	// unset($options['popularity']);
	// unset($options['rating']);
	// unset($options['date']);

	$options = [
		'common'	=> 'Sort by Common Name',
		'latin'		=> 'Sort by Latin Name',
		'price'		=> 'Sort by price: low to high',
		'price-desc'		=> 'Sort by price: high to low'
	];

	return $options;
}
add_filter('woocommerce_catalog_orderby', 'herbalapothecary_add_custom_sorting_options');


/**
 * Enqueue scripts and styles.
 */
function herbalapothecary_scripts()
{
	wp_enqueue_style('herbalapothecary-style', get_stylesheet_uri(), array(), _S_VERSION);
	wp_enqueue_style('herbalapothecary-base', get_template_directory_uri() . "/css/base.css",  [], _S_VERSION);
	wp_enqueue_style('herbalapothecary-layout', get_template_directory_uri() . "/css/layout.css",  [], _S_VERSION);
	wp_enqueue_style('herbalapothecary-components', get_template_directory_uri() . "/css/components.css",  [], _S_VERSION);
	wp_style_add_data('herbalapothecary-style', 'rtl', 'replace');

	wp_enqueue_script('herbalapothecary-scripts', get_template_directory_uri() . '/js/index.js', array(), _S_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'herbalapothecary_scripts');

function my_excerpt_length($length)
{
	return 30;
}

add_filter('excerpt_length', 'my_excerpt_length');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}

function shop_toolbar_start()
{
	echo "<div class='c-products__banner'>";
}

function shop_toolbar_end()
{
	echo "</div>";
}

add_action("woocommerce_before_shop_loop", "shop_toolbar_start", 9);
add_action("woocommerce_before_shop_loop", "shop_toolbar_end", 40);

function price()
{
}

add_action("woocommerce_after_shop_loop_item_title", "price", 11);

add_action('woocommerce_after_add_to_cart_quantity', 'ts_quantity_plus_sign');

function ts_quantity_plus_sign()
{
	echo '<button type="button" class="plus" >+</button>';
	echo "</div>";
}

add_action('woocommerce_before_add_to_cart_quantity', 'ts_quantity_minus_sign');
function ts_quantity_minus_sign()
{
	echo "<div class='c-quantity'>";
	echo '<button type="button" class="minus" >-</button>';
}

add_action('wp_footer', 'ts_quantity_plus_minus');

function ts_quantity_plus_minus()
{
	// To run this on the single product page
	if (!is_product()) return;
?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('form.cart').on('click', 'button.plus, button.minus', function() {

				// Get current quantity values
				var qty = $(this).closest('form.cart').find('.qty');
				var val = parseFloat(qty.val());
				var max = parseFloat(qty.attr('max'));
				var min = parseFloat(qty.attr('min'));
				var step = parseFloat(qty.attr('step'));

				// Change the value if plus or minus
				if ($(this).is('.plus')) {
					if (max && (max <= val)) {
						qty.val(max);
					} else {
						qty.val(val + step);
					}
				} else {
					if (min && (min >= val)) {
						qty.val(min);
					} else if (val > 1) {
						qty.val(val - step);
					}
				}

			});

		});
	</script>
<?php
}


function custom_search($query)
{
	// Don't do this filtering on the tag pages
	if ((array_key_exists("product_tag", $_REQUEST) && $_REQUEST['product_tag'] !== NULL) || strstr($_SERVER['REQUEST_URI'], '/product-tag/') || strstr($_SERVER['REQUEST_URI'], '/calculator/')) {
		return $query;
	}


	if ((is_shop() || is_product_category()) && !is_search()) {
		if (!is_admin()) { // Don't apply it to admin users
			if ($query->is_search() || $query->is_archive()) {
				$meta_query[] = [
					'key' => '_sku',
					'value' => 'C$',
					'compare' => 'RLIKE'
				];
				$query->set('meta_query', $meta_query);
				return $query;
			}
		}
	} else {
		return $query;
	}
}
add_action('pre_get_posts', 'custom_search');

function ha_enctype_custom_registration_forms()
{
	echo 'enctype="multipart/form-data" action="/registration-submitted"';
}
add_action('woocommerce_register_form_tag', 'ha_enctype_custom_registration_forms');

function ha_add_register_form_field_top()
{
?>
	<style>
		.width-100 {
			width: 100%;
		}
	</style>
<?php
	woocommerce_form_field(
		'customer_type',
		array(
			'type'        => 'select',
			'required'    => true, // just adds an "*"
			'label'       => 'Please choose your customer type',
			'input_class'				=> ['width-100'],
			'options'			=> [
				'Regular' => 'Regular',
				'Qualified Medical Herbalist / Pharmacist' => 'Qualified Medical Herbalist / Pharmacist',
				'Herbal Medicine Student' => 'Herbal Medicine Student',
				'CAM practitioner - Homeopath' => 'CAM practitioner - Homeopath',
				'CAM practitioner - Colon Hydrotherapist' => 'CAM practitioner - Colon Hydrotherapist',
				'CAM practitioner - Iridologist' => 'CAM practitioner - Iridologist',
				'CAM practitioner - TCM (Traditional Chinese Medicine) Practitioner' => 'CAM practitioner - TCM (Traditional Chinese Medicine) Practitioner',
				'Manufacturer (please provide details below)' => 'Manufacturer (please provide details below)',
				'Other (please provide details below)' => 'Other (please provide details below)'
			],
		),
		(isset($_POST['customer_type']) ? $_POST['customer_type'] : '')
	);

	woocommerce_form_field(
		'details',
		array(
			'type'        => 'textarea',
			'required'    => true, // just adds an "*"
			'label'       => 'Details',
		),
		(isset($_POST['details']) ? $_POST['details'] : '')
	);
}

function ha_add_register_form_field_bottom()
{
?>
	<div class="form-row validate-required c-register__bottom" id="qualifications" data-priority="">
		<label for="qualifications" class="">
			<h3>Qualifications</h3>
			<p>
				Some of our products are only available to professional practitioners. If you wish to be approved as a
				practitioner please upload a scanned copy of you qualifications. We will then review your application
				and contact you via email to let you know. You will still be able to make purchases of some items in
				the mean time. Once approved by our sales team you will be able to purchase a wider set of products.
				If you are not a practitioner you will still be able to purchase most of our products and you may
				skip this step.
			</p>
		</label>
		<span class="woocommerce-input-wrapper"><input type='file' name='qualifications' accept='image/*,.pdf,.doc,.docx'></span>
	</div>
<?php

}
add_action('woocommerce_register_form', 'ha_add_register_form_field_top', 20);
add_action('woocommerce_register_form', 'ha_add_register_form_field_bottom', 30);

function ha_register_top()
{
?>
	<div class="c-register__left">
	<?php
}

function ha_register_middle()
{
	?>
	</div>
	<div class="c-register__right">
	<?php
}

function ha_register_bottom()
{
	echo "</div>";
}

add_action("woocommerce_register_form_start", "ha_register_top");
add_action("woocommerce_register_form", "ha_register_middle", 25);
add_action("woocommerce_register_form", "ha_register_bottom", 35);



function ha_save_register_fields($customer_id)
{
	if (isset($_POST['customer_type'])) {
		update_field('customer_type', wc_clean($_POST['customer_type']), 'user_' . $customer_id);
	}

	if (isset($_POST['details'])) {
		update_field('details', wc_clean($_POST['details']), 'user_' . $customer_id);
	}

	//Upload the file
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	$uploadedfile = $_FILES['qualifications'];
	$movefile = wp_handle_upload($uploadedfile, array('test_form' => false));

	// Add to the media library
	if ($movefile) {
		$wp_upload_dir = wp_upload_dir();
		$attachment = array(
			'guid' => $wp_upload_dir['url'] . '/' . basename($movefile['file']),
			'post_mime_type' => $movefile['type'],
			'post_title' => preg_replace('/\.[^.]+$/', '', basename($movefile['file'])),
			'post_content' => '',
			'post_status' => 'inherit'
		);
		$attach_id = wp_insert_attachment($attachment, $movefile['file']);

		update_field('qualifications', $attach_id, 'user_' . $customer_id);
	}
}
add_action('woocommerce_created_customer', 'ha_save_register_fields');


function ha_custom_register_redirect($redirectURL)
{
	echo "Hello!";
	return get_home_url();
}
add_filter("woocommerce_registration_redirect", "ha_custom_register_redirect", 10, 1);

function update_stock($schedules)
{
	$schedules["every_minute"] = [
		"interval" => 60,
		"display" => esc_html__("Every Minute")
	];
	return $schedules;
}
add_filter("cron_schedules", "update_stock");


function ha_cron_exec()
{
	$debug = [];
	global $wpdb;
	try {
		$variableProducts = wc_get_products([
			"type" => "variable",
			"limit" => "1000"
		]);
	} catch (Throwable $th) {
		echo $th->getMessage();
		$variableProducts = wc_get_products([
			"type" => "variable",
			"limit" => "100"
		]);
	}
	// $groupedProducts = wc_get_products([
	// 	"type" => "grouped"
	// ]);
	
	function get_thousand_stock($variations)
	{
		$stock = 0;
		foreach ($variations as $variationArray) {
			foreach ($variationArray["attributes"] as $attribute) {
				if ($attribute == "1000gm" || $attribute == "1000ml") {
					$variation_obj = new WC_Product_Variation($variationArray["variation_id"]);
					$stock = $variation_obj->get_stock_quantity();
				}
			}
		}
		return $stock;
	}

	function strip_unit($amount)
	{
		preg_match("/[A-Za-z]/", $amount, $matches, PREG_OFFSET_CAPTURE);
		if ($matches[0][1]) {
			return intval(substr($amount, 0, $matches[0][1]));
		} else {
			return intval($amount);
		}
	}

	$debug["test"] = "Test";
	try {
		foreach ($variableProducts as $variableProduct) {

			$variations = $variableProduct->get_available_variations("array");
			$debug["variations"] = $variations;
			$stock = 0;
			foreach ($variations as $variationArray) {
				foreach ($variationArray["attributes"] as $attribute) {
					if ($attribute == "1000gm" || $attribute == "1000ml") {
						$variation_obj = new WC_Product_Variation($variationArray["variation_id"]);
						$stock = $variation_obj->get_stock_quantity();
					}
				}
			}
			$debug["thousand_stock"] = $stock;
			$limit = 500;
			$count = 0;
			if ($stock && $stock > 0 && $count < $limit) {
				foreach ($variations as $variationArray) {
					foreach ($variationArray["attributes"] as $value) {
						if (!strpos($value, "1000")) {
							$unit_stripped = strip_unit($value);
							$debug[$variationArray["variation_id"]]["weight_without_unit"] = $unit_stripped;
							$amount = ($stock * 1000) / $unit_stripped;
							$debug[$variationArray["variation_id"]]["stock"] = $amount;
							update_post_meta($variationArray["variation_id"], "_manage_stock", "yes");
							wc_update_product_stock($variationArray["variation_id"], $amount);
						}
					}
					$count++;
				}
			}
			// update_post_meta($variableProduct->get_id(), "_manage_stock", "yes");
			// update_post_meta($variableProduct->get_id(), "_manage_stock", "no");
		}
	} catch (\Throwable $th) {
		echo $th->getMessage() . "<br>";
		echo $th->getFile() . "<br>";
		echo $th->getLine();
	}
	?>
	<script>
		console.log(<?= json_encode($variableProducts) ?>)
		console.log(<?= json_encode($debug) ?>);
	</script>
	<?php
}

add_action("ha_cron_hook", "ha_cron_exec");

if (!wp_next_scheduled("ha_cron_hook")) {
	wp_schedule_event(time(), "every_minute", "ha_cron_hook");
}

// echo '<pre>'; print_r( _get_cron_array() ); echo '</pre>';


function ha_edit_price_display($price)
{
	global $product;

	if ($product && $product->is_type("grouped") && is_product()) {
		return "";
	} else if (is_product()) {
		return "<div class='c-price'>" . $price . "</div>";
	}
	return $price;
}

add_filter('woocommerce_get_price_html', "ha_edit_price_display");

add_filter( 'woocommerce_is_purchasable', 'vna_is_purchasable', 10, 2 );
function vna_is_purchasable( $purchasable, $product ){
    return true || false; // depending on your condition
}

add_filter( 'the_content', 'customizing_woocommerce_description' );
function customizing_woocommerce_description( $content ) {

	global $product;
	
	if($product){
		$productId = $product->get_id(); 
		$info = get_post_meta($productId,$key,true);
		$data = unserialize($info['product_descriptions'][0]);
		foreach($data as $description){
			if($description=='pet_bottles'){
				$content .= "<h2>Packaging</h2><p>Product is supplied in amber PET bottles with tamper evident screw tops.</p>";
			}
			if($description=='tincture'){
				$content .= "<h2>What is a Tincture?</h2><p>A herbal tincture is a concentrated extract of one or more herbs. The liquid in a tincture is a combination of alcohol and water. A tincture must contain at least 20% alcohol for preservation purposes. Alcohol concentrations tend to vary between 20% and 60%, but can be as high as 90% in some circumstances. At Herbal Apothecary we generally produce tinctures with alcohol concentrations of 25% - 45%. We use ethanol derived from sugar beat.</p><h2>How Are Tinctures Made?</h2><p>To produce the tincture we combine a quantity of herb with a proportional amount of liquid. Depending on the herb and the strength of tincture required this ratio can be 1:2, 1:3 or 1:4. The herb, alcohol and water is placed in a production vessel suitable for the size of the batch.</p><p>Traditionally, tinctures have been made by a process of maceration. This is where the herb sits in the liquid and over a period of time the plant cells break down. This allows the plant matter to be released into the liquid. Occasionally the producer might agitate the mixture to help the process along.</p><p>At Herbal Apothecary we have spent decades improving our tincture production processes. We use a system called Hydro-Ethanolic Percolation. Percolation is where liquid slowly passes through the herb, from top to bottom. In our case, the liquid is not simply passed through the herb once and then collected. Instead, it is continually cycled through the herb. Hydro-Ethanolic Percolation is a combination of maceration and traditional percolation. The circulation of liquid through a spray head agitates the herb, helping the key chemical compounds to be released into the liquid.</p><p>Our production vessels are primarily stainless steel. We use low voltage (24v) pumps to circulate the liquid. We have also developed a system of float switches and relays. These ensure the pumps only activate when an adequate level of liquid is present in the sump at the bottom of the vessel. It can take some time for the liquid to filter through the herb.</p><p>We produce most of our tinctures using dried herbs, although we sometimes use fresh. It's important that the size of the pieces of herb in the production vessel are small enough for the alcohol to thoroughly penetrate. No prior processing is required for flowers and leaves which are smaller and more delicate. However, for roots, bark and berries which tend to be tougher and larger we use herbs which are diced up into small pieces. This ensures that the maximum amount of plant material can be extracted into the liquid.</p><p>The manufacturing process takes 7 days to complete. Once the process is finished, the herb is pressed to extract every last drop of precious liquid. The liquid is filtered and then stored in bulk containers, before being bottled in smaller 250ml, 500ml and 1000ml quantities.</p><p><a href='/manufacturing/'>Click here if you'd like to know more about our herbal tincture manufacturing technology</a>. At Herbal Apothecary we are committed to research - we want to provide a robust evidence base for the products we produce. As a result we review our manufacturing systems and processes in order to ensure we're making best use of the raw ingredients.</p>";
			}
		}
	
	    return $content;
    
    }else{
	    return $content;
    }
}