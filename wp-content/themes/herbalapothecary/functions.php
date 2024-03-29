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
	define('_S_VERSION', '1.1.4');
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

function ha_add_grouped_product_to_breadcrumb($breadcrumbs, $args)
{
	global $post;

	$product = wc_get_product($post->ID);

	// echo "post parent: " . get_post_parent() . "<br>";
	// echo "<pre>". print_r($product, true) . "</pre>";
	// echo "<pre>". print_r($post, true) . "</pre>";

	// echo "<pre>". print_r($args, true) . "</pre>";
	return $breadcrumbs;
}

add_filter("woocommerce_breadcrumb", "ha_add_grouped_product_to_breadcrumb", 20, 2);



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
	wp_enqueue_style('herbalapothecary-style', get_template_directory_uri() . "/style.css", array(), _S_VERSION);
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
add_action('woocommerce_product_query', 'custom_search');


function show_only_instock_products($query)
{
	$meta_query = $query->get('meta_query');
	$meta_query[] = array(
		'key'       => '_stock_status',
		'compare'   => '=',
		'value'     => 'instock'
	);
	$query->set('meta_query', $meta_query);
}
add_action('woocommerce_product_query', 'show_only_instock_products');


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


function get_thousand_stock($variations)
{
	$stock = 0;
	foreach ($variations as $variation) {
		foreach ($variation["attributes"] as $attribute) {
			if ($attribute == "1000gm" || $attribute == "1000ml") {
				$variation_obj = new WC_Product_Variation($variation["variation_id"]);
				$stock = $variation_obj->get_stock_quantity();
			}
		}
	}
	return $stock;
}

function strip_unit($amount)
{
	preg_match("/[A-Za-z-]/", $amount, $matches, PREG_OFFSET_CAPTURE);
	if ($matches[0][1]) {
		return intval(substr($amount, 0, $matches[0][1]));
	} else {
		return intval($amount);
	}
}

function custom_get_variations($variableProduct)
{
	$children = $variableProduct->get_children();
	// print_r($children);
	$variations = [];
	if (!empty($children)) {
		foreach ($children as $childID) {
			$child = wc_get_product($childID)->get_data();
			$child["variation_id"] = $child["id"];
			$variations[] = $child;
		}
	}
	// echo "<pre>" . print_r($variations, true) . "</pre>";
	return $variations;
}

function print_readable($array)
{
	echo "<pre>" . print_r($array, true) . "</pre>";
}

function get_stock_safe(WC_Product_Variation $variation_obj)
{
	$stock = $variation_obj->get_stock_quantity();
	if (gettype($stock) != "integer") {
		$stock = 0;
	}
	return $stock;
}

