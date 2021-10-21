<?php

/**
 * herbalapothecary functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package herbalapothecary
 */

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

	wp_enqueue_script('herbalapothecary-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
	wp_enqueue_script('herbalapothecary-search', get_template_directory_uri() . '/js/search.js', array(), _S_VERSION, true);

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


function custom_search( $query )
{
  // Don't do this filtering on the tag pages
  if ((array_key_exists("product_tag", $_REQUEST) && $_REQUEST['product_tag'] !== NULL) || strstr($_SERVER['REQUEST_URI'], '/product-tag/') || strstr($_SERVER['REQUEST_URI'], '/calculator/')) {
    return $query;
  }


  if (is_shop() || is_category()) {
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
add_action( 'pre_get_posts', 'custom_search' );