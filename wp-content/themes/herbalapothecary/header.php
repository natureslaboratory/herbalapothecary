<!DOCTYPE html>
<html lang="en">

<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<script src="https://kit.fontawesome.com/5bcd9efe81.js" crossorigin="anonymous"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page">
		<header class="c-header">
			<div class="c-header__inner l-restrict">
				<a href="/"><img class="c-header__logo" src="<?= get_bloginfo("template_url") ?>/images/logo.webp"></a>
				<form class="c-search">
					<select class="c-search__dropdown">
						<option>All</option>
						<option>Option 1</option>
						<option>Option 2</option>
					</select>
					<input class="c-search__box" type="text" placeholder="I'm shopping for...">
					<button type="submit" class="c-button">Search</button>
				</form>
				<div class="c-header__buttons">
					<div class="c-header__contact">
						<i class="fas fa-phone-alt"></i>
						<div class="c-header__contact-details">
							<p>Hotline</p>
							<a href="/">01947 602346</a>
						</div>
					</div>
					<div class="c-header__cart c-menu__trigger">
						<a href="<?= wc_get_cart_url() ?>">
							<i class="fas fa-shopping-bag"></i>
						</a>
						<div class="c-header__cart-menu-wrapper c-menu__wrapper">
							<div class="c-header__cart-menu c-menu">
								<ul class="c-header__cart-list">
									<?php 
										global $woocommerce;
										$items = $woocommerce->cart->get_cart();

										foreach ($items as $itemKey => $item) {
											$_product = wc_get_product($item["data"]->get_id()); 
											$quantity = $item["quantity"];
											?>
											<li>
												<?= $_product->get_image() ?>
												<div class="c-header__cart-product-details">
													<a class="c-header__cart-product-name" href="<?= $_product->get_permalink() ?>"><?= $_product->get_title() ?></a>
													<p><?= $quantity ?> &#215; <?= wc_price($_product->get_price()) ?></p>
												</div>
												<a class="c-header__cart-product-delete" href="<?= wc_get_cart_remove_url($itemKey) ?>"><i class="fas fa-times"></i></a>
											</li>
										<?php } ?>

								</ul>
								<div class="c-header__cart-price">
									<h4>Subtotal:</h4>
									<p><?= wc_price($woocommerce->cart->cart_contents_total) ?></p>
								</div>
								<div class="c-header__cart-buttons">
									<a href="<?= wc_get_cart_url() ?>"><button class="c-button">View Basket</button></a>
									<a href="<?= wc_get_checkout_url() ?>"><button class="c-button">Checkout</button></a>
								</div>
							</div>
						</div>
					</div>
					<div class="c-header__account c-menu__trigger">
						<a class="c-header__account-link" href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
							<i class="far fa-user"></i>
						</a>
						<?php if (!is_user_logged_in()) { ?>
							<a href="<?= get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
								<div class="c-header__login">
									<p>Log In</p>
									<p>Register</p>
								</div>
							</a>
						<?php } else { ?>
							<div class="c-header__account-menu-wrapper c-menu__wrapper">
								<div class="c-header__account-menu c-menu">
									<?php
									global $current_user;
									wp_get_current_user();
									?>
									<h4>Hello, <?= $current_user->user_login ?>! </h4>
									<?php
									wp_nav_menu(
										array(
											'menu' => 'account-dropdown',
											'menu_id' => 'account-menu',
											'menu_class' => 'c-header__account-menu-list'
										)
									);
									?>
									<div class="c-header__account-menu-logout">
										<a href="<?= wp_logout_url() ?>">Logout</a>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<nav id="site-navigation" class="main-navigation c-navigation l-block l-block--no-padding">
				<div class="l-restrict c-navigation__inner">
					<div>
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'herbalapothecary'); ?></button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id' => 'primary-menu',
								'menu_class' => 'c-navigation__menu'
							)
						);
						?>
					</div>
					<form class="c-search c-search--navigation">
						<input class="c-search__box" type="text" placeholder="I'm shopping for...">
						<button type="submit" class="c-button">Search</button>
					</form>
				</div>
			</nav>
			<?php
			if (is_front_page()) :
			?>
				<div class="c-banner l-block l-block--no-padding">
					<div class="l-restrict">
						<h3>We Ship Internationally from UK</h3>
					</div>
				</div>
			<?php
			endif;
			?>
		</header>
		<div id="content">