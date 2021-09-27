<!DOCTYPE html>
<html lang="en">

<head <?php language_attributes(); ?>>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

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
						<div class="c-header__contact-phone-placeholder"></div>
						<div class="c-header__contact-details">
							<p>Hotline</p>
							<a href="/">01947 602346</a>
						</div>
					</div>
					<div class="c-header__basket"></div>
					<div class="c-header__account">
						<div class="c-header__icon"></div>
						<div class="c-header__login">
							<a>Log In</a>
							<a>Register</a>
						</div>
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
			else :
				?>
					<div class="c-breadcrumbs l-block l-block--no-padding">
						<div class="l-restrict">
							<?php get_template_part("template-parts/breadcrumbs", "bread") ?>
						</div>
					</div>
				<?php
				endif;
			?>
		</header>
		<div id="content">