function ha_cron_exec_new()
{
	$debug = [];

	$variableProducts = wc_get_products([
		"type" => "variable",
		"limit" => "-1",
	]);



	$count = 0;
	foreach ($variableProducts as $variableProduct) {

		// $variableProduct is type WC_Product_Variable, contains variations.
		$variations = custom_get_variations($variableProduct);

		$limit = 1000;

		$is_correct_type = false;
		$correct_type_stock = 0;
		foreach ($variations as $variation) {
			// Loops through variations, then loops through attributes of that variation looking for
			// 1000gm or 1000ml values.
			if ($is_correct_type) {
				break;
			}
			foreach ($variation["attributes"] as $attribute) {
				if ($attribute == "1000gm") {
					$is_correct_type = true;
					$variation_obj = new WC_Product_Variation($variation["variation_id"]);
					$correct_type_stock = get_stock_safe($variation_obj);
					break;
				}
			}
		}

		if ($is_correct_type) {
			$debug["correct_type"] = $debug["correct_type"] + 1;
			foreach ($variations as $variation) {
				foreach ($variation["attributes"] as $value) {
					if (gettype(strpos($value, "1000")) == "boolean") {
						// Updates every variation which is dictated by it's 1000gm variation  
						$unit_stripped = strip_unit($value);
						$amount = ($correct_type_stock * 1000) / $unit_stripped;
						if ($count < 10) {
							$debug["variations_less_than_1000"][] = [
								"id" => $variation["variation_id"],
								"stock" => $amount,
								"details" => $variation
							];
						}

						update_post_meta($variation["variation_id"], "_manage_stock", "yes");
						wc_update_product_stock($variation["variation_id"], $amount);
						wc_delete_product_transients($variation["variation_id"]);
					}
				}
			}
		}
	}

	?>
		<script>
			console.log(<?= json_encode($debug) ?>);
		</script>
		<?php
	}

	function print_custom($data)
	{
		echo "<pre>" . print_r($data, true) . "</pre>";
	}

	function get_grouped_product_children_for_capsules(array $productIDs)
	{
		$products = [];
		foreach ($productIDs as $productID) {
			$product = wc_get_product($productID);
			if (!$product) {
				continue;
			}

			$valid_title_contents = ["capsule", "powder"];
			$title = $product->get_title();
			foreach ($valid_title_contents as $test) {
				if ($products[$test]) {
					continue;
				}

				$str_location = strpos(strtolower($title), $test);
				if ($str_location) {
					$products[$test] = $product;
				}
			}
		}
		return $products;
	}

	function get_variable_product_variation_total_stock_amount($variable_product)
	{
		$variations = $variable_product->get_children();
		$max_value = 0;
		$stock = 0;
		foreach ($variations as $v) {
			$variation = wc_get_product($v);
			$attribute = $variation->get_attributes()["pa_size"];

			$matches = [];
			preg_match('/[0-9]*/', $attribute, $matches);
			foreach ($matches as $match) {
				if ($match > $max_value) {
					$max_value = $match;
					$stock = get_stock_safe($variation);
				}
			}
		}
		return $max_value * $stock;
	}

	function get_capsule_thousand_stock_variation($capsule_product)
	{
		$variations = $capsule_product->get_children();
		foreach ($variations as $v) {
			$variation = new WC_Product_Variation($v);
			$attribute = $variation->get_attributes()["pa_size"];

			$matches = [];
			preg_match('/1000/', $attribute, $matches);
			if (count($matches) > 0) {
				return $v;
			}
		}
		return null;
	}

	function set_capsule_stock()
	{

		$groupedProducts = wc_get_products([
			"type" => "grouped",
			"limit" => "-1",
		]);

		$debug = [];
		$count = 0;


		foreach ($groupedProducts as $groupedProduct) {
			// echo $groupedProduct->get_title() . "<br>";
			// get the children
			// if the product has children of capsules and powder, execute
			$children = $groupedProduct->get_children();
			$products = get_grouped_product_children_for_capsules($children);
			if (count($products) != 2) {
				continue;
			}
			echo "<strong>" . $groupedProduct->get_title() . "</strong>" . "<br>";

			// check stock of powder
			$powderProduct = $products["powder"];
			$capsuleProduct = $products["capsule"];
			$capsuleVariationID = get_capsule_thousand_stock_variation($capsuleProduct);
			$capsuleProductStock = get_variable_product_variation_total_stock_amount($capsuleProduct);

			$isFromPowder = get_post_meta($capsuleVariationID, "_stock_from_powder", true) == "true";
			echo "From powder: " . ($isFromPowder ? "true" : "false") . "<br>";

			if ($capsuleProductStock > 0 && !$isFromPowder) {
				echo "Powder In Stock <br><br>";
				continue;
			}


			$stock_in_grams = 0;
			if ($powderProduct->is_type("variable")) {
				$stock_in_grams = get_variable_product_variation_total_stock_amount($powderProduct);
			} else {
				echo "Product is not variable<br><br>";
				continue;
			}

			if ($stock_in_grams < 1000) {
				echo "Product is out of stock<br><br>";
				continue;
			}

			echo "Stock - $stock_in_grams" . "g<br>";

			// set new capsule stock level based on powder stock
			$capsuleVariation = wc_get_product($capsuleVariationID);
			if (!$capsuleVariation) {
				echo "<br>";
				continue;
			}

			echo "Updating stock of " . $capsuleVariation->get_title() . " to " . $stock_in_grams / 500 . "<br>";
			wc_update_product_stock($capsuleVariationID, $stock_in_grams / 500);
			wc_delete_product_transients($capsuleVariationID);

			update_post_meta($capsuleVariationID, "_shipping_status", "Please allow up to 7 days for delivery");
			update_post_meta($capsuleVariationID, "_stock_from_powder", "true");

			echo "<br>";


			$count++;
		}

		echo "<pre>" . print_r($debug, true) . "</pre>";
	}

	function verify_variable_stock(WC_Product_Variable $variable_product)
	{
		$has_stock = false;

		$variation_ids = $variable_product->get_children();
		foreach ($variation_ids as $variation_id) {
			$variation = wc_get_product($variation_id);
			if ($variation->get_stock_quantity() > 0) {
				$has_stock = true;
				break;
			}
		}


		update_post_meta($variable_product->get_id(), "_manage_stock", "no");

		if ($has_stock) {
			update_post_meta($variable_product->get_id(), "_stock_status", "instock");
		} else {
			update_post_meta($variable_product->get_id(), "_stock_status", "outofstock");
		}
	}

	// add_action("ha_cron_hook", "ha_cron_exec");

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
			$class = "c-price c-price--" . $product->get_type();
			return "<div class='" . $class . "'>" . $price . "</div>";
		}
		return $price;
	}

	add_filter('woocommerce_get_price_html', "ha_edit_price_display");

	add_filter('woocommerce_is_purchasable', 'vna_is_purchasable', 10, 2);
	function vna_is_purchasable($purchasable, $product)
	{
		return true || false; // depending on your condition
	}

	add_filter('the_content', 'customizing_woocommerce_description');
	function customizing_woocommerce_description($content)
	{

		global $product;

		if ($product) {
			$productId = $product->get_id();
			$info = get_post_meta($productId, "", true);
			$data = null;
			if (gettype($info) == "array" && array_key_exists("product_descriptions", $info)) {
				$data = unserialize($info['product_descriptions'][0]);
			}
			if ($data) {
				foreach ($data as $description) {
					if ($description == 'pet_bottles') {
						$content .= "<h2>Packaging</h2><p>Product is supplied in amber PET bottles with tamper evident screw tops. This keeps the contents fresh and protected from light. Look out for the QR code on the label - you can scan this with your smartphone to download the Certificate of Analysis document for this product.</p>";
					}
					if ($description == 'foil_bags') {
						$content .= "<h2>Packaging</h2><p>This product is packaged in protective foil bags. These keep the contents fresh and protected from moisture and light. Look out for the QR code on the label - you can scan this with your smartphone to download the Certificate of Analysis document for this product.</p>";
					}
					if ($description == 'clear_bags') {
						$content .= "<h2>Packaging</h2><p>This product is packaged in resealable clear bags. These keep the contents fresh and protected from moisture. Look out for the QR code on the label - you can scan this with your smartphone to download the Certificate of Analysis document for this product.</p>";
					}
					if ($description == 'tincture') {
						$content .= "<h2>What is a Tincture?</h2><p>A herbal tincture is a concentrated extract of one or more herbs. The liquid in a tincture is a combination of alcohol and water. A tincture must contain at least 20% alcohol for preservation purposes. Alcohol concentrations tend to vary between 20% and 60%, but can be as high as 90% in some circumstances. At Herbal Apothecary we generally produce tinctures with alcohol concentrations of 25% - 45%. We use ethanol derived from sugar beat.</p><h2>How Is A Tincture Made?</h2><p>To produce the " . $product->get_name() . " we combine a quantity of herb with a proportional amount of liquid. Depending on the herb and the strength of tincture required this ratio can be 1:2, 1:3 or 1:4. The herb, alcohol and water is placed in a production vessel suitable for the size of the batch.</p><p>Traditionally, tinctures have been made by a process of maceration. This is where the herb sits in the liquid and over a period of time the plant cells break down. This allows the plant matter to be released into the liquid. Occasionally the producer might agitate the mixture to help the process along.</p><p>At Herbal Apothecary we have spent decades improving our tincture production processes. We use a system called Hydro-Ethanolic Percolation. Percolation is where liquid slowly passes through the herb, from top to bottom. In our case, the liquid is not simply passed through the herb once and then collected. Instead, it is continually cycled through the herb. Hydro-Ethanolic Percolation is a combination of maceration and traditional percolation. The circulation of liquid through a spray head agitates the herb, helping the key chemical compounds to be released into the liquid.</p><p>Our production vessels are primarily stainless steel. We use low voltage (24v) pumps to circulate the liquid. We have also developed a system of float switches and relays. These ensure the pumps only activate when an adequate level of liquid is present in the sump at the bottom of the vessel. It can take some time for the liquid to filter through the herb.</p><p>We produce most of our tinctures using dried herbs, although we sometimes use fresh. It's important that the size of the pieces of herb in the production vessel are small enough for the alcohol to thoroughly penetrate. No prior processing is required for flowers and leaves which are smaller and more delicate. However, for roots, bark and berries which tend to be tougher and larger we use herbs which are diced up into small pieces. This ensures that the maximum amount of plant material can be extracted into the liquid.</p><p>The manufacturing process takes 7 days to complete. Once the process is finished, the herb is pressed to extract every last drop of precious liquid. The " . $product->get_name() . " is filtered and then stored in bulk containers, before being bottled in smaller 250ml, 500ml and 1000ml quantities.</p><p><a href='/manufacturing/'>Click here if you'd like to know more about our herbal tincture manufacturing technology</a>. At Herbal Apothecary we are committed to research - we want to provide a robust evidence base for the products we produce. As a result we review our manufacturing systems and processes in order to ensure we're making best use of the raw ingredients.</p>";
					}
					if ($description == 'fluidextract') {
						$content .= "<h2>What is a Fluid Extract?</h2><p>A herbal fluid extract is a concentrated extract of one or more herbs. The liquid in a fluid extract is a combination of alcohol and water. A fluid extract must contain at least 20% alcohol for preservation purposes. Alcohol concentrations tend to vary between 20% and 60%, but can be as high as 90% in some circumstances. At Herbal Apothecary we generally produce fluid extracts with alcohol concentrations of 25% - 45%. We use ethanol derived from sugar beat.</p><h2>How Is A Fluid Extract Made?</h2><p>To produce " . $product->get_name() . " we combine a quantity of herb with an equal liquid. The herb, alcohol and water is placed in a production vessel suitable for the size of the batch.</p><p>Traditionally, fluid extracts have been made by a process of maceration. This is where the herb sits in the liquid and over a period of time the plant cells break down. This allows the plant matter to be released into the liquid. Occasionally the producer might agitate the mixture to help the process along.</p><p>At Herbal Apothecary we have spent decades improving our fluid extract production processes. We use a system called Hydro-Ethanolic Percolation. Percolation is where liquid slowly passes through the herb, from top to bottom. In our case, the liquid is not simply passed through the herb once and then collected. Instead, it is continually cycled through the herb. Hydro-Ethanolic Percolation is a combination of maceration and traditional percolation. The circulation of liquid through a spray head agitates the herb, helping the key chemical compounds to be released into the liquid.</p><p>Our production vessels are primarily stainless steel. We use low voltage (24v) pumps to circulate the liquid. We have also developed a system of float switches and relays. These ensure the pumps only activate when an adequate level of liquid is present in the sump at the bottom of the vessel. It can take some time for the liquid to filter through the herb.</p><p>We produce most of our fluid extracts using dried herbs, although we sometimes use fresh. It's important that the size of the pieces of herb in the production vessel are small enough for the alcohol to thoroughly penetrate. No prior processing is required for flowers and leaves which are smaller and more delicate. However, for roots, bark and berries which tend to be tougher and larger we use herbs which are diced up into small pieces. This ensures that the maximum amount of plant material can be extracted into the liquid.</p><p>The manufacturing process takes 7 days to complete. Once the process is finished, the herb is pressed to extract every last drop of precious liquid. The " . $product->get_name() . " is filtered and then stored in bulk containers, before being bottled in smaller 250ml, 500ml and 1000ml quantities.</p><p><a href='/manufacturing/'>Click here if you'd like to know more about our herbal tincture manufacturing technology</a>. At Herbal Apothecary we are committed to research - we want to provide a robust evidence base for the products we produce. As a result we review our manufacturing systems and processes in order to ensure we're making best use of the raw ingredients.</p>";
					}
					if ($description == 'capsule') {
						$content .= "<h2>Herbal Capsules</h2><p>We produce " . $product->get_name() . " using powdered herb. The powder is very fine, allowing it to flow into the encapsulation machine. Fine powder is also easier for the body to absorb. Sometimes we produce the powder ourselves, from whole or cut herbs. Other times we source powdered herbs directly from our suppliers.</p><p>Empty capsules are positioned in the the capsule manufacturing machine. We use vegetarian capsules, size '0'. The empty capsules are then filled with the finely-ground powdered herb. A sufficient quantity of herb is pressed into the empty capsules. Once the capsules are full of powdered herb the tops of the capsules are positioned and firmly pressed into position.</p><p>The finished capsules are removed from the machine. Initially we store them in bulk bags. Depending on the type of capsule we may then use our capsule counting machine to dispense capsules into bottles.</p><p>" . $product->get_name() . " are a very convenient way to store and prescribe this herb. Less energy is used in the production process and they take less space to store.</p><p>At Herbal Apothecary we produce a wide range of single herb capsules as well as capsules made with blended herbs. The process for producing a blended capsule involves combining 2 or more powders together before encapsulation. Special care is taken to ensure the herbs are thoroughly blended, ensuring an equal distribution of herb through all capsules. Blended herb capsules are a fantastic way of prescribing more complex remedies in a way which is easy for the patient to take.</p>";
					}
					if ($description == 'powder') {
						$content .= "<h2>Powdered Herbs</h2><p>Powdered herbs like " . $product->get_name() . " are exactly that. We take high quality whole or cut herbs and process them using our powdering machine. Sometimes we source powdered herbs directly from our suppliers.</p><p>Using our powdering machine we can choose the size of the ground herb particle. This means we can produce everything from a course powder, which might be used in a herbal tea or infusion, to a very fine powder.</p><p>Powdered herbs like " . $product->get_name() . " might be used by herbalists in the production of herbal capsules. Powdered herbs are also sometimes used in tincture or fluid extract production.</p>";
					}
					if ($description == 'cut') {
						$content .= "<h2>Cut Herbs</h2><p>Cut herbs are herbs which have been harvested and then cut into smaller pieces, suitable for further processing. Cut herbs like " . $product->get_name() . " can be used to produce tinctures or fluid extracts. They can also be used in herbal teas and infusions.</p>";
					}
					if ($description == 'whole') {
						$content .= "<h2>Whole Herbs</h2><p>Whole herbs like " . $product->get_name() . " are herbs which are a suitable size to use whole. They are often petals and flowers, which tend to be smaller than leaves, stems and roots. Our whole herbs are dried.</p>";
					}
					if ($description == 'organic') {
						$content .= "<h2>Organic Herbs</h2><p>We’re all aware of the importance of choosing organic where possible. Agriculture and farming without the use of chemicals is better for both the environment as well as for our bodies! This is certainly the case when it comes to herbal medicine.</p><p>Our " . $product->get_name() . " is a great choice - with many additional benefits over the standard product.</p><p>We are a certified organic producer. We undergo regular inspections. These ensure that our systems and processes meet the requirements of certified producers. Our customers can be confident that our organic products meet all the statutory requirements. At Herbal Apothecary we manufacture a very wide range of herbal tinctures and fluid extracts. We also supply whole, cut and powdered herbs.</p><p>Organic farming respects nature and improve the health of soils, water and air. It’s about growing food in a way which is sustainable and protects ecosystems. Pesticides are a key contributor to the decline of pollinator populations. They are responsible for driving down the numbers of pollinating insects. There are also strict rules governing the use of additives and preservatives in organic products. Organic agriculture opposes the use of GM crops. Because organic agriculture doesn’t use any chemical pesticides or fertilisers it is better for nature and wildlife. Farms run this way provide a haven for wildlife like bees, birds and butterflies. Studies have found that insect, plant and bird life is upto 50% more abundant on organic farmland. And there are upto 75% more bees on organic land too! <a href='/organic/'>Find out more about our commitment to organic products</a>.</p>";
					}
				}
			}
		}
		return $content;
	}


	function ha_add_to_cart_filter($button, $product, $args)
	{
		// echo "<pre>" . print_r($product->get_id(), true) . "</pre>";
		// echo "<pre>" . print_r($args, true) . "</pre>";
		if ($product->get_type() == "simple") {
			$args_class = $args['class'] ? $args['class'] : 'button';
			$args_class_array = explode(" ", $args_class);
			$new_class_array = [];
			foreach ($args_class_array as $class) {
				if (gettype(strpos($class, "add_to_cart")) == "boolean") {
					$new_class_array[] = $class;
				}
			}
			$new_classes = implode(" ", $new_class_array);


			return sprintf(
				'<a href="%s" data-quantity="%s" class="%s" %s>%s</a>',
				esc_url($product->get_permalink()),
				esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
				esc_attr($new_classes),
				isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
				esc_html("View Product")
			);
		}
		return $button;
	}

	add_filter("woocommerce_loop_add_to_cart_link", "ha_add_to_cart_filter", 40, 3);

	function ha_remove_product_image_link($html, $post_id)
	{
		$html = str_replace("<img ", "<img data-test='this-one' loading='lazy'", $html);
		return preg_replace("!<(a|/a).*?>!", '', $html);
	}
	add_filter('woocommerce_single_product_image_thumbnail_html', 'ha_remove_product_image_link', 10, 2);



	function ha_single_product_acf_details()
	{
		global $post;

		$details_to_list = [];

		$ratio = get_field("ratio");
		if ($ratio) {
			$details_to_list["Ratio"] = $ratio;
		}

		$alcohol = get_field("alcohol");
		if ($alcohol) {
			$details_to_list["Alcohol"] = $alcohol;
		}

		if (!empty($details_to_list)) { ?>
			<div class="c-product__custom-details">
				<?php foreach ($details_to_list as $key => $value) { ?>
					<?php if ($key == 'Ratio') {
						$key = 'Herb to Solvent Ratio';
					} ?>
					<p><span><?= $key ?>:</span> <?= $value ?></p>
				<?php } ?>
			</div>
		<?php }
	}
	add_action("woocommerce_single_product_summary", "ha_single_product_acf_details", 25);

	/**
	 * Add upload button to WP dashboard
	 * @return null
	 */
	function ha_dashboard_widgets()
	{
		global $wp_meta_boxes;

		wp_add_dashboard_widget('ha_upload_widget', 'Herbal Apothecary Stock Upload', 'ha_upload_widget');
	}

	function ha_upload_widget()
	{
		// Generate a custom nonce value.
		if (current_user_can('edit_users')) {
			$ha_upload_nonce = wp_create_nonce('ha_upload_stock_form_nonce');
		?>
			<form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post" id="ha_upload_stock_form" enctype="multipart/form-data">
				<input type="file" name="ha_upload_stock_file" id="ha_upload_stock_file" />
				<input type="hidden" name="action" value="ha_upload_stock">
				<input type="hidden" name="ha_upload_stock_form_nonce" value="<?php echo $ha_upload_nonce; ?>" />
				<script>
					jQuery('#ha_upload_stock_file').on('change', function() {
						jQuery('#ha_upload_stock_form').submit();
					});
				</script>
			</form>
		<?php
		} else {
			echo __("You are not authorized to perform this operation.", $this->plugin_name);
		}
	}
	add_action('wp_dashboard_setup', 'ha_dashboard_widgets');

	function ha_upload_handler()
	{
		if (
			isset($_POST['ha_upload_stock_form_nonce']) &&
			wp_verify_nonce($_POST['ha_upload_stock_form_nonce'], 'ha_upload_stock_form_nonce')
		) {
			// Check we've got the right file type
			if (
				$_FILES['ha_upload_stock_file']['type'] != 'text/csv' &&
				$_FILES['ha_upload_stock_file']['type'] != 'application/vnd.ms-excel'
			)
				wp_die('File must be in CSV format, the MIME type for this file is ' . $_FILES['ha_upload_stock_file']['type'], __('Error'), array(
					'response' 	=> 403
				));

			// Move to the wp-content dir
			if (move_uploaded_file($_FILES['ha_upload_stock_file']["tmp_name"], WP_CONTENT_DIR . '/ha_stock_upload.csv')) {
				echo "File has been uploaded and will be processed shortly. <br /><a href=\"/wp-admin\">Click here to go back</a>";
			} else {
				echo "There was an error uploading the file. Please check the logs for more details.";
			}
		} else {
			echo "Unable to upload.";
			wp_die(__('Invalid nonce specified'), __('Error'), array(
				'response' 	=> 403
			));
		}
	}

	add_action('admin_post_ha_upload_stock', 'ha_upload_handler');

	function ha_add_organic_flag()
	{
		global $product;

		$info = get_post_meta($product->get_id());
		$data = null;
		if (gettype($info) == "array" && array_key_exists("product_descriptions", $info)) {
			$data = unserialize($info['product_descriptions'][0]);
		}
		// echo "<pre>" . print_r($data, true) . "</pre>";
		if ($data && in_array("organic", $data)) {
			echo "<img class='c-product__custom-details-flag' src='/wp-content/uploads/2021/09/euorg.png' alt='Organic Flag'>";
		}
	}
	add_action("woocommerce_single_product_summary", "ha_add_organic_flag", 31);



	// function ha_pagination_args($args) {
	// 	array( // WPCS: XSS ok.
	// 		'base'      => $base,
	// 		'format'    => $format,
	// 		'add_args'  => false,
	// 		'current'   => max( 1, $current ),
	// 		'total'     => $total,
	// 		'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
	// 		'next_text' => is_rtl() ? '&larr;' : '&rarr;',
	// 		'type'      => 'list',
	// 		'end_size'  => 3,
	// 		'mid_size'  => 3,
	// 	)
	// 	$args[""]
	// }

	// add_filter('woocommerce_pagination_args', "ha_pagination_args");

	function ha_redirect_page_one()
	{
		if (preg_match("/page\/1\/{0,1}$/", $_SERVER["REQUEST_URI"])) {
		?>
			<script>
				window.location.href = window.location.href.split("/page/1")[0] + "/";
			</script>
		<?php
		}
	}

	add_action("wp_loaded", "ha_redirect_page_one");

	function ha_show_out_of_stock()
	{
		global $product;

		$child_products = $product->get_children();
		if (empty($child_products)) {
			return;
		}

		$has_stock = false;
		foreach ($child_products as $child_id) {
			$child = wc_get_product($child_id);

			if (!$child) {
				break;
			}

			if ($child->get_type() == "variable") {
				$variation_ids = $child->get_children();
				if (!empty($variation_ids)) {
					foreach ($variation_ids as $variation_id) {
						$variation = wc_get_product($variation_id);
						if ($variation->get_stock_quantity() > 0) {
							$has_stock = true;
							break;
						}
					}
				}
			}

			if ($has_stock) {
				break;
			}

			if ($child->get_stock_quantity() > 0) {
				$has_stock = true;
				break;
			}
		}

		if (!$has_stock) { ?>
			<p class="stock out-of-stock c-product__out-of-stock">Out of stock</p>
		<?php }
	}

	add_action('woocommerce_after_shop_loop_item_title', "ha_show_out_of_stock", 25);

	remove_filter('woocommerce_product_loop_start', 'woocommerce_maybe_show_product_subcategories');

	add_action('woocommerce_review_order_before_submit', "order_disclaimer");
	function order_disclaimer()
	{
		?>
		<div class="c-cart__disclaimer">
			<h3><?php echo __("Import taxes and Duties for International Orders") ?></h3>
			<p>
				<?php
				echo __("All customers are responsible for local import taxes and duties on their orders. 
				The amount charged will differ depending on the content, size and weight of your order as 
				well as the chosen delivery country, so we are unable to provide an estimated cost. You 
				will be contacted by your delivery provider prior to delivery with the cost and how to pay. 
				For more information, please check with your local customs department.")
				?>
			</p>
		</div>

	<?php
	}

	add_action("woocommerce_variation_options_pricing", "ha_add_custom_field_to_variations", 10, 3);
	function ha_add_custom_field_to_variations($loop, $variation_data, $variation)
	{
		woocommerce_wp_text_input([
			"id" => '_shipping_status[' . $loop . ']',
			"class" => "short",
			"label" => __("Shipping Status", 'woocommerce'),
			'value' => get_post_meta($variation->ID, '_shipping_status', true)
		]);
	}

	add_action('woocommerce_save_product_variation', 'ha_save_custom_field_variations', 10, 2);
	function ha_save_custom_field_variations($variation_id, $i)
	{
		$custom_field = $_POST['_shipping_status'][$i];
		if (isset($custom_field)) update_post_meta($variation_id, '_shipping_status', esc_attr($custom_field));
	}

	add_filter('woocommerce_available_variation', 'ha_add_custom_field_variation_data');
	function ha_add_custom_field_variation_data($variations)
	{
		$variations['_shipping_status'] = '<span class="shipping-note">' . get_post_meta($variations['variation_id'], '_shipping_status', true) . '</span>';
		return $variations;
	}

	function ha_update_stock()
	{
		$file = ABSPATH . "/wp-content/ha_stock_upload.csv";

		// Go through each row
		$csvdata = [];
		if (($handle = fopen($file, "r")) !== FALSE) {
			while (($data = fgetcsv($handle, 3000, ",")) !== FALSE) {
				$csvdata[] = $data;
			}
			fclose($handle);
		}

		foreach ($csvdata as $key => $row) {
			if ($key == 0) {
				continue; // We don't want the header
			}

			// Skip anything with a 0 price
			if ($row[4] == 0) {
				echo "Skipping " . $row[0] . " as price is " . $row[4] . "<br>";
				continue;
			}

			// Get the post ID
			// $postId = wc_get_product_id_by_sku($row[$skuCol] . 'P');
			echo "SKU: " . $row[0] . "\n";

			$sku = $row[0];

			if (strlen($sku) == 1) {
				$sku = str_pad($sku, 3, 0, STR_PAD_LEFT);
			}

			$postId = wc_get_product_id_by_sku($sku);

			echo "Post ID: " . $postId . "<br>";
			echo "Stock: " . $row[3] . "<br>";
			echo "Price: " . $row[4] . "<br><br>";

			// See if the SKU exists
			if ($postId != 0) {
				$isFromPowder = get_post_meta($postId, "_stock_from_powder", true) == "true";
				if ($isFromPowder) {
					update_post_meta($postId, "_shipping_status", "");
					update_post_meta($postId, "_stock_from_powder", "false");
				}
				// Add stock
				update_post_meta($postId, "_manage_stock", "yes");
				echo $row[3] . "<br>";
				update_post_meta($postId, '_stock', (float)$row[3]);
				$stock = get_post_meta($postId, '_stock', true);

				// Update price
				update_post_meta($postId, '_regular_price', (float)$row[4]);
				update_post_meta($postId, '_price', (float)$row[4]);
			}
		}
	}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

add_action( 'woocommerce_single_product_summary', 'removing_variable_add_to_cart_template', 3 );
function removing_variable_add_to_cart_template(){
    global $product;

    // Only for variable products
    if( $product->is_type( 'variable' ) AND !is_user_logged_in()){
        remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    }
}
	
/**
* Change WooCommerce products per page
*/
 
add_filter( 'loop_shop_per_page', 'my_new_products_per_page', 9999 );
 
function my_new_products_per_page( $pr_per_page ) {
  $pr_per_page = 24;
  return $pr_per_page;
}