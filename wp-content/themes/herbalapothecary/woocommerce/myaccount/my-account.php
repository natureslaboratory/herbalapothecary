<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * My Account navigation.
 *
 * @since 2.6.0
 */
?>
<div class="c-account">
	<?php
	do_action( 'woocommerce_account_navigation' ); ?>

	<div class="woocommerce-MyAccount-content c-account__main">
		<?php
			/**
			 * My Account content.
			 *
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
			$user = wp_get_current_user();
		?>
		<h2>Get the Newsletter</h2>
		<p>Sign up for our newsletter and get a brief regular update from Herbal Apothecary. You'll be the first to hear about new products and replenished stock, things we're working on behind the scenes and <strong>discount codes</strong>.</p>
		<form
		  action="https://buttondown.email/api/emails/embed-subscribe/herbalapothecary"
		  method="post"
		  target="popupwindow"
		  onsubmit="window.open('https://buttondown.email/herbalapothecary', 'popupwindow')"
		  class="embeddable-buttondown-form"
		>
		  <label for="bd-email">Enter your email</label>
		  <input type="email" name="email" id="bd-email" value="<?= $user->user_email ?>" />
		  <input type="submit" value="Subscribe" />
		</form>
	</div>
</div>