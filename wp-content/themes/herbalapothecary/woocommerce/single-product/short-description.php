<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = strip_tags(apply_filters( 'woocommerce_short_description', $post->post_excerpt ), '<p><a>');

if ( ! $short_description ) {
	return;
}

?>

	<a href="https://nimh.org.uk/meet-our-friends/" target="_blank"><img src="/wp-content/themes/herbalapothecary/images/nimh.png" alt="NIMH" class="nimh" /></a>
	<a href="https://bhma.info/hpss/" target="_blank"><img src="/wp-content/themes/herbalapothecary/images/herbmark.svg" alt="Herb Mark" class="herbmark" /></a>
	<a href="https://www.iso.org/iso-9001-quality-management.html" target="_blank"><img src="/wp-content/themes/herbalapothecary/images/iso.svg" alt="ISO" class="iso" /></a>
	<?php echo $short_description; // WPCS: XSS ok. ?>

