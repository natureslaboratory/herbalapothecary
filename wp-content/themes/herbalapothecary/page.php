<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package herbalapothecary
 */

get_header();

$isProductCat = strpos($_SERVER["REQUEST_URI"], "product-category") ? true : false;
$isShop = strpos($_SERVER["REQUEST_URI"], "shop");

if ($isProductCat) {
	$splitUrl = explode("/product-category/", $_SERVER["REQUEST_URI"]);
	$productCategory = explode("/", $splitUrl[count($splitUrl)-1])[0];
}

?>
	<main id="primary" class="site-main site-main--shop">
		<div class="l-restrict">
			<?php
			if ($isProductCat || $isShop) {
				if ($isShop) {
					get_template_part("template-parts/product-categories", "categories");
				}
				echo "<div class='c-shop__grid c-shop__grid--category'>";
				
				get_sidebar();
				// get_template_part("template-parts/shop-sidebar", "sidebar");
				echo "<div class='c-shop__main'>";
			}
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// if ($isProductCat) {
				// 	$shopArgs = $isShop ? [] : ["category" => $productCategory];
				// 	get_template_part("template-parts/products", "shop", $shopArgs);
				// }

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			if ($isProductCat || $isShop) {
				echo "</div></div>";
			}
			?>
		</div>

	</main><!-- #main -->

<?php
// get_sidebar();
get_footer();
